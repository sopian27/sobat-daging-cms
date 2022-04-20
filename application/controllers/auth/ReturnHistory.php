<?php

class ReturnHistory extends CI_Controller{

    public function __construct() {  
        parent::__construct(); 

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/TRXReturnModel','trx_ret_model');

    } 


    public function index(){

        $data['judul']   = 'History Return';
        $data['subMenu'] = "Return/Cancel";
        $t = time();
        $data['date'] = date("d F Y", $t);
        $current_date = date("d/m/Y", $t);
        /*   
        $trxData = $this->trx_ret_model->getTrxId();
        $trxId = $trxData[0]->trx_id;

        $lastNoUrut = substr($trxId, 5,4);
        $nextNoUrut = intval($lastNoUrut)+1;
        $kodePo = 'RRI-'. sprintf('%04s',$nextNoUrut)."/".$current_date;
        $data['kode_po'] = $kodePo; */

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/return/sidemenu', $data);
        $this->load->view('auth/return/return-history', $data);
        $this->load->view('auth/templates/footer');

    }

    public function getDataByDate(){

        $data_post = $_POST;

        $batasTampilData = $_POST['batastampil'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;

        $data = $this->trx_ret_model->getData($data_post['create_date'], $_POST['keyword'], $halamanAwal, $batasTampilData);
        $dataCounter = $this->trx_ret_model->getDataCount($data_post['create_date'], $_POST['keyword']);

        $output = array(
            "length" => count($data),
            "data" => $data,
            "length_paging" => count($dataCounter)

        );

        echo json_encode($output);
    }

    
    public function getDataHistory(){


        $data_post = $_POST;
        $batasTampilData = $_POST['batastampil'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;

        $allDataPo = $this->trx_ret_model->getDataDetail($data_post['no_invoice'], $halamanAwal, $batasTampilData);
        $allDataPoCounter = $this->trx_ret_model->getDataDetailCount($data_post['no_invoice']);

        $output = array(
            "length" => count($allDataPo),
            "data" => $allDataPo,
            "length_paging" => count($allDataPoCounter),
        );

        echo json_encode($output);
    }

    public function getDetailTrx(){

        $getReturnData = $this->trx_ret_model->getDataByDate($_POST);
        echo json_encode($getReturnData);
    }


}
?>