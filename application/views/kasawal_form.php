<h4>Kas Awal Hari Ini</h4>
<hr style="margin-top: 0px; margin-bottom: 10px;"/>
<form method="post" action="<?= site_url() ?>/kas_awal/<?= isset($data['id']) ? 'update' : 'create' ?>">
    <input type="hidden" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>" />
    <div class="form-group">
        <label>Kas</label>
        <?php if (isset($data['id'])) { ?>
        <input type="text" name="id" class="form-control" value="<?= isset($data['id']) ? $data['id'] : '' ?>" readonly=""/>
        <?php } else { ?>
            <select name="id" class="form-control">
                <?php foreach ($kas as $s) { ?>
                    <option value="<?= $s['id'] ?>"><?= $s['nama'] ?></option>
                <?php } ?>
            </select>
        <?php } ?>
    </div>
    <div class="form-group">
        <label>Jumlah Awal</label>
        <input type="number" name="jumlah" class="form-control" value="<?= isset($data['jumlah']) ? $data['jumlah'] : '' ?>"/>
    </div>
    <div class="form-group">
        <label>Keterangan</label>
        <input type="text" name="keterangan" class="form-control" value="<?= isset($data['keterangan']) ? $data['keterangan'] : '' ?>"/>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?= site_url() ?>/kas_awal" type="button" class="btn btn-danger">Batal</a>
</form>