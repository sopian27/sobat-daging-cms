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

<div class="container mt-3">
    <form method="POST" action="<?php echo site_url()?>/sallary-print"  target="_blank">
        <div class="container col-md-8">
            <div class="row justify-content-center" id="form-sallary" style="background-color: #F4F4F4;padding:30px;">
                <div class="container">
                    <div class="row" > 
                        <div class="col-md-12 text-center" style="color:black">
                            <h2>Upah Bulanan</h2>
                            <hr style="border-width: 2px;border-style: solid;border-color:black">
                        </div>                   
                        <div class="col-md-8" style="color:black;margin-top:10px">
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label"> </label>
                            </div>
                            <div class="col-md-6 offset-md-10" >
                                <label class="col-sm-6 offset-md-10"><?=dateForShow($date)?> </label>
                            </div>
                            <div class="form-group row" >
                                <label for="" class="col-sm-4 col-form-label">Nama </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <input type="text" style="border-bottom:none;color:black" class="form-control-label" id="nama_minggu" name="nama" value="<?php echo ucwords($nama) ?>">
                                    <input type="hidden" class="form-control-label" id="type" name="type" value="2">
                                    <input type="hidden" class="form-control-label" id="date" name="date" value="<?php echo date('YmdHis')?>">
                                </div>
                            </div>
                            <div class="form-group row" >
                                <label for="" class="col-sm-4 col-form-label">Upah Bulanan </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <input type="text" style="border-bottom:none;color:black" class="form-control-label" id="upah_bulanan" name="upah_bulanan" value="<?php echo $upah_bulanan ?>">
                                </div>
                            </div>
                            <div class="form-group row" >
                                <label for="" class="col-sm-4 col-form-label">Bulan </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <input type="text" style="border-bottom:none;color:black" class="form-control-label" id="bulan_show" name="bulan_show" value="<?php echo dateForShow($bulan) ?>">
                                    <input type="hidden" style="border-bottom:none;color:black" class="form-control-label" id="bulan" name="bulan" value="<?php echo $bulan ?>">
                                </div>
                            </div>
                            <div class="form-group row" >
                                <label for="" class="col-sm-4 col-form-label">Bonus </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <input type="text" style="border-bottom:none;color:black" class="form-control-label" id="bonus" name="bonus" value="<?php echo "Rp. ".$bonus ?>">
                                </div>
                            </div>
                            <hr style="width: 500px;border-width: 2px;border-style: solid;border-color:black">
                            <div class="form-group row" >
                                <label for="" class="col-sm-4 col-form-label">Total Upah </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <input type="text" style="border-bottom:none;color:black" class="form-control-label" id="total_upah_bulan" name="total_upah" value="<?php echo "Rp. ".$total_upah ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 offset-md-6"  style="color:black;">
                            <label class="col-sm-6 offset-md-5"><?="Jakarta, " . dateForShow($date)?> </label>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 offset-md-9" style="color: black;margin-top:20px">
                                <p style="font-size: 20px;">Sobat Daging</p>
                            </div>
                            <div class="col-sm-3 offset-md-9" style="color: black;margin-top:20px">
                                <p style="font-size: 14px;">( Sobat Daging )</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex offset-md-9" style="margin-top: 20px;">
            <div class="col-md-4">
                <button class="form-control-button btn btn-outline-light button-action" onclick="clearAllData();"> Cancel </button>
            </div>
            <div class="col-md-4">
                <button class="form-control-button btn btn-outline-light button-action" type="submit"> Print </button>
            </div>
        </div>
    </form>
    <div style="margin-top:60px"></div>
</div>

<script>
</script>