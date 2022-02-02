<?php
class Sallary extends CI_Controller
{

    public function __construct() {  
        parent::__construct(); 

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/TRXExpensesModel','trx_exp_model');
        $this->load->library('Fungsi'); 

    } 
    
    public function index()
    {
        $data['judul']   = 'Sallary';
        $data['subMenu'] = "EXPENSES";
        $t = time();
        $data['date'] = date("d F Y", $t);

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/expenses/sidemenu', $data);
        $this->load->view('auth/expenses/sallary', $data);
        $this->load->view('auth/templates/footer');
    }


    public function sallarySave(){

        $data_post = $_POST;

        if($data_post['type']=="1"){

            $data= array(
                "nama"=> $data_post['nama'],
                "type"=> $data_post['type'],
                "jml_hari_kerja"=> str_replace(",", "", $data_post['jml_hari_kerja']),
                "upah_harian"=> str_replace(",", "", $data_post['upah_harian']),
                "upah_lembur"=> str_replace(",", "", $data_post['upah_lembur']),
                "create_date"=>date('YmdHis'),
                "update_date"=>date('YmdHis')

            );

            $this->trx_exp_model->insertSallary($data);

        }else{
            
            $data= array(
                "nama"=> $data_post['nama'],
                "type"=> $data_post['type'],
                "upah_bulanan"=> str_replace(",", "", $data_post['upah_bulanan']),
                "bulan"=>  $data_post['bulan'],
                "bonus"=> str_replace(",", "", $data_post['bonus']),
                "create_date"=>date('YmdHis'),
                "update_date"=>date('YmdHis')

            );

            $this->trx_exp_model->insertSallary($data);
        }

       $this->printPreview($data_post);

    }

    public function printPreview($data){


        $data['judul']   = 'Sallary';
        $data['subMenu'] = "EXPENSES";
        $t = time();
        $data['date'] = date("YmdHis");

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/expenses/sidemenu', $data);

        if($data['type']==="1"){
            $this->load->view('auth/expenses/sallary-preview-week', $data);
        }else{
            $this->load->view('auth/expenses/sallary-preview-month', $data);
        }       
        
        $this->load->view('auth/templates/footer');

    }

    public function printData(){

        $html="";
        $sallary_type="";

        $data_post = $_POST;

        $this->load->view('auth/templates/header', $data_post);
        
        if($data_post['type']=="1"){
            $sallary_type="Upah Mingguan";
            $html = $this->load->view('auth/expenses/download-sallary-week',$data_post,true);
        }else{
            $sallary_type="Upah Bulanan";
            $html = $this->load->view('auth/expenses/download-sallary-month',$data_post,true);
        }

        $this->fungsi->PdfGenerator($html,$sallary_type,'A4','potrait');
    }


}
