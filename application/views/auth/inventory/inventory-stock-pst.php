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
                <div class="row">
                    <div class="col-sm-7 offset-md-3" style="margin-top: 20px;">
                        <form id="form-pst-pusat" method="POST">
                            <table class="table table-dark table-bordered data">
                                <thead>
                                    <tr>
                                        <th> Kode </th>
                                        <th> Nama Barang</th>
                                        <th> Jumlah Stock </th>
                                        <th colspan="2" width="30%"> Update Stock Pusat </th>
                                        <th> Note </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody id="data-pusat"></tbody>
                            </table>
                            <input type="hidden" name="pusat_stock" id="pusat_stock" />
                            <input type="hidden" name="pusat_stock_update" id="pusat_stock_update" />
                            <input type="hidden" name="pusat_note" id="pusat_note" />
                            <input type="hidden" name="pusat_satuan" id="pusat_satuan" />
                            <input type="hidden" name="pusat_kode" id="pusat_kode" />
                            <input type="hidden" name="trx_pst_pusat" id="trx_pst_pusat" value="<?= $id_trx_pst ?>" />
                        </form>
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
                <div class="row">
                    <div class="col-sm-7 offset-md-3" style="margin-top: 20px;">
                    <form id="form-pst-sobat" method="POST">
                        <table class="table table-dark table-bordered data">
                            <thead>
                                <tr>
                                    <th> Kode </th>
                                    <th> Nama Barang</th>
                                    <th> Jumlah Stock </th>
                                    <th colspan="2" width="30%"> Update Stock Sobat </th>
                                    <th> Note </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody id="data-sobat"></tbody>
                        </table>
                        <input type="hidden" name="sobat_stock" id="sobat_stock" />
                        <input type="hidden" name="sobat_stock_update" id="sobat_stock_update" />
                        <input type="hidden" name="sobat_note" id="sobat_note" />
                        <input type="hidden" name="sobat_satuan" id="sobat_satuan" />
                        <input type="hidden" name="sobat_kode" id="sobat_kode" />
                        <input type="hidden" name="trx_pst_sobat" id="trx_pst_sobat" value="<?= $id_trx_sobat ?>" />
                    </form>
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
        getData();
    });

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

    });

    function checkInvalid(val) {
        if (val == null || val == "") {
            return true;
        }

        return false;
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


    function handlePusat(response) {

        var dataLoad = "";
        var total = 0;
        console.log(response);

        for (let i = 0; i < response.data_pusat.length; i++) {

            dataLoad += "<tr>";
            dataLoad += "<td >";
            dataLoad += response.data_pusat[i].kode;
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += response.data_pusat[i].nama_barang;
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += response.data_pusat[i].quantity_pusat + " " + response.data_pusat[i].satuan;
            dataLoad += "</td>";
            dataLoad += "<td>";
            dataLoad += '<input type="text" name="quantity_update_pusat[]" id="quantity_update_pusat' + i + '" class="form-control-label"/>';
            dataLoad += "</td>";
            dataLoad += '<td>'
            dataLoad += '      <select name="satuan_pusat[]" id="satuan_pusat' + i + '" class="form-control">'
            dataLoad += '          <option value="Kg">kg</option>'
            dataLoad += '          <option value="Dus">Dus</option>'
            dataLoad += '      </select>'
            dataLoad += '</td> '
            dataLoad += "<td>";
            dataLoad += '<input type="text" name="note_pusat[]" id="note_pusat' + i + '" class="form-control-label" />';
            dataLoad += '<input type="hidden" name="kode_pusat[]" id="kode_pusat' + i + '" value="' + response.data_pusat[i].kode + '"/>';
            dataLoad += '<input type="hidden" name="quantity_pusat[]" id="quantity_pusat' + i + '" value="' + response.data_pusat[i].quantity_pusat + '"/>';
            dataLoad += "</td>";
            dataLoad += "<td>";

            if (response.data_pusat[i].create_date != null) {
                dataLoad += "<a class='form-control-button btn-success' style='background-color: #a5662f'><span class='fas fa-check'></span></a>";
            } else {
                dataLoad += "<a class='form-control-button btn btn-outline-light button-action' onclick='update_data_pusat(" + i + ")'><span class='fas fa-check'></span></a>";
            }

            dataLoad += "</td>";
            dataLoad += "</tr>";

        }

        $("#data-pusat").html(dataLoad);
    }


    function update_data_pusat(it) {
        var quantity_pusat = $("#quantity_pusat" + it).val();
        var quantity_update = $("#quantity_update_pusat" + it).val();
        var satuan = $("#satuan_pusat" + it).val();
        var note = $("#note_pusat" + it).val();
        var kode = $("#kode_pusat" + it).val();

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


    }

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

    function handleSobat(response) {

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

    function getData() {

        $.ajax({
            url: '<?= site_url() ?>/inventory-updatestockpst/getdata',
            method: 'post',
            dataType: 'json',
            success: function(response) {

                handlePusat(response);
                handleSobat(response);

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