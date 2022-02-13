<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    MASUK DATA
    <pre>
        <?php
        print_r($data);
        ?>

<!-- [id] => 1
    [kode] => PO-A001
    [quantity] => 0
    [quantity_update] => 10
    [note] => TESTING
    [gudang] => sobat
    [trx] => IUS-0002/20/01/2022
    [halaman] => 1
    </pre>

    $data['ketGudang'] = (isset($_POST['gudang'])) ? $_POST['gudang'] : 'pusat';
    $data['halaman'] -->
    <form action="<?= base_url() ?>/inventory/updatestockpts" method="post" id="fomsubmit">
        <input type="hidden" name="halaman" id="halaman" value="<?= $data['halaman'] ?>">
        <input type="hidden" name="gudang" id="gudang" value="<?= $data['gudang'] ?>">
    </form>
</body>
<script>
    $(document).ready(function() {

        $("#fomsubmit").submit();
    });
</script>

</html>