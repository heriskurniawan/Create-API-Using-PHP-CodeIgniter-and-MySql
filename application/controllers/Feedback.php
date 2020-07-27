<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Feedback extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan semua data
    function index_get()
    {
        $id = $this->get('id');
        if ($id == '') {
            $feedback = $this->db->get('tbl_feedback')->result();
        } else {
            $this->db->where('id', $id);
            $feedback = $this->db->get('tbl_siswa')->result();
        }
        $this->response($feedback, 200);
    }

    //Mengirim atau menambah data
    function index_post()
    {
        $data = array(
            'nama'        => $this->post('nama'),
            'email'       => $this->post('email'),
            'messages'    => $this->post('messages'));
        $insert = $this->db->insert('tbl_feedback', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    //Menghapus salah satu data
    function index_delete()
    {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('tbl_feedback');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
