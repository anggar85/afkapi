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
			// Busca ultimo comentario agregado del usuario
			$this->db->where('user', $comment['user']);
            $this->db->limit(1);
            $this->db->order_by('id', 'desc');
			$q = $this->db->get('comments');
			if ($q->num_rows() > 0){
				// Tiene comentarios, se validara si ya puede publicar otro comentario
				$now = date("Y-m-d H:m:s");
                $c = $q->result()[0];
                $diff_mins = $this->alihan_diff_dates($c->date, "minutes");
                if ($diff_mins == 0) {
                    throw new Exception("Wait 1 minute to post another comment");
                }
			}

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
            $response['data']['error']  = true;
            $response['data']['msg']   = $e->getMessage();
            return ($response);
        }
    }

    public function alihan_diff_dates($date = null, $diff = "minutes") {
        $start_date = new DateTime($date);
        $since_start = $start_date->diff(new DateTime( date('Y-m-d H:i:s') )); // date now
        // print_r($since_start);
        switch ($diff) {
           case 'seconds':
               return $since_start->s;
               break;
           case 'minutes':
               return $since_start->i;
               break;
           case 'hours':
               return $since_start->h;
               break;
           case 'days':
               return $since_start->d;
               break;      
           default:
               # code...
               break;
        }
       }
    
}
