<?php
class Hero_model extends CI_Model {
    function __construct() {

        parent::__construct();
        
        // Metodos disponibles
        $this->load->helper('Util_helper');
        
    }

    // MOBILE

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

            $query = "SELECT h.id, t.overall, t.pve, t.pvp, t.lab, t.wrizz, t.soren, h.name, ".$default_column." as section, h.id as idHero 
                        FROM
                            ".$default_table." AS t
                        JOIN
                            hero_details AS h 
                        ON h.name = t.hero_name where rarity!='Common' and h.status= 1 order by h.name asc";

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
                $heroe['early'] = $early;
                $heroe['mid']   = $mid;
                $heroe['late']  = $late;
                $heroe['race_name']  = race_identify($heroe['race']);
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





    // WEB INTERFACE

    public function list_all_interface(){
        try{
            $query = "SELECT * FROM
                            hero_details where rarity!='Common' order by name asc";
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

    public function update_hero_basic_info($data){
        try {
            // Valida si los campos estan vacios o no son validos
            if ($data['name'] == "") {
                throw new Exception("Name can't be empty");
            }
            if ($data['classe'] == "") {
                throw new Exception("Class can't be empty");
            }
            if ($data['type'] == "") {
                throw new Exception("Type can't be empty");
            }
            if ($data['rarity'] == "") {
                throw new Exception("Rarity can't be empty");
            }
            
            $d['group'] = $data['group'];
            $d['type']  = $data['type'];
            $d['desc']  = $data['desc'];
            $d['race_name'] = $data['race_name'];
            $d['role'] = $data['role'];
            if (isset($data['synergy']) && $data['synergy'] != "") {
                $d['synergy'] = implode(",", $data['synergy']);
            }
            $d['position'] = $data['position'];
            if (isset($data['artifact']) && $data['artifact'] != "") {
                $d['artifact'] = implode(",", $data['artifact']);
            }
            $d['union'] = $data['union'];
            $d['classe'] = $data['classe'];
            $d['introduction'] = $data['introduction'];
            $d['lore'] = $data['lore'];
            $d['status'] = $data['status'];
            
            $this->db->where('id', $data['id']);
            $this->db->update('hero_details', $d);

            $response['error']  = false;
            $response['msg']   = "Hero Updated!";
            return ($response);

        } catch (Exception $e) {
            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
        }
    }

    public function update_skill($id, $data){
        try {
            $this->db->where("id", $id);
            $this->db->limit(1);
            $q = $this->db->get("skills");
            if ($q->num_rows() > 0) {
                $skill = [
                    'skill'       => $data['skill'],
                    'skillOrder'  => $data['skillOrder'],
                    'desc'        => $data['desc'],
                    'lvlUpgrades' => $data['lvlUpgrades']
                ];

                $this->db->where("id", $id);
                $this->db->limit(1);
                $this->db->update("skills", $skill);
                
                $response['error']  = false;
                $response['msg']   = "Skill Updated!";

            } else {
                throw new Exception("Can't find skill");
            }
                        
        return ($response);
        } catch (Exception $e) {
            $response['error']  = false;
            $response['msg']   = $e->getMessage();
        }
        
    }


    public function update_tier_data($table, $name, $data){
        try {
            $this->db->where("hero_name", $name);
            $this->db->limit(1);
            $q = $this->db->get($table);
            if ($q->num_rows() > 0) {
                $id =  $q->row()->id;
                $info = [
                    "overall"   => $data['overall'],
                    "pvp"       => $data['pvp'],
                    "pve"       => $data['pve'],
                    "lab"       => $data['lab'],
                    "wrizz"     => $data['wrizz'],
                    "soren"     => $data['soren']
                ];    

                $this->db->where("id", $id);
                $this->db->limit(1);
                $this->db->update($table, $info);
                
                $response['error']  = false;
                $response['msg']   = "Tier Data Updated!";

            } else {
                throw new Exception("Can't find Tier Data");
            }
                        
        return ($response);
        } catch (Exception $e) {
            $response['error']  = false;
            $response['msg']   = $e->getMessage();
        }
        
    }

    // public function updateTierData($data)
    // {
    //     try {
    //         $name = $data['heroName'];
    //         $table = $data['gameLevel'];

    //         unset($data['gameLevel']);
    //         unset($data['heroName']);
    //         unset($data['token']);
            
    //         $this->db->where('hero_name', $name);
    //         $this->db->limit(1);
    //         $this->db->update($table, $data);

    //         $response['error']  = false;
    //         $response['msg']   = "Tier Data Updated!";
    //         $response['msge2']   = $data;
    //         return $response;
    //     } catch (Exception $e) {
    //         $response['error']  = true;
    //         $response['msg']   = $e->getMessage();
    //         return $response;
    //     }
    // }

    public function strengthweakenes_delete($id){
        try {
            $this->db->where('id', $id);
            
            $this->db->limit(1);
            
            $this->db->delete("strengthWeakness");

            $response['error']  = false;
            $response['msg']   = "Data deleted!";
            return $response;
        } catch (Exception $e) {
            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return $response;
        }
    }

    public function create_strength_weakness($data){
        try {
            
            $single = [
                "hero_id" => $data['id'],
                "type" => $data['type'],
                "desc" => $data['desc'],
                "autor" => 'AFK-Arena Guide',
            ];

            $title = "Weakness";
            if ($data['type'] == 1) {
                $title = "Strength";
            }

            $this->db->insert('strengthWeakness', $single);
            
            $response['error']  = false;
            $response['msg']   = $title." created!";
            $response['msge2']   = $data;
            return $response;
        } catch (Exception $e) {
            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return $response;
        }
    }

    
    // TOOLS



    // public function edit($id){

    //     try {
    //         $this->db->where('id', $id);
    //         $this->db->limit(1);
    //         $list = $this->db->get("hero_details");
    //         $response['error']          = false;
    //         $response['data']['heroes']    = $list->row();
    //         return $response;

    //     }catch (Exception $e){

    //         $response['error']  = true;
    //         $response['msg']   = $e->getMessage();
    //         return $response;
    //     }
    // }
}