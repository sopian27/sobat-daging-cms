<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
</div>
<hr>
<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="row mb-3">
            <div class="col-md-6 offset-md-1">
                <form action="<?php echo site_url()?>/inventory-updatepo" method="POST" id="form-update">
                    <div class="form-group row">
                        <label for="" class="col-sm-1 col-form-label">search : </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="data_search" name="data_search" placeholder="supplier">
                            <input type="hidden" class="form-control" id="id_search" name="id_search">
                            <input type="hidden" class="form-control" id="supplier_name" name="supplier_name">
                            <input type="hidden" class="form-control" id="tanggal" name="tanggal">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php foreach ($allDataPo as $data_loop) : ?>
            <div class="row">
                <div class="col-md-3 offset-md-1"> Purchase From <a href="#" onclick="updateData('<?= $data_loop->id_trx_po; ?>', '<?= $data_loop->nama ?>', '<?= $data_loop->create_date ?>')"><?= $data_loop->nama ?></a></div>
                <div class="col-md-2">
                    <?php $date = date_create($data_loop->create_date);
                    $data_loop->create_date =  date_format($date, "d F Y"); ?>
                    <?= $data_loop->create_date; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script>
    function updateData(trx_id_po, supplier_name, tanggal) {
        $('#data_search').remove()
        $('#id_search').val(trx_id_po);
        $('#supplier_name').val(supplier_name);
        $('#tanggal').val(tanggal);
        $('#form-update').submit();
    }
</script>