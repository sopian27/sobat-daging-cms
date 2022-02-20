<?php

class PaymentHistory extends CI_Controller{

    public function __construct() {  
        parent::__construct(); 

        date_default_timezone_set('Asia/Jakarta'); 
        $this->load->model('auth/TRXPaymentInHistoryModel','trx_payment_in_history_model');  
        $this->load->model('auth/TRXPaymentOutHistoryModel','trx_payment_out_history_model');  
        $this->load->library('Fungsi');

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
        
        $data_post = $_POST;
        $batasTampilData = $_POST['batastampil'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;

        $dataIn = $this->trx_payment_in_history_model->getTrxPaymentIn($data_post['create_date'], $_POST['keyword'], $halamanAwal, $batasTampilData);
        $dataInCounter = $this->trx_payment_in_history_model->getTrxPaymentInCount($data_post['create_date'], $_POST['keyword']);

        $dataInTot = $this->trx_payment_in_history_model->getTotTrxPaymentIn($data_post['create_date'], $_POST['keyword']);

        $dataCus = $this->trx_payment_in_history_model->getInvoiceCustomer($data_post['create_date'], $_POST['keyword'], $halamanAwal, $batasTampilData);
        $dataCusCounter = $this->trx_payment_in_history_model->getInvoiceCustomerCount($data_post['create_date'], $_POST['keyword']);

        $dataOut = $this->trx_payment_out_history_model->getTrxPaymentOut($data_post['create_date'], $_POST['keyword'], $halamanAwal, $batasTampilData);
        $dataOutCounter = $this->trx_payment_out_history_model->getTrxPaymentOutCount($data_post['create_date'], $_POST['keyword']);

        $dataOutTot = $this->trx_payment_out_history_model->getTotTrxPaymentOut($data_post['create_date'], $_POST['keyword']);

        $dataPo = $this->trx_payment_out_history_model->getInvoicePayment($data_post['create_date'], $_POST['keyword'], $halamanAwal, $batasTampilData);
        $dataPoCounter = $this->trx_payment_out_history_model->getInvoicePaymentCount($data_post['create_date'], $_POST['keyword']);
        

        $output = array(
            "length_in" => count($dataIn),
            "data_in" => $dataIn,
            "length_in_paging" => count($dataInCounter),
            "data_in_tot" => $dataInTot,
            "length_cus" => count($dataCus),
            "data_cus" => $dataCus,
            "length_cus_paging" => count($dataCusCounter),
            "length_out" => count($dataOut),
            "data_out" => $dataOut,
            "length_out_paging" => count($dataOutCounter),
            "data_out_tot" => $dataOutTot,
            "length_po" => count($dataPo),
            "data_po" => $dataPo,
            "length_po_paging" => count($dataPoCounter)
            
        );
    
        echo json_encode($output);
        
        
    }
    
    public function loadHistoryPayment(){
        $trxData = $this->trx_payment_in_history_model->loadHistoryPayment($_POST);
        $flag=false;

        if(empty($trxData)){
            $flag=true;
            $trxData = $this->trx_payment_in_history_model->getInvoiceData($_POST);
        }

        $output = array(
            "flag"=> $flag,
            "data"=>$trxData);

        echo json_encode($output);
    }


    public function loadHistoryPaymentOut(){
        $trxData = $this->trx_payment_out_history_model->loadHistoryPayment($_POST);
        $flag=false;
        
        if(empty($trxData)){
            $flag=true;
            $trxData = $this->trx_payment_out_history_model->getInvoiceData($_POST);
        }

        $output = array(
            "flag"=> $flag,
            "data"=>$trxData);

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

    
    public function getNoSuratJalanHistory()
    {

        $noSuratJalan = $_POST['no_surat_jalan'];
        $batasTampilData = $_POST['batastampil'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;

        $data_surat_jln = $this->trx_payment_in_history_model->getNoSuratJalanData($noSuratJalan, $halamanAwal, $batasTampilData);
        $data_surat_jln_counter = $this->trx_payment_in_history_model->getNoSuratJalanDataCount($noSuratJalan);
        $sumTotal = $this->trx_payment_in_history_model->getSumTotal($noSuratJalan);

        $output = array(
            "data_surat_jln"  =>  $data_surat_jln,
            "length         " => count($data_surat_jln),
            "length_paging" => count($data_surat_jln_counter),
            "sum_total"       => $sumTotal
        );

        echo json_encode($output);
    }

    public function getKodePoHistory()
    {

        $kode_po = $_POST['kode_po'];
        $batasTampilData = $_POST['batastampil'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;

        $data_kode_po = $this->trx_payment_out_history_model->getKodeData($kode_po, $halamanAwal, $batasTampilData);
        $data_kode_po_counter = $this->trx_payment_out_history_model->getKodeDataCounter($kode_po);
        $sumTotal = $this->trx_payment_out_history_model->getSumTotalPo($kode_po);

        $output = array(
            "data_kode_po"  =>  $data_kode_po,
            "length         " => count($data_kode_po),
            "length_paging" => count($data_kode_po_counter),
            "sum_total"       => $sumTotal
        );

        echo json_encode($output);
    }

    public function print(){
       
        $html="";
        $data_post=$_POST;

        $t = time();
        $data['date'] = date("d F Y", $t);
        $data['data'] = $this->trx_payment_in_history_model->getNoSuratJalanDataCount($data_post['no_surat_jln']);
        $data['sumTotal'] = $this->trx_payment_in_history_model->getSumTotal($data_post['no_surat_jln']);
        
        $html = $this->load->view('auth/payment/history-payment-customer-print',$data,true);

        $this->fungsi->PdfGenerator($html,'History Payment Customer','A4','landscape');
    }
}
?>