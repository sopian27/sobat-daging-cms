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
        <div class="col-2 offset-10"><?= $date ?></div>
    </div>

    <div class="row mt-5 justify-content-center" id="form-invoice-customer">
        <div class="row">
            <div class="col-12 col-md-3 col-lg-2">
                <div>
                    <a class="form-control-button btn" style="background-color: #B89874;border:none;padding:10px"> Invoice Costumer </a>
                </div>
                <div class="mt-3">
                    <a class="form-control-button btn btn-outline-light button-action" style="padding:10px" onclick="showInvoicePembelian();"> Invoice Pembelian </a>
                </div>
                <div class="mt-3">
                    <p id="info-co"></p>
                </div>
            </div>

            <div class="col-12 col-md-8 offset-md-1 col-lg-6">
                <div class="form-group row">
                    <label for="" class="col-5 col-md-6 col-form-label"><?= $no_invoice_co ?></label>
                </div>
                <div class="form-group row">
                    <label for="" class="col-6 col-md-3 col-lg-4 col-form-label">Nomor Surat Jalan </label>
                    <div class="col-1 col-md-3 col-lg-2">: </div>
                    <div class="col-5 col-md-6 col-lg-5">
                        <input type="text" class="form-control-label" id="no_surat_jalan" name="no_surat_jalan">
                        <input type="hidden" class="form-control" id="no_invoice_co" name="no_invoice_co">
                        <input type="hidden" class="form-control" id="id_trx_payment_value" name="id_trx_payment" value="<?php echo $no_invoice_co ?>">
                        <input type="hidden" class="form-control" id="total_tagihan_value" name="total_tagihan">
                    </div>
                </div>

                <div class="div_no_surat_jln" style="display:none">
                    <hr style="border-width: 2px;border-style: solid;border-color:white">
                    <div class="form-group row">
                        <label for="" class="col-6 col-md-3 col-lg-4 col-form-label">Nomor Invoice </label>
                        <div class="col-1 col-md-3 col-lg-2">: </div>
                        <div class="col-5 col-md-6 col-lg-5">
                            <label for="" class="col-form-label" id="nomor_invoice"></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-6 col-md-3 col-lg-4 col-form-label">Nama Pelanggan </label>
                        <div class="col-1 col-md-3 col-lg-2">: </div>
                        <div class="col-5 col-md-6 col-lg-5">
                            <label for="" class="col-form-label" id="nama_pelanggan"></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-6 col-md-3 col-lg-4 col-form-label">Nomor Hp </label>
                        <div class="col-1 col-md-3 col-lg-2">: </div>
                        <div class="col-5 col-md-6 col-lg-5">
                            <label for="" class="col-form-label" id="no_hp"></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-6 col-md-3 col-lg-4 col-form-label">Alamat Pengiriman </label>
                        <div class="col-1 col-md-3 col-lg-2">: </div>
                        <div class="col-5 col-md-6 col-lg-5">
                            <label for="" class="col-form-label" id="alamat_pengiriman"></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-6 col-md-3 col-lg-4 col-form-label">Tanggal Pengiriman </label>
                        <div class="col-1 col-md-3 col-lg-2">: </div>
                        <div class="col-5 col-md-6 col-lg-5">
                            <label for="" class="col-form-label" id="tgl_pengiriman"></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-6 col-md-3 col-lg-4 col-form-label">Total Tagihan </label>
                        <div class="col-1 col-md-3 col-lg-2">: </div>
                        <div class="col-5 col-md-6 col-lg-5">
                            <label for="" class="col-form-label" id="total_tagihan"></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-6 col-md-3 col-lg-4 col-form-label">diskon </label>
                        <div class="col-1 col-md-3 col-lg-2">: </div>
                        <div class="col-4 col-md-6 col-lg-5">
                            <input type="text" name="bonus" id="bonus" class="form-control-label">
                        </div>
                        <div class="col-1"><span class="fa fa-pencil"><span></div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-6 col-md-3 col-lg-4 col-form-label">Jatuh Tempo </label>
                        <div class="col-1 col-md-3 col-lg-2">: </div>
                        <div class="col-4 col-md-6 col-lg-5">
                            <input type="text" name="jatuh_tempo" id="jatuh_tempo_no_surat_jln" class="form-control-label" style="color:red">
                        </div>
                        <div class="col-sm-1"><span class="fa fa-pencil"><span></div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-6 col-md-3 col-lg-4 col-form-label">Bank Tujuan </label>
                        <div class="col-1 col-md-3 col-lg-2">: </div>
                        <div class="col-4 col-md-6 col-lg-5">
                            <input type="text" name="bank_tujuan" id="bank_tujuan" class="form-control-label" />
                        </div>
                        <div class="col-1"><span class="fa fa-pencil"><span></div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-6 col-md-3 col-lg-4 col-form-label">No. Rekening </label>
                        <div class="col-1 col-md-3 col-lg-2">: </div>
                        <div class="col-4 col-md-6 col-lg-5">
                            <input type="text" name="no_rekening" id="no_rekening" class="form-control-label" onkeypress="validate(event)" />
                        </div>
                        <div class="col-1"><span class="fa fa-pencil"><span></div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-6 col-md-3 col-lg-4 col-form-label">Atas Nama </label>
                        <div class="col-1 col-md-3 col-lg-2">: </div>
                        <div class="col-4 col-md-6 col-lg-5">
                            <input type="text" name="atas_nama" id="atas_nama" class="form-control-label" />
                        </div>
                        <div class="col-1"><span class="fa fa-pencil"><span></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="div_no_surat_jln" style="display:none">
            <div class="row mt-5">
                <div class="col-12 col-md-7 offset-md-2 justify-content-center">
                    <div class="row mt-2 ">
                        <table class="table table-dark table-bordered data table-responsive" id="tableInv">
                            <thead>
                                <tr class="align-middle">
                                    <th rowspan="2"> Kode </th>
                                    <th rowspan="2"> Nama Barang </th>
                                    <th rowspan="2"> Nama Bahan </th>
                                    <th rowspan="1" colspan="2"> Quantity</th>
                                    <th rowspan="2"> Harga Satuan </th>
                                    <th rowspan="2"> Harga Total </th>
                                </tr>
                                <tr>
                                    <th> Quantity / Kg </th>
                                    <th> Pcs / Bungkus </th>
                                </tr>
                            </thead>
                            <tbody id='tbody-table-data-no_surat_jln'></tbody>
                        </table>
                        <input type="hidden" name="halaman_paging_co" id="halaman_paging_co" value="1">
                        <div class="row">
                            <div class="pagination-result-co offset-7"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center mt-5">
                <div class="col-4 col-lg-2">
                    <button class="form-control-button btn btn-outline-light button-action" onclick="clearAllCo();"> Clear All </button>
                </div>
                <div class="col-4 col-lg-2">
                    <button class="form-control-button btn btn-outline-light button-action" onclick="return confirmDataCo();"> Confirm </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5 justify-content-center" style="display: none;" id="form-invoice-pembelian">
        <div class="row">
            <div class="col-12 col-md-3 col-lg-2">
                <div>
                    <a class="form-control-button btn btn-outline-light button-action" onclick="showInvoiceCustomer();"> Invoice Costumer </a>
                </div>
                <div class="mt-3">
                    <a class="form-control-button btn" style="background-color: #B89874;border:none;padding:10px"> Invoice Pembelian </a>
                </div>
                <div class="mt-3">
                    <p id="info-po"></p>
                </div>
            </div>
            <div class="col-12 col-md-8 offset-md-1 col-lg-6">
                <div class="form-group row">
                    <label for="" class="col-5 col-md-6 col-form-label"><?= $no_invoice_co_po ?> </label>
                </div>
                <div class="form-group row">
                    <label for="" class="col-6 col-md-3 col-lg-4 col-form-label">Kode Po </label>
                    <div class="col-1 col-md-3 col-lg-2">: </div>
                    <div class="col-5 col-md-6 col-lg-5">
                        <input type="text" class="form-control-label" id="kode_po" name="kode_po">
                        <input type="hidden" class="form-control" id="no_invoice_co_po" name="no_invoice_co_po" value="<?= $no_invoice_co_po ?>">
                        <input type="hidden" class="form-control" id="total_tagihan_value_po" name="total_tagihan">
                        <input type="hidden" class="form-control" id="no_invoice_kode_po" name="no_invoice">
                    </div>
                </div>
                <div class="div_kode_po" style="display:none">
                    <hr style="border-width: 2px;border-style: solid;border-color:white">
                    <div class="form-group row">
                        <label for="" class="col-6 col-md-3 col-lg-4 col-form-label">Pembelian dari </label>
                        <div class="col-1 col-md-3 col-lg-2">: </div>
                        <div class="col-4 col-md-6 col-lg-5">
                            <label for="" class=" col-form-label" id="pembelian_dari"></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-6 col-md-3 col-lg-4 col-form-label">Pic </label>
                        <div class="col-1 col-md-3 col-lg-2">: </div>
                        <div class="col-4 col-md-6 col-lg-5">
                            <label for="" class=" col-form-label" id="pic"></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-6 col-md-3 col-lg-4 col-form-label">Nomor Hp </label>
                        <div class="col-1 col-md-3 col-lg-2">: </div>
                        <div class="col-4 col-md-6 col-lg-5">
                            <label for="" class=" col-form-label" id="no_hp_po"></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-6 col-md-3 col-lg-4 col-form-label">Tanggal Pembelian </label>
                        <div class="col-1 col-md-3 col-lg-2">: </div>
                        <div class="col-4 col-md-6 col-lg-5">
                            <label for="" class=" col-form-label" id="tgl_pembelian"> </label>
                        </div>
                    </div>
                    <div class="form-group row" style="margin-top:10px">
                        <label for="" class="col-6 col-md-3 col-lg-4 col-form-label">Jatuh Tempo </label>
                        <div class="col-1 col-md-3 col-lg-2">: </div>
                        <div class="col-4 col-md-6 col-lg-5">
                            <input type="text" name="jatuh_tempo" id="jatuh_tempo_kode_po" class="form-control-label" style="color:red">
                        </div>
                        <div class="col-1"><span class="fa fa-pencil"><span></div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-6 col-md-3 col-lg-4 col-form-label">Total Tagihan </label>
                        <div class="col-1 col-md-3 col-lg-2">: </div>
                        <div class="col-4 col-md-6 col-lg-5">
                            <label for="" class=" col-form-label" id="total_tagihan_kode_po"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="div_kode_po" style="display:none">
            <div class="row mt-5">
                <div class="col-12 col-md-7 offset-md-2 justify-content-center">
                    <div class="row mt-2 ">
                        <table class="table table-dark table-bordered data table-responsive" id="tableInv">
                            <thead>
                                <tr class="align-middle">
                                    <th rowspan="2"> Kode </th>
                                    <th rowspan="2"> Nama Barang </th>
                                    <th rowspan="1" colspan="2"> Quantity</th>
                                    <th rowspan="2"> Harga Satuan </th>
                                    <th rowspan="2"> Harga Total </th>
                                </tr>
                                <tr>
                                    <th> Quantity / Po </th>
                                    <th> Quantity / Update </th>
                                </tr>
                            </thead>
                            <tbody id='tbody-table-data_kode_po'></tbody>
                        </table>
                        <input type="hidden" name="halaman_paging_po" id="halaman_paging_po" value="1">
                        <div class="row">
                            <div class="pagination-result-po offset-7"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center mt-5">
                <div class="col-4 col-lg-2">
                    <button class="form-control-button btn btn-outline-light button-action" onclick="clearAllPo();"> Clear All </button>
                </div>
                <div class="col-4 col-lg-2">
                    <button class="form-control-button btn btn-outline-light button-action" onclick="confirmDataPo();"> Confirm </button>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top:60px"></div>
