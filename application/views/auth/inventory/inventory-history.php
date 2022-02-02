<?php
$data_update = $allDataPo;
$date = date_create($tanggal);
$tanggal =  date_format($date, "d F Y");

$date1 = date_create($tanggal_sampai);
$tanggal_sampai =  date_format($date, "d F Y");

?>
<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <hr style="width: 1570px;margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    <!-- <div class="row">
        <div class="col-md-3 offset-md-1"><?= $trx_lvStocks ?></div>
        <div class="col-md-2 offset-md-6 ">
            <?php
            // print_r($_POST);
            $date = date_create($tanggal);
            $tanggal =  date_format($date, "d F Y");
            echo $tanggal;
            ?>
        </div> -->
</div>


<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="row">
                    <div class="col">
                        <form>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 "><?= $trx_lvStocks ?> </label>

                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <form>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 ">Purchase From : </label>
                                <div class="col-sm-5">
                                    <?= $data['supplier_name'] ?>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-5 offest-md-1">
                        <div class="form-group row">
                            <label for="" class="col-sm-5 ">Tanggal PO </label>
                            <div class="col-sm-5">
                                : <?= $data['tanggal'] ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-5 ">Tanggal Penerimaan </label>
                            <div class="col-sm-5">
                                : <?= $data['tanggal_sampai'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-7 offset-md-2 justify-content-center">
                <div class="row">
                    <div class="col-md-1">
                    </div>
                </div>
                <pre>
                        <!-- <?php
                                print_r($data['allDataPo']);
                                ?> -->
                    </pre>
                <div class="row mt-2 ">
                    <table class="table table-dark table-bordered data" id="tableInv">
                        <thead>
                            <tr>
                                <th> Kode </th>
                                <th> Nama Barang </th>
                                <th> Quantity </th>
                                <th> Quantity Check</th>
                                <th> Harga Satuan</th>
                                <th> Harga Total</th>
                            </tr>
                        </thead>
                        <tbody id='tbody-table-data'>
                            <?php
                            foreach ($data_update as $data_loop) :
                            ?>
                                <tr>
                                    <td class="data" data-dat="id" style="display: none;"><input type="text" name="id" value="<?= $data_loop->id; ?>" class="form-control "></td>
                                    <td class="data" data-dat="kode"> <?= $data_loop->kode ?></td>
                                    <td class="data" data-dat="nama_barang"> <?= $data_loop->nama_barang ?></td>
                                    <td class="data" data-dat="quantity"><?= $data_loop->quantity ?> <?= $data_loop->satuan ?></td>
                                    <td class="data" data-dat="quantity_check"> <?= $data_loop->quantity_check ?> <?= $data_loop->satuan ?></td>
                                    <td class="data" data-dat="harga_satuan">Rp <?= $data_loop->harga_satuan ?></td>
                                    <td class="data" data-dat="harga_satuan">Rp <?= $data_loop->harga_satuan * $data_loop->quantity_check  ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="row d-flex justify-content-end">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-2">
                        <button class="form-control-button btn btn-outline-light" onclick="confirmData();"> Confirm </button>
                        <!-- <button class="form-control btn btn-outline-light" onclick="inputToHtml();"> Confirm </button> -->
                    </div>
                </div>
                <div class="row d-flex justify-content-start formSubmitData" id="formSubmitData">
                </div>
            </div>

        </div>
    </div>
</div>
</div>

<script>
    var ar_loop = []
    var total_data = ''
    /* for debuging
        $(document).on('click', '.edit', function() {
            console.log($(this).parent());
            $(this).parent().siblings('td.data').each(function() {
                var load_html_element = "";
                var contConvrt = ""
                var col_name = $(this).data('dat');
                var content = $(this).html().trim();


                if (col_name === 'satuan') {
                    console.log(content);
                    load_html_element += ' <select name="satuan" id="" class="form-control">'
                    if (content == "Kg") {
                        load_html_element += '     <option value="Kg" selected>kg</option>'
                        load_html_element += '     <option value="Dus">Dus</option>'
                    } else if (content == "Dus") {
                        load_html_element += '     <option value="Kg">kg</option>'
                        load_html_element += '     <option value="Dus" selected>Dus</option>'
                        // console.log("MAU DUS");
                    } else {
                        load_html_element += '     <option value="Kg">kg</option>'
                        load_html_element += '     <option value="Dus">Dus</option>'
                        // console.log("skip bang");
                    }
                    load_html_element += ' </select>'

                } else {

                    load_html_element += '<input type="text" name="' + col_name + '" value="' + content + '" class="form-control col-md-1">'
                }
                $(this).html(load_html_element)
            });
            $(this).siblings('.save').show();
            $(this).siblings('.delete').show();
            $(this).hide();
        });

        $(document).on('click', '.save', function() {
            var arr = []
            $('input').each(function() {
                var element_name = $(this).attr('name');
                var content = $(this).val();

                if (content == "") {
                    content = "-"
                    if (element_name == 'quantity') {
                        content = "0"
                    }
                }
                arr[element_name] = content;
                $(this).html(content);
                $(this).contents().unwrap();
            });
            $('select').each(function() {
                var element_select = $(this).attr('name');
                var content_select = $(this).val();
                arr[element_select] = content_select;
                $(this).html(" " + content_select);
                $(this).contents().unwrap();
            })
            $(this).siblings('.edit').show();
            $(this).siblings('.delete').show();
            $(this).hide();
            // ar_loop.push(arr)
            // console.log(ar_loop);
        });

        function inputToHtml() {
            var arr = []
            ar_loop = []

            const dataTable = document.getElementById('tbody-table-data').querySelectorAll('tr')
            const dataTableLength = dataTable.length
            for (let i = 0; i < dataTableLength; i++) {
                const element = dataTable[i];
                const childElement = element.children;
                console.log(childElement);
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
                        arr[element_select] = content_select
                    }
                }
                ar_loop.push(arr)
                arr = [];
            }
            console.log(ar_loop)
        }
    */
    $(document).on('click', '.delete', function() {
        console.log($(this).parents('tr'));
        $(this).parents('tr').remove();
    })

    function confirmData() {
        location.href = "<?= site_url() ?>/inventory/unsetpostdata/historypo";
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