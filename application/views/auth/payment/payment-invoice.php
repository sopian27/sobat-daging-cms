<?php 

function dateForShow($create_date) {
    $year = substr($create_date,0,4);
    $month = substr($create_date,4,2);
    $day = substr($create_date,6,2);

    if ($month == "01") {
        $month = "Januari";
    } else if ($month == "02") {
        $month = "Februari";
    } else if ($month == "03") {
        $month = "Maret";
    } else if ($month == "04") {
        $month = "April";
    } else if ($month == "05") {
        $month = "Mei";
    } else if ($month == "06") {
        $month = "Juni";
    } else if ($month == "07") {
        $month = "Juli";
    } else if ($month == "08") {
        $month = "Agustus";
    } else if ($month == "09") {
        $month = "September";
    } else if ($month == "10") {
        $month = "Oktober";
    } else if ($month == "11") {
        $month = "November";
    } else if ($month == "12") {
        $month = "Desember";
    }

    return $day." ".$month." ".$year;
}

?>


<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <hr style="width: 1570px;margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    <div class="row">
        <div class="col-md-3 offset-md-9 "><?= $date ?></div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center" id="form-invoice-customer">
            <div class="container">
                <form method="post" name="form-invoice-customer-data" id="form-invoice-customer-data">
                    <div class="row">
                        <div class="col-md-2 offset-md-1">
                            <div>
                                <a class="form-control-button btn" style="background-color: #a5662f;border:none;padding:10px"> Invoice Costumer </a>
                            </div>
                            <div style="margin-top:30px">
                                <a class="form-control-button btn btn-outline-light button-action" style="padding:10px" onclick="showInvoicePembelian();"> Invoice Pembelian </a>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label"><?= $no_invoice_co ?></label>
                            </div>
                            <div class="form-group row" style="margin-top:30px">
                                <label for="" class="col-sm-3 col-form-label">Nomor Surat Jalan </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control-label" id="no_surat_jalan" name="no_surat_jalan">
                                    <input type="hidden" class="form-control" id="no_invoice_co" name="no_invoice_co">
                                    <input type="hidden" class="form-control" id="id_trx_payment_value" name="id_trx_payment" value="<?php echo $no_invoice_co?>">
                                    <input type="hidden" class="form-control" id="total_tagihan_value" name="total_tagihan">
                                </div>
                            </div>
                            <div class="div_no_surat_jln" style="display:none">
                                <hr style="border-width: 2px;border-style: solid;border-color:white" class="col-md-8">
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Nomor Invoice </label>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-4">
                                        <label for="" class="col-form-label" id="nomor_invoice"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Nama Pelanggan </label>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-4">
                                        <label for="" class="col-form-label" id="nama_pelanggan"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label" >Nomor Hp </label>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-4">
                                        <label for="" class="col-form-label" id="no_hp"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label" >Alamat Pengiriman </label>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-4">
                                        <label for="" class="col-form-label" id="alamat_pengiriman"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Tanggal Pengiriman </label>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-4">
                                        <label for="" class="col-form-label" id="tgl_pengiriman"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Total Tagihan </label>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-4">
                                        <label for="" class="col-form-label" id="total_tagihan"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Bonus </label>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-4">
                                        <input type="text" name="bonus" id="bonus" class="form-control-label">
                                    </div>
                                    <div class="col-sm-1"><span class="fa fa-pencil"><span></div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Jatuh Tempo </label>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-4">
                                        <input type="text" name="jatuh_tempo" id="jatuh_tempo_no_surat_jln" class="form-control-label">
                                    </div>
                                    <div class="col-sm-1"><span class="fa fa-pencil"><span></div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Bank Tujuan </label>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-4">
                                        <input type="text" name="bank_tujuan" id="bank_tujuan" class="form-control-label" />
                                    </div>
                                    <div class="col-sm-1"><span class="fa fa-pencil"><span></div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">No. Rekening </label>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-4">
                                        <input type="text" name="no_rekening" id="no_rekening" class="form-control-label" />
                                    </div>
                                    <div class="col-sm-1"><span class="fa fa-pencil"><span></div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Atas Nama </label>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-4">
                                        <input type="text" name="atas_nama" id="atas_nama" class="form-control-label" />
                                    </div>
                                    <div class="col-sm-1"><span class="fa fa-pencil"><span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="div_no_surat_jln" style="display:none">
                        <div class="row" style="margin-top: 50px;">
                            <div class="col-md-7 offset-md-2 justify-content-center">
                                <div class="row mt-2 ">
                                    <table class="table table-dark table-bordered data" id="tableInv">
                                        <thead>
                                            <tr class="align-middle">
                                                <th rowspan="2"> Kode </th>
                                                <th rowspan="2"> Nama Barang </th>
                                                <th rowspan="1" colspan="2"> Quantity</th>
                                                <th rowspan="2"> Harga Satuan </th>
                                                <th rowspan="2"> Harga Total </th>
                                            </tr>
                                            <tr>
                                                <th> Quantity / Kg </th>
                                                <th> Pcs / Bungkus </th>
                                            </tr>
                                        </thead>
                                        <tbody id='tbody-table-data-no_surat_jln'></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex offset-md-7" style="margin-top: 30px;">
                            <div class="col-md-2">
                                <button class="form-control-button btn btn-outline-light button-action"> Clear All </button>
                            </div>
                            <div class="col-md-2">
                                <button class="form-control-button btn btn-outline-light button-action" onclick="return confirmDataCo();"> Confirm </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row justify-content-center" style="display: none;" id="form-invoice-pembelian">
            <div class="container">
                <form method="post" name="form-invoice-pembelian-data" id="form-invoice-pembelian-data">
                    <div class="row">
                        <div class="col-md-2 offset-md-1">
                            <div>
                                <a class="form-control-button btn btn-outline-light button-action" onclick="showInvoiceCustomer();"> Invoice Costumer </a>
                            </div>
                            <div style="margin-top:30px">
                                <a class="form-control-button btn" style="background-color: #a5662f;border:none;padding:10px"> Invoice Pembelian </a>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label"><?= $no_invoice_co_po ?> </label>
                            </div>
                            <div class="form-group row" style="margin-top:30px">
                                <label for="" class="col-sm-3 col-form-label">Kode Po </label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control-label" id="kode_po" name="kode_po">
                                    <input type="hidden" class="form-control" id="no_invoice_co_po" name="no_invoice_co_po" value="<?=$no_invoice_co_po ?>">
                                    <input type="hidden" class="form-control" id="total_tagihan_value_po" name="total_tagihan">
                                    <input type="hidden" class="form-control" id="no_invoice_kode_po" name="no_invoice">
                                </div>
                            </div>
                            <div class="div_kode_po" style="display:none">
                                <hr style="border-width: 2px;border-style: solid;border-color:white" class="col-md-8">
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Pembelian dari </label>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-4">
                                        <label for="" class=" col-form-label" id="pembelian_dari"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Tanggal Pembelian </label>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-4">
                                        <label for="" class=" col-form-label" id="tgl_pembelian"> </label>
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-top:10px">
                                    <label for="" class="col-sm-3 col-form-label">Jatuh Tempo </label>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-4">
                                        <input type="text" name="jatuh_tempo" id="jatuh_tempo_kode_po" class="form-control-label">
                                    </div>
                                    <div class="col-sm-1"><span class="fa fa-pencil"><span></div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Total Tagihan </label>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-4">
                                        <label for="" class=" col-form-label" id="total_tagihan_kode_po"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="div_kode_po" style="display:none">
                        <div class="row" style="margin-top: 50px;">
                            <div class="col-md-7 offset-md-2 justify-content-center">
                                <div class="row mt-2 ">
                                    <table class="table table-dark table-bordered data" id="tableInv">
                                        <thead>
                                            <tr class="align-middle">
                                                <th rowspan="2"> Kode </th>
                                                <th rowspan="2"> Nama Barang </th>
                                                <th rowspan="1" colspan="2"> Quantity</th>
                                                <th rowspan="2"> Harga Satuan </th>
                                                <th rowspan="2"> Harga Total </th>
                                            </tr>
                                            <tr>
                                                <th> Quantity / Po </th>
                                                <th> Quantity / Update </th>
                                            </tr>
                                        </thead>
                                        <tbody id='tbody-table-data_kode_po'></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex offset-md-7" style="margin-top: 100px;">
                            <div class="col-md-2">
                                <button class="form-control-button btn btn-outline-light button-action"> Clear All </button>
                            </div>
                            <div class="col-md-2">
                                <button class="form-control-button btn btn-outline-light button-action" onclick="confirmDataPo();"> Confirm </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div style="margin-top:60px"></div>
