<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use \Restserver\Libraries\REST_Controller;

class Hashtags extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('HashtagModel');
        $this->load->model('PostModel');
        $this->load->model('CommentModel');
    }

    public function index_get()
    {
        $hashtag = $this->uri->segment(3);
        if ($hashtag === null) {
            $posts = $this->PostModel->getPosts();
        } else {
            $posts = $this->PostModel->getPostByTags($hashtag);
        }
        if ($posts) {
            $this->response([
                'status' => TRUE,
                'data' => $posts
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'No posts yet!'
            ], REST_Controller::HTTP_NO_CONTENT);
        }

    }
}