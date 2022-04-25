<div class="container mt-3">

    <div class="row">
        <div class="col-12">
            <h2><?= ucfirst($judul) ?></h2>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <hr style="border-width: 2px;border-style: solid;border-color:white">
        </div>
    </div>

    <div class="row">
        <div class="col-3"><?= $kode_po; ?></div>
        <div class="col-2 offset-7"><?= $date ?></div>
    </div>

    <div class="row mt-4">
        <div class="col-md-5 offset-md-1">
            <div class="form-group row">
                <label for="" class="col-4 col-md-3 col-lg-4 col-form-label">Nomor Invoice </label>
                <div class="col-8 col-md-3 col-lg-2">: </div>
                <div class="col-12 col-md-6 col-lg-5">
                    <input type="text" class="form-control-label" id="no_invoice_value" name="no_invoice_value">
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-4 col-md-3 col-lg-4 col-form-label"></label>
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="col-5" id="payment-history"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-4 col-md-3 col-lg-4 col-form-label">Nama Pelanggan </label>
                <div class="col-8 col-md-3 col-lg-2">:</div>
                <div class="col-12 col-md-6 col-lg-5">
                    <label for="" id="nama_pelanggan"></label>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-4 col-md-3 col-lg-4 col-form-label">Total Tagihan </label>
                <div class="col-8 col-md-3 col-lg-2">: (Rp)</div>
                <div class="col-12 col-md-6 col-lg-5">
                    <label for="" id="total_tagihan" style="text-align:right;"></label>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-4 col-md-3 col-lg-4 col-form-label">Nominal Pembayaran </label>
                <div class="col-8 col-md-3 col-lg-2">: (Rp)</div>
                <div class="col-12 col-md-6 col-lg-5">
                    <input type="text" class="form-control-label" id="nominal_pembayaran" name="nominal_pembayaran" style="text-align:right;">
                    <input type="hidden" class="form-control" id="total_tagihan_value" name="total_tagihan_value" placeholder="Rp. 0">
                    <input type="hidden" name="id_trx_payment_co" id="id_trx_payment_co" />
                </div>
            </div>
            <hr style="border-width: 2px;border-style: solid;border-color:white">
            <div class="form-group row">
                <label for="" class="col-4 col-md-3 col-lg-4 col-form-label">Kekurangan Pembayaran </label>
                <div class="col-8 col-md-3 col-lg-2">: (Rp)</div>
                <div class="col-12 col-md-6 col-lg-5">
                    <label for="" id="kekurangan_pembayaran" style="text-align:right;"></label>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-4 col-lg-2">
            <button class="form-control-button btn btn-outline-light button-action" onclick="clearAllData();"> Clear All </button>
        </div>
        <div class="col-4 col-lg-2">
            <button class="form-control-button btn btn-outline-light button-action" onclick="paymentData();"> Confirm </button>
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

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function checkData() {

        var no_invoice = $("#no_invoice_value").val();

        $.ajax({
            url: '<?= site_url() ?>/paymentin/getinvoice',
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

                    $("#nama_pelanggan").html(data[0].nama_pelanggan.toUpperCase());
                    $("#total_tagihan").html("Rp. " + numberWithCommas(data[0].total_tagihan));
                    $("#total_tagihan_value").val(data[0].total_tagihan);
                    $("#id_trx_payment_co").val(data[0].id_trx_payment);
                } else {

                    $("#payment-history").html("");
                    $("#nama_pelanggan").html("");
                    $("#total_tagihan").html("Rp. 0");
                    $("#total_tagihan_value").val("");
                    $("#id_trx_payment_co").val("");

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

    function clearAllData() {
        $("#nominal_pembayaran").val("");
        $("#no_invoice_value").val("");
        $("#total_tagihan_value").val("");
        $("#id_trx_payment_co").val("");
        $("#nama_pelanggan").html("");
        $("#total_tagihan").html("");
        $("#kekurangan_pembayaran").html("");
    }


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

        if (nominal_bayar.charAt(0) == "0") {
            alert("nominal bayar tidak boleh 0");
            return;
        }

        var no_invoice = $("#no_invoice_value").val();
        var id_trx_payment_in = "<?php echo $kode_po ?>";
        var id_trx_payment_co = $("#id_trx_payment_co").val();

        $.ajax({
            url: '<?= site_url() ?>/paymentin-save',
            data: {
                'id_trx_payment_in': id_trx_payment_in,
                'no_invoice': no_invoice,
                'id_trx_payment_co': id_trx_payment_co,
                'nominal_bayar': nominal_bayar,
                'harga_total': total_tagihan
            },
            dataType: 'json',
            method: 'post',
            success: function(response) {

                alert("success insert data");
                location.href = "<?= site_url() ?>/payment";
            },
            error: function(xhr, status, error) {
                //var err = eval("(" + xhr.responseText + ")");
                console.log(error);
            }

        });
    }


    function loadHistoryPayment(no_invoice) {

        $.ajax({
            url: '<?= site_url() ?>/paymentin/loadhistory',
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
                        dataload += '<hr style="border-width: 2px;border-style: solid;border-color:white">' +
                            '<div style="font-size: 10px;">' +
                            '<div class="form-group row">' +
                            '<label for="" class="col-6 col-md-3 col-lg-4 col-form-label">Nama Pelanggan </label>' +
                            '<div class="col-1 col-md-3 col-lg-2">: </div>' +
                            '<div class="col-5 col-md-6 col-lg-5">' +
                            '<label >' + data[i].nama_pelanggan.toUpperCase() + '</label>' +
                            '</div>' +
                            '</div>';

                        dataload += '<div class="form-group row" >' +
                            '<label for="" class="col-6 col-md-3 col-lg-4 col-form-label">Total Tagihan </label>' +
                            '<div class="col-1 col-md-3 col-lg-2">: </div>' +
                            '<div class="col-5 col-md-6 col-lg-5">' +
                            '<label >Rp. ' + data[i].harga_total + '</label>' +
                            '</div>' +
                            '</div>';

                        dataload += '<div class="form-group row" >' +
                            '<label for="" class="col-6 col-md-3 col-lg-4 col-form-label">Nominal Pembayaran </label>' +
                            '<div class="col-1 col-md-3 col-lg-2">: </div>' +
                            '<div class="col-5 col-md-6 col-lg-5">' +
                            '<label>Rp. ' + data[i].nominal_bayar + '</label>' +
                            '</div>' +
                            '</div>' +
                            '<hr>';

                        dataload += '<div class="form-group row" >' +
                            '<label for="" class="col-6 col-md-3 col-lg-4 col-form-label">Kekurangan Pembayaran </label>' +
                            '<div class="col-1 col-md-3 col-lg-2">: </div>' +
                            '<div class="col-5 col-md-6 col-lg-5">' +
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

    $("#no_invoice_value").keyup(function(e) {

        if (e.keyCode == 13) {
            e.preventDefault();
            checkData();

        }

    });
</script>