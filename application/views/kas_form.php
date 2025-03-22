<h4>Master Kas</h4>
<hr style="margin-top: 0px; margin-bottom: 10px;"/>
<form method="post" action="<?= site_url() ?>/kas/<?= isset($data['id']) ? 'update' : 'create'?>">
    <div class="form-group">
        <label>Kode Kas</label>
        <input placeholder="Jangan gunakan spasi untuk membuat kode ..." type="text" name="id" class="form-control" value="<?= isset($data['id']) ? $data['id'] : ''?>" <?= isset($data['id']) ? 'readonly' : ''?> />
    </div>
    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="<?= isset($data['nama']) ? $data['nama'] : ''?>"/>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?= site_url() ?>/menu" type="button" class="btn btn-danger">Batal</a>
</form>