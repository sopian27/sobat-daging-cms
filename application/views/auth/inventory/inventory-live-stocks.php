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
        <div class="row" style="margin-top: 60px;">
            <div class="col-md-7" style="margin-left:7%;margin-top:10px">
                <div class="collapse-content"></div>
                <input type="hidden" name="halaman_paging_trx" id="halaman_paging_trx" value="1">
                <div class="pagination-result_trx" style="margin-left:160px;margin-top:10px;margin-left:30%"></div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="display: none;" id="div-inventory-update-detail">
        <div class="row">
            <div class="col-md-3 offset-md-1"><?= $id_trx_po ?></div>
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
                        <div class="row mt-2 ">
                            <table class="table table-dark table-bordered data">
                                <thead>
                                    <tr>
                                        <th> Kode </th>
                                        <th> Nama Barang </th>
                                        <th> Quantity </th>
                                        <th colspan="2"> Quantity Check</th>
                                        <th width="10%"> Action </th>
                                    </tr>
                                </thead>
                                <tbody id='tbody-table-data'></tbody>
                            </table>
                            <input type="hidden" name="halaman_paging_trx_detail" id="halaman_paging_trx_detail" value="1">
                            <div class="pagination-result_trx_detail" style="margin-top:10px;margin-left:45%"></div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="display: none;" id="div-inventory-update">
        <div class="row">
            <div class="col-md-3 offset-md-1" id="div-id-trx-po"></div>
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
                                    <input type="text" class="form-control" id="purchase_from_edit" name="purchase_from_edit" style="margin-top:2px">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-7 offset-md-2 justify-content-center">
                        <div class="row mt-2 ">
                            <table class="table table-dark table-bordered data">
                                <thead>
                                    <tr>
                                        <th> Kode </th>
                                        <th> Nama Barang </th>
                                        <th> Quantity </th>
                                        <th colspan="2"> Quantity Update</th>
                                        <th width="10%"> Action </th>
                                    </tr>
                                </thead>
                                <tbody id='tbody-table-data-edit'></tbody>
                            </table>
                            <input type="hidden" name="halaman_paging_trx_edit" id="halaman_paging_trx_edit" value="1">
                            <div class="pagination-result_trx_edit" style="margin-top:10px;margin-left:45%"></div>
                        </div>
                        <div class="row d-flex justify-content-end" style="margin-top:30px">
                            <div class="col-md-2">
                                <button class="form-control-button btn btn-outline-light button-action" onclick="clearAllDataEdit();"> Clear All </button>
                            </div>
                            <div class="col-md-2">
                                <button class="form-control-button btn btn-outline-light button-action" onclick="return confirmDataEdit();"> Confirm </button>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-start formSubmitData" id="formSubmitData">
                        </div>
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
            format: "yyyy-mm-dd",
            todayHighlight: true,
            autoclose: true
        })

        $("#create_date").val("...");
    });

    $(document).on('change', '#create_date', function() {
        var create_date = document.getElementById("create_date").value;

        var batasTampilData = 10;
        $("#halaman_paging_trx").val("1");
        var halaman = $('#halaman_paging_trx').val();
        var keyword = $("#search").val();

        getData(create_date.replaceAll("-", ""), keyword, batasTampilData, halaman);
    });

    function searchData() {

        var batasTampilData = 10;
        $("#halaman_paging_trx").val("1");
        var halaman = $('#halaman_paging_trx').val();
        var keyword = $("#search").val();
        var create_date = document.getElementById("create_date").value;
        getData(create_date.replaceAll("-", ""), keyword, batasTampilData, halaman);

    }


    function getData(create_date, keyword, batasTampilData, halaman) {
        $.ajax({
            url: '<?= site_url() ?>/inventory-livestock/getdata',
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

                    dataload += '<h4 style="text-decoration: underline;margin-top:10px">' + dateForShow(data.data[0].create_date) + '</h4>'

                    for (i = 0; i < data.length; i++) {
                        /*
                        if (create_date != "") {
                            dataload += '<h4 style="text-decoration: underline;margin-top:10px">' + dateForShow(create_date) + '</h4>'
                        } else {
                            dataload += '<h4 style="text-decoration: underline;margin-top:10px">' + dateForShow(data.data[i].update_date) + '</h4>'
                        }
                        */

                        var id_trx_po = data.data[i].id_trx_po;
                        var functionOnclick = 'getDetailLiveStock("' + id_trx_po + '","' + i + '")';
                        var functionOnclickCheck = 'dataPagingDetailCheck("' + id_trx_po + '")';
                        var functionOnclickEdit = 'dataPagingEditCheck("' + id_trx_po + '")';

                        dataload += '<div class="col-md-6" style="margin-top:10px"> ';
                        dataload += '<a style="color:#B89874;text-decoration:none" data-bs-toggle="collapse" ';
                        dataload += 'href="#collapseExample' + i + '"  ';
                        //dataload += "onclick=" + functionOnclick + ">" + "Purchase From Distributor " + data.data[i].nama.toUpperCase(); + '</a>';
                        dataload += "onclick=" + functionOnclick + ">" + data.data[i].nama.toUpperCase(); + '</a>';
                        dataload += '</div>';
                        dataload += '<div class="col-md-2 offset-md-2"> ';

                        if (data.data[i].id_trx_live_stocks != "") {
                            dataload += '<input type="checkbox" checked name="' + data.data[i].id + '" class="" />';
                            dataload += '<a style="color:#B89874;text-decoration:none;margin-left:10px" data-bs-toggle="collapse" ';
                            dataload += 'href="#collapseExample' + i + '"  ';
                            dataload += ">" + "<span class='fa fa-eye'></span>" + '</a>';
                            dataload += '<a style="color:#B89874;text-decoration:none;margin-left:10px" data-bs-toggle="collapse" ';
                            dataload += 'href="#collapseExample' + i + '"  ';
                            dataload += ">" + "<span class='fa fa-edit'></span>" + '</a>';
                        } else {
                            dataload += '<input type="checkbox" name="' + data.data[i].id + '" class="" />';
                            dataload += '<a style="color:#B89874;text-decoration:none;margin-left:10px" data-bs-toggle="collapse" ';
                            dataload += 'href="#collapseExample' + i + '"  ';
                            dataload += "onclick=" + functionOnclickCheck + ">" + "<span class='fa fa-eye'></span>" + '</a>';
                            dataload += '<a style="color:#B89874;text-decoration:none;margin-left:10px" data-bs-toggle="collapse" ';
                            dataload += 'href="#collapseExample' + i + '"  ';
                            dataload += "onclick=" + functionOnclickEdit + ">" + "<span class='fa fa-edit'></span>" + '</a>';
                        }

                        dataload += '</div>';

                        dataload += '<div class="collapse" id="collapseExample' + i + '">';
                        dataload += '<div class="card card-body" id="collapse-content' + i + '" style="background-color: transparent;border:none;">';
                        dataload += '</div>';
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

    function getDetailLiveStock(id_trx_po, index) {

        $.ajax({
            url: '<?= site_url() ?>/inventory-livestock/getDetailTrx',
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

    function dataPagingDetailCheck(id_trx_po) {

        batasTampilData = 10;
        halaman = $('#halaman_paging_trx_detail').val();
        getDetailCheck(halaman, id_trx_po, batasTampilData);
    }

    function getDetailCheck(halaman, id_trx_po, batasTampilData) {

        $.ajax({
            url: '<?= site_url() ?>/inventory-livestock/getdetail',
            method: 'post',
            dataType: 'json',
            data: {
                "id_trx_po": id_trx_po,
                "halaman": halaman,
                "batastampil": batasTampilData
            },
            success: function(data) {
                console.log(data);
                if (data.length > 0) {

                    var dataLoad = "";
                    var id_trx_live_stocks = '<?= $id_trx_po ?>';
                    //dataLoad += '<div class="container"> ';
                    //dataLoad += '<div class="row"> ';

                    for (i = 0; i < data.length; i++) {

                        var functionOnclick = 'update_data("' + data.data[i].id_trx_po + '","' + i + '","' + halaman + '")';

                        dataLoad += "<tr>";
                        dataLoad += "<td>";
                        dataLoad += data.data[i].kode
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += data.data[i].nama_barang
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += data.data[i].quantity + " " + data.data[i].satuan
                        dataLoad += "</td>";
                        dataLoad += '<td width="20%"><input type="number" step="0.01" name="quantity_check[]" id="quantity_check' + i + '"  value="' + data.data[i].quantity_check + '" class="form-control-label quantity-check" onkeypress="validate(event)"></td>'
                        dataLoad += '<td class="data" data-dat="satuan" width="7%">'
                        dataLoad += '<select name="satuan[]" id="satuan' + i + '" class="form-control">'
                        if (data.data[i].satuan == "Dus") {
                            dataLoad += '<option value="Kg">kg</option>'
                            dataLoad += '<option selected value="Dus">Dus</option>'
                        } else if (data.data[i].satuan == "Kg") {
                            dataLoad += '<option selected value="Kg">kg</option>'
                            dataLoad += '<option value="Dus">Dus</option>'
                        } else {
                            dataLoad += '<option value="Kg">kg</option>'
                            dataLoad += '<option value="Dus">Dus</option>'
                        }
                        dataLoad += '</select>'
                        dataLoad += '<input type="hidden" name="id[]" id="id' + i + '" value="' + data.data[i].id + '" class="form-control-label">'
                        dataLoad += '<input type="hidden" name="id_trx_live_stocks[]" id="id_trx_live_stocks' + i + '"  value="' + id_trx_live_stocks + '" class="form-control-label">'
                        dataLoad += '<input type="hidden" name="id_trx_po[]" id="id_trx_po" value="' + id_trx_po + '" class="form-control-label">'
                        dataLoad += '</td>'
                        dataLoad += "<td>";

                        if (data.data[i].status == '4') {
                            dataLoad += "<a class='form-control-button btn-success' style='background-color: #B89874'><span class='fas fa-check'></span></a>";
                        } else {
                            dataLoad += "<a class='form-control-button btn btn-outline-light button-action' onclick='" + functionOnclick + "'><span class='fas fa-check'></span></a>";
                        }

                        dataLoad += "</td>";
                        dataLoad += "</tr>";


                    }
                    //dataLoad += '</div>';
                    //dataLoad += '</div>';

                    var totalDataBarang = data.length_paging;
                    var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

                    $('.pagination-result_trx_detail').html(paginationViewHTMLDetail(halaman, totalHalaman, id_trx_po))


                    $("#tbody-table-data").html(dataLoad);
                    $("#purchase_from").val(data.data[0].nama);
                    $("#data-trigger").hide();
                    $("#div-inventory-update-detail").show();

                } else {
                    $('.pagination-result_trx_detail').html("");
                }
            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }


    function dataPagingEditCheck(id_trx_po) {

        batasTampilData = 10;
        halaman = $('#halaman_paging_trx_edit').val();
        getEditCheck(halaman, id_trx_po, batasTampilData);
    }

    function getEditCheck(halaman, id_trx_po, batasTampilData) {

        $.ajax({
            url: '<?= site_url() ?>/inventory-livestock/getedit',
            method: 'post',
            dataType: 'json',
            data: {
                "id_trx_po": id_trx_po,
                "halaman": halaman,
                "batastampil": batasTampilData
            },
            success: function(data) {
                console.log(data);
                if (data.length > 0) {

                    var dataLoad = "";
                    var id_trx_live_stocks = '<?= $id_trx_po ?>';

                    for (i = 0; i < data.length; i++) {

                        var functionOnclick = 'update_data_edit("' + data.data[i].id_trx_po + '","' + i + '","' + halaman + '")';

                        dataLoad += "<tr>";
                        dataLoad += "<td>";
                        dataLoad += data.data[i].kode
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += data.data[i].nama_barang
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += data.data[i].quantity + " " + data.data[i].satuan
                        dataLoad += "</td>";
                        dataLoad += '<td width="20%"><input type="number" step="0.01" name="quantity_update[]" id="quantity_update' + i + '"  value="' + data.data[i].quantity_update + '" class="form-control-label quantity-check" onkeypress="validate(event)"></td>'
                        dataLoad += '<td class="data" data-dat="satuan" width="7%">'
                        dataLoad += '<select name="satuan[]" id="satuan' + i + '" class="form-control">'
                        if (data.data[i].satuan == "Dus") {
                            dataLoad += '<option value="Kg">kg</option>'
                            dataLoad += '<option selected value="Dus">Dus</option>'
                        } else if (data.data[i].satuan == "Kg") {
                            dataLoad += '<option selected value="Kg">kg</option>'
                            dataLoad += '<option value="Dus">Dus</option>'
                        } else {
                            dataLoad += '<option value="Kg">kg</option>'
                            dataLoad += '<option value="Dus">Dus</option>'
                        }
                        dataLoad += '</select>'
                        dataLoad += '<input type="hidden" name="id[]" id="id' + i + '" value="' + data.data[i].id + '" class="form-control-label">'
                        dataLoad += '<input type="hidden" name="id_trx_live_stocks[]" id="id_trx_live_stocks' + i + '"  value="' + id_trx_live_stocks + '" class="form-control-label">'
                        dataLoad += '<input type="hidden" name="id_trx_po[]" id="id_trx_po" value="' + id_trx_po + '" class="form-control-label">'
                        dataLoad += '<input type="hidden" name="quantity_before[]" id="quantity_before'+i+'" value="' +  data.data[i].quantity + '" class="form-control-label">'
                        dataLoad += '</td>'
                        dataLoad += "<td>";

                        if (data.data[i].status == '0') {
                            dataLoad += "<a class='form-control-button btn-success' style='background-color: #B89874'><span class='fas fa-check'></span></a>";
                        } else {
                            dataLoad += "<a class='form-control-button btn btn-outline-light button-action' onclick='" + functionOnclick + "'><span class='fas fa-check'></span></a>";
                        }

                        dataLoad += "</td>";
                        dataLoad += "</tr>";


                    }
                    //dataLoad += '</div>';
                    //dataLoad += '</div>';

                    var totalDataBarang = data.length_paging;
                    var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

                    $('.pagination-result_trx_edit').html(paginationViewHTMLEdit(halaman, totalHalaman, id_trx_po))


                    $("#tbody-table-data-edit").html(dataLoad);
                    $("#div-id-trx-po").html(id_trx_po);
                    $("#purchase_from_edit").val(data.data[0].nama);
                    $("#data-trigger").hide();
                    $("#div-inventory-update").show();

                } else {
                    $('.pagination-result_trx_edit').html("");
                }
            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }

    function validate(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
            // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault) theEvent.preventDefault();
        }
    }

    function update_data(id_trx_po, it, halaman) {
        console.log("id_trx_po:" + id_trx_po);
        console.log("it:" + it);
        console.log("halaman:" + halaman);

        var quantity_check = $("#quantity_check" + it).val();
        var id = $("#id" + it).val();
        var satuan = $("#satuan" + it).val();

        if (checkInvalid(quantity_check) || quantity_check == '0') {
            alert("quantity check tidak boleh kosong");
            return;
        }

        $.ajax({
            url: '<?= site_url() ?>/inventory-livestock/update-quantity-check',
            method: 'post',
            dataType: 'json',
            data: {
                'id': id,
                'quantity_check': quantity_check,
                'id_trx_po': id_trx_po,
                'satuan': satuan
            },
            success: function(response) {

                dataPagingDetailCheck(id_trx_po);

            },
            error: function(response) {
                console.log(response);
            }

        });

    }

    function update_data_edit(id_trx_po, it, halaman) {
        console.log("id_trx_po:" + id_trx_po);
        console.log("it:" + it);
        console.log("halaman:" + halaman);

        var quantity_update = $("#quantity_update" + it).val();
        var id = $("#id" + it).val();
        var satuan = $("#satuan" + it).val();
        var quantity_before = $("#quantity_before" + it).val();

        if (checkInvalid(quantity_update) || quantity_update == '0') {
            alert("quantity update tidak boleh kosong");
            return;
        }

        $.ajax({
            url: '<?= site_url() ?>/inventory-livestock/update-quantity-edit',
            method: 'post',
            dataType: 'json',
            data: {
                'id': id,
                'quantity_update': quantity_update,
                'id_trx_po': id_trx_po,
                'quantity': quantity_before,
                'satuan': satuan
            },
            success: function(response) {

                dataPagingEditCheck(id_trx_po);

            },
            error: function(response) {
                console.log(response);
            }

        });

    }


    function clearAllData() {

        var id_trx_po = $("#id_trx_po").val();

        $.ajax({
            url: '<?= site_url() ?>/inventory-livestock/clear-all',
            method: 'post',
            dataType: 'json',
            async: false,
            data: {
                'id_trx_po': id_trx_po
            },
            success: function(response) {
                alert("clear all");
                location.href = "<?= site_url() ?>/inventory-livestock";
            },
            error: function(response) {
                console.log(response);
            }

        });

    }

    function clearAllDataEdit() {

        var id_trx_po = $("#id_trx_po").val();

        $.ajax({
            url: '<?= site_url() ?>/inventory-livestock/clear-all-edit',
            method: 'post',
            dataType: 'json',
            async: false,
            data: {
                'id_trx_po': id_trx_po
            },
            success: function(response) {
                alert("clear all");
                location.href = "<?= site_url() ?>/inventory-livestock";
            },
            error: function(response) {
                console.log(response);
            }

        });

    }

    function confirmData() {

        var id_trx_live_stocks = '<?= $id_trx_po ?>';
        var id_trx_po = $("#id_trx_po").val();

        var harga_satuan = document.getElementsByName('quantity_check[]');
        var k = "";
        var submit = true;
        for (var i = 0; i < harga_satuan.length; i++) {
            var a = harga_satuan[i];
            k = k + "array[" + i + "].value= " + a.value + " ";
            var index = i;
            var value = a.value;

            console.log("array[" + index + "] => " + value + " => length:" + value.length);

            if (checkInvalid(value) || value == '0') {
                alert("quantity check tidak boleh kosong");
                submit = false;
                break;
            }

        }

        if (submit == true) {
            console.log("submit " + submit);

            $.ajax({
                url: '<?= site_url() ?>/inventory-livestock/confirm',
                method: 'post',
                dataType: 'json',
                async: false,
                data: {
                    'id_trx_live_stocks': id_trx_live_stocks,
                    'id_trx_po': id_trx_po
                },
                success: function(response) {
                    alert("success insert");
                    location.href = "<?= site_url() ?>/inventory-livestock";
                },
                error: function(response) {
                    console.log(response);
                }

            });

        } else {
            return false;
        }

    }


    function confirmDataEdit() {

        var id_trx_live_stocks = '<?= $id_trx_po ?>';
        var id_trx_po = $("#id_trx_po").val();

        var harga_satuan = document.getElementsByName('quantity_update[]');
        var k = "";
        var submit = true;
        for (var i = 0; i < harga_satuan.length; i++) {
            var a = harga_satuan[i];
            k = k + "array[" + i + "].value= " + a.value + " ";
            var index = i;
            var value = a.value;

            console.log("array[" + index + "] => " + value + " => length:" + value.length);

            if (checkInvalid(value) || value == '0') {
                alert("quantity update tidak boleh kosong");
                submit = false;
                break;
            }

        }

        if (submit == true) {
            console.log("submit " + submit);

            $.ajax({
                url: '<?= site_url() ?>/inventory-livestock/confirm-edit',
                method: 'post',
                dataType: 'json',
                async: false,
                data: {
                    'id_trx_live_stocks': id_trx_live_stocks,
                    'id_trx_po': id_trx_po
                },
                success: function(response) {
                    alert("success insert");
                    location.href = "<?= site_url() ?>/inventory-livestock";
                },
                error: function(response) {
                    console.log(response);
                }

            });

        } else {
            return false;
        }

    }

    /*
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
    */


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

        //return day + " " + month + " " + year;
        return month + " " + year;
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

    function paginationViewHTMLDetail(halaman, totalHalaman, id_trx_po) { //halaman 1 total 6

        var data_load = '';
        prev = parseInt(halaman) - 1;
        next = parseInt(halaman) + 1;
        minimal_page = parseInt(halaman) - 2;
        max_page = parseInt(halaman) + 2;
        var prev_v = "dataPagingBarangHREFTrxDetail('" + prev + "','" + id_trx_po + "')";
        var next_v = "dataPagingBarangHREFTrxDetail('" + next + "','" + id_trx_po + "')";
        var halaman1 = "dataPagingBarangHREFTrxDetail('1','" + id_trx_po + "')";
        var halaman2 = "dataPagingBarangHREFTrxDetail('2','" + id_trx_po + "')";
        var halaman3 = "dataPagingBarangHREFTrxDetail('3','" + id_trx_po + "')";
        var halaman4 = "dataPagingBarangHREFTrxDetail('4','" + id_trx_po + "')";
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
            var onclk = "dataPagingBarangHREFTrxDetail('" + i + "','" + id_trx_po + "')";

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

    function dataPagingBarangHREFTrxDetail(halaman, id_trx_po) {
        $('#halaman_paging_trx_detail').val(halaman)
        dataPagingDetailCheck(id_trx_po);
    }

    function paginationViewHTMLEdit(halaman, totalHalaman, id_trx_po) { //halaman 1 total 6

        var data_load = '';
        prev = parseInt(halaman) - 1;
        next = parseInt(halaman) + 1;
        minimal_page = parseInt(halaman) - 2;
        max_page = parseInt(halaman) + 2;
        var prev_v = "dataPagingBarangHREFTrxEdit('" + prev + "','" + id_trx_po + "')";
        var next_v = "dataPagingBarangHREFTrxEdit('" + next + "','" + id_trx_po + "')";
        var halaman1 = "dataPagingBarangHREFTrxEdit('1','" + id_trx_po + "')";
        var halaman2 = "dataPagingBarangHREFTrxEdit('2','" + id_trx_po + "')";
        var halaman3 = "dataPagingBarangHREFTrxEdit('3','" + id_trx_po + "')";
        var halaman4 = "dataPagingBarangHREFTrxEdit('4','" + id_trx_po + "')";
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
            var onclk = "dataPagingBarangHREFTrxEdit('" + i + "','" + id_trx_po + "')";

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

    function dataPagingBarangHREFTrxEdit(halaman, id_trx_po) {
        $('#halaman_paging_trx_edit').val(halaman)
        dataPagingEditCheck(id_trx_po);
    }
</script>