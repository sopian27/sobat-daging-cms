<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <div class="col-md-11">
        <hr style="margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    </div>
    <div class="container-fluid" id="data-trigger">
        <div class="row">
            <div class="col-md-2 offset-md-1">
                <input type="text" id="search" name="search" placeholder="search..." class="form-search">
            </div>
            <div class="col-md-2 offset-md-6">
                <input type="text" id="create_date" name="create_date" class="form-search" placeholder="sort...">
            </div>
        </div>
        <div class="row" style="margin-top: 60px;">
            <div class="col-md-7" style="margin-left:7%;margin-top:10px">
                <h4 id="div-create-date" style="text-decoration: underline;margin-left:2%"></h4>
                <div class="collapse-content"></div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="display: none;" id="div-inventory-update-detail">
        <div class="row">
            <div class="col-md-3 offset-md-1"><?= "" ?></div>
            <div class="col-md-2 offset-md-5"><?= $date ?></div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="row">
                    <div class="col-md-7 offset-md-2">
                        <form>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 offset-md-4 col-form-label">Purchase From : </label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="purchase_from" name="purchase_from" style="margin-top:2px">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-7 offset-md-2 justify-content-center">
                        <form method="post" id="form-livestock-inventory">
                            <div class="row mt-2 ">
                                <table class="table table-dark table-bordered data">
                                    <thead>
                                        <tr>
                                            <th> Kode </th>
                                            <th> Nama Barang </th>
                                            <th> Quantity </th>
                                            <th colspan="2"> Quantity Check</th>
                                        </tr>
                                    </thead>
                                    <tbody id='tbody-table-data'></tbody>
                                </table>
                            </div>
                            <div class="row d-flex justify-content-end" style="margin-top:30px">
                                <div class="col-md-2">
                                    <button class="form-control-button btn btn-outline-light button-action" onclick="clearAllData();"> Clear All </button>
                                </div>
                                <div class="col-md-2">
                                    <button class="form-control-button btn btn-outline-light button-action" onclick="return confirmData();"> Confirm </button>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-start formSubmitData" id="formSubmitData">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {});

    $(function() {
        $("#create_date").datepicker({
            format: "yyyymmdd",
            todayHighlight: true,
            autoclose: true
        })

        $("#create_date").val("sort....");
    });

    $(document).on('change', '#create_date', function() {
        var create_date = document.getElementById("create_date").value;
       // getData(create_date);
    });


    function getData(create_date) {
        $.ajax({
            url: '<?= site_url() ?>/inventory-livestock/getdata',
            method: 'post',
            dataType: 'json',
            data: {
                'create_date': create_date
            },
            success: function(data) {

                console.log(data);
                if (data.length > 0) {

                    $("#div-create-date").html(dateForShow(create_date));

                    var dataload = "";
                    dataload += '<div class="container"> ';
                    dataload += '<div class="row"> ';

                    for (i = 0; i < data.length; i++) {

                        var id_trx_po = data[i].id_trx_po;
                        var functionOnclick = 'getDetailLiveStock("' + id_trx_po + '","' + i + '")';
                        var functionOnclickCheck = 'getDetailCheck("' + id_trx_po + '")';

                        dataload += '<div class="col-md-6" style="margin-top:10px"> ';
                        dataload += '<a style="color:#a5662f;text-decoration:none" data-bs-toggle="collapse" ';
                        dataload += 'href="#collapseExample' + i + '"  ';
                        dataload += "onclick=" + functionOnclick + ">" + "Purchase From Distributor " + data[i].nama.toUpperCase(); + '</a>';
                        dataload += '</div>';
                        dataload += '<div class="col-md-1 offset-md-2"> ';

                        if (data[i].status == "1") {
                            dataload += '<input type="checkbox" checked name="' + data[i].id + '" class="" />';
                            dataload += '<a style="color:#a5662f;text-decoration:none;margin-left:10px" data-bs-toggle="collapse" ';
                            dataload += 'href="#collapseExample' + i + '"  ';
                            dataload += ">" + "<span class='fa fa-edit'></span>" + '</a>';
                        } else {
                            dataload += '<input type="checkbox" name="' + data[i].id + '" class="" />';
                            dataload += '<a style="color:#a5662f;text-decoration:none;margin-left:10px" data-bs-toggle="collapse" ';
                            dataload += 'href="#collapseExample' + i + '"  ';
                            dataload += "onclick=" + functionOnclickCheck + ">" + "<span class='fa fa-edit'></span>" + '</a>';
                        }


                        dataload += '</div>';

                        dataload += '<div class="collapse" id="collapseExample' + i + '">';
                        dataload += '<div class="card card-body" id="collapse-content' + i + '" style="background-color: transparent;border:none;">';
                        dataload += '</div>';
                        dataload += '</div>';

                    }

                    dataload += '</div>';
                    dataload += '</div>';

                    $('.collapse-content').append(dataload);

                } else {
                    $("#div-create-date").html("");
                    $('.collapse-content').html("");
                }

            },
            error: function(response) {
                console.log(response);
            }

        });
    }

    function getDetailLiveStock(id_trx_po, index) {

        $.ajax({
            url: '<?= site_url() ?>/inventory-livestock/getdetail',
            method: 'post',
            dataType: 'json',
            data: {
                'id_trx_po': id_trx_po
            },
            success: function(data) {
                console.log(data);
                if (data.length > 0) {

                    var dataload = "";
                    dataload += '<div class="container"> ';
                    dataload += '<div class="row"> ';

                    for (i = 0; i < data.length; i++) {

                        dataload += '<div class="col-md-6"> ';
                        dataload += data[i].nama_barang;
                        dataload += '</div>';
                        dataload += '<div class="col-md-2" style="margin-left:-150px"> ';
                        dataload += data[i].quantity + " " + data[i].satuan;
                        dataload += '</div>';

                    }
                    dataload += '</div>';
                    dataload += '</div>';

                    document.getElementById("collapse-content" + index).innerHTML = dataload;

                } else {
                    document.getElementById(index).innerHTML = "";
                }
            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }

    function getDetailCheck(id_trx_po) {

        $.ajax({
            url: '<?= site_url() ?>/inventory-livestock/getdetail',
            method: 'post',
            dataType: 'json',
            data: {
                'id_trx_po': id_trx_po
            },
            success: function(data) {
                console.log(data);
                if (data.length > 0) {

                    var dataLoad = "";
                    var id_trx_live_stocks = '';
                    dataLoad += '<div class="container"> ';
                    dataLoad += '<div class="row"> ';

                    for (i = 0; i < data.length; i++) {

                        dataLoad += "<tr>";
                        dataLoad += "<td>";
                        dataLoad += data[i].kode
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += data[i].nama_barang
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += data[i].quantity + " " + data[i].satuan
                        dataLoad += "</td>";
                        dataLoad += '<td width="20%"><input type="text" name="quantity_check[]" value="" class="form-control-label quantity-check" ></td>'
                        dataLoad += '<td class="data" data-dat="satuan" width="7%">'
                        dataLoad += '      <select name="satuan[]" id="" class="form-control">'
                        dataLoad += '          <option value="Kg">kg</option>'
                        dataLoad += '          <option value="Dus">Dus</option>'
                        dataLoad += '      </select>'
                        dataLoad += '<input type="hidden" name="id[]" value="' + data[i].id + '" class="form-control-label">'
                        dataLoad += '<input type="hidden" name="id_trx_live_stocks[]" value="' + id_trx_live_stocks + '" class="form-control-label">'
                        dataLoad += '</td>'
                        dataLoad += "</tr>";


                    }
                    dataLoad += '</div>';
                    dataLoad += '</div>';


                    $("#tbody-table-data").html(dataLoad);
                    $("#purchase_from").val(data[0].nama);
                    $("#data-trigger").hide();
                    $("#div-inventory-update-detail").show();

                }
            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }

    function confirmData() {

        var quantity_check = document.getElementsByName('quantity_check[]');
        var k = "";
        var submit = true;
        for (var i = 0; i < quantity_check.length; i++) {
            var a = quantity_check[i];
            k = k + "array[" + i + "].value= " + a.value + " ";
            var index = i;
            var value = a.value;

            console.log("array[" + index + "] => " + value + " => length:" + value.length);

            if (checkInvalid(value)) {
                alert("quantity check tidak boleh kosong");
                submit = false;
                break;
            } else {
                if (isNaN(value)) {
                    alert("quantity check harus number");
                    submit = false;
                    break;

                }
            }

        }

        if (submit == true) {
            console.log("submit " + submit);
            $("#form-livestock-inventory").attr('action', '<?php echo site_url() ?>/inventory-livestock/insertqtycheck');
            $("#form-livestock-inventory").submit();
        } else {
            return false;
        }
    }


    function checkInvalid(val) {
        if (val == null || val == "") {
            return true;
        }

        return false;
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
</script>