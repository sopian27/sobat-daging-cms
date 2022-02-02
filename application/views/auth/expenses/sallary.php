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


<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <hr style="width: 1570px;margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    <div class="row">
        <div class="col-md-3 offset-md-9 "><?= $date ?></div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center" id="form-sallary">
            <div class="container">
                <form method="post" name="form-sallary-data" id="form-sallary-data">
                    <div class="row">
                        <div class="col-md-2 offset-md-1">
                            <div>
                                <a class="form-control-button btn" style="background-color: #a5662f;border:none;padding:10px"> Mingguan </a>
                            </div>
                            <div style="margin-top:30px">
                                <a class="form-control-button btn btn-outline-light button-action" style="padding:10px" onclick="showSallaryBulanan();"> Bulanan </a>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label"> </label>
                            </div>
                            <div class="form-group row" style="margin-top:30px">
                                <label for="" class="col-sm-3 col-form-label">Nama </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control-label" id="nama_minggu" name="nama">
                                    <input type="hidden" class="form-control-label" id="type" name="type" value="1">
                                </div>
                            </div>
                            <div class="form-group row" >
                                <label for="" class="col-sm-3 col-form-label">Jumlah Hari Kerja </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control-label" id="jml_hari_kerja" name="jml_hari_kerja">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Upah Harian </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control-label" id="upah_harian" name="upah_harian">
                                </div>
                            </div>
                            <div class="form-group row" >
                                <label for="" class="col-sm-3 col-form-label">Upah Lembur </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control-label" id="upah_lembur" name="upah_lembur">
                                </div>
                            </div>
                            <hr style="width: 500px;border-width: 2px;border-style: solid;border-color:white">
                            <div class="form-group row" >
                                <label for="" class="col-sm-3 col-form-label">Total Upah </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control-label" id="total_upah_minggu" name="total_upah">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex offset-md-7" style="margin-top: 20px;">
                        <div class="col-md-2">
                            <button class="form-control-button btn btn-outline-light button-action" onclick="clearAllData();"> Clear All </button>
                        </div>
                        <div class="col-md-2">
                            <button class="form-control-button btn btn-outline-light button-action" onclick="confirmMinggu();"> Confirm </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row justify-content-center" style="display: none;" id="form-invoice-pembelian">
            <div class="container">
                <form method="post" name="form-sallary-data-month" id="form-sallary-data-month">
                    <div class="row">
                        <div class="col-md-2 offset-md-1">
                            <div>
                                <a class="form-control-button btn btn-outline-light button-action" onclick="showSallaryMingguan();"> Mingguan </a>
                            </div>
                            <div style="margin-top:30px">
                                <a class="form-control-button btn" style="background-color: #a5662f;border:none;padding:10px"> Bulanan </a>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label"> </label>
                            </div>
                            <div class="form-group row" style="margin-top:30px">
                                <label for="" class="col-sm-3 col-form-label">Nama </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control-label" id="nama_bulan" name="nama">
                                    <input type="hidden" class="form-control-label" id="type" name="type" value="2">
                                </div>
                            </div>
                            <div class="form-group row" >
                                <label for="" class="col-sm-3 col-form-label">Upah Bulanan </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control-label" id="upah_bulanan" name="upah_bulanan">
                                </div>
                            </div>
                            <div class="form-group row" >
                                <label for="" class="col-sm-3 col-form-label">Bulanan </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control-label" id="bulan" name="bulan">
                                </div>
                            </div>
                            <div class="form-group row" >
                                <label for="" class="col-sm-3 col-form-label">Bonus </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control-label" id="bonus" name="bonus">
                                </div>
                            </div>
                            <hr style="width: 500px;border-width: 2px;border-style: solid;border-color:white">
                            <div class="form-group row" >
                                <label for="" class="col-sm-3 col-form-label">Total Upah </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control-label" id="total_upah_bulan" name="total_upah">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex offset-md-7" style="margin-top: 20px;">
                        <div class="col-md-2">
                            <button class="form-control-button btn btn-outline-light button-action" onclick="clearAllData();"> Clear All </button>
                        </div>
                        <div class="col-md-2">
                            <button class="form-control-button btn btn-outline-light button-action" onclick="confirmBulan();"> Confirm </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div style="margin-top:60px"></div>
</div>

