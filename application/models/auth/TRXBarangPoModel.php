<?php
class TRXBarangPoModel extends CI_Model
{
    /*
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
    } */

    /* create po */
    public function insertData($data)
    {
        $this->db->insert('trx_barang_po', $data);
        return $this->db->insert_id();
    }

    /* create po */
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

    /* update po */
    public function getDataById($id_trx_po, $halamanAwal, $batasTampilData)
    {
        $query = " SELECT 
                    tbo.kode, 
                    tbo.nama_barang, 
                    tbo.satuan, 
                    tbo.harga_satuan,
                    tbo.harga_total,
                    tbo.id,
                    tbo.quantity, 
                    tbo.id_trx_po,
                    tbo.quantity_check,
                    s.nama,
                    tbo.create_date,
                    tbo.status
                FROM 
                    trx_barang_po tbo,
                    supplier s 
                WHERE 
                    tbo.id_supplier = s.id 
                    and tbo.id_trx_po = '$id_trx_po' limit " . $halamanAwal . ", " . $batasTampilData;

        return $this->db->query($query)->result();
    }

    /* update po */
    public function getDataByIdCounter($id_trx_po)
    {
        $query = " SELECT 
                    tbo.kode, 
                    tbo.nama_barang, 
                    tbo.satuan, 
                    tbo.harga_satuan,
                    tbo.id,
                    tbo.quantity, 
                    tbo.id_trx_po,
                    tbo.quantity_check,
                    s.nama,
                    tbo.create_date
                FROM 
                    trx_barang_po tbo,
                    supplier s 
                WHERE 
                    tbo.id_supplier = s.id 
                    and tbo.id_trx_po = '$id_trx_po'";

        return $this->db->query($query)->result();
    }

    /* update po */
    public function getDataByIdSum($id_trx_po)
    {
        $query = " SELECT 
                    sum(tbo.harga_total) as total
                FROM 
                    trx_barang_po tbo,
                    supplier s 
                WHERE 
                    tbo.id_supplier = s.id 
                    and tbo.id_trx_po = '$id_trx_po'";

        return $this->db->query($query)->result();
    }

    /* update po */
    public function selectDistinct($keyword, $halaman, $batasTampilData)
    {

        $query = "";
        if (isset($keyword) && $keyword != "") {

            $query = " SELECT tbo.id_trx_po, s.nama, tbo.create_date
            FROM 
                trx_barang_po tbo, 
                supplier s 
            WHERE 
                tbo.id_supplier = s.id 
                and s.nama='$keyword'
                and tbo.status in('0','2')
                and tbo.id_trx_update =''
            group by tbo.id_trx_po
            order by tbo.create_date asc 
            limit " . $halaman . "," . $batasTampilData;
        } else {

            $query = " SELECT tbo.id_trx_po, s.nama, tbo.create_date
            FROM 
                trx_barang_po tbo, 
                supplier s 
            WHERE 
                tbo.id_supplier = s.id 
                and tbo.status in('0','2')
                and tbo.id_trx_update =''
            group by tbo.id_trx_po
            order by tbo.create_date asc
            limit " . $halaman . "," . $batasTampilData;
        }

        return $this->db->query($query)->result();
    }

    /* update po */
    public function selectDistinctCount($keyword)
    {

        $query = "";
        if (isset($keyword) && $keyword != "") {

            $query = " SELECT tbo.id_trx_po, s.nama, tbo.create_date
                FROM 
                    trx_barang_po tbo, 
                    supplier s 
                WHERE 
                    tbo.id_supplier = s.id 
                    and s.nama='$keyword'
                    and tbo.status in('0','2')
                    and tbo.id_trx_update =''
                group by tbo.id_trx_po
                order by tbo.create_date asc";
        } else {

            $query = " SELECT tbo.id_trx_po, s.nama, tbo.create_date
                FROM 
                    trx_barang_po tbo, 
                    supplier s 
                WHERE 
                    tbo.id_supplier = s.id 
                    and tbo.status in('0','2')
                    and tbo.id_trx_update =''
                group by tbo.id_trx_po
                order by tbo.create_date asc";
        }

        return $this->db->query($query)->result();
    }

    /* live stock */
    public function getLiveStockData($create_date, $keyword, $halaman, $batasTampilData)
    {
        $query = "";

        if (isset($keyword) && $keyword != "") {

            $query = " SELECT tbo.id_trx_po, s.nama, tbo.create_date,tbo.status,tbo.update_date,tbo.id_trx_live_stocks
            FROM 
                trx_barang_po tbo, 
                supplier s 
            WHERE 
                tbo.id_supplier = s.id 
                and tbo.status='3'
                and tbo.id_trx_update !=''
                /*and tbo.id_trx_live_stocks ='' */
                and s.nama ='$keyword'
            GROUP BY tbo.id_trx_po
            limit " . $halaman . "," . $batasTampilData;
        } else {

            $query = " SELECT tbo.id_trx_po, s.nama, tbo.create_date,tbo.status,tbo.update_date,tbo.id_trx_live_stocks
                    FROM 
                        trx_barang_po tbo, 
                        supplier s 
                    WHERE 
                        tbo.id_supplier = s.id 
                        and tbo.status='3'
                        and tbo.id_trx_update !=''
                        /*and tbo.id_trx_live_stocks ='' */
                        and substring(tbo.update_date,1,8) ='$create_date'
                    GROUP BY tbo.id_trx_po
                    limit " . $halaman . "," . $batasTampilData;
        }

        return $this->db->query($query)->result();
    }

