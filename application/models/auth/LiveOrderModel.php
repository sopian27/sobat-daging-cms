<?php
class LiveOrderModel extends CI_Model
{

    public function getDataByDate($data)
    {

        $date = $data['date_choosen'];
        $query = " SELECT id_trx_order,p.nama_pelanggan 
                  FROM trx_order_po t,pelanggan p 
                  WHERE t.id_pelanggan=p.id and status='0' and
                  substring(t.create_date,1,8) ='$date' group by id_trx_order";

        return $this->db->query($query)->result();
    }

    public function getDetailTrx($data)
    {
        $data_trx = $data['id_trx_order'];
        $query = " SELECT b.nama_barang,po.quantity,po.satuan,po.id 
                   FROM trx_order_po po, barang b 
                   WHERE b.id= po.id_barang and po.id_trx_order='$data_trx'";

        return $this->db->query($query)->result();
    }

    public function getliveOrderDetail($data)
    {
        $date = $data['createdate'];
        $query = " SELECT id_trx_order,p.nama_pelanggan,b.nama_barang,t.quantity,t.satuan
                    FROM trx_order_po t,pelanggan p, barang b 
                    WHERE t.id_pelanggan=p.id and  
                    b.id = t.id_barang and status='0' and
                    substring(t.create_date,1,8) ='$date' order by id_trx_order ";

        return $this->db->query($query)->result();
    }

    public function getliveOrderDetailKeyword($data)
    {
        $date = $data['createdate'];
        $query = " SELECT id_trx_order,p.nama_pelanggan,b.nama_barang,t.quantity,t.satuan
                    FROM trx_order_po t,pelanggan p, barang b 
                    WHERE t.id_pelanggan=p.id and  
                    b.id = t.id_barang and status='0' and
                    p.nama_pelanggan LIKE '%$date%' order by id_trx_order ";

        return $this->db->query($query)->result();
    }

    public function getliveOrderDetailTrx($trxId)
    {

        $query = " SELECT t.*,p.*,b.nama_barang,b.kode,t.id as id_po
                    FROM trx_order_po t,pelanggan p, barang b 
                    WHERE t.id_pelanggan=p.id and  
                    b.id = t.id_barang and status='0' and
                    t.id_trx_order ='$trxId'";

        return $this->db->query($query)->result();
    }

    public function getliveOrderDetailTrxPrint($trxId)
    {

        $query = " SELECT t.*,p.*,b.nama_barang,b.kode,t.id as id_po
                    FROM trx_order_po t,pelanggan p, barang b 
                    WHERE t.id_pelanggan=p.id and  
                    b.id = t.id_barang and status='1' and
                    t.id_trx_order = '$trxId'";

        return $this->db->query($query)->result();
    }

    /*
    public function confirmOrder($data)
    {

        $query = "UPDATE trx_order_po SET bungkusan =:bungkusan,status='1' WHERE id =:id and id_trx_order =:id_trx_order";

        $this->db->query($query);
        $this->db->bind('bungkusan', $data['bungkusan']);
        $this->db->bind('id', $data['id']);
        $this->db->bind('id_trx_order', $data['id_trx_order']);
        $this->db->execute();
        return $this->db->rowCount();
    }
    */

    public function update($data,$where){
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update('trx_order_po'); 
        return $this->db->affected_rows();
    }
}
