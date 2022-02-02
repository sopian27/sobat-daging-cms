<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <hr style="width: 1570px;margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    <div class="container-fluid">
        <div class="row" id="content-filter"  style="margin-top: 40px;">
            <div class="col-md-2 offset-md-1">
                <input type="text" id="search" name="search" placeholder="search..." class="form-search">
            </div>
            <div class="col-md-2 offset-md-6">
                <input type="text" id="create_date" name="create_date" class="form-search" placeholder="sort...">
            </div>
        </div>
        <div class="row" style="margin-top: 60px;display:none" id="content-header">
            <div class="col-md-3 offset-md-1">
                <div class="form-group row">
                    <label for="" class="col-sm-6 col-form-label" style="margin-top: -7px;" id="trx-ap"> </label>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-5 col-form-label" style="margin-top: -7px;"><b>Sobat Daging</b></label>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-5 col-form-label" style="margin-top: -7px;" id="trx-ap-month"> </label>
                </div>
            </div>
            <div class="col-md-3 offset-md-8" style="margin-top:-110px">
                <div class="form-group row">
                    <label for="" class="col-sm-5 col-form-label" style="margin-top: -7px;">Nominal AP </label>
                    <div class="col-sm-5" id="nominal-ap"></div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-5 col-form-label" style="margin-top: -7px;">Nominal Pembayaran </label>
                    <div class="col-sm-5" id="nominal-pembayaran"></div>
                </div>
                <hr style="border-width: 2px;border-style: solid;border-color:white">
                <div class="form-group row">
                    <label for="" class="col-sm-5 col-form-label" style="margin-top: -7px;">Sisa Pembayaran </label>
                    <div class="col-sm-5" style="color:brown" id="sisa-pembayaran"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="container">
                <div class="col-md-10 offset-md-1" style="margin-top: 20px;">
                    <table class="table table-dark table-bordered data" id="mytable2">
                        <thead>
                            <tr>
                                <th colspan="14" id="table-title"></th>
                            </tr>
                            <tr>
                                <th> Pembelian Dari </th>
                                <th> Nama Barang </th>
                                <th> Kode </th>
                                <th> Quantity </th>
                                <th> Harga Satuan </th>
                                <th> Harga Total </th>
                                <th> Nomor Invoice </th>
                                <th> Tanggal Masuk </th>
                                <th> Tanggal Invoice </th>
                                <th> Jatuh Tempo </th>
                                <th> Tanggal Payment </th>
                                <th> Nominal Pembayaran </th>
                                <th> Sisa Pembayaran </th>
                                <th> S </th>
                            </tr>
                        </thead>
                        <tbody id="data-ap">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top:60px"></div>
    <form method="post" id="form-date" name="form-date" action="<?php echo base_url() ?>/ap">
        <input type="hidden" name="date_show" id="date_show">
    </form>
    <form method="post" id="form-search" name="form-search" action="<?php echo base_url() ?>/ap">
        <input type="hidden" name="data_search" id="data_search">
    </form>
</div>

<script>
    $(document).ready(function() {

        $("#mytable").DataTable({
            "language": {
                "paginate": {
                    "previous": "<",
                    "next": ">"
                }
            },searching: false, 
              //paging: false, 
              info: false,
              ordering:false
        });


        $("#nominal-ap").html(": Rp. 0");
        $("#nominal-pembayaran").html(": Rp. 0");
        $("#sisa-pembayaran").html(": Rp. 0");
        $("#table-title").html("Data AP");

    });

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


    function getMonthTrx(create_date) {
	
        var today = new Date();
        var today_date = today.getDate();

        if (today_date < 10)
            today_date =  "0" + today_date;

        //var day = create_date.substring(6, 8);
        var year = create_date.substring(0, 4);
        var month = create_date.substring(4, 6);

        return today_date + "/" + month + "/" +year;
    }

    function getMonthYear(create_date) {
	
        //var day = create_date.substring(6, 8);
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

        return month + " " +year;
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


    $(document).on('change', '#create_date', function() {
        var create_date = document.getElementById("create_date").value;
        //$("#date_show").val(create_date.replaceAll("/", ""));
        //$("#form-date").submit();
        getData(create_date);

    });

    $("#search").keyup(function(e) {

        if (e.keyCode == 13) {
            e.preventDefault();

            var search = document.getElementById("search").value;
            $("#data_search").val(search);

            $("#form-search").submit();

        }

    });

    function getData(date) {

        $.ajax({
            url: '<?= site_url() ?>/ap/getdatabydate',
            method: 'post',
            dataType: 'json',
            data: {
                date_show: date
            },
            success: function(response) {

                var dataLoad = "";
                var total = 0;
                console.log(response);

                if (response.result != undefined) {
                    for (let i = 0; i < response.rptobj.length; i++) {

                        var isFinished = "";
                        if (parseFloat(response.rptobj[i].nominal_bayar) > 0) {
                            isFinished = "P";
                        } else {
                            isFinished = "F";
                        }

                        dataLoad += "<tr>";
                        dataLoad += "<td >";
                        dataLoad += response.rptobj[i].nama.toUpperCase();
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += response.rptobj[i].nama_barang;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += response.rptobj[i].kode;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += response.rptobj[i].quantity + " "+response.rptobj[i].satuan;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += numberWithCommas("Rp. "+response.rptobj[i].harga_satuan);
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += numberWithCommas("Rp. "+response.rptobj[i].harga_total);
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += response.rptobj[i].no_invoice;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += dateForShow(response.rptobj[i].tgl_masuk);
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += dateForShow(response.rptobj[i].tgl_invoice);
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += dateForShow(response.rptobj[i].jatuh_tempo);
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += dateForShow(response.rptobj[i].tgl_payment);
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += numberWithCommas("Rp. "+response.rptobj[i].nominal_bayar); 
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += numberWithCommas("Rp. "+response.rptobj[i].harga_total);
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += isFinished;
                        dataLoad += "</td>";
                        dataLoad += "</tr>";

                    }


                     

                    $("#trx-ap").html("PCPI-0001/"+getMonthTrx(date));
                    $("#trx-ap-month").html("Data AP "+getMonthYear(date));
                    $("#table-title").html("Data AP "+getMonthYear(date));

                    $("#nominal-ap").html(numberWithCommas("Rp. "+response.rptot[0].total_tagihan));
                    $("#nominal-pembayaran").html(numberWithCommas("Rp. "+response.rptot[0].nominal));

                    var sisa = parseFloat(response.rptot[0].total_tagihan) - parseFloat(response.rptot[0].nominal);

                    $("#sisa-pembayaran").html(numberWithCommas("Rp. "+sisa));

                    $("#content-filter").hide();
                    $("#content-header").show();
                    $("#data-ap").html(dataLoad);

                }

                

            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

</script>