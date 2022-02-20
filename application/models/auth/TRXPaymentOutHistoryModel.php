<?php
class TRXPaymentOutHistoryModel extends CI_Model
{

    public function getTrxId()
    {

        $query = " select max(id_trx_payment_out) as trx_id from trx_payment_out where substring(create_date,1,8) =DATE_FORMAT(SYSDATE(), '%Y%m%d')";

        return $this->db->query($query)->result();
    }

    public function getTrxPaymentOut($create_date, $keyword, $halaman, $batasTampilData)
    {

        $query = "";

        if (isset($keyword) && $keyword != "") {

            $query = "SELECT poo.no_invoice,poo.create_date as tgl_pembayaran, s.nama as nama 
            from trx_payment_po_invoice poo,trx_barang_po po,supplier s 
            where poo.no_invoice = po.no_invoice and s.id= po.id_supplier and poo.no_invoice ='$keyword' group by poo.no_invoice
            limit " . $halaman . "," . $batasTampilData;

        } else {
            $query = "SELECT poo.no_invoice,poo.create_date as tgl_pembayaran, s.nama as nama 
            from trx_payment_po_invoice poo,trx_barang_po po,supplier s 
            where poo.no_invoice = po.no_invoice and s.id= po.id_supplier and substring(poo.create_date,1,6) ='$create_date' group by poo.no_invoice
            limit " . $halaman . "," . $batasTampilData;


        }

        return $this->db->query($query)->result();
    }

    public function getTrxPaymentOutCount($create_date, $keyword)
    {

        $query = "";

        if (isset($keyword) && $keyword != "") {

            $query = "SELECT poo.no_invoice,poo.create_date as tgl_pembayaran, s.nama as nama 
            from trx_payment_po_invoice poo,trx_barang_po po,supplier s 
            where poo.no_invoice = po.no_invoice and s.id= po.id_supplier and poo.no_invoice ='$keyword' group by poo.no_invoice";

        } else {

            $query = "SELECT poo.no_invoice,poo.create_date as tgl_pembayaran, s.nama as nama 
            from trx_payment_po_invoice poo,trx_barang_po po,supplier s 
            where poo.no_invoice = po.no_invoice and s.id= po.id_supplier and substring(poo.create_date,1,6) ='$create_date' group by poo.no_invoice";

        }

        return $this->db->query($query)->result();
    }


    public function getTotTrxPaymentOut($create_date, $keyword)
    {

        $query = "";

        if (isset($keyword) && $keyword != "") {

            $query = "SELECT sum(poo.harga_total) as total
            FROM trx_payment_out poo
            where poo.no_invoice ='$keyword' group by poo.no_invoice";

        } else {

            $query = "SELECT sum(poo.harga_total) as total
            FROM trx_payment_out poo
            where substring(poo.create_date,1,6) ='$create_date' group by poo.no_invoice";
        }

        return $this->db->query($query)->result();
    }

    public function getInvoiceData($data)
    {
        $no_invoice = $data['no_invoice'];
        $query = "SELECT s.nama,inv.total_tagihan,inv.id_trx_payment from trx_payment_po_invoice inv,trx_barang_po po, supplier s where inv.no_invoice = po.no_invoice
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

    public function getInvoicePayment($create_date, $keyword, $halaman, $batasTampilData)
    {

        $query = "";

        if (isset($keyword) && $keyword != "") {

            $query = "select po.kode,s.nama as nama,po.no_invoice,po.id_trx_po 
                from trx_barang_po po, supplier s,trx_payment_po_invoice inv 
                where s.id=po.id_supplier 
                and inv.no_invoice = po.no_invoice
                and po.no_invoice ='$keyword' group by po.no_invoice
                limit " . $halaman . "," . $batasTampilData;

        } else {

            
            $query = "select po.kode,s.nama as nama,po.no_invoice,po.id_trx_po
                    from trx_barang_po po, supplier s,trx_payment_po_invoice inv 
                    where s.id=po.id_supplier 
                    and inv.no_invoice = po.no_invoice
                    and substring(po.create_date,1,6) ='$create_date' group by po.no_invoice
                    limit  " . $halaman . "," . $batasTampilData;
        }

        return $this->db->query($query)->result();
    }

    public function getInvoicePaymentCount($create_date, $keyword)
    {

        $query = "";

        if (isset($keyword) && $keyword != "") {

            $query = "select po.kode,s.nama as nama,po.no_invoice,po.id_trx_po 
                    from trx_barang_po po, supplier s,trx_payment_po_invoice inv 
                    where s.id=po.id_supplier 
                    and inv.no_invoice = po.no_invoice
                    and po.no_invoice ='$keyword' group by po.no_invoice";

        } else {

            $query = "select po.kode,s.nama as nama,po.no_invoice,po.id_trx_po
                    from trx_barang_po po, supplier s,trx_payment_po_invoice inv 
                    where s.id=po.id_supplier 
                    and inv.no_invoice = po.no_invoice
                    and substring(po.create_date,1,6) ='$create_date' group by po.no_invoice";
        }

        return $this->db->query($query)->result();
    }

    public function getKodeData($id_trx_po, $halaman, $batasTampilData)
    {
        $query = " SELECT 
                         tbo.kode, 
                         tbo.nama_barang, 
                         tbo.satuan, 
                         tbo.harga_satuan,
                         tbo.harga_total,
                         tbo.id,
                         tbo.quantity, 
                         tbo.id_trx_po,
                         tbo.quantity_check,
                         s.nama,
                         tbo.create_date,
                         tbo.status,
                         tbo.no_invoice,
                         inv.*
                     FROM 
                         trx_barang_po tbo,
                         supplier s,
                         trx_payment_po_invoice inv 
                     WHERE 
                         tbo.id_supplier = s.id 
                         and inv.no_invoice = tbo.no_invoice
                         and tbo.id_trx_po = '$id_trx_po'
                         and tbo.status >='4' 
                         and tbo.no_invoice !='' 
                         and tbo.id_trx_live_stocks !='' 
                         limit " . $halaman . "," . $batasTampilData;

        return $this->db->query($query)->result();
    }

    public function getKodeDataCounter($id_trx_po)
    {
        $query = " SELECT 
                        tbo.kode, 
                        tbo.nama_barang, 
                        tbo.satuan, 
                        tbo.harga_satuan,
                        tbo.id,
                        tbo.quantity, 
                        tbo.id_trx_po,
                        tbo.quantity_check,
                        s.nama,
                        tbo.create_date,
                        tbo.no_invoice,
                        tbo.status,
                        inv.*
                    FROM 
                        trx_barang_po tbo,
                        supplier s, 
                        trx_payment_po_invoice inv 
                     WHERE 
                        tbo.id_supplier = s.id 
                        and inv.no_invoice = tbo.no_invoice
                        and tbo.id_trx_po = '$id_trx_po'
                        and tbo.status >= '4' 
                        and tbo.no_invoice !='' 
                        and tbo.id_trx_live_stocks !=''"; 

        return $this->db->query($query)->result();
    }

    public function getSumTotalPo($data){

        $id_trx_po = $data;
        $query = " SELECT sum(harga_total) as total FROM `trx_barang_po` WHERE id_trx_po='$id_trx_po' and status >='4'";

        return $this->db->query($query)->result();
    }
}
