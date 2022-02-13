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
        $countData = $this->trx_brg_model->getTrxId();
        $num = $countData[0]->trx_id + 1;
        $num_padded = sprintf("%04d", $num);
        $data['id_trx_mutasi'] = "IMB-" . $num_padded . "/" . $data['tanggal'];
        $data['date'] = date("d F Y", $t);

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/inventory/sidemenu', $data);
        $this->load->view('auth/inventory/inventory-mutasi-barang', $data);
        $this->load->view('auth/templates/footer');
    }

    function get_ajax()
    {

        $list = $this->brg_model->get_datatables();
        $data = array();
        $no = @$_POST['start'];

        foreach ($list as $item) {
            $no++;
            $row = array();
            $param= $item->id."_,_".$item->kode."_,_".$item->quantity_pusat;
            $row[] = $item->kode;
            $row[] = $item->nama_barang;
            $row[] = $item->quantity_pusat." ".$item->satuan;
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

    function stringToArray($delimiter,$value){
        return explode($delimiter, $value);
    }
}
