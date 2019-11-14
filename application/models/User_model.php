<?php
class User_model extends CI_Model {

    function __construct() {

        parent::__construct();

        // Metodos disponibles
        $this->load->helper('Util_helper');
        
    }

    public function list_all(){
        try{
            $this->db->where('level !=', 100);
            $q = $this->db->get('users');
            $response['error']  = false;
            $response['data']['users']    = $q->result();
            
            return ($response);
        }catch (Exception $e){
            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
        }
    }

    public function show_profile($id){
        try{
            
            // Primero busca al usuario
            $this->db->where('id', $id);
            $this->db->limit(1);
            $q = $this->db->get('users');
            if ($q->num_rows() == 1){
                $user = $q->row();
                // Si el usuario existe, busca el row en decks, solo debe haber 1 deck por usuario
                $this->db->where('user_id', $id);
                $this->db->limit(1);
                $q = $this->db->get('decks');
                if ($q->num_rows() == 1){
                    // Si existe un row, entonces regresa la informacion como esta
                    $deck = $q->row();
                }else{
                    // Si el usuario no tiene row en decks, se le crea uno
                    $d = ["user_id"=> $id];
                    $this->db->insert("decks", $d);
                    $this->db->where('user_id', $id);
                    $this->db->limit(1);
                    $q = $this->db->get('decks');
                    $deck = $q->row();
                }

                // Busca la imagen que tiene en facebook y la agrega al objeto
                $img = FCPATH."assets/images/users/"."user_".$id.".jpg";
                $content = copy(getProfilePic($user->token), $img);
                $user->fb_image = base_url()."assets/images/users/"."user_".$id.".jpg";

                $response['error']  = false;
                $response['data']['profile']['user']    = $user;
                $response['data']['profile']['deck']    = $deck;
            }else{
                $response['data']['error']  = true;
                $response['data']['msg']    = "Can't find that User.";
            }

            return ($response);
        }catch (Exception $e){
            $response['data']['error']  = true;
            $response['data']['msg']   = $e->getMessage();
            return ($response);
        }
    }

