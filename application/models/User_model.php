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
                $response['error']  = true;
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


    public function getFacebookImages()
    {
        try {
            $this->db->where("token !=", "");
            $this->db->limit(10);
        $q = $this->db->get('users');
        if ($q->num_rows() > 0 ){
            
            $cont = 0;
            foreach ($q->result() as $user) {
                if ($user->token != "") {
                    $id = $user->id;
                    // Busca la imagen que tiene en facebook y la agrega al objeto
                    $img = FCPATH."assets/images/users/"."user_".$id.".jpg";
                    $content = copy(getProfilePic($user->token), $img);
                    $user->fb_image = base_url()."assets/images/users/"."user_".$id.".jpg";
                    sleep(1);
                    $cont++;
                }
                
            }
            $response['error']  = false;
            $response['msg']    = "Se actualizaron ".$cont." fotos.";

        }else{
            $response['error']  = false;
            $response['msg']    = "No hay usuarios";
        }
        return $response;

        } catch (Exeption $e) {
            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
        }
    }
}