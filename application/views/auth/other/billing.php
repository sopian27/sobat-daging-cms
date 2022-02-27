<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <div class="col-md-11">
        <hr style="margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    </div>
    <div class="row">
        <div class="col-md-3 offset-md-1"><?= $kode_po ?></div>
        <div class="col-md-2 offset-md-5 "><?= $date ?></div>
    </div>

    <div class="container-fluid" style="margin-top: 40px;">
        <div class="row justify-content-center offset-md-1">
            <div class="container">
                <form method="post" action="#" id="form-other-income-save" name="form-other-income-save" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-5 offset-md-1">
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">Pemasukkan Dana </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control-label" id="penggunaan_dana" name="penggunaan_dana" placeholder="Rp. 0">
                                    <input type="hidden" class="form-control-label" id="id_trx_ot" name="id_trx_ot" value="<?= $kode_po ?>">
                                </div>
                            </div>
                            <div class="form-group row" style="margin-top: 10px;">
                                <label for="" class="col-sm-4 col-form-label">Keterangan </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control-label" id="keterangan" name="keterangan" placeholder="keterangan...">
                                </div>
                            </div>
                            <div class="form-group row" style="margin-top: 10px;">
                                <label for="" class="col-sm-4 col-form-label">Upload Bukti </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-5">
                                    <input type="file" id="upload_bukti" name="upload_bukti" class="form-control-label">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex offset-md-7" style="margin-top: 20px;">
                        <div class="col-md-2">
                            <button class="form-control-button btn btn-outline-light button-action" onclick="clearAllData();"> Clear All </button>
                        </div>
                        <div class="col-md-2">
                            <button class="form-control-button btn btn-outline-light button-action" onclick="return confirm();"> Confirm </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $("#penggunaan_dana").autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });

    });


    $("#penggunaan_dana").keyup(function(e) {

        var penggunaan_dana = $("#penggunaan_dana").val();
        var saldo_result = penggunaan_dana;
        console.log(saldo_result);
        $("#penggunaan_dana").autoNumeric('set', saldo_result);

    });


    function confirm() {

        var penggunaan_dana = $("#penggunaan_dana").val();
        var keterangan = $("#keterangan").val();

        if (checkInvalid(penggunaan_dana)) {
            alert("penggunaan dana tidak boleh kosong");
            return;
        }

        if (checkInvalid(keterangan)) {
            alert("keterangan tidak boleh kosong");
            return;
        }

        var upload_bukti = document.getElementById("upload_bukti");

        if (upload_bukti.files.length == 0) {
            alert("upload bukti tidak boleh kosong");
            return;
        }

        var upload_bukti_file = upload_bukti.files[0];

        var formData = new FormData();

        formData.append("Filedata", upload_bukti_file);
        var t = upload_bukti_file.type.split('/').pop().toLowerCase();
        if (t != "jpeg" && t != "jpg" && t != "png") {
            alert("upload bukti hanya boleh (jpg,jpeg,png)");
            document.getElementById("upload_bukti").value = '';
            return;
        }
        /*
        if (upload_bukti_file.size > (1024000*10)) {
            alert("Maksimum ukuran file hanya 10MB");
            document.getElementById("upload_bukti").value = '';
            return;
        }*/

        $("#form-other-income-save").attr('action', '<?php echo site_url()?>/other/save');
        $("#form-other-income-save").submit();
    }

    function checkInvalid(val) {
        if (val == null || val == "") {
            return true;
        }

        return false;
    }

    function clearAllData(){
        location.href = "<?= site_url() ?>/other";
    }
</script>