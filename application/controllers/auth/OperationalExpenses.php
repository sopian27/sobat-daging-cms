<?php
class OperationalExpenses extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/TRXExpensesModel', 'trx_exp_model');
        $this->load->library('upload');
    }

    public function index()
    {
        $data['judul']   = 'Operational Expenses';
        $data['subMenu'] = "EXPENSES";
        $t = time();
        $data['date'] = date("d F Y", $t);
        //$current_date = date("d/m/Y", $t);
        /* $trxData = $this->trx_exp_model->getTrxId();
        $trxId = $trxData[0]->trx_id;

        $lastNoUrut = substr($trxId, 5, 4);
        $nextNoUrut = intval($lastNoUrut) + 1;
        $kodePo = 'OPEX-' . sprintf('%04s', $nextNoUrut) . "/" . $current_date;
        $data['kode_po'] = $kodePo; */
        $tgl_trx = date("Y-m-d");

        $trxData = $this->trx_exp_model->getTrxId($tgl_trx);
        $datax = $trxData[0]->trx_id;
        $lastNoUrut = substr($datax, 5,5);
        $nextNoUrut = intval($lastNoUrut)+1;
        $kodePo = 'OPEX-' . sprintf('%05s',$nextNoUrut)."/". date('d/m/Y',strtotime($tgl_trx));

        $data['kode_po'] = $kodePo;

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/expenses/sidemenu', $data);
        $this->load->view('auth/expenses/operational-expenses', $data);
        $this->load->view('auth/templates/footer');
    }


    public function exSavebak()
    {

        $data_post = $_POST;
        $config = array(
            'upload_path' => "./uploads/",
            'allowed_types' => "jpg|png|jpeg",
            'overwrite' => TRUE,
            'max_size' => "10240000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
        );

        $this->load->library('upload', $config);
        if ($this->upload->do_upload()) {
            $data = array('upload_data' => $this->upload->data());
            //$this->load->view('upload_success', $data);
            $this->trx_exp_model->insertData($data);
        } else {
            $error = array('error' => $this->upload->display_errors());
            //$this->load->view('custom_view', $error);
        }

        redirect('expenses');
    }

    public function exSave()
    {

        $post = $_POST;
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

            $data = array(
                "penggunaan_dana" => str_replace(",", "", $post['penggunaan_dana']),
                "keterangan" =>  $post['keterangan'],
                "id_trx_ex_opt" => $post['id_trx_ex_opt'],
                "upload_bukti" => $file_name,
                "create_date" => date('YmdHis'),
                "update_date" => date('YmdHis')
            );

            $this->trx_exp_model->insertData($data);

        }

        echo ( "<script LANGUAGE='JavaScript'>
                window.alert('Succesfully insert');
                window.location.href='".site_url()."/expenses';
                </script>");
        //redirect('expenses');
    }
}
