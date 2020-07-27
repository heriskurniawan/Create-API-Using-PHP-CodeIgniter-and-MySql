<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Content extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan semua data siswa
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $content = $this->db->get('tbl_content')->result();
        } else {
            $this->db->where('id', $id);
            $content = $this->db->get('tbl_content')->result();
        }
        $this->response($content, 200);
    }

     //Mengirim atau menambah data content baru
     function index_post() {
        $data = array(
                    'judul'    => $this->post('judul'),
                    'desc1'    => $this->post('desc1'),
                    'foto1'    => $this->post('foto1'));
        $insert = $this->db->insert('tbl_content', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
      //Memperbarui data siswa yang sudah ada
      function index_put() {
        $id = $this->put('id');
        $data = array(
                    'id'       => $this->put('id'),
                    'judul'    => $this->post('judul'),
                    'desc1'    => $this->post('desc1'),
                    'foto1'    => $this->post('foto1'));
        $this->db->where('id', $id);
        $update = $this->db->update('tbl_content', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
  
    //Menghapus salah satu data content
    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('tbl_content');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
