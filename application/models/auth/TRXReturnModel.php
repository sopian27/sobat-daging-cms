<?php
class TRXReturnModel extends CI_Model
{

    public function getTrxId()
    {

        $query = " select max(id_trx_return) as trx_id from trx_return where substring(create_date,1,8) =DATE_FORMAT(SYSDATE(), '%Y%m%d')";

        return $this->db->query($query)->result();
    }

    public function getInvoiceData($data)
    {
        $invoice = $data['no_invoice'];
        $query = "SELECT po.id,p.nama_pelanggan,po.tgl_pengiriman,b.kode,b.nama_barang,po.quantity 
                  FROM trx_order_po po,barang b,pelanggan p
                  WHERE po.id_barang=b.id and po.id_pelanggan = p.id 
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

    public function getDataByDateHistory($data)
    {
        $id_trx_return = $data['id_trx_return'];
        $query = "SELECT tr.id_trx_return,p.nama_pelanggan,tr.tgl_return,substring(tr.tgl_return,7,2) as day,tr.no_invoice,tr.tgl_return,
                po.id,p.nama_pelanggan,po.tgl_pengiriman,b.kode,b.nama_barang,tr.quantity_before,tr.quantity_return,tr.note  
                FROM trx_return tr, trx_order_po po, pelanggan p,barang b 
                where tr.id_trx_po=po.id and po.id_pelanggan=p.id and po.id_barang=b.id
                and tr.id_trx_return='$id_trx_return'";

        return $this->db->query($query)->result();
    }
}