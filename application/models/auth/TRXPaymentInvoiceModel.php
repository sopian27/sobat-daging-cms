<?php
class TRXPaymentInvoiceModel extends CI_Model
{

    /*
    public function insertData($data)
    {

        $query = "INSERT INTO trx_payment_co_invoice(
                            id_trx_payment, no_surat_jalan,
                            total_tagihan,jatuh_tempo, 
                            create_date, update_date, 
                            bank_tujuan,
                            no_rekening,atas_nama,bonus
            ) VALUES (
                            :id_trx_payment, :no_surat_jalan, 
                            :total_tagihan, :jatuh_tempo, 
                            DATE_FORMAT(SYSDATE(), '%Y%m%d%H%i%s'), DATE_FORMAT(SYSDATE(), '%Y%m%d%H%i%s'), 
                            :bank_tujuan,
                            :no_rekening,:atas_nama,:bonus
                )";

        $this->db->query($query);
        $this->db->bind('id_trx_payment', $data['id_trx_payment']);
        $this->db->bind('no_surat_jalan', $data['no_surat_jalan']);
        $this->db->bind('total_tagihan', $data['total_tagihan']);
        $this->db->bind('jatuh_tempo', str_replace("","/",$data['jatuh_tempo']));
        $this->db->bind('bank_tujuan', $data['bank_tujuan']);
        $this->db->bind('no_rekening', $data['no_rekening']);
        $this->db->bind('atas_nama', $data['atas_nama']);
        $this->db->bind('bonus', $data['bonus']);

        $this->db->execute();
        return $this->db->rowCount();
    }
    */

    public function getTrxId(){

        $query = " select max(id_trx_payment) as trx_id from trx_payment_co_invoice where substring(create_date,1,8) =DATE_FORMAT(SYSDATE(), '%Y%m%d')";

        return $this->db->query($query)->result();
    }

    public function getTrxIdPo(){

        $query = " select max(id_trx_payment) as trx_id from trx_payment_po_invoice where substring(create_date,1,8) =DATE_FORMAT(SYSDATE(), '%Y%m%d')";

        return $this->db->query($query)->result();
    }

    public function getSumTotal($data){

        $no_surat_jln = $data['no_surat_jalan'];
        $query = " SELECT sum(harga_total) as total FROM `trx_order_po` WHERE no_surat_jalan='$no_surat_jln' and status='1'";

        return $this->db->query($query)->result();
    }

    public function checkSuratJlnIsExist($data){

        $no_surat_jln = $data['no_surat_jalan'];
        $query = " SELECT count(*) as total FROM `trx_payment_co_invoice` WHERE no_surat_jalan='$no_surat_jln'";

        return $this->db->query($query)->result();
    }

    public function checKodePoIsExist($data){

        $kode_po = $data['kode_po'];
        $query = " SELECT count(*) as total FROM `trx_payment_po_invoice` WHERE id_trx_po='$kode_po'";

        return $this->db->query($query)->result();
    }

    /*
    public function insertDataPo($data)
    {

        $query = "INSERT INTO trx_payment_po_invoice(
                            id_trx_payment, id_trx_po,
                            total_tagihan,jatuh_tempo, 
                            create_date, update_date
            ) VALUES (
                            :id_trx_payment, :id_trx_po, 
                            :total_tagihan, :jatuh_tempo, 
                            DATE_FORMAT(SYSDATE(), '%Y%m%d%H%i%s'), DATE_FORMAT(SYSDATE(), '%Y%m%d%H%i%s')
                )";

        $this->db->query($query);
        $this->db->bind('id_trx_payment', $data['id_trx_payment']);
        $this->db->bind('id_trx_po', $data['id_trx_po']);
        $this->db->bind('total_tagihan', $data['total_tagihan']);
        $this->db->bind('jatuh_tempo', $data['jatuh_tempo']);

        $this->db->execute();
        return $this->db->rowCount();
    }
    */

    public function getNoSuratJalanData($data){

        $no_surat_jalan=$data['no_surat_jalan'];
        $query = " SELECT t.*,p.*,b.nama_barang,b.kode,t.id as id_po,te.nomor,a.alamat
                    FROM trx_order_po t,pelanggan p, barang b, alamat a, telephone te 
                    WHERE t.id_pelanggan=p.id 
                    and b.id = t.id_barang
                    and t.status='1'
                    /*and co.no_surat_jalan = t.no_surat_jalan*/
                    and t.id_telephone = te.id
                    and t.id_alamat = a.id
                    and t.no_surat_jalan ='$no_surat_jalan' group by b.id ";

        return $this->db->query($query)->result();
    }

    public function insertDataCustomer($data){
        $this->db->insert('trx_payment_co_invoice', $data);      
        return $this->db->insert_id();  
    }

    public function insertDataPembelian($data){
        $this->db->insert('trx_payment_po_invoice', $data);      
        return $this->db->insert_id();  
    }

    
}
