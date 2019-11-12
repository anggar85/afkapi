<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Comments extends CI_Controller {
    
    function __construct() {

        parent::__construct();
        $this->load->model('api/v2/Comment_model');        
    }

    public function create_comment()
	{
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $comment = $data['data']["comment"];

            header('Content-Type: application/json');
            $response = $this->Comment_model->create_comment($comment);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }



}
