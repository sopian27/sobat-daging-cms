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
        <div class="col-5 col-md-4 col-lg-3">
            <div class="input-group">
                <input class="form-control-paging" type="text" placeholder="search..." id="search" name="search">
                <span class="input-group-append">
                    <button class="btn btn-outline-light" type="button" onclick="searchData()">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </div>
        <div class="col-6 offset-1 col-md-4 offset-md-4 col-lg-3 offset-lg-6">
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

    <div class="row mt-5 justify-content-center" id="mutasi-masuk">
        <div class="row">
            <div class="col-12 col-md-3 col-lg-2">
                <div>
                    <a class="form-control-button btn" style="background-color: #B89874;border:none;padding:10px"> Mutasi Masuk </a>
                </div>
                <div class="mt-3">
                    <a class="form-control-button btn btn-outline-light button-action" style="padding:10px" onclick="mutasiKeluar();"> Mutasi Keluar </a>
                </div>
            </div>
        </div>
        <div class="row mt-5 justify-content-center">
            <div class="col-12 col-md-6 justify-content-center">
                <div class="table-responsive">
                    <table class="table table-dark table-bordered data">
                        <thead>
                            <tr>
                                <th colspan="5" id="mutasi-masuk-title"></th>
                            </tr>
                            <tr>
                                <th> Nama Pelanggan </th>
                                <th> Nomor Invoice </th>
                                <th> Jatuh Tempo </th>
                                <th> Nominal </th>
                                <th> S </th>
                            </tr>
                        </thead>
                        <tbody id="mutasi-masuk-data">
                        </tbody>
                    </table>
                </div>
                <input type="hidden" name="halaman_paging_mutasi_masuk" id="halaman_paging_mutasi_masuk" value="1">
                <div class="row">
                    <div class="pagination-result-mutasi-masuk offset-7"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5 justify-content-center" style="display: none;" id="mutasi-keluar">
        <div class="row">
            <div class="col-12 col-md-3 col-lg-2">
                <div>
                    <a class="form-control-button btn btn-outline-light button-action" onclick="mutasiMasuk();"> Mutasi Masuk </a>
                </div>
                <div class="mt-3">
                    <a class="form-control-button btn" style="background-color: #B89874;border:none;padding:10px"> Mutasi Keluar </a>
                </div>
            </div>
        </div>
        <div class="row mt-5 justify-content-center ">
            <div class="col-12 col-md-6 justify-content-center">
                <div class="table-responsive">
                    <table class="table table-dark table-bordered data">
                        <thead>
                            <tr>
                                <th colspan="5" id="mutasi-keluar-title"> </th>
                            </tr>
                            <tr>
                                <th> Pembelian Dari </th>
                                <th> Nomor Invoice </th>
                                <th> Jatuh Tempo </th>
                                <th> Nominal </th>
                                <th> S </th>
                            </tr>
                        </thead>
                        <tbody id="mutasi-keluar-data">
                        </tbody>
                    </table>
                </div>
                <input type="hidden" name="halaman_paging_mutasi_keluar" id="halaman_paging_mutasi_keluar" value="1">
                <div class="row">
                    <div class="pagination-result-mutasi-keluar offset-7"></div>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top:60px"></div>
</div>

