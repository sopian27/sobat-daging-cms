<?php
class Crm extends CI_Controller
{
    public function __construct() {  
        parent::__construct(); 

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/PelangganModel','plg_model');    
        $this->load->model('auth/SupplierModel','sup_model');    

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

    public function getDatabak(){
        $data= $this->plg_model->getAll();
        $output = array(
            "datacrm"=>$data,
            "result"=>"ok"
        );

        echo json_encode($output);
    }

    public function getData()
    {

        $data_post = $_POST;

        $batasTampilData = $_POST['batastampil'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;
        
        $data = $this->plg_model->getData($data_post['create_date'], $_POST['keyword'], $halamanAwal, $batasTampilData);
        $dataCounter = $this->plg_model->getDataCount($data_post['create_date'], $_POST['keyword']);

        $dataSup = $this->sup_model->getData($data_post['create_date'], $_POST['keyword'], $halamanAwal, $batasTampilData);
        $dataCounterSup = $this->sup_model->getDataCount($data_post['create_date'], $_POST['keyword']);

        $output = array(
            "length" => count($data),
            "datacrm" => $data,
            "length_paging" => count($dataCounter),
            "length_sup" => count($dataSup),
            "datasup" => $dataSup,
            "length_paging_sup" => count($dataCounterSup)
        );


        echo json_encode($output);
    }


}
