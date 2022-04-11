<?php

class HistoryExpenses extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/TRXExpensesModel', 'trx_expenses');
        $this->load->helper('download');
    }

    public function index()
    {

        $data['judul']   = 'History Expenses';
        $data['subMenu'] = "EXPENSES";
        $t = time();
        $data['date'] = date("d F Y", $t);
        
        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/expenses/sidemenu', $data);
        $this->load->view('auth/expenses/history-expenses', $data);
        $this->load->view('auth/templates/footer');
    }

    public function getDatabak()
    {

        $dataExpenses = array();
        $dataExpenses  = $this->trx_expenses->getDataExpensesByDate($_POST);
        $dataExpensesTot  = $this->trx_expenses->getDataSumExpensesByDate($_POST);

        $data = array(
            "data" => $dataExpenses,
            "dataTot" => $dataExpensesTot,
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

        $dataOp = $this->trx_expenses->getData($data_post['create_date'], $_POST['keyword'], $halamanAwal, $batasTampilData);
        $dataOpCount = $this->trx_expenses->getDataCount($data_post['create_date'], $_POST['keyword']);
        $dataExpensesTot  = $this->trx_expenses->getDataSumExpensesByDate($_POST);

        $dataMingguan = $this->trx_expenses->getDataSallary($data_post['create_date'], $_POST['keyword'],"1", $halamanAwal, $batasTampilData);
        $dataMingguanCount = $this->trx_expenses->getDataSallaryCount($data_post['create_date'], $_POST['keyword'],"1");

        $dataBulanan = $this->trx_expenses->getDataSallary($data_post['create_date'], $_POST['keyword'],"2", $halamanAwal, $batasTampilData);
        $dataBulananCount = $this->trx_expenses->getDataSallaryCount($data_post['create_date'], $_POST['keyword'],"2");

        //$dataPettyOut = $this->petty_out_model->getData($data_post['create_date'], $_POST['keyword'], $halamanAwal, $batasTampilData);
        //$dataPettyOutCount = $this->petty_out_model->getDataCount($data_post['create_date'], $_POST['keyword']);
        //$dataPettyOutTot = $this->petty_out_model->getSaldoByDate($_POST);

        $output = array(
            "length_op" => count($dataOp),
            "data_op" => $dataOp,
            "length_op_paging" => count($dataOpCount),
            "dataTot" => $dataExpensesTot,
            "length_minggu" => count($dataMingguan),
            "data_minggu" => $dataMingguan,
            "data_minggu_sum" => $dataMingguanCount,
            "length_minggu_paging" => count($dataMingguanCount),
            "length_bulan" => count($dataBulanan),
            "data_bulan" => $dataBulanan,
            "data_bulan_sum" => $dataBulananCount,
            "length_bulan_paging" => count($dataBulananCount)
        );


        echo json_encode($output);
    }


    function downloadFile()
    {

        $data_post = $_POST;
        $file = "uploads/".$data_post['filename'];
        //echo $file;
        /*
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
            exit;
        } else {
            echo "File does not exists";
        }
        */

        force_download($file,NULL);
    }
}
