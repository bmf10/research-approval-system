<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<span class="inline-block align-middle">
				Penilaian
			</span>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="judul">Nama Penilai</label>
						<input placeholder="Belum ada data" value="<?= count($penilaian) > 0 ? $penilaian[0]->nama : null ?>" class="form-control-plaintext" readonly required="required" />
					</div>
				</div>
				<div class="col-md-12">
					<table id="table" class="table table-bordered table-striped">
						<thead>
							<th>No</th>
							<th>Penilaian</th>
							<th>Bobot % </th>
							<th>Skor</th>
							<th>Nilai</th>
						</thead>
						<tbody>
							<?php foreach ($penilaian as $key => $d) : ?>
								<tr>
									<td><?= $key + 1 ?></td>
									<td style="text-transform: capitalize;"><?= $d->pernyataan ?></td>
									<td><?= $d->bobot ?></td>
									<td><?= $d->skor ?></td>
									<td><?= $d->nilai ?></td>
								</tr>
							<?php endforeach ?>
							<?php if (count($penilaian) > 0) : ?>
								<tr>
									<td></td>
									<td>Total</td>
									<td id="total_bobot_nilai"></td>
									<td id="total_skor_nilai"></td>
									<td id="total_nilai_nilai"></td>
								</tr>
							<?php endif ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		count_all_nilai()

		function count_all_nilai() {
			$.get({
				url: `<?= base_url('penilaian/get_by_penelitian/' . $penelitian->id) ?>`,
				success: res => {
					let total_bobot_nilai = 0
					let total_nilai_nilai = 0
					let total_skor_nilai = 0
					for (let i = 0; i < res.length; i++) {
						total_bobot_nilai = total_bobot_nilai + parseFloat(res[i].bobot)
						total_nilai_nilai = total_nilai_nilai + parseFloat(res[i].nilai)
						total_skor_nilai = total_skor_nilai + parseFloat(res[i].skor)
					}

					$("#total_bobot_nilai").html(total_bobot_nilai)
					$("#total_nilai_nilai").html(total_nilai_nilai)
					$("#total_skor_nilai").html(total_skor_nilai)
				},
				error: err => {
					console.log(err)
				}
			})
		}
	})
</script>
