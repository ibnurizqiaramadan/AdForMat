<input type="hidden" id="statusNa" value="<?= $this->uri->segment('2'); ?>">
<div class="col-12">
    <div class="card">
        <?php $status = $this->uri->segment('2'); if ($this->session->level == 2 && $status == "semua" || $status == "pending") { ?>
            <div class="card-header">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i> Buat Permintaan</button>
            </div>
        <?php } ?>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="list_<?= $this->uri->segment('2'); ?>" class="table table-bordered table-striped">
                <thead>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                    <th style="width: 100px;">Status</th>
                    <th style="width: 200px;">Aksi</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->

<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="formAddPermintaan">
                <div class="modal-header">
                    <h4 class="modal-title">Buat Permintaan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jenis</label>
                        <!-- <input type="text" class="form-control" name="nama" placeholder="Masukan Nama" required> -->
                        <select name="id_jenis" class="form-control">
                            <option value="" selected disabled>-- Pilih --</option>
                            <?php foreach($jenis as $key) { ?>
                                <option value="<?= $key->id?>"><?= $key->nama ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Keterangan</label>
                        <textarea name="keterangan" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>