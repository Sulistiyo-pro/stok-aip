<h4>Master Kas</h4>
<hr style="margin-top: 0px; margin-bottom: 10px;"/>
<a href="<?= site_url() ?>/kas/form" class="btn btn-primary">Tambah Master Kas</a>
<br />
<br />
<table class="dataTable table table-condensed table-hover table-striped table-bordered">
    <thead>
        <tr>
            <th width="15%">Kode Kas</th>
            <th>Nama</th>
            <th width="12%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $r) { ?>
            <tr>
                <td><?= $r['id'] ?></td>
                <td><?= $r['nama'] ?></td>
                <td class="text-center">
                    <a href="<?= site_url() ?>/kas/edit/<?= $r['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="#" rel="<?= site_url() ?>/kas/delete/<?= $r['id'] ?>" class="btn btn-danger btn-sm del">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>


