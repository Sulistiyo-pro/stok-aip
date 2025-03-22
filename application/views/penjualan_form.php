<br />
<div class="col-md-4">
    <form method="post" action="<?= site_url() ?>/penjualan/create">
        <input type="hidden" name="id" value="<?= time(); ?>" />
        <input type="hidden" name="nota" value="<?= $_SESSION['nota']; ?>" />
        <input type="hidden" name="nota_manual" value="<?= $_SESSION['nota_manual']; ?>" />
        <div class="form-group">
            <label>Kode Barang</label>
            <input type="text" name="menu" class="form-control" value="" list="menu_list" />
            <datalist id="menu_list">
                <?php foreach($menu as $m){ ?>
                <option value="<?= $m['id']?>"><?= $m['nama']?></option>
                <?php } ?>
            </datalist>
        </div>
        <div class="form-group">
            <label>Jumlah Beli</label>
            <input type="number" name="qty" class="form-control" value="1" min="1"/>
            <small class="text-danger"><?= $this->session->flashdata('error'); ?></small>
        </div>
        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Tambahkan</button>
    </form>
</div>
<div class="col-md-8">
    <label>Daftar Pembelian Pelanggan</label>
    <div class="table-responsive">
        <table class="table table-hover table-condensed">
            <tr class="bg-primary">
                <th width="1%"></th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
            <?php
            $tot = 0;
            foreach ($cart as $r) {
                $tot+= $r['total'];
                ?>
                <tr>
                    <td><a href="<?= site_url() ?>/penjualan/delete/<?= $r['id'] ?>"><li class="glyphicon glyphicon-remove-circle"></li></a></td>
                    <td><?= $r['nama'] ?></td>
                    <td><?= $r['qty'] ?></td>
                    <td><?= $r['satuan'] ?></td>
                    <td><?= number_format($r['harga'], 0, ',', '.') ?></td>
                    <td><?= number_format($r['total'], 0, ',', '.') ?></td>
                </tr>
            <?php } ?>
            <tr>
                <th colspan="4">
                    <a href="<?= site_url() ?>/penjualan/kembalian/<?= $_SESSION['nota']; ?>" class="btn btn-success  btn-sm"><span class="glyphicon glyphicon-print"></span> Bayar</a>
                    <a href="#" rel="<?= site_url() ?>/penjualan/hapus_nota/<?= $_SESSION['nota']; ?>/pesan" class="btn btn-danger btn-sm del"><span class="glyphicon glyphicon-remove"></span> Batalkan</a>
                <th><h4><strong>Total</strong></h4></th>
                <th><h4><strong><?= number_format($tot, 0, ',', '.') ?></strong></h4></th>
            </tr>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        var nota_manual = '<?= $_SESSION['nota_manual']; ?>';
        if (nota_manual != '') {
            $('input[name=menu]').focus();
        } else {
            $('input[name=nota_manual]').focus();
        }
    });
</script>
