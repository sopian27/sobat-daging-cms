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

<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
    </div>
    <hr style="width: 1570px;margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    <div class="row">
        <div class="col-md-3 offset-md-1"><?= $url ?></div>
    </div>

    <div class="container-fluid" style="margin-top: 90px;">
        <div class="row justify-content-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 offset-md-2">
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label" style="margin-top: -10px;">Nomor Surat Jalan </label>
                            <div class="col-sm-4">
                                <input type="text" style="border-bottom:none" class="form-control" id="nomor_surat_jalan" name="nomor_surat_jalan" value="<?php echo ":&nbsp; " . $trxOrderDataTrx[0]->no_surat_jalan ?>">
                            </div>
                        </div>
                        <hr style="width: 530px;border-width: 2px;border-style: solid;border-color:white">
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label" style="margin-top: -10px;">Nama Pelanggan </label>

                            <div class="col-sm-4">
                                <input type="text" style="border-bottom:none" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?php echo ":&nbsp; " . ucwords($trxOrderDataTrx[0]->nama_pelanggan) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label" style="margin-top: -10px;">Nomor Hp</label>

                            <div class="col-sm-4">
                                <input type="text" style="border-bottom:none" class="form-control" id="nomor_hp" name="nomor_hp" value="<?php echo ":&nbsp; " . $trxOrderDataTrx[0]->nomor_hp1 ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label" style="margin-top: -10px;">Alamat Pengiriman </label>

                            <div class="col-sm-4">
                                <input type="text" style="border-bottom:none" class="form-control" id="alamat_pengiriman" name="alamat_pengiriman" value="<?php echo ":&nbsp; " . $trxOrderDataTrx[0]->alamat1 ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label" style="margin-top: -10px;">Tanggal Pengiriman</label>

                            <div class="col-sm-4">
                                <input type="text" style="border-bottom:none" class="form-control" id="tanggal_pengiriman" name="tanggal_pengiriman" value="<?php echo ":&nbsp; " . dateForShow($trxOrderDataTrx[0]->tgl_pengiriman) ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 50px;">
                <div class="col-md-7 offset-md-2 justify-content-center">
                    <form method="post" name="form-live-order-detail-trx" id="form-live-order-detail-trx" action="<?php echo base_url() ?>/liveorder/confirmorder">
                        <div class="row mt-2 ">
                            <table class="table table-dark table-bordered data" id="tableInv">
                                <thead>
                                    <tr class="align-middle">
                                        <th rowspan="2"> Kode </th>
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
                                    <?php for ($i = 0; $i < count($trxOrderDataTrx); $i++) { ?>
                                        <tr>
                                            <td><?php echo $trxOrderDataTrx[$i]->kode ?></td>
                                            <td><?php echo $trxOrderDataTrx[$i]->nama_barang ?></td>
                                            <td><?php echo $trxOrderDataTrx[$i]->quantity . " " . $trxOrderDataTrx[$i]->satuan ?></td>
                                            <td style="width: 180px;">
                                                <input type="text" class="form-control" name="bungkus[]" />
                                                <input type="hidden" class="form-control" name="id_po[]" value="<?php echo $trxOrderDataTrx[$i]->id_po ?>" />
                                                <input type="hidden" class="form-control" name="id_trx_order[]" value="<?php echo $trxOrderDataTrx[$i]->id_trx_order ?>" />
                                            </td>
                                            <td style="width: 300px;"><?php echo $trxOrderDataTrx[$i]->keterangan ?></td>
                                        <tr>
                                        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row d-flex justify-content-end" style="margin-top: 20px;">
                            <div class="col-md-2">
                                <button class="form-control-button btn btn-outline-light button-action" onclick="confirmData();"> Confirm </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="margin-top: 60px;"><div>
<script>
</script>