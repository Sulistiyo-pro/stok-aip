<h4>Menu Restoran</h4>
<hr style="margin-top: 0px; margin-bottom: 10px;"/>
<form method="post" action="<?= site_url() ?>/menu/<?= isset($data['id']) ? 'update' : 'create'?>">
    <div class="form-group">
        <label>Kode Menu</label>
        <input placeholder="Jangan gunakan spasi untuk membuat kode ..." type="text" name="id" class="form-control" value="<?= isset($data['id']) ? $data['id'] : ''?>" <?= isset($data['id']) ? 'readonly' : ''?> />
    </div>
    <div class="form-group">
        <label>Nama Menu</label>
        <input type="text" name="nama" class="form-control" value="<?= isset($data['nama']) ? $data['nama'] : ''?>"/>
    </div>
    <div class="form-group">
        <label>Harga</label>
        <input type="number" name="harga" class="form-control" value="<?= isset($data['harga']) ? $data['harga'] : ''?>"/>
    </div>
    <div class="form-group">
        <label>Menu ini akan mengurangi stok</label>
        <select name="id_stok" class="form-control">
            <option value="">-- Plih --</option>
            <?php foreach($stok as $s){ ?>
            <option <?= (isset($data['id_stok']) && $data['id_stok'] == $s['id'] ) ? 'selected' : '' ?> value="<?= $s['id'] ?>"><?= $s['nama'] ?></option>
            <?php } ?>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?= site_url() ?>/menu" type="button" class="btn btn-danger">Batal</a>
</form>