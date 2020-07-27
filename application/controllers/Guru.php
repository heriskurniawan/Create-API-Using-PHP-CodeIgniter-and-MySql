<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Guru extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan semua data guru
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $guru = $this->db->get('tbl_guru')->result();
        } else {
            $this->db->where('id', $id);
            $guru = $this->db->get('tbl_guru')->result();
        }
        $this->response($guru, 200);
    }

     //Mengirim atau menambah data guru baru
     function index_post() {
        $data = array(
                    'kd_guru'      => $this->post('kd_guru'),
                    'nama_guru'          => $this->post('nama_guru'),
                    'no_hp'    => $this->post('no_hp'),
                    'username'    => $this->post('username'),
                    'password'    => md5($this->post('password')),
                    'id_level'    => '2');
        $insert = $this->db->insert('tbl_guru', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
     //Memperbarui data guru yang sudah ada
     function index_put() {
        $id = $this->put('id');
        $data = array(
                    'id'            => $this->put('id'),
                    'kd_guru'       => $this->put('kd_guru'),
                    'nama_guru'          => $this->put('nama_guru'),
                    'no_hp'    => $this->put('no_hp'),
                    'username'    => $this->put('username'),
                    'password'    => md5($this->put('password')));
        $this->db->where('id', $id);
        $update = $this->db->update('tbl_guru', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    //Menghapus salah satu data guru
    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('tbl_guru');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
