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

    <div class="container-fluid" style="margin-top: 40px;">
        <div class="row justify-content-center" id="form-sallary">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 offset-md-1">
                        <div>
                            <a class="form-control-button btn" style="background-color: #B89874;border:none;padding:10px"> Operational Expenses </a>
                        </div>
                        <div style="margin-top:30px">
                            <a class="form-control-button btn btn-outline-light button-action" style="padding:10px" onclick="showSallary();"> Sallary </a>
                        </div>
                    </div>
                    <div class="col-md-3 offset-md-1" style="margin-top: 30px;">
                        <div>
                            <h4 id="data-content-title"></h4>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-6" style="margin-top: 10px;display: none;" id="penggunaan-dana-div">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label" style="margin-top: -7px;">
                                <p>Penggunaan Dana Total </p>
                            </label>
                            <div class="col-sm-5">
                                <p>:&nbsp;Rp. <span id="data-content"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="display: none;" id="data-content-div">
                    <div class="col-sm-5 offset-md-4" style="margin-top: 20px;">
                        <table class="table table-dark table-bordered data">
                            <thead>
                                <tr>
                                    <th colspan="4"><span id="data-content-title2"><span></th>
                                </tr>
                                <tr>
                                    <th> Kode </th>
                                    <th> Penggunaan Dana</th>
                                    <th> Keterangan </th>
                                    <th> Bukti </th>
                                </tr>
                            </thead>
                            <tbody id="data-op">
                            </tbody>
                        </table>
                        <input type="hidden" name="halaman_paging_operational" id="halaman_paging_operational" value="1">
                        <div class="pagination-result-operational" style="margin-top:10px;margin-left:45%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center" style="display: none;" id="form-invoice-pembelian">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 offset-md-1">
                        <div>
                            <a class="form-control-button btn btn-outline-light button-action" onclick="showOperational();"> Operational Expenses </a>
                        </div>
                        <div style="margin-top:30px">
                            <a class="form-control-button btn" style="background-color: #B89874;border:none;padding:10px"> Salary </a>
                        </div>
                    </div>
                    <div class="col-md-8 offset-md-6" style="margin-top: 10px;display: none;" id="pengeluaran-gaji-minggu-div">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label" style="margin-top: -7px;">
                                <p>Pengeluaran Gaji Karyawan Minggu </p>
                            </label>
                            <div class="col-sm-5">
                                <p>:&nbsp;<span id="data-content-pengeluaran-minggu" style="margin-left:40px"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 offset-md-6" style="margin-top: 10px;display: none;" id="pengeluaran-gaji-bulan-div">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label" style="margin-top: -7px;">
                                <p>Pengeluaran Gaji Karyawan Bulan</p>
                            </label>
                            <div class="col-sm-5">
                                <p>:&nbsp;<span id="data-content-pengeluaran-bulan" style="margin-left:40px"></span></p>
                            </div>
                            <hr class="col-md-5" >
                        </div>
                    </div>
                    <div class="col-md-8 offset-md-6" style="margin-top: 10px;display: none;" id="pengeluaran-gaji-total-div">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label" style="margin-top: -7px;">
                                <p>Pengeluaran Gaji Karyawan Total</p>
                            </label>
                            <div class="col-sm-5">
                                <p>:&nbsp;<span id="data-content-pengeluaran-total" style="margin-left:40px"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center col-md-6 offset-md-1" style="margin-top:20px">
                    <a href="#" style="color:white" onclick="show_sallary_minggu();">Minggu</a> /
                    <a style="color:white" href="#" onclick="show_sallary_bulanan();">Bulan</a>
                </div>
                <div class="row">
                    <div class="col-md-6 offset-md-3" style="margin-top: 20px;" id="div-mingguan">
                        <table class="table table-dark table-bordered data">
                            <thead>
                                <tr>
                                    <th colspan="7"><span id="data-content-title4"></span></th>
                                </tr>
                                <tr>
                                    <th colspan="6"> Mingguan </th>
                                </tr>
                                <tr>
                                    <th> Kode </th>
                                    <th> Nama</th>
                                    <th> Hari </th>
                                    <th> Upah Harian </th>
                                    <th> Upah Lembur </th>
                                    <th> Total Upah </th>
                                </tr>
                            </thead>
                            <tbody id="data-minggu">
                            </tbody>
                        </table>
                        <input type="hidden" name="halaman_paging_minggu" id="halaman_paging_minggu" value="1">
                        <div class="pagination-result-minggu" style="margin-top:10px;margin-left:45%"></div>
                    </div>
                    <div class="col-md-6 offset-md-3" style="margin-top: 20px;display:none" id="div-bulanan">
                        <table class="table table-dark table-bordered data">
                            <thead>
                                <tr>
                                    <th colspan="7"><span id="data-content-title3"></span></th>
                                </tr>
                                <tr>
                                    <th colspan="6"> Bulanan </th>
                                </tr>
                                <tr>
                                    <th> Kode </th>
                                    <th> Nama</th>
                                    <th> Bulan </th>
                                    <th> Upah Bulanan </th>
                                    <th> Bonus </th>
                                    <th> Total Upah </th>
                                </tr>
                            </thead>
                            <tbody id="data-bulan">
                            </tbody>
                        </table>
                        <input type="hidden" name="halaman_paging_bulan" id="halaman_paging_bulan" value="1">
                        <div class="pagination-result-bulan" style="margin-top:10px;margin-left:45%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top:60px"></div>
    <form id="form-download" name="form-download" action="<?= site_url() ?>/history-expenses/download" target="blank" method="post">
        <input type="hidden" name="filename" id="filename" />
    </form>
