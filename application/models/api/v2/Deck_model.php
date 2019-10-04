<?php
class Deck_model extends CI_Model {
    function __construct() {
        parent::__construct();
        // Metodos disponibles
        $this->load->helper('Util_helper');
    }

    public function mydecks($user_id){
        try{
            // Busca los decks del usuario
            $query = "SELECT  *  FROM decks  where  `user_id` = ".$user_id." order by `id` desc";

            $q = $this->db->query($query);
            $decks = [];
            foreach($q->result() as $deck){
                $deck = (array) $deck;
                $deck['hero1'] = getImage($deck['hero1']); 
                $deck['hero2'] = getImage($deck['hero2']); 
                $deck['hero3'] = getImage($deck['hero3']); 
                $deck['hero4'] = getImage($deck['hero4']); 
                $deck['hero5'] = getImage($deck['hero5']);
                array_push($decks, $deck);
            }
            
            $response['error']  = false;
            $response['data']['decks']    = $decks;
            
            return ($response);
        }catch (Exception $e){

            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
        }
    }

    public function decks_list(){
        try{
            $query = "SELECT  *  FROM decks where `status` = 1  order by `votes` desc";

            $q = $this->db->query($query);
            $decks = [];
            foreach($q->result() as $deck){
                $deck = (array) $deck;
                $deck['hero1'] = getImage($deck['hero1']); 
                $deck['hero2'] = getImage($deck['hero2']); 
                $deck['hero3'] = getImage($deck['hero3']); 
                $deck['hero4'] = getImage($deck['hero4']); 
                $deck['hero5'] = getImage($deck['hero5']);
                array_push($decks, $deck);
            }
            
            $response['error']  = false;
            $response['data']['decks']    = $decks;
            return $response;
        }catch (Exception $e){

            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
        }
    }

    public function show_deck($deck_id){
        try{
            $query = "SELECT  *  FROM decks where `id` = ".$deck_id."  limit 1";
            $q = $this->db->query($query);
            if ($q->num_rows() == 0) {
                throw new Exception("Deck doesnt exist");
            }
            $deck =  (array)$q->row();
            $deck = (array) $deck;
            $deck['hero1'] = getImage($deck['hero1']); 
            $deck['hero2'] = getImage($deck['hero2']); 
            $deck['hero3'] = getImage($deck['hero3']); 
            $deck['hero4'] = getImage($deck['hero4']); 
            $deck['hero5'] = getImage($deck['hero5']);
            $response['error']  = false;
            $response['data']['deck']    = $deck;
            return $response;
        }catch (Exception $e){
            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
        }
    }
    
    public function create_deck($deck){
        try{
            $this->db->insert("decks", $deck);
            $response['error']  = false;
            $response['data']['deck']    = $deck;
            $response['msg']   = "Added";
            return $response;
        }catch (Exception $e){
            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
        }
    }
    
}