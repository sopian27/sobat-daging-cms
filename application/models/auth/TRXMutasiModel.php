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

    public function insertDataBatch($data)
    {
        $this->db->insert_batch('trx_mutasi', $data);
    }

    public function insertData($data)
    {
        $this->db->insert('trx_mutasi', $data);
        return $this->db->insert_id();
    }

    public function update($data, $where)
    {
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update('trx_mutasi');
    }

    public function getTrxMutasi($id_trx_mutasi,$halaman,$batasTampilData){
        $query="SELECT b.id,b.kode,b.nama_barang,b.quantity_pusat,trx.quantity_mutasi,b.satuan,trx.status 
        from barang b left join trx_mutasi trx on b.kode=trx.kode limit " . $halaman . ", " . $batasTampilData;

        return $this->db->query($query)->result();
    }

    public function getTrxMutasiCount($id_trx_mutasi){
        $query="SELECT b.id,b.kode,b.nama_barang,b.quantity_pusat,trx.quantity_mutasi,b.satuan
        from barang b left join trx_mutasi trx on b.kode=trx.kode";

        return $this->db->query($query)->result();
    }

    public function deleteData($where)
    {
        $this->db->delete('trx_mutasi', $where);
    }

    
}
