<?php

class Kas_masuk extends CI_Controller {

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
        $this->load->view('template', [
            'content' => $this->load->view('kasmasuk_list', ['data' => $this->crud->read('kas_masuk', ['tanggal' => date('Y-m-d')], 'id')], TRUE)
        ]);
    }
    function form() {
        $this->load->view('template', [
            'content' => $this->load->view('kasmasuk_form', ['kas' => $this->crud->read('ms_kas')], TRUE)
        ]);
    }
    function edit($id,$waktu) {
        $this->load->view('template', [
            'content' => $this->load->view('kasmasuk_form', [
                'data' => $this->crud->find('kas_masuk', ['waktu' => $waktu,'id' => $id])[0],
                'kas' => $this->crud->read('ms_kas')
                    ], TRUE)
        ]);
    }
    function update() {
        $this->crud->update('kas_masuk', ['waktu' => $this->input->post('waktu'),'id' => $this->input->post('id')], $this->input->post());
        redirect('kas_masuk');
    }
    function create() {
        $_POST['user'] = $this->session->userdata('username');
        $this->crud->create('kas_masuk', $this->input->post());
        redirect('kas_masuk');
    }

    function delete($id,$waktu) {
        $this->crud->delete('kas_masuk', ['waktu' => $waktu,'id' => $id]);
        redirect('kas_masuk');
    }

}
