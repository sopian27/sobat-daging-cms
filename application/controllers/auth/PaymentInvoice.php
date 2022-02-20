<?php

class PaymentInvoice extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/TRXPaymentInModel', 'trx_payment_in_model');
        $this->load->model('auth/HistoryOrderModel', 'history_order_model');
        $this->load->model('auth/TRXPaymentInvoiceModel', 'trx_payment_inv_model');
        $this->load->model('auth/TRXBarangPoModel', 'trx_brg_po_model');
        $this->load->model('auth/LiveOrderModel', 'lv_model');
        $this->load->model('auth/TRXBarangPoModel', 'trx_brg_model');
        $this->load->library('Fungsi');
    }

    public function index()
    {

        $data['judul']   = 'Invoice';
        $data['subMenu'] = "PAYMENT";
        $t = time();
        $data['date'] = date("d F Y", $t);
        $current_date = date("d/m/Y", $t);
        $trxData = $this->trx_payment_inv_model->getTrxId();
        $trxDataPo = $this->trx_payment_inv_model->getTrxIdPo();
        $trxId = $trxData[0]->trx_id;
        $trxIdPo = $trxDataPo[0]->trx_id;

        $lastNoUrut = substr($trxId, 5, 4);
        $nextNoUrut = intval($lastNoUrut) + 1;
        $kodePo = 'PIC-' . sprintf('%04s', $nextNoUrut) . "/" . $current_date;
        $data['no_invoice_co'] = $kodePo;

        $lastNoUrutPo = substr($trxIdPo, 5, 4);
        $nextNoUrutPo = intval($lastNoUrutPo) + 1;
        $kodePoPo = 'PIP-' . sprintf('%04s', $nextNoUrutPo) . "/" . $current_date;
        $data['no_invoice_co_po'] = $kodePoPo;

        /*

        if(isset($_POST['no_surat_jalan'])){
            $data['no_surat_jalan'] = $_POST['no_surat_jalan'];
            $post_data=array("no_surat_jalan"=> $_POST['no_surat_jalan']);
            $data['historyOrderData'] = $this->trx_payment_inv_model->getNoSuratJalanData($post_data);
            $data['sumTotal']=$this->trx_payment_inv_model->getSumTotal($post_data);

            $this->load->view('auth/templates/header', $data);
            $this->load->view('auth/templates/payment/sidemenu', $data);
            $this->load->view('auth/payment/payment-invoice-co', $data);
            $this->load->view('auth/templates/footer');
        }

        if(isset($_POST['kode_po'])){
            $data['kode_po'] = $_POST['kode_po'];
            $data['historyOrderData'] = $this->trx_brg_po_model->getDataByIdTrxPayment($_POST['kode_po']);
            $data['sumTotal']=$this->trx_brg_po_model->getSumTotal($_POST['kode_po']);

            $this->load->view('auth/templates/header', $data);
            $this->load->view('auth/templates/payment/sidemenu', $data);
            $this->load->view('auth/payment/payment-invoice-po', $data);
            $this->load->view('auth/templates/footer');
    
        }
        */

        // if(!isset($_POST['kode_po']) && !isset($_POST['no_surat_jalan'])){
        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/payment/sidemenu', $data);
        $this->load->view('auth/payment/payment-invoice', $data);
        $this->load->view('auth/templates/footer');
        //} 
    }


    public function getNoSuratJalan()
    {

        $noSuratJalan = $_POST['no_surat_jalan'];
        $batasTampilData = $_POST['batastampil'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;

        $data_surat_jln = $this->trx_payment_inv_model->getNoSuratJalanData($noSuratJalan, $halamanAwal, $batasTampilData);
        $data_surat_jln_counter = $this->trx_payment_inv_model->getNoSuratJalanDataCount($noSuratJalan);
        $sumTotal = $this->trx_payment_inv_model->getSumTotal($noSuratJalan);
        //$isExist = $this->trx_payment_inv_model->checkSuratJlnIsExist($noSuratJalan);

        $output = array(
            "data_surat_jln"  =>  $data_surat_jln,
            "length         " => count($data_surat_jln),
            "length_paging" => count($data_surat_jln_counter),
            "sum_total"       => $sumTotal
        );

        echo json_encode($output);
    }

    public function getKodePo()
    {

        $kode_po = $_POST['kode_po'];
        $batasTampilData = $_POST['batastampil'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;

        $data_kode_po = $this->trx_payment_inv_model->getKodeData($kode_po, $halamanAwal, $batasTampilData);
        $data_kode_po_counter = $this->trx_payment_inv_model->getKodeDataCounter($kode_po);
        $sumTotal = $this->trx_payment_inv_model->getSumTotalPo($kode_po);
        //$isExist = $this->trx_payment_inv_model->checKodePoIsExist($post_data);

        $output = array(
            "data_kode_po"  =>  $data_kode_po,
            "length         " => count($data_kode_po),
            "length_paging" => count($data_kode_po_counter),
            "sum_total"       => $sumTotal
        );

        echo json_encode($output);
    }

    public function getNoSuratJalanHistory()
    {

        $post_data = array("no_surat_jalan" => $_POST['no_surat_jalan']);
        $historyOrderData = $this->history_order_model->getHistoryOrderDetailTrxBySsj($post_data);
        $sumTotal = $this->trx_payment_inv_model->getSumTotal($post_data);

        $output = array(
            "data_surat_jln" => $historyOrderData,
            "sum_total" => $sumTotal,
            "result" => "ok"
        );

        echo json_encode($output);
    }

    public function getKodePoHistory()
    {


        $post_data['kode_po'] = $_POST['kode_po'];
        $data_kode_po = $this->trx_brg_po_model->getKodePoHistory($post_data['kode_po']);
        $sumTotal = $this->trx_brg_po_model->getSumTotal($post_data['kode_po']);

        $output = array();

        $output = array(
            "data_kode_po" => $data_kode_po,
            "sum_total" => $sumTotal,
            "result" => "ok"
        );

        echo json_encode($output);
    }

    /*
    public function co_detail(){

        $t = time();
        $data['date'] = date("d F Y", $t);
        $data['no_invoice_co']=$_POST['no_invoice_co'];
        $data['judul']   = 'Invoice Customer';
        $data['subMenu'] = "Payment";
        $data['historyOrderData'] = $this->model_auth('HistoryOrderModel')->getHistoryOrderDetailTrxBySsj($_POST);
        $data['no_invoice_co']=$_POST['no_invoice_co'];
        $data['sumTotal']=$this->trx_payment_inv_model->getSumTotal($_POST);
        //$data['jatuh_tempo_add']=date("d F Y", strtotime("+7 day"));

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/payment/sidemenu-detail', $data);
        $this->load->view('/payment/payment-invoice-co', $data);
        $this->load->view('auth/templates/footer');

    }

    public function po_detail(){

        $t = time();
        $data['date'] = date("d F Y", $t);
        $data['kode_po']=$_POST['kode_po'];
        $data['no_invoice_co_po']=$_POST['no_invoice_co_po'];
        $data['judul']   = 'Invoice Pembelian';
        $data['subMenu'] = "Payment";
        $data['historyBarangData'] = $this->trx_brg_po_model->getDataByIdTrx($_POST['kode_po']);
        $data['sumTotal']=$this->trx_brg_po_model->getSumTotal($_POST['kode_po']);

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/payment/sidemenu-detail', $data);
        $this->load->view('/payment/payment-invoice-po', $data);
        $this->load->view('auth/templates/footer');

    }
    */

    public function trxNoSuratJalanSave()
    {

        $data_post = $_POST;

        $data_save = array(
            "id_trx_payment" => $data_post['id_trx_payment'],
            "no_surat_jalan" => $data_post['no_surat_jalan'],
            "total_tagihan"  => $data_post['total_tagihan'],
            "total_tagihan_history"  => $data_post['total_tagihan'],
            "bank_tujuan"    => $data_post['bank_tujuan'],
            "no_rekening"    => $data_post['no_rekening'],
            "atas_nama"      => $data_post['atas_nama'],
            "bonus"          => str_replace(",", "", $data_post['bonus']),
            "jatuh_tempo"    => $data_post['jatuh_tempo'],
            "create_date"    => date('YmdHis'),
            "update_date"    => date('YmdHis')
        );

        $res = $this->trx_payment_inv_model->insertDataCustomer($data_save);

        if ($res > 0) {

            $data_post = $_POST;
            $where = array(
                "no_surat_jalan" => $data_post['no_surat_jalan']
            );

            $dataUpdate = array(
                "status"           =>  "3"
            );

            $this->lv_model->update($dataUpdate, $where);

            echo json_encode("success");
        }

        /*
        if ($res > 0) {

            $post_data = array("no_surat_jalan" => $_POST['no_surat_jalan']);
            $data['historyOrderData'] = $this->history_order_model->getHistoryOrderDetailTrxBySsj($post_data);
            $data['sumTotal'] = $this->trx_payment_inv_model->getSumTotal($post_data);

            $data['judul']   = 'Invoice';
            $data['subMenu'] = "PAYMENT";
            $t = time();
            $data['date'] = date("YmdHis");

            $this->load->view('auth/templates/header', $data);
            $this->load->view('auth/templates/payment/sidemenu', $data);
            $this->load->view('auth/payment/payment-invoice-co-print', $data);
            $this->load->view('auth/templates/footer');
        } else {
            redirect('payment-invoice');
        }

        */
    }


    public function printPreview()
    {

        $post_data = array("no_surat_jalan" => $_POST['no_surat_jalan']);
        $data['historyOrderData'] = $this->history_order_model->getHistoryOrderDetailTrxBySsj($post_data);
        $data['sumTotal'] = $this->trx_payment_inv_model->getSumTotal($post_data);

        $data['judul']   = 'Invoice';
        $data['subMenu'] = "PAYMENT";
        $t = time();
        $data['date'] = date("YmdHis");

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/payment/sidemenu', $data);
        $this->load->view('auth/payment/payment-invoice-co-print', $data);
        $this->load->view('auth/templates/footer');
    }


    public function printData()
    {

        $html = "";
        $data['date'] = date("YmdHis");
        $post_data = array("no_surat_jalan" => $_POST['no_surat_jalan']);
        $data['historyOrderData'] = $this->history_order_model->getHistoryOrderDetailTrxBySsj($post_data);
        $data['sumTotal'] = $this->trx_payment_inv_model->getSumTotal($post_data);

        $this->load->view('auth/templates/header', $data);

        $html = $this->load->view('auth/payment/download-payment-invoice-co', $data, true);

        $this->fungsi->PdfGenerator($html, 'Payment Invoice Customer', 'A4', 'potrait');
    }

    public function trxKodePoSave()
    {

        $data_post = $_POST;

        $data_save = array(
            "id_trx_payment" => $data_post['no_invoice_co_po'],
            "id_trx_po"      => $data_post['kode_po'],
            "total_tagihan"  => $data_post['total_tagihan'],
            "total_tagihan_history"  => $data_post['total_tagihan'],
            "jatuh_tempo"    => $data_post['jatuh_tempo'],
            "no_invoice"    =>  $data_post['no_invoice'],
            "create_date"    => date('YmdHis'),
            "update_date"    => date('YmdHis')
        );

        $res = $this->trx_payment_inv_model->insertDataPembelian($data_save);

        if ($res > 0) {

            $where = array(
                "id_trx_po" => $data_post['kode_po']
            );
    
            $dataUpdate = array(
                "status"           =>  "5"
            );
    
            $this->trx_brg_model->update($dataUpdate, $where);
    
            echo json_encode("success");
            /*
            $post_data=array("kode_po"=> $_POST['kode_po']);
            $data['historyOrderData'] = $this->history_order_model->getHistoryOrderDetailTrxBySsj($post_data);
            $data['sumTotal']=$this->trx_payment_inv_model->getSumTotal($post_data);
    
            $data['judul']   = 'Invoice';
            $data['subMenu'] = "PAYMENT";
            $t = time();
            $data['date'] = date("YmdHis");

            $this->load->view('auth/templates/header', $data);
            $this->load->view('auth/templates/payment/sidemenu', $data);
            $this->load->view('auth/payment/payment-invoice-co-print', $data);
            $this->load->view('auth/templates/footer');
            */
            //redirect('payment-invoice');
        } else {
            //redirect('payment-invoice');
        }

    }
}