<script>
    $(document).ready(function() {

        $("#upah_harian").autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });

        $("#upah_bulanan").autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });

        $("#bonus").autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });

        $("#upah_lembur").autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });

        $("#total_upah_minggu").autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });

        $("#total_upah_bulan").autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });

        $("#jml_hari_kerja").autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });

    });

    function showSallaryBulanan() {
        $("#form-sallary").hide();
        $("#form-invoice-pembelian").show();
    }

    function showSallaryMingguan() {
        $("#form-sallary").show();
        $("#form-invoice-pembelian").hide();
    }

    function confirm() {
        $("#form-sallary-data").attr('action', '<?php echo site_url() ?>/sallary/save');
        $("#form-sallary-data").submit();
    }



    $("#jml_hari_kerja").keyup(function(e) {

        var upah_harian = $("#upah_harian").autoNumeric('get');
        var jml_hari_kerja = $("#jml_hari_kerja").autoNumeric('get');
        $("#jml_hari_kerja").autoNumeric('set', jml_hari_kerja);

        var upah_lembur = $("#upah_lembur").autoNumeric('get');

        if (upah_lembur == null || upah_lembur == "") {
            upah_lembur = 0;
        }

        if (upah_harian == null || upah_harian == "") {
            upah_harian = 0;
        }

        $("#total_upah_minggu").autoNumeric('set', parseFloat(upah_lembur) + (parseFloat(upah_harian) * jml_hari_kerja));

    });

    $("#upah_harian").keyup(function(e) {

        var upah_harian = $("#upah_harian").autoNumeric('get');
        var jml_hari_kerja = $("#jml_hari_kerja").autoNumeric('get');
        $("#upah_harian").autoNumeric('set', upah_harian);

        var upah_lembur = $("#upah_lembur").autoNumeric('get');

        if (upah_lembur == null || upah_lembur == "") {
            upah_lembur = 0;
        }

        if (upah_harian == null || upah_harian == "") {
            upah_harian = 0;
        }

        $("#total_upah_minggu").autoNumeric('set', parseFloat(upah_lembur) + (parseFloat(upah_harian) * jml_hari_kerja));

    });

    $("#upah_lembur").keyup(function(e) {

        var upah_lembur = $("#upah_lembur").autoNumeric('get');
        var jml_hari_kerja = $("#jml_hari_kerja").autoNumeric('get');
        $("#upah_lembur").autoNumeric('set', upah_lembur);

        var upah_harian = $("#upah_harian").autoNumeric('get');

        if (upah_harian == null || upah_harian == "") {
            upah_harian = 0;
        }

        if (upah_harian == null || upah_harian == "") {
            upah_harian = 0;
        }

        $("#total_upah_minggu").autoNumeric('set', parseFloat(upah_lembur) + (parseFloat(upah_harian) * jml_hari_kerja));

    });



    $("#upah_bulanan").keyup(function(e) {

        var upah_bulanan = $("#upah_bulanan").autoNumeric('get');
        var bonus = $("#bonus").autoNumeric('get');

        $("#upah_bulanan").autoNumeric('set', upah_bulanan);

        if (upah_bulanan == null || upah_bulanan == "") {
            upah_bulanan = 0;
        }

        if (bonus == null || bonus == "") {
            bonus = 0;
        }

        $("#total_upah_bulan").autoNumeric('set', parseFloat(upah_bulanan) + parseFloat(bonus));

    });

    $("#bonus").keyup(function(e) {

        var upah_bulanan = $("#upah_bulanan").autoNumeric('get');
        var bonus = $("#bonus").autoNumeric('get');

        $("#upah_bulanan").autoNumeric('set', upah_bulanan);

        if (upah_bulanan == null || upah_bulanan == "") {
            upah_bulanan = 0;
        }

        if (bonus == null || bonus == "") {
            bonus = 0;
        }

        $("#total_upah_bulan").autoNumeric('set', parseFloat(upah_bulanan) + parseFloat(bonus));

    });

    $(function() {
        $("#bulan").datepicker({
            todayHighlight: true,
            format: "yyyymm",
            startView: "months",
            minViewMode: "months",
            autoclose: true
        })
    });

    function checkInvalid(val) {
        if (val == null || val == "") {
            return true;
        }

        return false;
    }


    function confirmMinggu() {

        var nama = $("#nama_minggu").val();
        var jml_hari_kerja = $("#jml_hari_kerja").val();
        var upah_harian = $("#upah_harian").val();
        var upah_lembur = $("#upah_lembur").val();

        if (checkInvalid(nama)) {
            alert("nama tidak boleh kosong");
            return;
        }

        if (checkInvalid(jml_hari_kerja)) {
            alert("jumlah hari kerja tidak boleh kosong");
            return;
        }

        if (checkInvalid(upah_harian)) {
            alert("upah harian tidak boleh kosong");
            return;
        }

        if (checkInvalid(upah_lembur)) {
            alert("upah lembur tidak boleh kosong");
            return;
        }


        confirm();

    }

    function confirmBulan() {

        var nama = $("#nama_bulan").val();
        var upah_bulanan = $("#upah_bulanan").val();
        var bulan = $("#bulan").val();
        var bonus = $("#bonus").val();

        if (checkInvalid(nama)) {
            alert("nama tidak boleh kosong");
            return;
        }

        if (checkInvalid(upah_bulanan)) {
            alert("upah bulanan tidak boleh kosong");
            return;
        }

        if (checkInvalid(bulan)) {
            alert("bulan tidak boleh kosong");
            return;
        }

        if (checkInvalid(bonus)) {
            alert("bonus tidak boleh kosong");
            return;
        }
        
        $("#form-sallary-data-month").attr('action', '<?php echo site_url() ?>/sallary/save');
        $("#form-sallary-data-month").submit();
    }

</script>