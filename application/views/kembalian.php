<div class="col-md-6 col-md-offset-3">
    <div class="panel panel-primary">
        <div class="panel-heading">Pembayaran</div>
        <div class="panel-body">
            <form class="form" method="post" action="<?= site_url() ?>/penjualan/simpan">
                <input type="hidden" name="nota" value="<?= $this->uri->segment(3) ?>" />
                <input type="hidden" name="total" value="<?= $data['total'] ?>" />
                <div class="form-group-lg">
                    <label>TOTAL</label>
                    <input id="total" type="text" class="form-control" value="<?= number_format($data['total'], 0) ?>" readonly="" />
                </div>
                <br />
                <div class="form-group-lg">
                    <label>BAYAR</label>
                    <input id="bayar" required="" name="bayar" type="number" min="<?= $data['total'] ?>" class="form-control" value="<?= $data['total'] ?>" />
                </div>
                <br />
                <div class="form-group-lg">
                    <label>KEMBALIAN</label>
                    <input id="kembalian" type="text" class="form-control" readonly="" value="0" />
                </div>
                <br />
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-print"></span> Bayar</button>
                <a href="<?= site_url() ?>/penjualan" class="btn btn-default"> Kembali</a>
            </form>
        </div>
    </div>
</div>
<script>
    $('#bayar').focus();
    $('#bayar').select();
    $('#bayar').keyup(function () {
        var total = '<?= $data['total'] ?>';
        total = parseInt(total);
        var bayar = $('#bayar').val();
        if (bayar>0) {
            bayar = parseInt($('#bayar').val());
            var kembali = bayar - total;
            $('#kembalian').val(kembali.toLocaleString('en-US', {minimumFractionDigits: 0}));
        }else{
            $('#kembalian').val('0');
        }
    });

</script>