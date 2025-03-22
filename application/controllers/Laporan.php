<?php

class Laporan extends CI_Controller {

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

    function penjualan_harian($tanggal = null) {

        if ($tanggal == null) {

            $tanggal = date('Y-m-d');
        } else {

            $tanggal = implode('-', array_reverse(explode('-', $tanggal)));
        }

        $sql = "SELECT *, SUM(total) AS tot FROM tr_penjualan WHERE waktu LIKE '" . $tanggal . "%' GROUP BY nota ORDER by waktu";

        $data = $this->db->query($sql)->result_array();

        $this->load->view('template', [
            'content' => $this->load->view('lprn_penjualan_harian', ['data' => $data], true)
        ]);
    }

    function rekap_penjualan_harian($tanggal = null) {

        if ($tanggal == null) {

            $tanggal = date('Y-m-d');
        } else {

            $tanggal = implode('-', array_reverse(explode('-', $tanggal)));
        }



        $sql = "SELECT menu,harga, SUM(qty) AS qty, SUM(total) AS total FROM tr_penjualan WHERE waktu LIKE '$tanggal%' GROUP BY menu";

        $data = $this->db->query($sql)->result_array();

        $this->load->view('template', [
            'content' => $this->load->view('lprn_rekap_penjualan_harian', ['data' => $data], true)
        ]);
    }

    function posisi_stok() {
        if (isset($_GET['mulai']) && isset($_GET['selesai'])) {
            $mulai = implode('-', array_reverse(explode('-', $_GET['mulai'])));
            $selesai = implode('-', array_reverse(explode('-', $_GET['selesai'])));
        } else {
            $mulai = date('Y-m-d');
            $selesai = date('Y-m-d');
        }

        $this->crud->delete('stok_akhir', ['tanggal' => $selesai]);

        $r0 = $this->crud->read('stok_awal', ['tanggal' => $selesai]);

        foreach ($r0 as $r) {

            $awal = $r['jumlah'];

            $masuk = get_total_masuk($r['id'], $selesai);

            $keluar = get_total_keluar($r['id'], $selesai);

            $terjual = get_total_terjual($r['id'], $selesai);

            $akhir = $awal + $masuk - $keluar - $terjual;

            $this->crud->create('stok_akhir', [
                'tanggal' => $selesai,
                'id' => $r['id'],
                'awal' => $awal,
                'masuk' => $masuk,
                'keluar' => $keluar,
                'terjual' => $terjual,
                'akhir' => $akhir,
                'user' => $this->session->userdata('username')
            ]);
        }

        //$data = $this->crud->read('stok_akhir', ['tanggal' => $tanggal], 'id');
        $sql = "SELECT id,IFNULL((SELECT awal FROM stok_akhir x WHERE x.tanggal='$mulai' AND x.id=y.id),0) AS awal, IFNULL((SELECT akhir FROM stok_akhir z WHERE z.tanggal='$selesai' AND z.id=y.id),0) AS akhir, sum(masuk) AS masuk, sum(keluar) as keluar, sum(terjual) as terjual FROM stok_akhir y JOIN ms_stok USING(id) WHERE tanggal BETWEEN '$mulai' AND '$selesai' GROUP BY id ORDER BY id";
        $data = $this->db->query($sql)->result_array();

        $this->load->view('template', [
            'content' => $this->load->view('lprn_posisi_stok_harian', ['data' => $data], true)
        ]);
    }

    function posisi_kas($tanggal = null) {

        if ($tanggal == null) {

            $tanggal = date('Y-m-d');
        } else {

            $tanggal = implode('-', array_reverse(explode('-', $tanggal)));
        }

        $this->crud->delete('kas_akhir', ['tanggal' => $tanggal]);

        $r0 = $this->crud->read('kas_awal', ['tanggal' => $tanggal]);

        foreach ($r0 as $r) {

            $awal = $r['jumlah'];

            $masuk = get_total_kas_masuk($r['id'], $tanggal);

            $keluar = get_total_kas_keluar($r['id'], $tanggal);

            $penjualan = get_total_kas_penjualan($r['id'], $tanggal);

            $akhir = $awal + $masuk + $penjualan - $keluar;

            $this->crud->create('kas_akhir', [
                'tanggal' => $tanggal,
                'id' => $r['id'],
                'awal' => $awal,
                'masuk' => $masuk,
                'penjualan' => $penjualan,
                'keluar' => $keluar,
                'akhir' => $akhir,
                'user' => $this->session->userdata('username')
            ]);
        }

        $data = $this->crud->read('kas_akhir', ['tanggal' => $tanggal], 'id');

        $this->load->view('template', [
            'content' => $this->load->view('lprn_posisi_kas_harian', ['data' => $data], true)
        ]);
    }

    function ubah_tanggal() {

        redirect('laporan/' . $this->input->post('laporan') . '/' . $this->input->post('tanggal'));
    }

    function hitung_ulang() {
        $r0 = $this->crud->read('stok_akhir', ['tanggal<' => date('Y-m-d')], 'tanggal DESC'); // lihat tgl terakhir ada stok akhir
        if (count($r0) > 0) {
            $sql = "DELETE FROM stok_awal WHERE tanggal='" . date('Y-m-d') . "'";
            $this->db->query($sql);
            
            $r1 = $this->crud->read('stok_akhir', ['tanggal' => $r0[0]['tanggal']]); // select yang tglnya paling akhir
            foreach ($r1 as $r) {
                $this->crud->create('stok_awal', [
                    'tanggal' => date('Y-m-d'),
                    'id' => $r['id'],
                    'jumlah' => $r['akhir'],
                    'keterangan' => 'Dari stok akhir tgl: ' . $r['tanggal'],
                    'user' => $this->session->userdata('username')
                ]);
            }
        }
        $sql = "INSERT IGNORE INTO stok_awal (SELECT CURDATE() AS tanggal,id,'0' AS jumlah,'' AS keterangan,'" . $this->session->userdata('username') . "' AS user FROM ms_stok)";
        $this->db->query($sql);
        echo $sql = "DELETE FROM stok_awal WHERE tanggal='" . date('Y-m-d') . "' AND id NOT IN (SELECT id FROM ms_stok)";
        $this->db->query($sql);
        redirect('laporan/posisi_stok');
    }

}
