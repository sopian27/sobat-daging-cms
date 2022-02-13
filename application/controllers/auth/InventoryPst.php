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
        $trx_pst_pusat = $this->pst_pusat_model->getTrxId();
        $trx_pst_sobat = $this->pst_sobat_model->getTrxId();
       
        $num = $trx_pst_pusat[0]->trx_id + 1;
        $num_padded = sprintf("%04d", $num);
        $data['id_trx_pst'] = "IUS-" . $num_padded . "/" . $data['tanggal'];

        $num = $trx_pst_sobat[0]->trx_id + 1;
        $num_padded = sprintf("%04d", $num);
        $data['id_trx_sobat'] = "IPST-" . $num_padded . "/" . $data['tanggal'];

        $data['date'] = date("d F Y", $t);

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/inventory/sidemenu', $data);
        $this->load->view('auth/inventory/inventory-stock-pst', $data);
        $this->load->view('auth/templates/footer');
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
            "kode"            => $post['pusat_kode'],
            "create_date"     => date('YmdHis'),
            "update_date"     => date('YmdHis'),
            "quantity"        => $post['pusat_stock'],
            "update_quantity" => $post['pusat_stock_update'],
            "note"            => $post['pusat_note'],
            "trx_pst_pusat"   => $post['trx_pst_pusat']
        );

        $this->pst_pusat_model->insertData($data);

        redirect('inventory-updatestockpst');
    }

    public function sobatSave(){
        $post = $_POST;
        $data=array(
            "kode"            => $post['sobat_kode'],
            "create_date"     => date('YmdHis'),
            "update_date"     => date('YmdHis'),
            "quantity"        => $post['sobat_stock'],
            "update_quantity" => $post['sobat_stock_update'],
            "note"            => $post['sobat_note'],
            "trx_pst_sobat"   => $post['trx_pst_sobat']
        );

        $this->pst_sobat_model->insertData($data);

        redirect('inventory-updatestockpst');
    }
    
}
