<html>
<head>
    <style>
        table,
        th,
        td {
            border: 2px solid;
            border-collapse: collapse;
            padding: 10px;
            width: 80%;
            text-align: center;
            vertical-align: middle;
        }

        div.center {
            text-align: center;
        }

        div.left {
            text-align: left;
        }

        div.right {
            text-align: right;
        }

        div.justify {
            text-align: justify;
        }

        .center {
            margin-left: auto;
            margin-right: auto;
        }

        .offset {
            margin-left: 65%;
            margin-top: 20px
        }

        .offset-top {
            margin-top: 30px;
        }

        .col-md-6 {
            width: 50%;
            height: 100px;
            display: inline-block;
        }

        .Row {
            display: table;
            width: 100%;
            /*Optional*/
            table-layout: fixed;
            /*Optional*/
            border-spacing: 10px;
            /*Optional*/
        }

        .Column {
            display: table-cell;
            /*Optional*/
        }

        .col-25 {
            float: left;
            width: 25%;
        }

        .col-50 {
            float: left;
            width: 40%;
        }

        .col-75 {
            float: left;
            width: 75%;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
            margin-top: 0px;
        }

        /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {

            .col-25,
            .col-75,
            input[type=submit] {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div>
        <div class="Row">
            <div class="Column">
                <img width="170" src="<?= base_url()?>/assets/client/images/img/Logo.png"/>
                <p>
                    Ruko Green Sedayu City, Blok J No 78 <br>
                    Cakung Timur, Jakarta Timur 17221 <br>
                    No Telepon. 081212121212 <br>
                    No Fax. 021 2223283
                </p>
                <div class="row offset-top">
                    <div class="col-50">
                        <label for="fname">No Surat Jalan</label>
                    </div>
                    <div class="col-75">
                        <label for="fname">&nbsp;&nbsp;:&nbsp;&nbsp; <?= $data[0]->no_surat_jalan ?></label>
                    </div>
                </div>
            </div>
            <div class="Column"></div>
            <div class="Column">
                <div class="row offset-top">
                    <div class="col-50">
                        <label for="fname">Nama Pelanggan</label>
                    </div>
                    <div class="col-75">
                        <label for="fname">&nbsp;&nbsp;:&nbsp;&nbsp; <?= $data[0]->nama_pelanggan ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-50">
                        <label for="fname">Nomor Hp</label>
                    </div>
                    <div class="col-75">
                        <label for="fname">&nbsp;&nbsp;:&nbsp;&nbsp; <?= $data[0]->nomor ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-50">
                        <label for="fname">Alamat Pengiriman</label>
                    </div>
                    <div class="col-75">
                        <label for="fname">&nbsp;&nbsp;:&nbsp;&nbsp; <?= $data[0]->alamat ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-50">
                        <label for="fname">Tanggal Pengiriman</label>
                    </div>
                    <div class="col-75">
                        <label for="fname">&nbsp;&nbsp;:&nbsp;&nbsp; <?= dateForShow($data[0]->tgl_pengiriman); ?></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="center">
            <h2>Surat Jalan</h2>
        </div>
        <hr>
        <table class="center">
            <thead>
                <tr>
                    <th rowspan="2"> Nama Barang </th>
                    <th rowspan="1" colspan="2"> Quantity</th>
                    <th rowspan="2"> Note </th>
                </tr>
                <tr>
                    <th> Quantity / Kg </th>
                    <th> Pcs / Bungkus </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $d) { ?>
                    <tr>
                        <td><?= $d->note_nama_barang; ?></td>
                        <td><?= $d->quantity; ?></td>
                        <td><?= $d->bungkusan; ?></td>
                        <td><?= $d->note; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="center offset">
        <?= $date; ?>
    </div>
    <div class="Row offset-top">
        <div class="Column offset">
            <h3>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</h3>
        </div>
        <div class="Column">

        </div>
        <div class="Column center offset">
            <h3>( Sobat Daging )</h3>
        </div>
    </div>
</body>

</html>
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