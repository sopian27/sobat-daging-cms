<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <div class="col-md-11">
        <hr style="margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    </div>
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
                <div class="col-md-7">
                    <form>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 offset-md-4 col-form-label">Purchase From : </label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control-label" id="purchase_from" name="purchase_from">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 offset-md-4 col-form-label">Pic : </label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control-label" id="pic" name="pic">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 offset-md-4 col-form-label">Nomor Handphone : </label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control-label" id="no_hp" name="no_hp">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row" style="margin-top: 40px;">
                <div class="col-md-7 offset-md-2 justify-content-center">
                    <div class="row">
                        <div class="col-md-1">
                            <button class="add form-control-button btn btn-outline-light button-action"> Add </button>
                        </div>
                    </div>
                    <div class="row mt-2 ">
                        <table class="table table-dark table-bordered data" id="tableInv">
                            <thead>
                                <tr>
                                    <th> Kode </th>
                                    <th> Nama Barang </th>
                                    <th colspan="2"> Quantity </th>
                                </tr>
                            </thead>
                            <tbody id='tbody-table-data'></tbody>
                        </table>
                    </div>
                    <div class="row d-flex justify-content-end">
                        <div class="col-md-2">
                            <button class="form-control-button btn btn-outline-light button-action" onclick="clearAllData();"> Clear All </button>
                        </div>
                        <div class="col-md-2" id="before-loading">
                            <button class="form-control-button btn btn-outline-light button-action" onclick="saveSupplier();"> Confirm </button>
                        </div>
                        <div class="col-md-2" id="on-loading" style="display: none;">
                            <button class="form-control-button btn btn-outline-light button-action"> Confirm <span><img src="<?= base_url() ?>/assets/auth/images/loader.png" width="30%" height="20%" /></span> </button>
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
</div>

