<?php
class TRXOtherIncomeModel extends CI_Model
{

    public function insertData($data){
        $this->db->insert('ot_income', $data);      
        return $this->db->insert_id();  
    }

    public function getTrxId()
    {

        $query = " select max(id_trx_ot) as trx_id from ot_income where substring(create_date,1,8) =DATE_FORMAT(SYSDATE(), '%Y%m%d')";

        return $this->db->query($query)->result();
    }

    public function getDataOtherByDate($data)
    {
        $date = $data['date_value'];
        $query = " SELECT penggunaan_dana,keterangan,id_trx_ot as kode 
                   FROM ot_income 
                   WHERE substring(create_date,1,6) = '$date'";

        return $this->db->query($query)->result();
    }

    public function getDataSumOtherByDate($data)
    {
        $date = $data['date_value'];
        $query = " SELECT sum(penggunaan_dana) as total
                   FROM ot_income 
                   WHERE substring(create_date,1,6) ='$date' group by substring(create_date,1,6) ";

        return $this->db->query($query)->result();
    }
}
