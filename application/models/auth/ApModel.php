<?php
class ApModel extends CI_Model
{

    public function getData($create_date, $keyword, $halaman, $batasTampilData)
    {

        $query = "";

        if (isset($keyword) && $keyword != "") {

            $query = "  select 
                            b.nama_barang, 
                            s.nama, 
                            b.kode, 
                            po.quantity_check as quantity, 
                            po.harga_satuan, 
                            po.harga_total, 
                            po.no_invoice, 
                            po.create_date as tgl_masuk, 
                            inv.create_date as tgl_invoice, 
                            inv.jatuh_tempo, 
                            ot.create_date as tgl_payment, 
                            ot.nominal_bayar,inv.total_tagihan,
                            b.satuan 
                        from 
                            trx_barang_po po, 
                            barang b, 
                            supplier s, 
                            trx_payment_po_invoice inv 
                            left join trx_payment_out ot on ot.no_invoice = inv.no_invoice 
                        where 
                            po.no_invoice = inv.no_invoice 
                            and b.kode = po.kode 
                            and s.id = po.id_supplier 
                            and inv.no_invoice = '".$keyword."'
                            limit " . $halaman . "," . $batasTampilData;
        } else {

                $query = "  select 
                            b.nama_barang, 
                            s.nama, 
                            b.kode, 
                            po.quantity_check as quantity, 
                            po.harga_satuan, 
                            po.harga_total, 
                            po.no_invoice, 
                            po.create_date as tgl_masuk, 
                            inv.create_date as tgl_invoice, 
                            inv.jatuh_tempo, 
                            ot.create_date as tgl_payment, 
                            ot.nominal_bayar,inv.total_tagihan,
                            b.satuan 
                        from 
                            trx_barang_po po, 
                            barang b, 
                            supplier s, 
                            trx_payment_po_invoice inv 
                            left join trx_payment_out ot on ot.no_invoice = inv.no_invoice 
                        where 
                            po.no_invoice = inv.no_invoice 
                            and b.kode = po.kode 
                            and s.id = po.id_supplier 
                            and substring(inv.create_date, 1, 6) = '".$create_date."'
                            limit " . $halaman . "," . $batasTampilData;

        }

        //echo $query;
        return $this->db->query($query)->result();
    }

    public function getDataCount($create_date, $keyword)
    {

        $query = "";

        if (isset($keyword) && $keyword != "") {

            $query = "  select 
                            b.nama_barang, 
                            s.nama, 
                            b.kode, 
                            po.quantity_check as quantity, 
                            po.harga_satuan, 
                            po.harga_total, 
                            po.no_invoice, 
                            po.create_date as tgl_masuk, 
                            inv.create_date as tgl_invoice, 
                            inv.jatuh_tempo, 
                            ot.create_date as tgl_payment, 
                            ot.nominal_bayar,inv.total_tagihan,
                            b.satuan 
                        from 
                            trx_barang_po po, 
                            barang b, 
                            supplier s, 
                            trx_payment_po_invoice inv 
                            left join trx_payment_out ot on ot.no_invoice = inv.no_invoice 
                        where 
                            po.no_invoice = inv.no_invoice 
                            and b.kode = po.kode 
                            and s.id = po.id_supplier 
                            and inv.no_invoice = '".$keyword."'";
        } else {

            $query = "  select 
                            b.nama_barang, 
                            s.nama, 
                            b.kode, 
                            po.quantity_check as quantity, 
                            po.harga_satuan, 
                            po.harga_total, 
                            po.no_invoice, 
                            po.create_date as tgl_masuk, 
                            inv.create_date as tgl_invoice, 
                            inv.jatuh_tempo, 
                            ot.create_date as tgl_payment, 
                            ot.nominal_bayar,inv.total_tagihan,
                            b.satuan 
                        from 
                            trx_barang_po po, 
                            barang b, 
                            supplier s, 
                            trx_payment_po_invoice inv 
                            left join trx_payment_out ot on ot.no_invoice = inv.no_invoice 
                        where 
                            po.no_invoice = inv.no_invoice 
                            and b.kode = po.kode 
                            and s.id = po.id_supplier 
                            and substring(inv.create_date, 1, 6) = '".$create_date."'";
        }

        return $this->db->query($query)->result();
    }

    public function getTotalTagihan($create_date,$keyword)
    {

        $query = "";

        if (isset($keyword) && $keyword != "") {

            $query = " SELECT sum(total_tagihan_history) - sum(total_tagihan) as nominal,
                    sum(total_tagihan_history)as total_tagihan FROM `trx_payment_po_invoice`
                    where no_invoice ='$keyword' /*GROUP by id_trx_payment*/";
        } else {

            $query = " SELECT sum(total_tagihan_history) - sum(total_tagihan) as nominal,
                    sum(total_tagihan_history)as total_tagihan FROM `trx_payment_po_invoice`
                    where substring(create_date,1,6) ='$create_date' /*GROUP by id_trx_payment*/";
        }

        return $this->db->query($query)->result();
    }
}
