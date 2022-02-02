<?php
class PelangganModel extends CI_Model
{

    public function insertData($data){
        $this->db->insert('pelanggan', $data);      
        return $this->db->insert_id();  
    }


    public function getWhere($where)
    {
        return $this->db->get_where('pelanggan', $where)->result();
    }


    public function getAll()
    {
        return $this->db->get('pelanggan')->result();
    }
}
