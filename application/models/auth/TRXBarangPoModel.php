<?php
class TRXBarangPoModel extends CI_Model
{

    public function getAllData()
    {
        $query = " SELECT tbo.id_trx_po, s.nama, tbo.create_date, tbo.date_sampai
                    FROM 
                        trx_barang_po tbo, 
                        barang b, 
                        supplier s 
                    WHERE 
                        tbo.kode = b.kode 
                    and 
                        tbo.id_supplier = s.id ";

        return $this->db->query($query)->result();
    }

    public function getDataByid($id_trx_po)
    {
        $query = " SELECT 
                    b.kode, 
                    b.nama_barang, 
                    b.satuan, 
                    b.harga_satuan,
                    tbo.id,
                    tbo.quantity, 
                    tbo.id_trx_po,
                    tbo.quantity_check 
                FROM 
                    trx_barang_po tbo 
                INNER JOIN 
                    barang b on tbo.kode = b.kode 
                WHERE tbo.id_trx_po = '$id_trx_po'";
       
       return $this->db->query($query)->result();
    }


    public function selectDistinct()
    {
        $query = " SELECT DISTINCT tbo.id_trx_po, s.nama, tbo.create_date, tbo.date_sampai
                    FROM 
                        trx_barang_po tbo, 
                        supplier s 
                    WHERE 
                        tbo.id_supplier = s.id 
                ";

        return $this->db->query($query)->result();
    }

    /*
    public function selectDistictByDate($month)
    {

        $query = " SELECT DISTINCT tbo.id_trx_po, s.nama, tbo.create_date, tbo.status, tbo.date_sampai
                    FROM 
                        trx_barang_po tbo, 
                        supplier s 
                    WHERE 
                        tbo.id_supplier = s.id  
                    AND tbo.create_date LIKE :month
                ";

        $this->db->query($query);
        $this->db->bind('month', $month . '%');
        $allData = $this->db->resultset();
        return $allData;
    }
    */

    public function selectDistinctSearch($search)
    {
        $query = " SELECT DISTINCT tbo.id_trx_po, s.nama, tbo.create_date, tbo.status, tbo.date_sampai
                    FROM 
                        trx_barang_po tbo, 
                        supplier s 
                    WHERE 
                        tbo.id_supplier = s.id  
                    AND s.nama Like '%' ". $search." '%' ";

        return $this->db->query($query)->result();
    }


    /*
    public function OneData($id)
    {
        $query = "  SELECT 
                b.kode, 
                b.nama_barang, 
                b.satuan, 
                tbo.id,
                tbo.quantity, 
                tbo.id_trx_po 
            FROM 
                trx_barang_po tbo 
            INNER JOIN 
                barang b on tbo.kode = b.kode
            WHERE tbo.id =:id
            ";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $allData = $this->db->resultset();
        return $allData;
    }


    public function CountExsistDataById()
    {
        $query = "  SELECT 
                        count(*) as CountData 
                    FROM 
                        trx_barang_po tbo
                ";
        $this->db->query($query);
        $allData = $this->db->single();
        return $allData;
    }

    public function insertDataPOInvMenu($data)
    {
        $query = "INSERT INTO trx_barang_po(
                            id, kode, quantity, 
                            create_date, update_date, 
                            id_trx_po, id_supplier, status
            ) VALUES (
                            '', :kode, :quantity, 
                            DATE_FORMAT(SYSDATE(), '%Y%m%d%H%i%s'), DATE_FORMAT(SYSDATE(), '%Y%m%d%H%i%s'), 
                            :id_trx_po, :id_supplier, :status
                )";

        $this->db->query($query);
        $this->db->bind('kode', $data['kode']);
        $this->db->bind('quantity', $data['quantity']);
        $this->db->bind('id_trx_po', $data['id_trx_po']);
        $this->db->bind('id_supplier', $data['id_supplier']);
        // $this->db->bind('counter', $data['counter']);
        $this->db->bind('status', $data['status']);

        $this->db->execute();
        return $this->db->rowCount();
    }
    
    */

    public function insertData($data)
    {
        $this->db->insert('trx_barang_po', $data);
        return $this->db->insert_id();
    }

