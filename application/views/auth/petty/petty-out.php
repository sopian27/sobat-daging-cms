<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <hr style="width: 1570px;margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    <div class="row">
        <div class="col-md-3 offset-md-1"><?= $kode_po ?></div>
        <div class="col-md-2 offset-md-5"><?= $date ?></div>
    </div>

    <div class="container-fluid" style="margin-top: 40px;">
        <div class="row justify-content-center offset-md-1">
            <div class="container">
                <form method="post" action="<?php echo site_url() ?>/petty-out-save" id="form-petty-out-save" name="form-petty-out-save">
                    <div class="row">
                        <div class="col-md-5 offset-md-1">
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">Saldo Awal (Rp) </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control-label" id="saldo_awal" name="saldo_awal" placeholder="Rp. 0" value="<?= $saldo?> ">
                                    <input type="hidden" class="form-control-label" id="id_trx_petty_cash" name="id_trx_petty_cash" value="<?= $kode_po?> ">
                                </div>
                            </div>
                            <div class="form-group row" style="margin-top: 10px;">
                                <label for="" class="col-sm-4 col-form-label">Penggunaan Saldo (Rp) </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control-label" id="tambahan_saldo" name="tambahan_saldo" placeholder="Rp. 0">
                                </div>
                            </div>
                            <div class="form-group row" style="margin-top: 10px;">
                                <label for="" class="col-sm-4 col-form-label">Keterangan </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-5">
                                    <textarea id="keterangan" name="keterangan" class="form-control-label"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex offset-md-7" style="margin-top: 20px;">
                        <div class="col-md-2">
                            <button class="form-control-button btn btn-outline-light button-action" onclick="clearAllData();"> Clear All </button>
                        </div>
                        <div class="col-md-2">
                            <button class="form-control-button btn btn-outline-light button-action" onclick="confirm();"> Confirm </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $("#saldo_awal").autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });

        $("#tambahan_saldo").autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });
    });


    $("#saldo_awal").keyup(function(e) {

        var saldo_awal = $("#saldo_awal").val();
        var saldo_result = saldo_awal;
        console.log(saldo_result);
        $("#saldo_awal").autoNumeric('set', saldo_result);

    });

    $("#tambahan_saldo").keyup(function(e) {

        var tambahan_saldo = $("#tambahan_saldo").val();
        var saldo_result = tambahan_saldo;
        console.log(saldo_result);
        $("#tambahan_saldo").autoNumeric('set', saldo_result);

    });


    function confirm(){

        var saldo_awal = $("#saldo_awal").val();
        var tambahan_saldo = $("#tambahan_saldo").val();
        var keterangan = $("#keterangan").val();

        if(checkInvalid(saldo_awal)) {
            alert("saldo awal tidak boleh kosong");
            return;
        }

        if(checkInvalid(tambahan_saldo)){
             alert("tambahan_saldo tidak boleh kosong");
             return;
        }

        if(checkInvalid(keterangan)){ 
            alert("keterangan tidak boleh kosong");
            return;
        }

        $("#form-petty-out-save").submit();


    }

    function checkInvalid(val){
        if(val==null || val==""){
            return true;
        }

        return false;
    }


</script>