<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {


	public function index()
	{
       $data['data'] = $this->db->get('tbl_pesan')->result();
        $this->load->view('welcome_message',$data);
	}
}
