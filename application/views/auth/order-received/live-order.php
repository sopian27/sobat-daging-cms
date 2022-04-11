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
            <div class="col-md-3 offset-md-1"><?= $id_trx_order ?></div>
            <div class="col-md-2 offset-md-5"><?= $date ?></div>
        </div>
        <div class="container-fluid" style="margin-top: 20px;">
            <div class="row justify-content-center">
                <div class="row">
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Nomor Surat Jalan </label>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="nomor_surat_jalan" name="nomor_surat_jalan">
                            </div>
                        </div>
                        <hr style="border-width: 2px;border-style: solid;border-color:white">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Nama Pelanggan </label>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Nomor Hp </label>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="nomor_hp" name="nomor_hp">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Alamat Pengiriman</label>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="alamat" name="alamat">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Tanggal Pengiriman</label>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="tgl_pengiriman" name="tgl_pengiriman">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-7 offset-md-2 justify-content-center">
                        <div class="row mt-2 ">
                            <table class="table table-dark table-bordered data">
                                <thead>
                                    <tr class="align-middle">
                                        <th rowspan="2"> Kode </th>
                                        <th rowspan="2"> Nama Bahan </th>
                                        <th rowspan="2"> Nama Barang </th>
                                        <th rowspan="1" colspan="2"> Quantity</th>
                                        <th rowspan="2"> Note </th>
                                        <th rowspan="2"> Action </th>
                                    </tr>
                                    <tr>
                                        <th> Quantity / Kg </th>
                                        <th> Pcs / Bungkus </th>
                                    </tr>
                                </thead>
                                <tbody id='tbody-table-data'></tbody>
                            </table>
                            <input type="hidden" name="halaman_paging_trx_detail" id="halaman_paging_trx_detail" value="1">
                            <div class="pagination-result_trx_detail" style="margin-top:10px;margin-left:45%"></div>
                        </div>
                        <div class="row d-flex justify-content-end">
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
    <div class="container-fluid" style="display: none;" id="div-live-order-date">
        <div class="row">
            <div class="col-md-2 offset-md-1" id="date-live-order"></div>
        </div>
        <div class="container-fluid" style="margin-top: 20px;">
            <div class="row justify-content-center">
                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-6 offset-md-1 justify-content-center">
                        <div class="row mt-2 ">
                            <table class="table table-dark table-bordered data" style="display: none;">
                                <tbody id='tbody-table-data-live-order'></tbody>
                            </table>
                            <div id="data-live-order"></div>
                            <input type="hidden" name="halaman_paging_live_order" id="halaman_paging_live_order" value="1">
                            <div class="pagination-result-live-order" style="margin-top:10px;margin-left:45%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top:20px"></div>
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

    function liveOrderPaging(create_date) {

        var batasTampilData = 10;
        var halaman = $('#halaman_paging_live_order').val();
        getLiveOrderDate(create_date, batasTampilData, halaman);

    }

    function update_data(id_trx_order, it, halaman) {
        console.log("id_trx_order:" + id_trx_order);
        console.log("it:" + it);
        console.log("halaman:" + halaman);

        var bungkusan = $("#bungkusan" + it).val();
        var id = $("#id" + it).val();
        var note = $("#note" + it).val();
        var id_trx_live_order = $("#id_trx_live_order" + it).val();

        if (checkInvalid(bungkusan) || bungkusan == '0') {
            alert("bungkusan tidak boleh kosong");
            return;
        }

        $.ajax({
            url: '<?= site_url() ?>/live-order/update-bungkusan',
            method: 'post',
            dataType: 'json',
            data: {
                'id': id,
                'bungkusan': bungkusan,
                'id_trx_order': id_trx_order,
                'id_trx_live_order': id_trx_live_order,
                'note': note
            },
            success: function(response) {

                dataPagingDetailCheck(id_trx_order);

            },
            error: function(response) {
                console.log(response);
            }

        });

    }

    function confirmData() {

        var id_trx_order = $("#id_trx_order").val();

        var bungkusan = document.getElementsByName('bungkusan[]');
        var k = "";
        var submit = true;
        for (var i = 0; i < bungkusan.length; i++) {
            var a = bungkusan[i];
            k = k + "array[" + i + "].value= " + a.value + " ";
            var index = i;
            var value = a.value;

            console.log("array[" + index + "] => " + value + " => length:" + value.length);

            if (checkInvalid(value) || value == '0') {
                alert("bungkusan tidak boleh kosong");
                submit = false;
                break;
            }

        }

        if (submit == true) {
            console.log("submit " + submit);

            $.ajax({
                url: '<?= site_url() ?>/live-order/update-bungkusan-confirm',
                method: 'post',
                dataType: 'json',
                async: false,
                data: {
                    'id_trx_order': id_trx_order
                },
                success: function(response) {
                    alert("success insert");
                    var id_trx_encrypt = id_trx_order.replace(/\//g, "_");
                    location.href = "<?= site_url() ?>/history-order/print-directly/"+id_trx_encrypt;
                },
                error: function(response) {
                    console.log(response);
                }

            });

        } else {
            return false;
        }

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

    function getDetailCheck(halaman, id_trx_order, batasTampilData) {

        $.ajax({
            url: '<?= site_url() ?>/live-order/live-order-detail',
            method: 'post',
            dataType: 'json',
            data: {
                "id_trx_order": id_trx_order,
                "halaman": halaman,
                "batastampil": batasTampilData
            },
            success: function(data) {
                console.log(data);
                if (data.length > 0) {

                    var dataLoad = "";
                    var id_trx_live_order = '<?= $id_trx_order ?>';

                    for (i = 0; i < data.length; i++) {

                        var functionOnclick = 'update_data("' + data.data[i].id_trx_order + '","' + i + '","' + halaman + '")';

                        dataLoad += "<tr>";
                        dataLoad += "<td>";
                        dataLoad += data.data[i].kode
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += data.data[i].nama_barang
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += data.data[i].note_nama_barang
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += data.data[i].quantity + " " + data.data[i].satuan
                        dataLoad += "</td>";
                        dataLoad += '<td width="15%"><input type="text" name="bungkusan[]" id="bungkusan' + i + '"  value="' + data.data[i].bungkusan + '" class="form-control-label quantity-check" onkeypress="validate(event)"></td>'
                        dataLoad += '<td class="data" data-dat="satuan" width="20%">'
                        dataLoad += '<input type="text" name="note[]" id="note' + i + '" class="form-control-label " value="' + data.data[i].keterangan + '">'
                        dataLoad += '<input type="hidden" name="id[]" id="id' + i + '" value="' + data.data[i].id + '" class="form-control-label">'
                        dataLoad += '<input type="hidden" name="id_trx_order[]" id="id_trx_order" value="' + id_trx_order + '" class="form-control-label">'
                        dataLoad += '<input type="hidden" name="id_trx_live_order[]" id="id_trx_live_order' + i + '"  value="' + id_trx_live_order + '" class="form-control-label">'
                        dataLoad += '</td>'
                        dataLoad += "<td>";

                        if (data.data[i].status == '1') {
                            dataLoad += "<a class='form-control-button btn-success' style='background-color: #B89874'><span class='fas fa-check'></span></a>";
                        } else {
                            dataLoad += "<a class='form-control-button btn btn-outline-light button-action' onclick='" + functionOnclick + "'><span class='fas fa-check'></span></a>";
                        }

                        dataLoad += "</td>";
                        dataLoad += "</tr>";


                    }

                    var totalDataBarang = data.length_paging;
                    var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

                    $('.pagination-result_trx_detail').html(paginationViewHTMLDetail(halaman, totalHalaman, id_trx_order))


                    $("#tbody-table-data").html(dataLoad);
                    $("#nomor_surat_jalan").val(data.data[0].no_surat_jalan);
                    $("#nama_pelanggan").val(data.data[0].nama_pelanggan);
                    $("#nomor_hp").val(data.data[0].nomor);
                    $("#alamat").val(data.data[0].alamat);
                    $("#tgl_pengiriman").val(dateForShow(data.data[0].tgl_pengiriman));
                    $("#data-trigger").hide();
                    $("#div-inventory-update-detail").show();

                }else{
                    $('.pagination-result_trx_detail').html("");
                }
            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }


    function clearAllData() {

        var id_trx_order = $("#id_trx_order").val();

        $.ajax({
            url: '<?= site_url() ?>/live-order/clear-all',
            method: 'post',
            dataType: 'json',
            async: false,
            data: {
                'id_trx_order': id_trx_order
            },
            success: function(response) {
                alert("clear all");
                location.href = "<?= site_url() ?>/live-order";
            },
            error: function(response) {
                console.log(response);
            }

        });

    }


    function getData(create_date, keyword, batasTampilData, halaman) {
        $.ajax({
            url: '<?= site_url() ?>/live-order/getdata',
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

                        var functionOnclickDate = 'liveOrderPaging("' + create_date + '")';

                        /*
                        if (create_date != "") {
                            dataload += '<a href="#" style="color:white;text-decoration:none"  onclick=' + functionOnclickDate + '><h4 style="text-decoration: underline;margin-top:10px">' + dateForShow(create_date) + '</h4></a>'
                        } else {
                            dataload += '<a href="#" style="color:white;text-decoration:none"  onclick=' + functionOnclickDate + '><h4 style="text-decoration: underline;margin-top:10px">' + dateForShow(data.data[i].update_date) + '</h4></a>'
                        }
                        */

                        var id_trx_order = data.data[i].id_trx_order;
                        var functionOnclick = 'getDetailLiveOrder("' + id_trx_order + '","' + i + '")';
                        var functionOnclickCheck = 'dataPagingDetailCheck("' + id_trx_order + '")';

                        dataload += '<div class="col-md-6" style="margin-top:10px"> ';
                        dataload += '<a style="color:#B89874;text-decoration:none" data-bs-toggle="collapse" ';
                        dataload += 'href="#collapseExample' + i + '"  ';
                        dataload += "onclick=" + functionOnclick + ">" + "Purchase From Distributor " + data.data[i].nama_pelanggan.toUpperCase(); + '</a>';
                        dataload += '</div>';
                        dataload += '<div class="col-md-1 offset-md-2"> ';

                        if (data.data[i].status >= 2) {
                            dataload += '<input type="checkbox" checked name="' + data.data[i].id + '" class="" />';
                            dataload += '<a style="color:#B89874;text-decoration:none;margin-left:10px" data-bs-toggle="collapse" ';
                            dataload += 'href="#collapseExample' + i + '"  ';
                            dataload += ">" + "<span class='fa fa-edit'></span>" + '</a>';
                        } else {
                            dataload += '<input type="checkbox" name="' + data.data[i].id + '" class="" />';
                            dataload += '<a style="color:#B89874;text-decoration:none;margin-left:10px" data-bs-toggle="collapse" ';
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

    /*
    function getLiveOrderDate(create_date, batasTampilData, halaman) {

        $.ajax({
            url: '<?= site_url() ?>/live-order/get-date',
            method: 'post',
            dataType: 'json',
            data: {
                "create_date": create_date,
                "halaman": halaman,
                "batastampil": batasTampilData
            },
            success: function(data) {
                console.log(data);
                if (data.length > 0) {

                    var dataLoad = "";

                    for (i = 0; i < data.length; i++) {

                        dataLoad += "<tr>";
                        dataLoad += "<td>";
                        dataLoad += data.data[i].nama_pelanggan
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += data.data[i].nama_barang
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += data.data[i].quantity + " " + data.data[i].satuan
                        dataLoad += "</td>";
                        dataLoad += "</tr>";


                    }

                    var totalDataBarang = data.length_paging;
                    var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

                    $('.pagination-result-live-order').html(paginationViewHTMLLiveOrder(halaman, totalHalaman, create_date))

                    $("#tbody-table-data-live-order").html(dataLoad)
                    $("#data-trigger").hide();
                    $("#div-inventory-update-detail").hide();
                    $("#div-live-order-date").show();

                }
            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }
    */

    function getLiveOrderDate(create_date, batasTampilData, halaman) {
        $.ajax({
            url: '<?= site_url() ?>/live-order/getdata',
            method: 'post',
            dataType: 'json',
            data: {
                'create_date': create_date.trim(),
                'halaman': halaman,
                'batastampil': batasTampilData,
                'keyword': ''
            },
            success: function(data) {

                console.log(data);
                if (data.length > 0) {

                    var dataload = "";
                    var flag = false;
                    dataload += '<div class="container"> ';
                    dataload += '<div class="row offset-md-3 col-md-12"> ';

                    for (i = 0; i < data.length; i++) {

                        if (i % 2 == 0) {
                            dataload += '<div class="col-md-6"> ';
                            dataload += '<p style="color:#B89874;">' + data.data[i].nama_pelanggan.toUpperCase() + '</p>';

                            for (j = 0; j < data.datapo.length; j++) {
                                if (data.data[i].id_trx_order == data.datapo[j].id_trx_order) {

                                    dataload += '<div class="row" style="margin-top:10px"> ';
                                    dataload += '<div class="col-md-4"> ';
                                    // if(flag==true){
                                    //    dataload += data.datapo[i].nama_pelanggan.toUpperCase();
                                    // }

                                    dataload += '</div>';

                                    dataload += '<div class="col-md-6"> ';
                                    dataload += data.datapo[j].nama_barang.toUpperCase();
                                    dataload += '</div>';

                                    dataload += '<div class="col-md-2"> ';
                                    dataload += data.datapo[j].quantity + " " + data.datapo[j].satuan;
                                    dataload += '</div>';
                                    dataload += '</div> ';
                                }

                            }

                            dataload += '<hr style="border-width: 2px;border-style: solid;border-color:white">';
                            dataload += '</div>';
    
                        } else {
                            dataload += '<div class="col-md-6"> ';
                            dataload += '<p style="color:#B89874;">' + data.data[i].nama_pelanggan.toUpperCase() + '</p>';

                            for (j = 0; j < data.datapo.length; j++) {
                                if (data.data[i].id_trx_order == data.datapo[j].id_trx_order) {

                                    dataload += '<div class="row" style="margin-top:10px"> ';
                                    dataload += '<div class="col-md-4"> ';
                                    // if(flag==true){
                                    //    dataload += data.datapo[i].nama_pelanggan.toUpperCase();
                                    // }

                                    dataload += '</div>';

                                    dataload += '<div class="col-md-6"> ';
                                    dataload += data.datapo[j].nama_barang.toUpperCase();
                                    dataload += '</div>';

                                    dataload += '<div class="col-md-2"> ';
                                    dataload += data.datapo[j].quantity + " " + data.datapo[j].satuan;
                                    dataload += '</div>';
                                    dataload += '</div> ';
                                }

                            }

                            dataload += '<hr style="border-width: 2px;border-style: solid;border-color:white">';
                            dataload += '</div>';

                        }




                    }

                    dataload += '</div>';
                    dataload += '</div>';

                    var totalDataBarang = data.length_paging;
                    var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

                    $('.pagination-result-live-order').html(paginationViewHTMLLiveOrder(halaman, totalHalaman, create_date))


                    $("#date-live-order").html(dateForShow(create_date))
                    $("#data-live-order").html(dataload)
                    $("#data-trigger").hide();
                    $("#div-inventory-update-detail").hide();
                    $("#div-live-order-date").show();

                } else {
                    $("#div-create-date").html("");
                    //$('.collapse-content').html("");
                    $('.pagination-result-live-order').html("");
                }

            },
            error: function(response) {
                console.log(response);
            }

        });
    }

    function dataPagingDetailCheck(id_trx_order) {

        batasTampilData = 10;
        halaman = $('#halaman_paging_trx_detail').val();
        getDetailCheck(halaman, id_trx_order, batasTampilData);
    }


    function getDetailLiveOrder(id_trx_order, index) {

        $.ajax({
            url: '<?= site_url() ?>/live-order/get-detail-trx',
            method: 'post',
            dataType: 'json',
            data: {
                'id_trx_order': id_trx_order
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
                    document.getElementById("collapse-content" + index).innerHTML = "";
                }
            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }

    /*
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

    function paginationViewHTMLDetail(halaman, totalHalaman, id_trx_order) { //halaman 1 total 6

        var data_load = '';
        prev = parseInt(halaman) - 1;
        next = parseInt(halaman) + 1;
        minimal_page = parseInt(halaman) - 2;
        max_page = parseInt(halaman) + 2;
        var prev_v = "dataPagingBarangHREFTrxDetail('" + prev + "','" + id_trx_order + "')";
        var next_v = "dataPagingBarangHREFTrxDetail('" + next + "','" + id_trx_order + "')";
        var halaman1 = "dataPagingBarangHREFTrxDetail('1','" + id_trx_order + "')";
        var halaman2 = "dataPagingBarangHREFTrxDetail('2','" + id_trx_order + "')";
        var halaman3 = "dataPagingBarangHREFTrxDetail('3','" + id_trx_order + "')";
        var halaman4 = "dataPagingBarangHREFTrxDetail('4','" + id_trx_order + "')";
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
            var onclk = "dataPagingBarangHREFTrxDetail('" + i + "','" + id_trx_order + "')";

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

    function dataPagingBarangHREFTrxDetail(halaman, id_trx_order) {
        $('#halaman_paging_trx_detail').val(halaman)
        dataPagingDetailCheck(id_trx_order);
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

    function paginationViewHTMLLiveOrder(halaman, totalHalaman, create_date) { //halaman 1 total 6

        var data_load = '';
        prev = parseInt(halaman) - 1;
        next = parseInt(halaman) + 1;
        minimal_page = parseInt(halaman) - 2;
        max_page = parseInt(halaman) + 2;
        var prev_v = "dataPagingBarangHREFTrxLive('" + prev + "','" + create_date + "')";
        var next_v = "dataPagingBarangHREFTrxLive('" + next + "','" + create_date + "')";
        var halaman1 = "dataPagingBarangHREFTrxLive('1','" + create_date + "')";
        var halaman2 = "dataPagingBarangHREFTrxLive('2','" + create_date + "')";
        var halaman3 = "dataPagingBarangHREFTrxLive('3','" + create_date + "')";
        var halaman4 = "dataPagingBarangHREFTrxLive('4','" + create_date + "')";
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
            var onclk = "dataPagingBarangHREFTrxLive('" + i + "','" + create_date + "')";

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

    function dataPagingBarangHREFTrxLive(halaman, create_date) {
        console.log("halaman" + halaman);
        $('#halaman_paging_live_order').val(halaman)
        liveOrderPaging(create_date);
    }
</script>