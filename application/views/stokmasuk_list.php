<h4><strong>Stok Masuk Hari Ini (<?= date('d-m-Y') ?>)</strong></h4>
<hr style="margin-top: 0px; margin-bottom: 10px;"/>
<a href="<?= site_url() ?>/stok_masuk/form" class="btn btn-success">Tambah Data</a>
<br />
<br />
<table class="dataTable table table-condensed table-hover table-striped table-bordered">
    <thead>
        <tr class="bg-primary">
            <th>Nama Stok</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
            <th>Operator</th>
            <th width="13%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $r) { ?>
            <tr>
                <td><?= get_info_stok($r['id'])['nama'] ?></td>
                <td><?= number_format($r['jumlah'], 0, ',', '.') ?></td>
                <td><?= $r['keterangan'] ?></td>
                <td><?= $r['user'] ?></td>
                <td class="text-center">
                    <a href="<?= site_url() ?>/stok_masuk/edit/<?= $r['id'] ?>/<?= $r['waktu'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="#" rel="<?= site_url() ?>/stok_masuk/delete/<?= $r['id'] ?>/<?= $r['waktu'] ?>" class="btn btn-danger btn-sm del">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>


