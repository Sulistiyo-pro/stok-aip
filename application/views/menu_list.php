<h4>Menu Restoran</h4>
<hr style="margin-top: 0px; margin-bottom: 10px;"/>
<a href="<?= site_url() ?>/menu/form" class="btn btn-primary">Tambah Menu</a>
<br />
<br />
<table class="dataTable table table-condensed table-hover table-striped table-bordered">
    <thead>
        <tr>
            <th width="15%">Kode Menu</th>
            <th>Nama</th>
            <th>Harga</th>
            <th width="12%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $r) { ?>
            <tr>
                <td><?= $r['id'] ?></td>
                <td><?= $r['nama'] ?></td>
                <td><?= number_format($r['harga'], 0, ',', '.') ?></td>
                <td class="text-center">
                    <a href="<?= site_url() ?>/menu/edit/<?= $r['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="#" rel="<?= site_url() ?>/menu/delete/<?= $r['id'] ?>" class="btn btn-danger btn-sm del">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>


