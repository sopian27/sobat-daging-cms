<?php
class TRXPettyInModel extends CI_Model
{

    public function insertData($data)
    {
        $this->db->insert('trx_petty_in', $data);
        return $this->db->insert_id();
    }

    public function initSaldo($data)
    {
        $this->db->insert('petty_cash', $data);
        return $this->db->insert_id();
    }

    public function getTrxId($tgl_trx)
    {

        $query = " select max(id_trx_petty_cash) as trx_id from trx_petty_in where date_format(create_date,'%Y-%m-%d') = '$tgl_trx'";

        return $this->db->query($query)->result();
    }

    public function getSaldo()
    {

        $query = " select saldo from petty_cash";

        return $this->db->query($query)->result();
    }

    public function getSaldoByDate($data)
    {

        $date = $data['create_date'];
        $keyword = $data['keyword'];
        $query = "";

        if ($keyword != ""  && $date == "...") {

            $query = "  SELECT sum(tambahan_saldo) as total,substring(create_date,6,2) as date
                        FROM trx_petty_in 
                        WHERE keterangan like '%$keyword%' group by substring(create_date,6,2)";

        } else if ($keyword != "" && $date != "...") {

            $query = "  SELECT sum(tambahan_saldo) as total,substring(create_date,6,2) as date
                        FROM trx_petty_in 
                        WHERE keterangan like '%$keyword%' and date_format(create_date,'%Y')= '$date' group by substring(create_date,6,2)";

        } else {

            $query = "  SELECT sum(tambahan_saldo) as total,substring(create_date,6,2) as date
                            FROM trx_petty_in 
                            WHERE date_format(create_date,'%Y')= '$date' group by substring(create_date,6,2)";
        }

        return $this->db->query($query)->result();
    }

    public function getSaldoByDateDetail($data)
    {

        $date = $data['create_date'];
        $keyword = $data['keyword'];
        $query = "";

        if ($keyword != ""  && $date == "...") {

            $query = "  SELECT sum(tambahan_saldo) as total,substring(create_date,6,2) as date
                        FROM trx_petty_in 
                        WHERE keterangan like '%$keyword%' group by substring(create_date,6,2)";

        } else if ($keyword != "" && $date != "...") {

            $query = "  SELECT sum(tambahan_saldo) as total,substring(create_date,6,2) as date
                        FROM trx_petty_in 
                        WHERE keterangan like '%$keyword%' and date_format(create_date,'%Y%m')= '$date' group by substring(create_date,6,2)";

        } else {

            $query = "  SELECT sum(tambahan_saldo) as total,substring(create_date,6,2) as date
                            FROM trx_petty_in 
                            WHERE date_format(create_date,'%Y%m')= '$date' group by substring(create_date,6,2)";
        }

        return $this->db->query($query)->result();
    }

    public function getSaldoByCurrentDate()
    {

        $query = " SELECT sum(tambahan_saldo) as total,substring(create_date,6,2) as date
                   FROM trx_petty_in 
                   WHERE substring(create_date,1,4) =DATE_FORMAT(SYSDATE(), '%Y') group by substring(create_date,6,2)";

        return $this->db->query($query)->result();
    }

    public function getDataByDate($data)
    {
        $date = $data['create_date'];
        $query = " SELECT id_trx_petty_cash as kode,tambahan_saldo,keterangan 
                   FROM trx_petty_in 
                   WHERE date_format(create_date,'%Y%m')= '$date'";

        return $this->db->query($query)->result();
    }

    public function getData($create_date, $keyword, $halaman, $batasTampilData)
    {

        $query = "";

        if (isset($keyword) && $keyword != "") {

            $query = "  SELECT 
                            *
                        from 
                            trx_petty_in b
                        where 
                            keterangan= '" . $keyword . "' 
                        order by b.id
                            limit " . $halaman . "," . $batasTampilData;
        } else {

            $query = "  SELECT 
                            *
                        from 
                            trx_petty_in b
                        where 
                            date_format(create_date,'%Y%m')= '".$create_date."'                          
                        order by b.id
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
                            trx_petty_in b
                        where 
                            keterangan= '" . $keyword . "' 
                        order by b.id";
        } else {

            $query = "  SELECT 
                            *
                        from 
                            trx_petty_in b
                        where 
                            date_format(create_date,'%Y%m')= '".$create_date."'                         
                        order by b.id";
        }

        return $this->db->query($query)->result();
    }
}
