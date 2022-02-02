<?php
class TRXPettyOutModel extends CI_Model
{

    public function insertData($data)
    {
        $this->db->insert('trx_petty_out', $data);
        return $this->db->insert_id();
    }

    public function getTrxId()
    {

        $query = " select max(id_trx_petty_cash) as trx_id from trx_petty_out where substring(create_date,1,8) =DATE_FORMAT(SYSDATE(), '%Y%m%d')";

        return $this->db->query($query)->result();
    }

    public function getSaldoByDate($data)
    {
        $date = $data['date_value'];
        $query = " SELECT sum(tambahan_saldo) as total,substring(create_date,5,2) as date
                   FROM trx_petty_out 
                   WHERE substring(create_date,1,6) ='$date' group by substring(create_date,5,2)";

        return $this->db->query($query)->result();
    }

    public function getSaldoByCurrentDate()
    {

        $query = " SELECT sum(tambahan_saldo) as total,substring(create_date,5,2) as date
                   FROM trx_petty_out
                   WHERE substring(create_date,1,4) =DATE_FORMAT(SYSDATE(), '%Y') group by substring(create_date,5,2)";

        return $this->db->query($query)->result();
    }


    public function getDataByDate($data)
    {
        $date = substr($data['date_value']);
        $query = " SELECT id_trx_petty_cash as kode,tambahan_saldo,keterangan 
                   FROM trx_petty_out 
                   WHERE substring(create_date,1,6) ='$date'";

        return $this->db->query($query)->result();
    }
}
