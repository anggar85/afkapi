<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

class Manifest extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Manifest_model');

        // Helpers
        $this->load->helper('Util_helper');
    }

    // TODO validar parametros y credenciales de quien puede entrar aqui

    public function list_all()
	{

        try {
            header('Content-Type: application/json');
            $response = $this->Manifest_model->list_all();
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }

    public function show()
	{
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $manifest = $data['data']["manifest"];
            header('Content-Type: application/json');
            $response = $this->Manifest_model->show($manifest);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }


    public function create()
	{
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $manifest = $data['data']["manifest"];
            header('Content-Type: application/json');
            $response = $this->Manifest_model->create($manifest);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }
    
    public function request_cancelation()
	{
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $manifest = $data['data']["manifest"];
            header('Content-Type: application/json');
            $response = $this->Manifest_model->request_cancelation($manifest);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }

    public function acept_cancelation()
	{
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $manifest = $data['data']["manifest"];
            header('Content-Type: application/json');
            $response = $this->Manifest_model->acept_cancelation($manifest);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }

    public function update()
	{
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $user = $data['data']["user"];
            header('Content-Type: application/json');
            $response = $this->Manifest_model->update($user);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }


    public function delete()
	{
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $user = $data['data']["user"];
            header('Content-Type: application/json');
            $response = $this->Manifest_model->delete($user);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }    

}