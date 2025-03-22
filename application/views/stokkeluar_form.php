<h4><strong>Stok Keluar Hari Ini (<?= date('d-m-Y') ?>)</strong></h4>
<hr style="margin-top: 0px; margin-bottom: 10px;"/>
<form method="post" action="<?= site_url() ?>/stok_keluar/<?= isset($data['id']) ? 'update' : 'create'?>">
    <input type="hidden" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>" />
    <input type="hidden" name="waktu" class="form-control" value="<?= isset($data['waktu']) ? $data['waktu'] : time() ?>" />
    <div class="form-group">
        <label>Kode Barang</label>
        <?php if (isset($data['id'])) { ?>
        <input type="text" name="id" class="form-control" value="<?= isset($data['id']) ? $data['id'] : '' ?>" readonly=""/>
        <?php } else { ?>
            <input type="text" name="id" class="form-control" value="" list="stok_list"/>
            <datalist id="stok_list">
                <?php foreach($stok as $m){ ?>
                <option value="<?= $m['id']?>"><?= $m['nama']?></option>
                <?php } ?>
            </datalist>
        <?php } ?>
    </div>
    <div class="form-group">
        <label>Jumlah Keluar</label>
        <input type="number" name="jumlah" class="form-control" value="<?= isset($data['jumlah']) ? $data['jumlah'] : ''?>"/>
    </div>
    <div class="form-group">
        <label>Keterangan</label>
        <input type="text" name="keterangan" class="form-control" value="<?= isset($data['keterangan']) ? $data['keterangan'] : ''?>"/>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?= site_url() ?>/stok_keluar" type="button" class="btn btn-danger">Batal</a>
</form>