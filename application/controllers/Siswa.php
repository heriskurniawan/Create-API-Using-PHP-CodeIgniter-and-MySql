<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Siswa extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan semua data siswa
    function index_get() {
        $nim = $this->get('nim');
        if ($nim == '') {
            $siswa = $this->db->get('tbl_siswa')->result();
        } else {
            $this->db->where('nim', $nim);
            $siswa = $this->db->get('tbl_siswa')->result();
        }
        $this->response($siswa, 200);
    }

     //Mengirim atau menambah data siswa baru
     function index_post() {
        $data = array(
                    'nim'      => $this->post('nim'),
                    'nama'          => $this->post('nama'),
                    'no_hp'    => $this->post('no_hp'),
                    'alamat'    => $this->post('alamat'),
                    'username'    => $this->post('username'),
                    'password'    => md5($this->post('password')),
                    'id_level'    => '3');
        $insert = $this->db->insert('tbl_siswa', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
     //Memperbarui data siswa yang sudah ada
     function index_put() {
        $nim = $this->put('nim');
        $data = array(
                    'nim'       => $this->put('nim'),
                    'nama'          => $this->put('nama'),
                    'no_hp'    => $this->put('no_hp'),
                    'alamat'    => $this->put('alamat'),
                    'username'    => $this->put('username'),
                    'password'    => md5($this->put('password')));
        $this->db->where('nim', $nim);
        $update = $this->db->update('tbl_siswa', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    //Menghapus salah satu data siswa
    function index_delete() {
        $nim = $this->delete('nim');
        $this->db->where('nim', $nim);
        $delete = $this->db->delete('tbl_siswa');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
