<div class="col-12">
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">List <?= $title ?></h3>
			<button type="button" class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i> Baru</button>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
			<table id="list_user" class="table table-bordered table-striped">
				<thead>
					<th>No</th>
					<th>Username</th>
					<th>Nama</th>
					<th>Level</th>
					<th>Jurusan</th>
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
			<form id="formAddUser">
				<div class="modal-header">
					<h4 class="modal-title">Tambah Data</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="exampleInputEmail1">Username</label>
						<input type="text" class="form-control" name="username" placeholder="Masukan Username" required>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Nama</label>
						<input type="text" class="form-control" name="nama" placeholder="Masukan Nama" required>
					</div>
					<div class="form-group">
						<label>Jurusan</label>
						<select class="form-control select2bs4" name="jur" style="width: 100%;">
							<option selected disabled>-- Pilih --</option>
							<option>Teknik Informatika</option>
							<option>Sistem Informasi</option>
						</select>
					</div>
					<div class="form-group">
						<label>Level</label>
						<select class="form-control select2bs4" name="level" style="width: 100%;">
							<option selected disabled>-- Pilih --</option>
							<option value="2">User</option>
							<option value="1">Admin</option>
						</select>
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
				<form id="formEditUser">
					<div class="modal-header">
						<h4 class="modal-title">Edit Data</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<input type="hidden" name="id" id="idData">
							<label for="exampleInputEmail1">Username</label>
							<input type="text" class="form-control" name="username" id="username" placeholder="Masukan Username" required>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Nama</label>
							<input type="text" class="form-control" name="nama" id="nama" placeholder="Masukan Nama" required>
						</div>
						<div class="form-group">
							<label>Jurusan</label>
							<select class="form-control select2bs4" name="jur" id="jur" style="width: 100%;">
								<option selected disabled>-- Pilih --</option>
								<option>Teknik Informatika</option>
								<option>Sistem Informasi</option>
							</select>
						</div>
						<div class="form-group">
							<label>Level</label>
							<select class="form-control select2bs4" name="level" id="level" style="width: 100%;">
								<option selected disabled>-- Pilih --</option>
								<option value="2">User</option>
								<option value="1">Admin</option>
							</select>
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