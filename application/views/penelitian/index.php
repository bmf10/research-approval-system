<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php if (get_role() === 'peneliti') : ?>
				<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal">
					Tambahkan Penelitian
				</button>
			<?php endif ?>
			<div class="card">
				<div class="card-header">
					Daftar Penelitian
				</div>
				<div class="card-body">
					<table id="table" class="table table-bordered table-striped">
						<thead>
							<th>No</th>
							<th>Nama Peneliti</th>
							<th>Judul</th>
							<th>Lokasi</th>
							<th>Jumlah Anggota</th>
							<th>Jumlah Biaya</th>
							<th>Status Evaluasi</th>
							<th data-priority="1">Action</th>
						</thead>
						<tbody>
							<?php foreach ($penelitian as $key => $d) : ?>
								<tr>
									<td><?= $key + 1 ?></td>
									<td><?= $d->nama ?></td>
									<td><?= $d->judul ?></td>
									<td><?= $d->lokasi ?></td>
									<td><?= $d->jumlah_anggota ?></td>
									<td><?= rupiah($d->jumlah_biaya) ?></td>
									<td style="text-transform: capitalize;"><?= $d->status ? $d->status : 'belum dievaluasi' ?></td>
									<td>
										<a href="<?= 'penelitian/detail/' . $d->id ?>" class="btn btn-sm btn-info mx-1">Detail</a>
									</td>
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
			<form id="form" action="<?= base_url('penelitian') ?>" method="POST" autocomplete="off">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
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

		$("#table").DataTable({
			"responsive": true,
			"autoWidth": false,
		})
	})
</script>
