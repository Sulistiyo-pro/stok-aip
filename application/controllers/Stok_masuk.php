<?php

class Stok_masuk extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('username') == '') {
            redirect('login');
        }
    }

    function index() {
        $this->load->view('template', [
            'content' => $this->load->view('stokmasuk_list', ['data' => $this->crud->read('stok_masuk', ['tanggal' => date('Y-m-d')], 'id')], TRUE)
        ]);
    }
    function form() {
        $this->load->view('template', [
            'content' => $this->load->view('stokmasuk_form', ['stok' => $this->crud->read('ms_stok')], TRUE)
        ]);
    }
    function edit($id,$waktu) {
		if ($this->session->userdata('level') != 'admin') {
            echo 'Akses ditolak ...';
            exit();
        }
        $this->load->view('template', [
            'content' => $this->load->view('stokmasuk_form', [
                'data' => $this->crud->find('stok_masuk', ['waktu' => $waktu,'id' => $id])[0],
                'stok' => $this->crud->read('ms_stok')
                    ], TRUE)
        ]);
    }
    function update() {
		if ($this->session->userdata('level') != 'admin') {
            echo 'Akses ditolak ...';
            exit();
        }
        $this->crud->update('stok_masuk', ['waktu' => $this->input->post('waktu'),'id' => $this->input->post('id')], $this->input->post());
        redirect('stok_masuk');
    }
    function create() {
        $_POST['user'] = $this->session->userdata('username');
        $this->crud->create('stok_masuk', $this->input->post());
        redirect('stok_masuk');
    }

    function delete($id,$waktu) {
        $this->crud->delete('stok_masuk', ['waktu' => $waktu,'id' => $id]);
        redirect('stok_masuk');
    }

}
