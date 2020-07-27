<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Pesan extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan semua data guru
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
           
            $pesan = $this->db->get('view_all_messages')->result();
        } else {
            
            $this->db->where('id', $id);
            $pesan = $this->db->get('view_all_messages')->result();
        }
        $this->response($pesan, 200);
    }
}
