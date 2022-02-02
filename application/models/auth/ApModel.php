<?php
class ApModel extends CI_Model
{

    public function getData($data)
    {

        $date = substr($data['date_choosen'], 0, 6);

        $query = " SELECT 
                   b.nama_barang,s.nama,b.kode,po.quantity_check as quantity,po.harga_satuan,po.harga_total,po.no_invoice,
                   po.create_date as tgl_masuk,inv.create_date as tgl_invoice,inv.jatuh_tempo,pout.create_date as tgl_payment, 
                   pout.nominal_bayar,pout.harga_total,inv.total_tagihan,b.satuan 
                   from 
                   barang b, supplier s, trx_barang_po po, trx_payment_po_invoice inv, trx_payment_out pout 
                   WHERE 
                   b.id_supplier=s.id and b.kode=po.kode and 
                   po.id_trx_po = inv.id_trx_po and 
                   inv.id_trx_payment=pout.id_trx_payment_po and 
                   substring(inv.create_date,1,6) ='$date'";

        return $this->db->query($query)->result();
    }

    public function getTotalTagihan($data)
    {
        $date = substr($data['date_choosen'], 0, 6);

        $query = " SELECT sum(total_tagihan_history) - sum(total_tagihan) as nominal,
                   sum(total_tagihan_history)as total_tagihan FROM `trx_payment_po_invoice`
                   where substring(create_date,1,6) ='$date' /*GROUP by id_trx_payment*/";

        return $this->db->query($query)->result();
    }
}
