<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Custom404Page extends CI_Controller
{
    public function index(){
        $this->output->set_status_header('404');

        // Make sure you actually have some view file named 404.php
        $this->load->view('404');
    }
}