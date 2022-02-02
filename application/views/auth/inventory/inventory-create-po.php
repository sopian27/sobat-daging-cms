<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <hr style="width: 1570px;margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    <div class="row">
        <div class="col-md-3 offset-md-1"><?= $id_trx_po ?></div>
        <div class="col-md-2 offset-md-6 "><?= $date ?></div>
    </div>


    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="row">
                <div class="col-md-7 offset-md-2">
                    <form>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Purchase From : </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="purchase_from" name="purchase_from">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
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
                                    <!-- <th> Action </th> -->
                                </tr>
                            </thead>
                            <tbody id='tbody-table-data'>

                            </tbody>
                        </table>
                    </div>
                    <div class="row d-flex justify-content-end">
                        <div class="col-md-2">
                            <button class="form-control-button btn btn-outline-light button-action" onclick="clearAllData();"> Clear All </button>
                        </div>
                        <div class="col-md-2">
                            <button class="form-control-button btn btn-outline-light button-action" onclick="confirmData();"> Confirm </button>
                            <!-- <button class="form-control btn btn-outline-light" onclick="inputToHtml();"> Confirm </button> -->
                        </div>
                    </div>
                    <div class="row d-flex justify-content-start formSubmitData" id="formSubmitData">
                    </div>
                </div>
                <div class="col-md-3 justify-content-center">
                    <p>
                        <button class="btn btn-outline-light" type="button" data-bs-toggle="collapse" data-bs-target="#data-barang-collapse" aria-expanded="false" aria-controls="data-barang-collapse">
                            kode
                        </button>
                    </p>
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

    $(document).on('click', '.add', function() {
        var dataload = "";
        dataload += '<tr> '
        dataload += '    <td class="data" data-dat="kode"><input type="text" name="kode" value="" class="form-control "></td> '
        dataload += '    <td class="data" data-dat="nama_barang"><input type="text" name="nama_barang" value="" class="form-control "></td> '
        dataload += '    <td class="data" data-dat="quantity"><input type="number" name="quantity" value="" class="form-control "></td> '
        dataload += '    <td class="data" data-dat="satuan">'
        dataload += '      <select name="satuan" id="" class="form-control">'
        dataload += '          <option value="Kg">kg</option>'
        dataload += '          <option value="Dus">Dus</option>'
        dataload += '      </select>'
        dataload += '    </td> '
        /* 
            //dataload += '    <td> '
            // dataload += '        <button class="save btn btn-outline-success btn-sm" style="display: none;"> Save </button> '
            // dataload += '        <button class="edit btn btn-outline-light btn-sm"> Edit </button> '
            // dataload += '        <button class="delete btn btn-outline-danger btn-sm"> Delete </button> '
            // dataload += '    </td> ' 
        */
        dataload += '</tr>'

        $('#tbody-table-data').append(dataload);
    })




    function confirmData() {
        var arr = []
        ar_loop = []

        const dataTable = document.getElementById('tbody-table-data').querySelectorAll('tr')
        const dataTableLength = dataTable.length
        console.log(dataTableLength);
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

            var create_date = document.createElement('input')
            create_date.setAttribute('type', 'hidden');
            create_date.setAttribute('name', 'status')
            create_date.setAttribute('value', '0')
            form_costume.append(create_date)

            var purchase_from = document.createElement('input')
            purchase_from.setAttribute('type', 'hidden');
            purchase_from.setAttribute('name', 'nama_supplier')
            purchase_from.setAttribute('value', $('#purchase_from').val())
            form_costume.append(purchase_from)

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
                    inp.setAttribute('type', 'text');
                    inp.setAttribute('name', element_select)
                    inp.setAttribute('value', content_select)
                    form_costume.append(inp)
                    arr[element_select] = content_select
                }
            }
            ar_loop.push(arr)
            arr = [];

            $('#formSubmitData').append(form_costume);
            console.log($('#insert-inventory').serialize());
            $.ajax({
                url: '<?= site_url() ?>/inventory/save',
                data: $('#insert-inventory').serialize(),
                method: 'post',
                success: function(data) {
                    console.log(data);
                },
                error: function(data) {
                    console.log("Failed");
                    console.log(data);
                }

            });
            $('#formSubmitData').empty();

        }

        console.log(ar_loop);
        //location.reload();
    }

    function clearAllData() {
        $('#tbody-table-data').empty();
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