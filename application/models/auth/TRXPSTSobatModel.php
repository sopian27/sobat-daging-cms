<?php
class TRXPSTSobatModel extends CI_Model
{
    
    public function getTrxId()
    {

        $query = "SELECT 
                    max(trx_pst_sobat) as trx_id 
                FROM 
                    trx_update_pst_sobat 
                WHERE 
                    substring(create_date,1,8) =DATE_FORMAT(SYSDATE(), '%Y%m%d')";

        return $this->db->query($query)->result();
    }

    /*
    public function saveData($data)
    {
        $query = " INSERT INTO 
                trx_update_pst_sobat
                    (
                        id, trx_pst_sobat, kode, 
                        create_date, update_date, quantity, 
                        update_quantity, note
                    ) VALUES (
                        '', :trx_pst_sobat, :kode, 
                        DATE_FORMAT(SYSDATE(), '%Y%m%d%H%i%s'), DATE_FORMAT(SYSDATE(), '%Y%m%d%H%i%s'),
                        :quantity, :update_quantity, :note
                        ) ";
        $this->db->query($query);
        $this->db->bind('trx_pst_sobat', $data['trx']);
        $this->db->bind('kode', $data['kode']);
        $this->db->bind('quantity', $data['quantity']);
        $this->db->bind('update_quantity', $data['quantity_update']);
        $this->db->bind('note', $data['note']);
        
        $this->db->execute();
        return $this->db->rowCount();
    }
    */

    public function getPstData()
    {
        $query = "SELECT b.id,b.kode,b.nama_barang,b.quantity_sobat,b.satuan,p.create_date 
                FROM barang b left join trx_update_pst_sobat p on b.kode = p.kode ";

        return $this->db->query($query)->result();
    }

    public function insertData($data)
    {
        $this->db->insert('trx_update_pst_sobat', $data);
        return $this->db->insert_id();
    }

    public function getTrxSobat($id_trx_pst,$halaman,$batasTampilData){
        $query="SELECT b.id,b.kode,b.nama_barang,b.quantity_sobat,trx.update_quantity,b.satuan,trx.status,trx.note
        from barang b left join trx_update_pst_sobat trx on b.kode=trx.kode limit " . $halaman . ", " . $batasTampilData;

        return $this->db->query($query)->result();
    }

    public function getTrxSobatCount($id_trx_pst){
        $query="SELECT b.id,b.kode,b.nama_barang,b.quantity_pusat,trx.update_quantity,b.satuan
        from barang b left join trx_update_pst_sobat trx on b.kode=trx.kode";

        return $this->db->query($query)->result();
    }

    public function deleteData($where)
    {
        $this->db->delete('trx_update_pst_sobat', $where);
    }

    public function update($data, $where)
    {
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update('trx_update_pst_sobat');
    }
}
