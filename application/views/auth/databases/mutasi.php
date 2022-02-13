<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <div class="col-md-11">
        <hr style="margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    </div>
    <div class="container-fluid">
        <div class="row" id="content-filter"  style="margin-top: 40px;">
            <div class="col-md-2 offset-md-1">
                <input type="text" id="search" name="search" placeholder="search..." class="form-search">
            </div>
            <div class="col-md-2 offset-md-6">
                <input type="text" id="create_date" name="create_date" class="form-search" placeholder="sort...">
            </div>
        </div>
    </div>

    <div class="container-fluid" style="margin-top: 20px;">
        <div class="row justify-content-center" id="mutasi-masuk">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 offset-md-1">
                        <div>
                            <a class="form-control-button btn" style="background-color: #a5662f;border:none;padding:10px"> Mutasi Masuk </a>
                        </div>
                        <div style="margin-top:30px">
                            <a class="form-control-button btn btn-outline-light button-action" style="padding:10px" onclick="mutasiKeluar();"> Mutasi Keluar </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5 offset-md-4">
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
                        <div style="min-height: 120px;">
                            <div class="collapse collapse-horizontal" id="data-barang-collapse">
                                <div class="card card-body bg-transparent " style="width: 300px; border: 2px solid white;">
                                    <input type="hidden" name="page" id="page" value="1">
                                    <input type="hidden" name="total_page" id="total_page">
                                    <div class="row"></div>
                                    <div class="data-pagination"></div>
                                    <div class="pagination-result" style="margin-left:160px;margin-top:10px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center" style="display: none;" id="mutasi-keluar">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 offset-md-1">
                        <div>
                            <a class="form-control-button btn btn-outline-light button-action" onclick="mutasiMasuk();"> Mutasi Masuk </a>
                        </div>
                        <div style="margin-top:30px">
                            <a class="form-control-button btn" style="background-color: #a5662f;border:none;padding:10px"> Mutasi Keluar </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5 offset-md-4">
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
                        <div style="min-height: 120px;">
                            <div class="collapse collapse-horizontal" id="data-barang-collapse">
                                <div class="card card-body bg-transparent " style="width: 300px; border: 2px solid white;">
                                    <input type="hidden" name="page" id="page" value="1">
                                    <input type="hidden" name="total_page" id="total_page">
                                    <div class="row"></div>
                                    <div class="data-pagination"></div>
                                    <div class="pagination-result" style="margin-left:160px;margin-top:10px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
            format: "yyyymm",
            startView: "months",
            minViewMode: "months",
            autoclose: true
        })

        $("#create_date").val("sort by month....");
    });

    $(document).on('change', '#create_date', function() {
        var create_date = document.getElementById("create_date").value;

        var today = new Date();
        var year = today.getFullYear();
        var month = today.getMonth();

        getDataMutasi(create_date);

    });

    function getDataMutasi(create_date){
        $.ajax({
            url: '<?= site_url() ?>/data-mutasi/get-data',
            method: 'post',
            dataType: 'json',
            data: {
                date_value: create_date
            },
            success: function(response) {

                var dataLoad = "";
                var total = 0;
                console.log(response);

                if (response.result != undefined) {

                    setMutasiMasuk(response);
                    setMutasiKeluar(response);

                    $("#mutasi-masuk-title").html("Data Mutasi Masuk "+ getMonthOnly(create_date))
                    $("#mutasi-keluar-title").html("Data Mutasi Keluar "+ getMonthOnly(create_date))

                }


            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }

    function setMutasiMasuk(response){

        dataLoad="";

        for (let i = 0; i < response.mutasi_masuk.length; i++) {

            var isFinished = "";
            if (parseFloat(response.mutasi_masuk[i].nominal_bayar) > 0) {
                isFinished = "P";
            } else {
                isFinished = "F";
            }

            dataLoad += "<tr>";
            dataLoad += "<td >";
            dataLoad += response.mutasi_masuk[i].nama.toUpperCase();
            dataLoad += "</td>";
            dataLoad += "<td >";
            dataLoad += response.mutasi_masuk[i].no_invoice;
            dataLoad += "</td>";
            dataLoad += "<td >";
            dataLoad += dateForShow(response.mutasi_masuk[i].jatuh_tempo);
            dataLoad += "</td>";
            dataLoad += "<td >";
            dataLoad += numberWithCommas("Rp. "+response.mutasi_masuk[i].nominal_bayar); 
            dataLoad += "</td>";
            dataLoad += "<td >";
            dataLoad += isFinished; 
            dataLoad += "</td>";
            dataLoad += "</tr>";

        }

        $("#mutasi-masuk-data").html(dataLoad);

    }

    function setMutasiKeluar(response){

        dataLoad="";

        for (let i = 0; i < response.mutasi_keluar.length; i++) {

            var isFinished = "";
            if (parseFloat(response.mutasi_keluar[i].nominal_bayar) > 0) {
                isFinished = "P";
            } else {
                isFinished = "F";
            }

            dataLoad += "<tr>";
            dataLoad += "<td >";
            dataLoad += response.mutasi_keluar[i].nama.toUpperCase();
            dataLoad += "</td>";
            dataLoad += "<td >";
            dataLoad += response.mutasi_keluar[i].no_invoice;
            dataLoad += "</td>";
            dataLoad += "<td >";
            dataLoad += dateForShow(response.mutasi_keluar[i].jatuh_tempo);
            dataLoad += "</td>";
            dataLoad += "<td >";
            dataLoad += numberWithCommas("Rp. "+response.mutasi_keluar[i].nominal_bayar); 
            dataLoad += "</td>";
            dataLoad += "<td >";
            dataLoad += isFinished; 
            dataLoad += "</td>";
            dataLoad += "</tr>";

        }

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

        return day + " " + month +" "+year;
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


</script>