<?php
class OtherIncome extends CI_Controller
{

    public function __construct() {  
        parent::__construct(); 

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/TRXOtherIncomeModel','trx_other_inc_model');    

    } 
    
    public function index()
    {
        $data['judul']   = 'Billing Other Income';
        $data['subMenu'] = "OTHER INCOME";
        $t = time();
        $data['date'] = date("d F Y", $t);
        $current_date = date("d/m/Y", $t);
        $trxData = $this->trx_other_inc_model->getTrxId();
        $trxId = $trxData[0]->trx_id;

        $lastNoUrut = substr($trxId, 5,4);
        $nextNoUrut = intval($lastNoUrut)+1;
        $kodePo = 'OI-'. sprintf('%04s',$nextNoUrut)."/".$current_date;
        $data['kode_po'] = $kodePo;

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/other/sidemenu', $data);
        $this->load->view('auth/other/billing', $data);
        $this->load->view('auth/templates/footer');
    }


    public function otherSave(){

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

}
