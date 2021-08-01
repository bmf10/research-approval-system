<div class="container">
	<div class="row">
		<div class="col-md-12">
			<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal">
				Tambahkan User
			</button>
			<div class="card">
				<div class="card-header">
					Daftar User
				</div>
				<div class="card-body">
					<table id="table" class="table table-bordered table-striped">
						<thead>
							<th>No</th>
							<th>NIP</th>
							<th>Nama</th>
							<th>Email</th>
							<th>Telepon</th>
							<th>Username</th>
							<th>Golongan</th>
							<th>Jabatan Fungsional</th>
							<th>Jabatan Struktural</th>
							<th>Role</th>
							<th style="min-width: 90px;" data-priority="1">Action</th>
						</thead>
						<tbody>
							<?php foreach ($users as $key => $d) : ?>
								<tr>
									<td><?= $key + 1 ?></td>
									<td><?= $d->nip ?></td>
									<td><?= $d->nama ?></td>
									<td><?= $d->email ?></td>
									<td><?= $d->telepon ?></td>
									<td><?= $d->username ?></td>
									<td><?= $d->golongan ?></td>
									<td><?= $d->jabatan_fungsional ?></td>
									<td><?= $d->jabatan_struktural ?></td>
									<td style="text-transform:capitalize"><?= $d->role ?></td>
									<td><button class="btn btn-sm btn-info mx-1 edit" data-id="<?= $d->id ?>">Edit</button><a onclick="return confirm('Anda yakin akan menghapus data ini?')" href="<?= base_url('user/delete/' . $d->id) ?>" class="btn btn-sm btn-danger">Delete</a></td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Data User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form" action="<?= base_url('user') ?>" method="POST" autocomplete="off">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<input type="hidden" id="id" name="id">
							<div class="form-group">
								<label for="nip">NIP</label>
								<input id="nip" placeholder="NIP" name="nip" class="form-control" required="required" />
							</div>
							<div class="form-group">
								<label for="nama">Nama</label>
								<input id="nama" placeholder="Nama" name="nama" class="form-control" required="required" />
							</div>
							<div class="form-group">
								<label for="nama">Telepon</label>
								<input id="telepon" placeholder="Telepon" name="telepon" class="form-control" required="required" />
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input id="email" placeholder="Email" type="email" name="email" class="form-control" required="required" />
							</div>
							<div class="form-group">
								<label for="golongan">Golongan</label>
								<input id="golongan" placeholder="Golongan" name="golongan" class="form-control" required="required" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="jabatan">Jabatan Fungsional</label>
								<input id="jabatan_fungsional" placeholder="Jabatan Fungsional" name="jabatan_fungsional" class="form-control" required="required" />
							</div>
							<div class="form-group">
								<label for="jabatan">Jabatan Struktural</label>
								<input id="jabatan_struktural" placeholder="Jabatan Struktural" name="jabatan_struktural" class="form-control" required="required" />
							</div>
							<div class="form-group">
								<label for="role">Hak Akses/Role</label>
								<div>
									<select id="role" name="role" class="custom-select" required="required">
										<option value="">Pilih Hak Akses/Role</option>
										<option value="admin">Admin</option>
										<option value="peneliti">Peneliti</option>
										<option value="anggota_pme">Anggota PME</option>
										<option value="kepala_pme">Kepala PME</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="nama">Username</label>
								<input id="username" placeholder="Username" name="username" class="form-control" required="required" />
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input autocomplete="new-password" id="password" placeholder="Password" name="password" type="password" class="form-control" required="required" />
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#user_menu').addClass('active')

		$("#table").DataTable({
			"responsive": true,
			"autoWidth": true
		})

		$('.edit').click(function() {
			console.log('run')
			let data = $(this).data('id')
			$.get({
				url: `<?= base_url('user/get_one/') ?>${data}`,
				success: res => {
					$('#id').val(res.id)
					$('#nip').val(res.nip)
					$('#nama').val(res.nama)
					$('#email').val(res.email)
					$('#golongan').val(res.golongan)
					$('#jabatan_struktural').val(res.jabatan_struktural)
					$('#jabatan_fungsional').val(res.jabatan_fungsional)
					$('#telepon').val(res.telepon)
					$('#username').val(res.username)
					$('#role').val(res.role)
					$('#modal').modal('show')
					$('#password').attr('required', false)
				},
				error: err => {
					console.log(err)
				}
			})
		})

		$('#modal').on('hidden.bs.modal', function(e) {
			$('#id').val('')
			$('#form').trigger('reset')
			$('#password').attr('required', true)
		})
	})
</script>