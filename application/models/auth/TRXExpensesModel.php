<?php
class TRXExpensesModel extends CI_Model
{

    public function insertData($data)
    {
        $this->db->insert('ex_opt', $data);
        return $this->db->insert_id();
    }

    public function insertSallary($data)
    {
        $this->db->insert('ex_sallary', $data);
        return $this->db->insert_id();
    }

    public function getTrxId()
    {

        $query = " select max(id_trx_ex_opt) as trx_id from ex_opt where substring(create_date,1,8) =DATE_FORMAT(SYSDATE(), '%Y%m%d')";

        return $this->db->query($query)->result();
    }

    public function getDataExpensesByDate($data)
    {
        $date = $data['date_value'];
        $query = " SELECT penggunaan_dana,keterangan,id_trx_ex_opt as kode 
                   FROM ex_opt 
                   WHERE substring(create_date,1,6) ='$date'";
        return $this->db->query($query)->result();
    }

    public function getDataSumExpensesByDate($data)
    {
        $date = $data['date_value'];
        $query = " SELECT sum(penggunaan_dana) as total
                   FROM ex_opt 
                   WHERE substring(create_date,1,6) ='$date' group by substring(create_date,1,6) ";

        return $this->db->query($query)->result();
    }
}
