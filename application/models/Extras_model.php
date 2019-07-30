<?php
class Extras_model extends CI_Model {

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



    public function create_StrengthWeakness($data){

        try {            
            $this->db->insert('strengthWeakness', $data);

            $data =  $this->strengthWeakness($data['hero_id']);

            $response['error']  = false;
            $response['data']['strengths']   = $data['strength'];
            $response['data']['weaknesses']   = $data['weakness'];
            $response['msg'] = "Awaiting for revision";
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