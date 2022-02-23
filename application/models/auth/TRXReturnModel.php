<?php
class TRXReturnModel extends CI_Model
{

    public function getTrxId()
    {

        $query = " select max(id_trx_return) as trx_id from trx_return where substring(create_date,1,8) =DATE_FORMAT(SYSDATE(), '%Y%m%d')";

        return $this->db->query($query)->result();
    }

    public function getInvoiceData($data,$halaman, $batasTampilData)
    {
        $invoice = $data;
        $query = "SELECT po.id,p.nama_pelanggan,po.tgl_pengiriman,b.kode,b.nama_barang,po.quantity,trx.quantity_return,trx.note,trx.status
                  FROM barang b,pelanggan p,trx_order_po po left join trx_return trx
                  on trx.id_trx_po = po.id
                  WHERE po.id_barang=b.id and po.id_pelanggan = p.id 
                  and po.status='2'
                  and po.no_invoice= '$invoice'
                  limit " . $halaman . "," . $batasTampilData;

        return $this->db->query($query)->result();
    }

    public function getInvoiceDataCount($data)
    {
        $invoice = $data;
        $query = "SELECT po.id,p.nama_pelanggan,po.tgl_pengiriman,b.kode,b.nama_barang,po.quantity,trx.quantity_return,trx.note,trx.status
                  FROM barang b,pelanggan p,trx_order_po po left join trx_return trx
                  on trx.id_trx_po = po.id
                  WHERE po.id_barang=b.id and po.id_pelanggan = p.id 
                  and po.status='2'
                  and po.no_invoice= '$invoice'";
                  
        return $this->db->query($query)->result();
    }

    public function insertData($data)
    {
        $this->db->insert('trx_return', $data);
        return $this->db->insert_id();
    }

    public function getDataByDate($date_choosen)
    {
        $date = $date_choosen['date_choosen'];
        $query = " SELECT tr.id_trx_return,p.nama_pelanggan,tr.tgl_return,substring(tr.tgl_return,7,2) as day,tr.no_invoice 
                  FROM trx_return tr, trx_order_po po, pelanggan p 
                  where tr.id_trx_po=po.id and po.id_pelanggan=p.id 
                  and substring(tr.tgl_return,1,6) ='$date' group by substring(tr.tgl_return,7,2)";

        return $this->db->query($query)->result();
    }

    public function getData($create_date, $keyword, $halaman, $batasTampilData)
    {
        $query = "";

        if (isset($keyword) && $keyword != "") {

                $query = "  SELECT tr.id_trx_return,p.nama_pelanggan,tr.tgl_return,substring(tr.tgl_return,7,2) as day,tr.no_invoice,tr.create_date
                            FROM trx_return tr, trx_order_po po, pelanggan p 
                            where tr.id_trx_po=po.id and po.id_pelanggan=p.id 
                            and tr.no_invoice ='$keyword'
                            GROUP BY day
                            limit " . $halaman . "," . $batasTampilData;
        } else {

            $query = "  SELECT tr.id_trx_return,p.nama_pelanggan,tr.tgl_return,substring(tr.tgl_return,7,2) as day,tr.no_invoice,tr.create_date 
                        FROM trx_return tr, trx_order_po po, pelanggan p 
                        where tr.id_trx_po=po.id and po.id_pelanggan=p.id 
                        and  substring(tr.create_date,1,6) ='$create_date'
                        GROUP BY day
                        limit " . $halaman . "," . $batasTampilData;
        }

        return $this->db->query($query)->result();
    }

    public function getDataCount($create_date, $keyword)
    {
        $query = "";

        if (isset($keyword) && $keyword != "") {

            $query = "  SELECT tr.id_trx_return,p.nama_pelanggan,tr.tgl_return,substring(tr.tgl_return,7,2) as day,tr.no_invoice 
                        FROM trx_return tr, trx_order_po po, pelanggan p 
                        where tr.id_trx_po=po.id and po.id_pelanggan=p.id 
                        and tr.no_invoice ='$keyword'
                        GROUP BY day";
        } else {

            $query = "  SELECT tr.id_trx_return,p.nama_pelanggan,tr.tgl_return,substring(tr.tgl_return,7,2) as day,tr.no_invoice 
                        FROM trx_return tr, trx_order_po po, pelanggan p 
                        where tr.id_trx_po=po.id and po.id_pelanggan=p.id 
                        and substring(tr.create_date,1,6) ='$create_date'
                        GROUP BY day";
        }

        return $this->db->query($query)->result();
    }

    public function getDataDetail($id_trx_return, $halaman, $batasTampilData)
    {

        $query = "SELECT tr.id_trx_return,p.nama_pelanggan,tr.tgl_return,substring(tr.tgl_return,7,2) as day,tr.no_invoice,tr.tgl_return,
                po.id,p.nama_pelanggan,po.tgl_pengiriman,b.kode,b.nama_barang,tr.quantity_before,tr.quantity_return,tr.note  
                FROM trx_return tr, trx_order_po po, pelanggan p,barang b 
                where tr.id_trx_po=po.id and po.id_pelanggan=p.id and po.id_barang=b.id
                and tr.id_trx_return='$id_trx_return'
                limit " . $halaman . "," . $batasTampilData;

        return $this->db->query($query)->result();
    }

    public function getDataDetailCount($id_trx_return)
    {

        $query = "SELECT tr.id_trx_return,p.nama_pelanggan,tr.tgl_return,substring(tr.tgl_return,7,2) as day,tr.no_invoice,tr.tgl_return,
                po.id,p.nama_pelanggan,po.tgl_pengiriman,b.kode,b.nama_barang,tr.quantity_before,tr.quantity_return,tr.note  
                FROM trx_return tr, trx_order_po po, pelanggan p,barang b 
                where tr.id_trx_po=po.id and po.id_pelanggan=p.id and po.id_barang=b.id
                and tr.id_trx_return='$id_trx_return'";

        return $this->db->query($query)->result();
    }
    

    public function deleteData($where)
    {
        $this->db->delete('trx_return', $where);
    }

    
    public function update($data, $where)
    {
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update('trx_return');
    }
}