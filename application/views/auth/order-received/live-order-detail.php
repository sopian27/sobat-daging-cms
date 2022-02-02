<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
    </div>
    <hr style="width: 1570px;margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    <div class="container-fluid">
        <div class="row">
            <div class="row" style="margin-top: 50px;">
                <div class="col-md-7 offset-md-1">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 id="div-create-date" style="text-decoration: underline;"><?php echo $createdate; ?></h4>
                        </div>
                    </div>
                    <div class="row mt-2 col-md-10">
                        <div class="container">
                            <div class="row">
                                <?php
                                $trx_order_id = "";
                                $counter = count($trxOrderData);
                                $current = 0;

                                for ($i = 0; $i < count($trxOrderData); $i++) {

                                    $counterAllow = $i + 1;
                                    $namaPelanggan = "";
                                    if ($counterAllow < $counter) {
                                        $current = $counterAllow;
                                        $namaPelanggan = $trxOrderData[$counterAllow]->nama_pelanggan;
                                    }

                                    $trx_order_id = $trxOrderData[$current]->id_trx_order;
                                ?>

                                    <div class="col-md-4" style="color:#a5662f">
                                    </div>
                                    <div class="col-md-3">
                                        <?php echo $trxOrderData[$i]->nama_barang ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?php echo $trxOrderData[$i]->quantity . " " . $trxOrderData[$i]->satuan ?>
                                    </div>

                                    <?php if ($i > 0 && $trx_order_id != $trxOrderData[$i]->id_trx_order) {
                                        
                                        $url_encrypt = str_replace("/", "_",$trxOrderData[$i]->id_trx_order); 
                                        $url=site_url()."/live-order/live-order-detailtrx/".$url_encrypt;
                                        echo "<a href='".$url."' style='color:#a5662f;text-decoration:none;'>".ucwords($trxOrderData[$i]->nama_pelanggan)."</a>";
                                    ?>
                                        <hr style="width: 600px;border-width: 2px;border-style: solid;border-color:white;margin-top:30px">

                                    <?php } if ($i > 0 && $i == $counter - 1) {
                                        
                                         $url_encrypt = str_replace("/", "_",$trxOrderData[$i]->id_trx_order); 
                                         $url=site_url()."/live-order/live-order-detailtrx/".$url_encrypt;
                                         echo "<a href='".$url."' style='color:#a5662f;text-decoration:none;'>".ucwords($trxOrderData[$i]->nama_pelanggan)."</a>";
                                    ?>
                                        <hr style="width: 600px;border-width: 2px;border-style: solid;border-color:white;margin-top:30px">

                                    <?php } ?>

                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form method="post" action="<?php echo site_url() ?>/live-order/live-order-detail" name="form-live-order" id="form-live-order">
        <input type="hidden" name="createdate" id="createdate" />
    </form>
</div>