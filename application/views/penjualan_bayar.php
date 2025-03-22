<?php if (count($data) <= 0) { ?>
    <h3>Saat ini tidak ada pesanan ...</h3>
<?php } ?>
<?php foreach ($data as $r) { ?>    
    <div class="col-md-3">
        <div class="panel panel-primary">
            <div class="panel-heading text-center">
                <h3 style="display: inline">MEJA NOMOR <?= $r['meja'] ?></h3>
            </div>
            <div class="panel-body text-center">
                <div style="font-size: 30px">
                    <?= number_format($r['tot'], 0, ',', '.') ?>
                </div>
            </div>
            <div class="panel-footer text-center">
                <a class="btn btn-warning btn-sm" href="<?= site_url() ?>/penjualan/edit/<?= $r['nota'] ?>/<?= $r['meja'] ?>/<?= $r['nota_manual'] ?>"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                <a class="btn btn-success btn-sm" href="<?= site_url() ?>/penjualan/kembalian/<?= $r['nota'] ?>/<?= $r['meja'] ?>"><span class="glyphicon glyphicon-print"></span> Bayar</a>
                <a class="btn btn-danger btn-sm del" href="#" rel="<?= site_url() ?>/penjualan/hapus_nota/<?= $r['nota'] ?>/bayar"><span class="glyphicon glyphicon-remove"></span> Batalkan</a>
                <br />
                <br />
                <form id="<?= $r['nota'] ?>" method="post" class="form form-inline" action="<?= site_url() ?>/penjualan/pindah">
                    <input type="hidden" name="nota" value="<?= $r['nota'] ?>" />
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Pindah ke</div>
                            <input type="text" name="meja" class="form-control" placeholder="no meja" />
                            <div class="input-group-addon btn btn-primary pindah" rel="<?= $r['nota'] ?>"><span class="glyphicon glyphicon-arrow-right"></span></div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
<?php } ?>
<script>
    $('.pindah').click(function(){
       var f = $(this).attr('rel');
       $('#'+f).submit();
    });
</script>


