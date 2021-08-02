<div class="col-md-12">
	<table id="table" class="table table-bordered table-striped">
		<thead>
			<th>No</th>
			<th>Pernyataan</th>
			<th>Bobot % </th>
			<th>Skor</th>
			<th>Nilai</th>
		</thead>
		<tbody>
			<?php foreach ($pernyataan as $key => $d) : ?>
				<tr>
					<td><?= $key + 1 ?></td>
					<td style="text-transform: capitalize;"><?= $d->pernyataan ?></td>
					<td><?= $d->bobot ?></td>
					<td><?= $d->skor ?></td>
					<td><?= $d->nilai ?></td>
				</tr>
			<?php endforeach ?>
			<?php if (count($pernyataan) > 0) : ?>
				<tr>
					<td></td>
					<td>Total</td>
					<td id="total_bobot"></td>
					<td id="total_skor"></td>
					<td id="total_nilai"></td>
				</tr>
			<?php endif ?>
		</tbody>
	</table>
</div>

<script>
	$(document).ready(function() {
		count_all()

		function count_all() {
			const evaluasi_id = "<?= $evaluasi ? $evaluasi->id : 'empty' ?>"
			if (evaluasi_id !== 'empty') {
				$.get({
					url: `<?= base_url('pernyataan/get_by_evaluasi/') ?>${evaluasi_id}`,
					success: res => {
						let total_bobot = 0
						let total_nilai = 0
						let total_skor = 0
						for (let i = 0; i < res.length; i++) {
							total_bobot = total_bobot + parseFloat(res[i].bobot)
							total_nilai = total_nilai + parseFloat(res[i].nilai)
							total_skor = total_skor + parseFloat(res[i].skor)
						}

						$("#total_bobot").html(total_bobot)
						$("#total_nilai").html(total_nilai)
						$("#total_skor").html(total_skor)
					},
					error: err => {
						console.log(err)
					}
				})
			}
		}
	})
</script>
