<div class="container-fluid mt-3">
    <div class="col-md-3 offset-md-1">
        <h2><?= ucfirst($judul) ?></h2>
    </div>
    <div class="col-md-11">
        <hr style="margin-left:160px;border-width: 2px;border-style: solid;border-color:white">
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 offset-md-1"><?= $id_trx_mutasi ?></div>
            <div class="col-md-2 offset-md-5"><?= $date ?></div>
        </div>
        <div class="container-fluid" style="margin-top: 60px;">
            <div class="row justify-content-center">
                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-8 offset-md-2 justify-content-center">
                        <form method="post" id="form-mutasi-inventory">
                            <div class="row mt-2 ">
                                <table class="table table-dark table-bordered data" id="mytable">
                                    <thead>
                                        <tr>
                                            <th> Kode </th>
                                            <th> Nama Barang </th>
                                            <th> Quantity Gudang</th>
                                            <th width="20%"> Mutasi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="quantity_pusat" id="quantity_pusat">
                                <input type="hidden" name="quantity_mutasi" id="quantity_mutasi">
                                <input type="hidden" name="kode" id="kode">
                                <input type="hidden" name="id_trx_mutasi" id="id_trx_mutasi" value="<?= $id_trx_mutasi?>">
                            </div>
                            <div class="row d-flex justify-content-end" style="margin-top:30px">
                                <div class="col-md-2">
                                    <button class="form-control-button btn btn-outline-light button-action" onclick="clearAllData();"> Clear All </button>
                                </div>
                                <div class="col-md-2">
                                    <button class="form-control-button btn btn-outline-light button-action" onclick="return confirmData();"> Confirm </button>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-start formSubmitData" id="formSubmitData">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#mytable").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('inventory-mutasibarang/get_ajax') ?>",
                "type": "POST"

            },
            "language": {
                "paginate": {
                    "previous": "<",
                    "next": ">"
                }
            },
            searching: false,
            //paging: false, 
            info: false,
            ordering: false
        });

    });

    function confirmData() {

        var mutasi = document.getElementsByName('mutasi[]');
        var k = "";
        var submit = true;
        for (var i = 0; i < mutasi.length; i++) {
            var a = mutasi[i];
            k = k + "array[" + i + "].value= " + a.value + " ";
            var index = i;
            var value = a.value;

            console.log("array[" + index + "] => " + value + " => length:" + value.length);

            if (checkInvalid(value)) {
                alert("mutasi tidak boleh kosong");
                submit = false;
                break;
            } else {
                if (isNaN(value)) {
                    alert("mutasi harus number");
                    submit = false;
                    break;

                }
            }

        }

        if (submit == true) {
            console.log("submit " + submit);
            getIdMutasi();
            
            $("#form-mutasi-inventory").attr('action', '<?php echo site_url() ?>/inventory-mutasibarang/insertmutasi');
            $("#form-mutasi-inventory").submit();

        } else {
            return false;
        }
    }

    function getIdMutasi() {

        var i = 0;
        var id_arr       = [];
        var mutasi_arr   = [];
        var kode_arr     = [];
        var quantity_arr = [];

        var value_id = $('input:text').map(function() {

            i++;
            var id_val =  $(this).attr('id');
            var mutasi =  $(this).val();

            console.log("this_value :" + i + "==> " + id_val + "----" + mutasi);

            var idx = id_val.replaceAll("mutasi", "");
            const data = idx.split("_,_");
            var id = data[0];
            var kode = data[1];
            var quantity = data[2];

            id_arr.push(id);
            mutasi_arr.push(mutasi);
            kode_arr.push(kode);
            quantity_arr.push(quantity);

            return $(this).val();
        });

        $("#id").val(id_arr);
        $("#quantity_mutasi").val(mutasi_arr);
        $("#quantity_pusat").val(quantity_arr);
        $("#kode").val(kode_arr);

        console.log("id_val length = " + id.length);
    }


    function checkInvalid(val) {
        if (val == null || val == "") {
            return true;
        }

        return false;
    }
</script>