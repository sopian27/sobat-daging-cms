<?php
class ArModel extends CI_Model
{

    /*
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
                   substring(inv.create_date,1,6) = '$date'";

        return $this->db->query($query)->result();
    }
    */


    public function getData($create_date, $keyword, $halaman, $batasTampilData)
    {

        $query = "";

        if (isset($keyword) && $keyword != "") {

            $query = "  select 
                            b.nama_barang, 
                            p.nama_pelanggan as nama, 
                            b.kode, 
                            po.quantity, 
                            po.harga_satuan, 
                            po.harga_total, 
                            po.no_invoice, 
                            po.create_date as tgl_masuk, 
                            inv.create_date as tgl_invoice, 
                            inv.jatuh_tempo, 
                            trx.create_date as tgl_payment, 
                            trx.nominal_bayar,inv.total_tagihan,
                            b.satuan 
                        from 
                            pelanggan p, 
                            barang b, 
                            trx_order_po po, 
                            trx_payment_co_invoice inv 
                            left join trx_payment_in trx on inv.id_trx_payment = trx.id_trx_payment_co 
                        where 
                            po.no_surat_jalan = inv.no_surat_jalan 
                            and b.id = po.id_barang 
                            and po.id_pelanggan = p.id
                            and po.no_invoice= '" . $keyword . "'
                            limit " . $halaman . "," . $batasTampilData;
        } else {

            $query = "  select 
                            b.nama_barang, 
                            p.nama_pelanggan as nama, 
                            b.kode, 
                            po.quantity, 
                            po.harga_satuan, 
                            po.harga_total, 
                            po.no_invoice, 
                            po.create_date as tgl_masuk, 
                            inv.create_date as tgl_invoice, 
                            inv.jatuh_tempo, 
                            trx.create_date as tgl_payment, 
                            trx.nominal_bayar,inv.total_tagihan,
                            b.satuan 
                        from 
                            pelanggan p, 
                            barang b, 
                            trx_order_po po, 
                            trx_payment_co_invoice inv 
                            left join trx_payment_in trx on inv.id_trx_payment = trx.id_trx_payment_co 
                        where 
                            po.no_surat_jalan = inv.no_surat_jalan 
                            and b.id = po.id_barang 
                            and po.id_pelanggan = p.id
                            and substring(inv.create_date, 1, 6) = '" . $create_date . "'
                            limit " . $halaman . "," . $batasTampilData;
        }

        return $this->db->query($query)->result();
    }

    public function getDataCount($create_date, $keyword)
    {

        $query = "";

        if (isset($keyword) && $keyword != "") {

            $query = "  select 
                            b.nama_barang, 
                            p.nama_pelanggan as nama, 
                            b.kode, 
                            po.quantity, 
                            po.harga_satuan, 
                            po.harga_total, 
                            po.no_invoice, 
                            po.create_date as tgl_masuk, 
                            inv.create_date as tgl_invoice, 
                            inv.jatuh_tempo, 
                            trx.create_date as tgl_payment, 
                            trx.nominal_bayar,inv.total_tagihan,
                            b.satuan 
                        from 
                            pelanggan p, 
                            barang b, 
                            trx_order_po po, 
                            trx_payment_co_invoice inv 
                            left join trx_payment_in trx on inv.id_trx_payment = trx.id_trx_payment_co 
                        where 
                            po.no_surat_jalan = inv.no_surat_jalan 
                            and b.id = po.id_barang 
                            and po.id_pelanggan = p.id
                            and po.no_invoice= '" . $keyword . "'";
        } else {

            $query = "  select 
                            b.nama_barang, 
                            p.nama_pelanggan as nama, 
                            b.kode, 
                            po.quantity, 
                            po.harga_satuan, 
                            po.harga_total, 
                            po.no_invoice, 
                            po.create_date as tgl_masuk, 
                            inv.create_date as tgl_invoice, 
                            inv.jatuh_tempo, 
                            trx.create_date as tgl_payment, 
                            trx.nominal_bayar,inv.total_tagihan,
                            b.satuan 
                        from 
                            pelanggan p, 
                            barang b, 
                            trx_order_po po, 
                            trx_payment_co_invoice inv 
                            left join trx_payment_in trx on inv.id_trx_payment = trx.id_trx_payment_co 
                        where 
                            po.no_surat_jalan = inv.no_surat_jalan 
                            and b.id = po.id_barang 
                            and po.id_pelanggan = p.id
                            and substring(inv.create_date, 1, 6) = '" . $create_date . "'";
        }

        return $this->db->query($query)->result();
    }

    public function getTotalTagihan($create_date, $keyword)
    {

        $query = "";

        if (isset($keyword) && $keyword != "") {

            $query = " SELECT sum(total_tagihan_history) - sum(total_tagihan) as nominal,
                    sum(total_tagihan_history)as total_tagihan FROM `trx_payment_co_invoice` co, trx_order_po po
                    where 
                    po.no_surat_jalan=co.no_surat_jalan
                    and po.no_invoice ='$keyword' /*GROUP by id_trx_payment*/";
        } else {

            $query = " SELECT sum(total_tagihan_history) - sum(total_tagihan) as nominal,
                    sum(total_tagihan_history)as total_tagihan FROM `trx_payment_co_invoice`
                    where substring(create_date,1,6) ='$create_date' /*GROUP by id_trx_payment*/";
        }

        return $this->db->query($query)->result();
    }
}
