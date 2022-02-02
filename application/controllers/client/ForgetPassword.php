<?php

class ForgetPassword extends CI_Controller{
    
    public function index(){
        $data['judul']      = 'home';
       
        $this->load->view('client/templates/header', $data);
        $this->load->view('client/forget-password-client');
        $this->load->view('client/templates/footer');
    }
    
}

?>