<?php
class TRXPaymentOutModel extends CI_Model
{

    public function getTrxId($tgl_trx)
    {

        $query = " select max(id_trx_payment_out) as trx_id from trx_payment_out where date_format(create_date,'%Y-%m-%d') = '$tgl_trx'";

        return $this->db->query($query)->result();
    }

    public function getTrxPaymentOut($data)
    {
        $date = $data['date_choosen'];
        $query = "SELECT poo.no_invoice,poo.create_date as tgl_pembayaran, s.nama as nama 
                  from trx_payment_out poo,trx_barang_po po,supplier s 
                  where poo.no_invoice = po.no_invoice and s.id= po.id_supplier and date_format(poo.create_date,'%Y%m')= '$date' group by poo.no_invoice";

        return $this->db->query($query)->result();
    }

    public function getTotTrxPaymentOut($data)
    {
        $date = $data['date_choosen'];
        $query = "SELECT sum(poo.harga_total) as total
                  FROM trx_payment_out poo
                  where date_format(poo.create_date,'%Y%m')= '$date' group by poo.no_invoice";

        return $this->db->query($query)->result();
    }

    public function getInvoiceData($data)
    {
        $no_invoice = $data['no_invoice'];
        /*
        $query = "SELECT s.nama,inv.total_tagihan,inv.id_trx_payment 
                 from trx_payment_po_invoice inv,trx_barang_po po, supplier s 
                 where inv.id_trx_po = po.id_trx_po and s.id=po.id_supplier 
                 and po.no_invoice='$no_invoice' group by s.nama, inv.total_tagihan "; */

        $query = "SELECT s.nama,inv.total_tagihan,inv.id_trx_payment 
                  from trx_payment_po_invoice inv,trx_barang_po po, supplier s
                  where inv.no_invoice = po.no_invoice
                  and s.id=po.id_supplier and po.no_invoice='$no_invoice' group by s.nama, inv.total_tagihan ";

        return $this->db->query($query)->result();
    }

    public function loadHistoryPayment($data)
    {
        $no_invoice = $data['no_invoice'];
        $query = "SELECT tp.id,tp.harga_total,tp.nominal_bayar,s.nama 
                  FROM trx_payment_out tp,trx_payment_po_invoice po, trx_barang_po bo, supplier s 
                  where tp.id_trx_payment_po = po.id_trx_payment 
                  and po.id_trx_po = bo.id_trx_po 
                  and s.id=bo.id_supplier 
                  and tp.no_invoice= '$no_invoice' group by tp.id  ";

        return $this->db->query($query)->result();
    }


    public function insertData($data)
    {
        $this->db->insert('trx_payment_out', $data);
        return $this->db->insert_id();
    }
}
