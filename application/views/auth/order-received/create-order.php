<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <div class="col-md-11">
        <hr style="margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    </div>
    <div class="row">
        <div class="col-md-3 offset-md-1"><?= $kodePO ?></div>
        <div class="col-md-2 offset-md-5 "><?= $date ?></div>
        <p class="col-md-2 offset-md-10">
            <button class="btn btn-outline-light" type="button" data-bs-toggle="collapse" data-bs-target="#data-barang-collapse" aria-expanded="false" aria-controls="data-barang-collapse">
                kode
            </button>
        </p>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 offset-md-1">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Nama Pelanggan </label>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control-label data-nama-pelanggan" id="nama_pelanggan" name="nama_pelanggan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Nomor Hp </label>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control-label" id="nomor_hp1" name="nomor_hp1" onkeypress="validate(event)">
                            </div>
                        </div>
                        <div class="form-group row" style="display: none;">
                            <label for="" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control-label" id="nomor_hp2" name="nomor_hp2" onkeypress="validate(event)">
                            </div>
                        </div>
                        <div class="form-group row" style="margin-top: 10px;">
                            <label for="" class="col-sm-3 col-form-label">Alamat Pengiriman </label>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-4">
                                <textarea id="alamat1" name="alamat1" class="form-control-label"></textarea>
                            </div>
                        </div>
                        <div class="form-group row" style="display: none;">
                            <label for="" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control-label" id="alamat2" name="alamat2">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-1" style="margin-left:-160px">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Tanggal Pengiriman </label>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control-label" id="tgl_pengiriman" name="tgl_pengiriman">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top: 50px;">
                <div class="col-md-8 offset-md-1 justify-content-center">
                    <div class="row">
                        <div class="col-md-1">
                            <button class="form-control-button add btn btn-outline-light button-action"> Add </button>
                        </div>
                    </div>
                    <div class="row mt-2 ">
                        <table class="table table-dark table-bordered data" id="tableInv">
                            <thead>
                                <tr>
                                    <th> Kode </th>
                                    <th> Nama Bahan </th>
                                    <th> Nama Barang </th>
                                    <th colspan="2"> Quantity </th>
                                    <th> Harga Satuan </th>
                                    <th> Harga Total </th>
                                    <th colspan="2"> Note </th>
                                </tr>
                            </thead>
                            <tbody id='tbody-table-data'>
                            </tbody>
                        </table>
                    </div>
                    <div class="row d-flex justify-content-end" style="margin-top: 20px;">
                        <div class="col-md-2">
                            <button class="form-control-button btn btn-outline-light button-action" onclick="clearAllData();"> Clear All </button>
                        </div>
                        <div class="col-md-2" id="loader-confirmed">
                            <button class="form-control-button btn btn-outline-light button-action" onclick="savePelangganData();">Confirmed</button>
                        </div>
                        <div class="col-md-2" id="loader" style="display: none;">
                            <button class="form-control-button btn btn-outline-light button-action">Saving Data...</button>
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
                                            <input class="form-control-paging" type="text" placeholder="search..." name="keyword-paging" id="keyword-paging" onkeyup="dataPagingBarang()">
                                            <span class="input-group-append">
                                                <button class="btn btn-outline-light" type="button">
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
    <div style="margin-top:60px"></div>
</div>

