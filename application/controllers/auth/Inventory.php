<?php
class Inventory extends CI_Controller
{

    public function __construct() {  
        parent::__construct(); 

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/TRXBarangPoModel','trx_brg_model');    
        $this->load->model('auth/BarangModel','brg_model');    
        $this->load->model('auth/SupplierModel','sup_model');    
        $this->load->model('auth/TRXPSTPusat','pst_pusat_model');    
        $this->load->model('auth/TRXPSTSobat','pst_sobat_model');    

    } 

    // Create PO
    public function index()
    {
        $countData = $this->trx_brg_model->getTrxId();
        $countDataBarang = $this->brg_model->countDataBarang();
        // $countDataBarang = $this->trx_brg_model->getTrxId();

        $dataBarangCount =  $countDataBarang[0]->CountData;
        $num = $countData[0]->trx_id + 1;
        $num_padded = sprintf("%04d", $num);

        $t = time();
        $currnet_date = date("d/m/Y", $t);
        $data['judul'] = 'Create PO';
        $data['id_trx_po'] = "IPO-" . $num_padded . "/" . $currnet_date;
        $data['id_trx_inv'] = "INV-PO-" . $num_padded . "/" . $currnet_date;
        $data['date'] = date("d F Y", $t);
        $data['dataBarangCount'] = $dataBarangCount;

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/inventory/sidemenu', $data);
        $this->load->view('auth/inventory/inventory-create-po', $data);
        $this->load->view('auth/templates/footer');
    }

    public function inventorySaveInvMenu()
    {

        $data_post= $_POST;

        $where_brg = array(
            "lower(trim(nama_barang))"=>$data_post['nama_barang'],
            "kode"=>$data_post['kode']
        );

        $where_sup = array(
            "lower(trim(nama))"=>$data_post['nama_supplier']
        );

        $data_sup=array(
            "nama"=> $data_post['nama_supplier'],
            "create_date"=>date('YmdHis'),
            "update_date"=>date('YmdHis')
        );

        $getSuplier = $this->sup_model->getWhere('supplier',$where_sup);
        $getId = $this->brg_model->getWhere('barang',$where_brg);

        if ($getSuplier == "") {
           
                $getSuplierId = $this->sup_model->insertData($data_sup);
                $_POST['id_supplier'] = $getSuplierId['id'];

        } else {
            $_POST['id_supplier'] = $getSuplier['id'];
        }

        if ($getId == "") {

            $data_brg=array(
                "kode"=> $data_post['kode'],
                "nama_barang"=> $data_post['nama_barang'],
                "satuan"=> $data_post['satuan'],
                "id_supplier"=> $_POST['id_supplier'],
                "create_date"=>date('YmdHis'),
                "update_date"=>date('YmdHis')
            );
            
            $getBarangId = $this->brg_model->insertData($data_brg);
            $_POST['id_barang'] = $getBarangId['id'];
            
        } else {
            $_POST['id_barang'] = $getId['id'];
        }

        $_POST['id_trx_update'] = "";

        $data_brg_po=array(
            "kode"=> $data_post['kode'],
            "quantity"=> $data_post['quantity'],
            "id_trx_po"=> $data_post['id_trx_po'],
            "id_supplier"=> $_POST['id_supplier'],
            "status"=> $_POST['status'],
            "create_date"=>date('YmdHis'),
            "update_date"=>date('YmdHis')
        );

        if ($this->trx_brg_model->insertData($data_brg_po) > 0) {
            echo json_encode("Suksess");
        } else {
            echo json_encode("Failed");
        }
    }

    // Update PO
    public function updatepo()
    {

        $id_search      = (isset($_POST['id_search'])) ? $_POST['id_search'] : 0;
        $data_search    = (isset($_POST['data_search'])) ? $_POST['data_search'] : 0;
        $data['judul']  = 'Update PO';

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/inventory/sidemenu', $data);

        if ($id_search === 0 || $id_search == '' || $id_search == null) {
            if ($data_search === 0) {
                $data['allDataPo'] = $this->trx_brg_model->selectDistinct();
                $this->load->view('auth/inventory/show-data-po', $data);
            } else {
                $data['allDataPo'] = $this->trx_brg_model->selectDistinctSearch($data_search);
                $this->load->view('auth/inventory/show-data-po', $data);
            }
        } else {

            $data['allDataPo'] = $this->trx_brg_model->getDataByid($id_search);
            $data['trx_update'] = str_replace("IPO", "IUP", $id_search);
            $data['supplier_name'] = $_POST['supplier_name'];
            $data['tanggal'] = $_POST['tanggal'];

            $countDataBarang = $this->brg_model->countDataBarang();
            $dataBarangCount =  $countDataBarang[0]->CountData;
            $data['dataBarangCount'] = $dataBarangCount;

            $this->load->view('auth/inventory/inventory-update-po', $data);
        }

        $this->load->view('auth/templates/footer');
    }

