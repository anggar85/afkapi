<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function addImages($hero){
    $milliseconds = round(microtime(true) * 1000);
    $img = base_url()."assets/heroes/icons/".$hero['name'].".jpg";
    // $img = base_url()."assets/heroes/icons/".$hero['name'].".jpg?t=".$milliseconds;
    $hero['smallImage'] = $img;
    return $hero;
}

function getImage($hero){
    $milliseconds = round(microtime(true) * 1000);
    $name = str_replace(" ", "_", $hero);
    $img = base_url()."assets/heroes/icons/".$name.".jpg";
    // $img = base_url()."assets/pins/".$name.".png?t=".$milliseconds;
    return $img;
}

function colorRarity($rarity){
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

function race_identify($race){
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



function selects($tier_value, $section){

    $tier = ["S+","S","A","B","C","D","E","F"];
    $a ='<select class="form-control" name="' . $section . '">';
    $a.= '<option value="0">Select Tier Value</option>';
    $tier_value = explode("<", explode(">", $tier_value)[1])[0];
    for ($x = 0; $x < sizeof($tier); $x++) {
        if ($tier_value == $tier[$x]) {
            $a.='<option value="' . $tier[$x] . '" selected="selected">' . $tier[$x] . '</option>';
        } else {
            $a.='<option value="' . $tier[$x] . '">' . $tier[$x] . '</option>';
        }
    }
    $a.='</select>';
    return $a;
    

}