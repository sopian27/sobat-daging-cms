<?php
class TRXPaymentInModel extends CI_Model
{
    public function getTrxId($tgl_trx)
    {

        $query = " select max(id_trx_payment_in) as trx_id from trx_payment_in where date_format(create_date,'%Y-%m-%d') = '$tgl_trx'";

        return $this->db->query($query)->result();
    }

    public function getInvoiceData($data)
    {
        $no_invoice = $data['no_invoice'];

        $query = "SELECT p.nama_pelanggan,co.total_tagihan,co.id_trx_payment  from 
                trx_payment_co_invoice co, trx_order_po po,pelanggan p 
                where co.no_surat_jalan = po.no_surat_jalan 
                and p.id = po.id_pelanggan 
                and po.no_invoice='$no_invoice' group by p.nama_pelanggan, co.total_tagihan";

        return $this->db->query($query)->result();
    }

    public function loadHistoryPayment($data)
    {
        $no_invoice = $data['no_invoice'];
        $query = "SELECT tp.id,tp.harga_total,tp.nominal_bayar, p.nama_pelanggan 
                  from trx_payment_in tp, trx_payment_co_invoice co,trx_order_po po, pelanggan p
                  where co.id_trx_payment=tp.id_trx_payment_co and po.no_surat_jalan = co.no_surat_jalan 
                  and p.id=po.id_pelanggan and tp.no_invoice='$no_invoice' group by tp.id ";

        return $this->db->query($query)->result();
    }

    public function insertData($data)
    {
        $this->db->insert('trx_payment_in', $data);
        return $this->db->insert_id();
    }


    public function getTotTrxPaymentIn($date_choosen)
    {
        $date = $date_choosen['date_choosen'];
        $query = "SELECT sum(poo.harga_total) as total
                  FROM trx_payment_in poo
                  where date_format(poo.create_date,'%Y%m')= '$date' group by poo.no_invoice";

        return $this->db->query($query)->result();
    }


    public function getTrxPaymentIn($date_choosen)
    {
        $date = $date_choosen['date_choosen'];
        $query = "SELECT pi.no_invoice,pi.create_date as tgl_pembayaran, p.nama_pelanggan as nama 
                  from trx_payment_in pi,trx_order_po po,pelanggan p
                  where pi.no_invoice = po.no_invoice and p.id= po.id_pelanggan and date_format(pi.create_date,'%Y%m')= '$date' group by pi.no_invoice ";

        return $this->db->query($query)->result();
    }

    public function getInvoiceCustomer($date_choosen)
    {
        $date = $date_choosen['date_choosen'];
        $query = "select po.no_surat_jalan,p.nama_pelanggan as nama,po.no_invoice 
                  from trx_order_po po, pelanggan p 
                  where po.id_pelanggan=p.id and date_format(po.create_date,'%Y%m')= '$date' and po.status='1' group by po.no_invoice";

        return $this->db->query($query)->result();
    }

    public function getInvoicePayment($date_choosen)
    {
        $date = $date_choosen['date_choosen'];
        $query = "select po.kode,s.nama as nama,po.no_invoice,po.id_trx_po 
                  from trx_barang_po po, supplier s 
                  where s.id=po.id_supplier and date_format(po.create_date,'%Y%m')= '$date' and po.status='1' group by po.no_invoice";

        return $this->db->query($query)->result();
    }
}
