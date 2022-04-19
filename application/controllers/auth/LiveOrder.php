<?php

class LiveOrder extends CI_Controller{

    public function __construct() {  
        parent::__construct(); 

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/LiveOrderModel','lv_model');    

    } 

    public function index(){

       // $countData = $this->lv_model->getTrxId();
       // $num = $countData[0]->trx_id + 1;
       // $num_padded = sprintf("%04d", $num);

        $tgl_trx = date("Y-m-d");
/*         $trxData = $this->lv_model->getTrxId($tgl_trx);
        $trxId = $trxData[0]->trx_id;
        $lastNoUrut = substr($trxId, 5, 4);
        $nextNoUrut = intval($lastNoUrut) + 1;
        $t = time();
        $currentDate = date("d/m/Y", $t);
        $kode = 'ORLO-' . sprintf('%04s', $nextNoUrut) . "/" . $currentDate; */

        $trxData = $this->lv_model->getTrxId($tgl_trx);
        $datax = $trxData[0]->trx_id;
        $lastNoUrut = substr($datax, 5,5);
        $nextNoUrut = intval($lastNoUrut)+1;
        $kode = 'ORLO-' . sprintf('%05s',$nextNoUrut)."/". date('d/m/Y',strtotime($tgl_trx));

        $t = time();
        $currentDate = date("d/m/Y", $t);
        $data['judul'] = 'Live Order';
        $data['subMenu'] = "ORDER RECEIVED";
        $data['id_trx_order'] = $kode;
        $data['date'] = date("d F Y", $t);

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/order-received/sidemenu', $data);
        $this->load->view('auth/order-received/live-order', $data);
        $this->load->view('auth/templates/footer');

    }
    
    public function getData(){

        $data_post = $_POST;

        $batasTampilData = $_POST['batastampil'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;

        $data = $this->lv_model->getLiveOrderData($data_post['create_date'], $_POST['keyword'], $halamanAwal, $batasTampilData);
        $dataCounter = $this->lv_model->getLiveOrderDataCount($data_post['create_date'], $_POST['keyword']);
        $allDataPo = $this->lv_model->getDateByIdLiveOrder($data_post['create_date'], $halamanAwal, $batasTampilData);

        $output = array(
            "length" => count($data),
            "data" => $data,
            "datapo" => $allDataPo,
            "lengthpo" => count($allDataPo),
            "length_paging" => count($dataCounter)

        );

        echo json_encode($output);
    }

    public function getDate(){

        $data_post = $_POST;

        $batasTampilData = $_POST['batastampil'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;

        $data = $this->lv_model->getLiveOrderDate($data_post['create_date'], "", $halamanAwal, $batasTampilData);
        $dataCounter = $this->lv_model->getLiveOrderDateCount($data_post['create_date'],"");
        $allDataPo = $this->lv_model->getDateByIdLiveOrder($data_post['create_date'], $halamanAwal, $batasTampilData);

        $output = array(
            "length" => count($data),
            "data" => $data,
            "length_paging" => count($dataCounter)

        );

        echo json_encode($output);
    } 

    public function getDetailTrx(){
        $getDetailTrx = $this->lv_model->getliveOrderDetailTrx($_POST['id_trx_order']);
        echo json_encode($getDetailTrx);
    }

    public function isLiveOrderConfirmed(){

        $where = array(
                    "id_trx_order"=>$_POST['id_trx_order'],
                    "status" => "2"
        );

        $getDetailTrx = $this->lv_model->getWhere($where);

        $output = array(
            "length" => count($getDetailTrx)

        );
        
        echo json_encode($output);
    }

    public function liveOrderDetail(){

        /*
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
        */
        $data_post = $_POST;
        $batasTampilData = $_POST['batastampil'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;

        $data_post = $_POST;
        $allDataPo = $this->lv_model->getDataByIdLiveOrder($data_post['id_trx_order'], $halamanAwal, $batasTampilData);
        $allDataPoCounter = $this->lv_model->getDataByIdLiveOrderCounter($data_post['id_trx_order']);

        $output = array(
            "length" => count($allDataPo),
            "data" => $allDataPo,
            "length_paging" => count($allDataPoCounter),
        );

        echo json_encode($output);
    }

    public function liveOrderDetailTrx($url){

        /*
        $trxIdClean = str_replace("_","/",$url);
        $data['judul'] = 'Live Order';
        $data['subMenu'] = "Live Order";
        $data['url'] = $trxIdClean;
        $data['trxOrderDataTrx'] = $this->lv_model->getliveOrderDetailTrx($trxIdClean);
 
        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/order-received/sidemenu-detail', $data);
        $this->load->view('auth/order-received/live-order-detail-trx', $data);
        $this->load->view('auth/templates/footer');
        */

       
        
    }

    public function clearAll()
    {

        $data_post = $_POST;
        $where = array("id_trx_order" => $data_post['id_trx_order']);

        $dataUpdate = array(
            "status"            =>  "0",
            "bungkusan"         => 0,
            "id_trx_live_order" => "",
            "note"              => ""
        );

        $this->lv_model->update($dataUpdate, $where);

        echo json_encode("success");
    }

    public function updateBungkusanConfirm()
    {

        $data_post = $_POST;
        $where = array(
            "id_trx_order" => $data_post['id_trx_order']
        );

        $dataUpdate = array(
            "status"           =>  "2"
        );

        $this->lv_model->update($dataUpdate, $where);

        echo json_encode("success");
    }


    public function updateBungkusan(){

        $data_post = $_POST;
        $where = array(
            "id"        => $data_post['id'],
            "id_trx_order" => $data_post['id_trx_order']
        );

        $dataUpdate = array(
            "bungkusan"           => $data_post['bungkusan'],
            "note"                => $data_post['note'],
            "id_trx_live_order"   => $data_post['id_trx_live_order'],
            "status"              =>  "1"
        );

        $this->lv_model->update($dataUpdate, $where);

        echo json_encode("success");
    }

    /*
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
    */

}
