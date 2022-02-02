<?php
class Ar extends CI_Controller
{
    public function __construct() {  
        parent::__construct(); 

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/ArModel','ar_model');    

    } 

    public function index()
    {
        $data['judul']   = 'AR';
        $data['subMenu'] = "DATABASE";
        $t = time();
        $data['date'] = date("d F Y", $t);

        /*
        if(isset($_POST['date_show'])){
            $data['date_show_data'] = $_POST['date_show'];
            $post_data=array("date_choosen"=>$_POST['date_show']);
            $data['rptObj']=$this->ar_model->getData($post_data);
            $data['rptTot']=$this->ar_model->getTotalTagihan($post_data);

        }

        if(isset($_POST['data_search'])){
            $data['date_show_data'] = "Search By ".$_POST['data_search'];
            $post_data=array("keyword"=> $_POST['data_search']);
            $data['rptObj']=$this->ar_model->getDataByKeyword($post_data);
        }
        */

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/databases/sidemenu', $data);
        $this->load->view('auth/databases/ar', $data);
        $this->load->view('auth/templates/footer');
    }

    public function getDataByDate(){
    
        $data['date_show_data'] = $_POST['date_show'];
        $post_data=array("date_choosen"=>$_POST['date_show']);
        
        $rptObj=$this->ar_model->getData($post_data);
        $rptTot=$this->ar_model->getTotalTagihan($post_data);

        $output = array(
            "rptobj"=>$rptObj,
            "rptot"=>$rptTot,
            "result"=>"ok"
        );

        echo json_encode($output);

}

}
