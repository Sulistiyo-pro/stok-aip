<h4><strong>Master Barang</strong></h4>

<hr style="margin-top: 0px; margin-bottom: 10px;"/>

<form method="post" action="<?= site_url() ?>/stok/<?= isset($data['id']) ? 'update' : 'create'?>">

    <div class="form-group">

        <label>Kode Barang</label>

        <input placeholder="Jangan gunakan spasi untuk membuat kode ..." type="text" name="id" class="form-control" value="<?= isset($data['id']) ? $data['id'] : ''?>" <?= isset($data['id']) ? 'readonly' : ''?> />

    </div>

    <div class="form-group">

        <label>Nama</label>

        <input type="text" name="nama" class="form-control" value="<?= isset($data['nama']) ? $data['nama'] : ''?>"/>

    </div>

    <div class="form-group">

        <label>Satuan</label>

        <input type="text" name="satuan" class="form-control" value="<?= isset($data['satuan']) ? $data['satuan'] : ''?>"/>

    </div>

	<div class="form-group">

        <label>Harga</label>

        <input type="number" name="harga" class="form-control" value="<?= isset($data['harga']) ? $data['harga'] : ''?>"/>

    </div>

    <button type="submit" class="btn btn-success">Simpan</button>

    <a href="<?= site_url() ?>/stok" type="button" class="btn btn-danger">Batal</a>

</form>