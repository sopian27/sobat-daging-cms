<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <div class="col-md-11">
        <hr style="margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    </div>
    <div class="row">
        <div class="col-md-3 offset-md-1"><?= $kode_po ?></div>
        <div class="col-md-2 offset-md-5 "><?= $date ?></div>
    </div>

    <div class="container-fluid" style="margin-top: 60px;">
        <div class="row justify-content-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Nomor Invoice </label>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control-label" id="no_invoice" name="no_invoice">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Nama Pelanggan </label>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control-label" id="nama_pelanggan" name="nama_pelanggan">
                                <input type="hidden" class="form-control" id="id_trx_return" name="id_trx_return" value="<?= $kode_po ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Tanggal Pengiriman </label>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control-label" id="tgl_pengiriman" name="tgl_pengiriman">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Tanggal Return </label>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control-label" id="tgl_return" name="tgl_return">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top: 50px;">
                <div class="col-md-7 offset-md-2 justify-content-center">
                    <div class="row mt-2 ">
                        <table class="table table-dark table-bordered data" id="mytable">
                            <thead>
                                <tr>
                                    <th> Kode </th>
                                    <th> Nama Barang </th>
                                    <th colspan="2"> Quantity </th>
                                    <th colspan="2"> Quantity Barang Return </th>
                                    <th> Note </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody id='tbody-table-data'>
                            </tbody>
                        </table>
                        <input type="hidden" name="halaman_paging" id="halaman_paging" value="1">
                        <div class="pagination-result" style="margin-top:10px;margin-left:40%"></div>
                    </div>
                    <div class="row d-flex justify-content-end" style="margin-top: 30px;">
                        <div class="col-md-2">
                            <button class="form-control-button btn btn-outline-light button-action" onclick="clearAllData();"> Clear All </button>
                        </div>
                        <div class="col-md-2">
                            <button class="form-control-button btn btn-outline-light button-action" onclick="return confirmData();"> Confirm </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top:60px"></div>
</div>

