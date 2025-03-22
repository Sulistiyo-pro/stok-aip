<?php

class Kas extends CI_Controller {

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
            'content' => $this->load->view('kas_list', ['data' => $this->crud->read('ms_kas')], TRUE)
        ]);
    }

    function form() {
        $this->load->view('template', [
            'content' => $this->load->view('kas_form', ['kas' => $this->crud->read('ms_kas')], TRUE)
        ]);
    }

    function create() {
        $this->crud->create('ms_kas', $this->input->post());
        redirect('kas');
    }

    function edit($id) {
        $this->load->view('template', [
            'content' => $this->load->view('kas_form', [
                'data' => $this->crud->find('ms_kas', ['id' => $id])[0],
                'kas' => $this->crud->read('ms_kas')
                    ], TRUE)
        ]);
    }

    function update() {
        $this->crud->update('ms_kas', ['id' => $this->input->post('id')], $this->input->post());
        redirect('kas');
    }

    function delete($id) {
        $this->crud->delete('ms_kas', ['id' => $id]);
        redirect('kas');
    }

}
