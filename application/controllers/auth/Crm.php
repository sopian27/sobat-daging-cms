<?php
class Crm extends CI_Controller
{
    public function __construct() {  
        parent::__construct(); 

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/PelangganModel','plg_model');    

    } 

    public function index()
    {
        $data['judul']   = 'Customer Relationship Management';
        $data['subMenu'] = "DATABASE";
        $t = time();
        $data['date'] = date("d F Y", $t);
        $data['pelangganObj']=$this->plg_model->getAll();

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/databases/sidemenu', $data);
        $this->load->view('auth/databases/crm', $data);
        $this->load->view('auth/templates/footer');
    }

    public function getData(){
        $data= $this->plg_model->getAll();
        $output = array(
            "datacrm"=>$data,
            "result"=>"ok"
        );

        echo json_encode($output);
    }


}
