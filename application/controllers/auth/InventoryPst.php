<?php
class InventoryPst extends CI_Controller
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

    // Create PO
    public function index()
    {
        $data['judul']      = 'Update Stock PST';

        $t = time();
        $data['tanggal'] = date("d/m/Y", $t);
        //$trx_pst_pusat = $this->pst_pusat_model->getTrxId();
        //$trx_pst_sobat = $this->pst_sobat_model->getTrxId();

        $trxData = $this->pst_pusat_model->getTrxId();
        $trxId = $trxData[0]->trx_id;
        $lastNoUrut = substr($trxId, 5, 4);
        $nextNoUrut = intval($lastNoUrut) + 1;
        $t = time();
        $currentDate = date("d/m/Y", $t);
        $trx_pst_pusat = 'IUS-' . sprintf('%04s', $nextNoUrut) . "/" . $currentDate;

        $trxDataSobat = $this->pst_sobat_model->getTrxId();
        $trxIdSobat = $trxDataSobat[0]->trx_id;
        $lastNoUrutSobat = substr($trxIdSobat, 5, 4);
        $nextNoUrutSobat = intval($lastNoUrutSobat) + 1;
        $trx_pst_sobat = 'IPST-' . sprintf('%04s', $nextNoUrutSobat) . "/" . $currentDate;
       
        //$num = $trx_pst_pusat[0]->trx_id + 1;
        //$num_padded = sprintf("%04d", $num);
        //$data['id_trx_pst'] = "IUS-" . $num_padded . "/" . $data['tanggal'];
         $data['id_trx_pst'] = $trx_pst_pusat;

        //$num = $trx_pst_sobat[0]->trx_id + 1;
        //$num_padded = sprintf("%04d", $num);
        //$data['id_trx_sobat'] = "IPST-" . $num_padded . "/" . $data['tanggal'];
        $data['id_trx_sobat'] = $trx_pst_sobat;

        $data['date'] = date("d F Y", $t);

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/inventory/sidemenu', $data);
        $this->load->view('auth/inventory/inventory-stock-pst', $data);
        $this->load->view('auth/templates/footer');
    }

    public function getPstDataPusat()
    {

        $batasTampilData = $_POST['batastampil'];
        $id_trx_pst = $_POST['id_trx_pst'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;

        $allDataPo = $this->pst_pusat_model->getTrxPusat($id_trx_pst, $halamanAwal, $batasTampilData);
        $allDataPoCounter = $this->pst_pusat_model->getTrxPusatCount($id_trx_pst);
        $output = array(
            "length" => count($allDataPo),
            "data" => $allDataPo,
            "length_paging" => count($allDataPoCounter)

        );

        echo json_encode($output);
    }

    public function getPstDataSobat()
    {

        $batasTampilData = $_POST['batastampil'];
        $id_trx_sobat = $_POST['id_trx_sobat'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;

        $allDataPo = $this->pst_sobat_model->getTrxSobat($id_trx_sobat, $halamanAwal, $batasTampilData);
        $allDataPoCounter = $this->pst_sobat_model->getTrxSobatCount($id_trx_sobat);
        $output = array(
            "length" => count($allDataPo),
            "data" => $allDataPo,
            "length_paging" => count($allDataPoCounter)

        );

        echo json_encode($output);
    }

    public function getPstData(){

        $dataPusat = $this->pst_pusat_model->getPstData();
        $dataSobat = $this->pst_sobat_model->getPstData();

        $output = array(
            "data_pusat"=>$dataPusat,
            "data_sobat"=>$dataSobat,
        );

        echo json_encode($output);
    }

    public function pusatSave(){

        $post = $_POST;
        $data=array(
            "kode"            => $post['kode'],
            "create_date"     => date('YmdHis'),
            "update_date"     => date('YmdHis'),
            "quantity"        => $post['quantity_pusat'],
            "update_quantity" => $post['quantity_update'],
            "note"            => $post['note'],
            "trx_pst_pusat"   => $post['id_trx_pusat'],
            "status"          => "0"
        );

        $this->pst_pusat_model->insertData($data);

        echo json_encode("success");
    }

    public function sobatSave(){
        $post = $_POST;
        $data=array(
            "kode"            => $post['kode'],
            "create_date"     => date('YmdHis'),
            "update_date"     => date('YmdHis'),
            "quantity"        => $post['quantity_sobat'],
            "update_quantity" => $post['quantity_update'],
            "note"            => $post['note'],
            "trx_pst_sobat"   => $post['id_trx_sobat'],
            "status"          => "0"
        );

        $this->pst_sobat_model->insertData($data);

        echo json_encode("success");
    }


    public function clearAll()
    {

        $data_post = $_POST;
        $where = array("status" =>"0");

        $this->pst_pusat_model->deleteData($where);

        echo json_encode("success");
    }

    public function confirmData(){

        $where = array("status" => '0');
        $dataUpdate = array(
            "status"            =>  "1"
        );

        $this->pst_pusat_model->update($dataUpdate, $where);
        echo json_encode("success");
    }

    public function clearAllSobat()
    {

        $data_post = $_POST;
        $where = array("status" =>"0");

        $this->pst_sobat_model->deleteData($where);

        echo json_encode("success");
    }

    public function confirmDataSobat(){

        $where = array("status" => '0');
        $dataUpdate = array(
            "status"            =>  "1"
        );

        $this->pst_sobat_model->update($dataUpdate, $where);
        echo json_encode("success");
    }

    public function saveInventoryPst(){
        
        $post = $_POST;
        $type = $post['type'];

        $trxData = $this->pst_pusat_model->getTrxIdPst();
        $trxId = $trxData[0]->trx_id;
        $lastNoUrut = substr($trxId, 5, 4);
        $nextNoUrut = intval($lastNoUrut) + 1;
        $t = time();
        $currentDate = date("d/m/Y", $t);
        $kodeInvoice = 'IPO-' . sprintf('%04s', $nextNoUrut) . "/" . $currentDate;

        $id_supplier = $this->inventorySaveSupplier($post);

        if($type==1){
            
            $data=array(
                "kode"            => $post['kode'],
                "create_date"     => date('YmdHis'),
                "update_date"     => date('YmdHis'),
                "quantity_pusat"  => $post['quantity'],
                "nama_barang"     => $post['nama_barang'],
                "quantity_sobat"  => 0,
                "note"            => $post['note'],
                "satuan"          => $post['satuan'],
                "harga_satuan"    => $post['harga_satuan'],
                "id_supplier"     => $id_supplier,
                "trx_id"          => $kodeInvoice
            );
        }else{
                
            $data=array(
                "kode"            => $post['kode'],
                "create_date"     => date('YmdHis'),
                "update_date"     => date('YmdHis'),
                "quantity_sobat"  => $post['quantity'],
                "quantity_pusat"  => 0,
                "nama_barang"     => $post['nama_barang'],
                "note"            => $post['note'],
                "satuan"          => $post['satuan'],
                "harga_satuan"    => $post['harga_satuan'],
                "id_supplier"     => $id_supplier,
                "trx_id"          => $kodeInvoice
            );

        }
        $this->pst_pusat_model->insertDataPst($data);

        echo json_encode("success");
    }

    public function inventorySaveSupplier($data_post){

        $where_sup = array(
            "nama" => trim($data_post['nama']),
            "pic" => trim($data_post['pic']),
            "no_hp" => trim($data_post['no_hp'])
        );

        $data_sup = array(
            "nama" => $data_post['nama'],
            "pic" => trim($data_post['pic']),
            "no_hp" => trim($data_post['no_hp']),
            "create_date" => date('YmdHis'),
            "update_date" => date('YmdHis')
        );

        $getSupplierId = $this->sup_model->getWhere($where_sup);

        if (empty($getSupplierId)) {
            $getSupplierId = $this->sup_model->insertData($data_sup);
        } else {
            $getSupplierId = $getSupplierId[0]->id;
        }

        return $getSupplierId;

    }
    
}
