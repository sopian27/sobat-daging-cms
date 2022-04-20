<?php
class TRXExpensesModel extends CI_Model
{

    public function insertData($data)
    {
        $this->db->insert('ex_opt', $data);
        return $this->db->insert_id();
    }

    public function insertSallary($data)
    {
        $this->db->insert('ex_sallary', $data);
        return $this->db->insert_id();
    }

    public function getTrxId($tgl_trx)
    {

        $query = " select max(id_trx_ex_opt) as trx_id from ex_opt where date_format(create_date,'%Y-%m-%d') = '$tgl_trx'";

        return $this->db->query($query)->result();
    }

    public function getTrxIdSallary($tgl_trx)
    {

        $query = " select max(id_trx) as trx_id from ex_sallary where date_format(create_date,'%Y-%m-%d') = '$tgl_trx'";

        return $this->db->query($query)->result();
    }

    public function getDataExpensesByDate($data)
    {
        $date = $data['date_value'];
        $query = " SELECT penggunaan_dana,keterangan,id_trx_ex_opt as kode 
                   FROM ex_opt 
                   WHERE date_format(create_date,'%Y%m')= '$date'";
        return $this->db->query($query)->result();
    }

    public function getDataSumExpensesByDate($data)
    {
        $date = $data['create_date'];
        $query = " SELECT sum(penggunaan_dana) as total
                   FROM ex_opt 
                   WHERE date_format(create_date,'%Y%m')= '$date' group by date_format(create_date,'%Y%m') ";

        return $this->db->query($query)->result();
    }

    public function getData($create_date, $keyword, $halaman, $batasTampilData)
    {

        $query = "";

        if ($keyword != ""  && $create_date == "Januari, Februari, Maret....") {

            $query = "  SELECT 
                            *
                        from 
                            ex_opt b
                        where 
                            b.id_trx_ex_opt like  '%$keyword%' 
                        order by b.id
                            limit " . $halaman . "," . $batasTampilData;

        } else if ($keyword != "" && $create_date != "Januari, Februari, Maret....") {

            $query = "  SELECT 
                            *
                        from 
                            ex_opt b
                        where 
                            b.id_trx_ex_opt like  '%$keyword%' 
                            and date_format(create_date,'%Y%m')= '$create_date'
                        order by b.id
                            limit " . $halaman . "," . $batasTampilData;

        } else {

            $query = "  SELECT 
                            *
                        from 
                            ex_opt b
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
                            ex_opt b
                        where 
                            b.id_trx_ex_opt like  '%$keyword%' 
                        order by b.id";

        } else if ($keyword != "" && $create_date != "Januari, Februari, Maret....") {

            $query = "  SELECT 
                            *
                        from 
                            ex_opt b
                        where 
                            b.id_trx_ex_opt like  '%$keyword%' 
                            date_format(create_date,'%Y%m')= '$create_date'
                        order by b.id";

        } else {

            $query = "  SELECT 
                            *
                        from 
                            ex_opt b
                        where 
                            date_format(create_date,'%Y%m')= '$create_date'                          
                        order by b.id";
        }

        return $this->db->query($query)->result();
    }

    public function getDataSallary($create_date, $keyword,$type, $halaman, $batasTampilData)
    {

        $query = "";

        if ($keyword != ""  && $create_date == "Januari, Februari, Maret....") {

            $query = "  SELECT 
                            *
                        from 
                            ex_sallary b
                        where 
                            b.nama like '%$keyword%' 
                            and type='".$type."'
                        order by b.id
                            limit " . $halaman . "," . $batasTampilData;

        } else if ($keyword != "" && $create_date != "Januari, Februari, Maret....") {

            $query = "  SELECT 
                            *
                        from 
                            ex_sallary b
                        where 
                            b.nama like '%$keyword%' 
                            and type='".$type."'
                            and date_format(b.create_date,'%Y%m')= '$create_date' 
                        order by b.id
                            limit " . $halaman . "," . $batasTampilData;

        } else {

            $query = "  SELECT 
                            *
                        from 
                            ex_sallary b
                        where 
                            date_format(create_date,'%Y%m')= '$create_date'
                            and type='".$type."'                      
                        order by b.id
                            limit " . $halaman . "," . $batasTampilData;
        }

        return $this->db->query($query)->result();
    }

    public function getDataSallaryCount($create_date, $keyword,$type)
    {

        $query = "";

        if ($keyword != ""  && $create_date == "Januari, Februari, Maret....") {

            $query = "  SELECT 
                            *
                        from 
                            ex_sallary b
                        where 
                            b.nama like '%$keyword%' 
                            and type='".$type."'
                        order by b.id";

        } else if ($keyword != "" && $create_date != "Januari, Februari, Maret....") {

            $query = "  SELECT 
                            *
                        from 
                            ex_sallary b
                        where 
                            b.nama like '%$keyword%' 
                            and type='".$type."'
                            and date_format(create_date,'%Y%m')= '$create_date' 
                        order by b.id";

        } else {

            $query = "  SELECT 
                            *
                        from 
                            ex_sallary b
                        where 
                             date_format(create_date,'%Y%m')= '$create_date' 
                            and type='".$type."'                      
                        order by b.id";
        }

        return $this->db->query($query)->result();
    }
}
