<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class News extends CI_Controller {
    
    function __construct() {

        parent::__construct();
        $this->load->model('News_model');

        $this->load->helper('form');

        // Helpers
        $this->load->helper('Util_helper');

        
        
    }


    public function list_news()
	{
        try {
            $response['data'] = $this->News_model->list_news();
            $this->load->view('dashboard/news/list', $response);
        } catch (Exception $e) {
            $this->load->view('dashboard/news/list', $response);
        }
    }


    public function new_news()
	{
        $this->load->view('dashboard/news/new');
    }

    public function edit($id = NULL)
	{
        try {
            $response['data'] = $this->News_model->edit($id);
            $this->load->view('dashboard/news/edit', $response);
        } catch (Exception $e) {
            $this->load->view('dashboard/news/list', $response);
        }
    }

    public function delete($id = NULL)
	{
        try {
            $response['data'] = $this->News_model->delete($id);
            if ($response['error']) {
                echo $response['msg'];
            } else {
                redirect('/news/list');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function save()
	{
        try {
            $data['upload_data']['file_name'] = "";
            // var_dump($_FILES['image']['name']);
            // return;
            if ($_FILES['image']['name'] != "") {
                // Upload the new image
                $config['upload_path']          = './assets/heroes/news';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 0;
                $config['remove_spaces']		= true;
                $config['encrypt_name']		    = true;
                $config['overwrite']		    = true;
    
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
    
                if ( ! $this->upload->do_upload('image'))
                {
                    $error = array('error' => $this->upload->display_errors());
                    return var_dump($this->upload->display_errors());
                }
                $data = array('upload_data' => $this->upload->data());
            }else{
                return "Can't create new noticia without an image";
            }

            $response  = $this->News_model->save($data['upload_data']['file_name'], $_POST);

            if ($response['error']) {
                echo $response['msg'];
            } else {
                redirect('/news/list');
            }
            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    

}
