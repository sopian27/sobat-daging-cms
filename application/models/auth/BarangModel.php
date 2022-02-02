<?php
class BarangModel extends CI_Model
{

    public function countDataBarang()
    {
        $query = " SELECT 
                count(*) as CountData 
            FROM barang b
        ";

        return $this->db->query($query)->result();
    }


    public function getWhere($where)
    {
        return $this->db->get_where('barang', $where)->result();
    }

    public function insertData($data){
        $this->db->insert('barang', $data);      
        return $this->db->insert_id();  
    }

    /*
    public function updateLiveStocks($data)
    {
        $query = "UPDATE barang SET 
                    quantity_check=:quantity_check_barang
                WHERE 
                    kode=:kode
                AND nama_barang=:nama_barang
        ";
        $this->db->query($query);
        $this->db->bind('kode', $data['kode']);
        $this->db->bind('nama_barang', $data['nama_barang']);
        $this->db->bind('quantity_check_barang', $data['quantity_check_barang']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function selectDataLiveStocks($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        $query = "SELECT quantity_check 
                from 
                    barang 
                WHERE 
                    kode=:kode
                AND nama_barang=:nama_barang
        ";
        $this->db->query($query);
        $this->db->bind('kode', $data['kode']);
        $this->db->bind('nama_barang', $data['nama_barang']);

        $allData = $this->db->resultset();
        return $allData;
    }

    */

    public function selectDataPaging($halamanAwal, $batasTampilData)
    {
        $query = "  SELECT * from barang limit ".$halamanAwal.", ".$batasTampilData;
        
        return $this->db->query($query)->result();
    }


    public function getDataBarang()
    {
        $query = " SELECT * FROM barang order by create_date";

        return $this->db->query($query)->result();
    }
}
