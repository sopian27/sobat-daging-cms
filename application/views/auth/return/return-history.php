<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <hr style="width: 1570px;margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 offset-md-1">
                <input type="text" id="search" name="search" placeholder="search..." class="form-search">
            </div>
            <div class="col-md-2 offset-md-6">
                <input type="text" id="create_date" name="create_date" class="form-search">
            </div>
        </div>
    </div>
    <div class="container-fluid" id="return-filter">
        <div class="row">
            <div class="row" style="margin-top: 50px;">
                <div class="col-md-7 offset-md-1" >
                    <div class="row">
                        <div class="col-md-4 offset-md-6 text-center">
                            <h2 id="div-create-date"></h2>
                        </div>
                    </div>
                    <div class="row mt-2 offset-md-2">
                        <div class="collapse-content">
                        </div>
                    </div>
                    <div class="row d-flex justify-content-start formSubmitData" id="formSubmitData">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="margin-top: 60px;display:none" id="return-content">
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
                    <div class="col-md-6 offset-md-2 justify-content-center">
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
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div style="margin-top:60px"></div>
</div>
<script>

    $(function() {

        $("#create_date").datepicker({
            todayHighlight: true,
            format: "yyyymm",
            startView: "months",
            minViewMode: "months",
            autoclose: true
        })

        $("#create_date").val("sort....");
    });

    $(document).on('change', '#create_date', function() {

        var create_date = document.getElementById("create_date").value;
        //var create_date_new = convertDate(create_date);
        console.log("create_date:" + create_date);

        $.ajax({
            url: '<?= site_url() ?>/return-history/getdatabydate',
            method: 'post',
            dataType: 'json',
            data: {
                'date_choosen': create_date
            },
            success: function(data) {

                console.log(data);
                $('.collapse-content').html("");
                
                if (data.length > 0) {

                    $("#div-create-date").html(getMonthOnly(create_date));

                    var dataload = "";
                    /*
                    dataload += '<div class="container"> ';
                    dataload += '<div class="row"> '
                    dataload += '<div class="col-md-6"> ';
                    */
                    dataload += '<table> ';
                    dataload += '<thead> ';
                    
                    for (i = 0; i < data.length; i++) {
                        
                        //var id_trx_return = data[i].id_trx_return.replace(/\//g, '(+)');
                        var functionOnclick = 'getInvoiceHistory("'+data[i].id_trx_return+'","'+i+'")';
                        
                        //dataload += "<p>";
                        dataload += '<tr> ';
                        dataload += '<td> ';
                        dataload += '<a href="#" style="color:white;text-decoration:none" class="btn-action"' ;
                        dataload += "onclick="+functionOnclick+">" + data[i].tgl_return.substr(6,2)+"&nbsp;&nbsp;"+data[i].nama_pelanggan.toUpperCase() + '</a>';
                        dataload += '</td> ';
                        dataload += "</tr>"      

                    }
                    /*
                    dataload += '</div>';  
                    dataload += '</div>';
                    dataload += '</div>'; 
                    */
                    dataload += '</thead> '; 
                    dataload += '</table> ';
                    $('.collapse-content').append(dataload);

                } else {
                    $("#div-create-date").html("");
                    $('.collapse-content').html("");
                }
            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });

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

    function getInvoiceHistory(id_trx_return){

        $.ajax({
            url: '<?= site_url() ?>/return-history/getdatabydatehistory',
            method: 'post',
            dataType: 'json',
            data: {
                id_trx_return: id_trx_return
            },
            success: function(data) {

                var dataload = "";
                console.log(data);

                if (data.length > 0) {

                    $("#no_invoice").val(data[0].no_invoice);
                    $("#nama_pelanggan").val(data[0].nama_pelanggan.toUpperCase());
                    $("#tgl_pengiriman").val(dateForShow(data[0].tgl_pengiriman));
                    $("#tgl_return").val(dateForShow(data[0].tgl_return));


                    for (i = 0; i < data.length; i++) {
                        
                        dataload += '<tr> '
                        dataload += '    <td class="data " data-dat="kode"><input type="text" name="kode[]" value="' + data[i].kode + '" class="form-control data-kode"></td> '
                        dataload += '    <td class="data" data-dat="nama_barang">'
                        dataload += '       <input type="text" name="nama_barang[]" value="' + data[i].nama_barang + '" class="form-control ">'
                        dataload += '       <input type="hidden" name="id_trx_po[]" value="' + data[i].id + '" class="form-control ">'
                        dataload += '    </td>'
                        dataload += '    <td class="data" data-dat="quantity" ><input type="text" name="quantity[]" value="' + data[i].quantity_before + '" class="form-control data-quantity"></td> '
                        dataload += '    <td class="data" data-dat="satuan select-wrapper" style="width: 7%;">'
                        dataload += '      <select name="satuan[]" class="form-control">'
                        dataload += '          <option value="Kg">kg</option>'
                        dataload += '          <option value="Dus">Dus</option>'
                        dataload += '      </select>'
                        dataload += '    </td> '
                        dataload += '    <td class="data" data-dat="quantity" ><input type="text" name="quantity_return[]" value="' + data[i].quantity_return + '" class="form-control data-quantity" required></td> '
                        dataload += '    <td class="data" data-dat="satuan select-wrapper" style="width: 7%;">'
                        dataload += '      <select name="satuan_return[]" class="form-control">'
                        dataload += '          <option value="Kg">kg</option>'
                        dataload += '          <option value="Dus">Dus</option>'
                        dataload += '      </select>'
                        dataload += '    </td> '
                        dataload += '    <td class="data" data-dat="keterangan" style="width: 20%;"><input type="text" name="note[]" value="'+data[i].note+'" class="form-control "></td> '
                        dataload += '</tr>'
                        
                    }

                    $("#return-filter").hide();
                    $("#tbody-table-data").html(dataload);
                    $("#return-content").show();
                   


                } else {

                    $("#tbody-table-data").html("");
                    $("#return-content").hide();
                }

            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    
    }


    function getDetailTrx(id_trx_return,index) {

        id_trx_return = id_trx_return.replaceAll('(+)', '/');
        
    }

    function convertDate(create_date) {
        var date_split = create_date.split("/");
        var year = date_split[2];
        var month = date_split[1];
        var day = date_split[0];
        return year + month + day;
    }

    function getMonthOnly(create_date) {

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

        return month;
    }

</script>