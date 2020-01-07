<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Deck extends CI_Controller {
    
    function __construct() {

        parent::__construct();
        $this->load->model('api/v3/Deck_model');        
    }

    public function decks_list($columna = "id", $asc_desc = "desc")
	{
        try {
            header('Content-Type: application/json');
            $response = $this->Deck_model->decks_list($columna, $asc_desc);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }

    public function show_deck($id = NULL)
	{
        try {
            header('Content-Type: application/json');
            $response = $this->Deck_model->show_deck($id);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }

    public function create_deck()
	{
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $deck = $data['data']["deck"];

            header('Content-Type: application/json');
            $response = $this->Deck_model->create_deck($deck);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }



}
