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
<div class="container-fluid mt-3" >
    <div class="container">
        <div class="row justify-content-center" style="background-color: #F4F4F4;padding:30px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 offset-md-1" style="color:black">
                        <a class="navbar-brand" href="index.html"><img class="img-responsive" src="<?php echo base_url() ?>/assets-client/images/img/Logo.png" alt="logo" width="200"></a>
                        <p style="font-size: 11px;">Ruko Green Sedayu City Block J No 78
                            <br>Cakung Timur, Jakarta Timur 17221
                            <br>No Telephone 081212121212
                            <br>No Fax. 2223283
                        </p>
                    </div>
                    <div class="col-md-5 offset-md-2" style="color:black;margin-top:60px">
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label" style="margin-top: -10px;">Kode CO </label>
                            <div class="col-sm-6">
                                <input type="text" style="border-bottom:none;color:black" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?php echo ":&nbsp; " . ucwords($data['historyOrderData'][0]['id_trx_order']) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label" style="margin-top: -10px;">Nama Pelanggan </label>
                            <div class="col-sm-6">
                                <input type="text" style="border-bottom:none;color:black" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?php echo ":&nbsp; " . ucwords($data['historyOrderData'][0]['nama_pelanggan']) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label" style="margin-top: -10px;">Nomor Hp</label>
                            <div class="col-sm-6">
                                <input type="text" style="border-bottom:none;color:black" class="form-control" id="nomor_hp" name="nomor_hp" value="<?php echo ":&nbsp; " . $data['historyOrderData'][0]['nomor_hp1'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label" style="margin-top: -10px;">Alamat Pengiriman </label>
                            <div class="col-sm-6">
                                <input type="text" style="border-bottom:none;color:black" class="form-control" id="alamat_pengiriman" name="alamat_pengiriman" value="<?php echo ":&nbsp; " . $data['historyOrderData'][0]['alamat1'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label" style="margin-top: -10px;">Tanggal Pengiriman</label>
                            <div class="col-sm-6">
                                <input type="text" style="border-bottom:none;color:black" class="form-control" id="tanggal_pengiriman" name="tanggal_pengiriman" value="<?php echo ":&nbsp; " . dateForShow($data['historyOrderData'][0]['tgl_pengiriman']) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label" style="margin-top: -10px;">Tanggal Co</label>
                            <div class="col-sm-6">
                                <input type="text" style="border-bottom:none;color:black" class="form-control" id="tanggal_pengiriman" name="tanggal_pengiriman" value="<?php echo ":&nbsp; " . dateForShow($data['historyOrderData'][0]['create_date']) ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <h2 style="color:black" class="text-center">History Order</h2>
                <hr style="width: 1570px;border-width: 1px;border-style: solid;border-color:black">
                <div class="col-md-8 offset-md-2 justify-content-center">
                    <form method="post" name="form-live-order-detail-trx" id="form-live-order-detail-trx" action="<?php echo base_url() ?>/liveorder/confirmorder">
                        <div class="row mt-2 ">
                            <table class="table table-bordered data" id="tableInv" style="  border-width:1px;border-style: solid;border-color: black;">
                                <thead>
                                    <tr class="align-middle">
                                        <th rowspan="2"> Nama Barang </th>
                                        <th rowspan="1" colspan="2"> Quantity</th>
                                        <th rowspan="2"> Note </th>
                                    </tr>
                                    <tr>
                                        <th> Quantity / Kg </th>
                                        <th> Pcs / Bungkus </th>
                                    </tr>
                                </thead>
                                <tbody id='tbody-table-data'>
                                    <?php for ($i = 0; $i < count($data['historyOrderData']); $i++) { ?>
                                        <tr>
                                            <td><?php echo ucwords($data['historyOrderData'][$i]['nama_barang']) ?></td>
                                            <td><?php echo $data['historyOrderData'][$i]['quantity'] . " " . $data['historyOrderData'][$i]['satuan'] ?></td>
                                            <td style="width: 180px;">
                                                <?php echo $data['historyOrderData'][$i]['bungkusan'] ?></td>
                                            <td style="width: 300px;"><?php echo $data['historyOrderData'][$i]['keterangan'] ?></td>
                                        <tr>
                                        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="col-sm-3 offset-md-8" style="color: black;margin-left:900px">
                    <?php echo "Jakarta, " . dateForShow($data['trxOrderDataTrx'][0]['tgl_pengiriman']) ?>
                </div>
                <div class="row">
                    <div class="col-sm-3  offset-md-2" style="color: black;margin-top:70px">
                        <p style="font-size: 20px;"><span>(<span><span style="color: #F4F4F4;">sobat daging nama</span><span>)<span></p>
                    </div>
                    <div class="col-sm-3 offset-md-4" style="color: black;margin-top:70px">
                        <p style="font-size: 20px;">( Sobat Daging )</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-end" style="margin-top: 40px;">
            <div class="col-md-2">
                <button class="form-control-button btn btn-outline-light button-action" onclick="back();"> Cancel </button>
            </div>
            <div class="col-md-2">
                <button class="form-control-button btn btn-outline-light button-action" onclick="printData();"> Print </button>
            </div>
        </div>
    </div>
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