<?php

function dateForShow($create_date)
{
    $year = substr($create_date, 0, 4);
    $month = substr($create_date, 4, 2);
    $day = substr($create_date, 6, 2);

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

    return $day . " " . $month . " " . $year;
}

?>
<div class="container mt-3">
    <form method="POST" action="<?php echo site_url()?>/payment-invoice-customer-print"  target="_blank">
        <div class="container">
            <div class="row justify-content-center" style="background-color: #F4F4F4;padding:30px;">
                <div class="container">
                                    
                    <div style="text-align:right;color:black;margin-right:100px">
                        <label for="" class="col-sm-5 col-form-label" style="margin-top: -10px;"><?php echo dateForShow($date) ?></label>
                    </div>

                    <div class="row">
                        <div class="col-md-4 offset-md-1" style="color:black">
                            <a class="navbar-brand" href="index.html"><img class="img-responsive" src="<?php echo base_url() ?>/assets/client/images/img/Logo.png" alt="logo" width="200"></a>
                            <p style="font-size: 11px;">Ruko Green Sedayu City Block J No 78
                                <br>Cakung Timur, Jakarta Timur 17221
                                <br>No Telephone 081212121212
                                <br>No Fax. 2223283
                            </p>
                        </div>

                        <div class="col-md-5 offset-md-2" style="color:black;margin-top:60px">
                                            
                            <div class="form-group row">
                                <label for="" class="col-sm-5 col-form-label" style="margin-top: -10px;">Nama Pelanggan </label>
                                <div class="col-sm-6">
                                    <input type="text" style="border-bottom:none;color:black" class="form-control" value="<?php echo ":&nbsp; " . ucwords($historyOrderData[0]->nama_pelanggan) ?>">
                                    <input type="hidden" value="<?php echo $historyOrderData[0]->no_surat_jalan ?>" name="no_surat_jalan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-5 col-form-label" style="margin-top: -10px;">Alamat Pengiriman</label>
                                <div class="col-sm-6">
                                    <input type="text" style="border-bottom:none;color:black" class="form-control" value="<?php echo ":&nbsp; " . ucwords($historyOrderData[0]->alamat) ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-5 col-form-label" style="margin-top: -10px;">Nomor Hp</label>
                                <div class="col-sm-6">
                                    <input type="text" style="border-bottom:none;color:black" class="form-control" value="<?php echo ":&nbsp; " . $historyOrderData[0]->nomor_hp1 ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-5 col-form-label" style="margin-top: -10px;">Tanggal Pengiriman</label>
                                <div class="col-sm-6">
                                    <input type="text" style="border-bottom:none;color:black" class="form-control" value="<?php echo ":&nbsp; " . dateForShow($historyOrderData[0]->tgl_pengiriman) ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-5 col-form-label" style="margin-top: -10px;">Tanggal Jatuh Tempo</label>
                                <div class="col-sm-6">
                                    <input type="text" style="border-bottom:none;color:black" class="form-control" value="<?php echo ":&nbsp; " . dateForShow($historyOrderData[0]->jatuh_tempo) ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-5 col-form-label" style="margin-top: -10px;">Payment Term</label>
                                <div class="col-sm-6">
                                    <input type="text" style="border-bottom:none;color:black" class="form-control" value="<?php echo ":&nbsp; Cash/Tunai";  ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-3 offset-md-2" style="color:black;font-size:11px">
                        <p>Nomor Invoice <?php echo ": " . $historyOrderData[0]->no_invoice ?></p>
                        <p>Surat Jalan <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: " .$historyOrderData[0]->no_surat_jalan ?> </p>
                    </div>
                    <div class="col-md-4 offset-md-1" style="color:black;border-style:dashed;padding:5px;">
                        <h4 style="text-align: center;"><?php echo "BANK " . strtoupper($historyOrderData[0]->bank_tujuan) . "- " .
                                                            strtoupper($historyOrderData[0]->atas_nama) . "<br> A/N " . strtoupper($historyOrderData[0]->no_rekening); ?></h4>
                    </div>

                    <div class="col-md-8 offset-md-2 justify-content-center" style="margin-top:20px">
                        <div class="row mt-2">
                            <table class="table table-bordered data" id="tableInv" style="border-width:1px;border-style: solid;border-color: black;">
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
                                <tbody id='tbody-table-data'>
                                    <?php for ($i = 0; $i < count($historyOrderData); $i++) { ?>
                                        <tr>
                                            <td><?php echo ucwords($historyOrderData[$i]->kode) ?></td>
                                            <td><?php echo ucwords($historyOrderData[$i]->nama_barang) ?></td>
                                            <td><?php echo $historyOrderData[$i]->quantity. " " . $historyOrderData[$i]->satuan ?></td>
                                            <td style="width: 180px;">
                                                <?php echo $historyOrderData[$i]->bungkusan ?>
                                            </td>
                                            <td><?php echo "Rp. ".number_format($historyOrderData[$i]->harga_satuan,0) ?></td>
                                            <td><?php echo "Rp. ".number_format($historyOrderData[$i]->harga_total,0) ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-sm-3 offset-md-8" style="color: black;margin-left:860px;margin-top:30px">
                        <table>
                            <tr>
                                <td>Grand Total</td>
                                <td>: Rp. <?php echo $sumTotal[0]->total ?></td>
                            </tr>
                            <tr>
                                <td>Discount</td>
                                <td>: Rp. <?php echo number_format($historyOrderData[0]->bonus,0) ?></td>
                            </tr>
                        </table>
                        <hr style="width: 160px;border-width: 2px;border-style: solid;border-color:black">
                        <table>
                            <tr >
                                <td>Total</td>
                                <td>: Rp. <?php echo number_format(floatval($sumTotal[0]->total) - floatval($historyOrderData[0]->bonus),0) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex offset-md-9" style="margin-top: 30px;">
            <div class="col-md-4">
                <button class="form-control-button btn btn-outline-light button-action" onclick="clearAllData();"> Cancel </button>
            </div>
            <div class="col-md-4">
                <button class="form-control-button btn btn-outline-light button-action" type="submit"> Print </button>
            </div>
        </div>
    </form>
    <div style="margin-top: 60px;"></div>
</div>

<script>
    function back() {
        location.href = "<?= base_url() ?>/historyorder";
    }

    function print() {
        console.log("print");
    }
</script>