    public function show_fb($data){
        try{
            $user_id = $data['user']['token'];

            $this->db->where('token', $user_id);
            $this->db->limit(1);
            $q = $this->db->get('users');
            if ($q->num_rows() == 1){
                $response['error']  = false;
                $response['data']['user']    = $q->row();
            }else{
                $response['data']['error']  = true;
                $response['msg']    = "Can't find that User.";
            }

            return ($response);
        }catch (Exception $e){
            $response['data']['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
        }
    }

    public function show($data){
        try{
            $user_id = $data['id'];

            $this->db->where('id', $user_id);
            $this->db->limit(1);
            $q = $this->db->get('users');
            if ($q->num_rows() == 1){
                $response['error']  = false;
                $response['data']['user']    = $q->row();
            }else{
                $response['error']  = true;
                $response['msg']    = "Can't find that User.";
            }

            return ($response);
        }catch (Exception $e){
            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
        }
    }

    public function create_fb($user){
        try{
            // Valida que el correo no exista en la db
            $this->db->where('token', $user['token']);
            $this->db->limit(1);
            $q = $this->db->get('users');
            if ($q->num_rows() == 1){
                $response['error']  = true;
                $response['msg']    = "Email is already in use";
                return $response;
            }else{
                $u =[
                    "name"      => $user['name'],
                    "status"    => 1,
                    "token"     => $user['token'],
                    "email"     => $user['email']
                ];
                $this->db->insert('users', $u);
                $user_id = $this->db->insert_id();
                $user['id'] = $user_id;
                $response['error']  = false;
                $response['user']  = $user;
                return ($response);
                
            }
            

        }
        catch (Exception $e){
            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
        }
    }
     

    public function update_profile($profile, $id){
        try{
            $user = $profile['user'];
            $deck = $profile['deck'];
            // Valida que el usuario exista
            $this->db->where('id', $id);
            $this->db->limit(1);
            $q = $this->db->get('users');
            if ($q->num_rows() == 1){
                // Si el usuario existe, entonces actualiza el nombre
                $d = ["name"=> $user['name']];
                $this->db->where('id', $id);
                $this->db->limit(1);
                $this->db->update('users', $d);
                // Si se actualizo correctamente el nombre
                // actualizara el deck... en este punto el deck ya existe, se creo al entrar 
                // a la seccion get profile
                // Agrega el campo author
                $deck['author'] = $user['name'];
                $this->db->where('user_id', $id);
                $this->db->limit(1);
                $this->db->update('decks', $deck);

                $response['error']  = false;
                $response['msg']    = "Profile updated";
                return $response;
            }else{
                $response['error']  = trye;
                $response['msg']    = "Cant find the user, try login again";
                return ($response);
            }
        }
        catch (Exception $e){
            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
        }
    }


    public function create($data){
        try{
            // Valida que el correo no exista en la db
            $this->db->where('email', $data['email']);
            $this->db->limit(1);
            $q = $this->db->get('users');
            if ($q->num_rows() == 1){
                $response['error']  = true;
                $response['data']['msg']    = "Email is already in use";
                return $response;
            }

            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $response['error']  = true;
                $response['data']['msg']    = "The email is not valid";
                return $response;
            }


            // Si el correo no existe, enotnces procede a crear la cuenta
            $password = substr(time(),2, 10);
            $md5Password = md5($password);
            $single =[
                'name'      => $data['name'],
                'lastname'  => $data['lastname'],
                'email'     => $data['email'],
                'phone'     => $data['phone'],
                'password'  => $md5Password,
                'notes'     => $data['notes'],
                'status'    => $data['status'],
                'level'     => $data['level']
            ];
            $this->db->insert('users', $single);
            $to = $data['email'];
            $subject = "New account created";
            $message = '<table style="background-color: #022f88; height: 163px; width: 406px; margin-left: auto; margin-right: auto;" cellpadding="10">
            <tbody>
            <tr>
            <td style="width: 396px;" colspan="2"><img style="display: block; margin-left: auto; margin-right: auto;" src="http://www.goldenacorncasino.com/images/logo-gac-310x84-rev.png" alt="" width="310" height="84" /></td>
            </tr>
            <tr>
            <td style="width: 203px; text-align: center;" colspan="2">
            <h3><strong><span style="color: #ffffff;">Account Information</span></strong></h3>
            </td>
            </tr>
            <tr>
            <td style="width: 203px; text-align: right;"><span style="color: #ffffff;">Email</span></td>
            <td style="width: 193px; text-align: left;"><span style="color: #ffffff;">'.$to.'</span></td>
            </tr>
            <tr>
            <td style="width: 203px; text-align: right;"><span style="color: #ffffff;">Password</span></td>
            <td style="width: 193px; text-align: left;">
            <p><span style="color: #ffffff;">'.$password.'</span></p>
            </td>
            </tr>
            </tbody>
            </table>';

            $response['error']  = false;
            $response['data']['user']   = $single;
            $response['msg']    = "User created!, no email sended";

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
                $response['error']  = false;
                $response['msg']    = "User created!, email sended";
            } else {
                $response['error']  = true;
                $response['msg']    = "User created but couldn't send the email";
            }

            return ($response);
        }catch (Exception $e){
            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
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
        } else {
            // show_error($this->email->print_debugger());
        }
    }


    public function update($data){
        try{
            if ($data['fromDriver']) {

                $single =[
                    'name'      => $data['name'],
                    'lastname'  => $data['lastname'],
                    'phone'     => $data['phone']
                ];
            }else{
                $single =[
                    'email'     => $data['email'],
                    'name'      => $data['name'],
                    'lastname'  => $data['lastname'],
                    'notes'     => $data['notes'],
                    'status'    => $data['status'],
                    'phone'     => $data['phone'],
                    'level'     => $data['level']
                ];
            }
            $this->db->where('id', $data['id']);
            $this->db->update('users', $single);
            $response['error']          = false;
            $response['data']['user']   = $single;
            $response['msg']            = "User updated!";
            // Actualiza informacion de la sesion
            $this->session->set_userdata('username', $data['name']);
            return ($response);
        }catch (Exception $e){
            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
        }
    }

    public function update_user_password($data){
        try{

            $password = md5($data['password']);

            // Valida que el pass actual sea correcto
            $this->db->where('id', $this->session->userdata('id'));
            $this->db->where('password', $password);
            $this->db->limit(1);
            $q = $this->db->get('users');
            if ($q->num_rows() == 1){
                // Password actual es correcto
                // Valida si new y confirm pass son iguales
                if ($data['newpassword']){

                    // Valida longitud de password
                    if (strlen($data['newpassword']) >= 8){
                        // Si coinciden, entonces si se camabia el password de la cuenta
                        $single =['password' => md5($data['newconfirmpassword']), "reset_password_token" => ""];

                        $this->db->where('id', $this->session->userdata('id'));
                        $this->db->update('users', $single);
                        $response['error']          = false;
//                        $response['data']['user']   = $single;
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


    public function delete($data){
        try{
            $this->db->where('id', $data['id']);
            $this->db->limit(1);
            $q = $this->db->get('users');
            if ($q->num_rows() == 1){
                $this->db->where('id', $data['id']);
                $this->db->limit(1);
                $this->db->delete('users');
                $response['error']  = false;
                $response['msg']    = "User deleted";
            }else{
                $response['error']  = true;
                $response['msg']    = "Can't find that id.";
            }

            return ($response);
        }catch (Exception $e){
            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
        }
    }


}