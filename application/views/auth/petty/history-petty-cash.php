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

    <div class="container-fluid" id="data-trigger">
        <div class="row justify-content-center">
            <div class="container">
                <div class="row" style="margin: 30px;">
                    <div class="text-center col-md-6 offset-md-3">
                        <h4 id="data-trigger-title">History Petty Cash</h4>
                        <hr>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-4 offset-md-2" style="margin-top: 20px;">
                        <table class="table table-dark table-borderless" style="border: none;width:50%; ">
                            <thead>
                            </thead>
                            <tbody id="data-trigger-content">
                            <tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="data-content" style="display: none;">
        <div class="row justify-content-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 offset-md-1" style="margin-top: 30px;">
                        <div>
                            <h5 id="data-content-title"></h5>
                        </div>
                    </div>
                    <div class="col-md-3 offset-md-4" style="margin-top: 30px;">
                        <div class="form-group row">
                            <label for="" class="col-sm-5 col-form-label" style="margin-top: -7px;">
                                <h5 style="color:red">Saldo Petty </h5>
                            </label>
                            <div class="col-sm-5">
                                <h5 style="color:red">:&nbsp;Rp. <span id="saldo-petty"></span></h5>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="" class="col-sm-5 col-form-label" style="margin-top: -7px;">
                                <h5>Petty In </h5>
                            </label>
                            <div class="col-sm-5">
                                <h5>:&nbsp;Rp. <span id="data-content-pettyin"></span></h5>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-5 col-form-label" style="margin-top: -7px;">
                                <h5>Petty Out </h5>
                            </label>
                            <div class="col-sm-5">
                                <h5>:&nbsp;Rp. <span id="data-content-pettyout"></span></h5>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="" class="col-sm-5 col-form-label" style="margin-top: -7px;">
                                <h5>Saldo Petty</h5>
                            </label>
                            <div class="col-sm-5">
                                <h5>:&nbsp;Rp. <span id="data-content-sum"></span></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center col-md-6" style="margin-top:20px">
                    <a href="#" style="color:white" onclick="show_petty_in();">Petty In</a> /
                    <a style="color:white" href="#" onclick="show_petty_out();">Petty Out</a>
                </div>
                <div class="row">
                    <div class="col-md-6 offset-md-3" style="margin-top: 20px;" id="div-petty-in">
                        <table class="table table-dark table-bordered data">
                            <thead>
                                <tr>
                                    <th colspan="4"><span id="data-content-title2"></span></th>
                                </tr>
                                <tr>
                                    <th colspan="3"> Petty In </th>
                                </tr>
                                <tr>
                                    <th> Kode </th>
                                    <th> Tambahan Saldo</th>
                                    <th> Keterangan </th>
                                </tr>
                            </thead>
                            <tbody id="data-petty-in">
                            </tbody>
                        </table>
                        <input type="hidden" name="halaman_paging_petty_in" id="halaman_paging_petty_in" value="1">
                        <div class="pagination-result-petty-in" style="margin-top:10px;margin-left:45%"></div>
                    </div>
                    <div class="col-md-6 offset-md-3" style="margin-top: 20px;display:none" id="div-petty-out">
                        <table class="table table-dark table-bordered data">
                            <thead>
                                <tr>
                                    <th colspan="4"><span id="data-content-title3"></span></th>
                                </tr>
                                <tr>
                                    <th colspan="3"> Petty Out </th>
                                </tr>
                                <tr>
                                    <th> Kode </th>
                                    <th> Tambahan Saldo</th>
                                    <th> Keterangan </th>
                                </tr>
                            </thead>
                            <tbody id="data-petty-out">
                            </tbody>
                        </table>
                        <input type="hidden" name="halaman_paging_petty_out" id="halaman_paging_petty_out" value="1">
                        <div class="pagination-result-petty-out" style="margin-top:10px;margin-left:45%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top: 20px;"></div>
