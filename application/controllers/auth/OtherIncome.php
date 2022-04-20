<?php
class OtherIncome extends CI_Controller
{

    public function __construct() {  
        parent::__construct(); 

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/TRXOtherIncomeModel','trx_other_inc_model');  
        $this->load->library('upload');  

    } 
    
    public function index()
    {
        $data['judul']   = 'Billing Other Income';
        $data['subMenu'] = "OTHER INCOME";
        $t = time();
        $data['date'] = date("d F Y", $t);
        $current_date = date("d/m/Y", $t);
/*         $trxData = $this->trx_other_inc_model->getTrxId();
        $trxId = $trxData[0]->trx_id;

        $lastNoUrut = substr($trxId, 5,4);
        $nextNoUrut = intval($lastNoUrut)+1;
        $kodePo = 'OI-'. sprintf('%04s',$nextNoUrut)."/".$current_date;
        $data['kode_po'] = $kodePo; */

        $tgl_trx = date("Y-m-d");

        $trxData = $this->trx_other_inc_model->getTrxId($tgl_trx);
        $datax = $trxData[0]->trx_id;
        $lastNoUrut = substr($datax, 3,5);
        $nextNoUrut = intval($lastNoUrut)+1;
        $kodePo = 'OI-' . sprintf('%05s',$nextNoUrut)."/". date('d/m/Y',strtotime($tgl_trx));

        $data['kode_po'] = $kodePo;

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/other/sidemenu', $data);
        $this->load->view('auth/other/billing', $data);
        $this->load->view('auth/templates/footer');
    }


    public function otherSave2(){

        $data_post = $_POST;

        $data=array(
            "penggunaan_dana" => str_replace(",", "", $data_post['penggunaan_dana']),
            "keterangan" =>  $data_post['keterangan'],
            "id_trx_ot"=> $data_post['id_trx_ot'],
            "create_date"=>date('YmdHis'),
            "update_date"=>date('YmdHis')
        );

        $this->trx_other_inc_model->insertData($data);

        redirect('other');

    }

    public function otherSave()
    {

        $data_post = $_POST;
        $file = $_FILES;
        $path = "uploads";
        $file_name = $file["upload_bukti"]["name"];

        $config['file_name']            = $file_name;
        $config['upload_path']          = './' . $path;
        $config['allowed_types']        = "jpg|png|jpeg";
        $config['overwrite']            = TRUE;
        //$config['max_size']             = $this->upload_size;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('upload_bukti')) {
            $this->session->set_flashdata('upload_failed', $this->upload->display_errors());
        } else {

            $data=array(
                "penggunaan_dana" => str_replace(",", "", $data_post['penggunaan_dana']),
                "keterangan" =>  $data_post['keterangan'],
                "id_trx_ot"=> $data_post['id_trx_ot'],
                "upload_bukti" => $file_name,
                "create_date"=>date('YmdHis'),
                "update_date"=>date('YmdHis')
            );
    
            $this->trx_other_inc_model->insertData($data);

        }

        echo ( "<script LANGUAGE='JavaScript'>
                window.alert('Succesfully insert');
                window.location.href='".site_url()."/other';
                </script>");
        //redirect('expenses');
    }


}
