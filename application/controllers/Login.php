<?php

class Login extends CI_Controller {

    function index() {
        if ($this->session->userdata('username') != '') {
            redirect('login/beranda');
        }
        $this->load->view('login_form');
    }

    function validasi() {
        $r = $this->db->where([
                    'username' => $this->input->post('username'),
                    'password' => md5($this->input->post('password'))
                ])->get('ms_user')->row_array();
        if (count($r) <= 0) {
            redirect('');
        } else {
            $this->session->set_userdata('username', $r['username']);
            $this->session->set_userdata('level', $r['level']);
            $this->session->set_userdata('nama', $r['nama']);
            redirect('login/beranda');
        }
    }

    function beranda() {
        // menghitung stok awal
        if (count($this->crud->read('stok_awal', ['tanggal' => date('Y-m-d')])) == 0) {
            $r0 = $this->crud->read('stok_akhir', ['tanggal<' => date('Y-m-d')], 'tanggal DESC'); // lihat tgl terakhir ada stok akhir
            if (count($r0) > 0) {
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
        }
        $sql = "INSERT IGNORE INTO stok_awal (SELECT CURDATE() AS tanggal,id,'0' AS jumlah,'' AS keterangan,'" . $this->session->userdata('username') . "' AS user FROM ms_stok)";
        $this->db->query($sql);
        $this->db->query($sql);
        $this->load->view('template', [
            'content' => '<h3><strong>Stok Barang dan Penjualan</strong</h3>'
        ]);
    }

    function logout() {
        $this->session->unset_userdata('username');
        redirect('');
    }

}
