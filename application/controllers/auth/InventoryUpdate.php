<?php
class InventoryUpdate extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/TRXBarangPoModel', 'trx_brg_model');
        $this->load->model('auth/BarangModel', 'brg_model');
        $this->load->model('auth/SupplierModel', 'sup_model');
        $this->load->model('auth/TRXPSTPusatModel', 'pst_pusat_model');
        $this->load->model('auth/TRXPSTSobatModel', 'pst_sobat_model');
    }

    public function index()
    {

        $data['judul']  = 'Update PO';
        $countDataBarang = $this->brg_model->countDataBarang();
        $countData = $this->trx_brg_model->getTrxIdUpdate();

        $dataBarangCount =  $countDataBarang[0]->CountData;
        $num = $countData[0]->trx_id + 1;
        $num_padded = sprintf("%04d", $num);

        $t = time();
        $currentDate = date("d/m/Y", $t);
        $data['id_trx_po'] = "IUPO-" . $num_padded . "/" . $currentDate;
        $data['date'] = date("d F Y", $t);
        $data['dataBarangCount'] = $dataBarangCount;

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/inventory/sidemenu', $data);
        $this->load->view('auth/inventory/inventory-update-po', $data);
        $this->load->view('auth/templates/footer');
    }

    public function loadNewPo()
    {

        $batasTampilData = $_POST['batastampil'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;

        $allDataPo = $this->trx_brg_model->selectDistinct($_POST['keyword'], $halamanAwal, $batasTampilData);
        $allDataPoCounter = $this->trx_brg_model->selectDistinctCount($_POST['keyword']);
        $output = array(
            "length" => count($allDataPo),
            "data" => $allDataPo,
            "length_paging" => count($allDataPoCounter)
            
        );

        echo json_encode($output);
    }

    public function getDetailNewPo()
    {

        $data_post = $_POST;
        $batasTampilData = $_POST['batastampil'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;

        $allDataPo = $this->trx_brg_model->getDataById($data_post['id_trx_po'], $halamanAwal, $batasTampilData);
        $allDataPoCounter = $this->trx_brg_model->getDataByIdCounter($data_post['id_trx_po']);
        $allDataPoSum = $this->trx_brg_model->getDataByIdSum($data_post['id_trx_po']);

        $output = array(
            "length" => count($allDataPo),
            "data" => $allDataPo,
            "length_paging" => count($allDataPoCounter),
            "data_sum" => $allDataPoSum[0]->total
        );

        echo json_encode($output);
    }
    /*
    public function updateHarga(){

        $data_post = $_POST;
        for($i=0;$i<count($data_post["id_trx_po"]);$i++){

            $where = array("id"=> $data_post['id'][$i]);
            $dataUpdate = array(
                "harga_satuan" => $data_post['harga_satuan'][$i],
                "harga_total"  => $data_post['harga_total'][$i],
                "id_trx_update"  => $data_post['id_trx_po'][$i]
            );

            $this->trx_brg_model->update($dataUpdate,$where);
        }

        redirect('inventory-updatepo');

    }*/

    public function updateHarga()
    {

        $data_post = $_POST;
        $where = array("id" => $data_post['id']);
        $dataUpdate = array(
            "harga_satuan"   => $data_post['harga_satuan'],
            "harga_total"    => str_replace(",", "",$data_post['harga_total']),
            //"id_trx_update"  => $data_post['id_trx_po'],
            "status"         =>  "2"
        );

        $this->trx_brg_model->update($dataUpdate, $where);

        echo json_encode("success");
    }

    public function confirmData()
    {
        $data_post = $_POST;
        $where = array("id_trx_po"       => $data_post['id_trx_po']
                      // "harga_satuan !=" => 0,
                      // "status"          => "2" 
                    );

        $dataUpdate = array(
            "id_trx_update"     => $data_post['id_trx_po_update'],
            "status"            =>  "3",
            "update_date"       =>  date('YmdHis')
        );

        $this->trx_brg_model->update($dataUpdate, $where);

        echo json_encode("success");
    }

    public function clearAll(){

        $data_post = $_POST;
        $where = array("id_trx_po" => $data_post['id_trx_po']);

        $dataUpdate = array(
            "id_trx_update"     => "",
            "status"            =>  "0",
            "harga_satuan"      =>  0,
            "harga_total"       =>  0,
        );

        $this->trx_brg_model->update($dataUpdate, $where);

        echo json_encode("success");

    }
}
