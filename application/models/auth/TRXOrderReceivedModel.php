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

    public function getTrxId(){

        $query = " select max(id_trx_order) as trx_id from trx_order_po where substring(create_date,1,8) =DATE_FORMAT(SYSDATE(), '%Y%m%d')";

        return $this->db->query($query)->result();
    }

    public function getTrxNoSuratJalan(){

        $query = " select max(no_surat_jalan) as trx_id from trx_order_po where substring(create_date,1,8) =DATE_FORMAT(SYSDATE(), '%Y%m%d')";

        return $this->db->query($query)->result();
    }

    public function getTrxIdNoInvoice(){

        $query = " select max(no_invoice) as trx_id from trx_order_po where substring(create_date,1,8) =DATE_FORMAT(SYSDATE(), '%Y%m%d')";

        return $this->db->query($query)->result();
    }

    public function getTrxIdLiveOrder(){

        $query = " select max(id_trx_live_order) as trx_id from trx_order_po where substring(create_date,1,8) =DATE_FORMAT(SYSDATE(), '%Y%m%d')";

        return $this->db->query($query)->result();
    }
}
?>