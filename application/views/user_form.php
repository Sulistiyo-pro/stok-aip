<h4><strong>Pengguna Aplikasi</strong></h4>
<hr style="margin-top: 0px; margin-bottom: 10px;"/>
<form method="post" action="<?= site_url() ?>/user/<?= isset($data['username']) ? 'update' : 'create'?>">
    <div class="form-group">
        <label>Username</label>
        <input placeholder="Jangan gunakan spasi untuk membuat kode ..." type="text" name="username" class="form-control" value="<?= isset($data['username']) ? $data['username'] : ''?>" <?= isset($data['username']) ? 'readonly' : ''?> />
    </div>
    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="<?= isset($data['nama']) ? $data['nama'] : ''?>"/>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" value=""/>
    </div>
    <div class="form-group">
        <label>Level</label>
		<select name="level">
			<option value="admin" <?= isset($data['level']) && $data['level'] == 'admin' ? 'selected' : ''?>>Admin</option>
			<option value="gudang" <?= isset($data['level']) && $data['level'] == 'gudang' ? 'selected' : ''?>>Gudang</option>
		</select>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?= site_url() ?>/user" type="button" class="btn btn-danger">Batal</a>
</form>