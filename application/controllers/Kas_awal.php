<?php

class Kas_awal extends CI_Controller {

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
        if (count($this->crud->read('kas_awal', ['tanggal' => date('Y-m-d')])) == 0) {
            $r0 = $this->crud->read('kas_akhir', ['tanggal<' => date('Y-m-d')], 'tanggal DESC'); // lihat tgl terakhir ada kas akhir
            if (count($r0) > 0) {
                $r1 = $this->crud->read('kas_akhir', ['tanggal' => $r0[0]['tanggal']]); // select yang tglnya paling akhir
                foreach ($r1 as $r) {
                    $this->crud->create('kas_awal', [
                        'tanggal' => date('Y-m-d'),
                        'id' => $r['id'],
                        'jumlah' => $r['akhir'],
                        'keterangan' => 'Dari kas akhir tgl: ' . $r['tanggal'],
                        'user' => $this->session->userdata('username')
                    ]);
                }
            } else {
                $r2 = $this->crud->read('ms_kas',null,'id');
                foreach($r2 as $r){
                    $this->crud->create('kas_awal', [
                        'tanggal' => date('Y-m-d'),
                        'id' => $r['id'],
                        'jumlah' => '0',
                        'user' => $this->session->userdata('username')
                    ]);
                }
            }
        }
        $this->load->view('template', [
            'content' => $this->load->view('kasawal_list', ['data' => $this->crud->read('kas_awal', ['tanggal' => date('Y-m-d')], 'id')], TRUE)
        ]);
    }

    function form() {
        $this->load->view('template', [
            'content' => $this->load->view('kasawal_form', ['kas' => $this->crud->read('ms_kas')], TRUE)
        ]);
    }

    function edit($id) {
        $this->load->view('template', [
            'content' => $this->load->view('kasawal_form', [
                'data' => $this->crud->find('kas_awal', ['tanggal' => date('Y-m-d'), 'id' => $id])[0],
                'kas' => $this->crud->read('ms_kas')
                    ], TRUE)
        ]);
    }

    function update() {
        $this->crud->update('kas_awal', ['tanggal' => date('Y-m-d'), 'id' => $this->input->post('id')], $this->input->post());
        redirect('kas_awal');
    }

    function create() {
        $_POST['user'] = $this->session->userdata('username');
        $this->crud->create('kas_awal', $this->input->post());
        redirect('kas_awal');
    }

    function delete($id) {
        $this->crud->delete('kas_awal', ['tanggal' => date('Y-m-d'), 'id' => $id]);
        redirect('kas_awal');
    }

}
