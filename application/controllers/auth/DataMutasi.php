<?php
class DataMutasi extends CI_Controller
{

    public function __construct() {  
        parent::__construct(); 

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/DataMutasiModel','mutasi_model'); 
        $this->load->model('auth/ApModel', 'ap_model');
        $this->load->model('auth/ArModel', 'ar_model');   

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

    public function getDatabak()
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

    public function getData()
    {

        $data_post = $_POST;

        $batasTampilData = $_POST['batastampil'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;
        
        //data trx keluar
        $rptObjOut = $this->ap_model->getData($data_post['create_date'], $_POST['keyword'], $halamanAwal, $batasTampilData);
        $rptObjCounterOut = $this->ap_model->getDataCount($data_post['create_date'], $_POST['keyword']);

        //data trx masuk
        $rptObjIn = $this->ar_model->getData($data_post['create_date'], $_POST['keyword'], $halamanAwal, $batasTampilData);
        $rptObjCounterIn = $this->ar_model->getDataCount($data_post['create_date'], $_POST['keyword']);

        $output = array(
            "length_in" => count($rptObjIn),
            "data_in" => $rptObjIn,
            "length_in_paging" => count($rptObjCounterIn),
            "length_out" => count($rptObjOut),
            "data_out" => $rptObjOut,
            "length_out_paging" => count($rptObjCounterOut)
        );


        echo json_encode($output);
    }

}
