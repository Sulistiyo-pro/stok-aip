<div class="row">
    <div class="col-md-6">
        <h4><strong>Posisi Stok Harian</strong></h4>
    </div>
    <div class="col-md-6">
        <form class="form form-inline pull-right" method="get" action="<?= site_url() ?>/laporan/posisi_stok">
            <label>Tanggal</label>
            <input type="text" size="8" class="form-control" name="mulai" placeholder="dd-mm-yyyy" value="<?= isset($_GET['mulai']) ? $_GET['mulai'] : date('d-m-Y') ?>" />
			<input type="text" size="8" class="form-control" name="selesai" placeholder="dd-mm-yyyy" value="<?= isset($_GET['mulai']) ? $_GET['mulai'] : date('d-m-Y') ?>" />
            <button type="submit" class="btn btn-warning">Ubah Tanggal Laporan</button>
        </form>
    </div>
</div>
<hr style="margin-top: 0px; margin-bottom: 10px;"/>
<?= anchor('laporan/hitung_ulang','HITUNG ULANG STOK (SESUAI TANGGAL PC)','class="btn btn-success"') ?>
<br /><br />
<table class="dataTable table table-condensed table-hover table-striped table-bordered small">
    <thead >
        <tr class="bg-primary">          
            <th>No</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Awal</th>
            <th>Masuk</th>
            <th>Keluar</th>
            <th>Terjual</th>
            <th>Akhir</th>
            <th>Harga</th>
            <th>Asset</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; ?>
        <?php foreach ($data as $r) { ?>
            <tr>              
                <td><?= $no++ ?></td>
                <td><?= $r['id'] ?></td>
                <td><?= get_info_stok($r['id'])['nama'] ?></td>
                <td><?= $r['awal'] ?></td>
                <td><?= $r['masuk'] ?></td>
                <td><?= $r['keluar'] ?></td>
                <td><?= $r['terjual'] ?></td>
                <td><?= ($r['awal']+$r['masuk']-$r['keluar']-$r['terjual']) ?></td>
				<td><?= number_format(get_info_stok($r['id'])['harga'],0) ?></td>
				<td><?= number_format(get_info_stok($r['id'])['harga']*$r['akhir'],0) ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>