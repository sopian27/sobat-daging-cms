<?php
class DataMutasiModel extends CI_Model
{
    public function getByDateMutasiKeluar($data)
    {

        $date = substr($data['date_value'], 0, 6);

        $query = " SELECT 
                   s.nama,po.no_invoice,inv.jatuh_tempo,pout.nominal_bayar
                   from 
                   barang b, supplier s, 
                   trx_barang_po po, trx_payment_po_invoice inv, 
                   trx_payment_out pout 
                   WHERE 
                   b.id_supplier=s.id and b.kode=po.kode and 
                   po.id_trx_po = inv.id_trx_po and 
                   inv.id_trx_payment=pout.id_trx_payment_po and 
                   substring(inv.create_date,1,6) ='$date'";

        return $this->db->query($query)->result();
    }

    public function getByDateMutasiMasuk($data)
    {
        $date = substr($data['date_value'], 0, 6);
        $query = " SELECT p.nama_pelanggan as nama,po.no_invoice,
                   inv.jatuh_tempo,trx.nominal_bayar
                   from trx_order_po po, barang b,pelanggan p,trx_payment_co_invoice inv,trx_payment_in trx 
                   where po.id_barang= b.id and po.id_pelanggan=p.id and 
                   inv.no_surat_jalan=po.no_surat_jalan and 
                   trx.id_trx_payment_co=inv.id_trx_payment and
                   substring(inv.create_date,1,6) = '$date'";

        return $this->db->query($query)->result();
    }


}
