<h4>Kas Mutasi Hari Ini (<?= date('d-m-Y') ?>)</h4>
<hr style="margin-top: 0px; margin-bottom: 10px;"/>
<a href="<?= site_url() ?>/kas_mutasi/form" class="btn btn-primary">Tambah Data</a>
<br />
<br />
<table class="dataTable table table-condensed table-hover table-striped table-bordered">
    <thead>
        <tr>
            <th>Kas Sumber</th>
            <th>Kas Tujuan</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
            <th>Operator</th>
            <th width="13%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $r) { ?>
            <tr>
                <td><?= get_info_kas($r['kas_sumber'])['nama'] ?></td>
                <td><?= get_info_kas($r['kas_tujuan'])['nama'] ?></td>
                <td><?= number_format($r['jumlah'], 0, ',', '.') ?></td>
                <td><?= $r['keterangan'] ?></td>
                <td><?= $r['user'] ?></td>
                <td class="text-center">
                    <a href="<?= site_url() ?>/kas_mutasi/edit/<?= $r['waktu'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="#" rel="<?= site_url() ?>/kas_mutasi/delete/<?= $r['waktu'] ?>" class="btn btn-danger btn-sm del">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>