</div>
<script>
    $(document).ready(function() {
        console.log("ready!");
        $("#data-content-title4").html("Salary");
        $("#data-content-title3").html("Salary");
    });

    function showSallary() {
        $("#form-sallary").hide();
        $("#form-invoice-pembelian").show();
    }

    function showOperational() {
        $("#form-sallary").show();
        $("#form-invoice-pembelian").hide();
    }

    function show_sallary_minggu() {
        $("#div-mingguan").show();
        $("#div-bulanan").hide();
    }

    function show_sallary_bulanan() {
        $("#div-mingguan").hide();
        $("#div-bulanan").show();
    }

    $(function() {
        $("#create_date").datepicker({
            todayHighlight: true,
            format: "yyyy-mm",
            startView: "months",
            minViewMode: "months",
            autoclose: true
        });

        $("#create_date").val("Januari, Februari, Maret....");
    });


    function initPaging() {

        $("#halaman_paging_operational").val("1");
        $("#halaman_paging_bulan").val("1");
        $("#halaman_paging_minggu").val("1");
    }

    $(document).on('change', '#create_date', function() {
        var create_date = document.getElementById("create_date").value;
        create_date = create_date.replaceAll("-", "");

        var batasTampilData = 10;
        var halaman = $('#halaman_paging_operational').val();
        var keyword = $("#search").val();

        initPaging();

        getDetail(create_date, keyword, batasTampilData, halaman);

    });

    function searchData() {

        var batasTampilData = 10;
        var halaman = $('#halaman_paging_operational').val();
        var keyword = $("#search").val();
        var create_date = document.getElementById("create_date").value;
        create_date = create_date.replaceAll("-", "");

        initPaging();

        getDetail(create_date, keyword, batasTampilData, halaman);

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

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function getDetail(date, keyword, batasTampilData, halaman) {

        $.ajax({
            url: '<?= site_url() ?>/history-expenses/getdata',
            method: 'post',
            dataType: 'json',
            data: {
                'create_date': date,
                'halaman': halaman,
                'batastampil': batasTampilData,
                'keyword': keyword
            },
            success: function(response) {

                var dataLoad = "";
                console.log(response);
                var total_bulan=0;
                var total_minggu=0;

                if (response.length_op > 0) {

                    setOperational(response, date, keyword, halaman, batasTampilData);

                } else {
                    $('.pagination-result-operational').html("");
                }

                if (response.length_minggu > 0) {

                    total_minggu = setMinggu(response, date, keyword, halaman, batasTampilData);

                } else {
                    $('.pagination-result-minggu').html("");
                }

                if (response.length_bulan > 0) {

                    total_bulan = setBulan(response, date, keyword, halaman, batasTampilData);


                } else {
                    $('.pagination-result-bulan').html("");
                }

                if (response.length_minggu > 0 && response.length_bulan > 0) {

                    $("#data-content-pengeluaran-total").html("Rp. "+numberWithCommas(total_bulan+total_minggu));
                    
                }


                $("#data-content-title2").html("Operational Expenses " + getMonthOnly(date));
                $("#data-content-title").html("Operational Expenses " + getMonthOnly(date));
                $("#penggunaan-dana-div").show();
                $("#pengeluaran-gaji-minggu-div").show();
                $("#pengeluaran-gaji-bulan-div").show();
                $("#pengeluaran-gaji-total-div").show();
                $("#data-content-div").show();


            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }

    function setOperational(response, create_date, keyword, halaman, batasTampilData) {

        dataLoad = "";
        var total = 0;

        for (let i = 0; i < response.data_op.length; i++) {

            var functionOnclick = 'getDetailDataOperational("' + response.data_op[i].upload_bukti + '")';

            dataLoad += "<tr>";
            dataLoad += "<td >";
            dataLoad += response.data_op[i].id_trx_ex_opt;
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += "Rp. " + numberWithCommas(response.data_op[i].penggunaan_dana);
            dataLoad += "</td>";
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += response.data_op[i].keterangan;
            dataLoad += "</td>";
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += "<span>view </span><a href='#' onclick=" + functionOnclick + " class='btn btn-payment-md'><span></span></a>";
            dataLoad += "</td>";
            dataLoad += "</tr>";

        }

        if (response.dataTot.length == 0) {
            total = 0;
        } else {
            total = numberWithCommas(response.dataTot[0].total);
        }


        var totalDataBarang = response.length_op_paging;
        var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

        $('.pagination-result-operational').html(paginationViewHTMLOp(halaman, totalHalaman, create_date, keyword, batasTampilData));
        $("#data-op").html(dataLoad);
        $("#data-content").html(total);

    }


    function setMinggu(response, create_date, keyword, halaman, batasTampilData) {

        dataLoad = "";
        var total = 0

        for (let i = 0; i < response.data_minggu.length; i++) {

            dataLoad += "<tr>";
            dataLoad += "<td >";
            dataLoad += response.data_minggu[i].id_trx;
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += response.data_minggu[i].nama;
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += response.data_minggu[i].jml_hari_kerja + " H";
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += "Rp. " + numberWithCommas(response.data_minggu[i].upah_harian);
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += "Rp. " + numberWithCommas(response.data_minggu[i].upah_lembur);
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += "Rp. " + numberWithCommas((parseFloat(response.data_minggu[i].upah_harian) *  parseFloat(response.data_minggu[i].jml_hari_kerja)) + parseInt(response.data_minggu[i].upah_lembur));
            dataLoad += "</td>";
            dataLoad += "</tr>";

        }

        for (let i = 0; i < response.data_minggu_sum.length; i++) {
            total += ((parseFloat(response.data_minggu_sum[i].upah_harian)* parseInt(response.data_minggu_sum[i].jml_hari_kerja)) + parseFloat(response.data_minggu_sum[i].upah_lembur));
        }

        var totalDataBarang = response.length_minggu_paging;
        var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

        $('.pagination-result-minggu').html(paginationViewHTMLMinggu(halaman, totalHalaman, create_date, keyword, batasTampilData));
        $("#data-minggu").html(dataLoad);
        $("#data-content-pengeluaran-minggu").html("Rp. "+numberWithCommas(total));

        return total;


    }

    function setBulan(response, create_date, keyword, halaman, batasTampilData) {

        dataLoad = "";
        var total = 0

        for (let i = 0; i < response.data_bulan.length; i++) {

            dataLoad += "<tr>";
            dataLoad += "<td >";
            dataLoad += response.data_bulan[i].id_trx;
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += response.data_bulan[i].nama;
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += getMonthOnly(response.data_bulan[i].bulan);
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += "Rp. " + numberWithCommas( response.data_bulan[i].upah_bulanan);
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += "Rp. " + numberWithCommas( response.data_bulan[i].bonus);
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += "Rp. " + numberWithCommas((parseFloat(response.data_bulan[i].upah_bulanan) +  parseFloat(response.data_bulan[i].bonus)));
            dataLoad += "</td>";
            dataLoad += "</tr>";

           

        }

        for (let i = 0; i < response.data_bulan_sum.length; i++) {
            total += (parseFloat(response.data_bulan_sum[i].upah_bulanan) +  parseFloat(response.data_bulan_sum[i].bonus));
        }

        var totalDataBarang = response.length_bulan_paging;
        var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

        $('.pagination-result-bulan').html(paginationViewHTMLBulan(halaman, totalHalaman, create_date, keyword, batasTampilData));
        $("#data-bulan").html(dataLoad);
        $("#data-content-pengeluaran-bulan").html("Rp. "+numberWithCommas(total));

        return total;


        
    }

    function getDetailDataOperational(id_trx_opt) {
        $("#filename").val(id_trx_opt);
        $("#form-download").submit();
    }

    function paginationViewHTMLOp(halaman, totalHalaman, create_date, keyword, batasTampilData) { //halaman 1 total 6

        var data_load = '';
        prev = parseInt(halaman) - 1;
        next = parseInt(halaman) + 1;
        minimal_page = parseInt(halaman) - 2;
        max_page = parseInt(halaman) + 2;
        var prev_v = "dataPagingBarangHREFTrxOp('" + prev + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var next_v = "dataPagingBarangHREFTrxOp('" + next + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman1 = "dataPagingBarangHREFTrxOp('1','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman2 = "dataPagingBarangHREFTrxOp('2','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman3 = "dataPagingBarangHREFTrxOp('3','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman4 = "dataPagingBarangHREFTrxOp('4','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
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
            var onclk = "dataPagingBarangHREFTrxOp('" + i + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";

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

    function dataPagingBarangHREFTrxOp(halaman, create_date, keyword, batasTampilData) {
        $('#halaman_paging_operational').val(halaman)
        getDetail(create_date, keyword, batasTampilData, halaman)
    }


    function paginationViewHTMLMinggu(halaman, totalHalaman, create_date, keyword, batasTampilData) { //halaman 1 total 6

        var data_load = '';
        prev = parseInt(halaman) - 1;
        next = parseInt(halaman) + 1;
        minimal_page = parseInt(halaman) - 2;
        max_page = parseInt(halaman) + 2;
        var prev_v = "dataPagingBarangHREFTrxMinggu('" + prev + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var next_v = "dataPagingBarangHREFTrxMinggu('" + next + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman1 = "dataPagingBarangHREFTrxMinggu('1','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman2 = "dataPagingBarangHREFTrxMinggu('2','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman3 = "dataPagingBarangHREFTrxMinggu('3','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman4 = "dataPagingBarangHREFTrxMinggu('4','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
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
            var onclk = "dataPagingBarangHREFTrxMinggu('" + i + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";

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

    function dataPagingBarangHREFTrxMinggu(halaman, create_date, keyword, batasTampilData) {
        $('#halaman_paging_minggu').val(halaman)
        getDetail(create_date, keyword, batasTampilData, halaman)
    }

    function paginationViewHTMLBulan(halaman, totalHalaman, create_date, keyword, batasTampilData) { //halaman 1 total 6

        var data_load = '';
        prev = parseInt(halaman) - 1;
        next = parseInt(halaman) + 1;
        minimal_page = parseInt(halaman) - 2;
        max_page = parseInt(halaman) + 2;
        var prev_v = "dataPagingBarangHREFTrxBulan('" + prev + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var next_v = "dataPagingBarangHREFTrxBulan('" + next + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman1 = "dataPagingBarangHREFTrxBulan('1','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman2 = "dataPagingBarangHREFTrxBulan('2','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman3 = "dataPagingBarangHREFTrxBulan('3','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman4 = "dataPagingBarangHREFTrxBulan('4','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
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
            var onclk = "dataPagingBarangHREFTrxBulan('" + i + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";

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

    function dataPagingBarangHREFTrxBulan(halaman, create_date, keyword, batasTampilData) {
        $('#halaman_paging_bulan').val(halaman)
        getDetail(create_date, keyword, batasTampilData, halaman)
    }
</script>