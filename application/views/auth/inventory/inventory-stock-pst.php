<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <div class="col-md-11">
        <hr style="margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    </div>
    <div class="row">
        <div class="col-md-2 offset-md-1">
            <div class="input-group">
                <input class="form-control-paging" type="text" placeholder="search..." id="search" name="search">
                <span class="input-group-append">
                    <button class="btn btn-outline-light" type="button" onclick="searchData()">
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
            <p id="date-filter" style="margin-top:30px"><?= $date ?></p>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center" id="form-pusat">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 offset-md-1">
                        <p id="trx_pst_pusat"><?= $id_trx_pst ?></p>
                        <div>
                            <a class="form-control-button btn" style="background-color: #a5662f;border:none;padding:10px;width:50%"> Gudang Luar </a>
                        </div>
                        <div style="margin-top:30px">
                            <a class="form-control-button btn btn-outline-light button-action" style="padding:10px;width:50%" onclick="showSobat();"> Sobat </a>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-8 offset-md-2 justify-content-center">
                        <div class="row mt-2 ">
                            <table class="table table-dark table-bordered data">
                                <thead>
                                    <tr>
                                        <th> Kode </th>
                                        <th> Nama Barang</th>
                                        <th colspan="2"> Jumlah Stock </th>
                                        <th colspan="2" width="30%"> Update Stock Gudang </th>
                                        <th> Note </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody id="data-pusat"></tbody>
                            </table>
                            <input type="hidden" name="halaman_pusat" id="halaman_pusat" value="1">
                            <div class="pagination-result-pusat" style="margin-top:10px;margin-left:25%"></div>
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

        <div class="row justify-content-center" style="display: none;" id="form-sobat">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 offset-md-1">
                        <p id="trx_pst_sobat" style="display: none;"><?= $id_trx_sobat ?></p>
                        <div>
                            <a class="form-control-button btn btn-outline-light button-action" onclick="showPusat();" style="width:50%"> Gudang Luar </a>
                        </div>
                        <div style="margin-top:30px">
                            <a class="form-control-button btn" style="background-color: #a5662f;border:none;padding:10px;width:50%"> Sobat </a>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-8 offset-md-2 justify-content-center">
                        <div class="row mt-2 ">
                            <table class="table table-dark table-bordered data">
                                <thead>
                                    <tr>
                                        <th> Kode </th>
                                        <th> Nama Barang</th>
                                        <th colspan="2"> Jumlah Stock </th>
                                        <th colspan="2" width="30%"> Update Stock Sobat </th>
                                        <th> Note </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody id="data-sobat"></tbody>
                            </table>
                            <input type="hidden" name="halaman_sobat" id="halaman_sobat" value="1">
                            <div class="pagination-result-sobat" style="margin-top:10px;margin-left:25%"></div>
                        </div>
                        <div class="row d-flex justify-content-end" style="margin-top:30px">
                            <div class="col-md-2">
                                <button class="form-control-button btn btn-outline-light button-action" onclick="clearAllDataSobat();"> Clear All </button>
                            </div>
                            <div class="col-md-2">
                                <button class="form-control-button btn btn-outline-light button-action" onclick="return confirmDataSobat();"> Confirm </button>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-start formSubmitData" id="formSubmitData">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top:60px"></div>
</div>

