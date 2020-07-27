<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class View_total_from extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data total siswa dengan nim 2020000100
    function index_get() {
        $from = $this->get('from');
        if ($from == '') {
            $this->db->order_by('date','ASC');
            $pesan = $this->db->get('tbl_pesan')->result();
        } else {
            $this->db->order_by('date','ASC');
            $this->db->where('from', $from);
            $pesan = $this->db->get('tbl_pesan')->result();
        }
        $this->response($pesan, 200);
       
      
    }
}