
<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <hr style="width: 1570px;margin-left:160px;border-width: 2px;border-style: solid;border-color:white">



    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="row">
                        <div class="col-md-2  "><?= $id_trx_mutasi ?></div>
                        <div class="col-md-3 offset-md-7 "><?= $date ?></div>
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
                                print_r($allDataPo);
                                ?> -->
                    </pre>
                    <div class="row mt-2 ">
                        <table class="table table-dark table-bordered data" id="tableInv">
                            <thead>
                                <tr>
                                    <th> Kode </th>
                                    <th> Nama Barang </th>
                                    <th> Quantity Gudang</th>
                                    <th> Quantity Mutasi</th>

                                </tr>
                            </thead>
                            <tbody id='tbody-table-data'>

                            </tbody>
                        </table>

                        <input type="hidden" name="halaman" id="halaman" value="1">
                        <input type="hidden" name="dataBarangCount" id="dataBarangCount" value="<?= $dataBarangCount ?>">
                        <div class="row">

                        </div>
                        <div class="data-barang-pagination">

                        </div>
                        <div class="pagination-result" style="margin-left:160px;margin-top:10px">

                        </div>
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

            <div class="row d-flex justify-content-start formSubmitData" id="formSubmitData">
            </div>

        </div>
    </div>
</div>

<script>
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
                console.log(data);

                for (let i = 0; i < data.length; i++) {
                    const element = data[i];
                    data_load += '<tr>'
                    data_load += '    <td><input type="hidden" value="' + element.id + '">' + element.kode + '</td>'
                    data_load += '    <td>' + element.nama_barang + '</td>'
                    data_load += '    <td>' + element.quantity_pusat + '</td>'
                    data_load += '    <td><input type="number" name="quantity" value="' + element.quantity_sobat + '" class="form-control "></td>'
                    data_load += '</tr>'

                }
                $('#tbody-table-data').html(data_load)
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
                data_load += '<li class="page-item active"><a class = "page-link" href="#" onclick="' + onclk + '">' + i + '</a></li>'
            } else if ((i == halaman - 1) && (i != 0)) {
                data_load += '<li class="page-item "><a class = "page-link" href="#" onclick="' + onclk + '">' + i + '</a></li>'
            } else if (((i > halaman) && (i < max_page)) && (i <= totalHalaman)) {
                data_load += '<li class="page-item "><a class = "page-link" href="#" onclick="' + onclk + '">' + i + '</a></li>'
            } else if ((halaman == 1) && (i > 0) && (totalHalaman >= 3)) {
                data_load += '<li class="page-item "><a class = "page-link" href="#" onclick="' + onclk + '">' + i + '</a></li>'
            } else if ((halaman == 3) && (totalHalaman >= 3) && (i == 1)) {
                data_load += '<li class="page-item "><a class = "page-link" href="#" onclick="' + onclk + '">' + i + '</a></li>'
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
            form_costume.setAttribute("id", "insert-mutasi");
            form_costume.setAttribute("method", "post");

            var po_id = document.createElement('input')
            po_id.setAttribute('type', 'hidden');
            po_id.setAttribute('name', 'id_trx_mutasi')
            po_id.setAttribute('value', '<?= $id_trx_mutasi ?>')
            form_costume.append(po_id)

            var create_date = document.createElement('input')
            create_date.setAttribute('type', 'hidden');
            create_date.setAttribute('name', 'createDate')
            create_date.setAttribute('value', '<?= $date ?>')
            form_costume.append(create_date)

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
            console.log($('#insert-mutasi').serialize());
            // $.ajax({
            //     url: '<?= base_url() ?>/inventory/inventorySaveInvMenu',
            //     data: $('#insert-inventory').serialize(),
            //     method: 'post',
            //     success: function(data) {
            //         console.log(data);
            //     },
            //     error: function(data) {
            //         console.log("Failed");
            //         console.log(data);
            //     }

            // });
            $('#formSubmitData').empty();

        }

        console.log(ar_loop);
        //location.reload();
    }
</script>