    //belum sampe sini
    public function inventoryUpdateInvMenu()
    {

        $getSuplier = $this->sup_model->getOneDataSupplier($_POST);
        $getId = $this->brg_model->getIdOneDataLimitDSC($_POST);
        if ($getSuplier == "") {
            if ($this->sup_model->insertDataSupplierInvMenu($_POST) > 0) {
                $getSuplierId = $this->sup_model->getOneDataSupplier($_POST);
                $_POST['id_supplier'] = $getSuplierId['id'];
            }
        } else {
            $_POST['id_supplier'] = $getSuplier['id'];
        }

        if ($getId == "") {
            if ($this->brg_model->insertDataInvMenuCreatePO($_POST) > 0) {
                $getBarangId = $this->brg_model->getIdOneDataLimitDSC($_POST);
                $_POST['id_barang'] = $getBarangId['id'];
            }
        } else {
            $_POST['id_barang'] = $getId['id'];
        }
        $getOneData = $this->trx_brg_model->OneData($_POST['id']);
        if (count($getOneData) < 1) {
            $_POST['id_trx_po'] = str_replace("IUP", "IPO", $_POST['id_trx_update']);
            $_POST['create_date'] = $getOneData['create_date'];
            if ($this->trx_brg_model->insertDataPOInvMenuForUpdate($_POST) > 0) {
                echo json_encode("Suksess");
            } else {
                echo json_encode("Failed");
            }
        } else {
            if ($this->trx_brg_model->updateDataPOInvMenu($_POST) > 0) {
                echo json_encode("Suksess");
            } else {
                echo json_encode("Failed");
            }
        }
    }

    // Live Stock
    public function livestock()
    {
        $id_search          = (isset($_POST['id_search'])) ? $_POST['id_search'] : 0;
        $data_search        = (isset($_POST['data_search'])) ? $_POST['data_search'] : 0;
        $date_sort          = (isset($_POST['date_sort'])) ? $_POST['date_sort'] : 0;
        $data['judul']      = 'Live Stocks';

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/inventory/sidemenu', $data);

        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        //search fiture
        if ($id_search === 0 || $id_search == '' || $id_search == null) {
            if ($data_search === 0 || $data_search == '' || $data_search == null) {
                if ($date_sort != 0 || $date_sort != '' || $date_sort != null) {
                    $data['titleSearch'] = $this->sup_model->getDateTitle($date_sort);
                    $date_sort = str_replace("-", "", $date_sort);
                    $data['allDataPo'] = $this->trx_brg_model->selectDistictByDate($date_sort);
                    $data['dateSort'] = $date_sort;
                    $this->load->view('auth/inventory/show-data-live-stocks', $data);
                } else {
                    $data['titleSearch'] = '';
                    $data['allDataPo'] = '';
                    $this->load->view('auth/inventory/show-data-live-stocks', $data);
                }
            } else {
                $data['titleSearch'] = $this->sup_model->getSupplierName($data_search);
                $data['allDataPo'] = $this->trx_brg_model->selectDistictSearch($data_search);
                $this->load->view('auth/inventory/show-data-live-stocks', $data);
            }
        } else {
            $data['allDataPo'] = $this->trx_brg_model->getDataByid($id_search);
            $data['trx_lvStocks'] = str_replace("IPO", "ILS", $id_search);
            $data['supplier_name'] = $_POST['supplier_name'];
            $data['tanggal'] = $_POST['tanggal'];

            $this->load->view('auth/inventory/inventory-live-stocks', $data);
        }


        $this->load->view('auth/templates/footer');
    }

    public function inventoryLiveStocksInvMenu()
    {
        $liveStocksNow = $this->brg_model->selectDataLiveStocks($_POST);
        $_POST['quantity_check_barang'] = $liveStocksNow[0]['quantity_check'] +  $_POST['quantity_check'];
        $_POST['status'] = '1';
        if ($this->trx_brg_model->updateDataLiveStocks($_POST) > 0 && $this->brg_model->updateLiveStocks($_POST) > 0) {
            echo json_encode("Suksess");
        } else {
            echo json_encode("Failed");
        }
    }

