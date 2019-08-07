<?php
class Skills_model extends CI_Model {


    public function show($id){
        $this->db->where('id', $id);
        $this->db->limit(1);
        $q = $this->db->get('skills');
        return ($r->row());
    }




}