<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AuthModel');
        $this->load->model('PostModel');
        $this->load->model('HashtagModel');
        $this->upload_path = "uploads/";
    }

    public function index(){
        $this->load->view('user/index');
        
    }
}