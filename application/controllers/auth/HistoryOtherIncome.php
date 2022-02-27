<?php

class HistoryOtherIncome extends CI_Controller
{

    public function __construct() {  
        parent::__construct(); 

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/TRXOtherIncomeModel','trx_other_inc_model');    
        $this->load->helper('download');

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
        /*
        $dataOther = array();
        $dataOther  = $this->trx_other_inc_model->getDataOtherByDate($_POST);
        $dataOtherTot  = $this->trx_other_inc_model->getDataSumOtherByDate($_POST);

        $data = array(
            "data" => $dataOther,
            "dataTot" => $dataOtherTot,
            "result" => "ok"
        );

        echo json_encode($data);
        */
        $data_post = $_POST;

        $batasTampilData = $_POST['batastampil'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;

        $dataOther = $this->trx_other_inc_model->getData($data_post['create_date'], $_POST['keyword'], $halamanAwal, $batasTampilData);
        $dataOtherCount = $this->trx_other_inc_model->getDataCount($data_post['create_date'], $_POST['keyword']);
        $dataOtherTot  =$this->trx_other_inc_model->getDataSumOtherByDate($_POST);

        $output = array(
            "length" => count($dataOther),
            "data" => $dataOther,
            "length_paging" => count($dataOtherCount),
            "dataTot" => $dataOtherTot,
        );


        echo json_encode($output);
    }

    function downloadFile()
    {

        $data_post = $_POST;
        $file = "uploads/".$data_post['filename'];
        force_download($file,NULL);
    }


}
