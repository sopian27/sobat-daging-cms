<?php
class PelangganModel extends CI_Model
{

    public function insertData($data)
    {
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

    public function getData($create_date, $keyword, $halaman, $batasTampilData)
    {

        $query = "";

        if (isset($keyword) && $keyword != "") {

            $query = "  SELECT 
                            p.id, 
                            p.nama_pelanggan, 
                            a.alamat, 
                            t.nomor 
                        from 
                            pelanggan p, 
                            alamat a, 
                            telephone t 
                        where 
                            p.id = a.id_pelanggan 
                            and p.id = t.id_pelanggan
                            and p.nama_pelanggan like '%$keyword%' 
                        order by p.id
                            limit " . $halaman . "," . $batasTampilData;
        } else {

            $query = "  SELECT 
                            p.id, 
                            p.nama_pelanggan, 
                            a.alamat, 
                            t.nomor 
                        from 
                            pelanggan p, 
                            alamat a, 
                            telephone t 
                        where 
                            p.id = a.id_pelanggan 
                            and p.id = t.id_pelanggan
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
                            p.id, 
                            p.nama_pelanggan, 
                            a.alamat, 
                            t.nomor 
                        from 
                            pelanggan p, 
                            alamat a, 
                            telephone t 
                        where 
                            p.id = a.id_pelanggan 
                            and p.id = t.id_pelanggan
                            and p.nama_pelanggan like '%$keyword%' 
                        order by p.id";
        } else {

            $query = "  SELECT 
                            p.id, 
                            p.nama_pelanggan, 
                            a.alamat, 
                            t.nomor 
                        from 
                            pelanggan p, 
                            alamat a, 
                            telephone t 
                        where 
                            p.id = a.id_pelanggan 
                            and p.id = t.id_pelanggan
                        order by p.id";
        }

        return $this->db->query($query)->result();
    }
}
