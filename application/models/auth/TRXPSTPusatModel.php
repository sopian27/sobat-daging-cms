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

    public function getTrxPusat($id_trx_pst, $create_date, $keyword, $halaman, $batasTampilData)
    {
        /*
        $query = "SELECT b.id,b.kode,b.nama_barang,b.quantity_pusat,trx.update_quantity,b.satuan,trx.status,trx.note
        from barang b left join trx_update_pst_pusat trx on b.kode=trx.kode limit " . $halaman . ", " . $batasTampilData;
        */

        $query = "";

        if ($keyword != ""  && $create_date == "Januari, Februari, Maret....") {

            $query = "select c.id,c.kode,c.nama_barang,c.quantity_pusat,c.update_quantity,c.satuan,c.status,c.note,c.create_date from ( SELECT b.id,b.kode,b.nama_barang,b.quantity_pusat,trx.update_quantity,b.satuan,trx.status,trx.note,b.create_date
            from barang b left join trx_update_pst_pusat trx on b.kode=trx.kode and status ='0') c where c.nama_barang ='$keyword' limit " . $halaman . ", " . $batasTampilData;

        } else if ($keyword != "" && $create_date != "Januari, Februari, Maret....") {

            $query = "select c.id,c.kode,c.nama_barang,c.quantity_pusat,c.update_quantity,c.satuan,c.status,c.note,c.create_date from ( SELECT b.id,b.kode,b.nama_barang,b.quantity_pusat,trx.update_quantity,b.satuan,trx.status,trx.note,b.create_date
            from barang b left join trx_update_pst_pusat trx on b.kode=trx.kode and status ='0') c where c.nama_barang ='$keyword' and substring(c.create_date,1,6) ='$create_date' limit " . $halaman . ", " . $batasTampilData;

        } else if ( $create_date != "Januari, Februari, Maret....") {

            $query = "select c.id,c.kode,c.nama_barang,c.quantity_pusat,c.update_quantity,c.satuan,c.status,c.note,c.create_date from ( SELECT b.id,b.kode,b.nama_barang,b.quantity_pusat,trx.update_quantity,b.satuan,trx.status,trx.note,b.create_date
            from barang b left join trx_update_pst_pusat trx on b.kode=trx.kode and status ='0') c where substring(c.create_date,1,6) ='$create_date' limit " . $halaman . ", " . $batasTampilData;

        }else{
            $query = "select c.id,c.kode,c.nama_barang,c.quantity_pusat,c.update_quantity,c.satuan,c.status,c.note,c.create_date from ( SELECT b.id,b.kode,b.nama_barang,b.quantity_pusat,trx.update_quantity,b.satuan,trx.status,trx.note,b.create_date
            from barang b left join trx_update_pst_pusat trx on b.kode=trx.kode and status ='0') c limit " . $halaman . ", " . $batasTampilData;

        }

        return $this->db->query($query)->result();
    }

    public function getTrxPusatCount($id_trx_pst,$create_date, $keyword)
    {
        $query = "";

        if ($keyword != ""  && $create_date == "Januari, Februari, Maret....") {

            $query = "select c.id,c.kode,c.nama_barang,c.quantity_pusat,c.update_quantity,c.satuan,c.status,c.note,c.create_date from ( SELECT b.id,b.kode,b.nama_barang,b.quantity_pusat,trx.update_quantity,b.satuan,trx.status,trx.note,b.create_date
            from barang b left join trx_update_pst_pusat trx on b.kode=trx.kode and status ='0') c where c.nama_barang ='$keyword'";

        } else if ($keyword != "" && $create_date != "Januari, Februari, Maret....") {

            $query = "select c.id,c.kode,c.nama_barang,c.quantity_pusat,c.update_quantity,c.satuan,c.status,c.note,c.create_date from ( SELECT b.id,b.kode,b.nama_barang,b.quantity_pusat,trx.update_quantity,b.satuan,trx.status,trx.note,b.create_date
            from barang b left join trx_update_pst_pusat trx on b.kode=trx.kode and status ='0') c where c.nama_barang ='$keyword' and substring(c.create_date,1,6) ='$create_date'";

        } else if ( $create_date != "Januari, Februari, Maret....") {

            $query = "select c.id,c.kode,c.nama_barang,c.quantity_pusat,c.update_quantity,c.satuan,c.status,c.note,c.create_date from ( SELECT b.id,b.kode,b.nama_barang,b.quantity_pusat,trx.update_quantity,b.satuan,trx.status,trx.note,b.create_date
            from barang b left join trx_update_pst_pusat trx on b.kode=trx.kode and status ='0') c where substring(c.create_date,1,6) ='$create_date' ";

        }else{
            $query = "select c.id,c.kode,c.nama_barang,c.quantity_pusat,c.update_quantity,c.satuan,c.status,c.note,c.create_date from ( SELECT b.id,b.kode,b.nama_barang,b.quantity_pusat,trx.update_quantity,b.satuan,trx.status,trx.note,b.create_date
            from barang b left join trx_update_pst_pusat trx on b.kode=trx.kode and status ='0') c ";

        }
        

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

    public function getWhere($where)
    {
        return $this->db->get_where('trx_update_pst_pusat', $where)->result();
    }
}
