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

                $base = "https://www.mxl-apps.com/afk/heroes/skills/";
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
                
                # Arma toda la informacion para el heroe
                $heroe['early'] = $early;
                $heroe['mid']   = $mid;
                $heroe['late']  = $late;
                $heroe['race_name']  = $this->race_identify($heroe['race']);
                $heroe['skills']  = $skillsArray;
                $icon = $this->addImages($heroe);
                $heroe['smallImage']  = $icon['smallImage'];

                $response['error']  = false;
                $response['data']['heroe']    = $heroe;
                
            }else{
                # No hay resultados
                $response['error']  = false;
                $response['msg']    = "Can't find the hero.";
            }

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
        $hero['smallImage'] = $img;
        return $hero;

    }

    public function colorRarity($rarity){
        switch($rarity){
            case "S+":
                return '<font color="#a64d79">'.$rarity.'</font>';        
            case "S":
                return '<font color="#674ea7">'.$rarity.'</font>';
            case "A":
                return '<font color="#3c78d8">'.$rarity.'</font>';
            case "B":
                return '<font color="#6aa84f">'.$rarity.'</font>';
            case "C":
                return '<font color="#f1c232">'.$rarity.'</font>';
            case "D":
                return '<font color="#b45f06">'.$rarity.'</font>';
            case "E":
                return '<font color="#5b0f22">'.$rarity.'</font>';
            case "F":
                return '<font color="#5b0f00">'.$rarity.'</font>';
            default:
                return "";
        }
    }

    public function race_identify($race){
        switch ($race) {
            case 1:
                return "Lightbearer";
            case 2:
                return "Mauler";
            case 3:
                return "Wilder";
            case 4:
                return "Graveborn";
            case 5:
                return "Celestial";
            case 6:
                return "Hypogean";
            default:
                return "";
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
                "overall"   => $this->colorRarity($data['overall']),
                "pvp"       => $this->colorRarity($data['pvp']),
                "pve"       => $this->colorRarity($data['pve']),
                "lab"       => $this->colorRarity($data['lab']),
                "wrizz"     => $this->colorRarity($data['wrizz']),
                "soren"     => $this->colorRarity($data['soren'])
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

}