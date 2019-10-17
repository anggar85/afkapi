<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Votes extends CI_Controller {
    
    function __construct() {

        parent::__construct();
        $this->load->model('api/v2/Votes_model');        
    }


    public function create_vote(){
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $vote = $data['data']["vote"];

            if ($vote['user'] == "") {
                throw new Exception("Empty user");
            }
            
            if ($vote['section'] == "") {
                throw new Exception("Empty section");
            }
            $section = $vote['section'];

            if ($vote['item_id'] == "") {
                throw new Exception("Empty item");
            }
            $item_id = $vote['item_id'];

            if ($vote['vote'] == "") {
                throw new Exception("Empty vote");
            }
                
            header('Content-Type: application/json');
            $response = $this->Votes_model->create_vote($vote, $section, $item_id);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }



}
