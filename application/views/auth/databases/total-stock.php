<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <hr style="margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    <div class="container-fluid">
        <div class="row" id="content-filter"  style="margin-top: 40px;">
            <div class="col-md-2 offset-md-1">
                <input type="text" id="search" name="search" placeholder="search..." class="form-search">
            </div>
        </div>
        <div class="row" style="margin-top: 150px;" id="content-header">
            <div class="col-md-8 offset-md-7" style="margin-top:-110px">
                <div class="form-group row">
                    <label for="" class="col-sm-5 col-form-label" style="margin-top: -7px;"><h4 id="tot-stock"></h4></label>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="container">
                <div class="col-sm-7 offset-md-2">
                    <table class="table table-dark table-bordered data" id="mytable">
                        <thead>
                            <tr class="align-middle">
                                <th rowspan="2"> Kode </th>
                                <th rowspan="2"> Nama Barang </th>
                                <th rowspan="1" colspan="2"> Quantity</th>
                                <th rowspan="2"> Harga Terakhir </th>
                                <th rowspan="2"> Harga Total </th>
                            </tr>
                            <tr>
                                <th> Gudang Luar </th>
                                <th> Gudang Sobat </th>
                            </tr>
                        </thead>
                        <tbody id="data-stock">
                        <tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top:60px"></div>
</div>

<script>
    $(document).ready(function() {

        getData();

    });

    function getData() {

        $.ajax({
            url: '<?= site_url() ?>/total-stock/getdata',
            method: 'post',
            dataType: 'json',
            success: function(response) {

                var dataLoad = "";
                var total = 0;
                console.log(response);

                if (response.result != undefined) {
                    for (let i = 0; i < response.datastock.length; i++) {

                        var tot = (parseFloat(response.datastock[i].harga_satuan)* (parseFloat( response.datastock[i].quantity_sobat)));
                        total += tot;

                        dataLoad += "<tr>";
                        dataLoad += "<td >";
                        dataLoad += response.datastock[i].kode;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += response.datastock[i].nama_barang.toUpperCase();
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += response.datastock[i].quantity_pusat +" " +response.datastock[i].satuan;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += response.datastock[i].quantity_sobat +" " +response.datastock[i].satuan; ;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += numberWithCommas("Rp. "+response.datastock[i].harga_satuan) ;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += numberWithCommas("Rp. "+tot);
                        dataLoad += "</td>";
                        dataLoad += "</tr>";

                    }

                    $("#tot-stock").html(numberWithCommas("Total Nominal Aset Stock : Rp. "+total));
                    $("#data-stock").html(dataLoad);

                }

                

            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

</script>