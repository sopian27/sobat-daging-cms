<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <hr style="width: 1570px;margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
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
                                <input type="text" class="form-control-label" id="nomor_hp1" name="nomor_hp1">
                            </div>
                        </div>
                        <div class="form-group row" style="display: none;">
                            <label for="" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control-label" id="nomor_hp2" name="nomor_hp2">
                            </div>
                        </div>
                        <div class="form-group row" style="margin-top: 10px;">
                            <label for="" class="col-sm-3 col-form-label">Alamat Pengiriman </label>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control-label" id="alamat1" name="alamat1">
                            </div>
                        </div>
                        <div class="form-group row">
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
                <div class="col-md-7 offset-md-2 justify-content-center">
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
                                    <th> Nama Barang </th>
                                    <th colspan="2"> Quantity </th>
                                    <th> Harga Satuan </th>
                                    <th> Harga Total </th>
                                    <th colspan="2"> Note </th>
                                    <!-- <th> Action </th> -->
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
                        <div class="col-md-2">
                            <button class="form-control-button btn btn-outline-light button-action" onclick="confirmData();"> Confirm </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 justify-content-center">
                <div style="min-height: 120px;">
                        <div class="collapse collapse-horizontal" id="data-barang-collapse">
                            <div class="card card-body bg-transparent " style="width: 300px; border: 2px solid white;">
                                <input type="hidden" name="halaman" id="halaman" value="1">
                                <input type="hidden" name="dataBarangCount" id="dataBarangCount" value="<?= $dataBarangCount ?>">
                                <div class="row">

                                </div>
                                <div class="data-barang-pagination">

                                </div>
                                <div class="pagination-result" style="margin-left:160px;margin-top:10px">

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
    var ar_loop = []
    var total_data = ''

    $(document).on('click', '.delete', function() {
        console.log($(this).parents('tr'));
        $(this).parents('tr').remove();
    })

    $(document).on('click', '.add', function() {
        var dataload = "";
        dataload += '<tr> '
        dataload += '    <td class="data " data-dat="kode"><input type="text" name="kode[]" value="" class="form-control data-kode"></td> '
        dataload += '    <td class="data" data-dat="nama_barang">'
        dataload += '       <input type="text" name="nama_barang[]" value="" class="form-control ">'
        dataload += '       <input type="hidden" name="id_barang[]" value="" class="form-control ">'
        dataload += '    </td>'
        dataload += '    <td class="data" data-dat="quantity" ><input type="text" name="quantity[]" value="" class="form-control data-quantity"></td> '
        dataload += '    <td class="data" data-dat="satuan select-wrapper" style="width: 7%;"> '
        dataload += '      <select name="satuan[]" class="form-control" >'
        dataload += '          <option value="Kg">kg</option>'
        dataload += '          <option value="Dus">Dus</option>'
        dataload += '      </select>'
        dataload += '    </td> '
        dataload += '    <td class="data" data-dat="harga_satuan"><input type="text" name="harga_satuan[]" value="" class="form-control "></td> '
        dataload += '    <td class="data" data-dat="harga_total"><input type="text" name="harga_total[]" value="" class="form-control "></td> '
        dataload += '    <td class="data" data-dat="keterangan" style="width: 20%;"><input type="text" name="keterangan[]" value="" class="form-control "></td> '
        dataload += '</tr>'

        $('#tbody-table-data').append(dataload);

    })

    function confirmData() {
        var arr = []
        ar_loop = []

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
            nama_pelanggan.setAttribute('name', 'nama_pelanggan')
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

            var tgl_pengiriman = document.createElement('input')
            tgl_pengiriman.setAttribute('type', 'hidden');
            tgl_pengiriman.setAttribute('name', 'tgl_pengiriman')
            tgl_pengiriman.setAttribute('value', $('#tgl_pengiriman').val().replaceAll('/', ''))
            form_costume.append(tgl_pengiriman)

            for (let j = 0; j < childElement.length; j++) {
                const element1 = childElement[j];
                const element1Chlid = element1.children;

                for (let k = 0; k < element1Chlid.length; k++) {
                    const element2 = element1Chlid[k];
                    element_select = element2.name
                    content_select = element2.value
                    if (content_select == "") {
                        content_select = " - ";
                    }
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
                success: function(data) {
                    if (data == "success") {
                        alert("success insert data");
                        location.href = "<?= site_url() ?>/order-received";
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Failed");
                    console.log(error);
                }

            });
            $('#formSubmitData').empty();

        }
    }

    $(document).on('keyup', '.data-kode', function() {
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

        }
    });

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
                    nama_barang[index].value = data["nama_barang"];
                    harga_satuan[index].value = data["harga_satuan"];
                    id_barang[index].value = data["id"];
                }
            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }

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
            harga_total[index].value = parseInt(value) * parseInt(harga_satuan[index].value);


        }
    });


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

    $(function() {
        $("#tgl_pengiriman").datepicker({
            format: "yyyy/mm/dd",
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

    function dataPaginBarang() {

        batasTampilData = 10;
        halaman = $('#halaman').val()
        keyword = ''
        halamanAwal = (halaman > 1) ? (halaman * batasTampilData) - batasTampilData : 0;
        totalDataBarang = $('#dataBarangCount').val()
        totalHalaman = Math.ceil(totalDataBarang / batasTampilData);
        console.log(totalHalaman);
        getDataBarangaPagination(halaman, keyword)
        $('.pagination-result').html(paginationViewHTML(halaman, totalHalaman))


    }

    function getDataBarangaPagination(halaman, keyword) {

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

                data_load += '<div class="row">'
                data_load += '    <div class="col">'
                data_load += '        Kode'
                data_load += '    </div>'
                data_load += '    <div class="col">'
                data_load += '        Barang'
                data_load += '    </div>'
                data_load += '</div>'
                data_load += ' <hr style="width: 260px;margin-left:0px;border-width: 2px;border-style: solid;border-color:white">'
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
        dataPaginBarang()
    }

    $(document).ready(function() {
        dataPaginBarang()

    })
</script>