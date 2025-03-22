<?php

class Kas_mutasi extends CI_Controller {

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
            'content' => $this->load->view('kasmutasi_list', ['data' => $this->crud->read('kas_mutasi', ['tanggal' => date('Y-m-d')], 'waktu')], TRUE)
        ]);
    }

    function form() {
        $this->load->view('template', [
            'content' => $this->load->view('kasmutasi_form', ['kas' => $this->crud->read('ms_kas')], TRUE)
        ]);
    }

    function edit($waktu) {
        $this->load->view('template', [
            'content' => $this->load->view('kasmutasi_form', [
                'data' => $this->crud->find('kas_mutasi', ['waktu' => $waktu])[0],
                'kas' => $this->crud->read('ms_kas')
                    ], TRUE)
        ]);
    }

    function update() {
        $this->crud->update('kas_mutasi', ['waktu' => $this->input->post('waktu')], $this->input->post());
        redirect('kas_mutasi');
    }

    function create() {
        if ($this->input->post('kas_sumber') == $this->input->post('kas_tujuan')) {
            echo 'Kas sumber dan tujuan tidak boleh sama<br /><br />';
            echo '<a href="'.site_url().'/kas_mutasi">Kembali</a>';
        } else {
            $_POST['user'] = $this->session->userdata('username');
            $this->crud->create('kas_mutasi', $this->input->post());
            $this->crud->create('kas_keluar', [
                'tanggal' => $this->input->post('tanggal'),
                'id' => $this->input->post('kas_sumber'),
                'jumlah' => $this->input->post('jumlah'),
                'keterangan' => 'Mutasi ke '.get_info_kas($this->input->post('kas_tujuan'))['nama'],
                'user' => $this->session->userdata('username'),
                'waktu' => $this->input->post('waktu')
            ]);
            $this->crud->create('kas_masuk', [
                'tanggal' => $this->input->post('tanggal'),
                'id' => $this->input->post('kas_tujuan'),
                'jumlah' => $this->input->post('jumlah'),
                'keterangan' => 'Mutasi dari '.get_info_kas($this->input->post('kas_sumber'))['nama'],
                'user' => $this->session->userdata('username'),
                'waktu' => $this->input->post('waktu')
            ]);
            redirect('kas_mutasi');
        }
    }

    function delete($waktu) {
        $this->crud->delete('kas_mutasi', ['waktu' => $waktu]);
        redirect('kas_mutasi');
    }

}