<script>
    $(function() {
        $("#tgl_return").datepicker({
            todayHighlight: true,
            format: "yyyy-mm-dd",
            autoclose: true
        })
    });

    $("#no_invoice").keydown(function(e) {

        if (e.keyCode == 13) {
            e.preventDefault();

            var batasTampilData = 10;
            $("#halaman_paging").val("1");
            var halaman = $('#halaman_paging').val();
            var no_invoice = $('#no_invoice').val();
            getInvoice(no_invoice, batasTampilData, halaman);
        }
    });


    function insert_data(id, it, halaman) {

        var quantity_return = $("#quantity_return" + it).val();
        var note = $("#note" + it).val();
        var quantity_before = $("#quantity_before" + it).val();
        var satuan_return = $('#satuan_return' + it).val();

        var no_invoice = $('#no_invoice').val();
        var tgl_return = $('#tgl_return').val();
        var id_trx_return = $('#id_trx_return').val();
        var batasTampil = 10;
        //var id = $("#id" + it).val();

        if (checkInvalid(quantity_return) || quantity_return == '0') {
            alert("quantity return tidak boleh kosong");
            return;
        }

        if (checkInvalid(note)) {
            alert("note tidak boleh kosong");
            return;
        }
        /*
        if (checkInvalid(tgl_return)) {
            alert("tanggal return tidak boleh kosong");
            return;
        }*/

        if (checkInvalid(satuan_return)) {
            alert("satuan tidak boleh kosong");
            return;
        }

        $.ajax({
            url: '<?= site_url() ?>/return-cancel/insert_data',
            method: 'post',
            dataType: 'json',
            data: {
                'id_trx_po': id,
                'quantity_return': quantity_return,
                'note': note,
                'tgl_return': tgl_return.replaceAll("-", ""),
                'id_trx_return': id_trx_return,
                'satuan_return': satuan_return,
                'quantity_before': quantity_before,
                'no_invoice': no_invoice
            },
            success: function(response) {

                getInvoice(no_invoice, batasTampil, halaman);

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

    function getInvoice(no_invoice, batasTampilData, halaman) {

        $.ajax({
            url: '<?= site_url() ?>/return-cancel/getinvoice',
            method: 'post',
            dataType: 'json',
            data: {
                'halaman': halaman,
                'no_invoice': no_invoice,
                'batastampil': batasTampilData
            },
            success: function(data) {

                var dataload = "";
                console.log(data);

                if (data.data.length > 0) {

                    $("#nama_pelanggan").val(data.data[0].nama_pelanggan.toUpperCase());
                    $("#tgl_pengiriman").val(dateForShow(data.data[0].tgl_pengiriman));


                    for (i = 0; i < data.data.length; i++) {

                        var functionOnclick = 'insert_data("' + data.data[i].id + '","' + i + '","' + halaman + '")';
                        var quantity_return = data.data[i].quantity_return;
                        var note = data.data[i].note;

                        if (quantity_return == "" || quantity_return == null) {
                            quantity_return = "0";
                        }

                        if (note == "" || note == null) {
                            note = "";
                        }

                        dataload += '<tr> '
                        dataload += '    <td  width="10%" class="data " data-dat="kode"><input type="text" name="kode[]" value="' + data.data[i].kode + '" class="form-control data-kode"></td> '
                        dataload += '    <td class="data" data-dat="nama_barang">'
                        dataload += '       <input type="text" name="nama_barang[]" value="' + data.data[i].nama_barang + '" class="form-control ">'
                        dataload += '       <input type="hidden" name="id_trx_po[]" value="' + data.data[i].id + '" class="form-control ">'
                        dataload += '       <input type="hidden" name="quantity_before[]"  id="quantity_before' + i + '" value="' + data.data[i].quantity + '" class="form-control ">'
                        dataload += '    </td>'
                        dataload += '    <td width="10%" class="data" data-dat="quantity" ><input type="text" name="quantity[]" value="' + data.data[i].quantity + '" class="form-control data-quantity"></td> '
                        dataload += '    <td class="data" data-dat="satuan select-wrapper" style="width: 7%;">'
                        dataload += '      <select name="satuan[]" class="form-control">'
                        dataload += '          <option value="Kg">kg</option>'
                        dataload += '          <option value="Dus">Dus</option>'
                        dataload += '      </select>'
                        dataload += '    </td> '
                        dataload += '    <td width="10%" class="data" data-dat="quantity" ><input type="text" id="quantity_return' + i + '" name="quantity_return[]" value="' + quantity_return + '"  onkeypress="validate(event)" class="form-control data-quantity" required></td> '
                        dataload += '    <td class="data" data-dat="satuan select-wrapper" style="width: 7%;">'
                        dataload += '      <select name="satuan_return[]" id="satuan_return' + i + '" class="form-control">'
                        dataload += '          <option value="Kg">kg</option>'
                        dataload += '          <option value="Dus">Dus</option>'
                        dataload += '      </select>'
                        dataload += '    </td> '
                        dataload += '    <td class="data" data-dat="keterangan" style="width: 20%;"><input type="text" name="note[]" id="note' + i + '" value="' + note + '" class="form-control "></td> '
                        if (data.data[i].status == "0") {
                            dataload += "<td><a class='form-control-button btn-success' style='background-color: #a5662f'><span class='fas fa-check'></span></a></td>";
                        } else {
                            dataload += " <td><a class='form-control-button btn btn-outline-light button-action' onclick='" + functionOnclick + "'><span class='fas fa-check'></span></a></td>";
                        }
                        dataload += '</tr>'

                    }

                    $("#tbody-table-data").html(dataload);
                    var totalDataBarang = data.length_paging;
                    var totalHalaman = Math.ceil(totalDataBarang / batasTampilData);

                    $('.pagination-result').html(paginationView(halaman, totalHalaman, no_invoice, batasTampilData))


                } else {

                    $("#tbody-table-data").html("");
                }

            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
        // });
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

    function checkInvalid(val) {
        if (val == null || val == "") {
            return true;
        }

        return false;
    }


    function confirmData() {
 
        var tgl_return = $("#tgl_return").val();
        var no_invoice = $('#no_invoice').val();

        if (checkInvalid(tgl_return)) {
            alert("tanggal return tidak boleh kosong");
            return;
        }

        $.ajax({
            url: '<?= site_url() ?>/return-cancel/save',
            method: 'post',
            dataType: 'json',
            data: {
                'tgl_return': tgl_return.replaceAll("-", ""),
                'no_invoice': no_invoice
            },
            success: function(response) {

                alert("success return cancel");
                location.href = "<?= site_url() ?>/return-cancel";

            },
            error: function(response) {
                console.log(response);
            }

        });
    }

    function clearAllData() {

        $("#tbody-table-data").html("");
        $("#nama_pelanggan").val("");
        $("#tgl_pengiriman").val("");
        $("#tgl_return").val("");

        clearData();


    }

    function clearData() {

        var no_invoice = $('#no_invoice').val();

        $.ajax({
            url: '<?= site_url() ?>/return-cancel/clear-all',
            method: 'post',
            dataType: 'json',
            data: {
                "no_invoice": no_invoice
            },
            success: function(response) {
                alert("clear all");
                location.href = "<?= site_url() ?>/return-cancel";
            },
            error: function(response) {
                console.log(response);
            }

        });

    }

    function paginationView(halaman, totalHalaman, no_invoice, batasTampilData) { //halaman 1 total 6

        var data_load = '';
        prev = parseInt(halaman) - 1;
        next = parseInt(halaman) + 1;
        minimal_page = parseInt(halaman) - 2;
        max_page = parseInt(halaman) + 2;
        var prev_v = "dataPagingBarangHREFTrxDetail('" + prev + "','" + no_invoice + "','" + batasTampilData + "')";
        var next_v = "dataPagingBarangHREFTrxDetail('" + next + "','" + no_invoice + "','" + batasTampilData + "')";
        var halaman1 = "dataPagingBarangHREFTrxDetail('1','" + no_invoice + "','" + batasTampilData + "')";
        var halaman2 = "dataPagingBarangHREFTrxDetail('2','" + no_invoice + "','" + batasTampilData + "')";
        var halaman3 = "dataPagingBarangHREFTrxDetail('3','" + no_invoice + "','" + batasTampilData + "')";
        var halaman4 = "dataPagingBarangHREFTrxDetail('4','" + no_invoice + "','" + batasTampilData + "')";
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
            var onclk = "dataPagingBarangHREFTrxDetail('" + i + "','" + no_invoice + "','" + batasTampilData + "')";

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

    function dataPagingBarangHREFTrxDetail(halaman, no_invoice, batasTampilData) {
        $('#halaman_paging').val(halaman)
        getInvoice(no_invoice, batasTampilData, halaman);
    }
</script>