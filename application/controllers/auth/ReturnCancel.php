<?php

class ReturnCancel extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/TRXReturnModel', 'trx_ret_model');
    }


    public function index()
    {

        //$tgl_trx = date("Y-m-d");
        $data['judul']   = 'Return Item';
        $data['subMenu'] = "Return/Cancel";
        $t = time();
        $data['date'] = date("d F Y", $t);
        //$current_date = date("d/m/Y", $t);
        //$trxData = $this->trx_ret_model->getTrxId($tgl_trx);
        /*   
        $trxId = $trxData[0]->trx_id;
        $lastNoUrut = substr($trxId, 5, 4);
        $nextNoUrut = intval($lastNoUrut) + 1;
        $kodePo = 'RRI-' . sprintf('%04s', $nextNoUrut) . "/" . $current_date; */
        /* 
        $datax = $trxData[0]->trx_id;
        $lastNoUrut = substr($datax, 4,5);
        $nextNoUrut = intval($lastNoUrut)+1;
        $kodePo = 'RRI-' . sprintf('%05s',$nextNoUrut)."/". date('d/m/Y',strtotime($tgl_trx)); */

        //$data['kode_po'] = $kodePo;

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/return/sidemenu', $data);
        $this->load->view('auth/return/return-item', $data);
        $this->load->view('auth/templates/footer');
    }


    public function getInvoiceData()
    {

        $data_post = $_POST;

        $tgl_trx = date("Y-m-d");
        $trxData = $this->trx_ret_model->getTrxId($tgl_trx);
        $datax = $trxData[0]->trx_id;
        $lastNoUrut = substr($datax, 4,5);
        $nextNoUrut = intval($lastNoUrut)+1;
        $kodePo = 'RRI-' . sprintf('%05s',$nextNoUrut)."/". date('d/m/Y',strtotime($tgl_trx));

        $batasTampilData = $_POST['batastampil'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;

        $data = $this->trx_ret_model->getInvoiceData($data_post['no_invoice'], $halamanAwal, $batasTampilData);
        $dataCounter = $this->trx_ret_model->getInvoiceDataCount($data_post['no_invoice']);

        $output = array(
            "length" => count($data),
            "data" => $data,
            "length_paging" => count($dataCounter),
            "kode_po" => $kodePo

        );

        echo json_encode($output);
    }
    /*
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
    */

    public function saveData()
    {
        $where = array(
            "no_invoice" => $_POST['no_invoice']
        );

        $data = array(
            "status" => "1",
            "update_date" => date('YmdHis'),
            "tgl_return" =>  $_POST['tgl_return']

        );

        $this->trx_ret_model->update($data, $where);

        echo json_encode("success");
    }

    public function isConfirmed(){

        $where = array(
            "no_invoice" => $_POST['no_invoice'],
            "status"     => "0"
        );

        $getDetailTrx = $this->trx_ret_model->getWhere($where);

        $output = array(
            "length" => count($getDetailTrx)

        );
        
        echo json_encode($output);
    }

    public function insertData()
    {

        $data = array(
            "no_invoice" => $_POST['no_invoice'], 
            "quantity_return" => $_POST['quantity_return'], 
            "quantity_before" => $_POST['quantity_before'], 
            "note" => $_POST['note'], 
            "id_trx_return" => $_POST['id_trx_return'], 
            "satuan" => $_POST['satuan_return'], 
            "id_trx_po" => $_POST['id_trx_po'], 
            "tgl_return" => $_POST['tgl_return'], 
            "create_date" => date('YmdHis'), 
            "update_date" => date('YmdHis'),
            "status" => "0"

        );

        $this->trx_ret_model->insertData($data);


        echo json_encode("success");
    }

    public function clearAll()
    {

        $where = array(
            "no_invoice" => $_POST['no_invoice'],
            "status" => "0"
        );

        $this->trx_ret_model->deleteData($where);

        echo json_encode("success");
    }
}
