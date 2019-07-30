<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Auth extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        // Helpers
        $this->load->helper('Util_helper');
    }

	public function index()
	{
	    if (!$this->session->userdata('logged_in')){
	        // If is not logged, is sended to login
            $this->load->view('auth/login');
        }else{
	        // Check the level
            if ($this->session->userdata('level') == 5 || $this->session->userdata('level') == 100 ){
                $this->load->view('system/index');
            }else{
                $this->load->view('dashboard/index');
            }
        }

	}

	public  function login(){
        header('Content-Type: application/json');
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            $login = $data['data']["login"];

            $response = $this->Auth_model->login_user($login);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }

    }

	public  function password_recovery(){
        header('Content-Type: application/json');
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            $login = $data['data']["login"];

            $response = $this->Auth_model->password_recovery($login);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }

    }


	public  function set_new_password(){
        header('Content-Type: application/json');
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            $login = $data['data']["login"];

            $response = $this->Auth_model->set_new_password($login);
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }

    }


	public  function password_reset(){
        try {~
            $token = $_GET['token'];

            $response = $this->Auth_model->password_reset($token);
            if ($response){
                $this->load->view('auth/change_password');
            }else{
                $this->load->view('auth/wrong_token');
            }
        } catch (Exception $e) {
            echo json_encode(['error'=>true, 'msg'=>$e->getMessage()]);
        }

    }

    public function logout(){
        $this->session->sess_destroy();
        $response['error'] = false;
        $response['logged_in'] = false;
        echo json_encode($response);
    }

    public function checkSession(){
        if ($this->session->userdata('logged_in') !== null) {
            $response['error'] = false;
            $response['logged_in'] = true;
            echo json_encode($response);
        }else{
            $response['error'] = false;
            $response['logged_in'] = false;
            echo json_encode($response);
        }
    }


}
