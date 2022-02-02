<?php

class HistoryOtherIncome extends CI_Controller
{

    public function __construct() {  
        parent::__construct(); 

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/TRXOtherIncomeModel','trx_other_inc_model');    

    } 

    public function index()
    {

        $data['judul']   = 'History Other Income';
        $data['subMenu'] = "OTHER INCOME";
        $t = time();
        $data['date'] = date("d F Y", $t);

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/other/sidemenu', $data);
        $this->load->view('auth/other/history-other-income', $data);
        $this->load->view('auth/templates/footer');
    }

    public function getData()
    {
        
        $dataOther = array();
        $dataOther  = $this->trx_other_inc_model->getDataOtherByDate($_POST);
        $dataOtherTot  = $this->trx_other_inc_model->getDataSumOtherByDate($_POST);

        $data = array(
            "data" => $dataOther,
            "dataTot" => $dataOtherTot,
            "result" => "ok"
        );

        echo json_encode($data);
    }

}
