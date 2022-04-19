<?php
class TRXOrderReceivedModel extends CI_Model
{
   
    public function insertData($data){
        $this->db->insert('trx_order_po', $data);      
        return $this->db->insert_id();  
    }

    public function insertDataBatch($data){
        $this->db->insert_batch('trx_order_po', $data);      
        //return $this->db->insert_id();  
    }

    public function getTrxId($tgl_trx){

        $query = " select max(id_trx_order) as trx_id from trx_order_po where date_format(create_date,'%Y-%m-%d') = '$tgl_trx'";

        return $this->db->query($query)->result();
    }

    public function getTrxNoSuratJalan($tgl_trx){

        $query = " select max(no_surat_jalan) as trx_id from trx_order_po where date_format(create_date,'%Y-%m-%d') = '$tgl_trx'";

        return $this->db->query($query)->result();
    }

    public function getTrxIdNoInvoice($tgl_trx){

        $query = " select max(no_invoice) as trx_id from trx_order_po where date_format(create_date,'%Y-%m-%d') = '$tgl_trx'";

        return $this->db->query($query)->result();
    }

    public function getTrxIdLiveOrder($tgl_trx){

        $query = " select max(id_trx_live_order) as trx_id from trx_order_po where date_format(create_date,'%Y-%m-%d') = '$tgl_trx'";

        return $this->db->query($query)->result();
    }
}
?>