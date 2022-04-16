<div class="container-fluid mt-3">
    <div class="col-md-6 offset-md-1">
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
        </div>
    </div>

    <div class="container-fluid" id="customer">
        <div class="row justify-content-center">
            <div class="container">
                <div class="row" style="margin-top:40px">
                    <div class="col-md-1 offset-md-1">
                        <div>
                            <a class="form-control-button btn" style="background-color: #B89874;border:none;padding:10px"> Customer </a>
                        </div>
                        <div style="margin-top:30px">
                            <a class="form-control-button btn btn-outline-light button-action" style="padding:10px" onclick="supplier();"> Supplier </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5 offset-md-3" style="margin-top: 40px;">
                    <table class="table table-dark table-bordered data" id="mytable1">
                        <thead>
                            <tr>
                                <th colspan="4"> Data Pelanggan </th>
                            </tr>
                            <tr>
                                <th> Kode </th>
                                <th> Nama Pelanggan </th>
                                <th> Nomor Hp </th>
                                <th> Alamat Pengiriman </th>
                            </tr>
                        </thead>
                        <tbody id="data-crm"></tbody>
                    </table>
                    <input type="hidden" name="halaman_paging" id="halaman_paging" value="1">
                    <div class="pagination-result" style="margin-top:10px;margin-left:45%"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="display: none;" id="supplier">
        <div class="row justify-content-center">
            <div class="container">
                <div class="row" style="margin-top:40px">
                    <div class="col-md-1 offset-md-1">
                        <div>
                            <a class="form-control-button btn btn-outline-light button-action" style="padding:10px" onclick="customer();"> Customer </a>
                        </div>
                        <div style="margin-top:30px">
                            <a class="form-control-button btn" style="background-color: #B89874;border:none;padding:10px"> Supplier </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5 offset-md-3" style="margin-top: 40px;">
                    <table class="table table-dark table-bordered data">
                        <thead>
                            <tr>
                                <th colspan="4"> Data Supplier </th>
                            </tr>
                            <tr>
                                <th> Kode </th>
                                <th> Nama Pelanggan </th>
                                <th> Nomor Hp </th>
                                <th> Pic </th>
                            </tr>
                        </thead>
                        <tbody id="data-crm-sup"></tbody>
                    </table>
                    <input type="hidden" name="halaman_paging_sup" id="halaman_paging_sup" value="1">
                    <div class="pagination-result-sup" style="margin-top:10px;margin-left:45%"></div>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top:60px"></div>
</div>

<script>
    $(document).ready(function() {

        var batasTampilData = 10;
        $("#halaman_paging").val("1");
        var halaman = $('#halaman_paging').val();
        getData("", "", batasTampilData, halaman);
    });

    function supplier() {
        $("#customer").hide();
        $("#supplier").show();
    }

    function customer() {
        $("#customer").show();
        $("#supplier").hide();
    }

    function searchData() {

        var batasTampilData = 10;
        $("#halaman_paging").val("1");
        var halaman = $('#halaman_paging').val();
        var keyword = $("#search").val();
        var create_date = "";
        getData(create_date, keyword, batasTampilData, halaman);

    }

    function getData(create_date, keyword, batasTampilData, halaman) {

        $.ajax({
            url: '<?= site_url() ?>/crm/getdata',
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
                setCustomer(response,create_date, keyword, halaman, batasTampilData);
                setSupplier(response,create_date, keyword, halaman, batasTampilData);


            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }


    function setCustomer(response,create_date, keyword, halaman, batasTampilData) {

        var dataLoad = "";
        var total = 0;

        if (response.length > 0) {
            for (let i = 0; i < response.datacrm.length; i++) {

                dataLoad += "<tr>";
                dataLoad += "<td >";
                dataLoad += response.datacrm[i].id;
                dataLoad += "</td>";
                dataLoad += "<td >";
                dataLoad += response.datacrm[i].nama_pelanggan.toUpperCase();
                dataLoad += "</td>";
                dataLoad += "<td >";
                dataLoad += response.datacrm[i].nomor;
                dataLoad += "</td>";
                dataLoad += "<td >";
                dataLoad += response.datacrm[i].alamat;
                dataLoad += "</td>";
                dataLoad += "</tr>";

            }

            var totalDataBarang = response.length_paging;
            var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

            $('.pagination-result').html(paginationViewHTML(halaman, totalHalaman, "", keyword, batasTampilData));
            $("#data-crm").html(dataLoad);

        } else {

            $('.pagination-result').html("");
        }
    }

    function setSupplier(response,create_date, keyword, halaman, batasTampilData) {

        var dataLoad = "";
        var total = 0;

        if (response.length_sup > 0) {
            for (let i = 0; i < response.datasup.length; i++) {

                dataLoad += "<tr>";
                dataLoad += "<td >";
                dataLoad += response.datasup[i].id;
                dataLoad += "</td>";
                dataLoad += "<td >";
                dataLoad += response.datasup[i].nama.toUpperCase();
                dataLoad += "</td>";
                dataLoad += "<td >";
                dataLoad += response.datasup[i].no_hp;
                dataLoad += "</td>";
                dataLoad += "<td >";
                dataLoad += response.datasup[i].pic;
                dataLoad += "</td>";
                dataLoad += "</tr>";

            }

            var totalDataBarang = response.length_paging_sup;
            var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

            $('.pagination-result-sup').html(paginationViewHTMLSup(halaman, totalHalaman, "", keyword, batasTampilData));
            $("#data-crm-sup").html(dataLoad);

        } else {

            $('.pagination-result-sup').html("");
        }
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

    function paginationViewHTMLSup(halaman, totalHalaman, create_date, keyword, batasTampilData) { //halaman 1 total 6

        var data_load = '';
        prev = parseInt(halaman) - 1;
        next = parseInt(halaman) + 1;
        minimal_page = parseInt(halaman) - 2;
        max_page = parseInt(halaman) + 2;
        var prev_v = "dataPagingBarangHREFTrxSup('" + prev + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var next_v = "dataPagingBarangHREFTrxSup('" + next + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman1 = "dataPagingBarangHREFTrxSup('1','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman2 = "dataPagingBarangHREFTrxSup('2','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman3 = "dataPagingBarangHREFTrxSup('3','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
        var halaman4 = "dataPagingBarangHREFTrxSup('4','" + create_date + "','" + keyword + "','" + batasTampilData + "')";
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
            var onclk = "dataPagingBarangHREFTrxSup('" + i + "','" + create_date + "','" + keyword + "','" + batasTampilData + "')";

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

    function dataPagingBarangHREFTrxSup(halaman, create_date, keyword, batasTampilData) {
        $('#halaman_paging_sup').val(halaman)
        getData(create_date, keyword, batasTampilData, halaman);
    }
</script>