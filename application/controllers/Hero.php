<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Hero extends CI_Controller {
    
    function __construct() {

        parent::__construct();
        $this->load->model('Hero_model');
        $this->load->model('Skills_model');

        // Helpers
        $this->load->helper('form');
        $this->load->helper('Util_helper');
        
    }



    public function list_all_interface()
	{
        try {            
            $response['data'] = $this->Hero_model->list_all_interface();
            $this->load->view('dashboard/heroes/list', $response);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function edit($id = NULL)
	{
        try {
            $response['data'] = $this->Hero_model->detail($id);
            // var_dump($response);
            // return;

            $response['data']['heroes'] = $this->Hero_model->list_all_interface();

            $this->load->view('dashboard/heroes/edit', $response);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function new_hero()
	{
        try {
            $response['data']['heroes'] = $this->Hero_model->list_all_interface();
            $this->load->view('dashboard/heroes/new', $response);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function save()
	{
        try {
            $response = $this->Hero_model->save_new_hero($_POST);
            // var_dump($response);
            if ($response['error']) {
                echo $response['msg'];
            } else {
                redirect('/hero/edit/'.$response['id']);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    public function update($id = NULL)
	{
        try {
            // var_dump($_POST);
            // return;
            $data['upload_data']['file_name'] = "";
            if ($_FILES['image_icon']['name'] != "") {
                $ext = explode(".", $_FILES['image_icon']['name'])[1];
                if ($ext != "jpg") {
                    throw new Exception("The format of the icon image MUST be '.jpg'");
                }
                $file_name =  ucfirst(str_replace(" ", "_", $_POST['name']).".".$ext);

                // Upload the new image
                $config['upload_path']          = './assets/heroes/icons/';
                $config['allowed_types']        = 'jpg';
                $config['max_size']             = 0;
                $config['remove_spaces']		= true;
                $config['overwrite']		    = true;
                $config['file_name']		    = $file_name;
    
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
    
                if ( ! $this->upload->do_upload('image_icon'))
                {
                    $error = array('error' => $this->upload->display_errors());
                    return var_dump($this->upload->display_errors());
                }
                $data = array('upload_data' => $this->upload->data());
            }
            $response = $this->Hero_model->update_hero_basic_info($_POST);
            if ($response['error']) {
                echo $response['msg'];
            } else {
                redirect('/hero/edit/'.$id);
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }



    public function update_skill($id = NULL)
	{
        try {
            $data['upload_data']['file_name'] = "";
            if ($_FILES['skillIcon']['name'] != "") {
                $ext = explode(".", $_FILES['skillIcon']['name'])[1];
                if ($ext != "png") {
                    throw new Exception("The format of the skill image MUST be '.png'");
                }
                $file_name =  strtolower($_POST['hero_name'].$_POST['skillOrder'].".".$ext);

                // Upload the new image
                $config['upload_path']          = './assets/heroes/skills/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 0;
                $config['remove_spaces']		= true;
                $config['overwrite']		    = true;
                $config['file_name']		    = $file_name;
    
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
    
                if ( ! $this->upload->do_upload('skillIcon'))
                {
                    $error = array('error' => $this->upload->display_errors());
                    return var_dump($this->upload->display_errors());
                }
                $data = array('upload_data' => $this->upload->data());
            }

            $response = $this->Hero_model->update_skill($id, $_POST);
            if ($response['error']) {
                echo $response['msg'];
            } else {
                redirect('/hero/edit/'.$_POST['hero_id']);
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    public function create_strength_weakness()
	{
        try {
            header('Content-Type: application/json');
            $data = $_GET;
            $response = $this->Hero_model->create_strength_weakness($data);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }

    public function strengthweakenes_delete($id = NULL, $hero_id =NULL)
	{
        try {
            $response = $this->Hero_model->strengthweakenes_delete($id);
            if ($response['error']) {
                echo $response['msg'];
            } else {
                redirect('/hero/edit/'.$hero_id);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update_tier_data($hero_id = NULL,$table = NULL, $hero_name =NULL)
	{
        try {
            $response = $this->Hero_model->update_tier_data($table, $hero_name, $_POST);
            if ($response['error']) {
                echo $response['msg'];
            } else {
                redirect('/hero/edit/'.$hero_id);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    

}
