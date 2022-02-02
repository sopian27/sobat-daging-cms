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
<style>
th, td {
  padding: 5px;
}
th {
  text-align: left;
}

table, th, td {
  
}

.wrapper {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 10px;
  grid-auto-rows: minmax(100px, auto);
}
.one {
  grid-column: 1 / 3;
  grid-row: 1;
}
.two {
  grid-column: 2 / 4;
  grid-row: 1 / 3;
}
.three {
  grid-column: 1;
  grid-row: 2 / 5;
}
.four {
  grid-column: 3;
  grid-row: 3;
}
.five {
  grid-column: 2;
  grid-row: 4;
}
.six {
  grid-column: 3;
  grid-row: 4;
}


</style>
<div style="padding:30px;">       
    <div style="text-align:right;color:black;margin-right:100px">
        <label style="margin-top: -10px;"><?php echo dateForShow($date) ?></label>
    </div>
    <div style="color:black">
        <a href="index.html"><img src="<?php echo base_url() ?>/assets/client/images/img/Logo.png" alt="logo" width="200"></a>
        <p style="font-size: 11px;">Ruko Green Sedayu City Block J No 78
            <br>Cakung Timur, Jakarta Timur 17221
            <br>No Telephone 081212121212
            <br>No Fax. 2223283
        </p>
    </div>
    <div style="color:black;margin-top:30px;text-align:left;margin-left:50%">
        <table>
            <tr>
                <th>Nama Pelanggan</th>
                <th>:</th>
                <th><?= ucwords($historyOrderData[0]->nama_pelanggan)?></th>
            </tr>
            <tr>
                <th>Alamat Pengiriman</th>
                <th>:</th>
                <th><?= ucwords($historyOrderData[0]->alamat)?></th>
            </tr>
            <tr>
                <th>Nomor Hp</th>
                <th>:</th>
                <th><?= $historyOrderData[0]->nomor_hp1?></th>
            </tr>
            <tr>
                <th>Tanggal Pengiriman</th>
                <th>:</th>
                <th><?= dateForShow($historyOrderData[0]->tgl_pengiriman)?></th>
            </tr>
            <tr>
                <th>Tanggal Jatuh Tempo</th>
                <th>:</th>
                <th><?= dateForShow($historyOrderData[0]->jatuh_tempo)?></th>
            </tr>
            <tr>
                <th>Payment Term</th>
                <th>:</th>
                <th><?= 'Cash/Tunai'?></th>
            </tr>
        </table>           
    </div>
    <div style="margin-top: 20px;">
        <div >
            <div >
                <div style="color:black;font-size:11px">
                    <p >Nomor Invoice <?php echo ": " . $historyOrderData[0]->no_invoice ?></p>
                    <p>Surat Jalan <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: " .$historyOrderData[0]->no_surat_jalan ?> </p>
                </div>
            </div>
            <div >
                <div style="color:black;border-style:dashed;padding:5px;width:50%;margin-left:46%">
                    <h4 style="text-align: center;"><?php echo "BANK " . strtoupper($historyOrderData[0]->bank_tujuan) . "- " .
                                                        strtoupper($historyOrderData[0]->atas_nama) . "<br> A/N " . strtoupper($historyOrderData[0]->no_rekening); ?></h4>
                </div>
            </div>
        </div>
        <table class="table-border" style="margin-top:30px;border: 1px solid black;border-collapse: collapse;text-align:center;" >
            <thead >
                <tr >
                    <th rowspan="2" style="border: 1px solid black;border-collapse: collapse;text-align:center;"> Kode </th>
                    <th rowspan="2" style="border: 1px solid black;border-collapse: collapse;text-align:center;"> Nama Barang </th>
                    <th colspan="2" style="border: 1px solid black;border-collapse: collapse;text-align:center;"> Quantity</th>
                    <th rowspan="2" style="border: 1px solid black;border-collapse: collapse;text-align:center;"> Harga Satuan </th>
                    <th rowspan="2" style="border: 1px solid black;border-collapse: collapse;text-align:center;"> Harga Total </th>
                </tr>
                <tr >    
                    <th> Quantity/Kg </th>            
                    <th> Bungkusan/Pcs </th>            
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($historyOrderData); $i++) { ?>
                    <tr >
                        <td style="border: 1px solid black;border-collapse: collapse;text-align:center;"> <?php echo ucwords($historyOrderData[$i]->kode) ?></td>
                        <td style="border: 1px solid black;border-collapse: collapse;text-align:center;"><?php echo ucwords($historyOrderData[$i]->nama_barang) ?></td>
                        <td style="border: 1px solid black;border-collapse: collapse;text-align:center;"><?php echo $historyOrderData[$i]->quantity. " " . $historyOrderData[$i]->satuan ?></td>
                        <td style="border: 1px solid black;border-collapse: collapse;text-align:center;">
                            <?php echo $historyOrderData[$i]->bungkusan ?>
                        </td>
                        <td style="border: 1px solid black;border-collapse: collapse;text-align:center;"><?php echo "Rp. ".number_format($historyOrderData[$i]->harga_satuan,0) ?></td>
                        <td style="border: 1px solid black;border-collapse: collapse;text-align:center;"><?php echo "Rp. ".number_format($historyOrderData[$i]->harga_total,0) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div style="color: black;margin-left:70%;margin-top:30px">
            <table>
                <thead>
                    <tr>
                        <td>Grand Total</td>
                        <td>: Rp. <?php echo $sumTotal[0]->total ?></td>
                    </tr>
                    <tr>
                        <td>Discount</td>
                        <td>: Rp. <?php echo number_format($historyOrderData[0]->bonus,0) ?></td>
                    </tr>
                </thead>
            </table>
            <hr style="width: 160px;border-width: 2px;border-style: solid;border-color:black">
            <table>
                <thead >
                    <tr >
                        <td>Total</td>
                        <td>: Rp. <?php echo number_format(floatval($sumTotal[0]->total) - floatval($historyOrderData[0]->bonus),0) ?></td>
                    </tr>
                </thead >
            </table>
        </div>
    </div>
</div>

