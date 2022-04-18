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
                    <input class="form-control-paging" type="text" placeholder="search..." id="search" name="search">
                    <span class="input-group-append">
                        <button class="btn btn-outline-light" type="button" onclick="searchData()">
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
            <div class="col-md-2 offset-md-9" style="margin-top:10px;display:none" id="div-status">
                <div class="input-group">
                    <span class="input-group-append">
                        <button class="btn btn-outline-light" type="button">
                            <span>sort</span>
                        </button>
                    </span>
                    <select class="btn btn-outline-light form" name="status" id="status">
                        <option value="p">Processed</option>
                        <option value="f">Finish</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 90px;display:none" id="content-header">
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
                    <div class="col-sm-5" style="color:red" id="sisa-pembayaran"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="container">
                <div class="col-md-10 offset-md-1" style="margin-top: 20px;">
                    <table class="table table-dark table-bordered data">
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
                                <th style="color:red"> Jatuh Tempo </th>
                                <th> Tanggal Payment </th>
                                <th> Nominal Pembayaran </th>
                                <th style="color:red"> Sisa Pembayaran </th>
                                <th> S </th>
                            </tr>
                        </thead>
                        <tbody id="data-ap">
                        </tbody>
                    </table>
                    <input type="hidden" name="halaman_paging" id="halaman_paging" value="1">
                    <div class="pagination-result" style="margin-top:10px;margin-left:45%"></div>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top:60px"></div>
</div>

