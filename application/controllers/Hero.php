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

    public function list_all()
	{
        try {
            header('Content-Type: application/json');
            $response = $this->Hero_model->list_all();
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }


    public function detail()
	{
        try {
            header('Content-Type: application/json');
            // $data = json_decode(file_get_contents('php://input'), true);
            $hero_id = $_GET['hero_id'];
            $response = $this->Hero_model->detail($hero_id);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }



    public function list_all_interface()
	{
        try {
            // header('Content-Type: application/json');
            
            $response['data'] = $this->Hero_model->list_all_interface();
            $this->load->view('dashboard/heroes/list', $response);
            // echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }

    public function edit($id = NULL)
	{
        try {
            $response['data'] = $this->Hero_model->detail($id);
            $response['data']['heroes'] = $this->Hero_model->list_all();

            $this->load->view('dashboard/heroes/edit', $response);
            // echo json_encode($response);
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


    public function update_hero_basic_info()
	{
        try {
            header('Content-Type: application/json');
            $data = $_POST;
            $response = $this->Hero_model->update_hero_basic_info($data);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }



    public function updateSkill()
	{
        try {
            header('Content-Type: application/json');
            $data = $_POST;
            $id = $_GET['id'];
            $response = $this->Hero_model->updateSkill($id, $data);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }


    public function updateTierData()
	{
        try {
            header('Content-Type: application/json');
            $data = $_GET;
            $response = $this->Hero_model->updateTierData($data);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }
    }


    public function delete_strength_weakness()
	{
        try {
            header('Content-Type: application/json');
            $id = $_GET['id'];
            $response = $this->Hero_model->delete_strength_weakness($id);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
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


    

}
