<?php

class Home extends CI_Controller{

    
    public function index(){
        $data['judul'] = 'Home';
        $this->load->view('client/templates/header', $data);
        $this->load->view('client/home');
    }
}
