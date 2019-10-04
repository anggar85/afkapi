<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Deck extends CI_Controller {
    
    function __construct() {

        parent::__construct();
        $this->load->model('api/v2/Deck_model');        
    }

    public function mydecks($user_id)
	{
        try {
            // Regresa los decks del usuario 
            header('Content-Type: application/json');
            $response = $this->Deck_model->mydecks($user_id);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }
    public function decks_list()
	{
        try {
            header('Content-Type: application/json');
            $response = $this->Deck_model->decks_list();
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
