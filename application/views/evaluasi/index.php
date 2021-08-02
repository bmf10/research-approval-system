<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					Daftar Evaluasi
				</div>
				<div class="card-body">
					<table id="table" class="table table-bordered table-striped">
						<thead>
							<th>No</th>
							<th>Judul</th>
							<th>Nama Pemeriksa</th>
							<th>Status</th>
							<th>Komentar</th>
							<th>Tanggal Pemeriksaan</th>
							<th data-priority="1">Action</th>
						</thead>
						<tbody>
							<?php foreach ($evaluasi as $key => $d) : ?>
								<tr>
									<td><?= $key + 1 ?></td>
									<td><?= $d->judul ?></td>
									<td><?= $d->nama ?></td>
									<td style="text-transform: capitalize;"><?= $d->status ?></td>
									<td><?= $d->komentar ?></td>
									<td><?= date_readable($d->created_at) ?></td>
									<td>
										<a href="<?= 'evaluasi/detail/' . $d->id ?>" class="btn btn-sm btn-info m-1">Detail</a>
										<?php if (get_role() === 'kepala_pme' || get_role() === 'admin') : ?>
											<a href="<?= 'penelitian/export_pdf/' . $d->id_penelitian ?>" class="btn btn-sm btn-success m-1">Export PDF</a>
										<?php endif ?>
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

<script>
	$(document).ready(function() {
		$('#evaluasi_menu').addClass('active')

		$("#table").DataTable({
			"responsive": true,
			"autoWidth": false,
		})
	})
</script>
