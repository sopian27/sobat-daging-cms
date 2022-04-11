<?php
class LiveOrderModel extends CI_Model
{

    public function getTrxId()
    {

        $query = " select max(id_trx_live_order) as trx_id from trx_order_po where substring(create_date,1,8) =DATE_FORMAT(SYSDATE(), '%Y%m%d')";

        return $this->db->query($query)->result();
    }

    public function getDataByDate($data)
    {

        $date = $data['date_choosen'];
        $query = " SELECT id_trx_order,p.nama_pelanggan 
                  FROM trx_order_po t,pelanggan p 
                  WHERE t.id_pelanggan=p.id and status='0' and
                  substring(t.create_date,1,8) ='$date' group by id_trx_order";

        return $this->db->query($query)->result();
    }

    public function getLiveOrderData($create_date, $keyword, $halaman, $batasTampilData)
    {
        $query = "";

        if ($keyword != ""  && $create_date =="...") {

                $query = " SELECT t.id_trx_order,p.nama_pelanggan,t.create_date,t.status,t.update_date,t.id_trx_live_order
                    FROM 
                        trx_order_po t,pelanggan p 
                    WHERE 
                        t.id_pelanggan=p.id 
                        and p.nama_pelanggan like '%$keyword%'
                    GROUP BY t.id_trx_order
                    limit " . $halaman . "," . $batasTampilData;

        }else if ($keyword!="" && $create_date !="...") {

            $query = "  SELECT t.id_trx_order,p.nama_pelanggan,t.create_date,t.status,t.update_date,t.id_trx_live_order
                    FROM 
                        trx_order_po t,pelanggan p 
                    WHERE 
                        t.id_pelanggan=p.id
                        and p.nama_pelanggan like '%$keyword%'
                        and substring(t.create_date,1,8) ='$create_date'
                    GROUP BY t.id_trx_order
                    limit " . $halaman . "," . $batasTampilData;

        } else {

            $query = "  SELECT t.id_trx_order,p.nama_pelanggan,t.create_date,t.status,t.update_date,t.id_trx_live_order
                        FROM 
                            trx_order_po t,pelanggan p 
                        WHERE 
                            t.id_pelanggan=p.id
                            and substring(t.create_date,1,8) ='$create_date'
                        GROUP BY t.id_trx_order
                        limit " . $halaman . "," . $batasTampilData;
        }

        return $this->db->query($query)->result();
    }

    public function getLiveOrderDataCount($create_date, $keyword)
    {
        $query = "";

        if ($keyword != ""  && $create_date =="...") {

            $query = " SELECT t.id_trx_order,p.nama_pelanggan,t.create_date,t.status,t.update_date,t.id_trx_live_order
                    FROM 
                        trx_order_po t,pelanggan p 
                    WHERE 
                        t.id_pelanggan=p.id
                        and p.nama_pelanggan like '%$keyword%'
                    GROUP BY t.id_trx_order";

        }else if ($keyword!="" && $create_date !="...") {
            
            $query = "  SELECT t.id_trx_order,p.nama_pelanggan,t.create_date,t.status,t.update_date,t.id_trx_live_order
                    FROM 
                        trx_order_po t,pelanggan p 
                    WHERE 
                        t.id_pelanggan=p.id
                        and p.nama_pelanggan like '%$keyword%'
                        and substring(t.create_date,1,8) ='$create_date'
                    GROUP BY t.id_trx_order";
        
        } else {

            $query = "  SELECT t.id_trx_order,p.nama_pelanggan,t.create_date,t.status,t.update_date,t.id_trx_live_order
                    FROM 
                        trx_order_po t,pelanggan p 
                    WHERE 
                        t.id_pelanggan=p.id
                        and substring(t.create_date,1,8) ='$create_date'
                    GROUP BY t.id_trx_order";
        }

        return $this->db->query($query)->result();
    }

    public function getLiveOrderDate($create_date, $keyword, $halaman, $batasTampilData)
    {
        $query = "";

        if (isset($keyword) && $keyword != "") {

        } else {

            $query = "  SELECT id_trx_order,p.nama_pelanggan,b.nama_barang,t.quantity,t.satuan
                        FROM trx_order_po t,pelanggan p, barang b 
                        WHERE t.id_pelanggan=p.id and  
                        b.id = t.id_barang 
                        and substring(t.create_date,1,8) ='$create_date'
                        limit " . $halaman . "," . $batasTampilData;

                        
        }

        return $this->db->query($query)->result();
    }

    public function getLiveOrderDateCount($create_date, $keyword)
    {
        $query = "";

        if (isset($keyword) && $keyword != "") {

        } else {

            $query = "  SELECT id_trx_order,p.nama_pelanggan,b.nama_barang,t.quantity,t.satuan
                        FROM trx_order_po t,pelanggan p, barang b 
                        WHERE t.id_pelanggan=p.id and  
                        b.id = t.id_barang 
                        and substring(t.create_date,1,8) ='$create_date'";
        }

        return $this->db->query($query)->result();
    }

    public function getDateByIdLiveOrder($create_date, $halaman, $batasTampilData)
    {
            $query = " SELECT t.id_trx_order,p.nama_pelanggan,t.create_date,t.status,t.update_date,t.id_trx_live_order,t.bungkusan,t.quantity,b.*,
                        t.no_surat_jalan,al.alamat,tl.nomor,t.tgl_pengiriman,t.note,t.id
                    FROM 
                        trx_order_po t,pelanggan p,barang b,alamat al,telephone tl  
                    WHERE 
                        t.id_pelanggan=p.id
                        and b.id = t.id_barang
                        and t.id_alamat = al.id
                        and t.id_telephone = tl.id
                        and substring(t.create_date,1,8) ='$create_date'
                        order by t.id_trx_order";
                       /* limit " . $halaman . "," . $batasTampilData; */

        return $this->db->query($query)->result();
    }

