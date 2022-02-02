<?php
class TelephoneModel extends CI_Model
{

    public function getWhere($where)
    {
        return $this->db->get_where('telephone', $where)->result();
    }

    public function insertData($data){
        $this->db->insert('telephone', $data);      
        return $this->db->insert_id();  
    }
}
?>