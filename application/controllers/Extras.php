<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Extras extends CI_Controller {
    
    function __construct() {

        parent::__construct();
        $this->load->model('Hero_model');
        $this->load->model('Extras_model');
        // Helpers
        $this->load->helper('Util_helper');
        
    }

    public function faq()
	{
        try {
            header('Content-Type: application/json');
            $response = $this->Extras_model->faq();
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }

    public function items_list()
	{
        try {
            header('Content-Type: application/json');
            $response = $this->Extras_model->items_list();
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }


    public function rol_definitions()
	{
        try {
            header('Content-Type: application/json');
            $response = $this->Extras_model->rol_definitions();
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }


    public function create_StrengthWeakness()
	{
        try {
            header('Content-Type: application/json');
            $data = json_decode(file_get_contents('php://input'), true);
            $data = $data['data']['strengthWeakness'];
            // var_dump($data);
            $response = $this->Extras_model->create_StrengthWeakness($data);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }

    public function contributors()
	{
        try {
            header('Content-Type: application/json');
            $response = $this->Extras_model->contributors();
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }


    public function dbBackup()
	{
        try {
            header('Content-Type: application/json');
            $response = $this->Extras_model->dbBackup();
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }


    

}
