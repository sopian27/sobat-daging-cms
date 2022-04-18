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
        </div>
        <div class="row">
            <div class="col-md-7" style="margin-top: 20px;margin-left:8%">
                <table class="table table-dark table-borderless" style="border: none;">
                    <tbody id="data-trigger-content">
                    </tbody>
                </table>
                <input type="hidden" name="halaman_paging_trx" id="halaman_paging_trx" value="1">
                <div class="pagination-result_trx" style="margin-left:160px;margin-top:10px;margin-left:30%"></div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="display: none;" id="div-inventory-update-detail">
        <div class="row">
            <div class="col-md-3 offset-md-1"><?= $id_trx_po ?></div>
            <div class="col-md-2 offset-md-5"><?= $date ?></div>
            <p class="col-md-2 offset-md-10">
                <button class="btn btn-outline-light" type="button" data-bs-toggle="collapse" data-bs-target="#data-barang-collapse" aria-expanded="false" aria-controls="data-barang-collapse">
                    kode
                </button>
            </p>
        </div>

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="row">
                    <div class="col-md-7 offset-md-2">
                        <form>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 offset-md-4 col-form-label">Purchase From : </label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control-label" id="purchase_from" name="purchase_from">
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
                                        <th> Harga Satuan (Rp) </th>
                                        <th> Harga Total (Rp) </th>
                                        <th width="10%"> Action </th>
                                    </tr>
                                </thead>
                                <tbody id='tbody-table-data'></tbody>
                            </table>
                            <input type="hidden" name="halaman_paging_trx_detail" id="halaman_paging_trx_detail" value="1">
                            <div class="pagination-result_trx_detail " style="margin-top:10px;margin-left:45%"></div>
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
                    <div class="col-md-3 justify-content-center">
                        <div style="min-height: 120px;">
                            <div class="collapse collapse-horizontal" id="data-barang-collapse">
                                <div class="card card-body bg-transparent " style="width: 300px; border: 2px solid white;">
                                    <input type="hidden" name="halaman" id="halaman" value="1">
                                    <input type="hidden" name="dataBarangCount" id="dataBarangCount" value="<?= $dataBarangCount ?>">
                                    <div class="row"> </div>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <input class="form-control-paging" type="text" placeholder="search..." name="keyword-paging" id="keyword-paging">
                                                <span class="input-group-append">
                                                    <button class="btn btn-outline-light" type="button" onclick="dataPagingBarang()">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4" style="margin-left:6%;margin-top:10px">
                                            <h4>Kode</h4>
                                            <hr style="border-width: 2px;border-style: solid;border-color:white">
                                        </div>
                                    </div>
                                    <div class="data-barang-pagination"></div>
                                    <div class="pagination-result" style="margin-left:160px;margin-top:10px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        //console.log(loadData(""));
        //dataPagingBarang();
        dataPagingBarangTrx();
        dataPagingBarang();

        $(".harga-satuan").autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });

        $(".harga-total").autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });
    });

    function loadData(keyword, batasTampilData, halaman) {

        $.ajax({
            url: '<?= site_url() ?>/inventory-updatepo/loadnewpo',
            method: 'post',
            dataType: 'json',
            data: {
                'keyword': keyword,
                'halaman': halaman,
                'batastampil': batasTampilData
            },
            success: function(response) {
                var dataLoad = "";

                for (let i = 0; i < response.length; i++) {

                    var functionOnclick = 'dataPagingDetail("' + response.data[i].id_trx_po + '")';

                    dataLoad += "<tr>";
                    dataLoad += "<td width='30%' style='text-align:left'><a class='btn-sobat-md' href='#' onclick='" + functionOnclick + "'>";
                    //dataLoad += "Purchase From Distributor " + response.data[i].nama.toUpperCase();
                    dataLoad += response.data[i].nama.toUpperCase();
                    dataLoad += "</a></td>";
                    dataLoad += "<td>";
                    dataLoad += dateForShow(response.data[i].create_date);
                    dataLoad += "</td>";
                    dataLoad += "</tr>";
                }

                $("#data-trigger-content").html(dataLoad);

                var totalDataBarang = response.length_paging;
                var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

                console.log("totalDataBarang" + totalDataBarang);
                console.log("totalHalaman" + totalHalaman);
                $('.pagination-result_trx').html(paginationViewHTML(halaman, totalHalaman))


            },
            error: function(response) {
                console.log(response);
            }

        });
    }

    function getDetailData(halaman, id_trx_po, batasTampilData) {

        $.ajax({
            url: '<?= site_url() ?>/inventory-updatepo/getdetailnewpo',
            method: 'post',
            data: {
                "id_trx_po": id_trx_po,
                "halaman": halaman,
                "batastampil": batasTampilData
            },
            dataType: 'json',
            success: function(response) {
                var dataLoad = "";
                var total = 0;
                var id_trx_po_update = '<?= $id_trx_po ?>';

                console.log(response);

                if (response.length > 0) {
                    for (let i = 0; i < response.length; i++) {

                        //var functionOnclick = 'update_data("' + i +  ','+halaman+','+response.data[i].id_trx_po+'")';
                        // var functionOnclick = 'update_data("' + i + ',' + halaman + ',' + response.data[i].id_trx_po + '")';
                        var functionOnclick = 'update_data("' + response.data[i].id_trx_po + '","' + i + '","' + halaman + '")';
                        total += parseFloat(response.data[i].harga_total);

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
                        dataLoad += '<td width="20%"><input type="text" style="text-align:right;" id="harga_satuan' + i + '" name="harga_satuan[]" value="' + numberWithCommas(response.data[i].harga_satuan) + '" class="form-control-label harga-satuan" onkeypress="validate(event)"></td>'
                        dataLoad += '<td width="20%">'
                        dataLoad += '<input type="text" name="harga_total[]" style="text-align:right;" id="harga_total' + i + '"  value="' + numberWithCommas(response.data[i].harga_total) + '" class="form-control-label harga-total" onkeypress="validate(event)">'
                        dataLoad += '<input type="hidden" name="quantity[]" id="quantity' + i + '" value="' + response.data[i].quantity + '" class="form-control-label">'
                        dataLoad += '<input type="hidden" name="id[]"  id="id' + i + '" value="' + response.data[i].id + '" class="form-control-label">'
                        dataLoad += '<input type="hidden" name="id_trx_po_update[]" id="id_trx_po_update' + i + '" value="' + id_trx_po_update + '" class="form-control-label">'
                        dataLoad += '<input type="hidden" name="id_trx_po[]" id="id_trx_po" value="' + id_trx_po + '" class="form-control-label">'
                        dataLoad += '<input type="hidden" name="status[]" id="status" value="' + response.data[i].status + '" class="form-control-label">'
                        dataLoad += '</td>'
                        dataLoad += "<td>";

                        if (response.data[i].status == '2') {
                            dataLoad += "<a class='form-control-button btn-success' style='background-color: #B89874'><span class='fas fa-check'></span></a>";
                        } else {
                            dataLoad += "<a class='form-control-button btn btn-outline-light button-action' onclick='" + functionOnclick + "'><span class='fas fa-check'></span></a>";
                        }

                        dataLoad += "</td>";
                        dataLoad += "</tr>";

                    }
                    dataLoad += "<tr>";
                    dataLoad += "<td colspan='4' style='text-align:right'>";
                    dataLoad += "Harga Total"
                    dataLoad += "</td>";
                    dataLoad += "<td colspan='2'>";
                    dataLoad += '<input type="text" id="harga-total-sum" class="form-control " value="' + 'Rp. ' + numberWithCommas(response.data_sum) + '">';
                    dataLoad += '<input type="hidden" value="0" id="harga-total-sum-hide" class="form-control ">';
                    dataLoad += "</td>";
                    dataLoad += "</tr>";

                    var totalDataBarang = response.length_paging;
                    var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

                    $('.pagination-result_trx_detail').html(paginationViewHTMLDetail(halaman, totalHalaman, id_trx_po))

                    $("#purchase_from").val(response.data[0].nama);
                    $("#tbody-table-data").html(dataLoad);
                    $("#data-trigger").hide();
                    $("#div-inventory-update-detail").show();
                } else {
                    $('.pagination-result_trx_detail').html("");
                }
            },
            error: function(response) {
                console.log(response);
            }

        });
    }

    function update_data(id_trx_po, it, halaman) {
        console.log("id_trx_po:" + id_trx_po);
        console.log("it:" + it);
        console.log("halaman:" + halaman);

        var harga_satuan = $("#harga_satuan" + it).val();
        var harga_total = $("#harga_total" + it).val();
        var id = $("#id" + it).val();

        if (checkInvalid(harga_satuan) || harga_satuan == '0') {
            alert("harga satuan tidak boleh kosong");
            return;
        }

        if (checkInvalid(harga_total) || harga_total == '0') {
            alert("harga total tidak boleh kosong");
            return;
        }

        $.ajax({
            url: '<?= site_url() ?>/inventory-updatepo/updateharga',
            method: 'post',
            dataType: 'json',
            data: {
                'id': id,
                'harga_satuan': harga_satuan,
                'harga_total': harga_total,
                'id_trx_po': id_trx_po
            },
            success: function(response) {

                dataPagingDetail(id_trx_po);

            },
            error: function(response) {
                console.log(response);
            }

        });

    }

    $(document).on('keyup', '.harga-satuan', function() {

        var quantity = document.getElementsByName('quantity[]');
        var harga_total = document.getElementsByName('harga_total[]');
        var harga_satuan = document.getElementsByName('harga_satuan[]');
        var status = document.getElementsByName('status[]');
        var result = 0;
        //var resultTot = 0;
        var harga_total_hide = $("#harga-total-sum-hide").val();
        var k = "";


        for (var i = 0; i < quantity.length; i++) {

            var a = quantity[i];
            k = k + "array[" + i + "].value= " +
                a.value + " ";
            var index = i;
            var value = a.value;

            console.log("array[" + index + "] => " + value + " => length:" + value.length);

            if (harga_satuan[index].value > 0) {
                result = parseInt(value) * parseInt(harga_satuan[index].value);
                harga_total[index].value = numberWithCommas(result);                
            }

            if (harga_satuan[index].value == "") {
                harga_total[index].value = "";

            }

        }

        //calculateSum();
    });


    function calculateSum() {
        var harga_total = document.getElementsByName('harga_total[]');
        var harga_total_sum = 0;
        var k = "";
        for (var i = 0; i < harga_total.length; i++) {
            var a = harga_total[i];
            k = k + "array[" + i + "].value= " +
                a.value + " ";
            var index = i;
            var value = a.value;

            console.log("array total[" + index + "] => " + value + " => length:" + value.length);

            harga_total_sum = parseFloat(value.replaceAll(',', ''));

            if (harga_total[index].value == "") {
                // harga_total_sum -=  harga_total[index].value;
            }
        }

        $("#harga-total-sum").val(harga_total_sum);

    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function confirmData() {

        var id_trx_po_update = '<?= $id_trx_po ?>';
        var id_trx_po = $("#id_trx_po").val();

        var harga_satuan = document.getElementsByName('harga_satuan[]');
        var k = "";
        var submit = true;
        for (var i = 0; i < harga_satuan.length; i++) {
            var a = harga_satuan[i];
            k = k + "array[" + i + "].value= " + a.value + " ";
            var index = i;
            var value = a.value;

            console.log("array[" + index + "] => " + value + " => length:" + value.length);

            if (checkInvalid(value) || value == '0') {
                alert("harga satuan tidak boleh kosong");
                submit = false;
                break;
            }

        }

        if (submit == true) {
            console.log("submit " + submit);

            $.ajax({
                url: '<?= site_url() ?>/inventory-updatepo/confirm',
                method: 'post',
                dataType: 'json',
                async: false,
                data: {
                    'id_trx_po_update': id_trx_po_update,
                    'id_trx_po': id_trx_po
                },
                success: function(response) {
                    alert("success insert");
                    location.href = "<?= site_url() ?>/inventory-updatepo";
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

        var harga_satuan = document.getElementsByName('harga_satuan[]');
        var k = "";
        var submit = true;
        for (var i = 0; i < harga_satuan.length; i++) {
            var a = harga_satuan[i];
            k = k + "array[" + i + "].value= " + a.value + " ";
            var index = i;
            var value = a.value;

            console.log("array[" + index + "] => " + value + " => length:" + value.length);

            if (checkInvalid(value)) {
                alert("harga satuan tidak boleh kosong");
                submit = false;
                break;
            }

        }

        if (submit == true) {
            console.log("submit " + submit);
            $("#form-update-inventory").attr('action', '<?php echo site_url() ?>/inventory-updatepo/updateharga');
            $("#form-update-inventory").submit();
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

    function searchData() {

        batasTampilData = 10;
        $("#halaman_paging_trx").val("1");
        halaman = $('#halaman_paging_trx').val();
        keyword = $("#search").val();
        loadData(keyword, batasTampilData, halaman);

    }

    function clearAllData() {


        var id_trx_po = $("#id_trx_po").val();

        $.ajax({
            url: '<?= site_url() ?>/inventory-updatepo/clear-all',
            method: 'post',
            dataType: 'json',
            async: false,
            data: {
                'id_trx_po': id_trx_po
            },
            success: function(response) {
                alert("clear all");
                location.href = "<?= site_url() ?>/inventory-updatepo";
            },
            error: function(response) {
                console.log(response);
            }

        });

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

    function dataPagingDetail(id_trx_po) {

        batasTampilData = 10;
        //$("#halaman_paging_trx_detail").val("1");
        halaman = $('#halaman_paging_trx_detail').val();
        getDetailData(halaman, id_trx_po, batasTampilData);
    }

    function dataPagingBarang() {

        batasTampilData = 10;
        halaman = $('#halaman').val();
        keyword = $("#keyword-paging").val();
        //console.log(keyword);
        //halamanAwal = (halaman > 1) ? (halaman * batasTampilData) - batasTampilData : 0;
        getDataBarangPagination(halaman, keyword, batasTampilData);

    }

    function dataPagingBarangTrx() {

        batasTampilData = 10;
        halaman = $('#halaman_paging_trx').val();
        keyword = $("#search").val();
        console.log(keyword);
        //halamanAwal = (halaman > 1) ? (halaman * batasTampilData) - batasTampilData : 0;

        loadData(keyword, batasTampilData, halaman);

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


    $("#keyword-paging").keyup(function(e) {

        //if (e.keyCode == 13) {
        //  e.preventDefault();
        console.log("on jo");
        //$("#halaman").val("1");
        dataPagingBarang();
        //}
    });

    function getDataBarangPagination(halaman, keyword, batasTampilData) {

        $.ajax({
            url: '<?= site_url() ?>/barang/get-pagination-page',
            method: 'post',
            dataType: 'json',
            data: {
                'halaman': halaman,
                'keyword': keyword,
                'batastampil': batasTampilData
            },
            success: function(data) {
                var data_load = ''

                for (let i = 0; i < data.length; i++) {
                    const element = data.data[i];
                    data_load += '<div class="row">'
                    data_load += '    <div class="col">'
                    data_load += '        ' + element.kode
                    data_load += '    </div>'
                    data_load += '    <div class="col">'
                    data_load += '        ' + element.nama_barang
                    data_load += '    </div>'
                    data_load += '</div>'

                }

                $('.data-barang-pagination').html(data_load);
                totalDataBarang = data.length_paging;
                totalHalaman = Math.ceil(totalDataBarang / batasTampilData);
                $('.pagination-result').html(paginationViewHTMLKode(halaman, totalHalaman))
            },
            error: function(data) {
                console.log("Gagal");
                console.log(data);
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

    function paginationViewHTMLKode(halaman, totalHalaman) { //halaman 1 total 6

        var data_load = '';
        prev = parseInt(halaman) - 1;
        next = parseInt(halaman) + 1;
        minimal_page = parseInt(halaman) - 2;
        max_page = parseInt(halaman) + 2;
        var prev_v = "dataPagingBarangHREF('" + prev + "')";
        var next_v = "dataPagingBarangHREF('" + next + "')";
        var halaman1 = "dataPagingBarangHREF('1')";
        var halaman2 = "dataPagingBarangHREF('2')";
        var halaman3 = "dataPagingBarangHREF('3')";
        var halaman4 = "dataPagingBarangHREF('4')";
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
            var onclk = "dataPagingBarangHREF('" + i + "')";

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

    function dataPagingBarangHREF(halaman) {
        $('#halaman').val(halaman)
        dataPagingBarang()
    }

    function dataPagingBarangHREFTrx(halaman) {
        $('#halaman_paging_trx').val(halaman)
        dataPagingBarangTrx()
    }

    function dataPagingBarangHREFTrxDetail(halaman, id_trx_po) {
        $('#halaman_paging_trx_detail').val(halaman)
        dataPagingDetail(id_trx_po)
    }
</script>