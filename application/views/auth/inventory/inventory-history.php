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
                <input class="form-control-paging" type="text" placeholder="search..." id="search" name="search" onkeyup="searchData()">
                <span class="input-group-append">
                    <button class="btn btn-outline-light" type="button">
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

    <div class="row mt-5" id="data-trigger">
        <div class="col-7 col-sm-7 col-md-6 col-lg-5">
            <div id="data-trigger-content"></div>
            <div class="row mt-3">
                <div class="col-7 offset-2">
                    <input type="hidden" name="halaman_paging_trx" id="halaman_paging_trx" value="1">
                    <div class="pagination-result_trx"></div>
                </div>
            </div>
        </div>
    </div>

    <div style="display: none;" id="div-inventory-update-detail">

        <div class="row mt-5">
            <div class="col-5 offset-1 col-md-4 col-lg-3">
                <p id="id_trx_po"></p>
                <p id="supplier_name"></p>
            </div>
            <div class="col-5 offset-1 col-md-4 col-lg-3">
                <p id="date-filter"><?= $date ?></p>
                <p id="tgl_po"></p>
                <p id="tgl_penerimaan"></p>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12 col-md-7 offset-md-1 justify-content-center">
                <div class="row mt-2 ">
                    <table class="table table-dark table-bordered data table-responsive">
                        <thead>
                            <tr>
                                <th> Kode </th>
                                <th> Nama Barang </th>
                                <th> Quantity </th>
                                <th> Quantity Check</th>
                                <th> Harga Satuan</th>
                                <th> Harga Total</th>
                            </tr>
                        </thead>
                        <tbody id='tbody-table-data'></tbody>
                    </table>
                    <input type="hidden" name="halaman_paging_trx_detail" id="halaman_paging_trx_detail" value="1">
                    <div class="row">
                        <div class="pagination-result_trx_detail offset-7"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
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
        $("#halaman_paging_trx").val("1");
        var halaman = $('#halaman_paging_trx').val();
        var keyword = $("#search").val();

        getData(create_date.replaceAll("-", ""), keyword, batasTampilData, halaman);

    });

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function searchData() {

        var batasTampilData = 10;
        $("#halaman_paging_trx").val("1");
        var halaman = $('#halaman_paging_trx').val();
        var keyword = $("#search").val();
        var create_date = document.getElementById("create_date").value;
        getData(create_date.replaceAll("-", ""), keyword, batasTampilData, halaman);

    }


    function getData(create_date, keyword, batasTampilData, halaman) {
        $.ajax({
            url: '<?= site_url() ?>/inventory-history/getdata',
            method: 'post',
            dataType: 'json',
            data: {
                'create_date': create_date.trim(),
                'halaman': halaman,
                'keyword': keyword,
                'batastampil': batasTampilData
            },
            success: function(response) {

                console.log(response);
                if (response.length > 0) {

                    var dataLoad = "";
                    $("#data-trigger-content").html("");
                    $(".pagination-result_trx").html("");

                    dataLoad += '<h4 style="text-decoration: underline;margin-top:2%">' + dateForMonth(response.data[0].create_date) + '</h4>'

                    dataLoad += '<table class="table table-dark table-borderless table-responsive" style="border: none;text-align:left">';
                    //dataLoad += '<thead></thead>';
                    dataLoad += '<tbody>';

                    for (let i = 0; i < response.length; i++) {

                        /*
                        if (create_date != "") {
                            dataLoad += '<h4 style="text-decoration: underline;margin-top:2%">' + dateForMonth(create_date) + '</h4>'
                        } else {
                            dataLoad += '<h4 style="text-decoration: underline;margin-top:2%">' + dateForShow(response.data[i].create_date) + '</h4>'
                        }
                        */


                        var functionOnclick = 'dataPagingDetail("' + response.data[i].id_trx_po + '")';

                        dataLoad += "<tr>";
                        dataLoad += "<td class='text-start'>";
                        dataLoad += response.data[i].id_trx_po;
                        dataLoad += "</td>";
                        dataLoad += "<td class='text-start'><a class='btn-sobat-md' href='#' onclick='" + functionOnclick + "'>";
                        //dataLoad += "Purchase From Distributor " + response.data[i].nama.toUpperCase();
                        dataLoad += response.data[i].nama.toUpperCase();
                        dataLoad += "</a></td>";
                        dataLoad += "</tr>";


                    }

                    dataLoad += '</tbody>';
                    dataLoad += '</table>';

                    $("#data-trigger-content").html(dataLoad);
                    var totalDataBarang = response.length_paging;
                    var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

                    $("#date-filter").show();
                    $("#data-trigger").show();
                    $("#div-inventory-update-detail").hide();

                    console.log("totalDataBarang" + totalDataBarang);
                    console.log("totalHalaman" + totalHalaman);
                    $('.pagination-result_trx').html(paginationViewHTML(halaman, totalHalaman, create_date, keyword, batasTampilData))

                } else {
                    // $("#div-create-date").html("");
                    $('#data-trigger-content').html("");
                    $('.pagination-result_trx').html("");
                }

            },
            error: function(response) {
                console.log(response);
            }

        });
    }

    function dataPagingDetail(id_trx_po) {

        batasTampilData = 10;
        halaman = $('#halaman_paging_trx_detail').val();
        getDetailData(halaman, id_trx_po, batasTampilData);
    }

    function getDetailData(halaman, id_trx_po, batasTampilData) {

        $.ajax({
            url: '<?= site_url() ?>/inventory-history/gethistory',
            method: 'post',
            data: {
                "id_trx_po": id_trx_po,
                "halaman": halaman,
                "batastampil": batasTampilData
            },
            dataType: 'json',
            success: function(response) {
                var dataLoad = "";
                var total = 0;
                console.log(response);

                if (response.length > 0) {
                    for (let i = 0; i < response.length; i++) {

                        let result = parseFloat(response.data[i].quantity) * parseFloat(response.data[i].harga_satuan);
                        total += result;

                        dataLoad += "<tr>";
                        dataLoad += "<td>";
                        dataLoad += response.data[i].kode
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += response.data[i].nama_barang
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += response.data[i].quantity + " " + response.data[i].satuan
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += response.data[i].quantity_check + " " + response.data[i].satuan
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += "Rp. " + numberWithCommas(response.data[i].harga_satuan)
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += "Rp. " + numberWithCommas(result.toFixed(2))
                        dataLoad += "</td>";
                        dataLoad += "</tr>";

                    }
                    dataLoad += "<tr>";
                    dataLoad += "<td colspan='5' style='text-align:right'>";
                    dataLoad += "Harga Total"
                    dataLoad += "</td>";
                    dataLoad += "<td>";
                    dataLoad += "Rp. " + numberWithCommas(response.sum_data)
                    dataLoad += "</td>";
                    dataLoad += "</tr>";

                    var totalDataBarang = response.length_paging;
                    var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

                    $('.pagination-result_trx_detail').html(paginationViewHTMLDetail(halaman, totalHalaman, id_trx_po))

                    $("#date-filter").hide();
                    $("#supplier_name").html("Purchase From : " + response.data[0].nama);
                    $("#tgl_po").html("Tanggal Po : " + dateForShow(response.data[0].create_date));
                    if (response.data[0].create_date_penerimaan != null) {
                        $("#tgl_penerimaan").html("Tanggal Penerimaan : " + dateForShow(response.data[0].create_date_penerimaan));
                    } else {
                        $("#tgl_penerimaan").html("Tanggal Penerimaan : -");
                    }

                    $("#id_trx_po").html(id_trx_po);
                    $("#tbody-table-data").html(dataLoad);
                    $("#data-trigger").hide();
                    $("#div-inventory-update-detail").show();
                } else {

                    $('.pagination-result_trx_detail').html("");
                    $("#tbody-table-data").html("");
                    $("#div-inventory-update-detail").hide();
                }
            },
            error: function(response) {
                console.log(response);
            }

        });
    }


    $("#search").keyup(function(e) {

        if (e.keyCode == 13) {
            e.preventDefault();

            var search = document.getElementById("search").value;
            console.log(search);

        }
    });

    function clearAllData() {
        $('#tbody-table-data').empty();
    }

    function dateForShow(create_date) {

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

    function dateForMonth(create_date) {

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

        return month + ", " + year;
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

    function paginationViewHTMLDetail(halaman, totalHalaman, id_trx_po) { //halaman 1 total 6

        var data_load = '';
        prev = parseInt(halaman) - 1;
        next = parseInt(halaman) + 1;
        minimal_page = parseInt(halaman) - 2;
        max_page = parseInt(halaman) + 2;
        var prev_v = "dataPagingBarangHREFTrxDetail('" + prev + "','" + id_trx_po + "')";
        var next_v = "dataPagingBarangHREFTrxDetail('" + next + "','" + id_trx_po + "')";
        var halaman1 = "dataPagingBarangHREFTrxDetail('1','" + id_trx_po + "')";
        var halaman2 = "dataPagingBarangHREFTrxDetail('2','" + id_trx_po + "')";
        var halaman3 = "dataPagingBarangHREFTrxDetail('3','" + id_trx_po + "')";
        var halaman4 = "dataPagingBarangHREFTrxDetail('4','" + id_trx_po + "')";
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
            var onclk = "dataPagingBarangHREFTrxDetail('" + i + "','" + id_trx_po + "')";

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
        $('#halaman_paging_trx').val(halaman)
        getData(create_date, keyword, batasTampilData, halaman);
    }

    function dataPagingBarangHREFTrxDetail(halaman, id_trx_po) {
        $('#halaman_paging_trx_detail').val(halaman)
        dataPagingDetail(id_trx_po);
    }
</script>