    /* live stock */
    public function getLiveStockDataCount($create_date, $keyword)
    {
        $query = "";

        if (isset($keyword) && $keyword != "") {

            $query = " SELECT tbo.id_trx_po, s.nama, tbo.create_date,tbo.status
            FROM 
                trx_barang_po tbo, 
                supplier s 
            WHERE 
                tbo.id_supplier = s.id 
                and tbo.status='3'
                and tbo.id_trx_update !=''
                /*and tbo.id_trx_live_stocks ='' */
                and s.nama ='$keyword'
            GROUP BY tbo.id_trx_po";
        } else {

            $query = " SELECT tbo.id_trx_po, s.nama, tbo.create_date,tbo.status
                    FROM 
                        trx_barang_po tbo, 
                        supplier s 
                    WHERE 
                        tbo.id_supplier = s.id 
                        and tbo.status='3'
                        and tbo.id_trx_update !=''
                        /*and tbo.id_trx_live_stocks ='' */
                        and substring(tbo.update_date,1,8) ='$create_date'
                    GROUP BY tbo.id_trx_po";
        }

        return $this->db->query($query)->result();
    }

    /* live stock */
    public function getDataByIdLiveStock($id_trx_po, $halaman, $batasTampilData)
    {
        $query = " SELECT 
                         tbo.kode, 
                         tbo.nama_barang, 
                         tbo.satuan, 
                         tbo.harga_satuan,
                         tbo.harga_total,
                         tbo.id,
                         tbo.quantity, 
                         tbo.id_trx_po,
                         tbo.quantity_check,
                         s.nama,
                         tbo.create_date,
                         tbo.status
                     FROM 
                         trx_barang_po tbo,
                         supplier s 
                     WHERE 
                         tbo.id_supplier = s.id 
                         and tbo.id_trx_po = '$id_trx_po'
                         and tbo.harga_satuan !=0 
                         limit " . $halaman . "," . $batasTampilData;

        return $this->db->query($query)->result();
    }

    /* live stock */
    public function getDataByIdLiveStockTrx($id_trx_po)
    {
        $query = " SELECT 
                             tbo.kode, 
                             tbo.nama_barang, 
                             tbo.satuan, 
                             tbo.harga_satuan,
                             tbo.harga_total,
                             tbo.id,
                             tbo.quantity, 
                             tbo.id_trx_po,
                             tbo.quantity_check,
                             s.nama,
                             tbo.create_date,
                             tbo.status
                         FROM 
                             trx_barang_po tbo,
                             supplier s 
                         WHERE 
                             tbo.id_supplier = s.id 
                             and tbo.id_trx_po = '$id_trx_po'
                             and tbo.harga_satuan !=0";

        return $this->db->query($query)->result();
    }

    /* live stock */
    public function getDataByIdLiveStockCounter($id_trx_po)
    {
        $query = " SELECT 
                        tbo.kode, 
                        tbo.nama_barang, 
                        tbo.satuan, 
                        tbo.harga_satuan,
                        tbo.id,
                        tbo.quantity, 
                        tbo.id_trx_po,
                        tbo.quantity_check,
                        s.nama,
                        tbo.create_date
                    FROM 
                        trx_barang_po tbo,
                        supplier s 
                    WHERE 
                        tbo.id_supplier = s.id 
                        and tbo.id_trx_po = '$id_trx_po'
                        and tbo.harga_satuan !=0 ";

        return $this->db->query($query)->result();
    }

    /* live stock */
    public function getWhereIn($where)
    {
        $this->db->select("quantity_check as quantity_pusat,kode,nama_barang,satuan,harga_satuan,DATE_FORMAT(current_timestamp(), '%Y%m%d%H%i%s') as create_date,DATE_FORMAT(current_timestamp(), '%Y%m%d%H%i%s') as update_date,id_supplier ");
        $this->db->from('trx_barang_po');
        $this->db->where_in('id', $where);
        $query =  $this->db->get();
        return $query->result();
    }

