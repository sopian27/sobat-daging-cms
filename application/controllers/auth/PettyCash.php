<?php

class PettyCash extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('auth/TRXPettyInModel', 'trx_petty_in_model');
        $this->load->library('upload');
    }


    public function index()
    {

        $data['judul']   = 'Petty In';
        $data['subMenu'] = "PETTY CASH";
        $t = time();
        $data['date'] = date("d F Y", $t);
        $current_date = date("d/m/Y", $t);
        $trxData = $this->trx_petty_in_model->getTrxId();
        $saldo = $this->trx_petty_in_model->getSaldo();
        $trxId = $trxData[0]->trx_id;

        if (empty($saldo)) {
            $data['saldo'] = "0";
        } else {
            $data['saldo'] = $saldo[0]->saldo;
        }

        $lastNoUrut = substr($trxId, 5, 4);
        $nextNoUrut = intval($lastNoUrut) + 1;
        $kodePo = 'PCPI-' . sprintf('%04s', $nextNoUrut) . "/" . $current_date;
        $data['kode_po'] = $kodePo;

        $this->load->view('auth/templates/header', $data);
        $this->load->view('auth/templates/petty/sidemenu', $data);
        $this->load->view('auth/petty/petty-in', $data);
        $this->load->view('auth/templates/footer');
    }

    public function getData()
    {
        $saldo = $this->trx_petty_in_model->getSaldo();

        if (empty($saldo)) {
            $data['saldo'] = "0";
        } else {
            $data['saldo'] = $saldo[0]->saldo;
        }

        echo json_encode($data);
    }

    public function pettyInSave()
    {

        $data_post = $_POST;
        $file = $_FILES;
        $path = "uploads";
        $file_name = $file["upload_bukti"]["name"];

        if($_FILES['upload_bukti']['name'] != "") {

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
                    "saldo_awal" =>  $data_post['saldo_awal'], //str_replace(".", "", $data_post['saldo_awal']),
                    "tambahan_saldo" =>  str_replace(",", "", $data_post['tambahan_saldo']),
                    "keterangan" => $data_post['keterangan'],
                    "id_trx_petty_cash" => $data_post['id_trx_petty_cash'],
                    "upload_bukti" => $file_name,
                    "create_date" => date('YmdHis'),
                    "update_date" => date('YmdHis')
                );

                $this->trx_petty_in_model->insertData($data);
            }
        }else{

            $data = array(
                "saldo_awal" =>  $data_post['saldo_awal'], //str_replace(".", "", $data_post['saldo_awal']),
                "tambahan_saldo" =>  str_replace(",", "", $data_post['tambahan_saldo']),
                "keterangan" => $data_post['keterangan'],
                "id_trx_petty_cash" => $data_post['id_trx_petty_cash'],
                "create_date" => date('YmdHis'),
                "update_date" => date('YmdHis')
            );

            $this->trx_petty_in_model->insertData($data);
        }

        echo json_encode("success");
    }
}
