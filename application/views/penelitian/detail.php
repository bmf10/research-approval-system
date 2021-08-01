<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<span class="inline-block align-middle">
						Informasi Penelitian
					</span>
					<?php if (get_role() === 'peneliti') : ?>
						<button data-id="<?= $penelitian->id ?>" type="button" id="edit" class="btn btn-primary btn-sm  float-right" data-toggle="modal" data-target="#modal">
							Edit Penelitian
						</button>
						<a onclick="return confirm('Anda yakin akan menghapus data ini?')" href="<?= base_url('penelitian/delete/' . $penelitian->id) ?>" class="btn btn-sm btn-danger float-right mr-2">Delete</a>
					<?php endif ?>
					<?php if (get_role() === 'admin') : ?>
						<a onclick="return confirm('Anda yakin akan menghapus data ini?')" href="<?= base_url('penelitian/delete/' . $penelitian->id) ?>" class="btn btn-sm btn-danger float-right">Delete</a>
					<?php endif; ?>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="judul">Nama Peneliti</label>
								<input placeholder="Judul" value="<?= $penelitian->nama ?>" class="form-control-plaintext" readonly name="judul" required="required" />
							</div>
							<div class="form-group">
								<label for="judul">Judul</label>
								<input placeholder="Judul" value="<?= $penelitian->judul ?>" class="form-control-plaintext" readonly name="judul" required="required" />
							</div>
							<div class="form-group">
								<label for="lokasi">Lokasi</label>
								<input placeholder="Lokasi" value="<?= $penelitian->lokasi ?>" name="lokasi" class="form-control-plaintext" readonly required="required" />
							</div>
							<div class="form-group">
								<label for="jumlah_anggota">Jumlah Anggota</label>
								<input min="1" type="number" value="<?= $penelitian->jumlah_anggota ?>" placeholder="Jumlah Anggota" name="jumlah_anggota" class="form-control-plaintext" readonly required="required" />
							</div>
							<div class="form-group">
								<label for="jumlah_biaya">Jumlah Biaya</label>
								<input min="1" value="<?= rupiah($penelitian->jumlah_biaya) ?>" placeholder="Jumlah Biaya" name="jumlah_biaya" class="form-control-plaintext" readonly required="required" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="tanggal_pelaksanaan">Tanggal Pelaksanaan</label>
								<input type="date" value="<?= date_input($penelitian->tanggal_pelaksanaan)   ?>" placeholder="Tanggal Pelaksanaan" name="tanggal_pelaksanaan" class="form-control-plaintext" readonly required="required" />
							</div>
							<div class="form-group">
								<label for="objek_penelitian">Objek Penelitian</label>
								<input placeholder="Objek Penelitian" value="<?= $penelitian->objek_penelitian ?>" name="objek_penelitian" class="form-control-plaintext" readonly required="required" />
							</div>
							<div class="form-group">
								<label for="masa_pelaksanaan">Masa Pelaksanaan</label>
								<input placeholder="Masa Pelaksanaan" value="<?= $penelitian->masa_pelaksanaan ?>" name="masa_pelaksanaan" class="form-control-plaintext" readonly required="required" />
							</div>
							<div class="form-group">
								<label for="target_temuan">Target Temuan</label>
								<input placeholder="Target Temuan" value="<?= $penelitian->target_temuan ?>" name="target_temuan" class="form-control-plaintext" readonly required="required" />
							</div>
							<div class="form-group">
								<label for="abstrak">Abstrak</label>
								<textarea placeholder="Abstrak" name="abstrak" class="form-control-plaintext" readonly required="required"><?= $penelitian->abstrak ?></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include 'tahapan.php' ?>
		<?php include 'evaluasi.php' ?>
		<?php include 'penilaian.php' ?>
	</div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Data Penelitian</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form" action="<?= base_url('penelitian') ?>" method="POST" autocomplete="off">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<input type="hidden" id="id" name="id">
							<div class="form-group">
								<label for="judul">Judul</label>
								<input id="judul" placeholder="Judul" name="judul" class="form-control" required="required" />
							</div>
							<div class="form-group">
								<label for="lokasi">Lokasi</label>
								<input id="lokasi" placeholder="Lokasi" name="lokasi" class="form-control" required="required" />
							</div>
							<div class="form-group">
								<label for="jumlah_anggota">Jumlah Anggota</label>
								<input id="jumlah_anggota" min="1" type="number" placeholder="Jumlah Anggota" name="jumlah_anggota" class="form-control" required="required" />
							</div>
							<div class="form-group">
								<label for="jumlah_biaya">Jumlah Biaya</label>
								<input id="jumlah_biaya" min="1" type="number" placeholder="Jumlah Biaya" name="jumlah_biaya" class="form-control" required="required" />
							</div>
							<div class="form-group">
								<label for="tanggal_pelaksanaan">Tanggal Pelaksanaan</label>
								<input id="tanggal_pelaksanaan" type="date" placeholder="Tanggal Pelaksanaan" name="tanggal_pelaksanaan" class="form-control" required="required" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="objek_penelitian">Objek Penelitian</label>
								<input id="objek_penelitian" placeholder="Objek Penelitian" name="objek_penelitian" class="form-control" required="required" />
							</div>
							<div class="form-group">
								<label for="masa_pelaksanaan">Masa Pelaksanaan</label>
								<input id="masa_pelaksanaan" placeholder="Masa Pelaksanaan" min="1900" max="2099" step="1" type="number" name="masa_pelaksanaan" class="form-control" required="required" />
							</div>
							<div class="form-group">
								<label for="target_temuan">Target Temuan</label>
								<input id="target_temuan" placeholder="Target Temuan" name="target_temuan" class="form-control" required="required" />
							</div>
							<div class="form-group">
								<label for="abstrak">Abstrak</label>
								<textarea id="abstrak" placeholder="Abstrak" name="abstrak" class="form-control" required="required"></textarea>
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
		$('#penelitian_menu').addClass('active')

		$('#edit').click(function() {
			let data = $(this).data('id')
			$.get({
				url: `<?= base_url('penelitian/get_one/') ?>${data}`,
				success: res => {
					const newDate = new Date()

					$('#id').val(res.id)
					$('#judul').val(res.judul)
					$('#lokasi').val(res.lokasi)
					$('#jumlah_anggota').val(res.jumlah_anggota)
					$('#jumlah_biaya').val(res.jumlah_biaya)
					$('#tanggal_pelaksanaan').val(formatDate(res.tanggal_pelaksanaan))
					$('#objek_penelitian').val(res.objek_penelitian)
					$('#masa_pelaksanaan').val(res.masa_pelaksanaan)
					$('#target_temuan').val(res.target_temuan)
					$('#abstrak').val(res.abstrak)
					$('#modal').modal('show')
				},
				error: err => {
					console.log(err)
				}
			})
		})

		function formatDate(date) {
			var d = new Date(date),
				month = '' + (d.getMonth() + 1),
				day = '' + d.getDate(),
				year = d.getFullYear();

			if (month.length < 2)
				month = '0' + month;
			if (day.length < 2)
				day = '0' + day;

			return [year, month, day].join('-');
		}

		$('#modal').on('hidden.bs.modal', function(e) {
			$('#id').val('')
			$('#form').trigger('reset')
		})
	})
</script>
