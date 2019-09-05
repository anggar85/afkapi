<?php
class Extras_model extends CI_Model {

    public function contributors(){

        try {

            $contributors = $this->db->get("contributors");
            $response['error']          = false;
            $response['data']['contributors']    = $contributors->result();
            return $response;

        }catch (Exception $e){

            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return $response;
        }
    }

    public function faq(){

        try {

            $faq = $this->db->get("faq");
            $response['error']          = false;
            $response['data']['faq']    = $faq->result();
            return $response;

        }catch (Exception $e){

            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return $response;
        }
    }

    public function items_list(){

        try {

            $items_list = $this->db->get("items");
            $response['error']          = false;
            $response['data']['items']    = $items_list->result();
            return $response;

        }catch (Exception $e){

            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return $response;
        }
    }



    public function rol_definitions(){

        try {

            $rol_definitions = $this->db->get("rol_definition");
            $response['error']            = false;
            $response['data']['rol_definition']    = $rol_definitions->result();
            return $response;

        }catch (Exception $e){

            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return $response;
        }
    }



    public function add_suggestion($data){
        try {            
            // Busca el nombre del usuario que subio la sugerencia
            $this->db->where('token', $data['user_token']);
            $this->db->limit(1);
            $q = $this->db->get("users");

            // Hace validaciones para evitar campos vacios
            if ($q->num_rows() == 0) {
                throw new Exception("Can't find your user, sorry");
            }

            if ($data['hero_id'] == "" || $data['hero_id'] == 0) {
                throw new Exception("Hero id is empty");
            }

            if ($data['type'] == "" ) {
                throw new Exception("Type of suggestion is empty");
            }

            if ($data['suggestion'] == "" ) {
                throw new Exception("Suggestion is empty");
            }

            $user = $q->row();
            $user = (array) $user;

            // Parsea el type a int
            $type = 1;
            if ($data['type'] != "Positive") {
                $type = 2;
            }

            $d = [
                "hero_id"   => $data['hero_id'],
                "type"      => $type,
                "desc"      => $data['suggestion'],
                "autor"     => $user['name'],
                "status"    =>  0
            ];

            $this->db->insert('strengthWeakness', $d);

            $response['error']  = false;
            $response['data']['sugestion']   = $data;
            $response['data']['user']   = $user;
            return $response;

        }catch (Exception $e){

            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return $response;
        }
    }

    public function strengthWeakness($hero_id){
        $this->db->where("hero_id", $hero_id);
        $q =  $this->db->get("strengthWeakness");
        $strength = [];
        $weakness = [];
        foreach ($q->result() as $value) {
            if ($value->type == 1) {
                array_push($strength, $value);
            }else{
                array_push($weakness, $value);
            }
        }
        $data = [
            'strength' => $strength,
            'weakness' => $weakness
        ];
        return $data;
    }

    

}