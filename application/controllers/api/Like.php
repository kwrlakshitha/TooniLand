<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use \Restserver\Libraries\REST_Controller;

class Like extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('LikeModel');
    }

    public function index_post()
    {
        $postID = $this->post('postID');
        $userID = $this->post('userID');

        $res = $this->LikeModel->insertLike($postID, $userID);
        $this->response([
            'status' => TRUE,
            'message' => 'Like recorded successfully',
            'res' => $res
        ], REST_Controller::HTTP_OK);
    }
}
