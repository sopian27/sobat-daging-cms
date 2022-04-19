<?php
class HistoryOrderModel extends CI_Model
{

    public function getDataByDate($data)
    {

        $date = $data['date_choosen'];

        $query = " SELECT id_trx_order,p.nama_pelanggan 
                  FROM trx_order_po t,pelanggan p 
                  WHERE t.id_pelanggan=p.id and status='1' and
                  /*  and substring(t.create_date, 1, 6) = '".$date."' */
                  and date_format(t.create_date,'%Y%m%d')= '".$date."'
                  group by id_trx_order";

        return $this->db->query($query)->result();
    }

    public function getDetailTrx($data)
    {
        $trx_data = $data['id_trx_order'];
        $query = " SELECT b.nama_barang,po.quantity,po.satuan,po.id 
                   FROM trx_order_po po, barang b 
                   WHERE b.id= po.id_barang and po.id_trx_order='$trx_data'";

        return $this->db->query($query)->result();
    }

    public function getHistoryOrderDetailTrx($trxId)
    {

        $query = " SELECT t.*,p.*,b.nama_barang,b.kode,t.id as id_po
                    FROM trx_order_po t,pelanggan p, barang b 
                    WHERE t.id_pelanggan=p.id and  
                    b.id = t.id_barang and
                    t.id_trx_order = '$trxId'";

        return $this->db->query($query)->result();
    }


    public function getHistoryOrderDetailTrxBySsj($data)
    {
        $no_surat_jalan = $data['no_surat_jalan'];

        $query = " SELECT t.*,p.*,b.nama_barang,b.kode,t.id as id_po,te.nomor,a.alamat,co.*
                    FROM trx_order_po t,pelanggan p, barang b, alamat a, telephone te,trx_payment_co_invoice co 
                    WHERE t.id_pelanggan=p.id 
                    and b.id = t.id_barang
                    and co.no_surat_jalan = t.no_surat_jalan
                    and t.id_telephone = te.id
                    and t.id_alamat = a.id
                    and t.no_surat_jalan ='$no_surat_jalan' group by b.id ";

        return $this->db->query($query)->result();
    }

