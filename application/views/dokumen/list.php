<div class="col-12">
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">List <?= $title ?></h3>
			<button type="button" class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i> Baru</button>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
			<table id="list_dokumen" class="table table-bordered table-striped">
				<thead>
					<th>No</th>
					<th>Nama</th>
					<th>Kode</th>
					<th>File</th>
					<th>Kata Kunci</th>
					<th>Kecocokan</th>
					<th>Aksi</th>
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
			<form id="formAddDokumen">
				<div class="modal-header">
					<h4 class="modal-title">Tambah Data</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">Nama</label>
						<input type="text" class="form-control" name="nama" placeholder="Masukan Nama" required>
					</div>
					<div class="form-group">
						<label for="">Kode</label>
						<input type="text" class="form-control" name="kode" placeholder="Masukan Nama" required>
					</div>
					<div class="form-group">
						<label for="">Kata Kunci</label>
						<textarea name="kata_kunci" class="form-control" id="" cols="30" rows="10" required></textarea>
					</div>
					<div class="form-group">
						<label for="">File</label>
						<input type="file" name="file" required>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Kecocokan (%)</label>
						<input type="number" max="100" min="0" class="form-control" name="kecocokan" placeholder="Masukan Kecocokan %" required>
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

<div class="modal fade" id="modal-edit">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-content">
				<form id="formEditDokumen">
					<div class="modal-header">
						<h4 class="modal-title">Edit Data</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<input type="hidden" name="id" id="idData">
							<label for="exampleInputEmail1">Nama</label>
							<input type="text" class="form-control" name="nama" id="nama" placeholder="Masukan Nama" required>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Kode</label>
							<input type="text" class="form-control" name="kode" id="kode" placeholder="Masukan Nama" required>
						</div>
						<div class="form-group">
							<label for="">Kata Kunci</label>
							<textarea name="kata_kunci" class="form-control" id="kata_kunci" cols="30" rows="10" required></textarea>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">File (Pilih file jika ingin merubah File)</label>
							<input type="file" name="file">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Kecocokan (%)</label>
							<input type="number" max="100" min="0" class="form-control" name="kecocokan" id="kecocokan" placeholder="Masukan Kecocokan %" required>
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
</div>