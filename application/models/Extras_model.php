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


}