<?php
class TRXPSTPusatModel extends CI_Model
{
    public function getTrxId()
    {

        $query = "SELECT 
                    max(trx_pst_pusat) as trx_id 
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

    public function getTrxPusat($id_trx_pst,$halaman,$batasTampilData){
        $query="SELECT b.id,b.kode,b.nama_barang,b.quantity_pusat,trx.update_quantity,b.satuan,trx.status,trx.note
        from barang b left join trx_update_pst_pusat trx on b.kode=trx.kode limit " . $halaman . ", " . $batasTampilData;

        return $this->db->query($query)->result();
    }

    public function getTrxPusatCount($id_trx_pst){
        $query="SELECT b.id,b.kode,b.nama_barang,b.quantity_pusat,trx.update_quantity,b.satuan
        from barang b left join trx_update_pst_pusat trx on b.kode=trx.kode";

        return $this->db->query($query)->result();
    }

    public function deleteData($where)
    {
        $this->db->delete('trx_update_pst_pusat', $where);
    }

    public function update($data, $where)
    {
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update('trx_update_pst_pusat');
    }


    public function getTrxIdPst()
    {

        $query = "SELECT 
                    max(trx_id) as trx_id 
                FROM 
                    barang_pst 
                WHERE 
                    substring(create_date,1,8) =DATE_FORMAT(SYSDATE(), '%Y%m%d')";

        return $this->db->query($query)->result();
    }

    public function insertDataPst($data)
    {
        $this->db->insert('barang_pst', $data);
        return $this->db->insert_id();
    }



}
