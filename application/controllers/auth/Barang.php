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
        $keyword = (isset($_POST['keyword'])) ? $keyword = $_POST['keyword'] : "";


        $allData = $this->barang_model->selectDataPaging($halamanAwal, $batasTampilData,$keyword);
        $allDataCount = $this->barang_model->selectDataPagingCount($keyword);
     
        $output = array(
            "length"=>count($allData),
            "data"=>$allData,
            "length_paging"=>count($allDataCount)
        );

        echo json_encode($output);
    }

    public function TotalDataBarang()
    {
        $countData = $this->barang_model->countDataBarang();
        echo json_encode($countData['CountData']);
    }
}

