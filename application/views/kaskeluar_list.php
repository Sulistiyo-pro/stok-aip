<h4>Kas Keluar Hari Ini (<?= date('d-m-Y') ?>)</h4>
<hr style="margin-top: 0px; margin-bottom: 10px;"/>
<a href="<?= site_url() ?>/kas_keluar/form" class="btn btn-primary">Tambah Data</a>
<br />
<br />
<table class="dataTable table table-condensed table-hover table-striped table-bordered">
    <thead>
        <tr>
            <th>Nama Kas</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
            <th>Operator</th>
            <th width="13%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $r) { ?>
            <tr>
                <td><?= get_info_kas($r['id'])['nama'] ?></td>
                <td><?= number_format($r['jumlah'], 0, ',', '.') ?></td>
                <td><?= $r['keterangan'] ?></td>
                <td><?= $r['user'] ?></td>
                <td class="text-center">
                    <a href="<?= site_url() ?>/kas_keluar/edit/<?= $r['id'] ?>/<?= $r['waktu'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="#" rel="<?= site_url() ?>/kas_keluar/delete/<?= $r['id'] ?>/<?= $r['waktu'] ?>" class="btn btn-danger btn-sm del">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>


