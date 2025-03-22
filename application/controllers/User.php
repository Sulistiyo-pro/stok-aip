<?php

class User extends CI_Controller {

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
            'content' => $this->load->view('user_list', ['data' => $this->crud->read('ms_user')], TRUE)
        ]);
    }

    function form() {
        $this->load->view('template', [
            'content' => $this->load->view('user_form', ['stok' => $this->crud->read('ms_stok')], TRUE)
        ]);
    }

    function create() {
        $_POST['password'] = md5($_POST['password']);
        $this->crud->create('ms_user', $this->input->post());
        redirect('user');
    }

    function edit($username) {
        $this->load->view('template', [
            'content' => $this->load->view('user_form', ['data' => $this->crud->find('ms_user', ['username' => $username])[0]], TRUE)
        ]);
    }

    function update() {
        if($_POST['password']==''){
            unset($_POST['password']);
        }else{
           $_POST['password'] = md5($_POST['password']); 
        }
        $this->crud->update('ms_user', ['username' => $this->input->post('username')], $this->input->post());
        redirect('user');
    }

    function delete($username) {
        $this->crud->delete('ms_user', ['username' => $username]);
        redirect('user');
    }

}
