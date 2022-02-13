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
        $countData = $this->trx_brg_model->getTrxId();
        $num = $countData[0]->trx_id + 1;
        $num_padded = sprintf("%04d", $num);

        $t = time();
        $currentDate = date("d/m/Y", $t);
        $data['id_trx_po'] = "PO-" . $num_padded . "/" . $currentDate;
        $data['date'] = date("d F Y", $t);

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/inventory/sidemenu', $data);
        $this->load->view('auth/inventory/inventory-history', $data);
        $this->load->view('auth/templates/footer');
    }


    public function getData(){

        $data_post=$_POST;
        $data=$this->trx_brg_model->getHistoryPoData($data_post['create_date']);
        $output=array("data"=>$data,
                      "length"=>count($data));

        echo json_encode($output);
    }

    public function getHistoryData(){

        $data_post=$_POST;
        $data=$this->trx_brg_model->getDataByIdHistory($data_post['id_trx_po']);
        $output=array("data"=>$data,
                      "length"=>count($data));

        echo json_encode($output);
    }

}
