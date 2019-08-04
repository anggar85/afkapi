<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Items extends CI_Controller {
    
    function __construct() {

        parent::__construct();
        $this->load->model('Items_model');

        $this->load->helper('form');

        // Helpers
        $this->load->helper('Util_helper');

        
        
    }


    public function list()
	{
        try {
            $response['data'] = $this->Items_model->list();
            $this->load->view('dashboard/items/list', $response);
        } catch (Exception $e) {
            $this->load->view('dashboard/items/list', $response);
        }
    }


    public function new()
	{
        $this->load->view('dashboard/items/new');
    }

    public function edit($id = NULL)
	{
        try {
            $response['data'] = $this->Items_model->edit($id);
            $this->load->view('dashboard/items/edit', $response);
        } catch (Exception $e) {
            $this->load->view('dashboard/items/list', $response);
        }
    }

    public function delete($id = NULL)
	{
        try {
            $response['data'] = $this->Items_model->delete($id);
            if ($response['error']) {
                echo $response['msg'];
            } else {
                redirect('/items/list');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update($id = NULL)
	{
        try {
            $data['upload_data']['file_name'] = "";
            // var_dump($_FILES['image']['name']);
            // return;
            if ($_FILES['image']['name'] != "") {
                // Upload the new image
                $config['upload_path']          = './assets/heroes/items';
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
            }

            $response  = $this->Items_model->update($data['upload_data']['file_name'], $_POST);

            if ($response['error']) {
                echo $response['msg'];
            } else {
                redirect('/items/list');
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
                $config['upload_path']          = './assets/heroes/items';
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
                return "Can't create new item without an image";
            }

            $response  = $this->Items_model->save($data['upload_data']['file_name'], $_POST);

            if ($response['error']) {
                echo $response['msg'];
            } else {
                redirect('/items/list');
            }
            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    

}
