<?php
class ArModel extends CI_Model
{


    public function getData($data)
    {
        $date = substr($data['date_choosen'], 0, 6);
        $query = " SELECT po.id,p.nama_pelanggan as nama,b.nama_barang,b.kode,po.quantity,po.harga_satuan,po.harga_total,po.no_invoice,
                   po.create_date as tgl_masuk,inv.jatuh_tempo,trx.create_date as tgl_payment,trx.nominal_bayar,trx.harga_total,
                   inv.total_tagihan,inv.create_date as tgl_invoice,b.satuan 
                   from trx_order_po po, barang b,pelanggan p,trx_payment_co_invoice inv,trx_payment_in trx 
                   where po.id_barang= b.id and po.id_pelanggan=p.id and 
                   inv.no_surat_jalan=po.no_surat_jalan and 
                   trx.id_trx_payment_co=inv.id_trx_payment and
                   substring(inv.create_date,1,6) = " . substr($data['date_choosen'], 0, 6);

        return $this->db->query($query)->result();
    }

    public function getTotalTagihan($data)
    {
        $date = substr($data['date_choosen'], 0, 6);

        $query = " SELECT sum(total_tagihan_history) - sum(total_tagihan) as nominal,
                   sum(total_tagihan_history)as total_tagihan FROM `trx_payment_co_invoice`
                   where substring(create_date,1,6) ='$date'";

        return $this->db->query($query)->result();
    }
}