    public function getDataHistoryOrder($create_date, $keyword, $halaman, $batasTampilData)
    {

        $query = "";

        if ($keyword != ""  && $create_date == "Januari, Februari, Maret....") {

            $query = "  SELECT t.id_trx_order,p.nama_pelanggan,t.create_date,t.status,t.update_date,t.id_trx_live_order,t.bungkusan,t.quantity,b.*,
                                t.no_surat_jalan,al.alamat,tl.nomor,t.tgl_pengiriman,t.note,t.id
                            FROM 
                                trx_order_po t,pelanggan p,barang b,alamat al,telephone tl  
                            WHERE 
                                t.id_pelanggan=p.id
                                and b.id = t.id_barang
                                and t.id_alamat = al.id
                                and t.id_telephone = tl.id
                                and p.nama_pelanggan like '%$keyword%'
                                group by t.id_trx_order
                                order by t.id_trx_order 
                                limit " . $halaman . "," . $batasTampilData;

        } else if ($keyword != "" && $create_date != "Januari, Februari, Maret....") {

            $query = "  SELECT t.id_trx_order,p.nama_pelanggan,t.create_date,t.status,t.update_date,t.id_trx_live_order,t.bungkusan,t.quantity,b.*,
                            t.no_surat_jalan,al.alamat,tl.nomor,t.tgl_pengiriman,t.note,t.id
                        FROM 
                            trx_order_po t,pelanggan p,barang b,alamat al,telephone tl  
                        WHERE 
                            t.id_pelanggan=p.id
                            and b.id = t.id_barang
                            and t.id_alamat = al.id
                            and t.id_telephone = tl.id
                            and p.nama_pelanggan like '%$keyword%'
                           /*  and substring(t.create_date, 1, 6) = '".$create_date."' */
                            and date_format(t.create_date,'%Y%m')= '".$create_date."'
                            group by t.id_trx_order
                            order by t.id_trx_order 
                            limit " . $halaman . "," . $batasTampilData;
        } else {

            $query = " SELECT t.id_trx_order,p.nama_pelanggan,t.create_date,t.status,t.update_date,t.id_trx_live_order,t.bungkusan,t.quantity,b.*,
                                    t.no_surat_jalan,al.alamat,tl.nomor,t.tgl_pengiriman,t.note,t.id
                                    FROM 
                                    trx_order_po t,pelanggan p,barang b,alamat al,telephone tl  
                                    WHERE 
                                    t.id_pelanggan=p.id
                                    and b.id = t.id_barang
                                    and t.id_alamat = al.id
                                    and t.id_telephone = tl.id
                                   /*  and substring(t.create_date, 1, 6) = '".$create_date."' */
                                    and date_format(t.create_date,'%Y%m')= '".$create_date."'
                                    group by t.id_trx_order
                                    order by t.id_trx_order
                                    limit " . $halaman . "," . $batasTampilData;
        }


        /*
        if (isset($keyword) && $keyword != "") {

            $query = "  SELECT t.id_trx_order,p.nama_pelanggan,t.create_date,t.status,t.update_date,t.id_trx_live_order,t.bungkusan,t.quantity,b.*,
                                t.no_surat_jalan,al.alamat,tl.nomor,t.tgl_pengiriman,t.note,t.id
                            FROM 
                                trx_order_po t,pelanggan p,barang b,alamat al,telephone tl  
                            WHERE 
                                t.id_pelanggan=p.id
                                and b.id = t.id_barang
                                and t.id_alamat = al.id
                                and t.id_telephone = tl.id
                                and p.nama_pelanggan ='$keyword'
                                group by t.id_trx_order
                                order by t.id_trx_order 
                                limit " . $halaman . "," . $batasTampilData;
        } else {

            $query = " SELECT t.id_trx_order,p.nama_pelanggan,t.create_date,t.status,t.update_date,t.id_trx_live_order,t.bungkusan,t.quantity,b.*,
                                    t.no_surat_jalan,al.alamat,tl.nomor,t.tgl_pengiriman,t.note,t.id
                                    FROM 
                                    trx_order_po t,pelanggan p,barang b,alamat al,telephone tl  
                                    WHERE 
                                    t.id_pelanggan=p.id
                                    and b.id = t.id_barang
                                    and t.id_alamat = al.id
                                    and t.id_telephone = tl.id
                                    and substring(t.create_date,1,6) ='$create_date'
                                    group by t.id_trx_order
                                    order by t.id_trx_order
                                    limit " . $halaman . "," . $batasTampilData;
        }
        */

        return $this->db->query($query)->result();
    }

    public function getDataHistoryOrderCounter($create_date, $keyword)
    {

        $query = "";

        if ($keyword != ""  && $create_date == "Januari, Februari, Maret....") {

            $query = "  SELECT t.id_trx_order,p.nama_pelanggan,t.create_date,t.status,t.update_date,t.id_trx_live_order,t.bungkusan,t.quantity,b.satuan,
                                t.no_surat_jalan,al.alamat,tl.nomor,t.tgl_pengiriman,t.note,t.id,b.nama_barang,b.kode,t.note_nama_barang
                            FROM 
                                trx_order_po t,pelanggan p,barang b,alamat al,telephone tl  
                            WHERE 
                                t.id_pelanggan=p.id
                                and b.id = t.id_barang
                                and t.id_alamat = al.id
                                and t.id_telephone = tl.id
                                and p.nama_pelanggan like '%$keyword%'
                                group by t.id_trx_order
                                order by t.id_trx_order";

        } else if ($keyword != "" && $create_date != "Januari, Februari, Maret....") {

            $query = "  SELECT t.id_trx_order,p.nama_pelanggan,t.create_date,t.status,t.update_date,t.id_trx_live_order,t.bungkusan,t.quantity,b.satuan,
                            t.no_surat_jalan,al.alamat,tl.nomor,t.tgl_pengiriman,t.note,t.id,b.nama_barang,b.kode,t.note_nama_barang
                        FROM 
                            trx_order_po t,pelanggan p,barang b,alamat al,telephone tl  
                        WHERE 
                            t.id_pelanggan=p.id
                            and b.id = t.id_barang
                            and t.id_alamat = al.id
                            and t.id_telephone = tl.id
                            and p.nama_pelanggan like '%$keyword%'
                            /*  and substring(t.create_date, 1, 6) = '".$create_date."' */
                            and date_format(t.create_date,'%Y%m')= '".$create_date."'
                            group by t.id_trx_order
                            order by t.id_trx_order";
        } else {

            $query = " SELECT t.id_trx_order,p.nama_pelanggan,t.create_date,t.status,t.update_date,t.id_trx_live_order,t.bungkusan,t.quantity,b.satuan,
                                    t.no_surat_jalan,al.alamat,tl.nomor,t.tgl_pengiriman,t.note,t.id,b.nama_barang,b.kode,t.note_nama_barang
                                    FROM 
                                    trx_order_po t,pelanggan p,barang b,alamat al,telephone tl  
                                    WHERE 
                                    t.id_pelanggan=p.id
                                    and b.id = t.id_barang
                                    and t.id_alamat = al.id
                                    and t.id_telephone = tl.id
                                   /*  and substring(t.create_date, 1, 6) = '".$create_date."' */
                                   and date_format(t.create_date,'%Y%m')= '".$create_date."'
                                    group by t.id_trx_order
                                    order by t.id_trx_order";
        }

        return $this->db->query($query)->result();
    }

