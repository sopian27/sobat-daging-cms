<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <div class="col-md-11">
        <hr style="margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    </div>
    <div class="container-fluid">
        <div class="row" id="content-filter"  style="margin-top: 40px;">
            <div class="col-md-2 offset-md-1">
                <input type="text" id="search" name="search" placeholder="search..." class="form-search">
            </div>
            <div class="col-md-2 offset-md-6">
                <input type="text" id="create_date" name="create_date" class="form-search" placeholder="sort...">
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="container">
                <div class="col-md-4 offset-md-4" style="margin-top: 20px;">
                    <table class="table table-dark table-bordered data">
                        <thead>
                            <tr>
                                <th colspan="5"> Data Mutasi </th>
                            </tr>
                            <tr>
                                <th> Nama Pelanggan </th>
                                <th> Nomor Invoice </th>
                                <th> Jatuh Tempo </th>
                                <th> Nominal </th>
                                <th> Keterangan </th>
                            </tr>
                        </thead>
                        <tbody>
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

    });

    $(function() {
        $("#create_date").datepicker({
            todayHighlight: true,
            format: "yyyymm",
            startView: "months",
            minViewMode: "months",
            autoclose: true
        })

        $("#create_date").val("sort by month....");
    });

</script>