<?php

class HistoryExpenses extends CI_Controller
{

    public function __construct() {  
        parent::__construct(); 

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/TRXExpensesModel','trx_expenses');    

    } 

    public function index()
    {

        $data['judul']   = 'History Expenses';
        $data['subMenu'] = "EXPENSES";
        $t = time();
        $data['date'] = date("d F Y", $t);

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/expenses/sidemenu', $data);
        $this->load->view('auth/expenses/history-expenses', $data);
        $this->load->view('auth/templates/footer');
    }

    public function getData()
    {
        
        $dataExpenses = array();
        $dataExpenses  = $this->trx_expenses->getDataExpensesByDate($_POST);
        $dataExpensesTot  = $this->trx_expenses->getDataSumExpensesByDate($_POST);

        $data = array(
            "data" => $dataExpenses,
            "dataTot" => $dataExpensesTot,
            "result" => "ok"
        );

        echo json_encode($data);
    }

}