    // history
    public function historypo()
    {
        $id_search          = (isset($_POST['id_search'])) ? $_POST['id_search'] : 0;
        $data_search        = (isset($_POST['data_search'])) ? $_POST['data_search'] : 0;
        $date_sort          = (isset($_POST['date_sort'])) ? $_POST['date_sort'] : 0;
        $data['judul']      = 'History Po';

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/inventory/sidemenu', $data);

        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        //search fiture
        if ($id_search === 0 || $id_search == '' || $id_search == null) {
            if ($data_search === 0 || $data_search == '' || $data_search == null) {
                if ($date_sort != 0 || $date_sort != '' || $date_sort != null) {
                    $data['titleSearch'] = $this->sup_model->getDateTitle($date_sort);
                    $date_sort = str_replace("-", "", $date_sort);
                    $data['allDataPo'] = $this->trx_brg_model->selectDistictByDate($date_sort);
                    $data['dateSort'] = $date_sort;
                    $this->load->view('auth/inventory/show-data-hisotry', $data);
                } else {
                    $data['titleSearch'] = '';
                    $data['allDataPo'] = '';
                    $this->load->view('auth/inventory/show-data-hisotry', $data);
                }
            } else {
                $data['titleSearch'] = $this->sup_model->getSupplierName($data_search);
                $data['allDataPo'] = $this->trx_brg_model->selectDistictSearch($data_search);
                $this->load->view('auth/inventory/show-data-hisotry', $data);
            }
        } else {
            $data['allDataPo'] = $this->trx_brg_model->getDataByid($id_search);
            // $data['trx_lvStocks'] = str_replace("IPO", "ILS", $id_search);
            $data['trx_lvStocks'] =  $id_search;
            $data['supplier_name'] = $_POST['supplier_name'];
            // $data['tanggal'] = $_POST['tanggal'];
            // $data['tanggal_sampai'] = $_POST['tanggal_sampai'];

           // $data['tanggal'] = $this->util('DateConvert')->formatDate($_POST['tanggal']);
           // $data['tanggal_sampai'] = $this->util('DateConvert')->formatDate($_POST['tanggal_sampai']);

            $this->load->view('auth/inventory/inventory-history', $data);
        }


        $this->load->view('auth/templates/footer');
    }

    // mutasi barang
    public function mutasibarang()
    {
        $data['judul']      = 'Mutasi Barang';

        $t = time();
        $data['tanggal'] = date("d/m/Y", $t);

        $countData = $this->trx_brg_model->getTrxId();
        $num = $countData[0]->trx_id + 1;
        $num_padded = sprintf("%04d", $num);
        $data['id_trx_mutasi'] = "IPO-" . $num_padded . "/" . $data['tanggal'];

        $data['date'] = date("d F Y", $t);

        $countDataBarang = $this->brg_model->countDataBarang();
        $dataBarangCount =  $countDataBarang[0]->CountData;
        $data['dataBarangCount'] = $dataBarangCount;

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/inventory/sidemenu', $data);
        $this->load->view('auth/inventory/inventory-mutasi-barang', $data);
        $this->load->view('auth/templates/footer');
    }


    //update stock PST
    public function updatestockpts()
    {
        $data['judul']      = 'Update Stoks PST';

        $t = time();
        $data['tanggal'] = date("d/m/Y", $t);

        $data['ketGudang'] = (isset($_POST['gudang'])) ? $_POST['gudang'] : 'pusat';
        $data['halaman'] = (isset($_POST['halaman'])) ? $_POST['halaman'] : '1';

        if ($data['ketGudang'] == 'pusat') {
            $countData = $this->pst_pusat_model->getTrxId();
        } else if ($data['ketGudang'] == 'sobat') {
            $countData = $this->pst_sobat_model->getTrxId();
        } else {
            $countData = "UNKNOWN";
        }

        $num = $countData[0]->trx_id + 1;
        $num_padded = sprintf("%04d", $num);

        $data['id_trx_pst'] = "IUS-" . $num_padded . "/" . $data['tanggal'];

        $data['date'] = date("d F Y", $t);

        $countDataBarang = $this->brg_model->countDataBarang();
        $dataBarangCount =  $countDataBarang[0]->CountData;
        $data['dataBarangCount'] = $dataBarangCount;


        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/inventory/sidemenu', $data);
        $this->load->view('auth/inventory/inventory-stock-pst', $data);
        $this->load->view('auth/templates/footer');
    }

    public function inventorySavePSTMenu()
    {
        $data = $_POST;

       // $isload->view = true;

        if ($_POST['gudang'] == 'pusat') {

            if ($this->load->model("TRXPSTPusat")->saveData($_POST) > 0) {
                echo json_encode("Suksess");
            } else {
                echo json_encode("Failed");
            }
            $this->load->view('auth/templates/header', $data);
            $this->load->view('/inventory/form-post', $data);
            $this->load->view('auth/templates/footer');
        } else if ($_POST['gudang'] == 'sobat') {

            if ($this->load->model("TRXPSTSobat")->saveData($_POST) > 0) {
                echo json_encode("Suksess");
            } else {
                echo json_encode("Failed");
            }

            $this->load->view('auth/templates/header', $data);
            $this->load->view('/inventory/form-post', $data);
            $this->load->view('auth/templates/footer');
        }
    }

    public function getDataLiveStocksByTRX()
    {
        $allData = $this->trx_brg_model->getDataByid($_POST['id_trx_po']);
        echo json_encode($allData);
    }

    public function inventoryDeleteInvMenu()
    {
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        if ($this->trx_brg_model->deleteDataPO($_POST) > 0) {
            echo json_encode("Suksess");
        } else {
            echo json_encode("Failed");
        }
    }
    // Utilitas
    public function UnsetPOSTData($data)
    {
        unset($_POST);
        //$url = site_url() . "/inventory/" . $data;
        //header('Location:' . $url);
        redirect('inventory');
    }
}
