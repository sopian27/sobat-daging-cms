<?php

class PaymentHistory extends CI_Controller{

    public function __construct() {  
        parent::__construct(); 

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/TRXPaymentInModel','trx_payment_in_model');    
        $this->load->model('auth/TRXPaymentOutModel','trx_payment_out_model');    
        $this->load->model('auth/HistoryOrderModel','history_order_model');    
        $this->load->model('auth/TRXPaymentInvoiceModel','trx_payment_inv_model');    
        $this->load->model('auth/TRXBarangPoModel','trx_brg_po_model');    

    } 

    public function index(){

        $data['judul']   = 'History Payment';
        $data['subMenu'] = "PAYMENT";
        $t = time();
        $data['date'] = date("d F Y", $t);
        $title = "History Payment Bulan ";

        /*
        if(isset($_POST['create_date'])){
            $data['title']= $title;
            $data['flag']= true;
            $data['date_show_data'] = $_POST['create_date'];
            $post_data=array("date_choosen"=>$_POST['create_date']);
            $data['payIn']=$this->trx_payment_in_model->getTrxPaymentIn($post_data);
            $data['payOut']=$this->trx_payment_out_model->getTrxPaymentOut($post_data);
            
            $payOutTot  =$this->trx_payment_out_model->getTotTrxPaymentOut($post_data);
            $payInTot   =$this->trx_payment_in_model->getTotTrxPaymentIn($post_data);

            
            if(!empty($payInTot)) {
                $data['payInTot'] = $payInTot['0']['total'];
            }else{
                $data['payInTot'] = 0;
            }

            if(!empty($payOutTot)) {
                $data['payOutTot'] = $payOutTot['0']['total'];
            }else{
                $data['payOutTot'] = 0;
            }

            $data['payCus']=$this->trx_payment_in_model->getInvoiceCustomer($post_data);
            $data['payPay']=$this->trx_payment_in_model->getInvoicePayment($post_data);
        
        }
        */

        /*
        if(isset($_POST['no_surat_jalan']) && $_POST['no_surat_jalan']!=""){
            $data['no_surat_jalan'] = $_POST['no_surat_jalan'];
            $post_data=array("no_surat_jalan"=> $_POST['no_surat_jalan']);
            $data['historyOrderData'] = $this->history_order_model->getHistoryOrderDetailTrxBySsj($post_data);
            $data['sumTotal']=$this->trx_payment_inv_model->getSumTotal($post_data);

            $this->load->view('auth/templates/header', $data);
            $this->load->view('auth/templates/payment/sidemenu', $data);
            $this->load->view('auth/payment/payment-invoice-co-history', $data);
            $this->load->view('auth/templates/footer');
        }

        if(isset($_POST['kode_po']) && $_POST['kode_po']!=""){
            $data['kode_po'] = $_POST['kode_po'];
            $data['historyOrderData'] = $this->trx_brg_po_model->getDataByIdTrx($_POST['kode_po']);
            $data['sumTotal']=$this->trx_brg_po_model->getSumTotal($_POST['kode_po']);

            $this->load->view('auth/templates/header', $data);
            $this->load->view('auth/templates/payment/sidemenu', $data);
            $this->load->view('auth/payment/payment-invoice-po-history', $data);
            $this->load->view('auth/templates/footer');
    
        }

        if(isset($_POST['data_search'])){
            //nanti di samain aja ya
            $data['date_show_data'] = "Search By ".$_POST['data_search'];
        }
        */

        //if(!isset($_POST['kode_po']) && !isset($_POST['no_surat_jalan'])){
            $this->load->view('auth/templates/header', $data);
            $this->load->view('auth/templates/payment/sidemenu', $data);
            $this->load->view('auth/payment/payment-history', $data);
            $this->load->view('auth/templates/footer');
    
        //}

    }

    public function getHistoryPayment(){
        
        $data['date_show_data'] = $_POST['create_date'];
        $post_data=array("date_choosen"=>$_POST['create_date']);
        
        $payIn=$this->trx_payment_in_model->getTrxPaymentIn($post_data);
        $payOut=$this->trx_payment_out_model->getTrxPaymentOut($post_data);
        
        $payOutTot=$this->trx_payment_out_model->getTotTrxPaymentOut($post_data);
        $payInTot=$this->trx_payment_in_model->getTotTrxPaymentIn($post_data);

        $payCo=$this->trx_payment_in_model->getInvoiceCustomer($post_data);
        $payPo=$this->trx_payment_in_model->getInvoicePayment($post_data);

        $output = array(
            "payin" => $payIn,
            "payout" => $payOut,
            "payouttot" => $payOutTot,
            "payintot" => $payInTot,
            "payco" => $payCo,
            "paypo" => $payPo
        );

        echo json_encode($output);
        
        
    }


    public function getInvoiceData(){

        $trxData = $this->trx_payment_in_model->getInvoiceData($_POST);
        echo json_encode($trxData);
    }

    public function paymentInSave(){

        $data_post = $_POST;

        $data=array(
            "id_trx_payment_in" =>  $data_post['id_trx_payment_in'],
            "no_invoice"=> $data_post['no_invoice'],
            "harga_total"=> $data_post['harga_total'],
            "nominal_bayar"=> $data_post['nominal_bayar'],
            "id_trx_payment_co"=> $data_post['id_trx_payment_co'],
            "create_date"=>date('YmdHis'),
            "update_date"=>date('YmdHis')
        );

        $this->trx_payment_in_model->insertData($data);

    }

    public function loadHistoryPayment(){
        $trxData = $this->trx_payment_in_model->loadHistoryPayment($_POST);
        echo json_encode($trxData);
    }

}
?>