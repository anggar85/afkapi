<?php
class Items_model extends CI_Model {

   

    public function list(){

        try {
            
            $this->db->order_by('id', 'desc');
            
            $list = $this->db->get("items");
            $response['error']          = false;
            $response['data']['items']    = $list->result();
            return $response;

        }catch (Exception $e){

            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return $response;
        }
    }


    public function edit($id){

        try {
            
            $this->db->where('id', $id);
            $this->db->limit(1);
            $list = $this->db->get("items");
            $response['error']          = false;
            $response['data']['item']    = $list->row();
            return $response;

        }catch (Exception $e){

            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return $response;
        }
    }

    public function delete($id){

        try {
            
            $this->db->where('id', $id);
            $this->db->limit(1);
            $this->db->delete('items');
            
            $response['error']          = false;
            return $response;

        }catch (Exception $e){

            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return $response;
        }
    }


    public function update($imgName, $data){

        try {

            if ($data['title'] == "") {
                throw new Exception("Title can't be empty");
            }

            if ($data['desc'] == "") {
                throw new Exception("Description can't be empty");
            }

            if ($imgName != "") {
                $item = [
                    'title' => $data['title'],
                    'desc'  => $data['desc'],
                    'image' => base_url()."assets/heroes/items/".$imgName
                ];
            } else {
                $item = [
                    'title' => $data['title'],
                    'desc'  => $data['desc'],
                ];

            }
            
            $this->db->where('id', $data['id']);
            $this->db->update("items", $item);
            $response['error']  = false;
            return $response;

        }catch (Exception $e){

            $response['error']  = true;
            $response['msg']    = $e->getMessage();
            return $response;
        }
    }


    public function save($imgName, $data){

        try {

            if ($data['title'] == "") {
                throw new Exception("Title can't be empty");
            }

            if ($data['desc'] == "") {
                throw new Exception("Description can't be empty");
            }

            $item = [
                'title' => $data['title'],
                'desc'  => $data['desc'],
                'image' => base_url()."assets/heroes/items/".$imgName
            ];
            
            $this->db->insert("items", $item);
            $response['error']  = false;
            return $response;

        }catch (Exception $e){

            $response['error']  = true;
            $response['msg']    = $e->getMessage();
            return $response;
        }
    }




}