    public function getDataByIdHistory($id_trx_order, $halaman, $batasTampilData)
    {

        $query = "  SELECT t.id_trx_order,p.nama_pelanggan,t.create_date,t.status,t.update_date,t.id_trx_live_order,t.bungkusan,t.quantity,b.satuan,
                                t.no_surat_jalan,al.alamat,tl.nomor,t.tgl_pengiriman,t.note,t.id,t.keterangan,b.nama_barang,b.kode,t.note_nama_barang
                            FROM 
                                trx_order_po t,pelanggan p,barang b,alamat al,telephone tl  
                            WHERE 
                                t.id_pelanggan=p.id
                                and b.id = t.id_barang
                                and t.id_alamat = al.id
                                and t.id_telephone = tl.id
                                and t.id_trx_order ='$id_trx_order'
                                order by t.id_trx_order 
                                limit " . $halaman . "," . $batasTampilData;

        return $this->db->query($query)->result();
    }

    public function getDataByIdTrxOrder($id_trx_order)
    {

        $query = "  SELECT t.id_trx_order,p.nama_pelanggan,t.create_date,t.status,t.update_date,t.id_trx_live_order,t.bungkusan,t.quantity,b.satuan,
                                t.no_surat_jalan,al.alamat,tl.nomor,t.tgl_pengiriman,t.note,t.id,t.no_surat_jalan,b.nama_barang,b.kode,t.note_nama_barang
                            FROM 
                                trx_order_po t,pelanggan p,barang b,alamat al,telephone tl  
                            WHERE 
                                t.id_pelanggan=p.id
                                and b.id = t.id_barang
                                and t.id_alamat = al.id
                                and t.id_telephone = tl.id
                                and t.id_trx_order ='$id_trx_order'
                                order by t.id_trx_order ";

        return $this->db->query($query)->result();
    }



    public function getDataByIdHistoryCounter($id_trx_order)
    {

        $query = "  SELECT t.id_trx_order,p.nama_pelanggan,t.create_date,t.status,t.update_date,t.id_trx_live_order,t.bungkusan,t.quantity,b.satuan,
                        t.no_surat_jalan,al.alamat,tl.nomor,t.tgl_pengiriman,t.note,t.id,t.no_surat_jalan,b.nama_barang,b.kode,t.note_nama_barang
                        FROM 
                        trx_order_po t,pelanggan p,barang b,alamat al,telephone tl  
                        WHERE 
                        t.id_pelanggan=p.id
                        and b.id = t.id_barang
                        and t.id_alamat = al.id
                        and t.id_telephone = tl.id
                        and t.id_trx_order ='$id_trx_order'
                        order by t.id_trx_order";


        return $this->db->query($query)->result();
    }
}
