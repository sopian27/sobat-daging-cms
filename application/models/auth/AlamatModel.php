<?php
class AlamatModel extends CI_Model
{

    public function getWhere($where)
    {
        return $this->db->get_where('alamat', $where)->result();
    }

    public function insertData($data){
        $this->db->insert('alamat', $data);      
        return $this->db->insert_id();  
    }
}
