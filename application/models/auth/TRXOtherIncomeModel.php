<?php
class TRXOtherIncomeModel extends CI_Model
{

    public function insertData($data){
        $this->db->insert('ot_income', $data);      
        return $this->db->insert_id();  
    }

    public function getTrxId($tgl_trx)
    {

        $query = " select max(id_trx_ot) as trx_id from ot_income where date_format(create_date,'%Y-%m-%d') = '$tgl_trx'";

        return $this->db->query($query)->result();
    }

    public function getDataOtherByDate($data)
    {
        $date = $data['date_value'];
        $query = " SELECT penggunaan_dana,keterangan,id_trx_ot as kode 
                   FROM ot_income 
                   WHERE date_format(create_date,'%Y%m')= '$date'";

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
                        WHERE keterangan like '%$keyword%' group by date_format(create_date,'%Y%m') ";

        } else if ($keyword != "" && $date != "Januari, Februari, Maret....") {

            $query = "  SELECT sum(penggunaan_dana) as total
                        FROM ot_income 
                        WHERE keterangan like '%$keyword%' and date_format(create_date,'%Y%m')= '$date' group by date_format(create_date,'%Y%m')";

        } else {

            $query = " SELECT sum(penggunaan_dana) as total
                        FROM ot_income 
                        WHERE date_format(create_date,'%Y%m')= '$date' group by date_format(create_date,'%Y%m') ";

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
                            b.keterangan like '%$keyword%' 
                        order by b.id
                            limit " . $halaman . "," . $batasTampilData;

        } else if ($keyword != "" && $create_date != "Januari, Februari, Maret....") {

            $query = "  SELECT 
                            *
                        from 
                            ot_income b
                        where 
                            b.keterangan like '%$keyword%' and
                            date_format(create_date,'%Y%m')= '$create_date'
                        order by b.id
                            limit " . $halaman . "," . $batasTampilData;

        } else {

            $query = "  SELECT 
                            *
                        from 
                            ot_income b
                        where 
                            date_format(create_date,'%Y%m')= '$create_date'                          
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
                            b.keterangan like '%$keyword%' 
                        order by b.id";

        } else if ($keyword != "" && $create_date != "Januari, Februari, Maret....") {

            $query = "  SELECT 
                            *
                        from 
                            ot_income b
                        where 
                            b.keterangan like '%$keyword%' 
                            and date_format(create_date,'%Y%m')= '$create_date' 
                        order by b.id";

        } else {

            $query = "  SELECT 
                            *
                        from 
                            ot_income b
                        where 
                            date_format(create_date,'%Y%m')= '$create_date'                         
                        order by b.id";
        }

        return $this->db->query($query)->result();
    }
}