</div>

<script>

    $(document).ready(function() {

        $("#nominal_pembayaran").autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });
        
        $("#bonus").autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });

    });

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function hideDataSuratJln(){
        $(".div_no_surat_jln").hide();
    }

    function hideDataKodePo(){
        $(".div_kode_po").hide();
    }

    function showDataSuratJln(){
        $(".div_no_surat_jln").show();
    }

    function showDataKodePo(){
        $(".div_kode_po").show();
    }

    function showInvoicePembelian() {
        $("#form-invoice-customer").hide();
        $("#form-invoice-pembelian").show();
    }

    function showInvoiceCustomer() {
        $("#form-invoice-customer").show();
        $("#form-invoice-pembelian").hide();
    }

    function confirmDataPo() {
 
        var jatuh_tempo = $("#jatuh_tempo_kode_po").val();

        if(checkInvalid(jatuh_tempo)){
             alert("jatuh tempo tidak boleh kosong");
             return false;
        }

        $("#form-invoice-pembelian-data").attr('action', '<?php echo site_url()?>/payment-invoice-pembelian/save');
        $("#form-invoice-pembelian-data").submit();
    }

    function confirmDataCo() {

        var bonus = $("#bonus").val();
        var jatuh_tempo = $("#jatuh_tempo_no_surat_jln").val();
        var bank_tujuan = $("#bank_tujuan").val();
        var no_rekening = $("#no_rekening").val();
        var atas_nama = $("#atas_nama").val();

        if(checkInvalid(bonus)) {
            alert("bonus tidak boleh kosong");
            return false;
        }

        if(checkInvalid(jatuh_tempo)){
             alert("jatuh tempo tidak boleh kosong");
             return false;
        }

        if(checkInvalid(bank_tujuan)){ 
            alert("bank tujuan tidak boleh kosong");
            return false;
        }

        if(checkInvalid(no_rekening)){ 
            alert("no rekening tidak boleh kosong");
            return false;
        }

        if(checkInvalid(atas_nama)){ 
            alert("atas nama tidak boleh kosong");
            return false;
        }

        $("#form-invoice-customer-data").attr('action', '<?php echo site_url()?>/payment-invoice-customer/save');
        $("#form-invoice-customer-data").submit();
    }

    function checkInvalid(val){
        if(val==null || val==""){
            return true;
        }

        return false;
    }

    $(function() {
        $("#jatuh_tempo_no_surat_jln").datepicker({
            format: "yyyymmdd",
            todayHighlight: true,
            autoclose: true
        });

        $("#jatuh_tempo_kode_po").datepicker({
            format: "yyyymmdd",
            todayHighlight: true,
            autoclose: true
        });
    });

    $("#no_surat_jalan").keydown(function(e) {

        if (e.keyCode == 13) {
            e.preventDefault();
            getNoSuratJalan();
            //console.log($("#no_surat_jalan").val());
        }
    });

    $("#kode_po").keydown(function(e) {

        if (e.keyCode == 13) {
            e.preventDefault();
            getKodePo();
            //confirmDataPo();
             //console.log($("#no_surat_jalan").val());
        }
    });

    function getNoSuratJalan() {

        var no_surat_jalan = $("#no_surat_jalan").val();

        $.ajax({
            url: '<?= site_url() ?>/payment-invoice/getnosuratjalan',
            method: 'post',
            dataType: 'json',
            data: {
                no_surat_jalan: no_surat_jalan
            },
            success: function(data) {

                var dataLoad="";

                if(data.data_surat_jln.length > 0){

                    $("#no_surat_jalan").val(no_surat_jalan);
                    $("#nomor_invoice").html(data.data_surat_jln[0].no_invoice);
                    $("#nama_pelanggan").html(data.data_surat_jln[0].nama_pelanggan.toUpperCase());
                    $("#no_hp").html(data.data_surat_jln[0].nomor_hp1);
                    $("#alamat_pengiriman").html(data.data_surat_jln[0].alamat1);
                    $("#tgl_pengiriman").html(dateForShow(data.data_surat_jln[0].tgl_pengiriman));
                    $("#total_tagihan").html("Rp. "+numberWithCommas(data.sum_total[0].total));
                    $("#total_tagihan_value").html(data.sum_total[0].total);

                    for(let i=0;i<data.data_surat_jln.length;i++){

                        var result = parseFloat(data.data_surat_jln[i].harga_satuan) * parseFloat(data.data_surat_jln[i].quantity);

                        dataLoad += "<tr>";
                        dataLoad += "<td >";
                        dataLoad += data.data_surat_jln[i].kode;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += data.data_surat_jln[i].nama_barang;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += data.data_surat_jln[i].quantity + " "+ data.data_surat_jln[i].satuan;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += data.data_surat_jln[i].bungkusan;
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += "Rp. " + numberWithCommas(data.data_surat_jln[i].harga_satuan);
                        dataLoad += "</td>";
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += "Rp. " + numberWithCommas(result);
                        dataLoad += "</td>";
                        dataLoad += "</td>";
                        dataLoad += "</tr>";
                    }
                    
                    $("#tbody-table-data-no_surat_jln").html(dataLoad);
                    showDataSuratJln();

                }else{

                    hideDataSuratJln();
                }
            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });

    }

    function getKodePo() {

        var kode_po = $("#kode_po").val();

        $.ajax({
            url: '<?= site_url() ?>/payment-invoice-pembelian/getkodepo',
            method: 'post',
            dataType: 'json',
            data: {
                kode_po: kode_po
            },
            success: function(data) {

                var dataLoad="";
                console.log(data);
                
                if(data.data_kode_po.length > 0){

                    $("#pembelian_dari").html(data.data_kode_po[0].nama);
                    $("#tgl_pembelian").html(dateForShow(data.data_kode_po[0].create_date));
                    $("#total_tagihan_kode_po").html("Rp. "+numberWithCommas(data.sum_total[0].total));
                    $("#total_tagihan_value_po").val(data.sum_total[0].total);
                    $("#no_invoice_kode_po").val(data.data_kode_po[0].no_invoice);

                    for(let i=0;i<data.data_kode_po.length;i++){

                        var result = parseFloat(data.data_kode_po[i].harga_satuan) * parseFloat(data.data_kode_po[i].quantity_check);

                        dataLoad += "<tr>";
                        dataLoad += "<td >";
                        dataLoad += data.data_kode_po[i].kode;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += data.data_kode_po[i].nama_barang;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += data.data_kode_po[i].quantity + " "+ data.data_kode_po[i].satuan;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += data.data_kode_po[i].quantity_check+ " "+ data.data_kode_po[i].satuan;
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += "Rp. " + numberWithCommas(data.data_kode_po[i].harga_satuan);
                        dataLoad += "</td>";
                        dataLoad += "</td>";
                        dataLoad += "<td>";
                        dataLoad += "Rp. " + numberWithCommas(result);
                        dataLoad += "</td>";
                        dataLoad += "</td>";
                        dataLoad += "</tr>";
                    }
                    
                    $("#tbody-table-data_kode_po").html(dataLoad);
                    
                    showDataKodePo();

                }else{

                    hideDataKodePo();
                }
                
            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
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

        return day + " " + month +" "+year;
    }
</script>