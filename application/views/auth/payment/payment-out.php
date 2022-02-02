<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <hr style="width: 1570px;margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
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
                            <div class="col-sm-1">:</div>
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
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-4">
                                <label for="" id="pembelian_dari"></label>
                            </div>
                        </div>
                        <div class="form-group row" >
                            <label for="" class="col-sm-4 col-form-label">Total Tagihan </label>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-4">
                                <label for="" id="total_tagihan">Rp. 0</label>
                            </div>
                        </div>
                        <div class="form-group row" >
                            <label for="" class="col-sm-4 col-form-label">Nominal Pembayaran </label>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control-label" id="nominal_pembayaran" name="nominal_pembayaran">
                                <input type="hidden" class="form-control" id="total_tagihan_value" name="total_tagihan_value" placeholder="Rp. 0">
                            </div>
                        </div>
                        <hr style="width: 600px;border-width: 2px;border-style: solid;border-color:white">
                        <div class="form-group row" >
                            <label for="" class="col-sm-4 col-form-label">Kekurangan Pembayaran </label>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-5">
                                <label for="" id="kekurangan_pembayaran">Rp. 0</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex offset-md-7" style="margin-top: 20px;">
                    <div class="col-md-2">
                        <button class="form-control-button btn btn-outline-light button-action" onclick="clearAllDataCo();"> Clear All </button>
                    </div>
                    <div class="col-md-2">
                        <button class="form-control-button btn btn-outline-light button-action" onclick="paymentData();"> Confirm </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form method="post" action="<?php echo site_url() ?>/paymentout-save" id="form-payment-out-save" name="form-payment-out-save">
        <input type="hidden" name="id_trx_payment_out" id="id_trx_payment_out" value="<?php echo $kode_po ?>" />
        <input type="hidden" name="no_invoice" id="no_invoice" />
        <input type="hidden" name="harga_total" id="harga_total" />
        <input type="hidden" name="nominal_bayar" id="nominal_bayar" />
        <input type="hidden" name="id_trx_payment_po" id="id_trx_payment_po" />
    </form>
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

            //var search = document.getElementById("no_invoice_value").value;
            //$("#data_search").val(search);

            //$("#form-payment-in-search").submit();
            checkData();

        }

    });

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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

        var nominal_pembayaran = document.getElementById("nominal_pembayaran").value;
        var total_tagihan = document.getElementById("total_tagihan_value").value;

        if (total_tagihan == null || total_tagihan == "") total_tagihan = 0;
        if (nominal_pembayaran == null || nominal_pembayaran == "") nominal_pembayaran = 0;

        var result = parseFloat(total_tagihan) - parseFloat(nominal_pembayaran);
        $("#kekurangan_pembayaran").html("Rp. " + numberWithCommas(result));


    });


    function paymentData() {

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


        $("#no_invoice").val($("#no_invoice_value").val());
        $("#harga_total").val($("#total_tagihan_value").val());
        $("#nominal_bayar").val($("#nominal_pembayaran").val());


        $("#form-payment-out-save").submit();
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

                        // console.log(data[i].nama_pelanggan);

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