<?php

class Stok extends CI_Controller {

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
            'content' => $this->load->view('stok_list', ['data' => $this->crud->read('ms_stok')], TRUE)
        ]);
    }

    function form() {
        $this->load->view('template', [
            'content' => $this->load->view('stok_form', ['stok' => $this->crud->read('ms_stok')], TRUE)
        ]);
    }

    function create() {
        $_POST['id'] = trim($_POST['id']);
        $this->crud->create('ms_stok', $this->input->post());
        redirect('stok');
    }

    function edit($id) {
        $this->load->view('template', [
            'content' => $this->load->view('stok_form', [
                'data' => $this->crud->read('ms_stok', ['id' => $id])[0],
                'stok' => $this->crud->read('ms_stok')
                    ], TRUE)
        ]);
    }

    function update() {
        $this->crud->update('ms_stok', ['id' => $this->input->post('id')], $this->input->post());
        redirect('stok');
    }

    function delete($id) {
        $this->crud->delete('ms_stok', ['id' => $id]);
        redirect('stok');
    }

}
