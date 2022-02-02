<?php
class HistoryOrderModel extends CI_Model
{

    public function getDataByDate($data)
    {

        $date = $data['date_choosen'];

        $query = " SELECT id_trx_order,p.nama_pelanggan 
                  FROM trx_order_po t,pelanggan p 
                  WHERE t.id_pelanggan=p.id and status='1' and
                  substring(t.create_date,1,8) ='$date' group by id_trx_order";

        return $this->db->query($query)->result();
    }

    public function getDetailTrx($data)
    {
        $trx_data = $data['id_trx_order'];
        $query = " SELECT b.nama_barang,po.quantity,po.satuan,po.id 
                   FROM trx_order_po po, barang b 
                   WHERE b.id= po.id_barang and po.id_trx_order='$trx_data'";

        return $this->db->query($query)->result();
    }

    public function getHistoryOrderDetailTrx($trxId)
    {

        $query = " SELECT t.*,p.*,b.nama_barang,b.kode,t.id as id_po
                    FROM trx_order_po t,pelanggan p, barang b 
                    WHERE t.id_pelanggan=p.id and  
                    b.id = t.id_barang and
                    t.id_trx_order = '$trxId'";

        return $this->db->query($query)->result();
    }


    public function getHistoryOrderDetailTrxBySsj($data)
    {
        $no_surat_jalan = $data['no_surat_jalan'];

        $query = " SELECT t.*,p.*,b.nama_barang,b.kode,t.id as id_po,te.nomor,a.alamat,co.*
                    FROM trx_order_po t,pelanggan p, barang b, alamat a, telephone te,trx_payment_co_invoice co 
                    WHERE t.id_pelanggan=p.id 
                    and b.id = t.id_barang
                    and co.no_surat_jalan = t.no_surat_jalan
                    and t.id_telephone = te.id
                    and t.id_alamat = a.id
                    and t.no_surat_jalan ='$no_surat_jalan' group by b.id ";

        return $this->db->query($query)->result();
    }
}
