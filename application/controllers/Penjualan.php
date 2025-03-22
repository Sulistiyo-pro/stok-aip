<?php

class Penjualan extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('username') == '') {
            redirect('login');
        }
        if ($this->session->userdata('level') != 'admin') {
            echo 'Akses ditolak ...';
            exit();
        }
    }

    function index() {
        $this->pesan();
    }

    function pesan() {
        $nota_manual = $this->db->where([
            'MONTH(waktu)' => date('m'),
            'YEAR(waktu)' => date('Y')
        ])->order_by('nota_manual','DESC')->get('tr_penjualan')->row_array();
        $nota = isset($nota_manual['nota_manual']) ? ++$nota_manual['nota_manual'] : 1;
        $_SESSION['nota'] = isset($_SESSION['nota']) ? $_SESSION['nota'] : 'PJ-' . time();
        $_SESSION['meja'] = isset($_SESSION['meja']) ? $_SESSION['meja'] : '';
        $_SESSION['nota_manual'] = isset($_SESSION['nota_manual']) ? $_SESSION['nota_manual'] : $nota;
        $sql = "SELECT a.*,b.nama,b.satuan FROM tr_penjualan a, ms_stok b WHERE a.menu=b.id AND a.nota='" . $_SESSION['nota'] . "' ORDER BY a.id";
        $this->load->view('template', [
            'content' => $this->load->view('penjualan_form', [
                'menu' => $this->crud->read('ms_stok','','id'),
                'cart' => $this->db->query($sql)->result_array()
                    ], TRUE)
        ]);
    }

    function create() {
        // menghitung stok akhir
        $tanggal = date('Y-m-d');
        $this->crud->delete('stok_akhir', ['tanggal' => $tanggal]);
        $r0 = $this->crud->read('stok_awal', ['tanggal' => $tanggal]);
        foreach ($r0 as $r) {
            $awal = $r['jumlah'];
            $masuk = get_total_masuk($r['id'], date('Y-m-d'));
            $keluar = get_total_keluar($r['id'], date('Y-m-d'));
            $terjual = get_total_terjual($r['id'], date('Y-m-d'));
            $akhir = $awal + $masuk - $keluar - $terjual;
            $this->crud->create('stok_akhir', [
                'tanggal' => $tanggal,
                'id' => $r['id'],
                'awal' => $awal,
                'masuk' => $masuk,
                'keluar' => $keluar,
                'terjual' => $terjual,
                'akhir' => $akhir,
                'user' => $this->session->userdata('username')
            ]);
        }
        
        $menu = explode('/', $this->input->post('menu'));
        $m = $this->crud->read('ms_stok', ['id' => trim($menu[0])]);
        $s = $this->crud->read('stok_akhir', ['tanggal' => $tanggal,'id' => trim($menu[0])])[0];
        if (count($m) > 0 && $s['akhir'] > 0) {
            $m = $m[0];
            $_POST['harga'] = $m['harga'];
            $_POST['total'] = $m['harga'] * $this->input->post('qty');
            $_POST['stok'] = trim($menu[0]);
            $_POST['user'] = $this->session->userdata('username');
            $this->crud->create('tr_penjualan', $this->input->post());
            $this->session->set_flashdata('error', 'Barang berhasil ditambahkan.');
            redirect('penjualan');
        }else{
            $this->session->set_flashdata('error', 'Stok barang tidak mencukupi.');
            redirect('penjualan');
        }
        
    }
    function kembalian($nota){
        $data = $this->db->query("SELECT SUM(total) AS total FROM tr_penjualan WHERE nota='".$nota."'")->row_array();
        $this->load->view('template', [
            'content' => $this->load->view('kembalian', ['data' => $data], TRUE)
        ]);
    }
    function delete($id) {
        $this->crud->delete('tr_penjualan', ['id' => $id]);
        redirect('penjualan');
    }

    function simpan() {
        
        $this->crud->update('tr_penjualan',['nota' => $this->input->post('nota')],[
            'cetak' => '1',
            'bayar' => $this->input->post('bayar'),
            'kembali' => ($this->input->post('bayar')-$this->input->post('total'))
        ]);
        unset($_SESSION['nota']);
        unset($_SESSION['meja']);
        unset($_SESSION['nota_manual']);
        redirect('penjualan/cetak/' . $this->input->post('nota'));
        redirect('penjualan');
    }

    function cetak($nota) {
        $this->load->library('PHPExcel');
        $sql = "SELECT a.*,b.nama,b.satuan,b.harga FROM tr_penjualan a, ms_stok b WHERE a.stok=b.id AND a.nota='" . $nota . "' ORDER BY a.id";
        $this->load->view('print_nota_excel', [
            'data' => $this->db->query($sql)->result_array(),
            'ket' => $this->db->query($sql)->row_array()
        ]);
    }
    function bayar(){
        $sql = "SELECT *,SUM(total) AS tot FROM tr_penjualan WHERE cetak='0' AND waktu LIKE '".date('Y-m-d')."%' GROUP BY nota ORDER BY meja";
        $data = $this->db->query($sql)->result_array();
        $this->load->view('template', [
            'content' => $this->load->view('penjualan_bayar', ['data' => $data], TRUE)
        ]);
    }
    function baru(){
        unset($_SESSION['nota']);
        unset($_SESSION['meja']);
        unset($_SESSION['nota_manual']);
        redirect('penjualan/pesan');
    }
    function edit($nota,$meja,$nota_manual){
        $_SESSION['nota'] = $nota;
        $_SESSION['meja'] = $meja;
        $_SESSION['nota_manual'] = $nota_manual;
        redirect('penjualan/pesan');
    }
    function hapus_nota($nota,$kembali){
        $this->crud->delete('tr_penjualan',['nota' => $nota]);
        unset($_SESSION['nota']);
        unset($_SESSION['meja']);
        unset($_SESSION['nota_manual']);
        redirect('penjualan/'.$kembali);
    }
    function pindah(){
        $this->crud->update('tr_penjualan',['nota' => $this->input->post('nota')],['meja' => $this->input->post('meja')]);
        redirect('penjualan/bayar');
    }
}
