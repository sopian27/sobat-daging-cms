<?php
class DataMutasi extends CI_Controller
{
    
    public function index()
    {
        $data['judul']   = 'Data Mutasi';
        $data['subMenu'] = "DATABASE";
        $t = time();
        $data['date'] = date("d F Y", $t);

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/databases/sidemenu', $data);
        $this->load->view('auth/databases/mutasi', $data);
        $this->load->view('auth/templates/footer');
    }

}
