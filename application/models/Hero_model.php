<?php
class Hero_model extends CI_Model {

    public function list_all($table = "tier_list_earlies", $columna = "overall"){
        try{

            $default_table = "tier_list_earlies";
            if (!isset($table) && $table != "") {
                $default_table = $table;
            }

            $default_column = "overall";
            if (!isset($columna) && $columna != "") {
                $default_column = $columna;
            }


            $query = "SELECT t.overall, t.pve, t.pvp, t.lab, t.wrizz, t.soren, h.name, ".$default_column." as sectionColumn, h.id as idHero 
                        FROM
                            ".$default_table." AS t
                        JOIN
                            hero_details AS h 
                        ON h.name = t.hero_name where rarity!='Common' and h.status= 1 order by h.name asc";

            $q = $this->db->query($query);
            $heroes = [];
            foreach($q->result() as $hero){
                $hero = (array) $hero;
                array_push($heroes, $this->addImages($hero));
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
        $img = "https://www.mxl-apps.com/afk/heroes/icons/".$hero['name'].".jpg";
        $hero['icon'] = $img;
        return $hero;

    }

    

}