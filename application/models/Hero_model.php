<?php
class Hero_model extends CI_Model {

    public function list_all(){
        try{
            // $this->db->where("status", 1);
            // $this->db->select("id, name");
            $query = "SELECT 
                            t.overall, t.pve, t.pvp, t.lab, t.wrizz, t.soren, h.name
                        FROM
                            tier_list_earlies AS t
                                JOIN
                            hero_details AS h ON t.hero_name = h.name WHERE h.status = 1";
            $q = $this->db->query($query);
            $heroes = [];
            foreach($q->result() as $hero){
                array_push($heroes, $hero);
            }

            $response['error']  = false;
            $response['data']['heroes']    = $heroes;
            
            return ($response);
        }catch (Exception $e){

            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);

        }
    }




    // Add data
    public function addImages($hero){
        
    }

    

}