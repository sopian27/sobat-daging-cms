<?php

class PaymentOut extends CI_Controller{

    public function __construct() {  
        parent::__construct(); 

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/TRXPaymentOutModel','trx_payment_out_model'); 

    } 

    public function index(){

        $data['judul']   = 'Payment Out';
        $data['subMenu'] = "PAYMENT";
        $t = time();
        $data['date'] = date("d F Y", $t);
        $current_date = date("d/m/Y", $t);
        $trxData = $this->trx_payment_out_model->getTrxId();
        $trxId = $trxData[0]->trx_id;

        $lastNoUrut = substr($trxId, 5,4);
        $nextNoUrut = intval($lastNoUrut)+1;
        $kodePo = 'PPO-'. sprintf('%04s',$nextNoUrut)."/".$current_date;
        $data['kode_po'] = $kodePo;

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/payment/sidemenu', $data);
        $this->load->view('auth/payment/payment-out', $data);
        $this->load->view('auth/templates/footer');

    }


    public function getInvoiceData(){

        $trxData = $this->trx_payment_out_model->getInvoiceData($_POST);
        echo json_encode($trxData);
    }

    public function paymentOutSave(){

        $data_post = $_POST;

        $data=array(
            "id_trx_payment_out" =>  $data_post['id_trx_payment_out'],
            "no_invoice"=> $data_post['no_invoice'],
            "harga_total"=> $data_post['harga_total'],
            "nominal_bayar"=> $data_post['nominal_bayar'],
            "id_trx_payment_po"=> $data_post['id_trx_payment_po'],
            "create_date"=>date('YmdHis'),
            "update_date"=>date('YmdHis')
        );

        $this->trx_payment_out_model->insertData($data);

        redirect('payment-out');

    }

    public function loadHistoryPayment(){
        $trxData = $this->trx_payment_out_model->loadHistoryPayment($_POST);
        echo json_encode($trxData);
    }

}
?>