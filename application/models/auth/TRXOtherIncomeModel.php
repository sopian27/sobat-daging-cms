<?php
class TRXOtherIncomeModel extends CI_Model
{

    public function insertData($data){
        $this->db->insert('ot_income', $data);      
        return $this->db->insert_id();  
    }

    public function getTrxId()
    {

        $query = " select max(id_trx_ot) as trx_id from ot_income where substring(create_date,1,8) =DATE_FORMAT(SYSDATE(), '%Y%m%d')";

        return $this->db->query($query)->result();
    }

    public function getDataOtherByDate($data)
    {
        $date = $data['date_value'];
        $query = " SELECT penggunaan_dana,keterangan,id_trx_ot as kode 
                   FROM ot_income 
                   WHERE substring(create_date,1,6) = '$date'";

        return $this->db->query($query)->result();
    }

    public function getDataSumOtherByDate($data)
    {
        $date = $data['create_date'];
        $keyword = $data['keyword'];

        $query = "";

        if ($keyword != ""  && $date == "Januari, Februari, Maret....") {

            $query = "  SELECT sum(penggunaan_dana) as total
                        FROM ot_income 
                        WHERE id_trx_ot like '%$keyword%' group by substring(create_date,1,6) ";

        } else if ($keyword != "" && $date != "Januari, Februari, Maret....") {

            $query = "  SELECT sum(penggunaan_dana) as total
                        FROM ot_income 
                        WHERE id_trx_ot like '%$keyword%' and substring(create_date,1,6) ='$date' group by substring(create_date,1,6) ";

        } else {

            $query = " SELECT sum(penggunaan_dana) as total
                        FROM ot_income 
                        WHERE substring(create_date,1,6) ='$date' group by substring(create_date,1,6) ";

        }
       
        return $this->db->query($query)->result();
    }

    public function getData($create_date, $keyword, $halaman, $batasTampilData)
    {

        $query = "";

        if ($keyword != ""  && $create_date == "Januari, Februari, Maret....") {

            $query = "  SELECT 
                            *
                        from 
                            ot_income b
                        where 
                            b.id_trx_ot like '%$keyword%' 
                        order by b.id
                            limit " . $halaman . "," . $batasTampilData;

        } else if ($keyword != "" && $create_date != "Januari, Februari, Maret....") {

            $query = "  SELECT 
                            *
                        from 
                            ot_income b
                        where 
                            b.id_trx_ot like '%$keyword%' 
                            and substring(b.create_date,1,6)= '" . $create_date . "' 
                        order by b.id
                            limit " . $halaman . "," . $batasTampilData;

        } else {

            $query = "  SELECT 
                            *
                        from 
                            ot_income b
                        where 
                            substring(b.create_date,1,6)= '" . $create_date . "'                          
                        order by b.id
                            limit " . $halaman . "," . $batasTampilData;
        }

        return $this->db->query($query)->result();
    }

    public function getDataCount($create_date, $keyword)
    {

        $query = "";

        if ($keyword != ""  && $create_date == "Januari, Februari, Maret....") {

            $query = "  SELECT 
                            *
                        from 
                            ot_income b
                        where 
                            b.id_trx_ot like '%$keyword%' 
                        order by b.id";

        } else if ($keyword != "" && $create_date != "Januari, Februari, Maret....") {

            $query = "  SELECT 
                            *
                        from 
                            ot_income b
                        where 
                            b.id_trx_ot like '%$keyword%' 
                            and substring(b.create_date,1,6)= '" . $create_date . "' 
                        order by b.id";

        } else {

            $query = "  SELECT 
                            *
                        from 
                            ot_income b
                        where 
                            substring(b.create_date,1,6)= '" . $create_date . "'                          
                        order by b.id";
        }

        return $this->db->query($query)->result();
    }
}
