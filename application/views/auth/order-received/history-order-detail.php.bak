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
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <hr style="width: 1570px;margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    <div class="container-fluid" style="margin-top: 50px;">
        <div class="row justify-content-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 offset-md-1">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Kode CO </label>
                            <div class="col-sm-4">
                                <label for="" class=" col-form-label"><?php echo ": &nbsp;" . $historyOrderData[0]->id_trx_order ?> </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Nama Pelanggan </label>
                            <div class="col-sm-4">
                                <label for="" class=" col-form-label"><?php echo ": &nbsp;" . ucwords($historyOrderData[0]->nama_pelanggan) ?></label>
                            </div>
                        </div>
                        <div class="form-group row" style="margin-top: 10px;">
                            <label for="" class="col-sm-3 col-form-label">Nomor Hp </label>
                            <div class="col-sm-4">
                                <label for="" class=" col-form-label"><?php echo ": &nbsp;" . $historyOrderData[0]->nomor_hp1 ?></label>
                            </div>
                        </div>
                        <div class="form-group row" style="margin-top: 10px;">
                            <label for="" class="col-sm-3 col-form-label">Alamat Pengiriman </label>
                            <div class="col-sm-4">
                                <label for="" class=" col-form-label"><?php echo ": &nbsp;" . $historyOrderData[0]->alamat1 ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-1" style="margin-left:-160px">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Tanggal CO </label>
                            <div class="col-sm-4">
                                <label for="" class=" col-form-label">
                                    <?php echo ": &nbsp;" . dateForShow($historyOrderData[0]->create_date) ?></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Tanggal Pengiriman </label>
                            <div class="col-sm-4">
                                <label for="" class=" col-form-label">
                                    <?php echo ": &nbsp;" . dateForShow($historyOrderData[0]->tgl_pengiriman) ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 50px;">
                <div class="col-md-7 offset-md-1 justify-content-center">
                    <form method="post" name="form-live-order-detail-trx" id="form-live-order-detail-trx" action="<?php echo site_url() ?>/live-order/confirmorder">
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
                                    <?php for ($i = 0; $i < count($historyOrderData); $i++) { ?>
                                        <tr>
                                            <td><?php echo $historyOrderData[$i]->kode ?></td>
                                            <td><?php echo $historyOrderData[$i]->nama_barang ?></td>
                                            <td><?php echo $historyOrderData[$i]->quantity . " " . $historyOrderData[$i]->satuan ?></td>
                                            <td style="width: 180px;"><?php echo $historyOrderData[$i]->bungkusan ?></td>
                                            <td style="width: 300px;"><?php echo $historyOrderData[$i]->keterangan ?></td>
                                        <tr>
                                        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                    <div class="row d-flex justify-content-end" style="margin-top: 40px;">
                        <div class="col-md-2">
                            <button class="form-control-button btn btn-outline-light button-action" onclick="back();"> Back </button>
                        </div>
                        <div class="col-md-2">
                            <a class="form-control-button btn btn-outline-light button-action" href="<?php echo site_url().'/history-order/print-detail/'.str_replace("/","_",$historyOrderData[0]->id_trx_order);?>">Print</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top: 60px;"></div>
</div>
<script>
    function back(){
         location.href = "<?= site_url() ?>/history-order";
    }

    function print(){
        console.log("print");
    }
</script>