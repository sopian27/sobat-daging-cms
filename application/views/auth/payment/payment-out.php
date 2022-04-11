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
                <div class="row">
                    <div class="col-md-5 offset-md-1">
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Nomor Invoice </label>
                            <div class="col-sm-1" style="width:10%">: &nbsp;</div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control-label" id="no_invoice_value" name="no_invoice_value">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-5" id="payment-history">
                            </div>
                        </div>
                        <div class="form-group row" style="margin-top: 10px;">
                            <label for="" class="col-sm-4 col-form-label">Pembelian dari </label>
                            <div class="col-sm-1" style="width:10%">: &nbsp;</div>
                            <div class="col-sm-4">
                                <label for="" id="pembelian_dari"></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Total Tagihan </label>
                            <div class="col-sm-1" style="width:10%">: &nbsp;(Rp)</div>
                            <div class="col-sm-4">
                                <label for="" id="total_tagihan" style="text-align:right;"></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Nominal Pembayaran </label>
                            <div class="col-sm-1" style="width:10%">: &nbsp;(Rp)</div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control-label" id="nominal_pembayaran" name="nominal_pembayaran" style="text-align:right;">
                                <input type="hidden" class="form-control" id="total_tagihan_value" name="total_tagihan_value" placeholder="Rp. 0">
                                <input type="hidden" name="id_trx_payment_po" id="id_trx_payment_po" />
                            </div>
                        </div>
                        <hr style="width: 600px;border-width: 2px;border-style: solid;border-color:white">
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Kekurangan Pembayaran </label>
                            <div class="col-sm-1" style="width:10%">: &nbsp;(Rp)</div>
                            <div class="col-sm-5">
                                <label for="" id="kekurangan_pembayaran" style="text-align:right;"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex offset-md-7" style="margin-top: 20px;">
                    <div class="col-md-2">
                        <button class="form-control-button btn btn-outline-light button-action" onclick="clearAllData();"> Clear All </button>
                    </div>
                    <div class="col-md-2">
                        <button class="form-control-button btn btn-outline-light button-action" onclick="paymentData();"> Confirm </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $("#nominal_pembayaran").autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });

    });

    $("#no_invoice_value").keyup(function(e) {

        if (e.keyCode == 13) {
            e.preventDefault();
            checkData();

        }

    });

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function clearAllData(){
        $("#nominal_pembayaran").val("");
        $("#pembelian_dari").val("");
        $("#no_invoice_value").val("");
        $("#total_tagihan_value").val("");
        $("#id_trx_payment_po").val("");
        $("#total_tagihan").html("");
        $("#kekurangan_pembayaran").html("");        
    }

    function checkData() {

        var no_invoice = $("#no_invoice_value").val();

        $.ajax({
            url: '<?= site_url() ?>/paymentout/getinvoice',
            method: 'post',
            dataType: 'json',
            data: {
                no_invoice: no_invoice
            },
            success: function(data) {

                if (data.length > 0) {

                    if (data[0].total_tagihan == 0) {
                        alert("tidak ada pembayaran tersisa");
                        return;
                    }

                    loadHistoryPayment(no_invoice);

                    $("#pembelian_dari").html(data[0].nama);
                    $("#total_tagihan").html("Rp. " + numberWithCommas(data[0].total_tagihan));
                    $("#total_tagihan_value").val(data[0].total_tagihan);
                    $("#id_trx_payment_po").val(data[0].id_trx_payment);
                } else {

                    $("#payment-history").html("");
                    $("#pembelian_dari").html("");
                    $("#total_tagihan").html("Rp. 0");
                    $("#total_tagihan_value").val("");
                    $("#id_trx_payment_po").val("");

                }

            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });

    }

    $(document).on('keyup', '#nominal_pembayaran', function() {

        var nominal_pembayaran = $("#nominal_pembayaran").autoNumeric('get'); //document.getElementById("nominal_pembayaran").value;
        var total_tagihan = document.getElementById("total_tagihan_value").value;

        if (total_tagihan == null || total_tagihan == "") total_tagihan = 0;
        if (nominal_pembayaran == null || nominal_pembayaran == "") nominal_pembayaran = 0;

        var result = parseFloat(total_tagihan) - parseFloat(nominal_pembayaran);

        if (result < 0) {
            alert("nominal pembayaran melebihi total harga");
            $("#nominal_pembayaran").val("0");
        }

        $("#kekurangan_pembayaran").html("Rp. " + numberWithCommas(result));
    });


    function paymentData() {     

        var no_invoice = $("#no_invoice_value").val();
        if (no_invoice == "") {
            alert("no invoice tidak boleh kosong");
            return;
        }   

        var total_tagihan = $("#total_tagihan_value").val();
        if (total_tagihan == "") {
            alert("total tagihan tidak boleh kosong");
            return;
        }

        var nominal_bayar = $("#nominal_pembayaran").val();
        if (nominal_bayar == "") {
            alert("nominal bayar tidak boleh kosong");
            return;
        }

        if(nominal_bayar.charAt(0)=="0"){
            alert("nominal bayar tidak boleh 0");
            return;
        }

        var no_invoice = $("#no_invoice_value").val();
        var id_trx_payment_out = "<?php echo $kode_po ?>";
        var id_trx_payment_po = $("#id_trx_payment_po").val();

        $.ajax({
            url: '<?= site_url() ?>/paymentout-save',
            data: {
                'id_trx_payment_out' : id_trx_payment_out,
                'no_invoice': no_invoice,
                'id_trx_payment_po' : id_trx_payment_po,
                'nominal_bayar': nominal_bayar,
                'harga_total': total_tagihan
            },
            dataType: 'json',
            method: 'post',
            success: function(response) {

                alert("success insert data");
                location.href = "<?= site_url() ?>/payment-out";
            },
            error: function(xhr, status, error) {
                //var err = eval("(" + xhr.responseText + ")");
                console.log(error);
            }

        });

    }


    function loadHistoryPayment(no_invoice) {

        $.ajax({
            url: '<?= site_url() ?>/paymentout/loadhistory',
            method: 'post',
            dataType: 'json',
            data: {
                no_invoice: no_invoice
            },
            success: function(data) {

                console.log(data);

                var dataload = "";
                dataload += '<a style="color:white;" data-bs-toggle="collapse" ';
                dataload += 'href="#collapseExample">Pembayaran Sebelumnya (-)</a>';

                if (data[0].total_tagihan != 'undefined' || data[0].total_tagihan != null) {

                    for (i = 0; i < data.length; i++) {

                        var sisa = parseFloat(data[i].harga_total) - parseFloat(data[i].nominal_bayar);

                        dataload += '<div class="collapse" id="collapseExample">';
                        dataload += '<hr style="width: 275px;border-width: 2px;border-style: solid;border-color:white">' +
                            '<div style="font-size: 10px;">' +
                            '<div class="form-group row">' +
                            '<label for="" class="col-sm-6 col-form-label">Pembelian Dari </label>' +
                            '<div class="col-sm-1">:</div>' +
                            '<div class="col-sm-4">' +
                            '<label >' + data[i].nama + '</label>' +
                            '</div>' +
                            '</div>';

                        dataload += '<div class="form-group row" >' +
                            '<label for="" class="col-sm-6 col-form-label">Total Tagihan </label>' +
                            '<div class="col-sm-1">:</div>' +
                            '<div class="col-sm-4">' +
                            '<label >Rp. ' + data[i].harga_total + '</label>' +
                            '</div>' +
                            '</div>';

                        dataload += '<div class="form-group row" >' +
                            '<label for="" class="col-sm-6 col-form-label">Nominal Pembayaran </label>' +
                            '<div class="col-sm-1">:</div>' +
                            '<div class="col-sm-5">' +
                            '<label>Rp. ' + data[i].nominal_bayar + '</label>' +
                            '</div>' +
                            '</div>' +
                            '<hr>';

                        dataload += '<div class="form-group row" >' +
                            '<label for="" class="col-sm-6 col-form-label">Kekurangan Pembayaran </label>' +
                            '<div class="col-sm-1">:</div>' +
                            '<div class="col-sm-5">' +
                            '<label >Rp. ' + sisa + '</label>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';

                    }

                    $("#payment-history").html(dataload);
                }
            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });

    }
</script>