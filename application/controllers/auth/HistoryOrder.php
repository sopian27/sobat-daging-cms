<?php

class HistoryOrder extends CI_Controller{

    public function __construct() {  
        parent::__construct(); 

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/HistoryOrderModel','hst_order_model');  
        $this->load->model('auth/LiveOrderModel','lv_model');     
        $this->load->library('Fungsi');  

    } 

    public function index(){

        $data['judul'] = 'History Order';
        $data['subMenu'] = "ORDER RECEIVED";

        /*
        if(isset($_POST['date_show'])){
            $data['date_show_data'] = $_POST['date_show'];
            $data['flag'] = "1";
            $post_data=array("date_choosen"=>$_POST['date_show']);
            $data['detailData']=$this->hst_order_model->getDataByDate($post_data);

        }

        if(isset($_POST['data_search'])){
            $data['date_show_data'] = "Search By ".$_POST['data_search'];
            $data['flag'] = "2";
            $post_data=array("keyword"=> $_POST['data_search']);
           // $data['detailData']=$this->hst_order_model->getDataByKeyword($post_data);
        }
        */

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/order-received/sidemenu', $data);
        $this->load->view('auth/order-received/history-order', $data);
        $this->load->view('auth/templates/footer');

    }

    public function getData(){

        $data_post = $_POST;

        $batasTampilData = $_POST['batastampil'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;

        $data = $this->hst_order_model->getDataHistoryOrder($data_post['create_date'], $_POST['keyword'], $halamanAwal, $batasTampilData);
        $dataCounter = $this->hst_order_model->getDataHistoryOrderCounter($data_post['create_date'], $_POST['keyword']);

        $output = array(
            "length" => count($data),
            "data" => $data,
            "length_paging" => count($dataCounter)

        );

        echo json_encode($output);

    }


    public function getHistoryData(){

        $data_post=$_POST;

        $batasTampilData = $_POST['batastampil'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;

        $allDataPo = $this->hst_order_model->getDataByIdHistory($data_post['id_trx_order'], $halamanAwal, $batasTampilData);
        $allDataPoCounter = $this->hst_order_model->getDataByIdHistoryCounter($data_post['id_trx_order']);

        $output = array(
            "length" => count($allDataPo),
            "data" => $allDataPo,
            "length_paging" => count($allDataPoCounter)
           
        );

        echo json_encode($output);
    }

    /*
    public function getDataByDate(){

        $getOrderData = $this->hst_order_model->getDataByDate($_POST);
        echo json_encode($getOrderData);
    }

    public function getDetailTrx(){

        $getDetailTrx = $this->lv_model->getDetailTrx($_POST);
        echo json_encode($getDetailTrx);
    }
    */

    /*
    public function detailOrder($url){
        
        $trxIdClean = str_replace("_","/",$url);
        $data['judul'] = 'History Order';
        $data['subMenu'] = "ORDER RECEIVED";
        $data['historyOrderData'] = $this->hst_order_model->getHistoryOrderDetailTrx($trxIdClean);
 
        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/order-received/sidemenu-detail', $data);
        $this->load->view('auth/order-received/history-order-detail', $data);
        $this->load->view('auth/templates/footer');
        
    }
    */

    /*
    public function liveOrderDetailTrx($url){

        $trxIdClean = str_replace("_","/",$url);
        $data['judul'] = 'Live Order';
        $data['subMenu'] = "Live Order";
        $data['url'] = $trxIdClean;
        $data['trxOrderDataTrx'] = $this->hst_order_model('LiveOrderModel')->getliveOrderDetailTrx($trxIdClean);
 
        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/order-received/sidemenu-detail', $data);
        $this->load->view('/order-received/live-order-detail-trx', $data);
        $this->load->view('auth/templates/footer');
        
    }
    */
    public function printDetail($url){
        
        $trxIdClean = str_replace("_","/",$url);
        $data['judul'] = 'History Order';
        $data['subMenu'] = "ORDER RECEIVED";
        $data['historyOrderData'] = $this->hst_order_model->getHistoryOrderDetailTrx($trxIdClean);
 
        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/order-received/sidemenu-detail', $data);
        $this->load->view('auth/order-received/history-order-detail-print', $data);
        $this->load->view('auth/templates/footer');
        
    }


    public function print(){

        $html="";
        $data_post=$_POST;

        $t = time();
        $data['date'] = date("d F Y", $t);
        $data['data'] = $this->hst_order_model->getDataByIdTrxOrder($data_post['id_trx_order']);
        $html = $this->load->view('auth/order-received/history-order-print',$data,true);

        $this->fungsi->PdfGenerator($html,'History Order','A4','landscape');
    }

    public function printDirectly($url){

        $html="";
        $trxIdClean = str_replace("_","/",$url);

        $t = time();
        $data['date'] = date("d F Y", $t);
        $data['data'] = $this->hst_order_model->getDataByIdTrxOrder($trxIdClean);
        $html = $this->load->view('auth/order-received/history-order-print',$data,true);

        $this->fungsi->PdfGenerator($html,'History Order','A4','landscape');
    }


}
?>