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
        $trxData = $this->trx_ret_model->getTrxId();
        $trxId = $trxData[0]->trx_id;

        $lastNoUrut = substr($trxId, 5,4);
        $nextNoUrut = intval($lastNoUrut)+1;
        $kodePo = 'RRI-'. sprintf('%04s',$nextNoUrut)."/".$current_date;
        $data['kode_po'] = $kodePo;

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/return/sidemenu', $data);
        $this->load->view('auth/return/return-history', $data);
        $this->load->view('auth/templates/footer');

    }

    public function getDataByDate(){

        $getReturnData = $this->trx_ret_model->getDataByDate($_POST);
        echo json_encode($getReturnData);
    }

    
    public function getDataByDateHistory(){

        $getReturnData = $this->trx_ret_model->getDataByDateHistory($_POST);
        echo json_encode($getReturnData);
    }

    public function getDetailTrx(){

        $getReturnData = $this->trx_ret_model->getDataByDate($_POST);
        echo json_encode($getReturnData);
    }


}
?>