<?php
class OperationalExpenses extends CI_Controller
{
    public function __construct() {  
        parent::__construct(); 

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/TRXExpensesModel','trx_exp_model');    

    } 

    public function index()
    {
        $data['judul']   = 'Operational Expenses';
        $data['subMenu'] = "EXPENSES";
        $t = time();
        $data['date'] = date("d F Y", $t);
        $current_date = date("d/m/Y", $t);
        $trxData = $this->trx_exp_model->getTrxId();
        $trxId = $trxData[0]->trx_id;

        $lastNoUrut = substr($trxId, 5,4);
        $nextNoUrut = intval($lastNoUrut)+1;
        $kodePo = 'OPEX-'. sprintf('%04s',$nextNoUrut)."/".$current_date;
        $data['kode_po'] = $kodePo;

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/expenses/sidemenu', $data);
        $this->load->view('auth/expenses/operational-expenses', $data);
        $this->load->view('auth/templates/footer');
    }


    public function exSave(){

        $data_post = $_POST;

        $data=array(
            "penggunaan_dana" => str_replace(",", "", $data_post['penggunaan_dana']),
            "keterangan" =>  $data_post['keterangan'],
            "id_trx_ex_opt"=> $data_post['id_trx_ex_opt'],
            "create_date"=>date('YmdHis'),
            "update_date"=>date('YmdHis')
        );

        $this->trx_exp_model->insertData($data);
        
        redirect('expenses');

    }

}