<script>
    var ar_loop = []
    var total_data = ''

    $(document).on('click', '.delete', function() {
        console.log($(this).parents('tr'));
        $(this).parents('tr').remove();
    })

    $(document).on('click', '.add', function() {
        var dataload = "";
        dataload += '<tr> '
        dataload += '    <td class="data " data-dat="kode" width="11%"><input type="text" name="kode[]" value="" class="form-control data-kode"></td> '
        dataload += '    <td class="data" data-dat="nama_barang" width="20%">'
        dataload += '       <input type="text" name="nama_barang[]" value="" class="form-control ">'
        dataload += '       <input type="hidden" name="id_barang[]" class="form-control ">'
        dataload += '    </td>'
        dataload += '    <td class="data" data-dat="keterangan_barang" style="width: 20%;"><input type="text" name="keterangan_barang[]" value="" class="form-control "></td> '
        dataload += '    <td class="data" data-dat="quantity" style="width: 9%;"><input type="number" step="0.01" value="1" name="quantity[]" value="" class="form-control data-quantity" onkeypress="validate(event)"></td> '
        dataload += '    <td class="data" data-dat="satuan select-wrapper" style="width: 7%;"> '
        dataload += '      <select name="satuan[]" class="form-control" >'
        dataload += '          <option value="Kg">kg</option>'
        dataload += '          <option value="Dus">Dus</option>'
        dataload += '      </select>'
        dataload += '    </td> '
        dataload += '    <td class="data" data-dat="harga_satuan" style="width: 12%;"><input type="text" name="harga_satuan[]" value="" class="form-control data-harga-satuan" onkeypress="validate(event)"></td> '
        dataload += '    <td class="data" data-dat="harga_total" style="width: 12%;"><input type="text" name="harga_total[]" value="" class="form-control "></td> '
        dataload += '    <td class="data" data-dat="keterangan" style="width: 25%;"><input type="text" name="keterangan[]" value="" class="form-control "></td> '
        dataload += '</tr>'

        $('#tbody-table-data').append(dataload);

    });

    function checkInvalid(val) {
        if (val == null || val == "") {
            return true;
        }

        return false;
    }

    function savePelangganData() {

        var nama_pelanggan = $("#nama_pelanggan").val();
        var nomor_hp1 = $("#nomor_hp1").val();
        var alamat1 = $("#alamat1").val();
        var tgl_pengiriman = $("#tgl_pengiriman").val();

        if (checkInvalid(nama_pelanggan)) {
            alert("nama pelanggan tidak boleh kosong");
            return false;
        }

        if (checkInvalid(nomor_hp1)) {
            alert("nomor hp tidak boleh kosong");
            return false;
        }

        if (checkInvalid(alamat1)) {
            alert("alamat tidak boleh kosong");
            return false;
        }

        if (checkInvalid(tgl_pengiriman)) {
            alert("tanggal pengiriman tidak boleh kosong");
            return false;
        }

        const dataTable = document.getElementById('tbody-table-data').querySelectorAll('tr')
        const dataTableLength = dataTable.length;
        let submit = true;
        var element_select = "";

        for (let i = 0; i < dataTableLength; i++) {
            const element = dataTable[i];
            const childElement = element.children;

            for (let j = 0; j < childElement.length; j++) {
                const element1 = childElement[j];
                const element1Chlid = element1.children;

                for (let k = 0; k < element1Chlid.length; k++) {
                    const element2 = element1Chlid[k];
                    element_select = element2.name
                    content_select = element2.value
                }

                if (content_select == null || content_select == "") {
                    alert("data barang " + content_select + " tidak boleh kosong");
                    submit = false;
                    break;

                }
            }
        }

        if (submit === true) {

            $.ajax({
                url: '<?= site_url() ?>/order-received/save-additional',
                data: {
                    'alamat1': alamat1,
                    'nama_pelanggan': nama_pelanggan,
                    'nomor_hp1': nomor_hp1
                },
                dataType: 'json',
                method: 'post',
                success: function(response) {

                    console.log(response.alamat_id + "-" + response.telephone_id + "-" + response.pelanggan_id);
                    alert("berhasil menambahkan data order");
                    confirmData(response.alamat_id, response.telephone_id, response.pelanggan_id);

                },
                error: function(xhr, status, error) {
                    //var err = eval("(" + xhr.responseText + ")");
                    console.log(error);
                }

            });
        }



    }

    function confirmData(id_alamat, id_telephone, id_pelanggan) {
        var arr = []
        ar_loop = []
        let result = false;

        const dataTable = document.getElementById('tbody-table-data').querySelectorAll('tr')
        const dataTableLength = dataTable.length

        for (let i = 0; i < dataTableLength; i++) {
            const element = dataTable[i];
            const childElement = element.children;
            var form_costume = document.createElement("form");
            form_costume.setAttribute("id", "form-create-order");
            form_costume.setAttribute("method", "post");

            var po_id = document.createElement('input')
            po_id.setAttribute('type', 'hidden');
            po_id.setAttribute('name', 'kode_po')
            po_id.setAttribute('value', '<?= $kodePO ?>')
            form_costume.append(po_id)

            //no_invoice
            var po_idInv = document.createElement('input')
            po_idInv.setAttribute('type', 'hidden');
            po_idInv.setAttribute('name', 'kode_inv')
            po_idInv.setAttribute('value', '<?= $kodeInv ?>')
            form_costume.append(po_idInv)

            //no_surat_jalan
            var po_idSsj = document.createElement('input')
            po_idSsj.setAttribute('type', 'hidden');
            po_idSsj.setAttribute('name', 'kode_ssj')
            po_idSsj.setAttribute('value', '<?= $kodeSsj ?>')
            form_costume.append(po_idSsj)

            var po_idhistory = document.createElement('input')
            po_idhistory.setAttribute('type', 'hidden');
            po_idhistory.setAttribute('name', 'kode_history')
            po_idhistory.setAttribute('value', '<?= $kodeHistory ?>')
            form_costume.append(po_idhistory)

            var create_date = document.createElement('input')
            create_date.setAttribute('type', 'hidden');
            create_date.setAttribute('name', 'createDate')
            create_date.setAttribute('value', '<?= $date ?>')
            form_costume.append(create_date)

            var nama_pelanggan = document.createElement('input')
            nama_pelanggan.setAttribute('type', 'hidden');
            nama_pelanggan.setAttribute('name', 'id_pelanggan')
            nama_pelanggan.setAttribute('value', $('#nama_pelanggan').val())
            form_costume.append(nama_pelanggan)

            var nomor_hp1 = document.createElement('input')
            nomor_hp1.setAttribute('type', 'hidden');
            nomor_hp1.setAttribute('name', 'nomor_hp1')
            nomor_hp1.setAttribute('value', $('#nomor_hp1').val())
            form_costume.append(nomor_hp1)

            var nomor_hp2 = document.createElement('input')
            nomor_hp2.setAttribute('type', 'hidden');
            nomor_hp2.setAttribute('name', 'nomor_hp2')
            nomor_hp2.setAttribute('value', $('#nomor_hp2').val())
            form_costume.append(nomor_hp2)

            var alamat1 = document.createElement('input')
            alamat1.setAttribute('type', 'hidden');
            alamat1.setAttribute('name', 'alamat1')
            alamat1.setAttribute('value', $('#alamat1').val())
            form_costume.append(alamat1)

            var alamat2 = document.createElement('input')
            alamat2.setAttribute('type', 'hidden');
            alamat2.setAttribute('name', 'alamat2')
            alamat2.setAttribute('value', $('#alamat2').val())
            form_costume.append(alamat2)

            var id_pelanggan_form = document.createElement('input')
            id_pelanggan_form.setAttribute('type', 'hidden');
            id_pelanggan_form.setAttribute('name', 'id_pelanggan')
            id_pelanggan_form.setAttribute('value', id_pelanggan)
            form_costume.append(id_pelanggan_form)

            var id_telephone_form = document.createElement('input')
            id_telephone_form.setAttribute('type', 'hidden');
            id_telephone_form.setAttribute('name', 'id_telephone')
            id_telephone_form.setAttribute('value', id_telephone)
            form_costume.append(id_telephone_form)

            var id_alamat_form = document.createElement('input')
            id_alamat_form.setAttribute('type', 'hidden');
            id_alamat_form.setAttribute('name', 'id_alamat')
            id_alamat_form.setAttribute('value', id_alamat)
            form_costume.append(id_alamat_form)

            var tgl_pengiriman = document.createElement('input')
            tgl_pengiriman.setAttribute('type', 'hidden');
            tgl_pengiriman.setAttribute('name', 'tgl_pengiriman')
            tgl_pengiriman.setAttribute('value', $('#tgl_pengiriman').val().replaceAll('-', ''))
            form_costume.append(tgl_pengiriman)

            for (let j = 0; j < childElement.length; j++) {
                const element1 = childElement[j];
                const element1Chlid = element1.children;

                for (let k = 0; k < element1Chlid.length; k++) {
                    const element2 = element1Chlid[k];
                    element_select = element2.name
                    content_select = element2.value

                    var inp = document.createElement('input')
                    inp.setAttribute('type', 'hidden');
                    inp.setAttribute('name', element_select)
                    inp.setAttribute('value', content_select)

                    console.log(element_select + "==>" + content_select);
                    form_costume.append(inp)
                    arr[element_select] = content_select
                }
            }

            $('#formSubmitData').append(form_costume);

            $.ajax({
                url: '<?= site_url() ?>/order-received/save',
                data: $('#form-create-order').serialize(),
                method: 'post',
                async: true,
                beforeSend: function() {
                    $("#loader-confirmed").hide();
                    $("#loader").show();
                },
                success: function(data) {

                    console.log("success");
                    //result = true;
                    location.href = "<?= site_url() ?>/order-received";
                },
                complete: function(data) {
                    $("#loader-confirmed").show();
                    $("#loader").hide();
                    //result = true;
                    //alert("success insert data");
                    //location.href = "<?= site_url() ?>/order-received";

                },
                error: function(xhr, status, error) {
                    console.log("Failed");
                    console.log(error);
                }

            });

            $('#formSubmitData').empty();

        }
        console.log("result" + result);
        //if(result==true){
        // alert("success insert data");
        //  location.href = "<?= site_url() ?>/order-received";
        // }
    }


    $(document).on('keydown', '.data-kode', function(e) {

        if (e.keyCode == 13) {
            e.preventDefault();
            autoCompleteKode();

        }


        if (e.keyCode == 8) {
            //e.preventDefault();
            //handle backspace 

        }


        /*
        var input = document.getElementsByName('kode[]');
        var k = "";
        for (var i = 0; i < input.length; i++) {
            var a = input[i];
            k = k + "array[" + i + "].value= " +
                a.value + " ";
            var index = i;
            var value = a.value;

            console.log("array[" + index + "] => " + value + " => length:" + value.length);

            if (value.length >= 7) {
                setDetailKode(index, value);
            }

        }*/
    });

    function autoCompleteKode() {

        var input = document.getElementsByName('kode[]');

        var k = "";
        for (var i = 0; i < input.length; i++) {
            var a = input[i];
            k = k + "array[" + i + "].value= " +
                a.value + " ";
            var index = i;
            var value = a.value;

            console.log("array[" + index + "] => " + value + " => length:" + value.length);

            //if (value.length >= 7) {
            setDetailKode(index, value);
            //}

        }
    }

    function setDetailKode(index, value) {

        var nama_barang = document.getElementsByName('nama_barang[]');
        var harga_satuan = document.getElementsByName('harga_satuan[]');
        var id_barang = document.getElementsByName('id_barang[]');

        $.ajax({
            url: '<?= site_url() ?>/order-received/getdatakode',
            method: 'post',
            dataType: 'json',
            data: {
                kode: value
            },
            success: function(data) {
                if (data["nama_barang"] != "undefined") {
                    nama_barang[index].value = data[0]["nama_barang"];
                    //harga_satuan[index].value = data[0]["harga_satuan"];
                    id_barang[index].value = data[0]["id"];
                }
            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }


    $(document).on('keyup mouseup', '.data-quantity', function() {
        var quantity = document.getElementsByName('quantity[]');
        var harga_total = document.getElementsByName('harga_total[]');
        var harga_satuan = document.getElementsByName('harga_satuan[]');

        var k = "";
        for (var i = 0; i < quantity.length; i++) {
            var a = quantity[i];
            k = k + "array[" + i + "].value= " +
                a.value + " ";
            var index = i;
            var value = a.value;

            console.log("array[" + index + "] => " + value + " => length:" + value.length);

            //validasi number
            harga_total[index].value = parseFloat(value) * parseInt(harga_satuan[index].value);


        }
    });

    $(document).on('keyup', '.data-quantity', function() {

        var quantity = document.getElementsByName('quantity[]');
        var harga_total = document.getElementsByName('harga_total[]');
        var harga_satuan = document.getElementsByName('harga_satuan[]');

        var k = "";
        for (var i = 0; i < quantity.length; i++) {
            var a = quantity[i];
            k = k + "array[" + i + "].value= " +
                a.value + " ";
            var index = i;
            var value = a.value;

            console.log("array[" + index + "] => " + value + " => length:" + value.length);

            //validasi number
            harga_total[index].value = parseFloat(value) * parseInt(harga_satuan[index].value);


        }
    });

    $(document).on('keyup', '.data-harga-satuan', function() {

        var quantity = document.getElementsByName('quantity[]');
        var harga_total = document.getElementsByName('harga_total[]');
        var harga_satuan = document.getElementsByName('harga_satuan[]');

        var k = "";
        for (var i = 0; i < quantity.length; i++) {
            var a = quantity[i];
            k = k + "array[" + i + "].value= " +
                a.value + " ";
            var index = i;
            var value = a.value;

            console.log("array[" + index + "] => " + value + " => length:" + value.length);

            //validasi number
            harga_total[index].value = parseFloat(value) * parseInt(harga_satuan[index].value);


        }
    });

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


    /*
    $(document).on('keyup', '#nama_pelanggan', function() {

        var nama_pelanggan = document.getElementById("nama_pelanggan").value;
        $.ajax({
            url: '<?= site_url() ?>/order-received/getdatapelanggan',
            method: 'post',
            dataType: 'json',
            data: {
                nama_pelanggan: nama_pelanggan
            },
            success: function(data) {

                if (data["nama_pelanggan"] != "undefined") {
                    $("#nomor_hp1").val(data["nomor_hp1"]);
                    $("#nomor_hp2").val(data["nomor_hp2"]);
                    $("#alamat1").val(data["alamat1"]);
                    $("#alamat2").val(data["alamat2"]);
                }
            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    });

    */

    $(function() {
        $("#tgl_pengiriman").datepicker({
            format: "yyyy-mm-dd",
            todayHighlight: true,
            autoclose: true
        })
    });


    function clearAllData() {
        $('#tbody-table-data').empty();
        $("#nama_pelanggan").val("");
        $("#nomor_hp1").val("");
        $("#nomor_hp2").val("");
        $("#alamat1").val("");
        $("#alamat2").val("");
        $("#tgl_pengiriman").val("");

    }


    function dataPagingBarang() {

        batasTampilData = 10;
        halaman = $('#halaman').val();
        keyword = $("#keyword-paging").val();
        //console.log(keyword);
        //halamanAwal = (halaman > 1) ? (halaman * batasTampilData) - batasTampilData : 0;
        getDataBarangPagination(halaman, keyword, batasTampilData);

    }

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
                $('.pagination-result').html(paginationViewHTML(halaman, totalHalaman))
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
        var prev_v = "dataPaginBarangHREF('" + prev + "')";
        var next_v = "dataPaginBarangHREF('" + next + "')";
        var halaman1 = "dataPaginBarangHREF('1')";
        var halaman2 = "dataPaginBarangHREF('2')";
        var halaman3 = "dataPaginBarangHREF('3')";
        var halaman4 = "dataPaginBarangHREF('4')";
        data_load += '<ul class ="pagination">'
        if (halaman > 1) {
            data_load += '<li class="page-item"><a href ="#"  class = "page-link " onclick="' + prev_v + '">< </a></li>'
        } else {
            data_load += '<li class="page-item"><a href="#" class = "page-link " > < <a></li>'
        }

        for (let i = minimal_page; i <= max_page; i++) {
            var onclk = "dataPaginBarangHREF('" + i + "')";

            if (i == halaman) {
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
        } else {
            data_load += '<li class="page-item"><a href="#" class = "page-link "> > <a></li>'
        }
        data_load += '</ul>'
        console.log(data_load);
        return data_load;
    }

    function dataPaginBarangHREF(halaman) {
        $('#halaman').val(halaman)
        dataPagingBarang()
    }

    $("#keyword-paging").keyup(function(e) {

        //if (e.keyCode == 13) {
        //  e.preventDefault();
        console.log("on jo");
        dataPagingBarang();
        //}
    });

    $(document).ready(function() {
        dataPagingBarang();
        clearAllData();

    })
</script>