    public function getDateByIdLiveOrderCounter($create_date)
    {
        $query = " SELECT t.id_trx_order,p.nama_pelanggan,t.create_date,t.status,t.update_date,t.id_trx_live_order,t.bungkusan,t.quantity,b.*,
                        t.no_surat_jalan,al.alamat,tl.nomor,t.tgl_pengiriman,t.note,t.id
                    FROM 
                        trx_order_po t,pelanggan p,barang b,alamat al,telephone tl  
                    WHERE 
                        t.id_pelanggan=p.id
                        and b.id = t.id_barang
                        and t.id_alamat = al.id
                        and t.id_telephone = tl.id
                        and substring(t.create_date,1,8) ='$create_date'";

        return $this->db->query($query)->result();
    }

    public function getDetailTrx($data)
    {
        $data_trx = $data['id_trx_order'];
        $query = " SELECT b.nama_barang,po.quantity,po.satuan,po.id 
                   FROM trx_order_po po, barang b 
                   WHERE b.id= po.id_barang and po.id_trx_order='$data_trx'";

        return $this->db->query($query)->result();
    }

    public function getliveOrderDetail($data)
    {
        $date = $data['createdate'];
        $query = " SELECT id_trx_order,p.nama_pelanggan,b.nama_barang,t.quantity,t.satuan
                    FROM trx_order_po t,pelanggan p, barang b 
                    WHERE t.id_pelanggan=p.id and  
                    b.id = t.id_barang and status='0' and
                    substring(t.create_date,1,8) ='$date' order by id_trx_order ";

        return $this->db->query($query)->result();
    }

    public function getliveOrderDetailKeyword($data)
    {
        $date = $data['createdate'];
        $query = " SELECT id_trx_order,p.nama_pelanggan,b.nama_barang,t.quantity,t.satuan
                    FROM trx_order_po t,pelanggan p, barang b 
                    WHERE t.id_pelanggan=p.id and  
                    b.id = t.id_barang and status='0' and
                    p.nama_pelanggan LIKE '%$date%' order by id_trx_order ";

        return $this->db->query($query)->result();
    }

    public function getliveOrderDetailTrx($trxId)
    {

        $query = " SELECT t.*,p.*,b.nama_barang,b.kode,t.id as id_po
                    FROM trx_order_po t,pelanggan p, barang b 
                    WHERE t.id_pelanggan=p.id and  
                    b.id = t.id_barang and
                    t.id_trx_order ='$trxId'";

        return $this->db->query($query)->result();
    }

    public function getDataByIdLiveOrder($id_trx_order, $halaman, $batasTampilData)
    {
            $query = " SELECT t.id_trx_order,p.nama_pelanggan,t.create_date,t.status,t.update_date,t.id_trx_live_order,t.bungkusan,t.quantity,b.*,
                        t.no_surat_jalan,al.alamat,tl.nomor,t.tgl_pengiriman,t.note,t.id,t.keterangan,t.note_nama_barang
                    FROM 
                        trx_order_po t,pelanggan p,barang b,alamat al,telephone tl  
                    WHERE 
                        t.id_pelanggan=p.id
                        and b.id = t.id_barang
                        and t.id_alamat = al.id
                        and t.id_telephone = tl.id
                        and t.id_trx_order = '$id_trx_order'
                        order by t.id
                        limit " . $halaman . "," . $batasTampilData;

        return $this->db->query($query)->result();
    }

    public function getDataByIdLiveOrderCounter($id_trx_order)
    {
        $query = " SELECT t.id_trx_order,p.nama_pelanggan,t.create_date,t.status,t.update_date,t.id_trx_live_order,t.bungkusan,t.quantity,b.*,
                        t.no_surat_jalan,al.alamat,tl.nomor,t.tgl_pengiriman,t.note,t.id,t.keterangan,t.note_nama_barang
                    FROM 
                        trx_order_po t,pelanggan p,barang b,alamat al,telephone tl  
                    WHERE 
                        t.id_pelanggan=p.id
                        and b.id = t.id_barang
                        and t.id_alamat = al.id
                        and t.id_telephone = tl.id
                        and t.id_trx_order = '$id_trx_order'";

        return $this->db->query($query)->result();
    }

    public function getliveOrderDetailTrxPrint($trxId)
    {

        $query = " SELECT t.*,p.*,b.nama_barang,b.kode,t.id as id_po
                    FROM trx_order_po t,pelanggan p, barang b 
                    WHERE t.id_pelanggan=p.id and  
                    b.id = t.id_barang and status='1' and
                    t.id_trx_order = '$trxId'";

        return $this->db->query($query)->result();
    }

    /*
    public function confirmOrder($data)
    {

        $query = "UPDATE trx_order_po SET bungkusan =:bungkusan,status='1' WHERE id =:id and id_trx_order =:id_trx_order";

        $this->db->query($query);
        $this->db->bind('bungkusan', $data['bungkusan']);
        $this->db->bind('id', $data['id']);
        $this->db->bind('id_trx_order', $data['id_trx_order']);
        $this->db->execute();
        return $this->db->rowCount();
    }
    */

    public function update($data, $where)
    {
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update('trx_order_po');
        return $this->db->affected_rows();
    }
}
