<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <hr style="width: 1570px;margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    <div class="row">
        <div class="col-md-3 offset-md-1"><?= $kode_po ?></div>
        <div class="col-md-2 offset-md-5 "><?= $date ?></div>
    </div>

    <div class="container-fluid" style="margin-top: 60px;">
        <div class="row justify-content-center">
            <form method="post" name="form-return-save" id="form-return-save">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 ">
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">Nomor Invoice </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control-label" id="no_invoice" name="no_invoice">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">Nama Pelanggan </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control-label" id="nama_pelanggan" name="nama_pelanggan">
                                    <input type="hidden" class="form-control" id="id_trx_return" name="id_trx_return" value="<?= $kode_po?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">Tanggal Pengiriman </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control-label" id="tgl_pengiriman" name="tgl_pengiriman">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 offset-md-1">
                            <div class="form-group row">
                                <label for="" class="col-sm-5 col-form-label">Tanggal Return </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-5">
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
                            <div class="col-md-2">
                                <button class="form-control-button btn btn-outline-light button-action" onclick="return confirmData();"> Confirm </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div style="margin-top:60px"></div>
</div>

<script>

    $(document).ready(function() {

        $("#mytable1").DataTable({
            "language": {
                "paginate": {
                    "previous": "<",
                    "next": ">"
                }
            },
            //searching: false, paging: false, info: false
        });

    });
    
    $(function() {
        $("#tgl_return").datepicker({
            todayHighlight: true,
            format: "yyyymmdd",
            autoclose: true
        })
    });

    $("#no_invoice").keydown(function(e) {

        if (e.keyCode == 13) {
            e.preventDefault();
            //submit_data();
            getInvoice();
        }
    });

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

        return day + " " + month +" "+year;
    }

    function getInvoice(){

        //$(document).on('keyup', '#no_invoice', function() {

            var no_invoice = document.getElementById("no_invoice").value;

            $.ajax({
                url: '<?= site_url() ?>/return-cancel/getinvoice',
                method: 'post',
                dataType: 'json',
                data: {
                    no_invoice: no_invoice
                },
                success: function(data) {

                    var dataload = "";
                    console.log(data);

                    if (data.length > 0) {

                        $("#nama_pelanggan").val(data[0].nama_pelanggan.toUpperCase());
                        $("#tgl_pengiriman").val(dateForShow(data[0].tgl_pengiriman));


                        for (i = 0; i < data.length; i++) {
                            
                            dataload += '<tr> '
                            dataload += '    <td class="data " data-dat="kode"><input type="text" name="kode[]" value="' + data[i].kode + '" class="form-control data-kode"></td> '
                            dataload += '    <td class="data" data-dat="nama_barang">'
                            dataload += '       <input type="text" name="nama_barang[]" value="' + data[i].nama_barang + '" class="form-control ">'
                            dataload += '       <input type="hidden" name="id_trx_po[]" value="' + data[i].id + '" class="form-control ">'
                            dataload += '       <input type="hidden" name="quantity_before[]" value="' + data[i].quantity + '" class="form-control ">'
                            dataload += '    </td>'
                            dataload += '    <td class="data" data-dat="quantity" ><input type="text" name="quantity[]" value="' + data[i].quantity + '" class="form-control data-quantity"></td> '
                            dataload += '    <td class="data" data-dat="satuan select-wrapper" style="width: 7%;">'
                            dataload += '      <select name="satuan[]" class="form-control">'
                            dataload += '          <option value="Kg">kg</option>'
                            dataload += '          <option value="Dus">Dus</option>'
                            dataload += '      </select>'
                            dataload += '    </td> '
                            dataload += '    <td class="data" data-dat="quantity" ><input type="text" name="quantity_return[]" class="form-control data-quantity" required></td> '
                            dataload += '    <td class="data" data-dat="satuan select-wrapper" style="width: 7%;">'
                            dataload += '      <select name="satuan_return[]" class="form-control">'
                            dataload += '          <option value="Kg">kg</option>'
                            dataload += '          <option value="Dus">Dus</option>'
                            dataload += '      </select>'
                            dataload += '    </td> '
                            dataload += '    <td class="data" data-dat="keterangan" style="width: 20%;"><input type="text" name="note[]" value="" class="form-control "></td> '
                            dataload += '</tr>'
                            
            

                        }

                        $("#tbody-table-data").html(dataload);

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

    function checkInvalid(val){
        if(val==null || val==""){
            return true;
        }

        return false;
    }


    function confirmData(){ 

        var tgl_return = $("#tgl_return").val();

        if(checkInvalid(tgl_return)) {
            alert("tanggal return tidak boleh kosong");
            return;
        }

        $("#form-return-save").attr('action', '<?php echo site_url()?>/return-cancel/save');
        $("#form-return-save").submit();
        console.log('confirm');
    }

    function clearAllData(){
        console.log('clear');
    }

</script>