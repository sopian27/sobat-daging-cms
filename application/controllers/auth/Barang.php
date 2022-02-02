<?php
class Barang extends CI_Controller
{
    public function __construct() {  
        parent::__construct(); 

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/BarangModel','barang_model');    

    } 

    public function GetPaginationPage()
    {

        $batasTampilData = 10;
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;


        $allData = $this->barang_model->selectDataPaging($halamanAwal, $batasTampilData);
        echo json_encode($allData);
    }

    public function TotalDataBarang()
    {
        $countData = $this->barang_model->countDataBarang();
        echo json_encode($countData['CountData']);
    }
}

