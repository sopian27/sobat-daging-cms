<?php
class InventoryHistory extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/TRXBarangPoModel', 'trx_brg_model');
        $this->load->model('auth/BarangModel', 'brg_model');
        $this->load->model('auth/SupplierModel', 'sup_model');
    }

    // history PO
    public function index()
    {
        
        $data['judul']  = 'History Po';
        //$countData = $this->trx_brg_model->getTrxId();
       // $num = $countData[0]->trx_id + 1;
       // $num_padded = sprintf("%04d", $num);

        $trxData = $this->trx_brg_model->getTrxId();
        $trxId = $trxData[0]->trx_id;
        $lastNoUrut = substr($trxId, 5, 4);
        $nextNoUrut = intval($lastNoUrut) + 1;
        $t = time();
        $currentDate = date("d/m/Y", $t);
        $kodeInvoice = 'PO-' . sprintf('%04s', $nextNoUrut) . "/" . $currentDate;

        //$dataBarangCount =  $countDataBarang[0]->CountData;

        $t = time();
        $currentDate = date("d/m/Y", $t);
        $data['id_trx_po'] = $kodeInvoice;//"PO-" . $num_padded . "/" . $currentDate;
        $data['date'] = date("d F Y", $t);

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/inventory/sidemenu', $data);
        $this->load->view('auth/inventory/inventory-history', $data);
        $this->load->view('auth/templates/footer');
    }


    public function getData(){

        $data_post = $_POST;

        $batasTampilData = $_POST['batastampil'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;

        $data = $this->trx_brg_model->getHistoryPoData($data_post['create_date'], $_POST['keyword'], $halamanAwal, $batasTampilData);
        $dataCounter = $this->trx_brg_model->getHistoryPoDataCount($data_post['create_date'], $_POST['keyword']);

        $output = array(
            "length" => count($data),
            "data" => $data,
            "length_paging" => count($dataCounter)

        );

        echo json_encode($output);

    }

    public function getHistoryData(){

        $data_post=$_POST;

        $batasTampilData = $_POST['batastampil'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;

        $allDataPo = $this->trx_brg_model->getDataByIdHistory($data_post['id_trx_po'], $halamanAwal, $batasTampilData);
        $allDataPoCounter = $this->trx_brg_model->getDataByIdHistoryCounter($data_post['id_trx_po']);
        $allDataPoSum = $this->trx_brg_model->getDataByIdHistorySum($data_post['id_trx_po']);

        $output = array(
            "length" => count($allDataPo),
            "data" => $allDataPo,
            "length_paging" => count($allDataPoCounter),
            "sum_data" => $allDataPoSum[0]->total,
        );

        echo json_encode($output);
    }

}
