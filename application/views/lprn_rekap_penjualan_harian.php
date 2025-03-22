<div class="row">
    <div class="col-md-6">
        <h4>Rekap Penjualan Harian</h4>
    </div>
    <div class="col-md-6">
        <form class="form form-inline pull-right" method="post" action="<?= site_url() ?>/laporan/ubah_tanggal">
            <input type="hidden" name="laporan" value="rekap_penjualan_harian" />
            <label>Tanggal</label>
            <input type="text" size="8" class="form-control" name="tanggal" placeholder="dd-mm-yyyy" value="<?= $this->uri->segment(3) != '' ? $this->uri->segment(3) : date('d-m-Y') ?>" />
            <button type="submit" class="btn btn-primary">Ubah Tanggal Laporan</button>
        </form>
    </div>
</div>
<hr style="margin-top: 0px; margin-bottom: 10px;"/>
<br />
<table class="dataTable table table-condensed table-hover table-striped table-bordered">
    <thead>
        <tr>
            <th>Menu</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $total_pendapatan = 0;
        foreach ($data as $r) {
            $total_pendapatan = $total_pendapatan + $r['total'];
            ?>
            <tr>
                <td><?= get_info_menu($r['menu'])['nama'] ?></td>
                <td><?= number_format($r['harga'], 0, ',', '.') ?></td>
                <td><?= number_format($r['qty'], 0, ',', '.') ?></td>
                <td><?= number_format($r['total'], 0, ',', '.') ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<h3>Total Pendapatan: Rp. <?= number_format($total_pendapatan, 0, ',', '.') ?></h3>