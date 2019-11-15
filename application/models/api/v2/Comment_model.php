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
                if ($diff_mins == 0 && $comment['item_id'] == $c->item_id) {
                    throw new Exception("Wait 1 minute to post another comment");
                }
            }
            // Como si paso las validaciones, inserta el comentario
            $this->db->insert("comments", $comment);

            // Decide que tipo de objeto va a regresar al cliente dependiendo de la seccion
            if ($comment['section'] == 'decks') {
                # DECKS
                // Obtiene el objeto deck original que ya trae comentarios
                $response = $this->Deck_model->show_deck($comment['item_id']);
                return $response;
            } else {
                # DETALLE DE HEROE
                // aqui se buscaran todos los comentarios de detalle de heroe de el hero seleccionado
                // Se agregan los comentarios disponibles
                $baseUrl = base_url('assets/images/users/user_');
                $query = 'SELECT u.id as userId, u.name as userName, c.* , u.email as `user`, 
                concat("'.$baseUrl.'" , u.id, ".jpg") as avatar
                from comments as `c`
                            JOIN users as u on c.user = u.id 
                            WHERE c.item_id= '.$comment['item_id'].' 
                            AND `section`="hero_detail" order by `date` DESC';

                $q = $this->db->query($query);

                $response['data']['error']      = false;
                $response['data']['comments']   = $q->result();
                return ($response);
            }
            
            
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