<script>
    $(document).ready(function() {
        /*
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

        */

        $("#nominal-ap").html(": Rp. 0");
        $("#nominal-pembayaran").html(": Rp. 0");
        $("#sisa-pembayaran").html(": Rp. 0");
        $("#table-title").html("Data AP");

    });

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

    $(document).on('change', '#create_date', function() {
        var create_date = document.getElementById("create_date").value;

        var batasTampilData = 25;
        $("#halaman_paging").val("1");
        var halaman = $('#halaman_paging').val();
        var keyword = $("#search").val();
        getData(create_date.replaceAll("-", ""), keyword, batasTampilData, halaman);

    });

    function searchData() {

        var batasTampilData = 25;
        $("#halaman_paging").val("1");
        var halaman = $('#halaman_paging').val();
        var keyword = $("#search").val();
        var create_date = document.getElementById("create_date").value;
        getData(create_date.replaceAll("-", ""), keyword, batasTampilData, halaman);

    }

    function getData(create_date, keyword, batasTampilData, halaman) {

        $.ajax({
            url: '<?= site_url() ?>/ap/getdata',
            method: 'post',
            dataType: 'json',
            data: {
                'create_date': create_date.trim(),
                'halaman': halaman,
                'keyword': keyword,
                'batastampil': batasTampilData
            },
            success: function(response) {

                var dataLoad = "";
                var total = 0;
                var nama_supplier="";
                var no_invoice="";
                var tgl_masuk="";
                var tgl_invoice="";
                var tgl_payment="";
                var nominal_pembayaran="";
                var sisa_pembayaran="";
                var status="";

                console.log(response);

                if (response.length > 0) {
                    for (let i = 0; i < response.rptobj.length; i++) {

                        var isFinished = "";
                        if (parseFloat(response.rptobj[i].total_tagihan) > 0) {
                            isFinished = "P";
                        } else {
                            isFinished = "F";
                        }

                        var tgl_payment="";
                        if(response.rptobj[i].tgl_payment==null ||response.rptobj[i].tgl_payment==""){
                            tgl_payment="-"
                        }else{
                            tgl_payment = dateForShow(response.rptobj[i].tgl_payment);
                        }

                       
                        dataLoad += "<tr>";
                        dataLoad += "<td >";
                        //dataLoad += response.rptobj[i].nama.toUpperCase();
                        if(i == 0 ){
                            dataLoad +=response.rptobj[i].nama.toUpperCase();
                            nama_supplier = response.rptobj[i].nama;
                        }else if(i > 0 && nama_supplier.trim()===response.rptobj[i].nama.trim()){
                            dataLoad += "";
                        }else if(i > 0 && nama_supplier != response.rptobj[i].nama){
                            dataLoad +=response.rptobj[i].nama.toUpperCase();
                            nama_supplier = response.rptobj[i].nama;
                        }

                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad +=response.rptobj[i].nama_barang;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += response.rptobj[i].kode;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += response.rptobj[i].quantity + " " + response.rptobj[i].satuan;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += numberWithCommas("Rp. " + response.rptobj[i].harga_satuan);
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += numberWithCommas("Rp. " + response.rptobj[i].harga_total);
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        //dataLoad += response.rptobj[i].no_invoice;
                        if(i == 0 ){
                            dataLoad +=response.rptobj[i].no_invoice.toUpperCase();
                            no_invoice = response.rptobj[i].no_invoice;
                        }else if(i > 0 && no_invoice.trim()===response.rptobj[i].no_invoice.trim()){
                            dataLoad += "";
                        }else if(i > 0 && no_invoice != response.rptobj[i].no_invoice){
                            dataLoad +=response.rptobj[i].no_invoice.toUpperCase();
                            no_invoice = response.rptobj[i].no_invoice;
                        }
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += dateForShow(response.rptobj[i].tgl_masuk);
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += dateForShow(response.rptobj[i].tgl_invoice);
                        dataLoad += "</td>";
                        dataLoad += "<td style='color:red'>";
                        dataLoad += dateForShow(response.rptobj[i].jatuh_tempo);
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += tgl_payment;
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        //if(response.rptobj[i].nominal_bayar==null || response.rptobj[i].nominal_bayar==""){
                            dataLoad += numberWithCommas("Rp. " + response.rptobj[i].nominal_bayar);
                        //}else{
                          //  dataLoad += numberWithCommas("Rp. " + response.rptobj[i].nominal_bayar);
                        //}
                        dataLoad += "</td>";
                        dataLoad += "<td  style='color:red'>";
                        dataLoad += numberWithCommas("Rp. " + response.rptobj[i].sisa_pembayaran);
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += isFinished;
                        dataLoad += "</td>";
                        dataLoad += "</tr>";

                    }

                    var totalDataBarang = response.length_paging;
                    var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

                    $('.pagination-result').html(paginationViewHTML(halaman, totalHalaman, create_date, keyword, batasTampilData));

                    if (create_date != 'Januari, Februari, Maret....') {
                        
                        $("#trx-ap").html("PCPI-0001/" + getMonthTrx(create_date));
                        $("#trx-ap-month").html("Data AP " + getMonthYear(create_date));
                        $("#table-title").html("Data AP " + getMonthYear(create_date));

                    }else{
                        $("#trx-ap").html("PCPI-0001");
                        $("#trx-ap-month").html("Data AR");
                        $("#table-title").html("Data AR");
                    }

                    $("#nominal-ap").html(numberWithCommas("Rp. " + response.rptot[0].total_tagihan));
                    $("#nominal-pembayaran").html(numberWithCommas("Rp. " + response.rptot[0].nominal));

                    var sisa = parseFloat(response.rptot[0].total_tagihan) - parseFloat(response.rptot[0].nominal);

                    $("#sisa-pembayaran").html(numberWithCommas("Rp. " + sisa));

                    $("#content-filter").hide();
                    $("#content-header").show();
                    $("#data-ap").html(dataLoad);

                } else {

                    $('.pagination-result').html("");
                    $("#data-ap").html("");
                    $("#nominal-ap").html("");
                    $("#nominal-pembayaran").html("");
                    $("#sisa-pembayaran").html("");

                }



            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }

    function getMonthTrx(create_date) {

        var today = new Date();
        var today_date = today.getDate();

        if (today_date < 10)
            today_date = "0" + today_date;

        //var day = create_date.substring(6, 8);
        var year = create_date.substring(0, 4);
        var month = create_date.substring(4, 6);

        return today_date + "/" + month + "/" + year;
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

        return month + " " + year;
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

    $("#search").keyup(function(e) {

        if (e.keyCode == 13) {
            e.preventDefault();

            var search = document.getElementById("search").value;
            $("#data_search").val(search);

            $("#form-search").submit();

        }

    });

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function paginationViewHTML(halaman, totalHalaman, create_date, keyword, batasTampilData) { //halaman 1 total 6

        var data_load = '';
        prev = parseInt(halaman) - 1;
        next = parseInt(halaman) + 1;
        minimal_page = parseInt(halaman) - 2;
        max_page = parseInt(halaman) + 2;
        var prev_v = "dataPagingBarangHREFTrx('" + prev + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var next_v = "dataPagingBarangHREFTrx('" + next + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman1 = "dataPagingBarangHREFTrx('1','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman2 = "dataPagingBarangHREFTrx('2','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman3 = "dataPagingBarangHREFTrx('3','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman4 = "dataPagingBarangHREFTrx('4','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
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
            var onclk = "dataPagingBarangHREFTrx('" + i + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";

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

    function dataPagingBarangHREFTrx(halaman, create_date, keyword, batasTampilData) {
        $('#halaman_paging').val(halaman)
        getData(create_date, keyword, batasTampilData, halaman);
    }
</script>