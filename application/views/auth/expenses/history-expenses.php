<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <hr style="width: 1570px;margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    <div class="row">
        <div class="col-md-2 offset-md-1">
            <input type="text" id="search" name="search" placeholder="search..." class="form-search">
        </div>
        <div class="col-md-2 offset-md-6">
            <input type="text" id="create_date" name="create_date" class="form-search" placeholder="sort...">
        </div>
    </div>

    <div class="container-fluid" style="margin-top: 40px;">
        <div class="row justify-content-center" id="form-sallary">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 offset-md-1">
                        <div>
                            <a class="form-control-button btn" style="background-color: #a5662f;border:none;padding:10px"> Operational Expenses </a>
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
                    <div class="col-md-5 offset-md-6" style="margin-top: 30px;display: none;" id="penggunaan-dana-div">
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
                            fi</tbody>
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

        <div class="row justify-content-center" style="display: none;" id="form-invoice-pembelian">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 offset-md-1">
                        <div>
                            <a class="form-control-button btn btn-outline-light button-action" onclick="showOperational();"> Operational Expenses </a>
                        </div>
                        <div style="margin-top:30px">
                            <a class="form-control-button btn" style="background-color: #a5662f;border:none;padding:10px"> Sallary </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top:60px"></div>
</div>

<script>
    function showSallary() {
        $("#form-sallary").hide();
        $("#form-invoice-pembelian").show();
    }

    function showOperational() {
        $("#form-sallary").show();
        $("#form-invoice-pembelian").hide();
    }


    $(function() {
        $("#create_date").datepicker({
            todayHighlight: true,
            format: "yyyymm",
            startView: "months",
            minViewMode: "months",
            autoclose: true
        })
    });

    $(document).on('change', '#create_date', function() {
        var create_date = document.getElementById("create_date").value;

        var today = new Date();
        var year = today.getFullYear();
        var month = today.getMonth();

        getData(create_date);

    });

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
            url: '<?= site_url() ?>/history-expenses/getdata',
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
                $("#data-content-title2").html("Operational Expenses " + getMonthOnly(date));
                $("#data-content-title").html("Operational Expenses " + getMonthOnly(date));
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

    /*paging start */

    
    /*paging end */

</script>