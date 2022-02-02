<?php
class TotalStock extends CI_Controller
{
    public function __construct() {  
        parent::__construct(); 

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/BarangModel','brg_model');

    } 

    public function index()
    {
        $data['judul']   = 'Total Stock';
        $data['subMenu'] = "DATABASE";
        $t = time();
        $data['date'] = date("d F Y", $t);
        //$data['barangObj']=$this->brg_model->getDataBarang();

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/databases/sidemenu', $data);
        $this->load->view('auth/databases/total-stock', $data);
        $this->load->view('auth/templates/footer');
    }

    public function getData(){
        $data= $this->brg_model->getDataBarang();
        $output = array(
            "datastock"=>$data,
            "result"=>"ok"
        );

        echo json_encode($output);
    }

}
