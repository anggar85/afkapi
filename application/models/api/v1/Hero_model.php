<?php
class Hero_model extends CI_Model {
    function __construct() {

        parent::__construct();
        
        // Metodos disponibles
        $this->load->helper('Util_helper');
        
    }

    // MOBILE

    public function list_all($table, $columna, $rarity, $classe, $race_name){
        try{
            $default_table = "tier_list_earlies";
            if (!isset($table) && $table != "") {
                $default_table = $table;
            }

            $default_column = "overall";
            if (!isset($columna) && $columna != "") {
                $default_column = $columna;
            }
            $queryExtra = "";
            $array = [$rarity, $classe, $race_name];

            // var_dump($array);
            for ($i=0; $i < sizeOf($array); $i++) { 
                if ($array[$i] != "All") {
                    switch ($i) {
                        case 0:
                        $queryExtra.=" and `rarity`= '".$rarity."' ";
                        break;
                        case 1:
                        $queryExtra.=" and `classe`= '".$classe."' ";
                        break;
                        case 2:
                        $queryExtra.=" and `race_name` = '".$race_name."'";
                        break;
                        default:
                            break;
                    }
                }
            }
            
            $query = "SELECT h.id, h.rarity, h.classe, h.race_name, t.overall, t.pve, t.pvp, t.lab, t.wrizz, t.soren, h.name, ".$columna." as section, h.id as idHero 
                        FROM
                            ".$table." AS t
                        JOIN
                            hero_details AS h 
                        ON h.name = t.hero_name where  h.status= 1 ".$queryExtra."  order by field(t.".$columna.", 'S+', 'S', 'A','B','C', 'D','E', 'F')  ASC";

            $q = $this->db->query($query);
            $heroes = [];
            foreach($q->result() as $hero){
                $hero = (array) $hero;
                array_push($heroes, addImages($hero));
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



    public function detail($id){

        try{
            $this->db->where("id", $id);
            $this->db->limit(1);
            $q = $this->db->get("hero_details");

            if ($q->num_rows() == 1) {
                # Encontro al heroe
                $heroe = (array) $q->row();

                # Busca los tiers data y los pinta de acuerdo a su valor
                $early  = $this->getTierData($heroe['name'], 1);
                $mid    = $this->getTierData($heroe['name'], 2);
                $late   = $this->getTierData($heroe['name'], 3);


                # Skills
                $skillsArray = [];
                $this->db->where("name", $heroe['name']);
                $skills =  $this->db->get("skills");

                $base = base_url()."assets/heroes/skills/";
                if ($skills->num_rows() != 0) {
                    $cont = 1;
                    foreach ($skills->result() as $sk) {
                        $sk = (array) $sk;
                        $singleSkill = [
                            'id'          => $sk['id'],
                            'skill'       => $sk['skill'],
                            'skillOrder'  => $sk['skillOrder'],
                            'desc'        => $sk['desc'],
                            'name'        => $sk['name'],
                            'lvlUpgrades' => $sk['lvlUpgrades'],
                            'skillIcon'   => $base.strtolower($heroe['name']).$cont.".png"
                        ];
                        array_push($skillsArray, $singleSkill);
                        $cont++;
                    }
                }


                # Strength & Weakness
                $strengthWeakness = $this->strengthWeakness($heroe['id']);


                
                # Arma toda la informacion para el heroe
                if ($heroe['synergy'] == null) {
                    $heroe['synergy'] = "";
                }
                if ($heroe['artifact'] == null) {
                    $heroe['artifact'] = "";
                }
                $heroe['early'] = $early;
                $heroe['mid']   = $mid;
                $heroe['late']  = $late;
                $heroe['race_name']  = $heroe['race_name'];
                $heroe['skills']  = $skillsArray;
                $icon = addImages($heroe);
                $heroe['smallImage']  = $icon['smallImage'];
                $heroe['strengths'] = $strengthWeakness['strength'];
                $heroe['weaknesses'] = $strengthWeakness['weakness'];

                $response['error']  = false;
                $response['data']['heroe']    = $heroe;
                
            }else{
                # No hay resultados
                $response['error']  = true;
                $response['id']  = $id;
                $response['msg']    = "Can't find the hero.";
            }

            return ($response);
        }catch (Exception $e){

            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);

        }
    }

    public function getTierData($name, $opc){
        $this->db->where("hero_name", $name);
        switch ($opc) {
            case 1:
            $data  = $this->db->get("tier_list_earlies");
            break;
            case 2:
            $data  = $this->db->get("tier_list_mids");
            break;
            case 3:
            $data  = $this->db->get("tier_list_lates");
            break;
            default:
            $data  = $this->db->get("tier_list_earlies");
            break;
        }
        
        if ($data->num_rows() == 1) {
            $data = (array) $data->row();
            $data = [
                "overall"   => colorRarity($data['overall']),
                "pvp"       => colorRarity($data['pvp']),
                "pve"       => colorRarity($data['pve']),
                "lab"       => colorRarity($data['lab']),
                "wrizz"     => colorRarity($data['wrizz']),
                "soren"     => colorRarity($data['soren'])
            ];                
        }else{
            $data = [
                "overall"   => "",
                "pvp"       => "",
                "pve"       => "",
                "lab"       => "",
                "wrizz"     => "",
                "soren"     => ""
            ];
        }
        return $data;
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