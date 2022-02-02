<?php $data_update = $allDataPo; ?>
<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <hr style="width: 1570px;margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    <div class="row">
        <div class="col-md-3 offset-md-1"><?= $trx_lvStocks ?></div>
        <div class="col-md-2 offset-md-6 ">
            <?php
            // print_r($_POST);
            $date = date_create($tanggal);
            $tanggal =  date_format($date, "d F Y");
            echo $tanggal;
            ?>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="row">
                <div class="col-md-7 offset-md-2">
                    <form>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 ">Purchase From : </label>
                            <div class="col-sm-5">
                                <?= $supplier_name ?>
                            </div>
                        </div>
                    </form>
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
                                    <th colspan="2"> Quantity </th>
                                    <th colspan="2"> Quantity Check</th>
                                </tr>
                            </thead>
                            <tbody id='tbody-table-data'>
                                <?php
                                foreach ($data_update as $data_loop) :
                                ?>
                                    <tr>
                                        <td class="data" data-dat="id" style="display: none;"><input type="text" name="id" value="<?= $data_loop->id; ?>" class="form-control "></td>
                                        <td class="data" data-dat="kode"><input type="hidden" name="kode" value="<?= $data_loop->kode; ?>" class="form-control "><?= $data_loop->kode ?></td>
                                        <td class="data" data-dat="nama_barang"><input type="hidden" name="nama_barang" value="<?= $data_loop->nama_barang; ?>" class="form-control "><?= $data_loop->nama_barang ?></td>
                                        <td class="data" data-dat="quantity"><?= $data_loop->quantity ?></td>
                                        <td class="data" data-dat="satuan"> <?= $data_loop->satuan ?></td>

                                        <td class="data" data-dat="quantity_check"><input type="number" name="quantity_check" value="<?= $data_loop->quantity_check ?>" class="form-control "></td>
                                        <td class="data" data-dat="satuan"> <?= $data_loop->satuan ?></td>

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
            po_id.setAttribute('name', 'id_trx_lvStocks')
            po_id.setAttribute('value', '<?= $trx_lvStocks ?>')
            form_costume.append(po_id)

            var purchase_from = document.createElement('input')
            purchase_from.setAttribute('type', 'hidden');
            purchase_from.setAttribute('name', 'nama_supplier')
            purchase_from.setAttribute('value', '<?= $supplier_name ?>')
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
            console.log(ar_loop);
            arr = [];

            $('#formSubmitData').append(form_costume);
            console.log($('#insert-inventory').serialize());
            $.ajax({
                url: '<?= site_url() ?>/inventory/update-data-livestock',
                data: $('#insert-inventory').serialize(),
                method: 'post',
                success: function(data) {
                    console.log(data);
                },
                error: function(data) {
                    console.log(data);
                }

            });
            $('#formSubmitData').empty();

        }

        console.log(ar_loop);
        location.href = "<?= site_url() ?>/inventory/UnsetPOSTData/livestock";

    }


</script>