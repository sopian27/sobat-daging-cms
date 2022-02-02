<?php

class TRXMutasiModel extends CI_Model
{

    public function getTrxId()
    {

        $query = "SELECT 
                    max(id_trx_mutasi) as trx_id 
                FROM 
                    trx_mutasi 
                WHERE 
                    substring(create_date,1,8) =DATE_FORMAT(SYSDATE(), '%Y%m%d')";

        return $this->db->query($query)->result();
    }
}
