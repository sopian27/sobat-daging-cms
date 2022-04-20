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
        </div>
    </div>
    <div class="container-fluid" id="return-filter">
        <div class="row">
            <div class="row" style="margin-top: 50px;">
                <div class="col-md-7 offset-md-1">
                    <div class="row">
                        <div class="col-md-4 offset-md-6 text-center">
                            <h2 id="div-create-date"></h2>
                        </div>
                    </div>
                    <div class="row mt-2 offset-md-1">
                        <div class="collapse-content">
                        </div>
                        <input type="hidden" name="halaman_paging_trx" id="halaman_paging_trx" value="1">
                        <div class="pagination-result_trx" style="margin-left:160px;margin-top:10px;margin-left:30%"></div>
                    </div>
                    <div class="row d-flex justify-content-start formSubmitData" id="formSubmitData">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="margin-top: 60px;display:none" id="return-content">
        <div class="row justify-content-center">
            <form method="post" name="form-return-save" id="form-return-save">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 ">
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">Nomor Invoice </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control-label" id="no_invoice" name="no_invoice">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">Nama Pelanggan </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control-label" id="nama_pelanggan" name="nama_pelanggan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">Tanggal Pengiriman </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control-label" id="tgl_pengiriman" name="tgl_pengiriman">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 offset-md-1">
                            <div class="form-group row">
                                <label for="" class="col-sm-5 col-form-label">Tanggal Return </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control-label" id="tgl_return" name="tgl_return">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 50px;">
                    <div class="col-md-6 offset-md-2 justify-content-center">
                        <div class="row mt-2 ">
                            <table class="table table-dark table-bordered data" id="mytable">
                                <thead>
                                    <tr>
                                        <th> Kode </th>
                                        <th> Nama Barang </th>
                                        <th colspan="2"> Quantity </th>
                                        <th colspan="2"> Quantity Barang Return </th>
                                        <th colspan="2"> Note </th>
                                    </tr>
                                </thead>
                                <tbody id='tbody-table-data'>
                                </tbody>
                            </table>
                            <input type="hidden" name="halaman_paging_trx_detail" id="halaman_paging_trx_detail" value="1">
                            <div class="pagination-result_trx_detail" style="margin-top:10px;margin-left:45%"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div style="margin-top:60px"></div>
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

        $("#return-filter").show();
        $("#return-content").hide();

        var create_date = document.getElementById("create_date").value;

        var batasTampilData = 10;
        $("#halaman_paging_trx").val("1");
        var halaman = $('#halaman_paging_trx').val();
        var keyword = $("#search").val();

        getData(create_date.replaceAll("-", ""), keyword, batasTampilData, halaman);
    });

    function searchData() {
        
        $("#return-filter").show();
        $("#return-content").hide();

        var batasTampilData = 10;
        $("#halaman_paging_trx").val("1");
        var halaman = $('#halaman_paging_trx').val();
        var keyword = $("#search").val();
        var create_date = document.getElementById("create_date").value;

        getData(create_date.replaceAll("-", ""), keyword, batasTampilData, halaman);

    }

    function getData(create_date, keyword, batasTampilData, halaman) {
        $.ajax({
            url: '<?= site_url() ?>/return-history/getdatabydate',
            method: 'post',
            dataType: 'json',
            data: {
                'create_date': create_date.trim(),
                'halaman': halaman,
                'keyword': keyword,
                'batastampil': batasTampilData
            },
            success: function(data) {

                console.log(data.data);
                if (data.length > 0) {

                    var dataload = "";
                    dataload += '<div class="container"> ';
                    dataload += '<div class="row"> ';

                    if (create_date != "") {
                        dataload += '<h4 style="text-decoration: underline;margin-top:10px">' + dateForShow(data.data[0].tgl_return) + '</h4>'
                    }

                    for (i = 0; i < data.length; i++) {

                        if (keyword != "") {
                            //dataload += '<h4 style="text-decoration: underline;margin-top:10px">' + dateForShow(data.data[i].create_date) + '</h4>'
                        }

                        //var id_trx_return = data.data[i].id_trx_return;
                        var no_invoice = data.data[i].no_invoice;
                        var functionOnclickCheck = 'dataPagingDetailCheck("' + no_invoice + '")';

                        dataload += '<div class="col-md-12" style="margin-top:10px"> ';
                        dataload += '<a class="btn-sobat-md" href="#"';
                        dataload += "onclick=" + functionOnclickCheck + ">" + dateOnlyDay(data.data[i].tgl_return) + "<span style='margin-left:20px'>" + data.data[i].nama_pelanggan.toUpperCase(); + '</span></a>';
                        dataload += '</div>';

                    }

                    dataload += '</div>';
                    dataload += '</div>';

                    $('.collapse-content').html(dataload);
                    var totalDataBarang = data.length_paging;
                    var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

                    console.log("totalDataBarang" + totalDataBarang);
                    console.log("totalHalaman" + totalHalaman);
                    $('.pagination-result_trx').html(paginationViewHTML(halaman, totalHalaman, create_date, keyword, batasTampilData))

                } else {
                    $("#div-create-date").html("");
                    $('.collapse-content').html("");
                    $('.pagination-result_trx').html("");
                }

            },
            error: function(response) {
                console.log(response);
            }

        });
    }


    $(document).on('change', '#create_date1', function() {

        var create_date = document.getElementById("create_date").value;
        //var create_date_new = convertDate(create_date);
        console.log("create_date:" + create_date);

        $.ajax({
            url: '<?= site_url() ?>/return-history/getdatabydate',
            method: 'post',
            dataType: 'json',
            data: {
                'date_choosen': create_date
            },
            success: function(data) {

                console.log(data);
                $('.collapse-content').html("");

                if (data.length > 0) {

                    $("#div-create-date").html(getMonthOnly(create_date));

                    var dataload = "";
                    /*
                    dataload += '<div class="container"> ';
                    dataload += '<div class="row"> '
                    dataload += '<div class="col-md-6"> ';
                    */
                    dataload += '<table> ';
                    dataload += '<thead> ';

                    for (i = 0; i < data.length; i++) {

                        //var id_trx_return = data[i].id_trx_return.replace(/\//g, '(+)');
                        var functionOnclick = 'getInvoiceHistory("' + data[i].id_trx_return + '","' + i + '")';

                        //dataload += "<p>";
                        dataload += '<tr> ';
                        dataload += '<td> ';
                        dataload += '<a href="#" style="color:white;text-decoration:none" class="btn-action"';
                        dataload += "onclick=" + functionOnclick + ">" + data[i].tgl_return.substr(6, 2) + "&nbsp;&nbsp;" + data[i].nama_pelanggan.toUpperCase() + '</a>';
                        dataload += '</td> ';
                        dataload += "</tr>"

                    }
                    /*
                    dataload += '</div>';  
                    dataload += '</div>';
                    dataload += '</div>'; 
                    */
                    dataload += '</thead> ';
                    dataload += '</table> ';
                    $('.collapse-content').append(dataload);

                } else {
                    $("#div-create-date").html("");
                    $('.collapse-content').html("");
                }
            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });

    });

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


    function dataPagingDetailCheck(no_invoice) {

        batasTampilData = 10;
        halaman = $('#halaman_paging_trx_detail').val();
        getDetail(halaman, no_invoice, batasTampilData);
    }

    function dateOnlyDay(create_date) {

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

        return day;
    }

    function getDetail(halaman, no_invoice, batasTampilData) {

        $.ajax({
            url: '<?= site_url() ?>/return-history/getdatahistory',
            method: 'post',
            dataType: 'json',
            data: {
                "no_invoice": no_invoice,
                "halaman": halaman,
                "batastampil": batasTampilData
            },
            success: function(data) {

                var dataload = "";
                console.log(data);

                if (data.length > 0) {

                    $("#no_invoice").val(data.data[0].no_invoice);
                    $("#nama_pelanggan").val(data.data[0].nama_pelanggan.toUpperCase());
                    $("#tgl_pengiriman").val(dateForShow(data.data[0].tgl_pengiriman));
                    $("#tgl_return").val(dateForShow(data.data[0].tgl_return));


                    for (i = 0; i < data.length; i++) {

                        dataload += '<tr> '
                        dataload += '    <td class="data " data-dat="kode"><input type="text" name="kodekode[]" value="' + data.data[i].kode + '" class="form-control data-kode"></td> '
                        dataload += '    <td class="data" data-dat="nama_barang" width="30%">'
                        dataload += '       <input type="text" name="nama_barang[]" value="' + data.data[i].nama_barang + '" class="form-control ">'
                        dataload += '       <input type="hidden" name="id_trx_po[]" value="' + data.data[i].id + '" class="form-control ">'
                        dataload += '    </td>'
                        dataload += '    <td class="data" data-dat="quantity" ><input type="text" name="quantity[]" value="' + data.data[i].quantity_before + '" class="form-control data-quantity"></td> '
                        dataload += '    <td class="data" data-dat="satuan select-wrapper" style="width: 7%;">'
                        dataload += '      <select name="satuan[]" class="form-control">'
                        dataload += '          <option value="Kg">kg</option>'
                        dataload += '          <option value="Dus">Dus</option>'
                        dataload += '      </select>'
                        dataload += '    </td> '
                        dataload += '    <td class="data" data-dat="quantity" width="15%" ><input type="text" name="quantity_return[]" value="' + data.data[i].quantity_return + '" class="form-control data-quantity" required></td> '
                        dataload += '    <td class="data" data-dat="satuan select-wrapper" style="width: 7%;">'
                        dataload += '      <select name="satuan_return[]" class="form-control">'
                        dataload += '          <option value="Kg">kg</option>'
                        dataload += '          <option value="Dus">Dus</option>'
                        dataload += '      </select>'
                        dataload += '    </td> '
                        dataload += '    <td class="data" data-dat="keterangan" style="width: 20%;"><input type="text" name="note[]" value="' + data.data[i].note + '" class="form-control "></td> '
                        dataload += '</tr>'

                    }

                    var totalDataBarang = data.length_paging;
                    var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

                    $('.pagination-result_trx_detail').html(paginationViewHTMLDetail(halaman, totalHalaman, no_invoice))

                    $("#return-filter").hide();
                    $("#tbody-table-data").html(dataload);
                    $("#return-content").show();



                } else {

                    $("#tbody-table-data").html("");
                    $("#return-content").hide();
                }

            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });

    }


    function getDetailTrx(id_trx_return, index) {

        id_trx_return = id_trx_return.replaceAll('(+)', '/');

    }

    function convertDate(create_date) {
        var date_split = create_date.split("/");
        var year = date_split[2];
        var month = date_split[1];
        var day = date_split[0];
        return year + month + day;
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
        $('#halaman_paging_trx').val(halaman)
        getData(create_date, keyword, batasTampilData, halaman);
    }

    function paginationViewHTMLDetail(halaman, totalHalaman, no_invoice) { //halaman 1 total 6

        var data_load = '';
        prev = parseInt(halaman) - 1;
        next = parseInt(halaman) + 1;
        minimal_page = parseInt(halaman) - 2;
        max_page = parseInt(halaman) + 2;
        var prev_v = "dataPagingBarangHREFTrxDetail('" + prev + "','" + no_invoice + "')";
        var next_v = "dataPagingBarangHREFTrxDetail('" + next + "','" + no_invoice + "')";
        var halaman1 = "dataPagingBarangHREFTrxDetail('1','" + no_invoice + "')";
        var halaman2 = "dataPagingBarangHREFTrxDetail('2','" + no_invoice + "')";
        var halaman3 = "dataPagingBarangHREFTrxDetail('3','" + no_invoice + "')";
        var halaman4 = "dataPagingBarangHREFTrxDetail('4','" + no_invoice + "')";
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
            var onclk = "dataPagingBarangHREFTrxDetail('" + i + "','" + no_invoice + "')";

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

    function dataPagingBarangHREFTrxDetail(halaman, no_invoice) {
        $('#halaman_paging_trx_detail').val(halaman)
        dataPagingDetailCheck(no_invoice);
    }
</script>