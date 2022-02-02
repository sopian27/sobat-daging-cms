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
</div>

<div class="container-fluid" id="data-trigger">
    <div class="row justify-content-center">
        <div class="container">
            <div class="row" style="margin: 30px;">
                <div class="text-center col-md-6 offset-md-3">
                    <h4 id="data-trigger-title">History Petty Cash</h4>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 offset-md-3" style="margin-top: 20px;">
                    <table class="table table-dark table-borderless" style="border: none;">
                        <thead>
                        </thead>
                        <tbody id="data-trigger-content">
                        <tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid" id="data-content" style="display: none;">
    <div class="row justify-content-center">
        <div class="container">
            <div class="row">
                <div class="col-md-3 offset-md-1" style="margin-top: 30px;">
                    <div>
                        <h4 id="data-content-title"></h4>
                    </div>
                </div>
                <div class="col-md-3 offset-md-4" style="margin-top: 30px;">
                    <div class="form-group row">
                        <label for="" class="col-sm-5 col-form-label" style="margin-top: -7px;">
                            <h4>Petty In </h4>
                        </label>
                        <div class="col-sm-5">
                            <h4>:&nbsp;Rp. <span id="data-content-pettyin"></span></h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-5 col-form-label" style="margin-top: -7px;">
                            <h4>Petty Out </h4>
                        </label>
                        <div class="col-sm-5">
                            <h4>:&nbsp;Rp. <span id="data-content-pettyout"></span></h4>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="" class="col-sm-5 col-form-label" style="margin-top: -7px;">
                            <h4>Saldo Petty</h4>
                        </label>
                        <div class="col-sm-5">
                            <h4>:&nbsp;Rp. <span id="data-content-sum"></span></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center col-md-6 offset-md-3" style="display: block;margin-top: 50px;border-width:1px;border-style: solid;border-color: white;padding:10px">
                <h4 id="data-content-title2"></h4>
            </div>
            <div class="row">
                <div class="col-sm-4 offset-md-2" style="margin-top: 20px;">
                    <table class="table table-dark table-bordered data">
                        <thead>
                            <tr>
                                <th colspan="3"> Petty In </th>
                            </tr>
                            <tr>
                                <th> Kode </th>
                                <th> Tambahan Saldo</th>
                                <th> Keterangan </th>
                            </tr>
                        </thead>
                        <tbody id="data-petty-in">
                        <tbody>
                    </table>
                </div>
                <div class="col-sm-4" style="margin-top: 20px;">
                    <table class="table table-dark table-bordered data">
                        <thead>
                            <tr>
                                <th colspan="3"> Petty Out </th>
                            </tr>
                            <tr>
                                <th> Kode </th>
                                <th> Tambahan Saldo</th>
                                <th> Keterangan </th>
                            </tr>
                        </thead>
                        <tbody id="data-petty-out">
                        <tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        var today = new Date();
        var year = today.getFullYear();
        var month = today.getMonth();
        //console.log(prefixMonth(month+1));
        //console.log(year);

        $("#data-trigger-title").html("Tahun " + year);

        loadData(year, prefixMonth(month + 1));
    });

    function prefixMonth(month) {
        if (month < 10)
            return "0" + month;
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

        $("#data-trigger-title").html("Tahun " + dateForShow(create_date));
        console.log(create_date);
        var today = new Date();
        var year = today.getFullYear();
        var month = today.getMonth();

        $("#data-content").hide();
        $("#data-trigger").show();

        getData(year, prefixMonth(month + 1), create_date);

    });

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function dateForShow(create_date) {

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

        return year + " Bulan " + month;
    }

    function getMonthName(year, month) {

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

    function getData(current_year, current_month, date) {

        $.ajax({
            url: '<?= site_url() ?>/history-petty-cash/getdata',
            method: 'post',
            dataType: 'json',
            data: {
                date_value: date
            },
            success: function(response) {

                var dataLoad = "";
                console.log(response);

                if (response.result != undefined) {
                    for (let i = 0; i < response.data.length; i++) {

                        var obj = response.data[i];
                        var key = Object.keys(obj)[0];
                        var value = obj[Object.keys(obj)[0]];

                        var functionOnclick = 'getDetailData("' + current_year + key + '")';

                        if (current_month === key) {

                            dataLoad += "<tr>";
                            dataLoad += "<td ><a style='color:#a5662f;' href='#' onclick='" + functionOnclick + "'>";
                            dataLoad += getMonthName(current_year, key);
                            dataLoad += "</a></td>";
                            dataLoad += "<td>";
                            dataLoad += "Rp. " + value;
                            dataLoad += "</td>";
                            dataLoad += "</tr>";

                        } else {
                            dataLoad += "<tr>";
                            dataLoad += "<td ><a style='color:white;' href='#' onclick='" + functionOnclick + "'>";
                            dataLoad += getMonthName(current_year, key);
                            dataLoad += "</a></td>";
                            dataLoad += "<td>";
                            dataLoad += "Rp. " + value;
                            dataLoad += "</td>";
                            dataLoad += "</tr>";
                        }


                    }
                }

                $("#data-trigger-content").html(dataLoad);

            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }


    function loadData(current_year, current_month) {

        $.ajax({
            url: '<?= site_url() ?>/history-petty-cash/loaddata',
            method: 'post',
            dataType: 'json',
            success: function(response) {

                var dataLoad = "";

                if (response.result != undefined) {
                    for (let i = 0; i < response.data.length; i++) {

                        var obj = response.data[i];
                        var key = Object.keys(obj)[0];
                        var value = obj[Object.keys(obj)[0]];

                        //console.log(i + ":" + key + ":" + value + ":" + obj);
                        //console.log(current_month + ":" + key);

                        var functionOnclick = 'getDetailData("' + current_year + key + '")';

                        if (current_month === key) {

                            dataLoad += "<tr>";
                            dataLoad += "<td ><a style='color:#a5662f;' href='#' onclick='" + functionOnclick + "'>";
                            dataLoad += getMonthName(current_year, key);
                            dataLoad += "</a></td>";
                            dataLoad += "<td>";
                            dataLoad += "Rp. " + value;
                            dataLoad += "</td>";
                            dataLoad += "</tr>";

                        } else {
                            dataLoad += "<tr>";
                            dataLoad += "<td ><a style='color:white;' href='#' onclick='" + functionOnclick + "'>";
                            dataLoad += getMonthName(current_year, key);
                            dataLoad += "</a></td>";
                            dataLoad += "<td>";
                            dataLoad += "Rp. " + value;
                            dataLoad += "</td>";
                            dataLoad += "</tr>";
                        }


                    }
                }

                $("#data-trigger-content").html(dataLoad);

            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }

    function getDetailData(date) {

        $.ajax({
            url: '<?= site_url() ?>/history-petty-cash/getdatahistory',
            method: 'post',
            dataType: 'json',
            data: {
                date_value: date
            },
            success: function(response) {

                console.log(response);

                var dataLoadIn = "";
                var dataLoadOut = "";
                for (let i = 0; i < response.data_in.length; i++) {

                    dataLoadIn += "<tr>";
                    dataLoadIn += "<td >";
                    dataLoadIn += response.data_in[i].kode;
                    dataLoadIn += "</td>";
                    dataLoadIn += "<td>";
                    dataLoadIn += "Rp. " + numberWithCommas(response.data_in[i].tambahan_saldo);
                    dataLoadIn += "</td>";
                    dataLoadIn += "<td>";
                    dataLoadIn += response.data_in[i].keterangan;
                    dataLoadIn += "</td>";
                    dataLoadIn += "</tr>";


                }

                for (let i = 0; i < response.data_out.length; i++) {

                    dataLoadOut += "<tr>";
                    dataLoadOut += "<td >";
                    dataLoadOut += response.data_out[i].kode;
                    dataLoadOut += "</td>";
                    dataLoadOut += "<td>";
                    dataLoadOut += "Rp. " + numberWithCommas(response.data_out[i].tambahan_saldo);
                    dataLoadOut += "</td>";
                    dataLoadOut += "<td>";
                    dataLoadOut += response.data_out[i].keterangan;
                    dataLoadOut += "</td>";
                    dataLoadOut += "</tr>";

                }

                var in_tot=0;
                var out_tot=0;

                console.log(response.in_tot.length==0);
                if(response.in_tot.length==0) {
                    in_tot=0;
                }else{
                    in_tot = response.in_tot[0].total;
                }

                if(response.out_tot.length==0){ 
                    out_tot=0;
                }else{
                    out_tot = response.out_tot[0].total;
                }

               
                var result = parseFloat(in_tot) - parseFloat(out_tot);
                if(result < 0){
                    $('#data-content-sum').css("color","red");
                }

                $("#data-content-title").html("History Petty Cash " + getMonthOnly(date));
                $("#data-content-title2").html("History Petty Cash " + getMonthOnly(date));
                $("#data-content-pettyin").html(numberWithCommas(in_tot));
                $("#data-content-pettyout").html(numberWithCommas(out_tot));
                $("#data-content-sum").html(numberWithCommas(result));
                $("#data-petty-in").html(dataLoadIn);
                $("#data-petty-out").html(dataLoadOut);
                $("#data-trigger-title").html("Tahun " + dateForShow(date));
                $("#data-content").show();
                $("#data-trigger").hide();

            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });


    }
</script>