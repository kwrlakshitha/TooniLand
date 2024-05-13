<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use \Restserver\Libraries\REST_Controller;

class Comment extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CommentModel');
    }

    public function index_post()
    {
        $comment = $this->post('comment');
        $postID = $this->post('postID');
        $userID = $this->post('userID');

        $this->CommentModel->insertComment($comment, $postID, $userID);
        $this->response([
            'status' => TRUE,
            'message' => 'Comment added successfully'
        ], REST_Controller::HTTP_OK);
    }

    public function index_get()
    {
        $id = $this->uri->segment(3);
        if ($id === null) {
            $comments = "Something went wrong. Unable to identify post!";
            $this->response([
                'status' => FALSE,
                'message' => $comments
            ], REST_Controller::HTTP_NOT_FOUND);
        } else {
            $comments = $this->CommentModel->getComment($id);
            if ($comments) {
                $this->response([
                    'status' => TRUE,
                    'message' => 'Comments found!',
                    'data' => $comments
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'No comments yet!',
                    'data' => [$comments]
                ], REST_Controller::HTTP_OK);
            }
        }
    }

    public function index_delete()
    {
        $id = $this->uri->segment(3);
        if ($id === null) {
            $this->response([
                'status' => FALSE,
                'message' => 'Unidentified comment!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->CommentModel->deleteComment($id) > 0) {
                $this->response([
                    'status' => TRUE,
                    'id' => $id,
                    'message' => 'Comment deleted.'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Comment not found!'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }
}
