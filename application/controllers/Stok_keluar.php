<?php

class Stok_keluar extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('username') == '') {
            redirect('login');
        }

    }

    function index() {
        $this->load->view('template', [
            'content' => $this->load->view('stokkeluar_list', [
                'data' => $this->crud->read('stok_keluar', ['tanggal' => date('Y-m-d')], 'id')
            ], TRUE)
        ]);
    }
    function form() {
        $this->load->view('template', [
            'content' => $this->load->view('stokkeluar_form', ['stok' => $this->crud->read('ms_stok')], TRUE)
        ]);
    }
    function edit($id,$waktu) {
		if ($this->session->userdata('level') != 'admin') {
            echo 'Akses ditolak ...';
            exit();
        }
        $this->load->view('template', [
            'content' => $this->load->view('stokkeluar_form', [
                'data' => $this->crud->find('stok_keluar', ['waktu' => $waktu,'id' => $id])[0],
                'stok' => $this->crud->read('ms_stok')
                    ], TRUE)
        ]);
    }
    function update() {
		if ($this->session->userdata('level') != 'admin') {
            echo 'Akses ditolak ...';
            exit();
        }
        $this->crud->update('stok_keluar', ['waktu' => $this->input->post('waktu'),'id' => $this->input->post('id')], $this->input->post());
        redirect('stok_keluar');
    }
    function create() {
        $_POST['user'] = $this->session->userdata('username');
        $this->crud->create('stok_keluar', $this->input->post());
        redirect('stok_keluar');
    }

    function delete($id,$waktu) {
        $this->crud->delete('stok_keluar', ['waktu' => $waktu,'id' => $id]);
        redirect('stok_keluar');
    }

}
