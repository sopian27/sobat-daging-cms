<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <div class="col-md-11">
        <hr style="margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 offset-md-1">
                <div class="input-group">
                    <input class="form-control-paging" type="text" placeholder="search..." id="search" name="search" onkeyup="searchData()">
                    <span class="input-group-append">
                        <button class="btn btn-outline-light" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </div>
            <div class="col-md-2 offset-md-6">
                <div class="input-group">
                    <span class="input-group-append">
                        <button class="btn btn-outline-light" type="button">
                            <span>sort</span>
                        </button>
                    </span>
                    <input class="form-control-paging-date" type="text" id="create_date" name="create_date">
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="margin-top:40px" id="payment-main">
        <div class="row justify-content-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-1 offset-md-1">
                        <div>
                            <a class="form-control-button btn" style="background-color: #B89874;border:none;padding:10px"> Payment </a>
                        </div>
                        <div style="margin-top:30px">
                            <a class="form-control-button btn btn-outline-light button-action" style="padding:10px" onclick="showInvoice();"> Invoice </a>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-1">
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">
                                <?php
                                $t = time();
                                $date = date("d/m/Y", $t);
                                echo "PIP-0001/" . $date;
                                ?>
                            </label>
                            <h4 id="payment-main-title"></h4>
                        </div>
                    </div>
                    <div class="col-md-3 offset-md-1">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label" style="margin-top: -7px;">Payment In </label>
                            <div class="col-sm-3" id="payment-in-tot"></div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label" style="margin-top: -7px;">Payment Out </label>
                            <div class="col-sm-3" id="payment-out-tot"></div>
                        </div>
                        <hr style="width: 300px;">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label" style="margin-top: -7px;">Total </label>
                            <div class="col-sm-3" id="payment-tot"></div>
                        </div>
                    </div>
                    <div class="col-md-3 offset-md-2">
                        <a href="#" style="color:white" onclick="show_payment_in();">Payment In</a> /
                        <a style="color:white" href="#" onclick="show_payment_out();">Payment Out</a>
                    </div>
                    <div class="col-md-6 offset-md-2" style="margin-top: 20px;" id="div-payment-in">
                        <table class="table table-dark table-bordered data">
                            <thead>
                                <tr>
                                    <th colspan="4"> Payment In </th>
                                </tr>
                                <tr>
                                    <th> Nomor Invoice </th>
                                    <th> Nama Pelanggan </th>
                                    <th> Tanggal Pembayaran </th>
                                    <th> View </th>
                                </tr>
                            </thead>
                            <tbody id="tbody-payment-in">
                            </tbody>
                        </table>
                        <input type="hidden" name="halaman_paging_payment_in" id="halaman_paging_payment_in" value="1">
                        <div class="pagination-result-payment-in" style="margin-top:10px;margin-left:45%"></div>
                    </div>
                    <div class="col-md-6 offset-md-2" style="margin-top: 20px;display:none" id="div-payment-out">
                        <table class="table table-dark table-bordered data">
                            <thead>
                                <tr>
                                    <th colspan="4"> Payment Out </th>
                                </tr>
                                <tr>
                                    <th> Nomor Invoice </th>
                                    <th> Nama Pelanggan </th>
                                    <th> Tanggal Pembayaran </th>
                                    <th> View </th>
                                </tr>
                            </thead>
                            <tbody id="tbody-payment-out">
                            </tbody>
                        </table>
                        <input type="hidden" name="halaman_paging_payment_out" id="halaman_paging_payment_out" value="1">
                        <div class="pagination-result-payment-out" style="margin-top:10px;margin-left:45%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" style="margin-top:40px;display:none" id="invoice-main">
        <div class="row justify-content-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-1 offset-md-1">
                        <div>
                            <a class="form-control-button btn btn-outline-light button-action" style="padding:10px" onclick="showPayment();"> Payment </a>
                        </div>
                        <div style="margin-top:30px">
                            <a class="form-control-button btn" style="background-color: #B89874;border:none;padding:10px"> Invoice </a>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-1">
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">
                                <?php
                                $t = time();
                                $date = date("d/m/Y", $t);
                                echo "PIP-0001/" . $date;
                                ?>
                            </label>
                            <h4 id="invoice-main-title"></h4>
                        </div>
                    </div>
                    <div class="col-md-3 offset-md-2">
                        <a href="#" style="color:white" onclick="show_invoice_co();">Invoice Customer</a> /
                        <a style="color:white" href="#" onclick="show_invoice_po();">Invoice Pembelian</a>
                    </div>
                    <div class="col-md-6 offset-md-2" style="margin-top: 20px;" id="div-invoice-co">
                        <table class="table table-dark table-bordered data">
                            <thead>
                                <tr>
                                    <th colspan="4"> Invoice Customer </th>
                                </tr>
                                <tr>
                                    <th> No Surat Jalan </th>
                                    <th> Nama Pelanggan </th>
                                    <th> No Invoice </th>
                                    <th> View </th>
                                </tr>
                            </thead>
                            <tbody id="tbody-invoice-co">
                            </tbody>
                        </table>
                        <input type="hidden" name="halaman_paging_invoice-co" id="halaman_paging_invoice-co" value="1">
                        <div class="pagination-result-invoice-co" style="margin-top:10px;margin-left:45%"></div>
                    </div>
                    <div class="col-md-6 offset-md-2" style="margin-top: 20px;display:none" id="div-invoice-po">
                        <table class="table table-dark table-bordered data">
                            <thead>
                                <tr>
                                    <th colspan="4"> Invoice Pembelian </th>
                                </tr>
                                <tr>
                                    <th> Kode Po </th>
                                    <th> Nama Pelanggan </th>
                                    <th> No Invoice </th>
                                    <th> View </th>
                                </tr>
                            </thead>
                            <tbody id="tbody-invoice-po">
                            </tbody>
                        </table>
                        <input type="hidden" name="halaman_paging_invoice-po" id="halaman_paging_invoice-po" value="1">
                        <div class="pagination-result-invoice-po" style="margin-top:10px;margin-left:45%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="margin-top: 40px;display:none" id="payment-history-side">
        <div class="row justify-content-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-1 offset-md-1">
                        <div>
                            <a class="form-control-button btn" style="background-color: #B89874;border:none;padding:10px"> Payment </a>
                        </div>
                        <div style="margin-top:30px">
                            <a class="form-control-button btn btn-outline-light button-action" style="padding:10px" onclick="showInvoice();"> Invoice </a>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-1">
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">
                                <?php
                                $t = time();
                                $date = date("d/m/Y", $t);
                                echo "PIP-0001/" . $date;
                                ?>
                            </label>
                            <h4 id="payment-main-title"></h4>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2" id="payment-history">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="margin-top: 40px;display:none" id="invoice-customer">
        <div class="row justify-content-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-1 offset-md-1">
                        <div>
                            <a class="form-control-button btn btn-outline-light button-action" style="padding:10px" onclick="showPayment();"> Payment </a>
                        </div>
                        <div style="margin-top:30px">
                            <a class="form-control-button btn" style="background-color: #B89874;border:none;padding:10px"> Invoice </a>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-1">
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">
                                <?php
                                $t = time();
                                $date = date("d/m/Y", $t);
                                echo "PIP-0001/" . $date;
                                ?>
                            </label>
                            <h4 id="invoice-main-title"></h4>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label"></label>
                        </div>
                        <div class="form-group row" style="margin-top:30px">
                            <label for="" class="col-sm-3 col-form-label">Nomor Surat Jalan </label>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control-label" id="no_surat_jalan" name="no_surat_jalan">
                            </div>
                        </div>
                        <div class="div_no_surat_jln">
                            <hr style="border-width: 2px;border-style: solid;border-color:white" class="col-md-8">
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nomor Invoice </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <label for="" class="col-form-label" id="nomor_invoice"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama Pelanggan </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <label for="" class="col-form-label" id="nama_pelanggan"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nomor Hp </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <label for="" class="col-form-label" id="no_hp"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Alamat Pengiriman </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <label for="" class="col-form-label" id="alamat_pengiriman"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Tanggal Pengiriman </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <label for="" class="col-form-label" id="tgl_pengiriman"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Jatuh Tempo </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <label for="" class="col-form-label" id="jatuh_tempo_no_surat_jln" style="color:red"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Total Tagihan </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <label for="" class="col-form-label" id="total_tagihan"></label>
                                </div>
                            </div>
                            <div class="form-group row" style="display: none;">
                                <label for="" class="col-sm-3 col-form-label">Bonus </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <label for="" class="col-form-label" id="bonus"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Bank Tujuan </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <label for="" class="col-form-label" id="bank_tujuan"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">No. Rekening </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <label for="" class="col-form-label" id="no_rekening"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Atas Nama </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <label for="" class="col-form-label" id="atas_nama"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="div_no_surat_jln">
                    <div class="row" style="margin-top: 50px;">
                        <div class="col-md-7 offset-md-2 justify-content-center">
                            <div class="row mt-2 ">
                                <table class="table table-dark table-bordered data" id="tableInv">
                                    <thead>
                                        <tr class="align-middle">
                                            <th rowspan="2"> Kode </th>
                                            <th rowspan="2"> Nama Bahan </th>
                                            <th rowspan="2"> Nama Barang </th>
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
                                <input type="hidden" name="halaman_paging_no_surat_jln" id="halaman_paging_no_surat_jln" value="1">
                                <div class="pagination-result-no_surat_jln" style="margin-top:10px;margin-left:45%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex offset-md-7">
                        <div class="col-md-2">
                            <button class="form-control-button btn btn-outline-light button-action" onclick="back();"> Back </button>
                        </div>
                        <div class="col-md-2">
                            <button class="form-control-button btn btn-outline-light button-action" onclick="print()"> Print </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center" style="margin-top: 40px;display:none" id="invoice-pembelian">
        <div class="container">
            <div class="row">
                <div class="col-md-1 offset-md-1">
                    <div>
                        <a class="form-control-button btn btn-outline-light button-action" style="padding:10px" onclick="showPayment();"> Payment </a>
                    </div>
                    <div style="margin-top:30px">
                        <a class="form-control-button btn" style="background-color: #B89874;border:none;padding:10px"> Invoice </a>
                    </div>
                </div>
                <div class="col-md-5 offset-md-1">
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label">
                            <?php
                            $t = time();
                            $date = date("d/m/Y", $t);
                            echo "PIP-0001/" . $date;
                            ?>
                        </label>
                        <h4 id="invoice-main-title"></h4>
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label"></label>
                    </div>
                    <div class="form-group row" style="margin-top:30px">
                        <label for="" class="col-sm-3 col-form-label">Kode Po </label>
                        <div class="col-sm-1">:</div>
                        <div class="col-sm-4">
                            <label for="" class=" col-form-label" id="kode_po"></label>
                        </div>
                    </div>
                    <div class="div_kode_po">
                        <hr style="border-width: 2px;border-style: solid;border-color:white" class="col-md-8">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Pembelian dari </label>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-4">
                                <label for="" class=" col-form-label" id="pembelian_dari"></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Pic </label>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-4">
                                <label for="" class=" col-form-label" id="pic"></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Nomor Hp </label>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-4">
                                <label for="" class=" col-form-label" id="no_hp"></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Tanggal Pembelian </label>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-4">
                                <label for="" class=" col-form-label" id="tgl_pembelian"> </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Jatuh Tempo </label>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-4">
                                <label for="" class=" col-form-label" id="jatuh_tempo_kode_po" style="color:red"></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Total Tagihan </label>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-4">
                                <label for="" class=" col-form-label" id="total_tagihan_kode_po"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="div_kode_po">
                <div class="row" style="margin-top: 50px;">
                    <div class="col-md-7 offset-md-2 justify-content-center">
                        <div class="row mt-2 ">
                            <table class="table table-dark table-bordered data" id="tableInv">
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
                            <input type="hidden" name="halaman_paging_kode_po" id="halaman_paging_kode_po" value="1">
                            <div class="pagination-result-kode-po" style="margin-top:10px;margin-left:45%"></div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex offset-md-7">
                    <div class="col-md-2">
                        <button class="form-control-button btn btn-outline-light button-action" onclick="back();"> Back </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top:60px">
        <form name="form-payment-history" id="form-payment-history" action="<?= site_url()?>/payment-history/print" target="blank" method="POST">
            <input type="hidden" name="no_surat_jln" id="no_surat_jln"/>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#payment-in-tot").html("Rp. 0");
        $("#payment-out-tot").html("Rp. 0");
        $("#payment-tot").html("Rp. 0");
    });

    function print(){
        $("#form-payment-history").submit();
    }

    function searchData() {

        var batasTampilData = 10;
        var halaman = 1;
        var keyword = $("#search").val();
        var create_date = "";
        initPaging();

        getHistory(create_date, keyword, batasTampilData, halaman);

    }

    /*
    function submit_data() {
        $("#form-payment-history").submit();
    }
    */

    $(document).on('change', '#create_date', function() {
        var create_date = document.getElementById("create_date").value;
        create_date = create_date.replaceAll("-", "");
        console.log(create_date);

        var batasTampilData = 10;
        var halaman = 1;
        var keyword = "";
        initPaging();

        getHistory(create_date, keyword, batasTampilData, halaman);

    });

    function initPaging() {

        $("#halaman_paging_payment_in").val("1");
        $("#halaman_paging_payment_out").val("1");
        $("#halaman_paging_invoice-co").val("1");
        $("#halaman_paging_invoice-po").val("1");
        $("#halaman_paging_no_surat_jln").val("1");
        $("#halaman_paging_kode_po").val("1");
    }

    function show_payment_in() {
        $("#div-payment-in").show();
        $("#div-payment-out").hide();
    }

    function show_payment_out() {
        $("#div-payment-in").hide();
        $("#div-payment-out").show();
    }

    function show_invoice_co() {
        $("#div-invoice-co").show();
        $("#div-invoice-po").hide();
    }

    function show_invoice_po() {
        $("#div-invoice-co").hide();
        $("#div-invoice-po").show();
    }

    $(function() {
        $("#create_date").datepicker({
            todayHighlight: true,
            format: "yyyy-mm",
            startView: "months",
            minViewMode: "months",
            autoclose: true
        })

        $("#create_date").val("Januari, Februari, Maret....");
    });

    function getHistory(create_date, keyword, batasTampilData, halaman) {

        $.ajax({
            url: '<?= site_url() ?>/payment-history/gethistory',
            method: 'post',
            dataType: 'json',
            data: {
                'create_date': create_date,
                'halaman': halaman,
                'keyword': keyword,
                'batastampil': batasTampilData
            },
            success: function(data) {

                console.log(data);

                if (data.length_in > 0) {
                    setdatapaymentin(data, create_date, keyword, halaman, batasTampilData);
                } else {
                    $("#tbody-payment-in").html("");
                    $('.pagination-result-payment-in').html("");
                }

                if (data.length_out > 0) {
                    setdatapaymentout(data, create_date, keyword, halaman, batasTampilData);
                } else {
                    $("#tbody-payment-out").html("");
                    $('.pagination-result-payment-out').html("");
                }

                if (data.length_cus > 0) {
                    setdatainvoiceco(data, create_date, keyword, halaman, batasTampilData);
                } else {
                    $("#tbody-invoice-co").html("");
                    $('.pagination-result-invoice-co').html("");
                }

                if (data.length_po > 0) {
                    setdatainvoicepo(data, create_date, keyword, halaman, batasTampilData);
                } else {
                    $("#tbody-invoice-po").html("");
                    $('.pagination-result-invoice-po').html("");
                }


                $("#payment-in-tot").html("Rp. " + numberWithCommas((data.data_in_tot.length > 0) ? data.data_in_tot[0].total : 0));
                $("#payment-out-tot").html("Rp. " + numberWithCommas((data.data_out_tot.length > 0) ? data.data_out_tot[0].total : 0));
                $("#payment-tot").html("Rp. " + numberWithCommas(parseFloat((data.data_in_tot.length > 0) ? data.data_in_tot[0].total : 0) - parseFloat((data.data_out_tot.length > 0) ? data.data_out_tot[0].total : 0)));

                paymentMainTitle(getMonthOnly(create_date));
                invoiceMainTitle(getMonthOnly(create_date));

            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }

    function setdatapaymentin(data, create_date, keyword, halaman, batasTampilData) {

        var dataLoad = "";
        for (let i = 0; i < data.length_in; i++) {

            var functionOnclick = 'loadHistoryPayment("' + data.data_in[i].no_invoice + '")';

            dataLoad += "<tr>";
            dataLoad += "<td>";
            dataLoad += data.data_in[i].no_invoice;
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += data.data_in[i].nama.toUpperCase();
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += dateForShow(data.data_in[i].tgl_pembayaran);
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += "<a href='#' onclick=" + functionOnclick + " class='btn btn-payment-md'><span></span></a>";
            dataLoad += "</td>";
            dataLoad += "</tr>";
        }

        var totalDataBarang = data.length_in_paging;
        var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);
        $('.pagination-result-payment-in').html(paginationViewHTMLIn(halaman, totalHalaman, create_date, keyword, batasTampilData))
        $("#tbody-payment-in").html(dataLoad);

    }

    function setdatapaymentout(data, create_date, keyword, halaman, batasTampilData) {

        var dataLoad = "";

        for (let i = 0; i < data.length_out; i++) {

            var functionOnclick = 'loadHistoryPaymentOut("' + data.data_out[i].no_invoice + '")';

            dataLoad += "<tr>";
            dataLoad += "<td>";
            dataLoad += data.data_out[i].no_invoice;
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += data.data_out[i].nama.toUpperCase();
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += dateForShow(data.data_out[i].tgl_pembayaran);
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += "<a href='#' onclick=" + functionOnclick + " class='btn btn-payment-md'><span></span></a>";
            dataLoad += "</td>";
            dataLoad += "</tr>";
        }

        var totalDataBarang = data.length_out_paging;
        var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

        $('.pagination-result-payment-out').html(paginationViewHTMLOut(halaman, totalHalaman, create_date, keyword, batasTampilData))
        $("#tbody-payment-out").html(dataLoad);

    }

    function setdatainvoiceco(data, create_date, keyword, halaman, batasTampilData) {

        var dataLoad = "";

        for (let i = 0; i < data.length_cus; i++) {

            var functionOnclick = 'invoiceCustomerPaging("' + data.data_cus[i].no_surat_jalan + '")';

            dataLoad += "<tr>";
            dataLoad += "<td>";
            dataLoad += data.data_cus[i].no_surat_jalan;
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += data.data_cus[i].nama.toUpperCase();
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += data.data_cus[i].no_invoice;
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += "<a href='#' onclick=" + functionOnclick + " class='btn btn-payment-md'><span></span></a>";
            dataLoad += "</td>";
            dataLoad += "</tr>";
        }

        var totalDataBarang = data.length_cus_paging;
        var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

        $('.pagination-result-invoice-co').html(paginationViewHTMLCo(halaman, totalHalaman, create_date, keyword, batasTampilData))
        $("#tbody-invoice-co").html(dataLoad);

    }

    function setdatainvoicepo(data, create_date, keyword, halaman, batasTampilData) {

        var dataLoad = "";

        for (let i = 0; i < data.length_po; i++) {

            var functionOnclick = 'invoicePembelianPaging("' + data.data_po[i].id_trx_po + '")';

            dataLoad += "<tr>";
            dataLoad += "<td>";
            dataLoad += data.data_po[i].id_trx_po;
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += data.data_po[i].nama.toUpperCase();
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += data.data_po[i].no_invoice;
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += "<a href='#' onclick=" + functionOnclick + " class='btn btn-payment-md'><span></span></a>";
            dataLoad += "</td>";
            dataLoad += "</tr>";
        }

        var totalDataBarang = data.length_cus_paging;
        var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

        $('.pagination-result-invoice-po').html(paginationViewHTMLPo(halaman, totalHalaman, create_date, keyword, batasTampilData))
        $("#tbody-invoice-po").html(dataLoad);

    }

    function invoiceCustomerPaging(no_surat_jalan) {

        var batasTampilData = 10;
        var halaman = $('#halaman_paging_no_surat_jln').val();
        getHistorySuratJalan(no_surat_jalan, batasTampilData, halaman);

    }

    function invoicePembelianPaging(id_trx_po) {

        var batasTampilData = 10;
        var halaman = $('#halaman_paging_kode_po').val();
        getHistoryKodePo(id_trx_po, batasTampilData, halaman);

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

    function getMonthOnly(create_date) {

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

        return month;
    }

    function paymentMainTitle(month) {
        $("#payment-main-title").html("History Payment Bulan " + month);
    }

    function invoiceMainTitle(month) {

        $("#invoice-main-title").html("History Invoice Bulan " + month);
    }

    function hideDataSuratJln() {
        $("#invoice-customer").hide();
    }

    function hideDataKodePo() {
        $("#invoice-pembelian").hide();
    }

    function showDataSuratJln() {
        $("#invoice-customer").show();
    }

    function showDataKodePo() {
        $("#invoice-pembelian").show();
    }

    function getHistoryKodePo(id_trx_po, batasTampilData, halaman) {

        var kode_po = id_trx_po;

        $.ajax({
            url: '<?= site_url() ?>/payment-history/gethistorykodepo',
            method: 'post',
            dataType: 'json',
            data: {
                'kode_po': kode_po,
                'halaman': halaman,
                'batastampil': batasTampilData
            },
            success: function(data) {

                var dataLoad = "";
                console.log(data);

                if (data.data_kode_po.length > 0) {

                    $("#kode_po").html(data.data_kode_po[0].id_trx_po);
                    $("#pembelian_dari").html(data.data_kode_po[0].nama);
                    $("#pic").html(data.data_kode_po[0].pic);
                    $("#no_hp").html(data.data_kode_po[0].no_hp);
                    $("#tgl_pembelian").html(dateForShow(data.data_kode_po[0].create_date));
                    $("#jatuh_tempo_kode_po").html(dateForShow(data.data_kode_po[0].jatuh_tempo));
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
                        dataLoad += "Rp. " + numberWithCommas(result);
                        dataLoad += "</td>";
                        dataLoad += "</td>";
                        dataLoad += "</tr>";
                    }

                    hidePaymentAndInvoice();

                    var totalDataBarang = data.length_paging;
                    var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

                    $('.pagination-result-kode-po').html(paginationViewHTMLKodePo(halaman, totalHalaman, kode_po));
                    $("#tbody-table-data_kode_po").html(dataLoad);
                    showDataKodePo();

                } else {

                    hideDataKodePo();
                    $('.pagination-result-kode-po').html("");
                }

            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });

    }

    function getHistorySuratJalan(no_surat_jalan, batasTampilData, halaman) {

        $.ajax({
            url: '<?= site_url() ?>/payment-history/gethistorysuratjalan',
            method: 'post',
            dataType: 'json',
            data: {
                'no_surat_jalan': no_surat_jalan,
                'halaman': halaman,
                'batastampil': batasTampilData
            },
            success: function(data) {

                var dataLoad = "";
                console.log(data);

                if (data.data_surat_jln.length > 0) {

                    $("#no_surat_jalan").val(no_surat_jalan);
                    $("#no_surat_jln").val(no_surat_jalan);
                    $("#nomor_invoice").html(data.data_surat_jln[0].no_invoice);
                    $("#nama_pelanggan").html(data.data_surat_jln[0].nama_pelanggan.toUpperCase());
                    $("#no_hp").html(data.data_surat_jln[0].nomor);
                    $("#alamat_pengiriman").html(data.data_surat_jln[0].alamat);
                    $("#tgl_pengiriman").html(dateForShow(data.data_surat_jln[0].tgl_pengiriman));
                    $("#total_tagihan").html("Rp. " + numberWithCommas(data.sum_total[0].total));
                    $("#total_tagihan_value").html(data.sum_total[0].total);
                    $("#bonus").html("Rp. " + numberWithCommas(data.data_surat_jln[0].bonus));
                    $("#jatuh_tempo_no_surat_jln").html(dateForShow(data.data_surat_jln[0].jatuh_tempo));
                    $("#bank_tujuan").html(data.data_surat_jln[0].bank_tujuan);
                    $("#atas_nama").html(data.data_surat_jln[0].atas_nama.toUpperCase());
                    $("#no_rekening").html(data.data_surat_jln[0].no_rekening);
                    $("#total_tagihan_value").html(data.sum_total[0].total);
                    $("#total_tagihan_value").html(data.sum_total[0].total);
                    

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

                    hidePaymentAndInvoice();
                    var totalDataBarang = data.length_paging;
                    var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

                    $('.pagination-result-no_surat_jln').html(paginationViewHTMLSuratJln(halaman, totalHalaman, no_surat_jalan));
                    $("#tbody-table-data-no_surat_jln").html(dataLoad);
                    showDataSuratJln();

                } else {

                    hideDataSuratJln();
                    $('.pagination-result-no_surat_jln').html("");
                }

            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }

    function backToHistory() {
        location.reload();
    }

    function loadHistoryPayment(no_invoice) {

        $.ajax({
            url: '<?= site_url() ?>/payment-history/loadhistory',
            method: 'post',
            dataType: 'json',
            data: {
                no_invoice: no_invoice
            },
            success: function(data) {

                $("#payment-history").html("");
                var dataload = "";
                dataload += '<div class="form-group row" style="margin-top:30px">' +
                    '<label for="" class="col-sm-6 col-form-label">Nomor Invoice </label>' +
                    '<div class="col-sm-1">:</div>' +
                    '<div class="col-sm-5">' +
                    '<label>' + no_invoice + '</label>' +
                    '</div>' +
                    '</div>';
                dataload += '<a style="color:white;" data-bs-toggle="collapse" ';
                dataload += 'href="#collapseExample">Pembayaran Sebelumnya (-)</a>';
                dataload += '<hr style="border-width: 2px;border-style: solid;border-color:white">';

                if (data.data.length > 0) {

                    if (data.flag == false) {

                        for (i = 0; i < data.data.length; i++) {

                            var nominal_bayar = data.data[i].nominal_bayar;

                            var sisa = parseFloat(data.data[i].harga_total) - parseFloat(data.data[i].nominal_bayar);
                            dataload += '<div class="collapse" id="collapseExample">';
                            dataload += '<hr style="width: 275px;border-width: 2px;border-style: solid;border-color:white">' +
                                '<div style="font-size: 14px;">' +
                                '<div class="form-group row">' +
                                '<label for="" class="col-sm-6 col-form-label">Nama Pelanggan </label>' +
                                '<div class="col-sm-1">:</div>' +
                                '<div class="col-sm-5">' +
                                '<label >' + data.data[i].nama_pelanggan.toUpperCase() + '</label>' +
                                '</div>' +
                                '</div>';

                            dataload += '<div class="form-group row" style="margin-top: 10px;">' +
                                '<label for="" class="col-sm-6 col-form-label">Total Tagihan </label>' +
                                '<div class="col-sm-1">:</div>' +
                                '<div class="col-sm-5">' +
                                '<label >Rp. ' + numberWithCommas(data.data[i].harga_total) + '</label>' +
                                '</div>' +
                                '</div>';

                            dataload += '<div class="form-group row" style="margin-top: 10px;">' +
                                '<label for="" class="col-sm-6 col-form-label">Nominal Pembayaran </label>' +
                                '<div class="col-sm-1">:</div>' +
                                '<div class="col-sm-5">' +
                                '<label>Rp. ' + numberWithCommas(data.data[i].nominal_bayar) + '</label>' +
                                '</div>' +
                                '</div>' +
                                '<hr>';

                            dataload += '<div class="form-group row" style="margin-top: 10px;">' +
                                '<label for="" class="col-sm-6 col-form-label">Kekurangan Pembayaran </label>' +
                                '<div class="col-sm-1">:</div>' +
                                '<div class="col-sm-5">' +
                                '<label >Rp. ' + numberWithCommas(sisa) + '</label>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>';

                        }


                        dataload += '<div class="form-group row" >' +
                            '<label for="" class="col-sm-6 col-form-label">Nama Pelanggan </label>' +
                            '<div class="col-sm-1">:</div>' +
                            '<div class="col-sm-5">' +
                            '<label>' + data.data[0].nama_pelanggan + '</label>' +
                            '</div>' +
                            '</div>';

                        dataload += '<div class="form-group row" >' +
                            '<label for="" class="col-sm-6 col-form-label">Kekurangan Pembayaran </label>' +
                            '<div class="col-sm-1">:</div>' +
                            '<div class="col-sm-5">' +
                            '<label>' + "Rp. " + numberWithCommas(data.data[0].harga_total) + '</label>' +
                            '</div>' +
                            '</div>';

                        dataload += '<div class="form-group row" >' +
                            '<label for="" class="col-sm-6 col-form-label">Nominal Pembayaran </label>' +
                            '<div class="col-sm-1">:</div>' +
                            '<div class="col-sm-5">' +
                            '<label>' + "Rp. " + numberWithCommas(data.data[0].harga_total) + '</label>' +
                            '</div>' +
                            '</div>';

                        dataload += '<hr style="border-width: 2px;border-style: solid;border-color:white">';

                        dataload += '<div class="form-group row" >' +
                            '<label for="" class="col-sm-6 col-form-label">Kekurangan Pembayaran </label>' +
                            '<div class="col-sm-1">:</div>' +
                            '<div class="col-sm-5">' +
                            '<label>' + "Rp. 0" + '</label>' +
                            '</div>' +
                            '</div>';

                    } else {

                        dataload += '<div class="form-group row" >' +
                            '<label for="" class="col-sm-6 col-form-label">Nama Pelanggan </label>' +
                            '<div class="col-sm-1">:</div>' +
                            '<div class="col-sm-5">' +
                            '<label>' + data.data[0].nama_pelanggan + '</label>' +
                            '</div>' +
                            '</div>';

                        dataload += '<div class="form-group row" >' +
                            '<label for="" class="col-sm-6 col-form-label">Kekurangan Pembayaran </label>' +
                            '<div class="col-sm-1">:</div>' +
                            '<div class="col-sm-5">' +
                            '<label>' + "Rp. " + numberWithCommas(data.data[0].total_tagihan) + '</label>' +
                            '</div>' +
                            '</div>';

                        dataload += '<div class="form-group row" >' +
                            '<label for="" class="col-sm-6 col-form-label">Nominal Pembayaran </label>' +
                            '<div class="col-sm-1">:</div>' +
                            '<div class="col-sm-5">' +
                            '<label>' + "Rp. 0" + '</label>' +
                            '</div>' +
                            '</div>';

                        dataload += '<hr style="border-width: 2px;border-style: solid;border-color:white">';

                        dataload += '<div class="form-group row" >' +
                            '<label for="" class="col-sm-6 col-form-label">Kekurangan Pembayaran </label>' +
                            '<div class="col-sm-1">:</div>' +
                            '<div class="col-sm-5">' +
                            '<label>' + "Rp. " + numberWithCommas(data.data[0].total_tagihan) + '</label>' +
                            '</div>' +
                            '</div>';
                    }



                    dataload += '<div class="col-md-3 offset-md-3" style="margin-top:30px">' +
                        '<button class="form-control-button btn btn-outline-light button-action" onclick="back();"> Back </button>' +
                        '</div>';

                    hidePaymentAndInvoice();

                    $("#payment-history").html(dataload);
                    $("#payment-history").show();
                    $("#payment-history-side").show();
                }
            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }

    function loadHistoryPaymentOut(no_invoice) {

        $.ajax({
            url: '<?= site_url() ?>/payment-history/loadhistoryout',
            method: 'post',
            dataType: 'json',
            data: {
                no_invoice: no_invoice
            },
            success: function(data) {

                $("#payment-history").html("");
                var dataload = "";
                dataload += '<div class="form-group row" style="margin-top:30px">' +
                    '<label for="" class="col-sm-6 col-form-label">Nomor Invoice </label>' +
                    '<div class="col-sm-1">:</div>' +
                    '<div class="col-sm-5">' +
                    '<label>' + no_invoice + '</label>' +
                    '</div>' +
                    '</div>';
                dataload += '<a style="color:white;" data-bs-toggle="collapse" ';
                dataload += 'href="#collapseExample">Pembayaran Sebelumnya (-)</a>';
                dataload += '<hr style="border-width: 2px;border-style: solid;border-color:white">';

                if (data.data.length > 0) {

                    if (data.flag == false) {

                        for (i = 0; i < data.data.length; i++) {

                            var nominal_bayar = data.data[i].nominal_bayar;

                            var sisa = parseFloat(data.data[i].harga_total) - parseFloat(data.data[i].nominal_bayar);
                            dataload += '<div class="collapse" id="collapseExample">';
                            dataload += '<hr style="width: 275px;border-width: 2px;border-style: solid;border-color:white">' +
                                '<div style="font-size: 14px;">' +
                                '<div class="form-group row">' +
                                '<label for="" class="col-sm-6 col-form-label">Nama Pelanggan </label>' +
                                '<div class="col-sm-1">:</div>' +
                                '<div class="col-sm-5">' +
                                '<label >' + data.data[i].nama.toUpperCase() + '</label>' +
                                '</div>' +
                                '</div>';

                            dataload += '<div class="form-group row" style="margin-top: 10px;">' +
                                '<label for="" class="col-sm-6 col-form-label">Total Tagihan </label>' +
                                '<div class="col-sm-1">:</div>' +
                                '<div class="col-sm-5">' +
                                '<label >Rp. ' + numberWithCommas(data.data[i].harga_total) + '</label>' +
                                '</div>' +
                                '</div>';

                            dataload += '<div class="form-group row" style="margin-top: 10px;">' +
                                '<label for="" class="col-sm-6 col-form-label">Nominal Pembayaran </label>' +
                                '<div class="col-sm-1">:</div>' +
                                '<div class="col-sm-5">' +
                                '<label>Rp. ' + numberWithCommas(data.data[i].nominal_bayar) + '</label>' +
                                '</div>' +
                                '</div>' +
                                '<hr>';

                            dataload += '<div class="form-group row" style="margin-top: 10px;">' +
                                '<label for="" class="col-sm-6 col-form-label">Kekurangan Pembayaran </label>' +
                                '<div class="col-sm-1">:</div>' +
                                '<div class="col-sm-5">' +
                                '<label >Rp. ' + numberWithCommas(sisa) + '</label>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>';

                        }


                        dataload += '<div class="form-group row" >' +
                            '<label for="" class="col-sm-6 col-form-label">Nama Pelanggan </label>' +
                            '<div class="col-sm-1">:</div>' +
                            '<div class="col-sm-5">' +
                            '<label>' + data.data[0].nama + '</label>' +
                            '</div>' +
                            '</div>';

                        dataload += '<div class="form-group row" >' +
                            '<label for="" class="col-sm-6 col-form-label">Kekurangan Pembayaran </label>' +
                            '<div class="col-sm-1">:</div>' +
                            '<div class="col-sm-5">' +
                            '<label>' + "Rp. " + numberWithCommas(data.data[0].harga_total) + '</label>' +
                            '</div>' +
                            '</div>';

                        dataload += '<div class="form-group row" >' +
                            '<label for="" class="col-sm-6 col-form-label">Nominal Pembayaran </label>' +
                            '<div class="col-sm-1">:</div>' +
                            '<div class="col-sm-5">' +
                            '<label>' + "Rp. " + numberWithCommas(data.data[0].harga_total) + '</label>' +
                            '</div>' +
                            '</div>';

                        dataload += '<hr style="border-width: 2px;border-style: solid;border-color:white">';

                        dataload += '<div class="form-group row" >' +
                            '<label for="" class="col-sm-6 col-form-label">Kekurangan Pembayaran </label>' +
                            '<div class="col-sm-1">:</div>' +
                            '<div class="col-sm-5">' +
                            '<label>' + "Rp. 0" + '</label>' +
                            '</div>' +
                            '</div>';

                    } else {

                        dataload += '<div class="form-group row" >' +
                            '<label for="" class="col-sm-6 col-form-label">Nama Pelanggan </label>' +
                            '<div class="col-sm-1">:</div>' +
                            '<div class="col-sm-5">' +
                            '<label>' + data.data[0].nama + '</label>' +
                            '</div>' +
                            '</div>';

                        dataload += '<div class="form-group row" >' +
                            '<label for="" class="col-sm-6 col-form-label">Kekurangan Pembayaran </label>' +
                            '<div class="col-sm-1">:</div>' +
                            '<div class="col-sm-5">' +
                            '<label>' + "Rp. " + numberWithCommas(data.data[0].total_tagihan) + '</label>' +
                            '</div>' +
                            '</div>';

                        dataload += '<div class="form-group row" >' +
                            '<label for="" class="col-sm-6 col-form-label">Nominal Pembayaran </label>' +
                            '<div class="col-sm-1">:</div>' +
                            '<div class="col-sm-5">' +
                            '<label>' + "Rp. 0" + '</label>' +
                            '</div>' +
                            '</div>';

                        dataload += '<hr style="border-width: 2px;border-style: solid;border-color:white">';

                        dataload += '<div class="form-group row" >' +
                            '<label for="" class="col-sm-6 col-form-label">Kekurangan Pembayaran </label>' +
                            '<div class="col-sm-1">:</div>' +
                            '<div class="col-sm-5">' +
                            '<label>' + "Rp. " + numberWithCommas(data.data[0].total_tagihan) + '</label>' +
                            '</div>' +
                            '</div>';
                    }

                    dataload += '<div class="col-md-3  offset-md-3" style="margin-top:30px">' +
                        '<button class="form-control-button btn btn-outline-light button-action" onclick="back();"> Back </button>' +
                        '</div>';

                    hidePaymentAndInvoice();
                    $("#payment-history").html(dataload);
                    $("#payment-history").show();
                    $("#payment-history-side").show();
                }
            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }

    function back() {
        $("#payment-main").show();
        $("#payment-history").hide();
        $("#payment-history-side").hide();
        $("#invoice-customer").hide();
        $("#invoice-pembelian").hide();
    }

    function showInvoice() {
        $("#payment-main").hide();
        $("#invoice-main").show();
        hideDetailMenu();
    }

    function showPayment() {
        $("#payment-main").show();
        $("#invoice-main").hide();
        hideDetailMenu();
    }

    function hidePaymentAndInvoice() {
        $("#payment-main").hide();
        $("#invoice-main").hide();
    }

    function showPaymentAndInvoice() {
        $("#payment-main").show();
        $("#invoice-main").show();
    }

    function hideDetailMenu() {
        $("#payment-history").hide();
        $("#payment-history-side").hide();
        $("#invoice-customer").hide();
        $("#invoice-pembelian").hide();

    }

    function confirmData(no_surat_jalan, kode_po) {
        $("#no_surat_jalan").val(no_surat_jalan);
        $("#kode_po").val(kode_po);
        $("#form-invoice-data").submit();
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function paginationViewHTMLIn(halaman, totalHalaman, create_date, keyword, batasTampilData) { //halaman 1 total 6

        var data_load = '';
        prev = parseInt(halaman) - 1;
        next = parseInt(halaman) + 1;
        minimal_page = parseInt(halaman) - 2;
        max_page = parseInt(halaman) + 2;
        var prev_v = "dataPagingBarangHREFTrxIn('" + prev + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var next_v = "dataPagingBarangHREFTrxIn('" + next + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman1 = "dataPagingBarangHREFTrxIn('1','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman2 = "dataPagingBarangHREFTrxIn('2','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman3 = "dataPagingBarangHREFTrxIn('3','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman4 = "dataPagingBarangHREFTrxIn('4','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
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
            var onclk = "dataPagingBarangHREFTrxIn('" + i + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";

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

    function dataPagingBarangHREFTrxIn(halaman, create_date, keyword, batasTampilData) {
        $('#halaman_paging_payment_in').val(halaman)
        getHistory(create_date, keyword, batasTampilData, halaman);
    }


    function paginationViewHTMLOut(halaman, totalHalaman, create_date, keyword, batasTampilData) { //halaman 1 total 6

        var data_load = '';
        prev = parseInt(halaman) - 1;
        next = parseInt(halaman) + 1;
        minimal_page = parseInt(halaman) - 2;
        max_page = parseInt(halaman) + 2;
        var prev_v = "dataPagingBarangHREFTrxOut('" + prev + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var next_v = "dataPagingBarangHREFTrxOut('" + next + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman1 = "dataPagingBarangHREFTrxOut('1','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman2 = "dataPagingBarangHREFTrxOut('2','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman3 = "dataPagingBarangHREFTrxOut('3','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman4 = "dataPagingBarangHREFTrxOut('4','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
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
            var onclk = "dataPagingBarangHREFTrxOut('" + i + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";

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

    function dataPagingBarangHREFTrxOut(halaman, create_date, keyword, batasTampilData) {
        $('#halaman_paging_payment_out').val(halaman)
        getHistory(create_date, keyword, batasTampilData, halaman);
    }

    function paginationViewHTMLCo(halaman, totalHalaman, create_date, keyword, batasTampilData) { //halaman 1 total 6

        var data_load = '';
        prev = parseInt(halaman) - 1;
        next = parseInt(halaman) + 1;
        minimal_page = parseInt(halaman) - 2;
        max_page = parseInt(halaman) + 2;
        var prev_v = "dataPagingBarangHREFTrxCo('" + prev + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var next_v = "dataPagingBarangHREFTrxCo('" + next + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman1 = "dataPagingBarangHREFTrxCo('1','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman2 = "dataPagingBarangHREFTrxCo('2','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman3 = "dataPagingBarangHREFTrxCo('3','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman4 = "dataPagingBarangHREFTrxCo('4','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
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
            var onclk = "dataPagingBarangHREFTrxCo('" + i + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";

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

    function dataPagingBarangHREFTrxCo(halaman, create_date, keyword, batasTampilData) {
        $('#halaman_paging_invoice-co').val(halaman)
        getHistory(create_date, keyword, batasTampilData, halaman);
    }

    function paginationViewHTMLPo(halaman, totalHalaman, create_date, keyword, batasTampilData) { //halaman 1 total 6

        var data_load = '';
        prev = parseInt(halaman) - 1;
        next = parseInt(halaman) + 1;
        minimal_page = parseInt(halaman) - 2;
        max_page = parseInt(halaman) + 2;
        var prev_v = "dataPagingBarangHREFTrxPo('" + prev + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var next_v = "dataPagingBarangHREFTrxPo('" + next + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman1 = "dataPagingBarangHREFTrxPo('1','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman2 = "dataPagingBarangHREFTrxPo('2','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman3 = "dataPagingBarangHREFTrxPo('3','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman4 = "dataPagingBarangHREFTrxPo('4','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
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
            var onclk = "dataPagingBarangHREFTrxPo('" + i + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";

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

    function dataPagingBarangHREFTrxPo(halaman, create_date, keyword, batasTampilData) {
        $('#halaman_paging_invoice-po').val(halaman)
        getHistory(create_date, keyword, batasTampilData, halaman);
    }

    function paginationViewHTMLSuratJln(halaman, totalHalaman, no_surat_jalan) { //halaman 1 total 6

        var data_load = '';
        prev = parseInt(halaman) - 1;
        next = parseInt(halaman) + 1;
        minimal_page = parseInt(halaman) - 2;
        max_page = parseInt(halaman) + 2;
        var prev_v = "dataPagingBarangHREFTrxSj('" + prev + "','" + no_surat_jalan + "')";
        var next_v = "dataPagingBarangHREFTrxSj('" + next + "','" + no_surat_jalan + "')";
        var halaman1 = "dataPagingBarangHREFTrxSj('1','" + no_surat_jalan + "')";
        var halaman2 = "dataPagingBarangHREFTrxSj('2','" + no_surat_jalan + "')";
        var halaman3 = "dataPagingBarangHREFTrxSj('3','" + no_surat_jalan + "')";
        var halaman4 = "dataPagingBarangHREFTrxSj('4','" + no_surat_jalan + "')";
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
            var onclk = "dataPagingBarangHREFTrxSj('" + i + "','" + no_surat_jalan + "')";

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

    function dataPagingBarangHREFTrxSj(halaman, no_surat_jalan) {
        console.log("halaman" + halaman);
        $('#halaman_paging_no_surat_jln').val(halaman)
        invoiceCustomerPaging(no_surat_jalan);
    }

    function paginationViewHTMLKodePo(halaman, totalHalaman, kodePo) { //halaman 1 total 6

        var data_load = '';
        prev = parseInt(halaman) - 1;
        next = parseInt(halaman) + 1;
        minimal_page = parseInt(halaman) - 2;
        max_page = parseInt(halaman) + 2;
        var prev_v = "dataPagingBarangHREFTrxPo('" + prev + "','" + kodePo + "')";
        var next_v = "dataPagingBarangHREFTrxPo('" + next + "','" + kodePo + "')";
        var halaman1 = "dataPagingBarangHREFTrxPo('1','" + kodePo + "')";
        var halaman2 = "dataPagingBarangHREFTrxPo('2','" + kodePo + "')";
        var halaman3 = "dataPagingBarangHREFTrxPo('3','" + kodePo + "')";
        var halaman4 = "dataPagingBarangHREFTrxPo('4','" + kodePo + "')";
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
            var onclk = "dataPagingBarangHREFTrxPo('" + i + "','" + kodePo + "')";

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

    function dataPagingBarangHREFTrxPo(halaman, kodePo) {
        console.log("halaman" + halaman);
        $('#halaman_paging_kode_po').val(halaman)
        invoicePembelianPaging(kodePo);
    }

</script>