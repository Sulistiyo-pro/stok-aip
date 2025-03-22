<h4><strong>Pengguna Aplikasi</strong></h4>
<hr style="margin-top: 0px; margin-bottom: 10px;"/>
<a href="<?= site_url() ?>/user/form" class="btn btn-success">Tambah Pengguna</a>
<br />
<br />
<table class="dataTable table table-condensed table-hover table-striped table-bordered">
    <thead>
        <tr class="bg-primary">
            <th width="15%">Username</th>
            <th>Nama</th>
            <th>Level</th>
            <th width="12%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $r) { ?>
            <tr>
                <td><?= $r['username'] ?></td>
                <td><?= $r['nama'] ?></td>
                <td><?= $r['level'] ?></td>
                <td class="text-center">
                    <a href="<?= site_url() ?>/user/edit/<?= $r['username'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="#" rel="<?= site_url() ?>/user/delete/<?= $r['username'] ?>" class="btn btn-danger btn-sm del">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>


