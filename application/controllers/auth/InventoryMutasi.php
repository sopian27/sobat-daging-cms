<?php
class InventoryMutasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/TRXBarangPoModel', 'trx_brg_model');
        $this->load->model('auth/BarangModel', 'brg_model');
        $this->load->model('auth/TRXMutasiModel', 'trx_mutasi_model');
    }

    public function index()
    {
        $data['judul']   = 'Mutasi Barang';
        $t = time();
        $data['tanggal'] = date("d/m/Y", $t);
        //$countData = $this->trx_mutasi_model->getTrxId();
       // $num = $countData[0]->trx_id + 1;
        //$num_padded = sprintf("%04d", $num);
       
        $data['date'] = date("d F Y", $t);

        $trxData = $this->trx_mutasi_model->getTrxId();
        $trxId = $trxData[0]->trx_id;
        $lastNoUrut = substr($trxId, 5, 4);
        $nextNoUrut = intval($lastNoUrut) + 1;
        $t = time();
        $currentDate = date("d/m/Y", $t);
        $kodeInvoice = 'IMB-' . sprintf('%04s', $nextNoUrut) . "/" . $currentDate;
        $data['id_trx_mutasi'] = $kodeInvoice;

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/inventory/sidemenu', $data);
        $this->load->view('auth/inventory/inventory-mutasi-barang', $data);
        $this->load->view('auth/templates/footer');
    }

    public function loadPo()
    {

        $batasTampilData = $_POST['batastampil'];
        $id_trx_mutasi = $_POST['id_trx_mutasi'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;

        $allDataPo = $this->trx_mutasi_model->getTrxMutasi($id_trx_mutasi, $halamanAwal, $batasTampilData);
        $allDataPoCounter = $this->trx_mutasi_model->getTrxMutasiCount($id_trx_mutasi);
        $output = array(
            "length" => count($allDataPo),
            "data" => $allDataPo,
            "length_paging" => count($allDataPoCounter)

        );

        echo json_encode($output);
    }

    function get_ajax()
    {

        $list = $this->brg_model->get_datatables();
        $data = array();
        $no = @$_POST['start'];

        foreach ($list as $item) {
            $no++;
            $row = array();
            $param = $item->id . "_,_" . $item->kode . "_,_" . $item->quantity_pusat;
            $row[] = $item->kode;
            $row[] = $item->nama_barang;
            $row[] = $item->quantity_pusat . " " . $item->satuan;
            $row[] = '<input type="text" class="form form-control-label" name="mutasi[]" id="mutasi' . $param . '" />';

            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->brg_model->count_all(),
            "recordsFiltered" => $this->brg_model->count_filtered(),
            "data" => $data,
        );

        // output to json format
        echo json_encode($output);
    }

    /*
    function insertMutasi(){

        $post = $_POST;
        $id              = $this->stringToArray(",",$post['id']);
        $quantity_pusat  = $this->stringToArray(",",$post['quantity_pusat']);
        $quantity_mutasi = $this->stringToArray(",",$post['quantity_mutasi']);
        $kode            = $this->stringToArray(",",$post['kode']);
        $id_trx_mutasi   = $post['id_trx_mutasi'];

        $data=array();

        for($i=0;$i <count($id);$i++){

            $data[]=array(
                "kode"            => $kode[$i],
                "create_date"     => date('YmdHis'),
                "update_date"     => date('YmdHis'),
                "quantity_pusat"  => $quantity_pusat[$i],
                "quantity_mutasi" => $quantity_mutasi[$i],
                "id_trx_mutasi"   => $id_trx_mutasi,
            );
        }

        $this->trx_mutasi_model->insertDataBatch($data);

        redirect('inventory-mutasibarang');

    }
    */

    function insertMutasi()
    {

        $post = $_POST;
        $quantity_pusat  = $post['quantity_pusat'];
        $quantity_mutasi = $post['quantity_mutasi'];
        $kode            = $post['kode'];
        $id_trx_mutasi   = $post['id_trx_mutasi'];

        $data = array(
            "kode"            => $kode,
            "create_date"     => date('YmdHis'),
            "update_date"     => date('YmdHis'),
            "quantity_pusat"  => $quantity_pusat,
            "quantity_mutasi" => $quantity_mutasi,
            "id_trx_mutasi"   => $id_trx_mutasi,
            "status"          => "0",
        );


        $this->trx_mutasi_model->insertData($data);

        echo json_encode("success");
    }

    function updateMutasi()
    {

        $post = $_POST;
        $id_trx_mutasi   = $post['id_trx_mutasi'];
        $where = array("id_trx_mutasi" => $id_trx_mutasi);

        $dataUpdate = array(
            "status"            =>  "1"
        );

        $this->trx_mutasi_model->update($dataUpdate, $where);
        echo json_encode("success");
    }

    function stringToArray($delimiter, $value)
    {
        return explode($delimiter, $value);
    }

    public function clearAll()
    {

        $data_post = $_POST;
        $where = array("status" =>"0");

        $this->trx_mutasi_model->deleteData($where);

        echo json_encode("success");
    }
}