<script>
    function showSobat() {

        $("#form-pusat").hide();
        $("#form-sobat").show();

        $("#trx_pst_sobat").show();
        $("#trx_pst_pusat").hide();
    }

    function showPusat() {
        $("#form-pusat").show();
        $("#form-sobat").hide();

        $("#trx_pst_sobat").hide();
        $("#trx_pst_pusat").show();

    }


    $(document).ready(function() {
        //getData();
        dataPaging();
        dataPagingSobat();
    });

    function dataPaging() {

        var batasTampilData = 10;
        var halaman = $('#halaman_pusat').val();
        getDataPusat(halaman, batasTampilData);
    }

    function dataPagingSobat() {

        var batasTampilData = 10;
        var halaman = $('#halaman_sobat').val();
        getDataSobat(halaman, batasTampilData);
    }

    $(function() {
        $("#create_date").datepicker({
            todayHighlight: true,
            format: "yyyymm",
            startView: "months",
            minViewMode: "months",
            autoclose: true
        });

        $("#create_date").val("Januari, Februari, Maret....");
    });

    $(document).on('change', '#create_date', function() {
        var create_date = document.getElementById("create_date").value;

        var today = new Date();
        var year = today.getFullYear();
        var month = today.getMonth();

    });

    function checkInvalid(val) {
        if (val == null || val == "") {
            return true;
        }

        return false;
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


    function handlePusat(response, halaman, batasTampilData) {

        var dataLoad = "";
        var total = 0;
        console.log(response);

        for (let i = 0; i < response.length; i++) {

            var note = response.data[i].note;
            if (note == null) note = "";

            var update_quantity = response.data[i].update_quantity;
            if (update_quantity == null) update_quantity = "0";

            dataLoad += "<tr>";
            dataLoad += "<td width='10%'>";
            dataLoad += response.data[i].kode;
            dataLoad += "</td>";
            dataLoad += "<td width='20%'>";
            dataLoad += response.data[i].nama_barang;
            dataLoad += "</td>";
            dataLoad += "<td width='10%'>";
            dataLoad += response.data[i].quantity_pusat;
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += response.data[i].satuan;
            dataLoad += "</td>";
            dataLoad += "<td width='10%'>";
            dataLoad += '<input type="text" name="quantity_update_pusat[]" id="quantity_update_pusat' + i + '" class="form-control-label" value="' + update_quantity + '" onkeypress="validate(event)"/>';
            dataLoad += "</td>";
            dataLoad += '<td width="7%">'
            dataLoad += '      <select name="satuan_pusat[]" id="satuan_pusat' + i + '" class="form-control">'
            dataLoad += '          <option value="Kg">kg</option>'
            dataLoad += '          <option value="Dus">Dus</option>'
            dataLoad += '      </select>'
            dataLoad += '</td> '
            dataLoad += "<td width='20%'>";
            dataLoad += '<input type="text" name="note_pusat[]" id="note_pusat' + i + '" class="form-control-label" value="' + note + '"/>';
            dataLoad += '<input type="hidden" name="kode_pusat[]" id="kode_pusat' + i + '" value="' + response.data[i].kode + '"/>';
            dataLoad += '<input type="hidden" name="quantity_pusat[]" id="quantity_pusat' + i + '" value="' + response.data[i].quantity_pusat + '"/>';
            dataLoad += "</td>";
            dataLoad += "<td>";

            if (response.data[i].note != null) {
                dataLoad += "<a class='form-control-button btn-success' style='background-color: #a5662f'><span class='fas fa-check'></span></a>";
            } else {
                dataLoad += "<a class='form-control-button btn btn-outline-light button-action' onclick='update_data_pusat(" + i + ")'><span class='fas fa-check'></span></a>";
            }

            dataLoad += "</td>";
            dataLoad += "</tr>";

        }

        var totalDataBarang = response.length_paging;
        var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

        $('.pagination-result-pusat').html(paginationViewHTML(halaman, totalHalaman))

        $("#data-pusat").html(dataLoad);
    }

    function handleSobat(response, halaman, batasTampilData) {

        var dataLoad = "";
        var total = 0;
        console.log(response);

        for (let i = 0; i < response.length; i++) {

            var note = response.data[i].note;
            if (note == null) note = "";

            var update_quantity = response.data[i].update_quantity;
            if (update_quantity == null) update_quantity = "0";

            dataLoad += "<tr>";
            dataLoad += "<td width='10%'>";
            dataLoad += response.data[i].kode;
            dataLoad += "</td>";
            dataLoad += "<td width='20%'>";
            dataLoad += response.data[i].nama_barang;
            dataLoad += "</td>";
            dataLoad += "<td width='10%'>";
            dataLoad += response.data[i].quantity_sobat;
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += response.data[i].satuan;
            dataLoad += "</td>";
            dataLoad += "<td width='10%'>";
            dataLoad += '<input type="text" name="quantity_update_sobat[]" id="quantity_update_sobat' + i + '" class="form-control-label" value="' + update_quantity + '" onkeypress="validate(event)"/>';
            dataLoad += "</td>";
            dataLoad += '<td width="7%">'
            dataLoad += '      <select name="satuan_sobat[]" id="satuan_sobat' + i + '" class="form-control">'
            dataLoad += '          <option value="Kg">kg</option>'
            dataLoad += '          <option value="Dus">Dus</option>'
            dataLoad += '      </select>'
            dataLoad += '</td> '
            dataLoad += "<td width='20%'>";
            dataLoad += '<input type="text" name="note_sobat[]" id="note_sobat' + i + '" class="form-control-label" value="' + note + '"/>';
            dataLoad += '<input type="hidden" name="kode_sobat[]" id="kode_sobat' + i + '" value="' + response.data[i].kode + '"/>';
            dataLoad += '<input type="hidden" name="quantity_sobat[]" id="quantity_sobat' + i + '" value="' + response.data[i].quantity_sobat + '"/>';
            dataLoad += "</td>";
            dataLoad += "<td>";

            if (response.data[i].note != null) {
                dataLoad += "<a class='form-control-button btn-success' style='background-color: #a5662f'><span class='fas fa-check'></span></a>";
            } else {
                dataLoad += "<a class='form-control-button btn btn-outline-light button-action' onclick='update_data_sobat(" + i + ")'><span class='fas fa-check'></span></a>";
            }

            dataLoad += "</td>";
            dataLoad += "</tr>";

        }

        var totalDataBarang = response.length_paging;
        var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

        $('.pagination-result-sobat').html(paginationViewHTMLSobat(halaman, totalHalaman))

        $("#data-sobat").html(dataLoad);
    }

    /*

    function update_data_pusat(it) {

        var quantity_pusat = $("#quantity_pusat" + it).val();
        var quantity_update = $("#quantity_update_pusat" + it).val();
        var satuan = $("#satuan_pusat" + it).val();
        var note = $("#note_pusat" + it).val();
        var kode = $("#kode_pusat" + it).val();
        var id_trx_pusat = <?= $id_trx_pst ?>;

        if (checkInvalid(quantity_update)) {
            alert("update pst tidak boleh kosong");
            return;
        }

        if (checkInvalid(note)) {
            alert("note tidak boleh kosong");
            return;
        }

        $("#pusat_stock").val(quantity_pusat);
        $("#pusat_satuan").val(satuan);
        $("#pusat_note").val(note);
        $("#pusat_kode").val(kode);
        $("#pusat_stock_update").val(quantity_update);

        $("#form-pst-pusat").attr('action', '<?php echo site_url() ?>/inventory-updatestockpst/pusatsave');
        $("#form-pst-pusat").submit();


    }*/

    function update_data_pusat(it) {

        var quantity_pusat = $("#quantity_pusat" + it).val();
        var quantity_update = $("#quantity_update_pusat" + it).val();
        var satuan = $("#satuan_pusat" + it).val();
        var note = $("#note_pusat" + it).val();
        var kode = $("#kode_pusat" + it).val();
        var id_trx_pusat = "<?= $id_trx_pst ?>";

        if (checkInvalid(quantity_update)) {
            alert("update pst tidak boleh kosong");
            return;
        }

        if (checkInvalid(note)) {
            alert("note tidak boleh kosong");
            return;
        }

        $.ajax({
            url: '<?= site_url() ?>/inventory-updatestockpst/pusatsave',
            method: 'post',
            dataType: 'json',
            data: {
                'quantity_pusat': quantity_pusat,
                "quantity_update": quantity_update,
                "satuan": satuan,
                "note": note,
                "kode": kode,
                "id_trx_pusat": id_trx_pusat
            },
            success: function(response) {

                dataPaging();

            },
            error: function(response) {
                console.log(response);
            }

        });

    }

    function update_data_sobat(it) {

        var quantity_sobat = $("#quantity_sobat" + it).val();
        var quantity_update = $("#quantity_update_sobat" + it).val();
        var satuan = $("#satuan_sobat" + it).val();
        var note = $("#note_sobat" + it).val();
        var kode = $("#kode_sobat" + it).val();
        var id_trx_sobat = "<?= $id_trx_sobat ?>";

        if (checkInvalid(quantity_update)) {
            alert("update pst tidak boleh kosong");
            return;
        }

        if (checkInvalid(note)) {
            alert("note tidak boleh kosong");
            return;
        }

        $.ajax({
            url: '<?= site_url() ?>/inventory-updatestockpst/sobatsave',
            method: 'post',
            dataType: 'json',
            data: {
                'quantity_sobat': quantity_sobat,
                "quantity_update": quantity_update,
                "satuan": satuan,
                "note": note,
                "kode": kode,
                "id_trx_sobat": id_trx_sobat
            },
            success: function(response) {

                dataPagingSobat();

            },
            error: function(response) {
                console.log(response);
            }

        });

    }

    function confirmData() {

        $.ajax({
            url: '<?= site_url() ?>/inventory-updatestockpst/confirm',
            method: 'post',
            dataType: 'json',
            success: function(response) {
                alert("success update pst");
                location.href = "<?= site_url() ?>/inventory-updatestockpst";

            },
            error: function(response) {
                console.log(response);
            }

        });
    }

    function confirmDataSobat() {

        $.ajax({
            url: '<?= site_url() ?>/inventory-updatestockpst/confirmsobat',
            method: 'post',
            dataType: 'json',
            success: function(response) {
                alert("success update pst");
                location.href = "<?= site_url() ?>/inventory-updatestockpst";

            },
            error: function(response) {
                console.log(response);
            }

        });
    }

    /*
    function update_data_sobat(it) {
        var quantity_sobat = $("#quantity_sobat" + it).val();
        var quantity_update = $("#quantity_update_sobat" + it).val();
        var satuan = $("#satuan_sobat" + it).val();
        var note = $("#note_sobat" + it).val();
        var kode = $("#kode_sobat" + it).val();

        if (checkInvalid(quantity_update)) {
            alert("update pst tidak boleh kosong");
            return;
        }

        if (checkInvalid(note)) {
            alert("note tidak boleh kosong");
            return;
        }

        $("#sobat_stock").val(quantity_sobat);
        $("#sobat_satuan").val(satuan);
        $("#sobat_note").val(note);
        $("#sobat_kode").val(kode);
        $("#sobat_stock_update").val(quantity_update);

        $("#form-pst-sobat").attr('action', '<?php echo site_url() ?>/inventory-updatestockpst/sobatsave');
        $("#form-pst-sobat").submit();

    }
    */

    function clearAllData() {

        $.ajax({
            url: '<?= site_url() ?>/inventory-updatestockpst/clear-all',
            method: 'post',
            dataType: 'json',
            success: function(response) {
                alert("clear all");
                location.href = "<?= site_url() ?>/inventory-updatestockpst";
            },
            error: function(response) {
                console.log(response);
            }

        });

    }

    function clearAllDataSobat() {

        $.ajax({
            url: '<?= site_url() ?>/inventory-updatestockpst/clear-all-sobat',
            method: 'post',
            dataType: 'json',
            success: function(response) {
                alert("clear all");
                location.href = "<?= site_url() ?>/inventory-updatestockpst";
            },
            error: function(response) {
                console.log(response);
            }

        });

    }

    function handleSobatBak(response, halaman, batasTampilData) {

        var dataLoad = "";
        var total = 0;
        console.log(response);

        for (let i = 0; i < response.data_sobat.length; i++) {

            dataLoad += "<tr>";
            dataLoad += "<td >";
            dataLoad += response.data_sobat[i].kode;
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += response.data_sobat[i].nama_barang;
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += response.data_sobat[i].quantity_sobat + " " + response.data_sobat[i].satuan;
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += '<input type="text" name="quantity_update_sobat[]" id="quantity_update_sobat' + i + '" class="form-control-label"/>';
            dataLoad += "</td>";
            dataLoad += '<td>'
            dataLoad += '      <select name="satuan_sobat[]" id="satuan_sobat' + i + '" class="form-control">'
            dataLoad += '          <option value="Kg">kg</option>'
            dataLoad += '          <option value="Dus">Dus</option>'
            dataLoad += '      </select>'
            dataLoad += '</td> '
            dataLoad += "<td>";
            dataLoad += '<input type="text" name="note_sobat[]" id="note_sobat' + i + '" class="form-control-label" />';
            dataLoad += '<input type="hidden" name="kode_sobat[]" id="kode_sobat' + i + '" value="' + response.data_sobat[i].kode + '"/>';
            dataLoad += '<input type="hidden" name="quantity_sobat[]" id="quantity_sobat' + i + '" value="' + response.data_sobat[i].quantity_sobat + '"/>';
            dataLoad += "</td>";
            dataLoad += "<td>";

            if (response.data_sobat[i].create_date != null) {
                dataLoad += "<a class='form-control-button btn-success' style='background-color: #a5662f'><span class='fas fa-check'></span></a>";
            } else {
                dataLoad += "<a class='form-control-button btn btn-outline-light button-action' onclick='update_data_sobat(" + i + ")'><span class='fas fa-check'></span></a>";
            }

            dataLoad += "</td>";
            dataLoad += "</tr>";

        }

        $("#data-sobat").html(dataLoad);
    }

    function getData(halaman, batasTampilData) {

        $.ajax({
            url: '<?= site_url() ?>/inventory-updatestockpst/getdata',
            method: 'post',
            dataType: 'json',
            data: {
                "halaman": halaman,
                "batastampil": batasTampilData,
                "id_trx_pst": "<?= $id_trx_pst ?>",
                "id_trx_sobat": "<?= $id_trx_sobat ?>"
            },
            success: function(response) {

                // handlePusat(response);
                handleSobat(response);

            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }

    function getDataPusat(halaman, batasTampilData) {

        $.ajax({
            url: '<?= site_url() ?>/inventory-updatestockpst/getdatapusat',
            method: 'post',
            dataType: 'json',
            data: {
                "halaman": halaman,
                "batastampil": batasTampilData,
                "id_trx_pst": "<?= $id_trx_pst ?>"
            },
            success: function(response) {

                handlePusat(response, halaman, batasTampilData);

            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }

    function getDataSobat(halaman, batasTampilData) {

        $.ajax({
            url: '<?= site_url() ?>/inventory-updatestockpst/getdatasobat',
            method: 'post',
            dataType: 'json',
            data: {
                "halaman": halaman,
                "batastampil": batasTampilData,
                "id_trx_sobat": "<?= $id_trx_sobat ?>"
            },
            success: function(response) {

                handleSobat(response, halaman, batasTampilData);

            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }

    function paginationViewHTML(halaman, totalHalaman) { //halaman 1 total 6

        var data_load = '';
        prev = parseInt(halaman) - 1;
        next = parseInt(halaman) + 1;
        minimal_page = parseInt(halaman) - 2;
        max_page = parseInt(halaman) + 2;
        var prev_v = "dataPagingBarangHREFTrx('" + prev + "')";
        var next_v = "dataPagingBarangHREFTrx('" + next + "')";
        var halaman1 = "dataPagingBarangHREFTrx('1')";
        var halaman2 = "dataPagingBarangHREFTrx('2')";
        var halaman3 = "dataPagingBarangHREFTrx('3')";
        var halaman4 = "dataPagingBarangHREFTrx('4')";
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
            var onclk = "dataPagingBarangHREFTrx('" + i + "')";

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

    function dataPagingBarangHREFTrx(halaman) {
        $('#halaman_pusat').val(halaman)
        dataPaging();
    }

    function paginationViewHTMLSobat(halaman, totalHalaman) { //halaman 1 total 6

        var data_load = '';
        prev = parseInt(halaman) - 1;
        next = parseInt(halaman) + 1;
        minimal_page = parseInt(halaman) - 2;
        max_page = parseInt(halaman) + 2;
        var prev_v = "dataPagingBarangHREFTrxSobat('" + prev + "')";
        var next_v = "dataPagingBarangHREFTrxSobat('" + next + "')";
        var halaman1 = "dataPagingBarangHREFTrxSobat('1')";
        var halaman2 = "dataPagingBarangHREFTrxSobat('2')";
        var halaman3 = "dataPagingBarangHREFTrxSobat('3')";
        var halaman4 = "dataPagingBarangHREFTrxSobat('4')";
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
            var onclk = "dataPagingBarangHREFTrxSobat('" + i + "')";

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

    function dataPagingBarangHREFTrxSobat(halaman) {
        $('#halaman_sobat').val(halaman)
        dataPagingSobat();
    }
</script>