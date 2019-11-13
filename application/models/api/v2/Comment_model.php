<?php
class Comment_model extends CI_Model {
    function __construct() {
        parent::__construct();
        // Metodos disponibles
        $this->load->helper('Util_helper');
        $this->load->model('api/v2/Deck_model');        
        $this->load->library('gravatar');
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
            
            // Se puede agregar una limitacion de tiempo para que el 
            // usuario no peuda agregar multiuples comentarios
            // hasta que pase cierto tiempo

            $this->db->insert("comments", $comment);

            // $this->Deck_model->show_deck($id);
            // Obtiene el objeto deck original que ya trae comentarios
            $response = $this->Deck_model->show_deck($comment['item_id']);
            
            // Aqui comienza a iterar los comentarios buscando el usuario para generar el gravatar
            $comments = [];

            // Valida que tenga comentarios el deck para solicitar los gravatars
            if ($response['data']['deck']['comments'] != null && sizeof($response['data']['deck']['comments']) > 0) {
                // Si tiene comentarios, transforma el correo en un gravatar
                foreach ($response['data']['deck']['comments'] as $comment) {
                    $img = $this->gravatar->get($comment->user);
                    $comment->avatar = $img;
                    array_push($comments, $comment);
                }
            } 
            // Reasigna la variable con el gravatar incluido
            $response['data']['deck']['comments'] = $comments;
            return $response;
        }catch (Exception $e){
            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
        }
    }
    
}
