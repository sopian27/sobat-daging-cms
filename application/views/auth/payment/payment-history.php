<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <hr style="width: 1570px;margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    <div class="container-fluid">
        <form method="post" action="<?php echo site_url() ?>/paymenthistory" name="form-payment-history" id="form-payment-history">
            <div class="row">
                <div class="col-md-2 offset-md-1">
                    <input type="text" id="search" name="search" placeholder="search..." class="form-search">
                </div>
                <div class="col-md-2 offset-md-6">
                    <input type="text" id="create_date" name="create_date" class="form-search" placeholder="sort...">
                </div>
            </div>
        </form>
    </div>
    <div class="container-fluid" style="margin-top:40px" id="payment-main">
        <div class="row justify-content-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-1 offset-md-1">
                        <div>
                            <a class="form-control-button btn" style="background-color: #a5662f;border:none;padding:10px"> Payment </a>
                        </div>
                        <div style="margin-top:30px">
                            <a class="form-control-button btn btn-outline-light button-action" style="padding:10px" onclick="showInvoice();"> Invoice </a>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-1">
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">PIP-0001/01/01/22</label>
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
                    <div class="col-md-3 offset-md-2" >
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
                            <tbody>
                        </table>
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
                            <tbody>
                        </table>
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
                            <a class="form-control-button btn" style="background-color: #a5662f;border:none;padding:10px" > Invoice </a>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-1">
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">PIP-0001/01/01/22</label>
                            <h4 id="invoice-main-title"></h4>
                        </div>
                    </div>
                    <div class="col-md-3 offset-md-2" >
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
                            <tbody>
                        </table>
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
                            <tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="margin-top: 40px;">
        <div class="row justify-content-center offset-md-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 offset-md-2" id="payment-history">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="display: none;" id="invoice-customer">
        <div class="row justify-content-center">
            <div class="container">
                <form method="post" action="<?php echo site_url()?>/payment-invoice-customer-print-preview" 
                      name="form-invoice-customer-data" id="form-invoice-customer-data">
                    <div class="row">
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
                                    <label for="" class="col-sm-3 col-form-label" >Nomor Hp </label>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-4">
                                        <label for="" class="col-form-label" id="no_hp"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label" >Alamat Pengiriman </label>
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
                                    <label for="" class="col-sm-3 col-form-label">Total Tagihan </label>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-4">
                                        <label for="" class="col-form-label" id="total_tagihan"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Bonus </label>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-4">
                                        <label for="" class="col-form-label" id="bonus"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Jatuh Tempo </label>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-4">
                                        <label for="" class="col-form-label" id="jatuh_tempo_no_surat_jln"></label>
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
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex offset-md-7" style="margin-top: 30px;">
                            <div class="col-md-2">
                                <button class="form-control-button btn btn-outline-light button-action" onclick="back();"> Back </button>
                            </div>
                            <div class="col-md-2">
                                <button class="form-control-button btn btn-outline-light button-action" > Print </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row justify-content-center" style="display: none;" id="invoice-pembelian">
        <div class="container">
            <form method="post" name="form-invoice-pembelian-data" id="form-invoice-pembelian-data">
                <div class="row">
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
                                    <label for="" class=" col-form-label" id="jatuh_tempo_kode_po"></label>
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
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex offset-md-7" style="margin-top: 20px;">
                        <div class="col-md-2">
                            <button class="form-control-button btn btn-outline-light button-action" onclick="back();"> Back </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div style="margin-top:60px"></div>
</div>

