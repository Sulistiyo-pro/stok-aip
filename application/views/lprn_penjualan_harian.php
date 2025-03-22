<div class="row">
    <div class="col-md-6">
        <h4><strong>Detail Penjualan Harian</strong></h4>
    </div>
    <div class="col-md-6">
        <form class="form form-inline pull-right" method="post" action="<?= site_url() ?>/laporan/ubah_tanggal">
            <input type="hidden" name="laporan" value="penjualan_harian" />
            <label>Tanggal</label>
            <input type="text" size="8" class="form-control" name="tanggal" placeholder="dd-mm-yyyy" value="<?= $this->uri->segment(3) != '' ? $this->uri->segment(3) : date('d-m-Y') ?>" />
            <button type="submit" class="btn btn-warning">Ubah Tanggal Laporan</button>
        </form>
    </div>
</div>
<hr style="margin-top: 0px; margin-bottom: 10px;"/>
<br />
<table class="dataTable table table-condensed table-hover table-striped table-bordered">
    <thead>
    <tr class="bg-primary">           
            <th>Kode</th>
            <th>No. Nota</th>
            <th>Total</th>
            <th>Operator</th>
            <th width="20%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $total_pendapatan = 0;
        foreach ($data as $r) {
            $total_pendapatan = $total_pendapatan + $r['tot'];
            ?>
            <tr>              
                <td><?= $r['nota'] ?></td>
                <td><?= $r['nota_manual'] ?></td>
                <td><?= number_format($r['tot'], 0, ',', '.') ?></td>
                <td><?= $r['user'] ?></td>
                <td class="text-center">
                    <a href="<?= site_url() ?>/penjualan/edit/<?= $r['nota'] ?>/<?= $r['meja'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="#" rel="<?= site_url() ?>/penjualan/hapus_nota/<?= $r['nota'] ?>" class="btn btn-danger btn-sm del">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<div class="badge badge-warning text-wrap" style="width: 41rem; height: 7rem;">
  <h3><strong>Total Pendapatan: Rp. <?= number_format($total_pendapatan, 0, ',', '.') ?></strong></h3>
</div>