<script>
    var ar_loop = []
    var total_data = ''

    $(document).on('click', '.delete', function() {
        console.log($(this).parents('tr'));
        $(this).parents('tr').remove();
    });

    $(document).on('click', '.add', function() {
        var dataload = "";
        dataload += '<tr> '
        dataload += '    <td class="data" data-dat="kode"><input type="text" name="kode" value="" class="form-control "></td> '
        //dataload += '    <td class="data" data-dat="kode"><input type="text" name="kode[]" value="" class="form-control data-kode"></td> '
        dataload += '    <td class="data" data-dat="nama_barang"><input type="text" name="nama_barang" value="" class="form-control "></td> '
        // dataload += '    <td class="data" data-dat="nama_barang" width="25%">'
        //dataload += '       <input type="text" name="nama_barang[]" value="" class="form-control ">'
        //dataload += '       <input type="hidden" name="id_barang[]" class="form-control ">'
        //dataload += '    </td>'
        dataload += '    <td class="data quantity" data-dat="quantity"><input type="number" step="0.01" name="quantity" value="" class="form-control " onkeypress="validate(event)"></td> '
        dataload += '    <td class="data" data-dat="satuan">'
        dataload += '      <select name="satuan" id="" class="form-control">'
        dataload += '          <option value="Kg">kg</option>'
        dataload += '          <option value="Dus">Dus</option>'
        dataload += '      </select>'
        dataload += '    </td> '
        dataload += '</tr>'

        $('#tbody-table-data').append(dataload);
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


    function saveSupplier() {

        var supplier_name = $("#purchase_from").val();
        var pic = $("#pic").val();
        var no_hp = $("#no_hp").val();

        if (checkInvalid(supplier_name)) {
            alert("nama supplier tidak boleh kosong");
            return false;
        }

        if (checkInvalid(pic)) {
            alert("pic supplier tidak boleh kosong");
            return false;
        }

        if (checkInvalid(no_hp)) {
            alert("nomor handphone supplier tidak boleh kosong");
            return false;
        }

        const dataTable = document.getElementById('tbody-table-data').querySelectorAll('tr')
        let submit = true;
        var element_select = "";

        if (dataTable.length == 0) {
            alert("data barang tidak boleh kosong");
            return false;

        } else {

            const dataTableLength = dataTable.length;
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
        }


        if (submit === true) {

            $.ajax({
                url: '<?= site_url() ?>/inventory/save-supplier',
                data: {
                    'nama_supplier': supplier_name,
                    'pic': pic,
                    'no_hp': no_hp
                },
                dataType: 'json',
                method: 'post',
                success: function(data) {

                    if (data.result == "ok") {
                        alert("berhasil menambahkan data po");
                        confirmData(data.id);
                    }
                },
                error: function(data) {
                    console.log("Failed");
                    console.log(data);
                }

            });

        }
    }

    function confirmData(id_supplier) {
        var arr = []
        ar_loop = []
        let submit = true;

        const dataTable = document.getElementById('tbody-table-data').querySelectorAll('tr')
        const dataTableLength = dataTable.length

        if (dataTableLength <= 0) {
            alert("data barang tidak boleh kosong");
            return false;
        }

        for (let i = 0; i < dataTableLength; i++) {
            const element = dataTable[i];
            const childElement = element.children;
            var form_costume = document.createElement("form");
            form_costume.setAttribute("id", "insert-inventory");
            form_costume.setAttribute("method", "post");

            var po_id = document.createElement('input')
            po_id.setAttribute('type', 'hidden');
            po_id.setAttribute('name', 'id_trx_po')
            po_id.setAttribute('value', '<?= $id_trx_po ?>')
            form_costume.append(po_id)

            var create_date = document.createElement('input')
            create_date.setAttribute('type', 'hidden');
            create_date.setAttribute('name', 'createDate')
            create_date.setAttribute('value', '<?= $date ?>')
            form_costume.append(create_date)

            var status = document.createElement('input')
            status.setAttribute('type', 'hidden');
            status.setAttribute('name', 'status')
            status.setAttribute('value', '0')
            form_costume.append(status)

            var purchase_from = document.createElement('input')
            purchase_from.setAttribute('type', 'hidden');
            purchase_from.setAttribute('name', 'id_supplier')
            purchase_from.setAttribute('value', id_supplier)
            form_costume.append(purchase_from)

            for (let j = 0; j < childElement.length; j++) {
                const element1 = childElement[j];
                const element1Chlid = element1.children;
                for (let k = 0; k < element1Chlid.length; k++) {
                    const element2 = element1Chlid[k];
                    element_select = element2.name
                    content_select = element2.value
                    /*if (content_select == "") {
                        content_select = " - ";
                    }*/

                    var inp = document.createElement('input')
                    inp.setAttribute('type', 'text');
                    inp.setAttribute('name', element_select)
                    inp.setAttribute('value', content_select)

                    if (content_select == null || content_select == "") {
                        alert("data barang " + element_select + " tidak boleh kosong");
                        submit = false;
                        break;

                    }

                    form_costume.append(inp)
                    arr[element_select] = content_select
                }
            }

            if (submit) {
                //ar_loop.push(arr)
                //arr = [];

                $('#formSubmitData').append(form_costume);
                //console.log($('#insert-inventory').serialize());

                $.ajax({
                    url: '<?= site_url() ?>/inventory/save',
                    data: $('#insert-inventory').serialize(),
                    method: 'post',
                    dataType: 'json',
                    async: true,
                    success: function(data) {
                        //if (data == "success") {
                        console.log("success insert data");
                        location.href = "<?= site_url() ?>/inventory";
                        //}
                    },
                    error: function(data) {
                        console.log("Failed");
                        console.log(data);
                    }

                });

                $('#formSubmitData').empty();
            }

        }
        /*
        if (data == "success") {
            console.log("success insert data");
            location.href = "<?= site_url() ?>/inventory";
        }
        */
    }

    function clearAllData() {
        $('#tbody-table-data').empty();
        $("#purchase_from").val("");
        $("#pic").val("");
        $("#no_hp").val("");
    }

    function dataPagingBarang() {

        batasTampilData = 10;
        halaman = $('#halaman').val();
        keyword = $("#keyword-paging").val();
        //console.log(keyword);
        //halamanAwal = (halaman > 1) ? (halaman * batasTampilData) - batasTampilData : 0;
        getDataBarangPagination(halaman, keyword, batasTampilData);

    }

    /*
    function getDataBarangPagination(halaman, keyword) {

        $.ajax({
            url: '<?= site_url() ?>/barang/get-pagination-page',
            method: 'post',
            dataType: 'json',
            data: {
                halaman: halaman,
                keyword: keyword
            },
            success: function(data) {
                var data_load = ''


                for (let i = 0; i < data.length; i++) {
                    const element = data[i];
                    data_load += '<div class="row">'
                    data_load += '    <div class="col">'
                    data_load += '        ' + element.kode
                    data_load += '    </div>'
                    data_load += '    <div class="col">'
                    data_load += '        ' + element.nama_barang
                    data_load += '    </div>'
                    data_load += '</div>'

                }
                $('.data-barang-pagination').html(data_load)
            },
            error: function(data) {
                console.log("Gagal");
                console.log(data);
            }

        });
    }
    */

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

    function dataPagingBarangHREF(halaman) {
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

    });

    $(document).on('keydown', '.data-kode', function(e) {

        if (e.keyCode == 13) {
            e.preventDefault();
            autoCompleteKode();

        }
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

            setDetailKode(index, value);

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

                if (data.length > 0) {
                    nama_barang[index].value = data[0]["nama_barang"];
                }
            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }
</script>