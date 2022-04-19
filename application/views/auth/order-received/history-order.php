<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <div class="col-md-11">
        <hr style="margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    </div>
    <div class="container-fluid">
        <div class="row" id="date-filter">
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
        <div class="row" style="margin-top: 60px;" id="data-trigger">
            <div class="col-md-7" style="margin-left:7%;margin-top:10px">
                <div id="data-trigger-content"></div>
                <input type="hidden" name="halaman_paging_trx" id="halaman_paging_trx" value="1">
                <div class="pagination-result_trx" style="margin-left:160px;margin-top:10px;margin-left:30%"></div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="display: none;margin-top: 30px;" id="div-inventory-update-detail">
        <div class="row">
            <div class="col-md-4 offset-md-2">
                <div class="form-group row">
                    <label for="" class="col-sm-5 col-form-label">Kode CO </label>
                    <div class="col-sm-1">:</div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="kode_co" name="kode_co">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-5 col-form-label">No Surat Jalan </label>
                    <div class="col-sm-1">:</div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="surat_jalan" name="surat_jalan">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-5 col-form-label">Nama Pelanggan </label>
                    <div class="col-sm-1">:</div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-5 col-form-label">Nomor Hp </label>
                    <div class="col-sm-1">:</div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="nomor_hp" name="nomor_hp">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-5 col-form-label">Alamat Pengiriman </label>
                    <div class="col-sm-1">:</div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="alamat" name="alamat">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group row">
                    <label for="" class="col-sm-5 col-form-label">Tanggal CO </label>
                    <div class="col-sm-1">:</div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="tgl_co" name="tgl_co">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-5 col-form-label">Tanggal Pengiriman </label>
                    <div class="col-sm-1">:</div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="tgl_pengiriman" name="tgl_pengiriman">
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="row">
                    <div class="col-md-7 offset-md-2 justify-content-center">
                        <div class="row mt-2 ">
                            <table class="table table-dark table-bordered data">
                                <thead>
                                    <tr class="align-middle">
                                        <th rowspan="2"> Kode </th>
                                        <th rowspan="2"> Nama Bahan </th>
                                        <th rowspan="2"> Nama Barang </th>
                                        <th rowspan="1" colspan="2"> Quantity</th>
                                        <th rowspan="2"> Note </th>
                                    </tr>
                                    <tr>
                                        <th> Quantity / Kg </th>
                                        <th> Pcs / Bungkus </th>
                                    </tr>
                                </thead>
                                <tbody id='tbody-table-data'></tbody>
                            </table>
                            <input type="hidden" name="halaman_paging_trx_detail" id="halaman_paging_trx_detail" value="1">
                            <div class="pagination-result_trx_detail" style="margin-top:10px;margin-left:45%"></div>
                        </div>
                        <div class="row d-flex justify-content-end" style="margin-top: 20px;">
                            <div class="col-md-2">
                                <button class="form-control-button btn btn-outline-light button-action" onclick="back();"> Back </button>
                            </div>
                            <div class="col-md-2" id="loader-confirmed">
                                <button class="form-control-button btn btn-outline-light button-action" onclick="print();">Print</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top: 10px;"></div>
        <form method="post" action="<?= site_url() ?>/history-order/print" id="form-history-order-print" name="form-history-order-print" target="blank">
            <input type="hidden" name="id_trx_order" id="id_trx_order" />
        </form>
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

    function print() {
        var kode_co = $("#kode_co").val();
        $("#id_trx_order").val(kode_co);
        $("#form-history-order-print").submit();
    }


    function getData(create_date, keyword, batasTampilData, halaman) {
        $.ajax({
            url: '<?= site_url() ?>/history-order/getdata',
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

                    dataLoad += '<h4 style="text-decoration: underline;margin-top:2%">' + dateForMonth(response.data[0].update_date) + '</h4>'

                    for (let i = 0; i < response.length; i++) {
                        /*
                        if (create_date != "") {
                            dataLoad += '<h4 style="text-decoration: underline;margin-top:2%">' + dateForMonth(create_date) + '</h4>'
                        } else {
                            dataLoad += '<h4 style="text-decoration: underline;margin-top:2%">' + dateForShow(response.data[i].create_date) + '</h4>'
                        }*/

                        dataLoad += '<table class="table table-dark table-borderless" style="border: none;">';
                        dataLoad += '<thead></thead>';
                        dataLoad += '<tbody>';

                        var functionOnclick = 'dataPagingDetail("' + response.data[i].id_trx_order + '")';

                        dataLoad += "<tr>";
                        dataLoad += "<td width='19%'>";
                        dataLoad += response.data[i].id_trx_order;
                        dataLoad += "</td>";
                        dataLoad += "<td><a class='btn-sobat-md' href='#' onclick='" + functionOnclick + "'>";
                        //dataLoad += "Purchase From Distributor " + response.data[i].nama_pelanggan.toUpperCase();
                        dataLoad += response.data[i].nama_pelanggan.toUpperCase();
                        dataLoad += "</a></td>";
                        dataLoad += "</tr>";

                        dataLoad += '</tbody>';
                        dataLoad += '</table>';
                    }

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
                    // $('#data-trigger-content').html("");
                    $('.pagination-result_trx').html("");
                }

            },
            error: function(response) {
                console.log(response);
            }

        });
    }

    function dataPagingDetail(id_trx_order) {

        batasTampilData = 10;
        halaman = $('#halaman_paging_trx_detail').val();
        getDetailData(halaman, id_trx_order, batasTampilData);
    }

    function getDetailData(halaman, id_trx_order, batasTampilData) {

        $.ajax({
            url: '<?= site_url() ?>/history-order/gethistory',
            method: 'post',
            data: {
                "id_trx_order": id_trx_order,
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
                        dataLoad += response.data[i].note_nama_barang
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += response.data[i].quantity + " " + response.data[i].satuan
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += response.data[i].bungkusan + " " + response.data[i].satuan
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += response.data[i].note
                        dataLoad += "</td>";
                        dataLoad += "</tr>";

                    }

                    var totalDataBarang = response.length_paging;
                    var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

                    $('.pagination-result_trx_detail').html(paginationViewHTMLDetail(halaman, totalHalaman, id_trx_order))

                    $("#date-filter").hide();
                    $("#kode_co").val(id_trx_order);
                    $("#nama_pelanggan").val(response.data[0].nama_pelanggan);
                    $("#nomor_hp").val(response.data[0].nomor);
                    $("#alamat").val(response.data[0].alamat);
                    $("#tgl_co").val(dateForShow(response.data[0].create_date));
                    $("#tgl_pengiriman").val(dateForShowVarchar(response.data[0].tgl_pengiriman));
                    $("#surat_jalan").val((response.data[0].no_surat_jalan));
                    //$("#id_trx_order").val(id_trx_order);
                    $("#tbody-table-data").html(dataLoad);
                    $("#data-trigger").hide();
                    $("#div-inventory-update-detail").show();
                } else {
                    $('.pagination-result_trx_detail').html("");
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

    function back() {
        location.href = "<?= site_url() ?>/history-order";
    }

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

    function dateForShowVarchar(create_date) {

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

    function paginationViewHTMLDetail(halaman, totalHalaman, id_trx_order) { //halaman 1 total 6

        var data_load = '';
        prev = parseInt(halaman) - 1;
        next = parseInt(halaman) + 1;
        minimal_page = parseInt(halaman) - 2;
        max_page = parseInt(halaman) + 2;
        var prev_v = "dataPagingBarangHREFTrxDetail('" + prev + "','" + id_trx_order + "')";
        var next_v = "dataPagingBarangHREFTrxDetail('" + next + "','" + id_trx_order + "')";
        var halaman1 = "dataPagingBarangHREFTrxDetail('1','" + id_trx_order + "')";
        var halaman2 = "dataPagingBarangHREFTrxDetail('2','" + id_trx_order + "')";
        var halaman3 = "dataPagingBarangHREFTrxDetail('3','" + id_trx_order + "')";
        var halaman4 = "dataPagingBarangHREFTrxDetail('4','" + id_trx_order + "')";
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
            var onclk = "dataPagingBarangHREFTrxDetail('" + i + "','" + id_trx_order + "')";

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

    function dataPagingBarangHREFTrxDetail(halaman, id_trx_order) {
        $('#halaman_paging_trx_detail').val(halaman)
        dataPagingDetail(id_trx_order);
    }
</script>