<?php
class Comment_model extends CI_Model {
    function __construct() {
        parent::__construct();
        // Metodos disponibles
        $this->load->helper('Util_helper');
        $this->load->model('api/v2/Deck_model');        

    }

    
    public function create_comment($comment){
        try{
            // Valida que existan los campos obligatorios
            if ($comment['comment'] == "") 
            throw new Exception("Comment can't be empty");
        

            if ($comment['item_id'] == "") 
                throw new Exception("Item can't be empty");
            

            if ($comment['section'] == "") 
                throw new Exception("Section can't be empty");
        

            if ($comment['user'] == "") 
                throw new Exception("User can't be empty");
            

            $this->db->insert("comments", $comment);


            // Se puede agregar una limitacion de tiempo para que el 
            // usuario no peuda agregar multiuples comentarios
            // hasta que pase cierto tiempo


            // $this->Deck_model->show_deck($id);
            $deck = $this->Deck_model->show_deck($comment['item_id']);
            
            $deck = $deck['data']['deck'];

            $response['error']  = false;
            $response['data']['deck']    = $deck;
            $response['msg']   = "Comment Added";
            return $response;
        }catch (Exception $e){
            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
        }
    }
    
}