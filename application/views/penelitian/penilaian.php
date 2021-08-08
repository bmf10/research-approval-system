<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<span class="inline-block align-middle">
				Penilaian
			</span>
			<?php if (get_role() === 'anggota_pme' && count($penilaian) == 0) : ?>
				<button type="button" class="btn btn-primary btn-sm  float-right" data-toggle="modal" data-target="#modal_penilaian">
					Tambah Penilaian
				</button>
			<?php endif ?>
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
							<th>Action</th>
						</thead>
						<tbody>
							<?php foreach ($penilaian as $key => $d) : ?>
								<tr>
									<td><?= $key + 1 ?></td>
									<td style="text-transform: capitalize;"><?= $d->pernyataan ?></td>
									<td><?= $d->bobot ?></td>
									<td><?= $d->skor ?></td>
									<td><?= $d->nilai ?></td>
									<td>
										<?php if (get_role() === 'anggota_pme') : ?>
											<button class="btn btn-sm btn-info mx-1 edit_penilaian" data-id="<?= $d->id ?>">Edit</button>
										<?php endif ?>
									</td>
								</tr>
							<?php endforeach ?>
							<?php if (count($penilaian) > 0) : ?>
								<tr>
									<td></td>
									<td>Total</td>
									<td id="total_bobot_nilai"></td>
									<td id="total_skor_nilai"></td>
									<td id="total_nilai_nilai"></td>
									<td></td>
								</tr>
							<?php endif ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_penilaian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Data Penilaian</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form_penilaian" action="<?= base_url('penilaian') ?>" method="POST" autocomplete="off">
				<input value="<?= $penelitian->id ?>" name="id_penelitian" type="hidden" />
				<div class="modal-body">
					<div id="penilaian_list"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_edit_penilaian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Data Penilaian</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form_edit_penilaian" action="<?= base_url('penilaian/edit') ?>" method="POST" autocomplete="off">
				<div class="modal-body">
					<input type="hidden" id="id_penilaian_edit" name="id">
					<input type="hidden" name="id_penelitian" value="<?= $penelitian->id ?>">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="pernyataan">Penilaian</label>
								<input id="pernyataan_nilai_edit" placeholder="Penilaian" style="text-transform:capitalize" name="pernyataan" class="form-control" required="required" readonly />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="bobot">Bobot %</label>
								<input readonly id="bobot_nilai_edit" min="1" type="number" value="0" max="100" placeholder="Bobot" name="bobot" class="form-control bobot" required="required" />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="skor">Skor</label>
								<input id="skor_nilai_edit" min="1" type="number" value="0" max="100" placeholder="Skor" name="skor" class="form-control skor" required="required" />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="nilai">Nilai</label>
								<input id="nilai_nilai_edit" min="1" type="number" readonly value="0" placeholder="Nilai" name="nilai" class="form-control nilai" required="required" />
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
		count_all_nilai()

		const penilaian = [{
			penilaian: "orientasi pelayanan",
			bobot: 20
		}, {
			penilaian: "komitmen",
			bobot: 30
		}, {
			penilaian: "inisiatif kerja",
			bobot: 25
		}, {
			penilaian: "kerja sama",
			bobot: 15
		}, {
			penilaian: "kepemimpinan",
			bobot: 10
		}]

		let penilaian_html = "<div/>"
		for (let i = 0; i < penilaian.length; i++) {
			penilaian_html += `
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="pernyataan">Penilaian</label>
								<input placeholder="Penilaian" style="text-transform:capitalize" value="${penilaian[i].penilaian}" name="pernyataan[]" class="form-control" required="required" readonly />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="bobot">Bobot %</label>
								<input min="1" type="number" value="${penilaian[i].bobot}" readonly max="100" placeholder="Bobot" name="bobot[]" class="form-control penilaian_bobot" required="required" />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="skor">Skor</label>
								<input min="1" type="number" value="0" max="100" placeholder="Skor" name="skor[]" class="form-control penilaian_skor" required="required" />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="nilai">Nilai</label>
								<input min="1" type="number" readonly value="0" placeholder="Nilai" name="nilai[]" class="form-control penilaian_nilai" required="required" />
							</div>
						</div>
					</div>
					<hr>
				`
		}

		$('#penilaian_list').html(penilaian_html)

		function count_nilai() {
			const bobot_values = $('.penilaian_bobot').map((_, el) => el.value).get()
			const skor_values = $('.penilaian_skor').map((_, el) => el.value).get()
			let nilai_value = $('.penilaian_nilai').map((_, el) => el.value).get()
			for (let i = 0; i < bobot_values.length; i++) {
				nilai_value[i] = skor_values[i] * (bobot_values[i] / 100)
			}

			console.log(nilai_value)

			$('.penilaian_nilai').each(function(index) {
				$(this).val(nilai_value[index])
			})
		}

		$('.penilaian_bobot').change(function() {
			count_nilai()
		})

		$('.penilaian_skor').change(function() {
			count_nilai()
		})

		$('.penilaian_bobot').keyup(function() {
			count_nilai()
		})

		$('.penilaian_skor').keyup(function() {
			count_nilai()
		})

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

		function count_nilai_edit() {
			const bobot_val = $('#bobot_nilai_edit').val()
			const skor_val = $('#skor_nilai_edit').val()
			const nilai_val = skor_val * (bobot_val / 100)

			$('#nilai_nilai_edit').val(nilai_val)
		}


		$('.edit_penilaian').click(function() {
			let data = $(this).data('id')
			$.get({
				url: `<?= base_url('penilaian/get_one/') ?>${data}`,
				success: res => {
					$('#id_penilaian_edit').val(res.id)
					$('#pernyataan_nilai_edit').val(res.pernyataan)
					$('#bobot_nilai_edit').val(res.bobot)
					$('#skor_nilai_edit').val(res.skor)
					$('#nilai_nilai_edit').val(res.nilai)
					$('#modal_edit_penilaian').modal('show')
				},
				error: err => {
					console.log(err)
				}
			})
		})
	})
</script>
