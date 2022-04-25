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
    </div>

    <div class="row justify-content-end" id="content-header">
        <div class="col-4 ">
            <div class="form-group row">
                <label for="" class="col-12 col-md-5 col-form-label">Total Harga All : </label>
                <div class="col-5 mt-2" id="total-harga-all"></div>
            </div>
            <hr style="border-width:2px;border-style: solid;border-color:white">
        </div>
    </div>

    <div class="row mt-5 justify-content-center">
        <div class="col-12 justify-content-center">
            <div class="table-responsive">
                <table class="table table-dark table-bordered data">
                    <thead>
                        <tr class="align-middle">
                            <th rowspan="2"> Kode </th>
                            <th rowspan="2"> Nama Barang </th>
                            <th rowspan="1" colspan="2"> Quantity</th>
                            <th rowspan="2"> Harga Terakhir </th>
                            <th rowspan="2"> Harga Total </th>
                        </tr>
                        <tr>
                            <th> Gudang Luar </th>
                            <th> Gudang Sobat </th>
                        </tr>
                    </thead>
                    <tbody id="data-stock">
                    </tbody>
                </table>
            </div>
            <input type="hidden" name="halaman_paging" id="halaman_paging" value="1">
            <div class="row">
                <div class="pagination-result offset-7"></div>
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
            url: '<?= site_url() ?>/total-stock/getdata',
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
                console.log(response);

                if (response.length > 0) {
                    for (let i = 0; i < response.datastock.length; i++) {

                        /*
                        if(parseFloat(response.datastock[i].quantity_sobat) > 0){
                            var tot = (parseFloat(response.datastock[i].harga_satuan)) * (parseFloat(response.datastock[i].quantity_sobat)+(parseFloat(response.datastock[i].quantity_pusat)));
                            total += tot;
                        }else{
                            var tot = (parseFloat(response.datastock[i].harga_satuan) * (parseFloat(response.datastock[i].quantity_pusat)));
                            total += tot;
                        }
                        */

                        var tot = (parseFloat(response.datastock[i].harga_satuan)) * (parseFloat(response.datastock[i].quantity_sobat) + (parseFloat(response.datastock[i].quantity_pusat)));
                        total += tot;


                        dataLoad += "<tr>";
                        dataLoad += "<td >";
                        dataLoad += response.datastock[i].kode;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += response.datastock[i].nama_barang.toUpperCase();
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += parseFloat(response.datastock[i].quantity_pusat).toFixed(2) + " " + response.datastock[i].satuan;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += parseFloat(response.datastock[i].quantity_sobat).toFixed(2) + " " + response.datastock[i].satuan;;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += numberWithCommas("Rp. " + response.datastock[i].harga_satuan);
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += numberWithCommas("Rp. " + tot.toFixed(2));
                        dataLoad += "</td>";
                        dataLoad += "</tr>";

                    }

                    var totalDataBarang = response.length_paging;
                    var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

                    $('.pagination-result').html(paginationViewHTML(halaman, totalHalaman, "", keyword, batasTampilData));
                    $("#tot-stock").html(numberWithCommas("Total Nominal Aset Stock : Rp. " + total));
                    $("#total-harga-all").html(numberWithCommas("Rp. " + response.quantity_total));
                    $("#data-stock").html(dataLoad);

                }

            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }

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