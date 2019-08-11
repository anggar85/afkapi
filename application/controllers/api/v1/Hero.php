<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Hero extends CI_Controller {
    
    function __construct() {

        parent::__construct();
        $this->load->model('api/v1/Hero_model');        
    }

    public function list_all()
	{
        try {
            header('Content-Type: application/json');
            $response = $this->Hero_model->list_all();
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }


    public function detail($id = NULL)
	{
        try {
            header('Content-Type: application/json');
            $response = $this->Hero_model->detail($id);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }



}
