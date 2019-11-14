<?php
class Deck_model extends CI_Model {
    function __construct() {
        parent::__construct();
        // Metodos disponibles
        $this->load->helper('Util_helper');
		$this->load->library('gravatar');

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

    public function decks_list($columna, $asc_desc){
        try{
            $query = "SELECT  d.*, u.id as userId, u.token as user_token, 
            (select count('id') from votes where item_id = d.id) as numero_votos  FROM decks as d 
            JOIN users as u
            ON u.id = d.user_id
            where d.status = 1 
            AND d.name != '' AND d.desc != ''
            AND d.hero1 != '' AND d.hero2 != '' AND d.hero3 != '' AND d.hero4 != '' AND d.hero5 != ''
             order by $columna $asc_desc";

            $q = $this->db->query($query);
            $decks = [];
            foreach($q->result() as $deck){
                $deck = (array) $deck;
                $deck['hero1'] = getImage($deck['hero1']); 
                $deck['hero2'] = getImage($deck['hero2']); 
                $deck['hero3'] = getImage($deck['hero3']); 
                $deck['hero4'] = getImage($deck['hero4']); 
                $deck['hero5'] = getImage($deck['hero5']);
                $deck['fb_image'] = getProfilePic($deck['user_token']);
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
            $query = "SELECT  *, 
            (select count('id') from votes where item_id = d.id) as numero_votos
              FROM decks as d where `id` = ".$deck_id."  limit 1";

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

            // Se agregan los comentarios disponibles
            $baseUrl = base_url('assets/images/users/user_');
            $query = 'SELECT u.id as userId, u.name as userName, c.* , u.email as `user`, 
            concat("'.$baseUrl.'" , u.id) as avatar
            from comments as `c`
                        JOIN users as u on c.user = u.id 
                        WHERE c.item_id= '.$deck['id'].' 
                        AND `section`="decks" order by `date` DESC';

            $q = $this->db->query($query);

			$deck['comments'] = $q->result();


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
            $this->db->where('id', $deck['user_id']);
            $this->db->limit(1);
            $x = $this->db->get('users');

            $deck['author'] = $x->row()->name;

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
