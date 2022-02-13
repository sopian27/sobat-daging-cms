<?php
class TRXPSTPusatModel extends CI_Model
{
    public function getTrxId()
    {

        $query = "SELECT 
                    count(trx_pst_pusat) as trx_id 
                FROM 
                    trx_update_pst_pusat 
                WHERE 
                    substring(create_date,1,8) =DATE_FORMAT(SYSDATE(), '%Y%m%d')";

        return $this->db->query($query)->result();
    }


    public function getPstData()
    {
        $query = "SELECT b.id,b.kode,b.nama_barang,b.quantity_pusat,b.satuan,p.create_date,p.note,p.update_quantity 
                FROM barang b left join trx_update_pst_pusat p on b.kode = p.kode ";

        return $this->db->query($query)->result();
    }

    public function insertData($data)
    {
        $this->db->insert('trx_update_pst_pusat', $data);
        return $this->db->insert_id();
    }

}
