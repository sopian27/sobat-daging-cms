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

    <div class="row justify-content-center" id="form-sallary">
        <div class="row mt-5">
            <div class="col-12 justify-content-start">
                <div>
                    <h5 id="data-content-title"></h5>
                </div>
            </div>

            <div class="col-4" style="display: none;" id="penggunaan-dana-div">
                <div class="form-group row mt-2">
                    <label for="" class="col-8 col-md-6 col-form-label">
                        <p>Penggunaan Dana Total </p>
                    </label>
                    <div class="col-4 col-md-6">
                        <p class="mt-2">:&nbsp;Rp. <span id="data-content"></span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5" style="display: none;" id="data-content-div">
            <div class="col-12 col-md-7 offset-md-3 justify-content-center">
                <table class="table table-dark table-bordered data table-responsive">
                    <thead>
                        <tr>
                            <th colspan="4"><span id="data-content-title2"><span></th>
                        </tr>
                        <tr>
                            <th> Kode </th>
                            <th> Pemasukkan Dana</th>
                            <th> Keterangan </th>
                            <th> Bukti </th>
                        </tr>
                    </thead>
                    <tbody id="data-oi">
                    </tbody>
                </table>
                <input type="hidden" name="halaman_paging_oi" id="halaman_paging_oi" value="1">
                <div class="row">
                    <div class="pagination-result-oi offset-7"></div>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top:60px"></div>
    <form id="form-download" name="form-download" action="<?= site_url() ?>/history-other/download" target="blank" method="post">
        <input type="hidden" name="filename" id="filename" />
    </form>
</div>

<script>
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

        $("#halaman_paging_oi").val("1");
    }

    $(document).on('change', '#create_date', function() {
        var create_date = document.getElementById("create_date").value;
        create_date = create_date.replaceAll("-", "");

        var batasTampilData = 10;
        var halaman = $('#halaman_paging_oi').val();
        initPaging();
        var keyword = $("#search").val();
        getDetail(create_date, keyword, batasTampilData, halaman);

    });

    function searchData() {

        var batasTampilData = 10;
        var halaman = $('#halaman_paging_oi').val();
        var keyword = $("#search").val();
        var create_date = document.getElementById("create_date").value;
        create_date = create_date.replaceAll("-", "");

        initPaging();

        getDetail(create_date, keyword, batasTampilData, halaman);

    }

    function getDetail(date, keyword, batasTampilData, halaman) {

        $.ajax({
            url: '<?= site_url() ?>/history-other/getdata',
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
                var total = 0;
                console.log(response);

                if (response.length > 0) {
                    for (let i = 0; i < response.data.length; i++) {

                        var functionOnclick = 'getDetailDataOther("' + response.data[i].upload_bukti + '")';

                        dataLoad += "<tr>";
                        dataLoad += "<td >";
                        dataLoad += response.data[i].id_trx_ot;
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += "Rp. " + numberWithCommas(response.data[i].penggunaan_dana);
                        dataLoad += "</td>";
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += response.data[i].keterangan;
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

                    $("#data-op").html(dataLoad);
                    $("#data-content-title2").html("Other Income " + getMonthOnly(date));
                    $("#data-content-title").html("Other Income " + getMonthOnly(date));
                    $("#data-content").html(total);
                    $("#penggunaan-dana-div").show();
                    $("#data-content-div").show();


                    var totalDataBarang = response.length_paging;
                    var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

                    $('.pagination-result-oi').html(paginationViewHTMLOi(halaman, totalHalaman, date, keyword, batasTampilData));
                    $("#data-oi").html(dataLoad);
                    $("#data-content").html(total);

                }

            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }


    function getDetailDataOther(upload_bukti) {
        $("#filename").val(upload_bukti);
        $("#form-download").submit();
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
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function getData(date) {

        $.ajax({
            url: '<?= site_url() ?>/history-other/getdata',
            method: 'post',
            dataType: 'json',
            data: {
                date_value: date
            },
            success: function(response) {

                var dataLoad = "";
                var total = 0;
                console.log(response);

                if (response.result != undefined) {
                    for (let i = 0; i < response.data.length; i++) {

                        dataLoad += "<tr>";
                        dataLoad += "<td >";
                        dataLoad += response.data[i].kode;
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += "Rp. " + numberWithCommas(response.data[i].penggunaan_dana);
                        dataLoad += "</td>";
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += response.data[i].keterangan;
                        dataLoad += "</td>";
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += "---";
                        dataLoad += "</td>";
                        dataLoad += "</tr>";

                    }


                    if (response.dataTot.length == 0) {
                        total = 0;
                    } else {
                        total = numberWithCommas(response.dataTot[0].total);
                    }

                }

                $("#data-op").html(dataLoad);
                $("#data-content-title2").html("Other Income " + getMonthOnly(date));
                $("#data-content-title").html("Other Income " + getMonthOnly(date));
                $("#data-content").html(total);
                $("#penggunaan-dana-div").show();
                $("#data-content-div").show();


            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }

    function paginationViewHTMLOi(halaman, totalHalaman, create_date, keyword, batasTampilData) { //halaman 1 total 6

        var data_load = '';
        prev = parseInt(halaman) - 1;
        next = parseInt(halaman) + 1;
        minimal_page = parseInt(halaman) - 2;
        max_page = parseInt(halaman) + 2;
        var prev_v = "dataPagingBarangHREFTrxOi('" + prev + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var next_v = "dataPagingBarangHREFTrxOi('" + next + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman1 = "dataPagingBarangHREFTrxOi('1','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman2 = "dataPagingBarangHREFTrxOi('2','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman3 = "dataPagingBarangHREFTrxOi('3','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman4 = "dataPagingBarangHREFTrxOi('4','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
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
            var onclk = "dataPagingBarangHREFTrxOi('" + i + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";

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

    function dataPagingBarangHREFTrxOi(halaman, create_date, keyword, batasTampilData) {
        $('#halaman_paging_oi').val(halaman)
        getDetail(create_date, keyword, batasTampilData, halaman)
    }
</script>