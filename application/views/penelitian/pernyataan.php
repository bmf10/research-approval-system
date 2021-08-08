<div class="col-md-12">
	<table id="table" class="table table-bordered table-striped">
		<thead>
			<th>No</th>
			<th>Pernyataan</th>
			<th>Bobot % </th>
			<th>Skor</th>
			<th>Nilai</th>
			<th>Action</th>
		</thead>
		<tbody>
			<?php foreach ($pernyataan as $key => $d) : ?>
				<tr>
					<td><?= $key + 1 ?></td>
					<td style="text-transform: capitalize;"><?= $d->pernyataan ?></td>
					<td><?= $d->bobot ?></td>
					<td><?= $d->skor ?></td>
					<td><?= $d->nilai ?></td>
					<td>
						<?php if (get_role() === 'anggota_pme') : ?>
							<button class="btn btn-sm btn-info mx-1 edit_pernyataan" data-id="<?= $d->id ?>">Edit</button>
						<?php endif ?>
					</td>
				</tr>
			<?php endforeach ?>
			<?php if (count($pernyataan) > 0) : ?>
				<tr>
					<td></td>
					<td>Total</td>
					<td id="total_bobot"></td>
					<td id="total_skor"></td>
					<td id="total_nilai"></td>
					<td></td>
				</tr>
			<?php endif ?>
		</tbody>
	</table>
</div>

<div class="modal fade" id="modal_edit_pernyataan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Data Pernyataan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form_edit_pernyataan" action="<?= base_url('pernyataan') ?>" method="POST" autocomplete="off">
				<div class="modal-body">
					<input type="hidden" name="id_penelitian" value="<?= $penelitian->id ?>">
					<input type="hidden" id="id_pernyataan_edit" name="id">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="pernyataan">Pernyataan</label>
								<input id="pernyataan_edit" placeholder="Pernyataan" style="text-transform:capitalize" name="pernyataan" class="form-control" required="required" readonly />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="bobot">Bobot %</label>
								<input readonly id="bobot_edit" min="1" type="number" value="0" max="100" placeholder="Bobot" name="bobot" class="form-control " required="required" />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="skor">Skor</label>
								<input id="skor_edit" min="1" type="number" value="0" max="100" placeholder="Skor" name="skor" class="form-control " required="required" />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="nilai">Nilai</label>
								<input id="nilai_edit" min="1" type="number" readonly value="0" placeholder="Nilai" name="nilai" class="form-control " required="required" />
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
		count_all()

		$('.edit_pernyataan').click(function() {
			let data = $(this).data('id')
			$.get({
				url: `<?= base_url('pernyataan/get_one/') ?>${data}`,
				success: res => {
					$('#id_pernyataan_edit').val(res.id)
					$('#pernyataan_edit').val(res.pernyataan)
					$('#bobot_edit').val(res.bobot)
					$('#skor_edit').val(res.skor)
					$('#nilai_edit').val(res.nilai)
					$('#modal_edit_pernyataan').modal('show')
				},
				error: err => {
					console.log(err)
				}
			})
		})

		function count_pernyataan_edit() {
			const bobot_val = $('#bobot_edit').val()
			const skor_val = $('#skor_edit').val()
			const nilai_val = skor_val * (bobot_val / 100)


			$('#nilai_edit').val(nilai_val)
		}

		$('#bobot_edit').change(function() {
			count_pernyataan_edit()
		})

		$('#skor_edit').change(function() {
			count_pernyataan_edit()
		})

		$('#bobot_edit').keyup(function() {
			count_pernyataan_edit()
		})

		$('#skor_edit').keyup(function() {
			count_pernyataan_edit()
		})

		$('#modal_edit_pernyataan').on('hidden.bs.modal', function(e) {
			$('#id').val('')
			$('#form_edit_pernyataan').trigger('reset')
		})

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
