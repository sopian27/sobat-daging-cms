<?php
class TRXPaymentInHistoryModel extends CI_Model
{
    public function getTrxId()
    {

        $query = " select max(id_trx_payment_in) as trx_id from trx_payment_in where substring(create_date,1,8) =DATE_FORMAT(SYSDATE(), '%Y%m%d')";

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

    public function getTotTrxPaymentIn($create_date, $keyword)
    {

        $query = "";

        if (isset($keyword) && $keyword != "") {
            
            $query = "SELECT sum(poo.harga_total) as total
            FROM trx_payment_in poo
            where poo.no_invoice ='$keyword' group by poo.no_invoice";
        
        } else {

            $query = "SELECT sum(poo.harga_total) as total
            FROM trx_payment_in poo
            where substring(poo.create_date,1,6) ='$create_date' group by poo.no_invoice";

        }

        return $this->db->query($query)->result();
    }


    public function getTrxPaymentIn($create_date, $keyword, $halaman, $batasTampilData)
    {

        $query = "";

        if (isset($keyword) && $keyword != "") {

            $query = " SELECT po.no_invoice,pi.create_date as tgl_pembayaran, p.nama_pelanggan as nama 
            from trx_payment_co_invoice pi,trx_order_po po,pelanggan p
            where pi.no_surat_jalan = po.no_surat_jalan and p.id= po.id_pelanggan and po.no_invoice ='$keyword' group by pi.no_surat_jalan
            limit " . $halaman . "," . $batasTampilData;

        } else {

            $query = " SELECT po.no_invoice,pi.create_date as tgl_pembayaran, p.nama_pelanggan as nama 
            from trx_payment_co_invoice pi,trx_order_po po,pelanggan p
            where pi.no_surat_jalan = po.no_surat_jalan and p.id= po.id_pelanggan and substring(pi.create_date,1,6) ='$create_date' group by pi.no_surat_jalan
            limit " . $halaman . "," . $batasTampilData;
        }

        return $this->db->query($query)->result();
    }

    public function getTrxPaymentInCount($create_date, $keyword)
    {

        $query = "";

        if (isset($keyword) && $keyword != "") {

            $query = " SELECT po.no_invoice,pi.create_date as tgl_pembayaran, p.nama_pelanggan as nama 
            from trx_payment_co_invoice pi,trx_order_po po,pelanggan p
            where pi.no_surat_jalan = po.no_surat_jalan and p.id= po.id_pelanggan and po.no_invoice ='$keyword' group by pi.no_surat_jalan";
        
        } else {
            $query = " SELECT po.no_invoice,pi.create_date as tgl_pembayaran, p.nama_pelanggan as nama 
            from trx_payment_co_invoice pi,trx_order_po po,pelanggan p
            where pi.no_surat_jalan = po.no_surat_jalan and p.id= po.id_pelanggan and substring(pi.create_date,1,6) ='$create_date' group by pi.no_surat_jalan";


        }

        return $this->db->query($query)->result();
    }

    public function getInvoiceCustomer($create_date, $keyword, $halaman, $batasTampilData)
    {

        $query = "";

        if (isset($keyword) && $keyword != "") {

            $query = "select po.no_surat_jalan,p.nama_pelanggan as nama,po.no_invoice 
            from trx_order_po po, pelanggan p,trx_payment_co_invoice inv 
            where po.id_pelanggan=p.id 
            and inv.no_surat_jalan = po.no_surat_jalan
            and po.no_invoice ='$keyword' group by po.no_invoice
            limit " . $halaman . "," . $batasTampilData;
          
        } else {

            $query = "select po.no_surat_jalan,p.nama_pelanggan as nama,po.no_invoice 
            from trx_order_po po, pelanggan p,trx_payment_co_invoice inv  
            where po.id_pelanggan=p.id 
            and inv.no_surat_jalan = po.no_surat_jalan 
            and substring(po.create_date,1,6) ='$create_date' group by po.no_invoice
            limit " . $halaman . "," . $batasTampilData;


        }

        return $this->db->query($query)->result();
    }

    public function getInvoiceCustomerCount($create_date, $keyword)
    {

        $query = "";

        if (isset($keyword) && $keyword != "") {

            $query = "select po.no_surat_jalan,p.nama_pelanggan as nama,po.no_invoice 
            from trx_order_po po, pelanggan p,trx_payment_co_invoice inv 
            where po.id_pelanggan=p.id 
            and inv.no_surat_jalan = po.no_surat_jalan
            and po.no_invoice ='$keyword' group by po.no_invoice";
           
        } else {

            $query = "select po.no_surat_jalan,p.nama_pelanggan as nama,po.no_invoice 
            from trx_order_po po, pelanggan p,trx_payment_co_invoice inv  
            where po.id_pelanggan=p.id 
            and inv.no_surat_jalan = po.no_surat_jalan 
            and substring(po.create_date,1,6) ='$create_date' group by po.no_invoice";

        }

        return $this->db->query($query)->result();
    }

    public function getNoSuratJalanData($no_surat_jalan, $halaman, $batasTampilData){

        $query = " SELECT t.*,p.*,b.nama_barang,b.kode,t.id as id_po,te.nomor,a.alamat,inv.*
                    FROM trx_order_po t,pelanggan p, barang b, alamat a, telephone te,trx_payment_co_invoice inv
                    WHERE t.id_pelanggan=p.id 
                    and b.id = t.id_barang
                    and inv.no_surat_jalan = t.no_surat_jalan
                    and t.status >='2'
                    /*and co.no_surat_jalan = t.no_surat_jalan*/
                    and t.id_telephone = te.id
                    and t.id_alamat = a.id
                    and t.no_surat_jalan ='$no_surat_jalan' group by b.id 
                    limit " . $halaman . "," . $batasTampilData;

        return $this->db->query($query)->result();
    }

    public function getNoSuratJalanDataCount($no_surat_jalan){

        $query = " SELECT t.*,p.*,b.nama_barang,b.kode,t.id as id_po,te.nomor,a.alamat,inv.*
                    FROM trx_order_po t,pelanggan p, barang b, alamat a, telephone te,trx_payment_co_invoice inv
                    WHERE t.id_pelanggan=p.id 
                    and b.id = t.id_barang
                    and inv.no_surat_jalan = t.no_surat_jalan
                    and t.status >='2'
                    /*and co.no_surat_jalan = t.no_surat_jalan*/
                    and t.id_telephone = te.id
                    and t.id_alamat = a.id
                    and t.no_surat_jalan ='$no_surat_jalan' group by b.id";

        return $this->db->query($query)->result();
    }

    public function getSumTotal($data){

        $no_surat_jln = $data;
        $query = " SELECT sum(harga_total) as total FROM `trx_order_po` WHERE no_surat_jalan='$no_surat_jln' and status >='2'";

        return $this->db->query($query)->result();
    }


}
