<div class="row">
    <div class="col-md-6">
        <h4>Posisi Kas Harian</h4>
    </div>
    <div class="col-md-6">
        <form class="form form-inline pull-right" method="post" action="<?= site_url() ?>/laporan/ubah_tanggal">
            <input type="hidden" name="laporan" value="posisi_kas" />
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
            <th>Nama Kas</th>
            <th>Awal</th>
            <th>Masuk</th>
            <th>Penjualan</th>
            <th>Keluar</th>
            <th>Akhir</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $r) { ?>
            <tr>              
                <td><?= get_info_kas($r['id'])['nama'] ?></td>
                <td><?= number_format($r['awal'], 0, ',', '.') ?></td>
                <td><?= number_format($r['masuk'], 0, ',', '.') ?></td>
                <td><?= number_format($r['penjualan'], 0, ',', '.') ?></td>
                <td><?= number_format($r['keluar'], 0, ',', '.') ?></td>
                <td><?= number_format($r['akhir'], 0, ',', '.') ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>