<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('validaRequest'))
{
    function validaRequest($req = '')
    {
        $error = false;
        if (!isset($req['data'])) {
            return $msg = 'Nodo data no encontrado';
        }
        if (!isset($req['data']['token'])) {
            return 'No se encontro el token';
        }
        if ($req['data']['token'] != MOBILE_TOKEN) {
            return 'El token es incorrecto';
        }
    }

    function validateStats($stats){
        if ($stats != null){
            $data = [
                'id' => (int)$stats->id,
                'atk' => (float)$stats->atk,
                'chc' => (float)$stats->chc,
                'chd' => (float)$stats->chd,
                'cp' => (float)$stats->cp,
                'dac' => (float)$stats->dac,
                'def' => (float)$stats->def,
                'eff' => (float)$stats->eff,
                'efr' => (float)$stats->efr,
                'hp' => (float)$stats->hp,
                'spd' => (float)$stats->spd,
            ];
        }else{
            $data  = [
                'id' => (int)$stats->id,
                'atk' => "",
                'chc' => "",
                'chd' => "",
                'cp' => "",
                'dac' => "",
                'def' => "",
                'eff' => "",
                'efr' => "",
                'hp' => "",
                'spd' => "",
            ];
        }
        return $data;
    }

    function requestValidation($REQUEST, $opcion){
        if (!isset($REQUEST['data'])) {
            return ('Nodo data no encontrado');
        }
        if (!isset($REQUEST['data']['token'])) {
            return ('No se encontro el token');
        }
        if ($REQUEST['data']['token'] != MOBILE_TOKEN) {
            return ('El token es incorrecto');
        }

        switch ($opcion){
            case 1:
                if (!isset($REQUEST['data']['event_id'])) {
                    return('No se recibio event_id');
                }
                if ($REQUEST['data']['event_id'] < 1) {
                    return('El event_id no es valido');
                }
                break;
            default:
                break;
        }
        return 1;
    }
}