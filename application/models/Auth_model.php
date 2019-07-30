<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function login_user($data){
        try{
            $this->db->where('email', $data['email']);
            $this->db->where('password', md5($data['password']));
            $this->db->limit(1);
            $query = $this->db->get('users');
            if ($query->num_rows() > 0){
                $userData = $query->row();
                $response['error']  = false;
//                $response['data']['user']   = $userData;
                $response['msg']    = "Welcome ".$data['email'];
                // Create array of user data
                $newdata = array(
                    'username'  => $userData->name,
                    'email'     => $userData->email,
                    'id'        => $userData->id,
                    'logged_in' => TRUE
                );
                // Save data in teh session
                $this->session->set_userdata($newdata);

            }else{
                $response['error']  = true;
                $response['msg']   = "Wrong user or password, try again";
            }
            return ($response);
        }catch (Exception $e){
            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
        }
    }


    public function password_reset($token){
//        Este metodo solo se encarga de buscar el token recibido
        try{
            $this->db->where('reset_password_token', $token);
            $this->db->limit(1);
            $query = $this->db->get('users');
            if ($query->num_rows() > 0){
                $userData = $query->row();

                $newdata = array(
                    'username'  => $userData->name,
                    'email'     => $userData->email,
                    'id'        => $userData->id,
                    'level'     => $userData->level,
                    'logged_in' => TRUE
                );
                // Save data in teh session
                $this->session->set_userdata($newdata);
                return true;
            }else{
                return false;
            }

        }catch (Exception $e){
            return false;
        }
    }

    public function set_new_password($data){
        try{

            // Valida que el pass actual sea correcto
            $this->db->where('id', $this->session->userdata('id'));
            $this->db->limit(1);
            $q = $this->db->get('users');
            if ($q->num_rows() == 1){
                // Password actual es correcto
                // Valida si new y confirm pass son iguales
                if ($data['newpassword'] == $data['newconfirmpassword']){

                    // Valida longitud de password
                    if (strlen($data['newpassword']) > 8){
                        // Si coinciden, entonces si se camabia el password de la cuenta
                        $single =['password' => md5($data['newconfirmpassword']), "reset_password_token" => ""];

                        $this->db->where('id', $this->session->userdata('id'));
                        $this->db->update('users', $single);
                        $response['error']          = false;
                        $response['data']['user']   = $single;
                        $response['msg']            = "User password updated!";
                        // Enviar correo a usuario acerca de la actualizacion del password?
                        $to = $this->session->userdata('email');
                        $subject ="Password updated!";
                        $message = "Your password has been changed";
                        $this->send($to, $subject, $message);
                    }else{
                        $response['error']  = true;
                        $response['msg']   = "Password must have minimum 8 characters";
                    }
                }else{
                    $response['error']  = true;
                    $response['msg']   = "New password and confirmation aren't equals";
                }
            }else{
                // No coincide
                $response['error']  = true;
                $response['msg']   = "Current password provided is wrong";
            }
            return ($response);
        }catch (Exception $e){
            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
        }
    }



    public function password_recovery($data){
        try{
            $this->db->where('email', $data['email']);
            $this->db->limit(1);
            $query = $this->db->get('users');
            if ($query->num_rows() > 0){
                $userData = $query->row();

                // COmo si lo encontro, envia el correo a la direccion almacenada
                // Genera un token
                $token = md5(time());
                $single =[
                    'reset_password_token'      => $token
                ];

                // Se actualiza el token del usuario
                $this->db->where('email', $data['email']);
                $this->db->limit(1);
                $this->db->update('users', $single);

                // Se envia el correo al usuario con un link basado en el token
                $msj = "<p>Click this link to recover you password</p>
                        <p><a href='".base_url()."password_reset?token=".$token."'>Recover my password</a></p>";
                $this->sendPasswordRecoveryMail($userData->email, "Reset password request", $msj);

                $response['error']  = false;
                $response['msg']   = "A email has been sent to reset the password.";

                // Save data in teh session

            }else{
                $response['error']  = true;
                $response['msg']   = "Wrong user or password, try again";
            }
            return ($response);
        }catch (Exception $e){
            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
        }
    }


    public function sendPasswordRecoveryMail($to, $subject, $message) {
        $this->load->config('email');
        $this->load->library('email');

        $from = $this->config->item('smtp_user');
        $to = $to;
        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            // echo 'Your Email has successfully been sent.';
            $response['error']  = false;
            $response['msg']   = "A email has been sent to reset the password.";
            return $response;
        } else {
            $response['error']  = true;
            $response['msg']   = "Couldn't send the reset password email";
            return $response;
            // show_error($this->email->print_debugger());
        }
    }

    public function send($to, $subject, $message) {
        $this->load->config('email');
        $this->load->library('email');

        $from = $this->config->item('smtp_user');
        $to = $to;
        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            // echo 'Your Email has successfully been sent.';
            $response['error']          = false;
            $response['msg']            = "User password updated!";
        } else {
            $response['error']          = true;
            $response['msg']            = "Something went wrong. Contact Admin.";
            // show_error($this->email->print_debugger());
        }
    }




}