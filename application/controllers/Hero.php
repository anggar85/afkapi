<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Hero extends CI_Controller {
    
    function __construct() {

        parent::__construct();
        $this->load->model('Hero_model');
        // Helpers
        $this->load->helper('Util_helper');
        
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


    public function detail()
	{
        try {
            header('Content-Type: application/json');
            $data = json_decode(file_get_contents('php://input'), true);
            $hero_id = $data['data']['hero']['id'];
            $response = $this->Hero_model->detail($hero_id);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }



    public function update_hero()
	{
        try {
            header('Content-Type: application/json');
            // $data = json_decode(file_get_contents('php://input'), true);
            $data = $_POST;
            // $hero_id = $data['data']['hero']['id'];
            $response = $this->Hero_model->update_hero($data);
            echo json_encode($data);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }




}
