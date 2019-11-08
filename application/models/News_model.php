<?php
class News_model extends CI_Model {

   

    public function list_news(){

        try {

			$news_list = $this->db->get("news");

			$news = [];
			foreach ($news_list->result() as $noticia){
				$noticia->image = base_url("assets/heroes/news/").$noticia->image;
				$news[] = $noticia;
			}

			$response['error']          = false;
			$response['data']['news']    = $news;
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
            $this->db->delete('news');
            
            $response['error']          = false;
            return $response;

        }catch (Exception $e){

            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return $response;
        }
    }


    public function save($imgName, $data){

        try {

            if ($data['desc'] == "") {
                throw new Exception("Description can't be empty");
            }

            $item = [
                'title' => $data['title'],
                'desc'  => $data['desc'],
                'image' => $imgName
            ];
            
            $this->db->insert("news", $item);
            $response['error']  = false;
            return $response;

        }catch (Exception $e){

            $response['error']  = true;
            $response['msg']    = $e->getMessage();
            return $response;
        }
    }




}
