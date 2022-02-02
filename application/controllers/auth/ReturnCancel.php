<?php

class ReturnCancel extends CI_Controller{

    public function __construct() {  
        parent::__construct(); 

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/TRXReturnModel','trx_ret_model');

    } 


    public function index(){

        $data['judul']   = 'Return Item';
        $data['subMenu'] = "Return/Cancel";
        $t = time();
        $data['date'] = date("d F Y", $t);
        $current_date = date("d/m/Y", $t);
        $trxData = $this->trx_ret_model->getTrxId();
        $trxId = $trxData[0]->trx_id;

        $lastNoUrut = substr($trxId, 5,4);
        $nextNoUrut = intval($lastNoUrut)+1;
        $kodePo = 'RRI-'. sprintf('%04s',$nextNoUrut)."/".$current_date;
        $data['kode_po'] = $kodePo;

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/return/sidemenu', $data);
        $this->load->view('auth/return/return-item', $data);
        $this->load->view('auth/templates/footer');

    }


    public function getInvoiceData(){

        $trxData = $this->trx_ret_model->getInvoiceData($_POST);
        echo json_encode($trxData);
    }

    public function saveData(){

        $data=array();

        for($i=0;$i<count($_POST['id_trx_po']);$i++){
            
            $id_barang =  $_POST['id_trx_po'][$i];

            $data= array(
                "no_invoice"=> $_POST['no_invoice'],
                "quantity_return"=> $_POST['quantity_return'][$i],
                "quantity_before"=> $_POST['quantity_before'][$i],
                "note"=> $_POST['note'][$i],
                "id_trx_return"=> $_POST['id_trx_return'],
                "satuan"=> $_POST['satuan_return'][$i],
                "id_trx_po"=> $_POST['id_trx_po'][$i],
                "tgl_return"=> $_POST['tgl_return'],
                "create_date"=>date('YmdHis'),
                "update_date"=>date('YmdHis')

            );

            if($id_barang != ""){
                 $this->trx_ret_model->insertData($data);
            }

        }

        redirect('return-cancel');

    }

}
?>