<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <div class="col-md-11">
        <hr style="margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 offset-md-1"><?= $id_trx_mutasi ?></div>
            <div class="col-md-2 offset-md-5"><?= $date ?></div>
        </div>
        <div class="container-fluid" style="margin-top: 60px;">
            <div class="row justify-content-center">
                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-8 offset-md-2 justify-content-center">
                        <div class="row mt-2 ">
                            <table class="table table-dark table-bordered data">
                                <thead>
                                    <tr>
                                        <th> Kode </th>
                                        <th> Nama Barang </th>
                                        <th colspan="2"> Quantity Gudang</th>
                                        <th colspan="2"> Mutasi</th>
                                        <th width="10%"> Action </th>
                                    </tr>
                                </thead>
                                <tbody id='tbody-table-data'></tbody>
                            </table>
                            <input type="hidden" name="halaman" id="halaman" value="1">
                            <div class="pagination-result" style="margin-top:10px;margin-left:25%"></div>
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
</div>
<script>
    $(document).ready(function() {
        /* $("#mytable").DataTable({
             "processing": true,
             "serverSide": true,
             "ajax": {
                 "url": "<?= site_url('inventory-mutasibarang/get_ajax') ?>",
                 "type": "POST"

             },
             "language": {
                 "paginate": {
                     "previous": "<",
                     "next": ">"
                 }
             },
             searching: false,
             //paging: false, 
             info: false,
             ordering: false
         }); */

        dataPaging();

    });

    function dataPaging() {

        var batasTampilData = 10;
        var halaman = $('#halaman').val();
        loadData(halaman, batasTampilData);
    }


    function loadData(halaman, batasTampilData) {

        $.ajax({
            url: '<?= site_url() ?>/inventory-mutasibarang/loadpo',
            method: 'post',
            dataType: 'json',
            data: {
                "halaman": halaman,
                "batastampil": batasTampilData,
                "id_trx_mutasi": "<?= $id_trx_mutasi ?>"
            },
            success: function(data) {
                console.log(data);
                if (data.length > 0) {

                    var dataLoad = "";
                    for (i = 0; i < data.length; i++) {

                        var functionOnclick = 'update_data("' + i + '","' + halaman + '")';
                        var quantityMutasi = data.data[i].quantity_mutasi;

                        if (quantityMutasi == null) quantityMutasi = 0;

                        dataLoad += "<tr>";
                        dataLoad += "<td>";
                        dataLoad += data.data[i].kode
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += data.data[i].nama_barang
                        dataLoad += "</td>";
                        dataLoad += '<td>';
                        dataLoad += data.data[i].quantity_pusat;
                        dataLoad += "</td>";
                        dataLoad += "<td width='5%'>";
                        dataLoad += data.data[i].satuan
                        dataLoad += "</td>";
                        
                        if (data.data[i].status == '0') {
                            dataLoad += '<td width="15%"><input type="text" name="quantity_mutasi[]" id="quantity_mutasi' + i + '"  value="' + quantityMutasi + '" class="form-control-label quantity-check" onkeypress="validate(event)"></td>'
                        } else {
                            dataLoad += '<td width="15%"><input type="text" name="quantity_mutasi[]" id="quantity_mutasi' + i + '"  class="form-control-label quantity-check" onkeypress="validate(event)"></td>'
                        }

                        
                        dataLoad += '<td class="data" data-dat="satuan" width="5%">'
                        dataLoad += data.data[i].satuan
                        dataLoad += '<input type="hidden" name="id[]" id="id' + i + '" value="' + data.data[i].id + '" class="form-control-label">'
                        dataLoad += '<input type="hidden" name="kode[]" id="kode' + i + '" value="' + data.data[i].kode + '" class="form-control-label">'
                        dataLoad += '<input type="hidden" name="quantity_pusat[]" id="quantity_pusat' + i + '" value="' + data.data[i].quantity_pusat + '" class="form-control-label">'
                        dataLoad += '</td>'
                        dataLoad += "<td>";

                        if (data.data[i].status == '0') {
                            dataLoad += "<a class='form-control-button btn-success' style='background-color: #a5662f'><span class='fas fa-check'></span></a>";
                        } else {
                            dataLoad += "<a class='form-control-button btn btn-outline-light button-action' onclick='" + functionOnclick + "'><span class='fas fa-check'></span></a>";
                        }

                        dataLoad += "</td>";
                        dataLoad += "</tr>";


                    }

                    var totalDataBarang = data.length_paging;
                    var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

                    $('.pagination-result').html(paginationViewHTML(halaman, totalHalaman))
                    $("#tbody-table-data").html(dataLoad);
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

    function update_data(it, halaman) {
        console.log("it:" + it);
        console.log("halaman:" + halaman);

        var quantity_mutasi = $("#quantity_mutasi" + it).val();
        var id = $("#id" + it).val();
        var kode = $("#kode" + it).val();
        var quantity_pusat = $("#quantity_pusat" + it).val();

        if (checkInvalid(quantity_mutasi) || quantity_mutasi == '0') {
            alert("quantity mutasi tidak boleh kosong");
            return;
        }

        if (parseInt(quantity_pusat) < parseInt(quantity_mutasi)) {
            alert("quantity mutasi lebih besar dari quantity gudang");
            return;
        }

        $.ajax({
            url: '<?= site_url() ?>/inventory-mutasibarang/insert-mutasi',
            method: 'post',
            dataType: 'json',
            data: {
                'quantity_mutasi': quantity_mutasi,
                "id_trx_mutasi": "<?= $id_trx_mutasi ?>",
                "kode": kode,
                "quantity_pusat": quantity_pusat
            },
            success: function(response) {

                dataPaging();

            },
            error: function(response) {
                console.log(response);
            }

        });

    }

    function confirmData() {

        $.ajax({
            url: '<?= site_url() ?>/inventory-mutasibarang/update-mutasi',
            method: 'post',
            dataType: 'json',
            data: {
                "id_trx_mutasi": "<?= $id_trx_mutasi ?>",
            },
            success: function(response) {
                alert("success mutasi barang");
                location.href = "<?= site_url()?>/inventory-mutasibarang";

            },
            error: function(response) {
                console.log(response);
            }

        });
    }

    /*
    function confirmData() {

        var mutasi = document.getElementsByName('mutasi[]');
        var k = "";
        var submit = true;
        for (var i = 0; i < mutasi.length; i++) {
            var a = mutasi[i];
            k = k + "array[" + i + "].value= " + a.value + " ";
            var index = i;
            var value = a.value;

            console.log("array[" + index + "] => " + value + " => length:" + value.length);

            if (checkInvalid(value)) {
                alert("mutasi tidak boleh kosong");
                submit = false;
                break;
            } else {
                if (isNaN(value)) {
                    alert("mutasi harus number");
                    submit = false;
                    break;

                }
            }

        }

        if (submit == true) {
            console.log("submit " + submit);
            getIdMutasi();

            $("#form-mutasi-inventory").attr('action', '<?php echo site_url() ?>/inventory-mutasibarang/insertmutasi');
            $("#form-mutasi-inventory").submit();

        } else {
            return false;
        }
    }
    */

    function clearAllData() {

        var id_trx_mutasi = "<?= $id_trx_mutasi ?>";

        $.ajax({
            url: '<?= site_url() ?>/inventory-mutasibarang/clear-all',
            method: 'post',
            dataType: 'json',
            async: false,
            data: {
                'id_trx_mutasi': id_trx_mutasi
            },
            success: function(response) {
                alert("clear all");
                location.href = "<?= site_url() ?>/inventory-mutasibarang";
            },
            error: function(response) {
                console.log(response);
            }

        });

    }

    function getIdMutasi() {

        var i = 0;
        var id_arr = [];
        var mutasi_arr = [];
        var kode_arr = [];
        var quantity_arr = [];

        var value_id = $('input:text').map(function() {

            i++;
            var id_val = $(this).attr('id');
            var mutasi = $(this).val();

            console.log("this_value :" + i + "==> " + id_val + "----" + mutasi);

            var idx = id_val.replaceAll("mutasi", "");
            const data = idx.split("_,_");
            var id = data[0];
            var kode = data[1];
            var quantity = data[2];

            id_arr.push(id);
            mutasi_arr.push(mutasi);
            kode_arr.push(kode);
            quantity_arr.push(quantity);

            return $(this).val();
        });

        $("#id").val(id_arr);
        $("#quantity_mutasi").val(mutasi_arr);
        $("#quantity_pusat").val(quantity_arr);
        $("#kode").val(kode_arr);

        console.log("id_val length = " + id.length);
    }


    function checkInvalid(val) {
        if (val == null || val == "") {
            return true;
        }

        return false;
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
        $('#halaman').val(halaman)
        dataPaging();
    }
</script>