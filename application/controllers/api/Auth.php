<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use \Restserver\Libraries\REST_Controller;

class Auth extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AuthModel');
        $this->upload_path = "uploads/profiles/";

    }

    // Register User & Login User
    public function login_post()
    {
        $username = $this->post('userName');
        $email = $this->post('email');
        $password = $this->post('password');
        $count = $this->AuthModel->verifyUser($username, $email);

        if ($username && $email && $password) {
            if ($count > 0) {
                echo 'This User Already Exists';
            } else {
                $this->AuthModel->registerUser($username, $email, $password);
                $this->response([
                    'status' => TRUE,
                    'message' => 'User created successfully'
                ], REST_Controller::HTTP_OK);
            }
        } else {
            $login = $this->AuthModel->loginUser($username, $password);
            if ($login) {
                $jwt = new JWT();
                $key = getenv('JWT_SECRET');
                $iat = time(); // current timestamp value
                $exp = $iat + 3600;

                $payload = array(
                    "iss" => "Issuer of the JWT",
                    "aud" => "Audience that the JWT",
                    "sub" => "Subject of the JWT",
                    "iat" => $iat, //Time the JWT issued at
                    "exp" => $exp, // Expiration time of token
                    "username" => $login->userName,
                    "email" => $login->email,
                    "userID" => $login->userID
                );

                $token = $jwt->encode($payload, $key, 'HS256');
                // $decoded = $jwt->decode($token, $key, 'HS256');
                
                
                $this->response([
                    'status' => TRUE,
                    'message' => 'User logged in successfully',
                    "token" => $token,
                    "userID" => $login->userID,
                    "username" => $login->userName,
                    "userDescription" => $login->userDescription,
                    "userAddress" => $login->userAddress,
                    "userTelNo" => $login->userTelNo,
                    "userFirstName" => $login->userFirstName,
                    "userLastName" => $login->userLastName,
                    "profileImage" => $login->profileImage
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Invalid username or password'
                ], REST_Controller::HTTP_UNAUTHORIZED);
            }
        }
    }

    // update user profile
    public function updateProfile_post()
    {
        $userID = $this->post('userID');
        $username = $this->post('userName');
        $fName = $this->post('fName') ? $this->post('fName') : NULL;
        $lName = $this->post('lName') ? $this->post('lName') : NULL;
        $telNum = $this->post('telNum') ? $this->post('telNum') : NULL;
        $uAddress = $this->post('uAddress') ? $this->post('uAddress') : NULL;
        $uDesc = $this->post('uDesc') ? $this->post('uDesc') : NULL;
        $profileImg = $this->post('profileImg');
        
        if (!isset($userID)) {
            $this->response([
                'status' => FALSE,
                'message' => 'User ID is required'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
            $config['upload_path'] = './uploads/profiles/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = TRUE;
            $config['maintain_ratio'] = TRUE;

            $this->load->library('upload', $config);


            if (!$this->upload->do_upload('profileImg')) {
                $response = $this->AuthModel->updateProfile($userID, $username, $fName, $lName, $telNum, $uAddress, $uDesc, NULL);
                if ($response) {
                    $this->response([
                        'data' => $response,
                        'status' => TRUE,
                        'message' => 'User profile updated successfully'
                    ], REST_Controller::HTTP_OK);
                } else {
                    $this->response([
                        'status' => FALSE,
                        'message' => 'User profile update failed'
                    ], REST_Controller::HTTP_BAD_REQUEST);
                }
            } else {
                $data = array('upload_data' => $this->upload->data());
                $profileImg = $data['upload_data']['file_name'];

                $source_img_path = $this->upload_path . $data['upload_data']['file_name'];
                $config['image_library'] = 'gd2';
                $config['source_image'] = $source_img_path;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 100;
                $config['height'] = 100;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                    
                $response = $this->AuthModel->updateProfile($userID, $username, $fName, $lName, $telNum, $uAddress, $uDesc, $profileImg);
                if ($response) {
                    $this->response([
                        'data' => $response,
                        'status' => TRUE,
                        'message' => 'User profile updated successfully'
                    ], REST_Controller::HTTP_OK);
                } else {
                    $this->response([
                        'status' => FALSE,
                        'message' => 'User profile update failed'
                    ], REST_Controller::HTTP_BAD_REQUEST);
                }
            }
    
        }
    }
}
