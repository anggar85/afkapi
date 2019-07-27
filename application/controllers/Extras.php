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




}
