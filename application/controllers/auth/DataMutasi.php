<?php
class DataMutasi extends CI_Controller
{

    public function __construct() {  
        parent::__construct(); 

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/DataMutasiModel','mutasi_model');    

    }
    
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

    public function getData()
    {
        
        $dataMutasiIn   = $this->mutasi_model->getByDateMutasiMasuk($_POST);
        $dataMutasiOut  = $this->mutasi_model->getByDateMutasiKeluar($_POST);

        $data = array(
            "mutasi_masuk" => $dataMutasiIn,
            "mutasi_keluar" => $dataMutasiOut,
            "result" => "ok"
        );

        echo json_encode($data);
    }

}