    /* live stock */
    public function getWhereTrxId($where)
    {
        $this->db->select("quantity_check as quantity_pusat,kode,nama_barang,satuan,harga_satuan,DATE_FORMAT(current_timestamp(), '%Y%m%d%H%i%s') as create_date,DATE_FORMAT(current_timestamp(), '%Y%m%d%H%i%s') as update_date,id_supplier ");
        $this->db->from('trx_barang_po');
        $this->db->where($where);
        $query =  $this->db->get();
        return $query->result();
    }

    /* history po */
    public function getHistoryPoData($create_date, $keyword, $halaman, $batasTampilData)
    {

        $query = "";

        if (isset($keyword) && $keyword != "") {

            $query = " SELECT tbo.id_trx_po, s.nama, tbo.create_date,tbo.status
            FROM 
                trx_barang_po tbo, 
                supplier s 
            WHERE 
                tbo.id_supplier = s.id 
                and tbo.status='3' 
                and tbo.id_trx_live_stocks !='' 
                and s.nama= '$keyword'
            GROUP BY tbo.id_trx_po,substring(tbo.create_date,5,2)
            limit " . $halaman . "," . $batasTampilData;
        } else {

            $query = " SELECT tbo.id_trx_po, s.nama, tbo.create_date,tbo.status
                    FROM 
                        trx_barang_po tbo, 
                        supplier s 
                    WHERE 
                        tbo.id_supplier = s.id 
                        and tbo.status='3' 
                        and tbo.id_trx_live_stocks !='' 
                        and substring(tbo.create_date,1,6) ='$create_date'
                    GROUP BY tbo.id_trx_po,substring(tbo.create_date,5,2)
                    limit " . $halaman . "," . $batasTampilData;
        }


        return $this->db->query($query)->result();
    }

    /* history po */
    public function getHistoryPoDataCount($create_date, $keyword)
    {
        $query = "";

        if (isset($keyword) && $keyword != "") {

            $query = " SELECT tbo.id_trx_po, s.nama, tbo.create_date,tbo.status
            FROM 
                trx_barang_po tbo, 
                supplier s 
            WHERE 
                tbo.id_supplier = s.id 
                and tbo.status='3' 
                and tbo.id_trx_live_stocks !='' 
                and s.nama= '$keyword'
            GROUP BY tbo.id_trx_po,substring(tbo.create_date,5,2)";
        } else {

            $query = " SELECT tbo.id_trx_po, s.nama, tbo.create_date,tbo.status
                    FROM 
                        trx_barang_po tbo, 
                        supplier s 
                    WHERE 
                        tbo.id_supplier = s.id 
                        and tbo.status='3' 
                        and tbo.id_trx_live_stocks !='' 
                        and substring(tbo.create_date,1,6) ='$create_date'
                    GROUP BY tbo.id_trx_po,substring(tbo.create_date,5,2)";
        }

        return $this->db->query($query)->result();
    }

    /* history po */
    public function getDataByIdHistory($id_trx_po, $halaman, $batasTampilData)
    {
        $query = " SELECT 
                        tbo.kode, 
                        tbo.nama_barang, 
                        tbo.satuan, 
                        tbo.harga_satuan,
                        tbo.id,
                        tbo.quantity, 
                        tbo.id_trx_po,
                        tbo.quantity_check,
                        s.nama,
                        tbo.create_date,
                        b.create_date as create_date_penerimaan
                    FROM 
                        trx_barang_po tbo,
                        supplier s,
                        barang b
                    WHERE 
                        tbo.id_supplier = s.id 
                        and tbo.kode = b.kode
                        and tbo.id_trx_po = '$id_trx_po'
                        limit " . $halaman . "," . $batasTampilData;

        return $this->db->query($query)->result();
    }

    /* history po */
    public function getDataByIdHistoryCounter($id_trx_po)
    {
        $query = " SELECT 
                        tbo.kode, 
                        tbo.nama_barang, 
                        tbo.satuan, 
                        tbo.harga_satuan,
                        tbo.id,
                        tbo.quantity, 
                        tbo.id_trx_po,
                        tbo.quantity_check,
                        s.nama,
                        tbo.create_date,
                        b.create_date as create_date_penerimaan
                    FROM 
                        trx_barang_po tbo,
                        supplier s,
                        barang b
                    WHERE 
                        tbo.id_supplier = s.id 
                        and tbo.kode = b.kode
                        and tbo.id_trx_po = '$id_trx_po'";

        return $this->db->query($query)->result();
    }

    /* history po */
    public function getDataByIdHistorySum($id_trx_po)
    {
        $query = "  SELECT sum(tbo.harga_total) as total
                    FROM 
                        trx_barang_po tbo,
                        supplier s,
                        barang b
                    WHERE 
                        tbo.id_supplier = s.id 
                        and tbo.kode = b.kode
                        and tbo.id_trx_po = '$id_trx_po'";

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
                    AND s.nama Like '%' " . $search . " '%' ";

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

    /* update po, live stock */
    public function update($data, $where)
    {
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update('trx_barang_po');
    }

    public function confirmData()
    {
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
}
