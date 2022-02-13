<?php

class OrderReceived extends CI_Controller{

    public function __construct() {  
        parent::__construct(); 

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/TRXOrderReceivedModel','trx_order_recv_model');    
        $this->load->model('auth/PelangganModel','plg_model');    
        $this->load->model('auth/BarangModel','brg_model');    
        $this->load->model('auth/TelephoneModel','tlp_model');    
        $this->load->model('auth/AlamatModel','alamat_model');    

    } 

    public function index(){

        $data['judul'] = 'Create Order';
        $t = time();
        $current_date = date("d/m/Y", $t);
        $trxData = $this->trx_order_recv_model->getTrxId();
        $trxId = $trxData[0]->trx_id;
        $lastNoUrut = substr($trxId, 5,4);
        $nextNoUrut = intval($lastNoUrut)+1;

        $kodePo = 'ORCO-'. sprintf('%04s',$nextNoUrut)."/".$current_date;
        $kodeInvoice = 'INV-CO'. sprintf('%04s',$nextNoUrut)."/".$current_date;
        $kodeSuratJalan = 'SJ-'. sprintf('%04s',$nextNoUrut)."/".$current_date;
        $kodeHistory = 'PO-CO'. sprintf('%04s',$nextNoUrut)."/".$current_date;
        
        $data['kodePO'] = $kodePo;
        $data['kodeInv'] = $kodeInvoice;
        $data['kodeSsj'] = $kodeSuratJalan;
        $data['kodeHistory'] = $kodeHistory;
        $data['date'] = date("d F Y", $t);
        $data['subMenu'] = "ORDER RECEIVED";
        
        $countDataBarang = $this->brg_model->countDataBarang();
        $dataBarangCount =  $countDataBarang[0]->CountData;
        $data['dataBarangCount'] = $dataBarangCount;

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/order-received/sidemenu', $data);
        $this->load->view('auth/order-received/create-order', $data);
        $this->load->view('auth/templates/footer');

    }

    /**
     * order save
     * 1. insert data pelanggan, data pelanggan harus unique
     * 2. get id data pelanggan
     * 3. insert ke table transaksi order received
     * 4. update quantity di table barang
     *
     * 
     */ 
    public function orderSave(){

        /*step 1 & step 2*/
        $getPelangganId =array();
        $getTelephoneId =array();
        $alamatId =array();
        $dataInsert=array();

        for($i=0; $i<count($_POST["id_barang"]); $i++){
            
            if($i==0){

                $where =array(
                    "lower(trim(nama_pelanggan))"=> $_POST['nama_pelanggan']
                );

                $data =array(
                    "nama_pelanggan"=> $_POST['nama_pelanggan'],
                    "nomor_hp1"=> $_POST['nomor_hp1'],
                    "nomor_hp2"=> $_POST['nomor_hp2'],
                    "alamat1"=> $_POST['alamat1'],
                    "alamat2"=> $_POST['alamat2'],
                    "create_date"=>date('YmdHis'),
                    "update_date"=>date('YmdHis')
                );

                $getPelangganId = $this->plg_model->getWhere($where);

                if (empty($getPelangganId)) {
                        $getPelangganId = $this->plg_model->insertData($data); 
                }              
                

                $dataTelephone = array(
                    "nomor"=>$_POST['nomor_hp1'],
                    "id_pelanggan" => $getPelangganId[0]->id
                );

                $whereTelephone = array(
                    "nomor"=>$_POST['nomor_hp1']
                );

                $getTelephoneId = $this->tlp_model->getWhere($whereTelephone);
        
                if (empty($getTelephoneId)) {
                    $getTelephoneId = $this->tlp_model->insertData($dataTelephone); 
                }

                $dataAlamat = array(
                    "alamat"=>$_POST['alamat1'],
                    "id_pelanggan" => $getPelangganId[0]->id
                );

                $whereAlamat = array(
                    "lower(trim(alamat))"=>$_POST['alamat1']
                );
                
                $alamatId = $this->alamat_model->getWhere($whereAlamat);
        
                if (empty($alamatId)) {
                     $alamatId = $this->alamat_model->insertData($dataAlamat);
                }

            }

            /*step 3 */
            $j=0;
            $dataInsert[] =array(
                "id_barang" => $_POST["id_barang"][$j],
                "quantity"  => $_POST["quantity"][$j],
                "harga_satuan" => $_POST["harga_satuan"][$j],
                "harga_total" => $_POST["harga_total"][$j],
                "satuan" => $_POST["satuan"][$j],
                "tgl_pengiriman" => $_POST["tgl_pengiriman"],
                "id_trx_order" => $_POST["kode_po"],
                "keterangan" => $_POST["keterangan"][$j],
                "id_pelanggan" => $getPelangganId[0]->id,
                "no_invoice" => $_POST["kode_inv"],
                "no_surat_jalan" => $_POST["kode_ssj"],
                "id_alamat" => $alamatId[0]->id,
                "id_telephone" => $getTelephoneId[0]->id,
                "create_date"=>date('YmdHis'),
                "update_date"=>date('YmdHis'),
                "status"=>"0"
            );

        }

        $this->trx_order_recv_model->insertDataBatch($dataInsert);
        echo "success";

    }

    public function getDataKode(){

        $where = array(
            "kode"=>$_POST['kode']
        );

        $dataBarang = $this->brg_model->getWhere($where);
        echo json_encode($dataBarang);

    }

    public function getDataPelanggan(){

        $where =array(
            "lower(trim(nama_pelanggan))"=> $_POST['nama_pelanggan']
        );

        $dataPelanggan = $this->plg_model->getWhere($where);
        echo json_encode($dataPelanggan);
    }
}
?>