<?php
class InventoryLiveStock extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/TRXBarangPoModel', 'trx_brg_model');
        $this->load->model('auth/BarangModel', 'brg_model');
        $this->load->model('auth/SupplierModel', 'sup_model');
        $this->load->model('auth/TRXPSTPusatModel', 'pst_pusat_model');
        $this->load->model('auth/TRXPSTSobatModel', 'pst_sobat_model');
    }

    public function index()
    {
        $countData = $this->trx_brg_model->getTrxId();
        $countDataBarang = $this->brg_model->countDataBarang();

        $dataBarangCount =  $countDataBarang[0]->CountData;
        $num = $countData[0]->trx_id + 1;
        $num_padded = sprintf("%04d", $num);

        $t = time();
        $currentDate = date("d/m/Y", $t);
        $data['judul'] = 'Live Stock';
        $data['id_trx_po'] = "ILS-" . $num_padded . "/" . $currentDate;
        $data['date'] = date("d F Y", $t);
        $data['dataBarangCount'] = $dataBarangCount;

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/inventory/sidemenu', $data);
        $this->load->view('auth/inventory/inventory-live-stocks', $data);
        $this->load->view('auth/templates/footer');
    }

    public function getTrxId()
    {

        $trxData = $this->trx_brg_model->getTrxId();
        $trxId = $trxData[0]->trx_id;
        $lastNoUrut = substr($trxId, 5, 4);
        $nextNoUrut = intval($lastNoUrut) + 1;
        $t = time();
        $currentDate = date("d/m/Y", $t);
        $kodeInvoice = 'INV-PO' . sprintf('%04s', $nextNoUrut) . "/" . $currentDate;

        return $kodeInvoice;
    }


    public function getData()
    {

        $data_post = $_POST;

        $batasTampilData = $_POST['batastampil'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;

        $data = $this->trx_brg_model->getLiveStockData($data_post['create_date'], $_POST['keyword'], $halamanAwal, $batasTampilData);
        $dataCounter = $this->trx_brg_model->getLiveStockDataCount($data_post['create_date'], $_POST['keyword']);

        $output = array(
            "length" => count($data),
            "data" => $data,
            "length_paging" => count($dataCounter)

        );

        echo json_encode($output);
    }

    public function getDetailTrx()
    {

        $data_post = $_POST;
        $allDataPo = $this->trx_brg_model->getDataByIdLiveStockTrx($data_post['id_trx_po']);

        echo json_encode($allDataPo);
    }

    public function getDetail()
    {

        $data_post = $_POST;
        $batasTampilData = $_POST['batastampil'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;

        $data_post = $_POST;
        $allDataPo = $this->trx_brg_model->getDataByIdLiveStock($data_post['id_trx_po'], $halamanAwal, $batasTampilData);
        $allDataPoCounter = $this->trx_brg_model->getDataByIdLiveStockCounter($data_post['id_trx_po']);

        $output = array(
            "length" => count($allDataPo),
            "data" => $allDataPo,
            "length_paging" => count($allDataPoCounter),
        );

        echo json_encode($output);
    }

    public function updateQuantityCheck()
    {

        $data_post = $_POST;
        $where = array(
            "id"        => $data_post['id'],
            "id_trx_po" => $data_post['id_trx_po']
        );

        $dataUpdate = array(
            "quantity_check"   => $data_post['quantity_check'],
            "satuan"           => $data_post['satuan'],
            "status"           =>  "4"
        );

        $this->trx_brg_model->update($dataUpdate, $where);

        echo json_encode("success");
    }

    public function clearAll()
    {

        $data_post = $_POST;
        $where = array("id_trx_po" => $data_post['id_trx_po']);

        $dataUpdate = array(
            "status"            =>  "3",
            "quantity_check"    => 0
        );

        $this->trx_brg_model->update($dataUpdate, $where);

        echo json_encode("success");
    }

    public function confirmData()
    {

        $data_post = $_POST;
        $no_invoice = $this->getTrxId();

        $where = array(
            "id_trx_po" => $data_post['id_trx_po'],
            "harga_satuan !=" => 0    
        );
        $dataUpdate = array(
            "id_trx_live_stocks"  => $data_post['id_trx_live_stocks'],
            "no_invoice"          => $no_invoice
        );

        $this->trx_brg_model->update($dataUpdate, $where);

        $data = $this->trx_brg_model->getWhereTrxId($where);
        $dataInsert = array();
        $dataUpdate = array();

        foreach ($data as $d) {
            $isExist = array("kode" => $d->kode);
            $res = $this->brg_model->getWhere($isExist);

            if (empty($res)) {
                $dataInsert[] = $d;
            } else {
                $dataUpdate[] = $d;
            }
        }

        if (count($dataInsert) > 0) {
            $this->brg_model->insertDataBatch($dataInsert);
        }

        if (count($dataUpdate) > 0) {
            $this->brg_model->updateTriggerExistingBarang($dataUpdate);
        }

        echo json_encode("success");
    }


    public function insertQuantityCheck()
    {

        $data_post = $_POST;
        $where_insert = array();
        $no_invoice = $this->getTrxId();

        for ($i = 0; $i < count($data_post["id_trx_live_stocks"]); $i++) {

            $where = array("id" => $data_post['id'][$i]);
            $where_insert[] = $data_post['id'][$i];
            $dataUpdate = array(
                "quantity_check"      => $data_post['quantity_check'][$i],
                "satuan"              => $data_post['satuan'][$i],
                "id_trx_live_stocks"  => $data_post['id_trx_live_stocks'][$i],
                "no_invoice"          => $no_invoice,
                "status"              => "1"
            );

            $this->trx_brg_model->update($dataUpdate, $where);
        }

        $data = $this->trx_brg_model->getWhereIn($where_insert);
        $dataInsert = array();
        $dataUpdate = array();

        foreach ($data as $d) {
            $isExist = array("kode" => $d->kode);
            $res = $this->brg_model->getWhere($isExist);

            if (empty($res)) {
                $dataInsert[] = $d;
            } else {
                $dataUpdate[] = $d;
            }
        }

        if (count($dataInsert) > 0) {
            $this->brg_model->insertDataBatch($dataInsert);
        }

        if (count($dataUpdate) > 0) {
            $this->brg_model->updateTriggerExistingBarang($dataUpdate);
        }

        redirect('inventory-livestock');
    }
}
