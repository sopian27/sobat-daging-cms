<div class="container-fluid mt-3">
    <div class="col-md-6 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <hr style="width: 1570px;margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    <div class="container-fluid">
        <div class="row" id="content-filter"  style="margin-top: 40px;">
            <div class="col-md-2 offset-md-1">
                <input type="text" id="search" name="search" placeholder="search..." class="form-search">
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="container">
                <div class="col-sm-5 offset-md-3" style="margin-top: 40px;">
                    <table class="table table-dark table-bordered data" id="mytable1">
                        <thead>
                            <tr>
                                <th colspan="4"> Data Pelanggan </th>
                            </tr>
                            <tr>
                                <th> Kode </th>
                                <th> Nama Pelanggan </th>
                                <th> Nomor Hp </th>
                                <th> Alamat Pengiriman </th>
                            </tr>
                        </thead>
                        <tbody id="data-crm"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top:60px"></div>
</div>

<script>
    $(document).ready(function() {

        $("#mytable").DataTable({
            "language": {
                "paginate": {
                    "previous": "<",
                    "next": ">"
                }
            }
        });

        getData();

    });

    function getData() {

        $.ajax({
            url: '<?= site_url() ?>/crm/getdata',
            method: 'post',
            dataType: 'json',
            success: function(response) {

                var dataLoad = "";
                var total = 0;
                console.log(response);

                if (response.result != undefined) {
                    for (let i = 0; i < response.datacrm.length; i++) {



                        dataLoad += "<tr>";
                        dataLoad += "<td >";
                        dataLoad += response.datacrm[i].id;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += response.datacrm[i].nama_pelanggan.toUpperCase();
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += response.datacrm[i].nomor_hp1;
                        dataLoad += "</td>";
                        dataLoad += "<td >";
                        dataLoad += response.datacrm[i].alamat1 ;
                        dataLoad += "</td>";
                        dataLoad += "</tr>";

                    }

                    $("#data-crm").html(dataLoad);

                }

                

            },
            error: function(xhr, status, error) {
                console.log("Failed");
                console.log(error);
            }

        });
    }

</script>