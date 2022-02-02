<?php
class TRXPSTPusat extends CI_Model
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

    
    public function saveData($data)
    {

        $query = " INSERT INTO 
        trx_update_pst_pusat
            (
                id, trx_pst_pusat, kode, 
                create_date, update_date, quantity, 
                update_quantity, note
            ) VALUES (
                '', :trx_pst_pusat, :kode, 
                DATE_FORMAT(SYSDATE(), '%Y%m%d%H%i%s'), DATE_FORMAT(SYSDATE(), '%Y%m%d%H%i%s'),
                :quantity, :update_quantity, :note
                ) ";
        $this->db->query($query);
        $this->db->bind('trx_pst_pusat', $data['trx']);
        $this->db->bind('kode', $data['kode']);
        $this->db->bind('quantity', $data['quantity']);
        $this->db->bind('update_quantity', $data['quantity_update']);
        $this->db->bind('note', $data['note']);

        $this->db->execute();
        return $this->db->rowCount();
    }
}
