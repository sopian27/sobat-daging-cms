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

    public function getData($create_date, $keyword, $halaman, $batasTampilData)
    {

        $query = "";

        if (isset($keyword) && $keyword != "") {

            $query = "  SELECT 
                           *
                        from 
                            supplier p  
                        where 
                            p.nama like '%$keyword%' 
                        order by p.id
                            limit " . $halaman . "," . $batasTampilData;
        } else {

            $query = "  SELECT 
                            *
                        from 
                            supplier p 
                        order by p.id
                            limit " . $halaman . "," . $batasTampilData;
        }

        return $this->db->query($query)->result();
    }

    public function getDataCount($create_date, $keyword)
    {

        $query = "";

        if (isset($keyword) && $keyword != "") {

            $query = "  SELECT 
                            *
                        from 
                            supplier p  
                        where 
                            p.nama like '%$keyword%' 
                        order by p.id";
        } else {

            $query = "  SELECT 
                            *
                        from 
                            supplier p 
                        order by p.id";
        }

        return $this->db->query($query)->result();
    }
}
?>
