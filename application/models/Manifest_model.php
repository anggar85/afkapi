<?php
class Manifest_model extends CI_Model {

    public function list_all(){
        try{
            if ($this->session->userdata('level') == 1){
                $q = $this->db->query('SELECT 
                                        u.id, u.status,  u.email, concat(u.name, " ", u.lastname) as name , m.id AS manifestId, m.*
                                    FROM
                                        manifests AS m
                                            left JOIN
                                        users AS u ON u.id = m.user_id WHERE m.user_id = "'.$this->session->userdata('id').' AND m.status != 5  order by m.id desc";');
            }else{
                $q = $this->db->query('SELECT 
                                        u.id, u.status,  u.email, concat(u.name, " ", u.lastname) as name , m.id AS manifestId, m.*
                                    FROM
                                        manifests AS m
                                            left JOIN
                                        users AS u ON u.id = m.user_id   order by m.id desc');

            }
            $manifests = [];
            foreach($q->result() as $manifest){
                $m = $this->cleanData($manifest);
                array_push($manifests, $m);
            }

            $response['error']  = false;
            $response['data']['manifests']    = $manifests;
            
            return ($response);
        }catch (Exception $e){
            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
        }
    }

    public function show($data){
        try{
            $id = (int)$data['reservation_number'];
            $q = $this->db->query('SELECT 
                                        u.id, u.status,  u.email, concat(u.name, " ", u.lastname) as name , m.id AS manifestId, m.*
                                    FROM
                                        manifests AS m
                                            left JOIN
                                        users AS u ON u.id = m.user_id 
                                    where m.id = "'.$id.'" 
                                    limit 1');
            if ($q->num_rows() == 1){
                $response['error']  = false;
                $response['data']['manifest']    = $this->cleanData($q->row());
            }else{
                $response['error']  = true;
                $response['msg']    = "Can't find that Manifest.";
            }

            return ($response);
        }catch (Exception $e){
            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
        }
    }

    public function cleanData($d){
        return $data = [
            "name" => ($d->name == null ? "No name" :$d->name),
            "charter_company" => $d->charter_company,
            "group_name" => $d->group_name,
            "reservation_number" => sprintf("%04d", $d->id),
            "status" => ($d->status == null ? "0" : $d->status),
            "passengers_total" => $d->passenger_total,
            "pickup_location" => $d->pickup_location,
            "coordinator_phone_number" => $d->coordinator_phone_number,
            "coordinator_name" => $d->coordinator_name,
            "notes" => $d->notes,
            "manifestId" => (int)$d->manifestId,
            "status" => (int)$d->status,
            "created_at" => $d->created_at,
            "date" => $this->humanDate($d->date),
            "hour" => $this->humanHour($d->date),
            "email" => ($d->email == null ? "No email": $d->email)
        ];
    }

    public function humanHour($date){
        // $d = $date.explode(" ")[0];
        return date_format(date_create($date), 'g:i A');
    }
    public function humanDate($date){
        // $d = $date.explode(" ")[0];
        return date_format(date_create($date), 'm/d/Y');
    }

    public function create($data){
        try{
            $manifestDate = explode(" ", $data['date']);
            $fecha = explode("/", $manifestDate[0]);
            $newdate = $fecha[2]."-".$fecha[0]."-".$fecha[1]." ".$manifestDate[1];

            $manifest =[
                'user_id'                   => $this->session->userdata('id'),
                'charter_company'           => $data['charter_company'],
                'group_name'                => $data['group_name'],
                'passenger_total'           => $data['passenger_total'],
                'pickup_location'           => $data['pickup_location'],
                'coordinator_phone_number'  => $data['coordinator_phone_number'],
                'coordinator_name'          => $data['coordinator_name'],
                'notes'                     => $data['notes'],
                'date'                      => $newdate,
                'reservation_number'        => strtoupper(substr(uniqid(), -5))
            ];
            $this->db->insert('manifests', $manifest);

            $id = $this->db->insert_id();
            # Busca la data del ultumo id creado
            $q = $this->db->query('SELECT 
                                        u.id, u.status,  u.email, concat(u.name, " ", u.lastname) as name , m.id AS manifestId, m.*
                                    FROM
                                        manifests AS m
                                            left JOIN
                                        users AS u ON u.id = m.user_id 
                                    where m.id = "'.$id.'" 
                                    limit 1');

            $m = $this->cleanData($q->row());

            // var_dump($m);
            

            $response['error']  = false;
            $response['data']['manifest']   = $manifest;
            $response['msg']    = "Manifest created!";

            $message = '<table style="background-color: #022f88; width: 503px;" cellpadding="10">
            <tbody>
            <tr>
            <td style="width: 501px;" colspan="2"><img style="display: block; margin-left: auto; margin-right: auto;" src="http://www.goldenacorncasino.com/images/logo-gac-310x84-rev.png" alt="" width="310" height="84" /></td>
            </tr>
            <tr>
            <td style="width: 501px;" colspan="2">
            <h3 style="text-align: center;"><strong><span style="color: #ffffff;">Manifest Information</span></strong></h3>
            </td>
            </tr>
            <tr>
            <td style="width: 242px; text-align: right;"><strong><span style="color: #ffffff;">Arriving Date</span></strong></td>
            <td style="width: 259px;"><span style="color: #ffffff;">'.$m["date"].' '.$m["hour"].'</span></td>
            </tr>
            <tr>
            <td style="width: 242px; text-align: right;"><strong><span style="color: #ffffff;">Reservation Number</span></strong></td>
            <td style="width: 259px;"><span style="color: #ffffff;">'.sprintf("%04d", $id).'</span></td>
            </tr>
            <tr>
            <td style="width: 242px; text-align: right;"><strong><span style="color: #ffffff;">User</span></strong></td>
            <td style="width: 259px;"><span style="color: #ffffff;">'.$m["name"].'</span></td>
            </tr>
            <tr>
            <td style="width: 242px; text-align: right;"><strong><span style="color: #ffffff;">Charter Company</span></strong></td>
            <td style="width: 259px;"><span style="color: #ffffff;">'.$m["charter_company"].'</span></td>
            </tr>
            <tr>
            <td style="width: 242px; text-align: right;"><strong><span style="color: #ffffff;">Group Name</span></strong></td>
            <td style="width: 259px;"><span style="color: #ffffff;">'.$m["group_name"].'</span></td>
            </tr>
            <tr>
            <td style="width: 242px; text-align: right;"><strong><span style="color: #ffffff;">Passenger Total</span></strong></td>
            <td style="width: 259px;"><span style="color: #ffffff;">'.$m["passengers_total"].'</span></td>
            </tr>
            <tr>
            <td style="width: 242px; text-align: right;"><strong><span style="color: #ffffff;">Pickup Location</span></strong></td>
            <td style="width: 259px;"><span style="color: #ffffff;">'.$m["pickup_location"].'&nbsp;</span></td>
            </tr>
            <tr>
            <td style="width: 242px; text-align: right;"><strong><span style="color: #ffffff;">Notes</span></strong></td>
            <td style="width: 259px;"><span style="color: #ffffff;">'.$m["notes"].'&nbsp;</span></td>
            </tr>
            <tr>
            <td style="width: 242px;" colspan="2">
            <h3 style="text-align: center;"><span style="color: #ffffff;"><strong>Coordinator Information</strong></span></h3>
            </td>
            </tr>
            <tr>
            <td style="width: 242px; text-align: right;"><strong><span style="color: #ffffff;">Name</span></strong></td>
            <td style="width: 259px; text-align: left;"><span style="color: #ffffff;">'.$m["coordinator_name"].'</span></td>
            </tr>
            <tr>
            <td style="width: 242px; text-align: right;"><strong><span style="color: #ffffff;">Phone</span></strong></td>
            <td style="width: 259px; text-align: left;"><span style="color: #ffffff;">'.$m["coordinator_phone_number"].'</span></td>
            </tr>
            </tbody>
            </table>';

            $this->send($message);


            return ($response);
        }catch (Exception $e){
            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
        }
    }

    public function send($message) {
        $this->load->config('email');
        $this->load->library('email');
        
        $from = $this->config->item('smtp_user');
        $to = ADMIN_EMAIL;
        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject("New Manifest");
        $this->email->message($message);

        if ($this->email->send()) {
            // Guardar bitacora de correos?
            // echo 'Your Email has successfully been sent.';
        } else {
            // show_error($this->email->print_debugger());
        }
    }

    public function update($data){
        try{
            $single =[
                'email'     => $data['email'],
                'name'      => $data['name'],
                'lastname'  => $data['lastname'],
                'password'  => $data['password'],
                'company'   => $data['company'],
                'notes'     => $data['notes'],
                'status'    => $data['status']
            ];
            $this->db->where('id', $data['id']);
            $this->db->update('users', $single);
            $response['error']          = false;
            $response['data']['manifest']   = $single;
            $response['msg']            = "User updated!";

            return ($response);
        }catch (Exception $e){
            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
        }
    }

    public function request_cancelation($data){
        try{
            $single =[
                'status'    => 2 // Es request cancelation
            ];
            $this->db->where('id', $data['id']);
            $this->db->update('manifests', $single);
            $response['error']          = false;
            $response['msg']            = "Request sended!";
            
            $d['reservation_number'] = $data['id'];
            $manifestData = $this->show($d);
            $manifestData = $manifestData['data']['manifest'];
            // var_dump($manifestData);

            $message ='<table style="background-color: #022f88; width: 503px;" cellpadding="10">
            <tbody>
            <tr>
            <td style="width: 501px;" colspan="2"><img style="display: block; margin-left: auto; margin-right: auto;" src="http://www.goldenacorncasino.com/images/logo-gac-310x84-rev.png" alt="" width="310" height="84" /></td>
            </tr>
            <tr>
            <td style="width: 501px;" colspan="2">
            <h3 style="text-align: center;"><strong><span style="color: #ffffff;">Request of manifest cancelation</span></strong></h3>
            </td>
            </tr>
            <tr>
            <td style="width: 242px; text-align: right;"><strong><span style="color: #ffffff;">Manifest Number</span></strong></td>
            <td style="width: 259px;"><span style="color: #ffffff;">'.$manifestData['reservation_number'].'</span></td>
            </tr>
            <tr>
            <td style="width: 242px; text-align: right;"><strong><span style="color: #ffffff;">User</span></strong></td>
            <td style="width: 259px;"><span style="color: #ffffff;">'.$manifestData['name'].'</span></td>
            </tr>
            <tr>
            <td style="width: 242px; text-align: right;"><strong><span style="color: #ffffff;">Date</span></strong></td>
            <td style="width: 259px;"><span style="color: #ffffff;">'.$manifestData['date'].' '.$manifestData['hour'].'</span></td>
            </tr>
            </tbody>
            </table>';
            $this->sendMailRequestCancelation($message);
            return ($response);
        }catch (Exception $e){
            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
        }
    }

    public function sendMailRequestCancelation($message) {
        $this->load->config('email');
        $this->load->library('email');
        
        $from = $this->config->item('smtp_user');
        $to = ADMIN_EMAIL;
        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject("Request manifest cancelation");
        $this->email->message($message);

        if ($this->email->send()) {
            // echo 'Your Email has successfully been sent.';
        } else {
            // show_error($this->email->print_debugger());
        }
    }
    

    public function acept_cancelation($data){
        try{
            $single =[
                'status'    => 5 // Es cancelation final
            ];
            $this->db->where('id', $data['id']);
            $this->db->update('manifests', $single);
            $response['error']          = false;
            $response['msg']            = "Manifest canceled!";
            
            $d['reservation_number'] = $data['id'];
            $manifestData = $this->show($d);
            $manifestData = $manifestData['data']['manifest'];

            $message ='<table style="background-color: #022f88; width: 503px;" cellpadding="10">
            <tbody>
            <tr>
            <td style="width: 501px;" colspan="2"><img style="display: block; margin-left: auto; margin-right: auto;" src="http://www.goldenacorncasino.com/images/logo-gac-310x84-rev.png" alt="" width="310" height="84" /></td>
            </tr>
            <tr>
            <td style="width: 501px;" colspan="2">
            <h3 style="text-align: center;"><strong><span style="color: #ffffff;">Manifest '.$manifestData['reservation_number'].' was cancelated</span></strong></h3>
            </td>
            </tr>
            <tr>
            <td style="width: 242px; text-align: right;"><strong><span style="color: #ffffff;">Date</span></strong></td>
            <td style="width: 259px;"><span style="color: #ffffff;">'.$manifestData['date'].' '.$manifestData['hour'].'</span></td>
            </tr>
            </tbody>
            </table>';
            $this->aceptCancelation($message, $manifestData['email']);
            return ($response);
        }catch (Exception $e){
            $response['error']  = true;
            $response['msg']   = $e->getMessage();
            return ($response);
        }
    }

    

    public function aceptCancelation($message, $user) {
        $this->load->config('email');
        $this->load->library('email');
        
        $from = $this->config->item('smtp_user');
        $to = $user;
        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject("Manifest Canceled");
        $this->email->message($message);

        if ($this->email->send()) {
            // echo 'Your Email has successfully been sent.';
        } else {
            // show_error($this->email->print_debugger());
        }
    }
    


    public function delete($data){
        try{
            $this->db->where('id', $data['id']);
            $this->db->limit(1);
            $q = $this->db->get('manifests');
            if ($q->num_rows() == 1){
                $this->db->where('id', $data['id']);
                $this->db->limit(1);
                $this->db->delete('manifests');
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