<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					Daftar Penilaian
				</div>
				<div class="card-body">
					<table id="table" class="table table-bordered table-striped">
						<thead>
							<th>No</th>
							<th>Judul</th>
							<th>Nama Penilai</th>
							<th>Total Bobot</th>
							<th>Total Skor</th>
							<th>Total Nilai</th>
							<th>Tanggal Penilaian</th>
							<th data-priority="1">Action</th>
						</thead>
						<tbody>
							<?php foreach ($penilaian as $key => $d) : ?>
								<tr>
									<td><?= $key + 1 ?></td>
									<td><?= $d->judul ?></td>
									<td><?= $d->nama ?></td>
									<td><?= $d->total_bobot ?></td>
									<td><?= $d->total_skor ?></td>
									<td><?= $d->total_nilai ?></td>
									<td><?= date_readable($d->created_at) ?></td>
									<td>
										<a href="<?= 'penilaian/detail/' . $d->id ?>" class="btn btn-sm btn-info m-1">Detail</a>
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
		$('#penilaian_menu').addClass('active')

		$("#table").DataTable({
			"responsive": true,
			"autoWidth": false,
		})
	})
</script>
