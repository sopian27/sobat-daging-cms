<?php
class Inventory extends CI_Controller
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
        //$countData = $this->trx_brg_model->getTrxId();
        $countDataBarang = $this->brg_model->countDataBarang();

        $trxData = $this->trx_brg_model->getTrxId();
        $trxId = $trxData[0]->trx_id;
        $lastNoUrut = substr($trxId, 5, 4);
        $nextNoUrut = intval($lastNoUrut) + 1;
        $t = time();
        $currentDate = date("d/m/Y", $t);
        $kodeInvoice = 'IPO-' . sprintf('%04s', $nextNoUrut) . "/" . $currentDate;

        $dataBarangCount =  $countDataBarang[0]->CountData;
        /*
        $num = $countData[0]->trx_id;
        $lastNoUrut = substr($num, -4);
        $nextNoUrut = intval($lastNoUrut)+1;
        $num_padded = sprintf("%04d", $nextNoUrut);
        */

        //$t = time();
        //$currentDate = date("d/m/Y", $t);
        $data['judul'] = 'Create PO';
        $data['id_trx_po'] = $kodeInvoice;
        $data['date'] = date("d F Y", $t);
        $data['dataBarangCount'] = $dataBarangCount;

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/inventory/sidemenu', $data);
        $this->load->view('auth/inventory/inventory-create-po', $data);
        $this->load->view('auth/templates/footer');
    }

    public function inventorySaveSupplier(){

        $data_post = $_POST;

        $where_sup = array(
            "nama" => trim($data_post['nama_supplier']),
            "pic" => trim($data_post['pic']),
            "no_hp" => trim($data_post['no_hp'])
        );

        $data_sup = array(
            "nama" => $data_post['nama_supplier'],
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

        $output=array(
            "result"=>"ok",
            "id"=>$getSupplierId
        );

        
        echo json_encode($output);

    }

    public function inventorySaveInvMenu()
    {

        $data_post = $_POST;

       
        $data_brg_po = array(
            "kode" => $data_post['kode'],
            "nama_barang"=> $data_post['nama_barang'],
            "satuan"=> $data_post['satuan'],
            "quantity" => $data_post['quantity'],
            "id_trx_po" => $data_post['id_trx_po'],
            "id_supplier" => $data_post['id_supplier'],
            "status" => $data_post['status'],
            "create_date" => date('YmdHis'),
            "update_date" => date('YmdHis')
        );

        /*
        if ($this->trx_brg_model->insertData($data_brg_po) > 0) {
            echo json_encode("success");
        } else {
            echo json_encode("failed");
        }
        */
        $this->trx_brg_model->insertData($data_brg_po);
        echo json_encode("success");

    }
    
}
