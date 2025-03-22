<?php

class Menu extends CI_Controller {

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
            'content' => $this->load->view('menu_list', ['data' => $this->crud->read('ms_menu')], TRUE)
        ]);
    }

    function form() {
        $this->load->view('template', [
            'content' => $this->load->view('menu_form', ['stok' => $this->crud->read('ms_stok')], TRUE)
        ]);
    }

    function create() {
        $this->crud->create('ms_menu', $this->input->post());
        redirect('menu');
    }

    function edit($id) {
        $this->load->view('template', [
            'content' => $this->load->view('menu_form', [
                'data' => $this->crud->find('ms_menu', ['id' => $id])[0],
                'stok' => $this->crud->read('ms_stok')
                    ], TRUE)
        ]);
    }

    function update() {
        $this->crud->update('ms_menu', ['id' => $this->input->post('id')], $this->input->post());
        redirect('menu');
    }

    function delete($id) {
        $this->crud->delete('ms_menu', ['id' => $id]);
        redirect('menu');
    }

}
