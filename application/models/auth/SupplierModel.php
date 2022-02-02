<?php
class SupplierModel extends CI_Model
{

    public function getWhere($where)
    {
        return $this->db->get_where('supplier', $where)->result();
    }

    public function insertData($data){
        $this->db->insert('supplier', $data);      
        return $this->db->insert_id();  
    }

    /*
    public function getSupplierName($data)
    {

        $query = " SELECT  DISTINCT s.nama 
                    FROM 
                        trx_barang_po tbo, 
                        supplier s 
                    WHERE 
                        tbo.id_supplier = s.id  
                    AND s.nama Like :nama ";

        $this->db->query($query);
        $this->db->bind('nama', '%' . $data . '%');
        $allData = $this->db->resultset();
        return $allData;
    }

    public function getDateTitle($data)
    {
        $data = $data."-19";
        $query = " SELECT MONTHNAME(:mont) as nama ";

        $this->db->query($query);
        $this->db->bind('mont', $data);
        $allData = $this->db->resultset();
        return $allData;
    }
    */
}
?>
