<?php

class LiveOrder extends CI_Controller{

    public function __construct() {  
        parent::__construct(); 

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/LiveOrderModel','lv_model');    

    } 

    public function index(){

        $data['judul'] = 'Live Order';
        $data['subMenu'] = "ORDER RECEIVED";

        if(isset($_POST['date_show'])){
            $data['date_show_data'] = $_POST['date_show'];
            $data['flag'] = "1";
            $post_data=array("date_choosen"=>$_POST['date_show']);
            $data['detailData']=$this->lv_model->getDataByDate($post_data);

        }

        /*
        if(isset($_POST['data_search'])){
            $data['date_show_data'] = "Search By ".$_POST['data_search'];
            $data['flag'] = "2";
            $post_data=array("keyword"=> $_POST['data_search']);
            $data['detailData']=$this->lv_model->getDataByKeyword($post_data);
        }*/

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/order-received/sidemenu', $data);
        $this->load->view('auth/order-received/live-order', $data);
        $this->load->view('auth/templates/footer');

    }
    
    public function getDataByDate(){

        $getLiveOrderData = $this->lv_model->getDataByDate($_POST);
        echo json_encode($getLiveOrderData);
    }
    

    public function getDetailTrx(){

        $getDetailTrx = $this->lv_model->getDetailTrx($_POST);
        echo json_encode($getDetailTrx);
    }

    public function liveOrderDetail(){

        
        $data['judul'] = 'Live Order';
        $data['subMenu'] = "Live Order";
        $data['createdate'] = $_POST['createDateFormater'];
        $flag = $_POST['flag'];
        
        if($flag==1){
            $data['trxOrderData'] = $this->lv_model->getliveOrderDetail($_POST);
        }else{
            $tes=$data['trxOrderData'] = $this->lv_model->getliveOrderDetailKeyword($_POST);
        }
     
    
        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/order-received/sidemenu-detail', $data);
        $this->load->view('auth/order-received/live-order-detail', $data);
        $this->load->view('auth/templates/footer');
        
    }

    public function liveOrderDetailTrx($url){

        $trxIdClean = str_replace("_","/",$url);
        $data['judul'] = 'Live Order';
        $data['subMenu'] = "Live Order";
        $data['url'] = $trxIdClean;
        $data['trxOrderDataTrx'] = $this->lv_model->getliveOrderDetailTrx($trxIdClean);
 
        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/order-received/sidemenu-detail', $data);
        $this->load->view('auth/order-received/live-order-detail-trx', $data);
        $this->load->view('auth/templates/footer');
        
    }


    public function confirmOrder(){
        
        $data=array();
        $trxIdClean="";

        for($i=0;$i<count($_POST['id_po']);$i++){
            
           $bungkus_value =  $_POST['bungkus'][$i];
           $trxIdClean = $_POST['id_trx_order'][$i];

            $data=array(
               "bungkusan"=> $_POST['bungkus'][$i],
               "status"=> '1'
            );

            $where=array(
                "id"=> $_POST['id_po'][$i],
                "id_trx_order"=> $_POST['id_trx_order'][$i]

            );

            if($bungkus_value != ""){
                 $this->lv_model->update($data,$where);
            }

        }

        $data['judul'] = 'Live Order';
        $data['subMenu'] = "Live Order";
        $data['url'] = $trxIdClean;
        $data['trxOrderDataTrx'] = $this->lv_model->getliveOrderDetailTrxPrint($trxIdClean);
 
        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/order-received/sidemenu-detail-print', $data);
        $this->load->view('auth/order-received/live-order-detail-trx-print', $data);
        $this->load->view('auth/templates/footer');

    }
    

}
