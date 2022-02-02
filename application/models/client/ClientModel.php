<?php

class ClientModel extends CI_Model{

    public function insert($data,$TABLE_NAME){
        $this->db->insert($TABLE_NAME, $data);
        
        $query = $this->db->insert_id();  
        log_message('debug',$this->db->last_query()); 
        return $query;
    }

    public function update($data,$where,$TABLE_NAME){
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update($TABLE_NAME); 

        $query = $this->db->affected_rows();
        log_message('debug',$this->db->last_query());
        return $query;
    }

    public function delete($where,$TABLE_NAME){

        $this->db->where($where);
        $this->db->delete($TABLE_NAME);
        
        $query = $this->db->affected_rows();
        log_message('debug',$this->db->last_query());
        return $query;
    }

    public function getAll($TABLE_NAME){

        $this->db->order_by("create_date", "desc");
        $query = $this->db->get($TABLE_NAME)->result();
        log_message('debug',$this->db->last_query());
        return $query;
    }

    public function getWhere($where,$TABLE_NAME){

        $this->db->order_by("create_date", "desc");
        $query = $this->db->get_where($TABLE_NAME,$where)->result();
        log_message('debug',$this->db->last_query());

        return $query;
    }
    
}

?>