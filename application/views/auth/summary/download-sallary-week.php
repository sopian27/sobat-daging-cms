<?php

function dateForShow($create_date)
{
    $year = substr($create_date, 0, 4);
    $month = substr($create_date, 4, 2);
    $day = substr($create_date, 6, 2);

    if ($month == "01") {
        $month = "Januari";
    } else if ($month == "02") {
        $month = "Februari";
    } else if ($month == "03") {
        $month = "Maret";
    } else if ($month == "04") {
        $month = "April";
    } else if ($month == "05") {
        $month = "Mei";
    } else if ($month == "06") {
        $month = "Juni";
    } else if ($month == "07") {
        $month = "Juli";
    } else if ($month == "08") {
        $month = "Agustus";
    } else if ($month == "09") {
        $month = "September";
    } else if ($month == "10") {
        $month = "Oktober";
    } else if ($month == "11") {
        $month = "November";
    } else if ($month == "12") {
        $month = "Desember";
    }

    return $day . " " . $month . " " . $year;
}

?>

<style>
th, td {
  padding: 5px;
}
th {
  text-align: left;
}

</style>


<div class="container mt-3">
    <div class="container col-md-8">
        <div class="row justify-content-center" id="form-sallary" style="padding:30px;">
            <div class="container">
                <div class="row" > 
                    <div class="col-md-12 text-center" style="color:black;text-align:center">
                        <h2>Upah Mingguan</h2>
                        <hr style="border-width: 2px;border-style: solid;border-color:black">
                    </div>                   
                    <div class="col-md-8" style="color:black;margin-top:10px">
                        <div style="text-align:right">
                            <label ><?=dateForShow($date)?> </label>
                        </div>
                        <table>
                            <tr>
                                <th>Nama</th>
                                <th>:</th>
                                <th><?= $nama?></th>
                            </tr>
                            <tr>
                                <th>Jumlah Hari Kerja</th>
                                <th>:</th>
                                <th><?= $jml_hari_kerja?></th>
                            </tr>
                            <tr>
                                <th>Upah Harian</th>
                                <th>:</th>
                                <th><?= $upah_harian?></th>
                            </tr>
                            <tr>
                                <th>Upah Lembur</th>
                                <th>:</th>
                                <th><?= $upah_lembur?></th>
                            </tr>
                            <tr>
                                <th>Upah Lembur</th>
                                <th>:</th>
                                <th><?= $upah_lembur?></th>
                            </tr>
                        </table>
                        <hr style="width:50%;margin-left:0px"> 
                        <table>                            
                            <tr>
                                <th>Total Upah</th>
                                <th>:</th>
                                <th></th>
                                <th><?= $total_upah?></th>
                            </tr>
                        </table>                        
                    </div>
                    <div style="color:black;text-align:center;margin-top:30px;margin-left:60%">
                        <label class="col-sm-6 offset-md-5"><?="Jakarta, " . dateForShow($date)?> </label>
                    </div>
                    <div class="row" style="color:black;text-align:center;margin-left:60%">
                        <div style="color: black;margin-top:20px">
                            <p style="font-size: 20px;">Sobat Daging</p>
                        </div>
                        <div style="color: black;margin-top:20px">
                            <p style="font-size: 14px;">( Sobat Daging )</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>