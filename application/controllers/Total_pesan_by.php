<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Total_pesan_by extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan bearapa total pesan untuk masing masing siswa by session login siswa
    function index_get() {
        $to = $this->get('to');
        
        if ($to == '') {
            $pesan = $this->db->get('tbl_pesan')->result();
        } else {
            // $this->db->where('to', $to);
            // $pesan = $this->db->get('tbl_pesan')->result();
            $this->db->select('*');
            $this->db->from('tbl_pesan');
            $this->db->where('to', $to);
            $pesan = $this->db->count_all_results();
           
        }
        $this->response($pesan, 200);

       
       
      
    }
}