</div>

<script>
    $(document).ready(function() {

        $("#nominal_pembayaran").autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });

        $("#bonus").autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });

    });

    function validate(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
            // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault) theEvent.preventDefault();
        }
    }

    function clearAllCo() {
        $("#bonus").val("");
        $("#jatuh_tempo_no_surat_jln").val("");
        $("#bank_tujuan").val("");
        $("#no_rekening").val("");
        $("#atas_nama").val("");

    }

    function clearAllPo() {
        $("#jatuh_tempo_kode_po").val("");
    }



    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function hideDataSuratJln() {
        $(".div_no_surat_jln").hide();
    }

    function hideDataKodePo() {
        $(".div_kode_po").hide();
    }

    function showDataSuratJln() {
        $(".div_no_surat_jln").show();
    }

    function showDataKodePo() {
        $(".div_kode_po").show();
    }

    function showInvoicePembelian() {
        $("#form-invoice-customer").hide();
        $("#form-invoice-pembelian").show();
    }

    function showInvoiceCustomer() {
        $("#form-invoice-customer").show();
        $("#form-invoice-pembelian").hide();
    }

    function confirmDataPo() {

        var jatuh_tempo = $("#jatuh_tempo_kode_po").val();
        var no_invoice_co_po = $("#no_invoice_co_po").val();
        var kode_po = $("#kode_po").val();
        var no_invoice = $("#no_invoice_kode_po").val();
        var total_tagihan = $("#total_tagihan_value_po").val();

        if (checkInvalid(jatuh_tempo)) {
            alert("jatuh tempo tidak boleh kosong");
            return false;
        }

        $.ajax({
            url: '<?= site_url() ?>/payment-invoice-pembelian/save',
            data: {
                'jatuh_tempo': jatuh_tempo.replaceAll("-", ""),
                'no_invoice_co_po': no_invoice_co_po,
                'kode_po': kode_po,
                'no_invoice': no_invoice,
                'total_tagihan': total_tagihan
            },
            dataType: 'json',
            method: 'post',
            success: function(response) {

                alert("success insert data");
                location.href = "<?= site_url() ?>/payment-invoice";
            },
            error: function(xhr, status, error) {
                //var err = eval("(" + xhr.responseText + ")");
                console.log(error);
            }

        });
    }

    function confirmDataCo() {

        var bonus = $("#bonus").val();
        var jatuh_tempo = $("#jatuh_tempo_no_surat_jln").val();
        var bank_tujuan = $("#bank_tujuan").val();
        var no_rekening = $("#no_rekening").val();
        var atas_nama = $("#atas_nama").val();
        var total_tagihan = $("#total_tagihan_value").val();
        var id_trx_payment = "<?php echo $no_invoice_co ?>";
        var no_surat_jalan = $("#no_surat_jalan").val();

        if (checkInvalid(bonus)) {
            alert("diskon tidak boleh kosong");
            return false;
        }

        if (checkInvalid(jatuh_tempo)) {
            alert("jatuh tempo tidak boleh kosong");
            return false;
        }

        if (checkInvalid(bank_tujuan)) {
            alert("bank tujuan tidak boleh kosong");
            return false;
        }

        if (checkInvalid(no_rekening)) {
            alert("no rekening tidak boleh kosong");
            return false;
        }

        if (checkInvalid(atas_nama)) {
            alert("atas nama tidak boleh kosong");
            return false;
        }

        total_tagihan = parseFloat(total_tagihan) - parseFloat(bonus.replaceAll(",", ""));

        $.ajax({
            url: '<?= site_url() ?>/payment-invoice-customer/isConfirmed',
            method: 'post',
            dataType: 'json',
            async: false,
            data: {
                'no_surat_jalan': no_surat_jalan
            },
            success: function(response) {

                if (response.length == 0) {

                    $.ajax({
                        url: '<?= site_url() ?>/payment-invoice-customer/save',
                        data: {
                            'bonus': bonus,
                            'jatuh_tempo': jatuh_tempo.replaceAll("-", ""),
                            'no_rekening': no_rekening,
                            'atas_nama': atas_nama,
                            'total_tagihan': total_tagihan,
                            'id_trx_payment': id_trx_payment,
                            'no_surat_jalan': no_surat_jalan,
                            'bank_tujuan': bank_tujuan
                        },
                        dataType: 'json',
                        method: 'post',
                        success: function(response) {

                            alert("success insert data");
                            var id_trx_encrypt = no_surat_jalan.replace(/\//g, "_");
                            location.href = "<?= site_url() ?>/payment-history/print-directly/" + id_trx_encrypt;

                        },
                        error: function(xhr, status, error) {
                            //var err = eval("(" + xhr.responseText + ")");
                            console.log(error);
                        }

                    });

                } else {

                    location.href = "<?= site_url() ?>/payment-invoice";

                }


            },
            error: function(response) {
                console.log(response);
            }
        });
    }

    function checkInvalid(val) {
        if (val == null || val == "") {
            return true;
        }

        return false;
    }

    $(function() {

        const today = new Date();
        var dateObj = new Date();
        dateObj.setDate(today.getDate() + 7);
        var month = dateObj.getUTCMonth() + 1; //months from 1-12
        var day = dateObj.getUTCDate();
        var year = dateObj.getUTCFullYear();
        var newdate = year + "-" + month + "-" + day;

        $("#jatuh_tempo_no_surat_jln").datepicker({
            format: "yyyy-mm-dd",
            todayHighlight: true,
            autoclose: true
        });

        $('#jatuh_tempo_no_surat_jln').datepicker('setDate', newdate);

        $("#jatuh_tempo_kode_po").datepicker({
            format: "yyyy-mm-dd",
            todayHighlight: true,
            autoclose: true
        });

        $('#jatuh_tempo_kode_po').datepicker('setDate', newdate);
    });

    $("#no_surat_jalan").keydown(function(e) {

        if (e.keyCode == 13) {
            e.preventDefault();

            var batasTampilData = 10;
            var halaman = $('#halaman_paging_co').val();
            var keyword = $("#no_surat_jalan").val();

            getNoSuratJalan(keyword, batasTampilData, halaman);

        }
    });

    $("#kode_po").keydown(function(e) {

        if (e.keyCode == 13) {
            e.preventDefault();

            var batasTampilData = 10;
            var halaman = $('#halaman_paging_po').val();
            var keyword = $("#kode_po").val();

            getKodePo(keyword, batasTampilData, halaman);
        }
    });

    function getNoSuratJalan(keyword, batasTampilData, halaman) {

        var no_surat_jalan = keyword;

        $.ajax({
            url: '<?= site_url() ?>/payment-invoice/getnosuratjalan',
            method: 'post',
            dataType: 'json',
            data: {
                "no_surat_jalan": keyword,
                "halaman": halaman,
                "batastampil": batasTampilData
            },
            success: function(data) {

                var dataLoad = "";

                if (data.data_surat_jln.length > 0) {

                    $("#no_surat_jalan").val(no_surat_jalan);
                    $("#nomor_invoice").html(data.data_surat_jln[0].no_invoice);
                    $("#nama_pelanggan").html(data.data_surat_jln[0].nama_pelanggan.toUpperCase());
                    $("#no_hp").html(data.data_surat_jln[0].nomor_hp1);
                    $("#alamat_pengiriman").html(data.data_surat_jln[0].alamat1);
                    $("#tgl_pengiriman").html(dateForShow(data.data_surat_jln[0].tgl_pengiriman));
                    $("#total_tagihan").html("Rp. " + numberWithCommas(data.sum_total[0].total));
                    $("#total_tagihan_value").val(data.sum_total[0].total);

                    for (let i = 0; i < data.data_surat_jln.length; i++) {

                        var result = parseFloat(data.data_surat_jln[i].harga_satuan) * parseFloat(data.data_surat_jln[i].quantity);

                        dataLoad += "<tr>";
                        dataLoad += "<td >";
                        dataLoad += data.data_surat_jln[i].kode;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += data.data_surat_jln[i].nama_barang;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += data.data_surat_jln[i].note_nama_barang;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += data.data_surat_jln[i].quantity + " " + data.data_surat_jln[i].satuan;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += data.data_surat_jln[i].bungkusan;
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += "Rp. " + numberWithCommas(data.data_surat_jln[i].harga_satuan);
                        dataLoad += "</td>";
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += "Rp. " + numberWithCommas(data.data_surat_jln[i].harga_total);
                        dataLoad += "</td>";
                        dataLoad += "</td>";
                        dataLoad += "</tr>";
                    }

                    $("#tbody-table-data-no_surat_jln").html(dataLoad);
                    var totalDataBarang = data.length_paging;
                    var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

                    $('.pagination-result-co').html(paginationViewHTMLDetail(halaman, totalHalaman, no_surat_jalan, batasTampilData))

                    showDataSuratJln();

                } else {
                    $("#info-co").html("Data tidak tersedia");
                    hideDataSuratJln();
                    $('.pagination-result-co').html("");
                }
            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });

    }

    function getKodePo(keyword, batasTampilData, halaman) {

        var kode_po = keyword;

        $.ajax({
            url: '<?= site_url() ?>/payment-invoice-pembelian/getkodepo',
            method: 'post',
            dataType: 'json',
            data: {
                "kode_po": kode_po,
                "halaman": halaman,
                "batastampil": batasTampilData
            },
            success: function(data) {

                var dataLoad = "";
                console.log(data);

                if (data.data_kode_po.length > 0) {

                    $("#pembelian_dari").html(data.data_kode_po[0].nama);
                    $("#pic").html(data.data_kode_po[0].pic);
                    $("#no_hp_po").html(data.data_kode_po[0].no_hp);
                    $("#tgl_pembelian").html(dateForShowCreateDate(data.data_kode_po[0].create_date));
                    $("#total_tagihan_kode_po").html("Rp. " + numberWithCommas(data.sum_total[0].total));
                    $("#total_tagihan_value_po").val(data.sum_total[0].total);
                    $("#no_invoice_kode_po").val(data.data_kode_po[0].no_invoice);

                    for (let i = 0; i < data.data_kode_po.length; i++) {

                        var result = parseFloat(data.data_kode_po[i].harga_satuan) * parseFloat(data.data_kode_po[i].quantity_check);

                        dataLoad += "<tr>";
                        dataLoad += "<td >";
                        dataLoad += data.data_kode_po[i].kode;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += data.data_kode_po[i].nama_barang;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += data.data_kode_po[i].quantity + " " + data.data_kode_po[i].satuan;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += data.data_kode_po[i].quantity_check + " " + data.data_kode_po[i].satuan;
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += "Rp. " + numberWithCommas(data.data_kode_po[i].harga_satuan);
                        dataLoad += "</td>";
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += "Rp. " + numberWithCommas(data.data_kode_po[i].harga_total);
                        dataLoad += "</td>";
                        dataLoad += "</td>";
                        dataLoad += "</tr>";
                    }

                    $("#tbody-table-data_kode_po").html(dataLoad);
                    var totalDataBarang = data.length_paging;
                    var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

                    $('.pagination-result-po').html(paginationViewHTMLDetailPo(halaman, totalHalaman, kode_po, batasTampilData))

                    showDataKodePo();

                } else {
                    $("#info-po").html("Data tidak tersedia");
                    hideDataKodePo();
                    $('.pagination-result-po').html("");
                }

            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });

    }

    function dateForShow(create_date) {

        var day = create_date.substring(6, 8);
        var year = create_date.substring(0, 4);
        var month = create_date.substring(4, 6)


        if (month == "01") {
            month = "Januari";
        } else if (month == "02") {
            month = "Februari";
        } else if (month == "03") {
            month = "Maret";
        } else if (month == "04") {
            month = "April";
        } else if (month == "05") {
            month = "Mei";
        } else if (month == "06") {
            month = "Juni";
        } else if (month == "07") {
            month = "Juli";
        } else if (month == "08") {
            month = "Agustus";
        } else if (month == "09") {
            month = "September";
        } else if (month == "10") {
            month = "Oktober";
        } else if (month == "11") {
            month = "November";
        } else if (month == "12") {
            month = "Desember";
        }

        return day + " " + month + " " + year;
    }

    function dateForShowCreateDate(create_date) {

        var day = create_date.substring(8, 10);
        var year = create_date.substring(0, 4);
        var month = create_date.substring(5, 7)

        if (month == "01") {
            month = "Januari";
        } else if (month == "02") {
            month = "Februari";
        } else if (month == "03") {
            month = "Maret";
        } else if (month == "04") {
            month = "April";
        } else if (month == "05") {
            month = "Mei";
        } else if (month == "06") {
            month = "Juni";
        } else if (month == "07") {
            month = "Juli";
        } else if (month == "08") {
            month = "Agustus";
        } else if (month == "09") {
            month = "September";
        } else if (month == "10") {
            month = "Oktober";
        } else if (month == "11") {
            month = "November";
        } else if (month == "12") {
            month = "Desember";
        }

        return day + " " + month + " " + year;
    }

    function paginationViewHTMLDetail(halaman, totalHalaman, noSuratJalan, batasTampilData) { //halaman 1 total 6

        var data_load = '';
        prev = parseInt(halaman) - 1;
        next = parseInt(halaman) + 1;
        minimal_page = parseInt(halaman) - 2;
        max_page = parseInt(halaman) + 2;
        var prev_v = "dataPagingBarangHREFTrxDetail('" + prev + "','" + noSuratJalan + "','" + batasTampilData + "')";
        var next_v = "dataPagingBarangHREFTrxDetail('" + next + "','" + noSuratJalan + "','" + batasTampilData + "')";
        var halaman1 = "dataPagingBarangHREFTrxDetail('1','" + noSuratJalan + "','" + batasTampilData + "')";
        var halaman2 = "dataPagingBarangHREFTrxDetail('2','" + noSuratJalan + "','" + batasTampilData + "')";
        var halaman3 = "dataPagingBarangHREFTrxDetail('3','" + noSuratJalan + "','" + batasTampilData + "')";
        var halaman4 = "dataPagingBarangHREFTrxDetail('4','" + noSuratJalan + "','" + batasTampilData + "')";
        data_load += '<ul class ="pagination">'

        if (halaman > 1) {
            data_load += '<li class="page-item"><a href ="#"  class = "page-link " onclick="' + prev_v + '">< </a></li>'
            //data_load += '<li class="page-item"><a href="#" class = "page-link " > < <a></li>'
        } else {
            //  data_load += '<li class="page-item"><a href="#" class = "page-link " > < <a></li>'
        }

        console.log("halaman" + halaman);
        console.log("totalHalaman" + totalHalaman);

        for (let i = minimal_page; i <= max_page; i++) {
            var onclk = "dataPagingBarangHREFTrxDetail('" + i + "','" + noSuratJalan + "','" + batasTampilData + "')";

            if (i == halaman && totalHalaman != 0) {
                data_load += '<li class="page-item active"><a class = "page-link" href="#" onclick="' + onclk + '">' + i + '</a> </li>'
            } else if ((i == halaman - 1) && (i != 0)) {
                data_load += '<li class="page-item "><a class = "page-link" href="#" onclick="' + onclk + '">' + i + '</a> </li>'
            } else if (((i > halaman) && (i < max_page)) && (i <= totalHalaman)) {
                data_load += '<li class="page-item "><a class = "page-link" href="#" onclick="' + onclk + '">' + i + '</a> </li>'
            } else if ((halaman == 1) && (i > 0) && (totalHalaman > 3)) {
                data_load += '<li class="page-item "><a class = "page-link" href="#" onclick="' + onclk + '">' + i + '</a> </li>'
            }
        }


        if (halaman < totalHalaman) {
            data_load += '<li class="page-item"><a href="#" class = "page-link " onclick="' + next_v + '"> > <a></li>'
            //data_load += '<li class="page-item"><a href="#" class = "page-link "> > <a></li>'
        } else {
            // data_load += '<li class="page-item"><a href="#" class = "page-link "> > <a></li>'
        }

        data_load += '</ul>'
        console.log(data_load);
        return data_load;
    }

    function dataPagingBarangHREFTrxDetail(halaman, noSuratJalan, batasTampilData) {
        $('#halaman_paging_co').val(halaman)
        getNoSuratJalan(noSuratJalan, batasTampilData, halaman);
    }

    function paginationViewHTMLDetailPo(halaman, totalHalaman, kodePo, batasTampilData) { //halaman 1 total 6

        var data_load = '';
        prev = parseInt(halaman) - 1;
        next = parseInt(halaman) + 1;
        minimal_page = parseInt(halaman) - 2;
        max_page = parseInt(halaman) + 2;
        var prev_v = "dataPagingBarangHREFTrxDetailPo('" + prev + "','" + kodePo + "','" + batasTampilData + "')";
        var next_v = "dataPagingBarangHREFTrxDetailPo('" + next + "','" + kodePo + "','" + batasTampilData + "')";
        var halaman1 = "dataPagingBarangHREFTrxDetailPo('1','" + kodePo + "','" + batasTampilData + "')";
        var halaman2 = "dataPagingBarangHREFTrxDetailPo('2','" + kodePo + "','" + batasTampilData + "')";
        var halaman3 = "dataPagingBarangHREFTrxDetailPo('3','" + kodePo + "','" + batasTampilData + "')";
        var halaman4 = "dataPagingBarangHREFTrxDetailPo('4','" + kodePo + "','" + batasTampilData + "')";
        data_load += '<ul class ="pagination">'

        if (halaman > 1) {
            data_load += '<li class="page-item"><a href ="#"  class = "page-link " onclick="' + prev_v + '">< </a></li>'
            //data_load += '<li class="page-item"><a href="#" class = "page-link " > < <a></li>'
        } else {
            //  data_load += '<li class="page-item"><a href="#" class = "page-link " > < <a></li>'
        }

        console.log("halaman" + halaman);
        console.log("totalHalaman" + totalHalaman);

        for (let i = minimal_page; i <= max_page; i++) {
            var onclk = "dataPagingBarangHREFTrxDetailPo('" + i + "','" + kodePo + "','" + batasTampilData + "')";

            if (i == halaman && totalHalaman != 0) {
                data_load += '<li class="page-item active"><a class = "page-link" href="#" onclick="' + onclk + '">' + i + '</a> </li>'
            } else if ((i == halaman - 1) && (i != 0)) {
                data_load += '<li class="page-item "><a class = "page-link" href="#" onclick="' + onclk + '">' + i + '</a> </li>'
            } else if (((i > halaman) && (i < max_page)) && (i <= totalHalaman)) {
                data_load += '<li class="page-item "><a class = "page-link" href="#" onclick="' + onclk + '">' + i + '</a> </li>'
            } else if ((halaman == 1) && (i > 0) && (totalHalaman > 3)) {
                data_load += '<li class="page-item "><a class = "page-link" href="#" onclick="' + onclk + '">' + i + '</a> </li>'
            }
        }


        if (halaman < totalHalaman) {
            data_load += '<li class="page-item"><a href="#" class = "page-link " onclick="' + next_v + '"> > <a></li>'
            //data_load += '<li class="page-item"><a href="#" class = "page-link "> > <a></li>'
        } else {
            // data_load += '<li class="page-item"><a href="#" class = "page-link "> > <a></li>'
        }

        data_load += '</ul>'
        console.log(data_load);
        return data_load;
    }

    function dataPagingBarangHREFTrxDetailPo(halaman, kodePo, batasTampilData) {
        $('#halaman_paging_po').val(halaman)
        getKodePo(kodePo, batasTampilData, halaman);
    }
</script>