<script>
    $(document).ready(function() {
        $("#mutasi-keluar-title").html("Data Mutasi Keluar");
        $("#mutasi-masuk-title").html("Data Mutasi Masuk");
    });

    function mutasiKeluar() {
        $("#mutasi-masuk").hide();
        $("#mutasi-keluar").show();
    }

    function mutasiMasuk() {
        $("#mutasi-masuk").show();
        $("#mutasi-keluar").hide();
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

    $(document).on('change', '#create_date', function() {
        var create_date = document.getElementById("create_date").value;

        var batasTampilData = 10;
        var halaman = $('#halaman_paging_mutasi_masuk').val();
        var keyword = $("#search").val();
        //$("#search").val("");
        initPaging();
        getDataMutasi(create_date.replaceAll("-", ""), keyword, batasTampilData, halaman);

    });

    function initPaging() {

        $("#halaman_paging_mutasi_masuk").val("1");
        $("#halaman_paging_mutasi_keluar").val("1");
    }


    function searchData() {

        var batasTampilData = 10;
        var halaman = $('#halaman_paging_mutasi_masuk').val();
        var keyword = $("#search").val();
        var create_date = document.getElementById("create_date").value;
        //$("#create_date").val("");
        getDataMutasi(create_date.replaceAll("-", ""), keyword, batasTampilData, halaman);

    }

    function getDataMutasi(create_date, keyword, batasTampilData, halaman) {
        $.ajax({
            url: '<?= site_url() ?>/data-mutasi/get-data',
            method: 'post',
            dataType: 'json',
            data: {
                'create_date': create_date,
                'halaman': halaman,
                'keyword': keyword,
                'batastampil': batasTampilData
            },
            success: function(response) {

                var dataLoad = "";
                var total = 0;
                console.log(response);

                $("#mutasi-masuk-title").html("Data Mutasi Masuk " + getMonthOnly(create_date))
                if (response.length_in > 0) {

                    setMutasiMasuk(response, create_date, keyword, halaman, batasTampilData);

                } else {
                    $("#mutasi-masuk-data").html("");
                    $('.pagination-result-mutasi-masuk').html("");
                }

                $("#mutasi-keluar-title").html("Data Mutasi Keluar " + getMonthOnly(create_date))
                if (response.length_out > 0) {

                    setMutasiKeluar(response, create_date, keyword, halaman, batasTampilData);

                } else {
                    $("#mutasi-keluar-data").html("");
                    $('.pagination-result-mutasi-keluar').html("");
                }

            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }

    function setMutasiMasuk(response, create_date, keyword, halaman, batasTampilData) {

        dataLoad = "";
        var nama_supplier = "";
        for (let i = 0; i < response.length_in; i++) {

            var isFinished = "";
            if (parseFloat(response.data_in[i].sisa_pembayaran) > 0) {
                isFinished = "P";
            } else {
                isFinished = "F";
            }

            dataLoad += "<tr>";
            dataLoad += "<td >";
            dataLoad += response.data_in[i].nama.toUpperCase();
            dataLoad += "</td>";
            dataLoad += "<td >";
            dataLoad += response.data_in[i].no_invoice;
            dataLoad += "</td>";
            dataLoad += "<td >";
            dataLoad += dateForShow(response.data_in[i].jatuh_tempo);
            dataLoad += "</td>";
            dataLoad += "<td >";
            if (response.data_in[i].nominal_bayar == null || response.data_in[i].nominal_bayar == "") {
                dataLoad += numberWithCommas("Rp. " + response.data_in[i].total_tagihan);
            } else {
                dataLoad += numberWithCommas("Rp. " + response.data_in[i].nominal_bayar);
            }
            dataLoad += "</td>";
            dataLoad += "<td >";
            dataLoad += isFinished;
            dataLoad += "</td>";
            dataLoad += "</tr>";

        }

        var totalDataBarang = response.length_in_paging;
        var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

        $('.pagination-result-mutasi-masuk').html(paginationViewHTMLMasuk(halaman, totalHalaman, create_date, keyword, batasTampilData));
        $("#mutasi-masuk-data").html(dataLoad);

    }

    function setMutasiKeluar(response, create_date, keyword, halaman, batasTampilData) {

        dataLoad = "";

        for (let i = 0; i < response.length_out; i++) {

            var isFinished = "";
            if (parseFloat(response.data_out[i].sisa_pembayaran) > 0) {
                isFinished = "P";
            } else {
                isFinished = "F";
            }

            dataLoad += "<tr>";
            dataLoad += "<td >";
            dataLoad += response.data_out[i].nama.toUpperCase();
            dataLoad += "</td>";
            dataLoad += "<td >";
            dataLoad += response.data_out[i].no_invoice;
            dataLoad += "</td>";
            dataLoad += "<td >";
            dataLoad += dateForShow(response.data_out[i].jatuh_tempo);
            dataLoad += "</td>";
            dataLoad += "<td >";
            if (response.data_out[i].nominal_bayar == null || response.data_out[i].nominal_bayar == "") {
                dataLoad += numberWithCommas("Rp. " + response.data_out[i].total_tagihan);
            } else {
                dataLoad += numberWithCommas("Rp. " + response.data_out[i].nominal_bayar);
            }
            dataLoad += "</td>";
            dataLoad += "<td >";
            dataLoad += isFinished;
            dataLoad += "</td>";
            dataLoad += "</tr>";

        }

        var totalDataBarang = response.length_out_paging;
        var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

        $('.pagination-result-mutasi-keluar').html(paginationViewHTMLKeluar(halaman, totalHalaman, create_date, keyword, batasTampilData));
        $("#mutasi-keluar-data").html(dataLoad);

    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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

        console.log("month" + month);

        return month;
    }

    function paginationViewHTMLMasuk(halaman, totalHalaman, create_date, keyword, batasTampilData) { //halaman 1 total 6

        var data_load = '';
        prev = parseInt(halaman) - 1;
        next = parseInt(halaman) + 1;
        minimal_page = parseInt(halaman) - 2;
        max_page = parseInt(halaman) + 2;
        var prev_v = "dataPagingBarangHREFTrxMasuk('" + prev + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var next_v = "dataPagingBarangHREFTrxMasuk('" + next + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman1 = "dataPagingBarangHREFTrxMasuk('1','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman2 = "dataPagingBarangHREFTrxMasuk('2','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman3 = "dataPagingBarangHREFTrxMasuk('3','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman4 = "dataPagingBarangHREFTrxMasuk('4','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
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
            var onclk = "dataPagingBarangHREFTrxMasuk('" + i + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";

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

    function dataPagingBarangHREFTrxMasuk(halaman, create_date, keyword, batasTampilData) {
        $('#halaman_paging_mutasi_masuk').val(halaman)
        getDataMutasi(create_date, keyword, batasTampilData, halaman);
    }

    function paginationViewHTMLKeluar(halaman, totalHalaman, create_date, keyword, batasTampilData) { //halaman 1 total 6

        var data_load = '';
        prev = parseInt(halaman) - 1;
        next = parseInt(halaman) + 1;
        minimal_page = parseInt(halaman) - 2;
        max_page = parseInt(halaman) + 2;
        var prev_v = "dataPagingBarangHREFTrxKeluar('" + prev + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var next_v = "dataPagingBarangHREFTrxKeluar('" + next + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman1 = "dataPagingBarangHREFTrxKeluar('1','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman2 = "dataPagingBarangHREFTrxKeluar('2','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman3 = "dataPagingBarangHREFTrxKeluar('3','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman4 = "dataPagingBarangHREFTrxKeluar('4','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
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
            var onclk = "dataPagingBarangHREFTrxKeluar('" + i + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";

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

    function dataPagingBarangHREFTrxKeluar(halaman, create_date, keyword, batasTampilData) {
        $('#halaman_paging_mutasi_keluar').val(halaman)
        getDataMutasi(create_date, keyword, batasTampilData, halaman);
    }
</script>