<h4>Kas Mutasi Hari Ini (<?= date('d-m-Y') ?>)</h4>
<hr style="margin-top: 0px; margin-bottom: 10px;"/>
<form method="post" action="<?= site_url() ?>/kas_mutasi/<?= isset($data['id']) ? 'update' : 'create'?>">
    <input type="hidden" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>" />
    <input type="hidden" name="waktu" class="form-control" value="<?= isset($data['waktu']) ? $data['waktu'] : time() ?>" />
    <div class="form-group">
        <label>Kas Sumber</label>
        <?php if (isset($data['id'])) { ?>
        <input type="text" name="kas_sumber" class="form-control" value="<?= isset($data['kas_sumber']) ? $data['kas_sumber'] : '' ?>" readonly=""/>
        <?php } else { ?>
            <select name="kas_sumber" class="form-control">
                <?php foreach ($kas as $s) { ?>
                    <option value="<?= $s['id'] ?>"><?= $s['nama'] ?></option>
                <?php } ?>
            </select>
        <?php } ?>
    </div>
    <div class="form-group">
        <label>Kas Tujuan</label>
        <?php if (isset($data['id'])) { ?>
        <input type="text" name="kas_tujuan" class="form-control" value="<?= isset($data['kas_tujuan']) ? $data['kas_tujuan'] : '' ?>" readonly=""/>
        <?php } else { ?>
            <select name="kas_tujuan" class="form-control">
                <?php foreach ($kas as $s) { ?>
                    <option value="<?= $s['id'] ?>"><?= $s['nama'] ?></option>
                <?php } ?>
            </select>
        <?php } ?>
    </div>
    <div class="form-group">
        <label>Jumlah Mutasi</label>
        <input type="number" name="jumlah" class="form-control" value="<?= isset($data['jumlah']) ? $data['jumlah'] : ''?>"/>
    </div>
    <div class="form-group">
        <label>Keterangan</label>
        <input type="text" name="keterangan" class="form-control" value="<?= isset($data['keterangan']) ? $data['keterangan'] : ''?>"/>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?= site_url() ?>/kas_mutasi" type="button" class="btn btn-danger">Batal</a>
</form>