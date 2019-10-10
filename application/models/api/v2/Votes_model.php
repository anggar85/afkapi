<?php
class Votes_model extends CI_Model {
    function __construct() {
        parent::__construct();
        // Metodos disponibles
        $this->load->helper('Util_helper');
        // $this->load->library('gravatar');

    }

    public function listCommentsFor($section, $item_id){
        try{           
            // Busca todos los comentarios de 'cierta seccion' y cierto 'articulo, pind, deck'
            
            $query = "SELECT u.id as userId, c.* , u.email as `user` from comments as `c`
                        JOIN users as u on c.user = u.id WHERE c.item_id= ".$item_id." 
                        AND `section`='".$section."' order by `date` DESC";

            $q = $this->db->query($query);    
            $comments = [];
            foreach ($q->result() as $comment) {
                // $img = $this->gravatar->get($comment->user);
                // $comment->avatar = $img;
                array_push($comments, $comment);
            }
            return ($comments);
        }catch (Exception $e){
            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
        }
    }

    public function create_vote($vote, $section, $item_id){
        try{       
            // Valida si el usuario ya envio un voto a este item
            $this->db->where('section', $section);
            $this->db->where('item_id', $item_id);
            $this->db->where('user', $vote['user']);
            $q = $this->db->get('votes');

            if ($q->num_rows() == 1) {
                // Si existe, entonces se actualiza su voto
                $v = $q->row();
                $this->db->where('id', $v->id);
                $this->db->limit(1);
                $this->db->update("votes", $vote);
                $response['error']  = false;
            }else{
                // No ha votado por este item, entonces se inserta un nuevo voto
                $q = $this->db->insert('votes', $vote);
                $response['error']  = false;
            }
            // Ejecutara otro metodo que actualizara la columna individual de votacion en el deck, pin, etc
            $this->calculateVotes($vote['vote'], $section, $item_id);
            return ($response);
        }catch (Exception $e){
            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
        }
    }

    public function calculateVotes($vote, $section, $item_id){
        try{
            // Cada que se actualiza o emite un voto, se busca el item en su tabla y se actualiza el valor de votos
            // $votes = cantidad que se le dio, es del 1 al 5
            // $section = La secccion en la que se esta haciendo la votacion, tambien es el nombre de la tabla
            // $item_id = Es el id del row ya sea deck, pin, clan, etc
            // Busca todos los votos que tenga el item, los suma y los actualiza en el row del item
            $this->db->where("item_id", $item_id);
            $this->db->where("section", $section);
            $q = $this->db->get('votes');

            // Total de votaciones para este item en particular
            $votes_rows = $q->num_rows();
            $votes = 0;
            foreach ($q->result() as $v) {
                $votes = $votes + $v->vote;
            }

            // Cuando termina de sumar los votos y promediarlos, los ingresa en el item
            $newVotesValue = $votes / $votes_rows;
            $newVotesValue = sprintf('%0.1f', $newVotesValue);

            // Actualiza los votos en el item
            $this->db->where('id', $item_id);
            $this->db->limit(1);
            $this->db->update($section, ['votes' => $newVotesValue]);

            $response['error']  = false;
            return ($response);
        }catch (Exception $e){
            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
        }
    }

}