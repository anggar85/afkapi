<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

class Users extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('User_model');

        // Helpers
        $this->load->helper('Util_helper');
    }

    // TODO validar parametros y credenciales de quien puede entrar aqui

    public function list_all()
	{

        try {
            header('Content-Type: application/json');
            $response = $this->User_model->list_all();
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }

    public function show_fb()
	{
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $user = $data['data']["user"];

            header('Content-Type: application/json');
            $response = $this->User_model->show_fb($_GET);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }

    
    public function show_profile($id = NULL)
	{
        try {
            $data = json_decode(file_get_contents('php://input'), true);

            header('Content-Type: application/json');
            $response = $this->User_model->show_profile($id);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }

    
    public function update_profile($id = NULL)
	{
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $profile = $data['data']["profile"];
            header('Content-Type: application/json');
            $response = $this->User_model->update_profile($profile, $id);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }

    
    public function show()
	{
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $user = $data['data']["user"];

            header('Content-Type: application/json');
            $response = $this->User_model->show($user);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }


    public function create_fb()
	{
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $user = $data['data']["user"];
            header('Content-Type: application/json');
            $res = $this->User_model->create_fb($user);
            $response['data'] = $res;
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }

    public function getFacebookImages()
    {
        try {
            header('Content-Type: application/json');
            $res = $this->User_model->getFacebookImages();
            $response['data'] = $res;
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }

}