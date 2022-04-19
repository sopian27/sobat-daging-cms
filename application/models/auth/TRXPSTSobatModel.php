<?php
class TRXPSTSobatModel extends CI_Model
{
    
    public function getTrxId($tgl_trx)
    {

        $query = "SELECT 
                    max(trx_pst_sobat) as trx_id 
                FROM 
                    trx_update_pst_sobat 
                WHERE 
                date_format(create_date,'%Y-%m-%d') = '$tgl_trx'";

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

    /*
    public function getTrxSobat($id_trx_pst,$halaman,$batasTampilData){
        $query="SELECT b.id,b.kode,b.nama_barang,b.quantity_sobat,trx.update_quantity,b.satuan,trx.status,trx.note
        from barang b left join trx_update_pst_sobat trx on b.kode=trx.kode limit " . $halaman . ", " . $batasTampilData;

        return $this->db->query($query)->result();
    }

    public function getTrxSobatCount($id_trx_pst){
        $query="SELECT b.id,b.kode,b.nama_barang,b.quantity_sobat,trx.update_quantity,b.satuan
        from barang b left join trx_update_pst_sobat trx on b.kode=trx.kode";

        return $this->db->query($query)->result();
    }*/

    public function getTrxSobat($id_trx_pst, $create_date, $keyword, $halaman, $batasTampilData)
    {
        /*
        $query = "SELECT b.id,b.kode,b.nama_barang,b.quantity_sobat,trx.update_quantity,b.satuan,trx.status,trx.note
        from barang b left join trx_update_pst_sobat trx on b.kode=trx.kode limit " . $halaman . ", " . $batasTampilData;
        */

        $query = "";

        if ($keyword != ""  && $create_date == "Januari, Februari, Maret....") {

            $query = "select c.id,c.kode,c.nama_barang,c.quantity_sobat,c.update_quantity,c.satuan,c.status,c.note,c.create_date from ( SELECT b.id,b.kode,b.nama_barang,b.quantity_sobat,trx.update_quantity,b.satuan,trx.status,trx.note,b.create_date
            from barang b left join trx_update_pst_sobat trx on b.kode=trx.kode and status ='0') c where c.nama_barang ='$keyword' limit " . $halaman . ", " . $batasTampilData;

        } else if ($keyword != "" && $create_date != "Januari, Februari, Maret....") {

            $query = "select c.id,c.kode,c.nama_barang,c.quantity_sobat,c.update_quantity,c.satuan,c.status,c.note,c.create_date from ( SELECT b.id,b.kode,b.nama_barang,b.quantity_sobat,trx.update_quantity,b.satuan,trx.status,trx.note,b.create_date
            from barang b left join trx_update_pst_sobat trx on b.kode=trx.kode and status ='0') c where c.nama_barang ='$keyword' and date_format(c.create_date,'%Y%m') = '$create_date' limit " . $halaman . ", " . $batasTampilData;

        } else if ( $create_date != "Januari, Februari, Maret....") {

            $query = "select c.id,c.kode,c.nama_barang,c.quantity_sobat,c.update_quantity,c.satuan,c.status,c.note,c.create_date from ( SELECT b.id,b.kode,b.nama_barang,b.quantity_sobat,trx.update_quantity,b.satuan,trx.status,trx.note,b.create_date
            from barang b left join trx_update_pst_sobat trx on b.kode=trx.kode and status ='0') c where date_format(c.create_date,'%Y%m') = '$create_date'  limit " . $halaman . ", " . $batasTampilData;

        }else{
            $query = "select c.id,c.kode,c.nama_barang,c.quantity_sobat,c.update_quantity,c.satuan,c.status,c.note,c.create_date from ( SELECT b.id,b.kode,b.nama_barang,b.quantity_sobat,trx.update_quantity,b.satuan,trx.status,trx.note,b.create_date
            from barang b left join trx_update_pst_sobat trx on b.kode=trx.kode and status ='0') c limit " . $halaman . ", " . $batasTampilData;

        }

        //echo $query;
        return $this->db->query($query)->result();
    }

    public function getTrxSobatCount($id_trx_pst,$create_date, $keyword)
    {
        $query = "";

        if ($keyword != ""  && $create_date == "Januari, Februari, Maret....") {

            $query = "select c.id,c.kode,c.nama_barang,c.quantity_sobat,c.update_quantity,c.satuan,c.status,c.note,c.create_date from ( SELECT b.id,b.kode,b.nama_barang,b.quantity_sobat,trx.update_quantity,b.satuan,trx.status,trx.note,b.create_date
            from barang b left join trx_update_pst_sobat trx on b.kode=trx.kode and status ='0') c where c.nama_barang ='$keyword'";

        } else if ($keyword != "" && $create_date != "Januari, Februari, Maret....") {

            $query = "select c.id,c.kode,c.nama_barang,c.quantity_sobat,c.update_quantity,c.satuan,c.status,c.note,c.create_date from ( SELECT b.id,b.kode,b.nama_barang,b.quantity_sobat,trx.update_quantity,b.satuan,trx.status,trx.note,b.create_date
            from barang b left join trx_update_pst_sobat trx on b.kode=trx.kode and status ='0') c where c.nama_barang ='$keyword' and date_format(c.create_date,'%Y%m') = '$create_date'";

        } else if ( $create_date != "Januari, Februari, Maret....") {

            $query = "select c.id,c.kode,c.nama_barang,c.quantity_sobat,c.update_quantity,c.satuan,c.status,c.note,c.create_date from ( SELECT b.id,b.kode,b.nama_barang,b.quantity_sobat,trx.update_quantity,b.satuan,trx.status,trx.note,b.create_date
            from barang b left join trx_update_pst_sobat trx on b.kode=trx.kode and status ='0') c where date_format(c.create_date,'%Y%m') = '$create_date' ";

        }else{
            $query = "select c.id,c.kode,c.nama_barang,c.quantity_sobat,c.update_quantity,c.satuan,c.status,c.note,c.create_date from ( SELECT b.id,b.kode,b.nama_barang,b.quantity_sobat,trx.update_quantity,b.satuan,trx.status,trx.note,b.create_date
            from barang b left join trx_update_pst_sobat trx on b.kode=trx.kode and status ='0') c ";

        }

        return $this->db->query($query)->result();
    }

    public function getTrxSobatNew($id_trx_pst, $create_date, $keyword, $halaman, $batasTampilData)
    {

        $query = "";

        if ($keyword != ""  && $create_date == "Januari, Februari, Maret....") {

            $query = "select c.id,c.kode,c.nama_barang,c.quantity_sobat,c.update_quantity,c.satuan,c.status,c.note,c.create_date from ( SELECT b.id,b.kode,b.nama_barang,b.quantity_sobat,trx.update_quantity,b.satuan,trx.status,trx.note,b.create_date
            from barang b left join trx_update_pst_sobat trx on b.kode=trx.kode and status ='0') c where c.nama_barang ='$keyword' limit " . $halaman . ", " . $batasTampilData;

        } else if ($keyword != "" && $create_date != "Januari, Februari, Maret....") {

            $query = "select c.id,c.kode,c.nama_barang,c.quantity_sobat,c.update_quantity,c.satuan,c.status,c.note,c.create_date from ( SELECT b.id,b.kode,b.nama_barang,b.quantity_sobat,trx.update_quantity,b.satuan,trx.status,trx.note,b.create_date
            from barang b left join trx_update_pst_sobat trx on b.kode=trx.kode and status ='0') c where c.nama_barang ='$keyword' and date_format(c.create_date,'%Y%m') = '$create_date' limit " . $halaman . ", " . $batasTampilData;

        } else if ( $create_date != "Januari, Februari, Maret....") {

            $query = "select c.id,c.kode,c.nama_barang,c.quantity_sobat,c.update_quantity,c.satuan,c.status,c.note,c.create_date from ( SELECT b.id,b.kode,b.nama_barang,b.quantity_sobat,trx.update_quantity,b.satuan,trx.status,trx.note,b.create_date
            from barang b left join trx_update_pst_sobat trx on b.kode=trx.kode and status ='0') c where date_format(c.create_date,'%Y%m') = '$create_date'  limit " . $halaman . ", " . $batasTampilData;

        }else{
            $query = "select c.id,c.kode,c.nama_barang,c.quantity_sobat,c.update_quantity,c.satuan,c.status,c.note,c.create_date from ( SELECT b.id,b.kode,b.nama_barang,b.quantity_sobat,trx.update_quantity,b.satuan,trx.status,trx.note,b.create_date
            from barang b left join trx_update_pst_sobat trx on b.kode=trx.kode and status ='0') c limit " . $halaman . ", " . $batasTampilData;

        }

        return $this->db->query($query)->result();
    }

    public function getTrxSobatNewCount($id_trx_pst,$create_date, $keyword)
    {
        $query = "";

        if ($keyword != ""  && $create_date == "Januari, Februari, Maret....") {

            $query = "select c.id,c.kode,c.nama_barang,c.quantity_sobat,c.update_quantity,c.satuan,c.status,c.note,c.create_date from ( SELECT b.id,b.kode,b.nama_barang,b.quantity_sobat,trx.update_quantity,b.satuan,trx.status,trx.note,b.create_date
            from barang b left join trx_update_pst_sobat trx on b.kode=trx.kode and status ='0') c where c.nama_barang ='$keyword'";

        } else if ($keyword != "" && $create_date != "Januari, Februari, Maret....") {

            $query = "select c.id,c.kode,c.nama_barang,c.quantity_sobat,c.update_quantity,c.satuan,c.status,c.note,c.create_date from ( SELECT b.id,b.kode,b.nama_barang,b.quantity_sobat,trx.update_quantity,b.satuan,trx.status,trx.note,b.create_date
            from barang b left join trx_update_pst_sobat trx on b.kode=trx.kode and status ='0') c where c.nama_barang ='$keyword' and date_format(c.create_date,'%Y%m') = '$create_date'";

        } else if ( $create_date != "Januari, Februari, Maret....") {

            $query = "select c.id,c.kode,c.nama_barang,c.quantity_sobat,c.update_quantity,c.satuan,c.status,c.note,c.create_date from ( SELECT b.id,b.kode,b.nama_barang,b.quantity_sobat,trx.update_quantity,b.satuan,trx.status,trx.note,b.create_date
            from barang b left join trx_update_pst_sobat trx on b.kode=trx.kode and status ='0') c where date_format(c.create_date,'%Y%m') = '$create_date' ";

        }else{
            $query = "select c.id,c.kode,c.nama_barang,c.quantity_sobat,c.update_quantity,c.satuan,c.status,c.note,c.create_date from ( SELECT b.id,b.kode,b.nama_barang,b.quantity_sobat,trx.update_quantity,b.satuan,trx.status,trx.note,b.create_date
            from barang b left join trx_update_pst_sobat trx on b.kode=trx.kode and status ='0') c ";

        }

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

    public function getWhere($where)
    {
        return $this->db->get_where('trx_update_pst_sobat', $where)->result();
    }
}
