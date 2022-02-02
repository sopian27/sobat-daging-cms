<style>
    a {
        text-decoration: none;
        color: white;
    }
    a:hover{
        color: #a5662f;
    }
</style>
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
                <form action="<?php echo site_url()?>/inventory-historypo" method="POST" id="form-live-stocks">
                    <div class="form-group row">
                        <label for="" class="col-sm-1 col-form-label">search : </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="data_search" name="data_search" placeholder="supplier">
                            <input type="hidden" class="form-control" id="id_search" name="id_search">
                            <input type="hidden" class="form-control" id="supplier_name" name="supplier_name">
                            <input type="hidden" class="form-control" id="tanggal" name="tanggal">
                            <input type="hidden" class="form-control" id="tanggal_sampai" name="tanggal_sampai">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-3 ">
                <form action="<?php echo site_url()?>/inventory-historypo" method="post" id="sort-by-date">
                    <input class="form-control" type="month" name="date_sort" id="date_sort" onclick="disableSearch();">
                </form>
            </div>
        </div>
        <?php

        if (isset($titleSearch) && $titleSearch != null || $titleSearch !== '') {

            foreach ($titleSearch as $data_loop_title) :
        ?>
                <div class="row mt-4">
                    <div class="col-md-2 offset-md-1 d-flex justify-content-center">
                        <?php if (isset($dateSort)) { ?>
                            <h5>
                                <?= $data_loop_title->nama . " " . substr($dateSort, 0, 4) ?>
                            </h5>
                        <?php } else { ?>
                            <h5>
                                <?= $data_loop_title->nama ?>
                            </h5>
                        <?php } ?>
                    </div>
                </div>
                <?php
                if (isset($allDataPo) && $allDataPo != null || $allDataPo !== '') {
                    $no = 0;
                    foreach ($allDataPo as $data_loop) :
                        $no++;
                        $id_href = "data" . $no;
                        $id_href_1 = "#data" . $no;
                        $id_href_collapse_content = "content" . $no;
                        if ($data_loop_title->nama == $data_loop->nama) {
                ?>
                            <div class="row mt-2">
                                <div class="col-md-2  offset-md-1">
                                    <?php $date = date_create($data_loop->create_date);
                                    $data_date =  date_format($date, "d F Y"); ?>
                                    <!-- <?= $data_date; ?> -->
                                    <?= $data_loop->id_trx_po ?>
                                </div>
                                <div class="col-md-3"> Purchase From
                                    <a href="#" onclick="updateData('<?= $data_loop->id_trx_po; ?>', '<?= $data_loop->nama ?>', '<?= $data_loop->create_date ?>', '<?= $data_loop->date_sampai ?>')"><?= $data_loop->nama ?></a>
                                </div>
                               
                            </div>

                        <?php
                        } else if (isset($data['dateSort'])) {
                        ?>
                            <div class="row mt-1">
                                <div class="col-md-2 offset-md-1">
                                    <?php $date = date_create($data_loop->create_date);
                                    $data_date =  date_format($date, "d"); ?>
                                    <!-- <?= $data_date; ?> -->
                                    <?= $data_loop['id_trx_po'] ?>
                                </div>
                                <div class="col-md-3"> Purchase From
                                <a href="#" onclick="updateData('<?= $data_loop->id_trx_po; ?>', '<?= $data_loop->nama ?>', '<?= $data_loop->create_date ?>', '<?= $data_loop->date_sampai ?>')"><?= $data_loop->nama ?></a>
                                </div>

                            </div>

                <?php
                        }
                    endforeach;
                }  ?>
        <?php endforeach;
        }


        ?>

    </div>
</div>
<div class="createCostumeForm">

</div>
<!-- <pre>
    <?php
    print_r($data);
    ?>
</pre> -->
<script>
    function updateData(trx_id_po, supplier_name, tanggal, tanggal_sampai) {
        $('#data_search').remove()
        $('#id_search').val(trx_id_po);
        $('#supplier_name').val(supplier_name);
        $('#tanggal').val(tanggal);
        $('#tanggal_sampai').val(tanggal_sampai);
        $('#form-live-stocks').submit();
    }


    function setLiveStocksData(params) {

        var form_costume = document.createElement("form");
        form_costume.setAttribute("id", "insert-inventory");
        form_costume.setAttribute("method", "post");
        form_costume.setAttribute("action", '<?= site_url() ?>/inventory/save');
        // createCostumeForm
    }

    function disableSearch() {
        document.getElementById("data_search").disabled = true;
    }

    var input = document.getElementById("date_sort");

    // Execute a function when the user releases a key on the keyboard
    input.addEventListener("keyup", function(event) {
        // Number 13 is the "Enter" key on the keyboard
        if (event.keyCode === 13) {
            // Cancel the default action, if needed
            event.preventDefault();
            // Trigger the button element with a click
            // alert("submit data")
            $('#sort-by-date').submit();
        }
    });
</script>