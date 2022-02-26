<?php
class Ap extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/ApModel', 'ap_model');
    }

    public function index()
    {
        $data['judul']   = 'AP';
        $data['subMenu'] = "DATABASE";
        $t = time();
        $data['date'] = date("d F Y", $t);

        /*
        if(isset($_POST['data_search'])){
            $data['date_show_data'] = "Search By ".$_POST['data_search'];
            $post_data=array("keyword"=> $_POST['data_search']);
            $data['rptObj']=$this->ap_model->getDataByKeyword($post_data);
        }
        */

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/databases/sidemenu', $data);
        $this->load->view('auth/databases/ap', $data);
        $this->load->view('auth/templates/footer');
    }


    public function getData()
    {

        $data_post = $_POST;

        $batasTampilData = $_POST['batastampil'];
        $halaman = (isset($_POST['halaman'])) ? $halaman = $_POST['halaman'] : $halaman = 1;
        $halamanAwal = ($halaman > 1) ? ($halaman * $batasTampilData) - $batasTampilData : 0;

        
        
        $rptObj = $this->ap_model->getData($data_post['create_date'], $_POST['keyword'], $halamanAwal, $batasTampilData);
        $rptObjCounter = $this->ap_model->getDataCount($data_post['create_date'], $_POST['keyword']);
        $rptTot = $this->ap_model->getTotalTagihan($data_post['create_date'], $_POST['keyword']);

        $output = array(
            "rptobj" => $rptObj,
            "length_paging" => count($rptObjCounter),
            "rptot" => $rptTot,
            "length" => count($rptObj)
        );

        echo json_encode($output);
    }
}
