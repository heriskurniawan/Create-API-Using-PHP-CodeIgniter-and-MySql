<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Semua_pesan extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan semua data guru
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $pesan = $this->db->get('tbl_pesan')->result();
        } else {
           
            $this->db->where('id', $id);
            $pesan = $this->db->get('tbl_pesan')->result();
        }
        $this->response($pesan, 200);
    }

     //Mengirim atau menambah data pesan
     function index_post() {
        $data = array(
                    'date'        => $this->post('date'),
                    'from'        => $this->post('from'),
                    'to'          => $this->post('to'),
                    'messages'    => $this->post('messages'));
        $insert = $this->db->insert('tbl_pesan', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Menghapus salah satu data pesan
    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('tbl_pesan');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