<script>

    $(document).ready(function(){
        $("#payment-in-tot").html("Rp. 0"); 
        $("#payment-out-tot").html("Rp. 0"); 
        $("#payment-tot").html("Rp. 0"); 
    });

    $("#search").keyup(function(e) {

        if (e.keyCode == 13) {
            e.preventDefault();
            submit_data();
        }
    });

    function submit_data() {
        $("#form-payment-history").submit();
    }

    $(document).on('change', '#create_date', function() {
        var create_date = document.getElementById("create_date").value;
        create_date = create_date.replaceAll("/", "");
        console.log(create_date);
        
        getHistory(create_date);
       
    });

    function show_payment_in(){
        $("#div-payment-in").show();
        $("#div-payment-out").hide();
    }

    function show_payment_out(){
        $("#div-payment-in").hide();
        $("#div-payment-out").show();
    }

    function show_invoice_co(){
        $("#div-invoice-co").show();
        $("#div-invoice-po").hide();
    }

    function show_invoice_po(){
        $("#div-invoice-co").hide();
        $("#div-invoice-po").show();
    }

    $(function() {
        $("#create_date").datepicker({
            todayHighlight: true,
            format: "yyyymm",
            startView: "months",
            minViewMode: "months",
            autoclose: true
        })

        $("#create_date").val("sort by month....");
    });

    function getHistory(date) {

        $.ajax({
            url: '<?= site_url() ?>/payment-history/gethistory',
            method: 'post',
            dataType: 'json',
            data: {
                create_date: date
            },
            success: function(data) {

                console.log(data);
                if(data.payin.length > 0){
                    setdatapaymentin(data);
                }else{
                    $("#tbody-payment-in").html("");
                }

                if(data.payout.length > 0){
                    setdatapaymentout(data);
                }else{
                    $("#tbody-payment-in").html("");
                }

                if(data.payco.length > 0){
                    setdatainvoiceco(data);
                }else{
                    $("#tbody-invoice-co").html("");
                }

                if(data.paypo.length > 0){
                    setdatainvoicepo(data);
                }else{
                    $("#tbody-invoice-po").html("");
                }

            
                $("#payment-in-tot").html("Rp. "+numberWithCommas((data.payintot.length > 0) ? data.payintot[0].total : 0)); 
                $("#payment-out-tot").html("Rp. "+numberWithCommas((data.payouttot.length > 0) ? data.payouttot[0].total : 0)); 
                $("#payment-tot").html("Rp. "+numberWithCommas(parseFloat((data.payintot.length > 0) ? data.payintot[0].total : 0) - parseFloat((data.payouttot.length > 0) ? data.payouttot[0].total : 0))); 
                
                paymentMainTitle(getMonthOnly(date));
                invoiceMainTitle(getMonthOnly(date));

            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }

    function setdatapaymentin(data){

        var dataLoad="";
       
            for(let i=0;i<data.payin.length;i++){

                var functionOnclick = 'loadHistoryPayment("' + data.payin[i].no_invoice + '")';

                dataLoad += "<tr>";
                dataLoad += "<td>";
                dataLoad += data.payin[i].no_invoice;
                dataLoad += "</td>";
                dataLoad += "<td>";
                dataLoad += data.payin[i].nama.toUpperCase();
                dataLoad += "</td>";
                dataLoad += "<td>";
                dataLoad += dateForShow(data.payin[i].tgl_pembayaran);
                dataLoad += "</td>";
                dataLoad += "<td>";
                dataLoad += "<a href='#' onclick=" + functionOnclick + "><span>Detail</span></a>";
                dataLoad += "</td>";
                dataLoad += "</tr>";
            }

        $("#tbody-payment-in").html(dataLoad);
           
    }

    function setdatapaymentout(data){

        var dataLoad="";

            for(let i=0;i<data.payout.length;i++){

                var functionOnclick = 'loadHistoryPaymentOut("' + data.payout[i].no_invoice + '")';

                dataLoad += "<tr>";
                dataLoad += "<td>";
                dataLoad += data.payout[i].no_invoice;
                dataLoad += "</td>";
                dataLoad += "<td>";
                dataLoad += data.payout[i].nama.toUpperCase();
                dataLoad += "</td>";
                dataLoad += "<td>";
                dataLoad += dateForShow(data.payout[i].tgl_pembayaran);
                dataLoad += "</td>";
                dataLoad += "<td>";
                dataLoad += "<a href='#' onclick=" + functionOnclick + "><span>Detail</span></a>";
                dataLoad += "</td>";
                dataLoad += "</tr>";
            }

        $("#tbody-payment-out").html(dataLoad);

    }

    function setdatainvoiceco(data){

        var dataLoad="";

        for(let i=0;i<data.payco.length;i++){

            var functionOnclick = 'getHistorySuratJalan("' + data.payco[i].no_surat_jalan + '")';

            dataLoad += "<tr>";
            dataLoad += "<td>";
            dataLoad += data.payco[i].no_surat_jalan;
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += data.payco[i].nama.toUpperCase();
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += data.payco[i].no_invoice;
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += "<a href='#' onclick=" + functionOnclick + "><span>Detail</span></a>";
            dataLoad += "</td>";
            dataLoad += "</tr>";
        }

        $("#tbody-invoice-co").html(dataLoad);

    }

    function setdatainvoicepo(data){

        var dataLoad="";

        for(let i=0;i<data.paypo.length;i++){

            var functionOnclick = 'getHistoryKodePo("' + data.paypo[i].id_trx_po + '")';

            dataLoad += "<tr>";
            dataLoad += "<td>";
            dataLoad += data.paypo[i].kode+" "+data.paypo[i].id_trx_po;
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += data.paypo[i].nama.toUpperCase();
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += data.paypo[i].no_invoice;
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += "<a href='#' onclick=" + functionOnclick + "><span>Detail</span></a>";
            dataLoad += "</td>";
            dataLoad += "</tr>";
        }

        $("#tbody-invoice-po").html(dataLoad);

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

        return day + " " + month +" "+year;
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

    function paymentMainTitle(month){
        $("#payment-main-title").html("History Payment Bulan "+month);
    }

    function invoiceMainTitle(month){

        $("#invoice-main-title").html("History Invoice Bulan "+month);
    }

    function hideDataSuratJln(){
        $("#invoice-customer").hide();
    }

    function hideDataKodePo(){
        $("#invoice-pembelian").hide();
    }

    function showDataSuratJln(){
        $("#invoice-customer").show();
    }

    function showDataKodePo(){
        $("#invoice-pembelian").show();
    }

    function getHistoryKodePo(id_trx_po) {

        var kode_po = id_trx_po;

        $.ajax({
            url: '<?= site_url() ?>/payment-history/gethistorykodepo',
            method: 'post',
            dataType: 'json',
            data: {
                kode_po: kode_po
            },
            success: function(data) {

                var dataLoad="";
                console.log(data);
                
                if(data.data_kode_po.length > 0){

                    $("#kode_po").html(data.data_kode_po[0].id_trx_po);
                    $("#pembelian_dari").html(data.data_kode_po[0].nama);
                    $("#tgl_pembelian").html(dateForShow(data.data_kode_po[0].create_date));
                    $("#jatuh_tempo_kode_po").html(dateForShow(data.data_kode_po[0].jatuh_tempo));
                    $("#total_tagihan_kode_po").html("Rp. "+numberWithCommas(data.sum_total[0].total));
                    $("#total_tagihan_value_po").val(data.sum_total[0].total);
                    $("#no_invoice_kode_po").val(data.data_kode_po[0].no_invoice);

                    for(let i=0;i<data.data_kode_po.length;i++){

                        var result = parseFloat(data.data_kode_po[i].harga_satuan) * parseFloat(data.data_kode_po[i].quantity_check);

                        dataLoad += "<tr>";
                        dataLoad += "<td >";
                        dataLoad += data.data_kode_po[i].kode;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += data.data_kode_po[i].nama_barang;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += data.data_kode_po[i].quantity + " "+ data.data_kode_po[i].satuan;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += data.data_kode_po[i].quantity_check+ " "+ data.data_kode_po[i].satuan;
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
                    $("#tbody-table-data_kode_po").html(dataLoad);
                    showDataKodePo();

                }else{

                    hideDataKodePo();
                }
                
            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });

    }
    
    function getHistorySuratJalan(no_surat_jalan) {

        $.ajax({
            url: '<?= site_url() ?>/payment-history/gethistorysuratjalan',
            method: 'post',
            dataType: 'json',
            data: {
                no_surat_jalan: no_surat_jalan
            },
            success: function(data) {

                var dataLoad="";

                if(data.data_surat_jln.length > 0){

                    $("#no_surat_jalan").val(no_surat_jalan);
                    $("#nomor_invoice").html(data.data_surat_jln[0].no_invoice);
                    $("#nama_pelanggan").html(data.data_surat_jln[0].nama_pelanggan.toUpperCase());
                    $("#no_hp").html(data.data_surat_jln[0].nomor_hp1);
                    $("#alamat_pengiriman").html(data.data_surat_jln[0].alamat1);
                    $("#tgl_pengiriman").html(dateForShow(data.data_surat_jln[0].tgl_pengiriman));
                    $("#total_tagihan").html("Rp. "+numberWithCommas(data.sum_total[0].total));
                    $("#total_tagihan_value").html(data.sum_total[0].total);
                    $("#bonus").html("Rp. "+numberWithCommas(data.data_surat_jln[0].bonus));
                    $("#jatuh_tempo_no_surat_jln").html(dateForShow(data.data_surat_jln[0].jatuh_tempo));
                    $("#bank_tujuan").html(data.data_surat_jln[0].bank_tujuan);
                    $("#atas_nama").html(data.data_surat_jln[0].atas_nama.toUpperCase());
                    $("#no_rekening").html(data.data_surat_jln[0].no_rekening);
                    $("#total_tagihan_value").html(data.sum_total[0].total);
                    $("#total_tagihan_value").html(data.sum_total[0].total);

                    for(let i=0;i<data.data_surat_jln.length;i++){

                        var result = parseFloat(data.data_surat_jln[i].harga_satuan) * parseFloat(data.data_surat_jln[i].quantity);

                        dataLoad += "<tr>";
                        dataLoad += "<td >";
                        dataLoad += data.data_surat_jln[i].kode;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += data.data_surat_jln[i].nama_barang;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += data.data_surat_jln[i].quantity + " "+ data.data_surat_jln[i].satuan;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += data.data_surat_jln[i].bungkusan;
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += "Rp. " + numberWithCommas(data.data_surat_jln[i].harga_satuan);
                        dataLoad += "</td>";
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += "Rp. " + numberWithCommas(result);
                        dataLoad += "</td>";
                        dataLoad += "</td>";
                        dataLoad += "</tr>";
                    }
                    
                    hidePaymentAndInvoice();
                    $("#tbody-table-data-no_surat_jln").html(dataLoad);
                    showDataSuratJln();

                }else{

                    hideDataSuratJln();
                }

            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }

    function backToHistory(){
       location.reload();
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

                $("#payment-history").html("");
                var dataload = "";
                dataload += '<div class="form-group row" style="margin-top:30px">' +
                    '<label for="" class="col-sm-3 col-form-label">Nomor Invoice </label>' +
                    '<div class="col-sm-1">:</div>' +
                    '<div class="col-sm-4">' +
                    '<label>' + no_invoice + '</label>' +
                    '</div>' +
                    '</div>';
                dataload += '<a style="color:white;" data-bs-toggle="collapse" ';
                dataload += 'href="#collapseExample">Pembayaran Sebelumnya (-)</a>';
                dataload += '<hr style="border-width: 2px;border-style: solid;border-color:white">';

                if (data.length > 0) {

                    for (i = 0; i < data.length; i++) {

                        var sisa = parseFloat(data[i].harga_total) - parseFloat(data[i].nominal_bayar);
                        dataload += '<div class="collapse" id="collapseExample">';
                        dataload += '<hr style="width: 275px;border-width: 2px;border-style: solid;border-color:white">' +
                            '<div style="font-size: 14px;">' +
                            '<div class="form-group row">' +
                            '<label for="" class="col-sm-6 col-form-label">Nama Pelanggan </label>' +
                            '<div class="col-sm-1">:</div>' +
                            '<div class="col-sm-4">' +
                            '<label >' + data[i].nama_pelanggan.toUpperCase() + '</label>' +
                            '</div>' +
                            '</div>';

                        dataload += '<div class="form-group row" style="margin-top: 10px;">' +
                            '<label for="" class="col-sm-6 col-form-label">Total Tagihan </label>' +
                            '<div class="col-sm-1">:</div>' +
                            '<div class="col-sm-4">' +
                            '<label >Rp. ' + numberWithCommas(data[i].harga_total) + '</label>' +
                            '</div>' +
                            '</div>';

                        dataload += '<div class="form-group row" style="margin-top: 10px;">' +
                            '<label for="" class="col-sm-6 col-form-label">Nominal Pembayaran </label>' +
                            '<div class="col-sm-1">:</div>' +
                            '<div class="col-sm-5">' +
                            '<label>Rp. ' + numberWithCommas(data[i].nominal_bayar) + '</label>' +
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

                    dataload += '<div class="col-md-3 offset-md-3" style="margin-top:30px">' +
                        '<button class="form-control-button btn btn-outline-light button-action" onclick="back();"> Back </button>' +
                        '</div>';

                    hidePaymentAndInvoice();
                    $("#payment-history").html(dataload);
                    $("#payment-history").show();
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
            url: '<?= site_url() ?>/paymentout/loadhistory',
            method: 'post',
            dataType: 'json',
            data: {
                no_invoice: no_invoice
            },
            success: function(data) {

                console.log(data);
                $("#payment-history").html("");

                var dataload = "";
                dataload += '<div class="form-group row" style="margin-top:30px">' +
                    '<label for="" class="col-sm-3 col-form-label">No Invoice </label>' +
                    '<div class="col-sm-1">:</div>' +
                    '<div class="col-sm-4">' +
                    '<label>' + no_invoice + '</label>' +
                    '</div>' +
                    '</div>';
                dataload += '<a style="color:white;" data-bs-toggle="collapse" ';
                dataload += 'href="#collapseExample">Pembayaran Sebelumnya (-)</a>';
                dataload += '<hr style="border-width: 2px;border-style: solid;border-color:white">';

                if (data.length > 0) {

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

                        dataload += '<div class="form-group row" style="margin-top: 10px;">' +
                            '<label for="" class="col-sm-6 col-form-label">Total Tagihan </label>' +
                            '<div class="col-sm-1">:</div>' +
                            '<div class="col-sm-4">' +
                            '<label >Rp. ' + numberWithCommas(data[i].harga_total) + '</label>' +
                            '</div>' +
                            '</div>';

                        dataload += '<div class="form-group row" style="margin-top: 10px;">' +
                            '<label for="" class="col-sm-6 col-form-label">Nominal Pembayaran </label>' +
                            '<div class="col-sm-1">:</div>' +
                            '<div class="col-sm-5">' +
                            '<label>Rp. ' + numberWithCommas(data[i].nominal_bayar) + '</label>' +
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

                    dataload += '<div class="col-md-3  offset-md-3" style="margin-top:30px">' +
                        '<button class="form-control-button btn btn-outline-light button-action" onclick="back();"> Back </button>' +
                        '</div>';

                    hidePaymentAndInvoice();
                    $("#payment-history").html(dataload);
                    $("#payment-history").show();
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
    }

    function showInvoice() {
        $("#payment-main").hide();
        $("#invoice-main").show();
    }

    function showPayment() {
        $("#payment-main").show();
        $("#invoice-main").hide();
    }

    function hidePaymentAndInvoice(){
        $("#payment-main").hide();
        $("#invoice-main").hide();
    }
    
    function showPaymentAndInvoice(){
        $("#payment-main").show();
        $("#invoice-main").show();
    }

    function confirmData(no_surat_jalan,kode_po) {
        $("#no_surat_jalan").val(no_surat_jalan);
        $("#kode_po").val(kode_po);
        $("#form-invoice-data").submit();
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    
</script>