</div>
<script>
    $(document).ready(function() {

        var today = new Date();
        var year = today.getFullYear();
        var month = today.getMonth();
        $("#data-trigger-title").html("Tahun " + year);

        loadData(year, prefixMonth(month + 1));
    });

    function prefixMonth(month) {
        if (month < 10)
            return "0" + month;
    }

    $(function() {
        $("#create_date").datepicker({
            format: "yyyy",
            weekStart: 1,
            orientation: "bottom",
            language: "{{ app.request.locale }}",
            keyboardNavigation: false,
            viewMode: "years",
            minViewMode: "years",
            autoclose: true
        })

        $("#create_date").val("...");
    });

    function show_petty_in() {
        $("#div-petty-out").hide();
        $("#div-petty-in").show();
    }

    function show_petty_out() {
        $("#div-petty-out").show();
        $("#div-petty-in").hide();
    }

    $(document).on('change', '#create_date', function() {
        var create_date = document.getElementById("create_date").value;
        create_date = create_date.replaceAll("-", "");
        //$("#data-trigger-title").html("Tahun " + dateForShow(create_date));
        $("#data-trigger-title").html("Tahun " + dateForShow(create_date));

        console.log(create_date);
        var today = new Date();
        var year = today.getFullYear();
        var month = today.getMonth();
        var keyword = $("#search").val();

        initPaging();

        $("#data-content").hide();
        $("#data-trigger").show();
        $("#search").val("");
        getData(year, prefixMonth(month + 1), create_date, keyword);

    });

    function initPaging() {

        $("#halaman_paging_petty_out").val("1");
        $("#halaman_paging_petty_in").val("1");
    }

    function searchData() {

        var batasTampilData = 10;
        var halaman = $('#halaman_paging_mutasi_masuk').val();
        var keyword = $("#search").val();
        var create_date = document.getElementById("create_date").value;
        create_date = create_date.replaceAll("-", "");

        initPaging();

        $("#data-content").hide();
        $("#data-trigger").show();

        console.log(create_date);
        var today = new Date();
        var year = today.getFullYear();
        var month = today.getMonth();

        getData(year, prefixMonth(month + 1), create_date, keyword);

    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function dateForShow(create_date) {

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

        //return year + " Bulan " + month;
        return year;
    }

    function getMonthName(year, month) {

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

        //return month + ", " + year;
        return month;
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

    function getData(current_year, current_month, date, keyword) {

        $.ajax({
            url: '<?= site_url() ?>/history-petty-cash/getdata',
            method: 'post',
            dataType: 'json',
            data: {
                "create_date": date,
                "keyword": keyword
            },
            success: function(response) {

                var dataLoad = "";
                console.log(response);

                if (response.result != undefined) {
                    for (let i = 0; i < response.data.length; i++) {

                        var obj = response.data[i];
                        var key = Object.keys(obj)[0];
                        var value = obj[Object.keys(obj)[0]];

                        var functionOnclick = 'getDetailData("' + current_year + key + '")';

                        if (current_month === key) {

                            //  dataLoad += "<tr>";
                            dataLoad += "<td ><a style='color:#B89874;' href='#' onclick='" + functionOnclick + "'>";
                            dataLoad += getMonthName(current_year, key);
                            dataLoad += "</a></td>";
                            /*
                            dataLoad += "<td>";
                            if (parseInt(value) > 0) {
                                dataLoad += "Rp. " + value;
                            } else {
                                dataLoad += "Rp. <span style='color:red'>" + value + "</span>";
                            }
                            dataLoad += "</td>";
                            */
                            //dataLoad += "</tr>";

                        } else {
                            // dataLoad += "<tr>";
                            dataLoad += "<td ><a style='color:white;' href='#' onclick='" + functionOnclick + "'>";
                            dataLoad += getMonthName(current_year, key);
                            dataLoad += "</a></td>";
                            /*
                            dataLoad += "<td>";
                            if (parseInt(value) > 0) {
                                dataLoad += "Rp. " + value;
                            } else {
                                dataLoad += "Rp. <span style='color:red'>" + value + "</span>";
                            }
                            dataLoad += "</td>";
                            */
                            //dataLoad += "</tr>";
                        }

                    }
                }

                $("#data-trigger-content").html(dataLoad);

            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }


    function loadData(current_year, current_month) {

        $.ajax({
            url: '<?= site_url() ?>/history-petty-cash/loaddata',
            method: 'post',
            dataType: 'json',
            success: function(response) {

                var dataLoad = "";

                if (response.result != undefined) {
                    for (let i = 0; i < response.data.length; i++) {

                        var obj = response.data[i];
                        var key = Object.keys(obj)[0];
                        var value = obj[Object.keys(obj)[0]];

                        var functionOnclick = 'getDetailData("' + current_year + key + '")';

                        if (current_month === key) {

                            // dataLoad += "<tr>";
                            dataLoad += "<td ><a style='color:#B89874;' href='#' onclick='" + functionOnclick + "'>";
                            dataLoad += getMonthName(current_year, key);
                            dataLoad += "</a></td>";
                            /*
                            dataLoad += "<td>";

                            if (parseInt(value) > 0) {
                                dataLoad += "Rp. " + value;
                            } else {
                                dataLoad += "Rp. <span style='color:red'>" + value + "</span>";
                            }

                            dataLoad += "</td>";
                            */
                            // dataLoad += "</tr>";

                        } else {
                            //  dataLoad += "<tr>";
                            dataLoad += "<td ><a style='color:white;' href='#' onclick='" + functionOnclick + "'>";
                            dataLoad += getMonthName(current_year, key);
                            dataLoad += "</a></td>";
                            /*
                            dataLoad += "<td>";

                            if (parseInt(value) > 0) {
                                dataLoad += "Rp. " + value;
                            } else {
                                dataLoad += "Rp. <span style='color:red'>" + value + "</span>";
                            }
                            dataLoad += "</td>";
                            */
                            // dataLoad += "</tr>";
                        }

                    }


                }

                $("#data-trigger-content").html(dataLoad);

            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }

    function getDetailData(date) {

        var batasTampilData = 10;
        var halaman = $('#halaman_paging_petty_in').val();
        getDetail(date, batasTampilData, halaman);

    }

    function getDetail(date, batasTampilData, halaman) {

        $.ajax({
            url: '<?= site_url() ?>/history-petty-cash/getdatahistory',
            method: 'post',
            dataType: 'json',
            data: {
                'create_date': date,
                'halaman': halaman,
                'batastampil': batasTampilData,
                'keyword': ''
            },
            success: function(response) {

                console.log(response);


                if (response.length_in > 0) {

                    setPettyIn(response, date, halaman, batasTampilData);

                } else {
                    $('.pagination-result-petty-in').html("");
                }

                if (response.length_out > 0) {

                    setPettyOut(response, date, halaman, batasTampilData);

                } else {
                    $('.pagination-result-petty-out').html("");
                }

                var in_tot = 0;
                var out_tot = 0;

                console.log(response.in_tot.length == 0);
                if (response.in_tot.length == 0) {
                    in_tot = 0;
                } else {
                    in_tot = response.in_tot[0].total;
                }

                if (response.out_tot.length == 0) {
                    out_tot = 0;
                } else {
                    out_tot = response.out_tot[0].total;
                }

                var result = parseFloat(in_tot) - parseFloat(out_tot);
                if (result < 0) {
                    $('#data-content-sum').css("color", "red");
                }

                $("#data-content-title").html("History Petty Cash " + getMonthOnly(date));
                $("#data-content-title2").html("History Petty Cash " + getMonthOnly(date));
                $("#data-content-title3").html("History Petty Cash " + getMonthOnly(date));
                $("#data-content-pettyin").html(numberWithCommas(in_tot));
                $("#data-content-pettyout").html(numberWithCommas(out_tot));
                $("#saldo-petty").html(numberWithCommas(response.saldo));
                $("#data-content-sum").html(numberWithCommas(result));
                $("#data-trigger-title").html("Tahun " + dateForShow(date));
                $("#data-content").show();
                $("#data-trigger").hide();

            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });


    }

    function setPettyIn(response, create_date, halaman, batasTampilData) {

        dataLoadIn = "";

        for (let i = 0; i < response.data_in.length; i++) {

            var ket = response.data_in[i].keterangan;
            if (ket == null || ket == "") {
                ket = "-";
            } else {

                ket = response.data_in[i].keterangan;
            }


            dataLoadIn += "<tr>";
            dataLoadIn += "<td >";
            dataLoadIn += response.data_in[i].id_trx_petty_cash;
            dataLoadIn += "</td>";
            dataLoadIn += "<td>";
            dataLoadIn += "Rp. " + numberWithCommas(response.data_in[i].tambahan_saldo);
            dataLoadIn += "</td>";
            dataLoadIn += "<td>";
            dataLoadIn += ket;
            dataLoadIn += "</td>";
            dataLoadIn += "</tr>";

        }

        var totalDataBarang = response.length_in_paging;
        var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

        $('.pagination-result-petty-in').html(paginationViewHTMLIn(halaman, totalHalaman, create_date, "", batasTampilData));
        $("#data-petty-in").html(dataLoadIn);

    }


    function setPettyOut(response, create_date, halaman, batasTampilData) {

        var dataLoadOut = "";

        for (let i = 0; i < response.data_out.length; i++) {


            var ket = response.data_out[i].keterangan;
            if (ket == null || ket == "") {
                ket = "-";
            } else {

                ket = response.data_out[i].keterangan;
            }


            dataLoadOut += "<tr>";
            dataLoadOut += "<td >";
            dataLoadOut += response.data_out[i].id_trx_petty_cash;
            dataLoadOut += "</td>";
            dataLoadOut += "<td>";
            dataLoadOut += "Rp. " + numberWithCommas(response.data_out[i].tambahan_saldo);
            dataLoadOut += "</td>";
            dataLoadOut += "<td>";
            dataLoadOut += ket;
            dataLoadOut += "</td>";
            dataLoadOut += "</tr>";

        }

        var totalDataBarang = response.length_out_paging;
        var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

        $('.pagination-result-petty-out').html(paginationViewHTMLOut(halaman, totalHalaman, create_date, "", batasTampilData));
        $("#data-petty-out").html(dataLoadOut);

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
        $('#halaman_paging_petty_in').val(halaman)
        getDetail(create_date, batasTampilData, halaman)
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
        $('#halaman_paging_petty_out').val(halaman)
        getDetail(create_date, batasTampilData, halaman)
    }
</script>