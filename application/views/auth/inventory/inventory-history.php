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
                <input type="text" id="search" name="search" placeholder="search..." class="form-search">
            </div>
            <div class="col-md-2 offset-md-6">
                <input type="text" id="create_date" name="create_date" class="form-search" placeholder="sort...">
            </div>
        </div>
        <div class="row" style="margin-top: 60px;" id="data-trigger">
            <div class="col-md-7" style="margin-left:7%;margin-top:10px">
                <h4 id="div-create-date" style="text-decoration: underline;margin-left:2%"></h4>
                <table class="table table-dark table-borderless" style="border: none;">
                    <thead></thead>
                    <tbody id="data-trigger-content">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="display: none;margin-top: 30px;" id="div-inventory-update-detail">
        <div class="row">
            <div class="col-md-3 offset-md-2">
                <p id="id_trx_po"></p>
                <p id="supplier_name"></p>

                <label for="" class="col-sm-2 offset-md-4 col-form-label"> </label>
            </div>
            <div class="col-md-2 offset-md-3">
                <p id="date-filter"><?= $date ?></p>
                <p id="tgl_po"></p>
                <p id="tgl_penerimaan"></p>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="row">
                    <div class="col-md-7 offset-md-2 justify-content-center">
                        <div class="row mt-2 ">
                            <table class="table table-dark table-bordered data">
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
                        </div>
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
            format: "yyyymm",
            startView: "months",
            minViewMode: "months",
            autoclose: true
        })

        $("#create_date").val("sort by month....");
    });

    $(document).on('change', '#create_date', function() {
        var create_date = document.getElementById("create_date").value;
        getData(create_date);
    });

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }


    function getData(create_date) {
        $.ajax({
            url: '<?= site_url() ?>/inventory-history/getdata',
            method: 'post',
            dataType: 'json',
            data: {
                'create_date': create_date
            },
            success: function(response) {

                console.log(response);
                if (response.length > 0) {

                    $("#div-create-date").html(dateForMonth(create_date));

                    var dataLoad = "";

                    for (let i = 0; i < response.length; i++) {

                        var functionOnclick = 'getDetailData("' + response.data[i].id_trx_po + '")';

                        dataLoad += "<tr>";
                        dataLoad += "<td width='19%'>";
                        dataLoad += response.data[i].id_trx_po;
                        dataLoad += "</td>";
                        dataLoad += "<td><a class='btn-sobat-md' href='#' onclick='" + functionOnclick + "'>";
                        dataLoad += "Purchase From Distributor " + response.data[i].nama.toUpperCase();
                        dataLoad += "</a></td>";
                        dataLoad += "</tr>";
                    }

                    $("#data-trigger-content").html(dataLoad);

                } else {
                    $("#div-create-date").html("");
                    $('#data-trigger-content').html("");
                }

            },
            error: function(response) {
                console.log(response);
            }

        });
    }

    function getDetailData(id_trx_po) {

        $.ajax({
            url: '<?= site_url() ?>/inventory-history/gethistory',
            method: 'post',
            data: {
                "id_trx_po": id_trx_po
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
                        dataLoad += "Rp. "+numberWithCommas(response.data[i].harga_satuan) 
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += "Rp. "+numberWithCommas(result) 
                        dataLoad += "</td>";
                        dataLoad += "</tr>";

                    }
                    dataLoad += "<tr>";
                    dataLoad += "<td colspan='5' style='text-align:right'>";
                    dataLoad += "Harga Total"
                    dataLoad += "</td>";
                    dataLoad += "<td>";
                    dataLoad += "Rp. "+numberWithCommas(total) 
                    dataLoad += "</td>";
                    dataLoad += "</tr>";

                    $("#date-filter").hide();
                    $("#supplier_name").html("Purchase From : " + response.data[0].nama);
                    $("#tgl_po").html("Tanggal Po : "+dateForShow(response.data[0].create_date));
                    $("#tgl_penerimaan").html("Tanggal Penerimaan : "+dateForShow(response.data[0].create_date_penerimaan));
                    $("#id_trx_po").html(id_trx_po);
                    $("#tbody-table-data").html(dataLoad);
                    $("#data-trigger").hide();
                    $("#div-inventory-update-detail").show();
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

        return month + ", " + year;
    }
</script>