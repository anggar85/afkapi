<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Hero extends CI_Controller {
    
    function __construct() {

        parent::__construct();
        $this->load->model('api/v2/Hero_model');        
    }

    public function list_all()
	{
        try {
            header('Content-Type: application/json');

            $tier = $_GET['gameLevel'];
            $section = $_GET['section'];
            $rarity = $_GET['rarity'];
            $classe = $_GET['classe'];
            $race_name = $_GET['race_name'];

            $response = $this->Hero_model->list_all($tier, $section, $rarity, $classe, $race_name);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }

    public function list_advanced()
	{
        try {
            header('Content-Type: application/json');

            $data = json_decode(file_get_contents('php://input'), true);
            $filters = $data['data']["list"];

            $response = $this->Hero_model->list_advanced($filters);
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
