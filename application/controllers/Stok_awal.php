<?php

class Stok_awal extends CI_Controller {

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
            } else {
                $r2 = $this->crud->read('ms_stok',null,'id');
                foreach($r2 as $r){
                    $this->crud->create('stok_awal', [
                        'tanggal' => date('Y-m-d'),
                        'id' => $r['id'],
                        'jumlah' => '0',
                        'user' => $this->session->userdata('username')
                    ]);
                }
            }
        }
        $this->load->view('template', [
            'content' => $this->load->view('stokawal_list', ['data' => $this->crud->read('stok_awal', ['tanggal' => date('Y-m-d')], 'id')], TRUE)
        ]);
    }

    function form() {
        $this->load->view('template', [
            'content' => $this->load->view('stokawal_form', ['stok' => $this->crud->read('ms_stok')], TRUE)
        ]);
    }

    function edit($id) {
        $this->load->view('template', [
            'content' => $this->load->view('stokawal_form', [
                'data' => $this->crud->find('stok_awal', ['tanggal' => date('Y-m-d'), 'id' => $id])[0],
                'stok' => $this->crud->read('ms_stok')
                    ], TRUE)
        ]);
    }

    function update() {
        $this->crud->update('stok_awal', ['tanggal' => date('Y-m-d'), 'id' => $this->input->post('id')], $this->input->post());
        redirect('stok_awal');
    }

    function create() {
        $_POST['user'] = $this->session->userdata('username');
        $this->crud->create('stok_awal', $this->input->post());
        redirect('stok_awal');
    }

    function delete($id) {
        $this->crud->delete('stok_awal', ['tanggal' => date('Y-m-d'), 'id' => $id]);
        redirect('stok_awal');
    }

}
