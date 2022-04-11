<?php

class HistoryPettyCash extends CI_Controller
{

    public function __construct() {  
        parent::__construct(); 

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/TRXPettyInModel','petty_in_model');    
        $this->load->model('auth/TRXPettyOutModel','petty_out_model');
            

    } 

    public function index()
    {

        $data['judul']   = 'History Petty Cash';
        $data['subMenu'] = "PETTY CASH";
        $t = time();
        $data['date'] = date("d F Y", $t);

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/petty/sidemenu', $data);
        $this->load->view('auth/petty/history-petty-cash', $data);
        $this->load->view('auth/templates/footer');
    }

    public function getData()
    {
        
        $dataPettyIn = array();
        $dataPettyOut = array();

        $dataPettyIn  = $this->petty_in_model->getSaldoByDate($_POST);
        $dataPettyOut = $this->petty_out_model->getSaldoByDate($_POST);

        $output = array();
        $length = 0;
        $min = 0;

        $result = count($dataPettyIn) - count($dataPettyOut);
        if ($result >= 0) {
            $length = count($dataPettyIn);
            $min = count($dataPettyOut);
            $output = $this->composeData($dataPettyIn, $dataPettyOut, $length, $min, true);
        }

        if ($result < 0) {
            $length = count($dataPettyOut);
            $min = count($dataPettyIn);
            $output = $this->composeData($dataPettyIn, $dataPettyOut, $length, $min, false);
        }

        $data = array(
            "data" => $output,
            "result" => "ok"
        );

        echo json_encode($data);
    }

    public function loadData()
    {

        $dataPettyIn = array();
        $dataPettyOut = array();
        $dataPettyIn  = $this->petty_in_model->getSaldoByCurrentDate();
        $dataPettyOut = $this->petty_out_model->getSaldoByCurrentDate();

        $output = array();
        $length = 0;
        $min = 0;

        $result = count($dataPettyIn) - count($dataPettyOut);
        if ($result >= 0) {
            $length = count($dataPettyIn);
            $min = count($dataPettyOut);
            $output = $this->composeData($dataPettyIn, $dataPettyOut, $length, $min, true);
        }

        if ($result < 0) {
            $length = count($dataPettyOut);
            $min = count($dataPettyIn);
            $output = $this->composeData($dataPettyIn, $dataPettyOut, $length, $min, false);
        }

        $data = array(
            "data" => $output,
            "result" => "ok"
        );

        echo json_encode($data);
    }

    private function composeData($dataPettyIn, $dataPettyOut, $length, $min, $flag)
    {
        $output = array();

        if ($flag) {

            for ($i = 0; $i < $length; $i++) {
                $result = 0;
                if ($i < $min) {
                    if ($dataPettyIn[$i]->date == $dataPettyOut[$i]->date) {
                        $result = floatval($dataPettyIn[$i]->total) - floatval($dataPettyOut[$i]->total);
                    }
                } else {
                    $result = floatval($dataPettyIn[$i]->total);
                }

                array_push($output, array($dataPettyIn[$i]->date => number_format($result, 0)));
            }
        } else {


            for ($i = 0; $i < $length; $i++) {
                $result = 0;
                if ($i < $min) {
                    if ($dataPettyIn[$i]->date == $dataPettyOut[$i]->date) {
                        $result = floatval($dataPettyIn[$i]->total) - floatval($dataPettyOut[$i]->total);
                    }
                } else {
                    $result = floatval($dataPettyOut[$i]->total);
                }

                array_push($output, array($dataPettyOut[$i]->date => number_format($result, 0)));
            }
        }

        return $output;
    }



    public function getDataHistory()
    {
        /*
        $dataPettyIn  = $this->petty_in_model->getDataByDate($_POST);
        $dataPettyOut  = $this->petty_out_model->getDataByDate($_POST);

        $dataPettyInTot  = $this->petty_in_model->getSaldoByDate($_POST);
        $dataPettyOutTot = $this->petty_out_model->getSaldoByDate($_POST);

        $data = array(
            "data_in" => $dataPettyIn,
            "data_out" => $dataPettyOut,
            "in_tot" => $dataPettyInTot,
            "out_tot" => $dataPettyOutTot,
            "result" => "ok"
        );

        echo json_encode($data);
        */
        $data_post = $_POST;

        $batasTampilData = $_POST['batastampil'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;
        
        $dataPettyIn = $this->petty_in_model->getData($data_post['create_date'], $_POST['keyword'], $halamanAwal, $batasTampilData);
        $dataPettyInCount = $this->petty_in_model->getDataCount($data_post['create_date'], $_POST['keyword']);
        $dataPettyInTot  = $this->petty_in_model->getSaldoByDate($_POST);

        $dataPettyOut = $this->petty_out_model->getData($data_post['create_date'], $_POST['keyword'], $halamanAwal, $batasTampilData);
        $dataPettyOutCount = $this->petty_out_model->getDataCount($data_post['create_date'], $_POST['keyword']);
        $dataPettyOutTot = $this->petty_out_model->getSaldoByDate($_POST);

        $saldo = $this->petty_in_model->getSaldo();
        $saldo_current="";

        if (empty($saldo)) {
            $saldo_current = "0";
        } else {
            $saldo_current = $saldo[0]->saldo;
        }

        $output = array(
            "length_in" => count($dataPettyIn),
            "data_in" => $dataPettyIn,
            "in_tot" => $dataPettyInTot,
            "length_in_paging" => count($dataPettyInCount),
            "length_out" => count($dataPettyOut),
            "out_tot" => $dataPettyOutTot,
            "data_out" => $dataPettyOut,
            "length_out_paging" => count($dataPettyOutCount),
            "saldo"=> $saldo_current
        );


        echo json_encode($output);
    }
}