    /*
    public function insertDataPOInvMenuForUpdate($data)
    {
        $query = "INSERT INTO trx_barang_po(
                            id, kode, quantity, 
                            create_date, update_date, 
                            id_trx_po, id_supplier
            ) VALUES (
                            '', :kode, :quantity, 
                            :create_date, DATE_FORMAT(SYSDATE(), '%Y%m%d%H%i%s'), 
                            :id_trx_po, :id_supplier
                )";

        $this->db->query($query);
        $this->db->bind('kode', $data['kode']);
        $this->db->bind('quantity', $data['quantity']);
        $this->db->bind('id_trx_po', $data['id_trx_po']);
        $this->db->bind('id_supplier', $data['id_supplier']);
        $this->db->bind('create_date', $data['create_date']);
        // $this->db->bind('counter', $data['counter']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateDataPOInvMenu($data)
    {
        $query = " UPDATE trx_barang_po SET 
                        kode=:kode,
                        quantity=:quantity,
                        update_date=DATE_FORMAT(SYSDATE(), '%Y%m%d%H%i%s'),
                        id_trx_update=:id_trx_update,
                        id_supplier=:id_supplier
                    WHERE 
                        id=:id
        ";
        $this->db->query($query);
        $this->db->bind('kode', $data['kode']);
        $this->db->bind('quantity', $data['quantity']);
        $this->db->bind('id_trx_update', $data['id_trx_update']);
        $this->db->bind('id_supplier', $data['id_supplier']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    */

    public function getDataByIdTrx($id_trx_po)
    {
        $query = " SELECT 
                   b.nama_barang,b.satuan,tbo.*,s.*,b.kode
                FROM 
                    trx_barang_po tbo,
                    barang b,
                    supplier s 
                WHERE tbo.kode = b.kode
                and tbo.id_supplier = s.id 
                and tbo.id_trx_po ='$id_trx_po'";
        
        return $this->db->query($query)->result();
    }

    public function getDataByIdTrxPayment($id_trx_po)
    {
        $query = " SELECT 
                   b.nama_barang,b.satuan,tbo.*,s.*,b.kode
                FROM 
                    trx_barang_po tbo,
                    barang b,
                    supplier s 
                WHERE tbo.kode = b.kode
                and tbo.id_supplier = s.id 
                /*and tbo.status='1'*/
                and tbo.id_trx_po ='$id_trx_po'";
        
        return $this->db->query($query)->result();
    }

    public function getKodePo($id_trx_po)
    {
        $query = " SELECT 
                   b.nama_barang,b.satuan,tbo.*,s.*,b.kode
                FROM 
                    trx_barang_po tbo,
                    barang b,
                    supplier s 
                WHERE tbo.kode = b.kode
                and tbo.id_supplier = s.id 
                and tbo.status='1'
                and tbo.id_trx_po ='$id_trx_po'";
        
        return $this->db->query($query)->result();
    }

    
    public function getKodePoHistory($id_trx_po)
    {
        $query = " SELECT 
                   b.nama_barang,b.satuan,tbo.*,s.*,b.kode,inv.jatuh_tempo
                FROM 
                    trx_barang_po tbo,
                    barang b,
                    supplier s,
                    trx_payment_po_invoice inv 
                WHERE tbo.kode = b.kode
                and tbo.id_supplier = s.id
                and tbo.id_trx_po = inv.id_trx_po 
                and tbo.status='1'
                and tbo.id_trx_po ='$id_trx_po'";
        
        return $this->db->query($query)->result();
    }

    public function getSumTotal($id_trx_po)
    {

        $query = " SELECT sum(harga_total) as total FROM `trx_barang_po` WHERE id_trx_po='$id_trx_po' and status ='1'";

        return $this->db->query($query)->result();
    }

    /*
    public function updateDataLiveStocks($data)
    {
        $query = " UPDATE trx_barang_po SET 
                    quantity_check=:quantity_check,
                    status =:status,
                    update_date=DATE_FORMAT(SYSDATE(), '%Y%m%d%H%i%s'),
                    date_sampai=DATE_FORMAT(SYSDATE(), '%Y%m%d%H%i%s')
                WHERE 
                    id=:id ";
        $this->db->query($query);
        $this->db->bind('quantity_check', $data['quantity_check']);
        $this->db->bind('status', $data['status']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();
        return $this->db->rowCount();
    }
   

    public function deleteDataPO($data)
    {
        $query = " DELETE FROM trx_barang_po  
                WHERE 
                    id=:id ";
        $this->db->query($query);
        $this->db->bind('id', $data['id']);

        $this->db->execute();
        return $this->db->rowCount();
    }

     */

    public function getTrxId()
    {

        $query = "SELECT 
                    count(id_trx_po) as trx_id 
                FROM 
                    trx_barang_po 
                WHERE 
                    substring(create_date,1,8) =DATE_FORMAT(SYSDATE(), '%Y%m%d')";

        return $this->db->query($query)->result();
    }
}
