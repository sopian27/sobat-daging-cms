<?php
class TotalStock extends CI_Controller
{
    public function __construct() {  
        parent::__construct(); 

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/BarangModel','brg_model');

    } 

    public function index()
    {
        $data['judul']   = 'Total Stock';
        $data['subMenu'] = "DATABASE";
        $t = time();
        $data['date'] = date("d F Y", $t);
        //$data['barangObj']=$this->brg_model->getDataBarang();

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/databases/sidemenu', $data);
        $this->load->view('auth/databases/total-stock', $data);
        $this->load->view('auth/templates/footer');
    }

    public function getDatabak(){
        $data= $this->brg_model->getDataBarang();
        $output = array(
            "datastock"=>$data,
            "result"=>"ok"
        );

        echo json_encode($output);
    }

    public function getData()
    {

        $data_post = $_POST;

        $batasTampilData = $_POST['batastampil'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;
        
        $data = $this->brg_model->getData($data_post['create_date'], $_POST['keyword'], $halamanAwal, $batasTampilData);
        $dataCounter = $this->brg_model->getDataCount($data_post['create_date'], $_POST['keyword']);
        $dataSum = $this->brg_model->getDataSum();
        $quantityTotal=0;
        foreach ($dataSum as $datax){
            if(floatval($datax->quantity_sobat) > 0){
                $quantityTotal += floatval($datax->harga_satuan) * (floatval($datax->quantity_sobat) + floatval($datax->quantity_pusat));
            }else{
                $quantityTotal += floatval($datax->harga_satuan) * (floatval($datax->quantity_pusat));
            }
        }

        $output = array(
            "length" => count($data),
            "datastock" => $data,
            "quantity_total" => $quantityTotal,
            "length_paging" => count($dataCounter)
        );


        echo json_encode($output);
    }

}
