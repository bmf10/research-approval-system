<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<span class="inline-block align-middle">
				Evaluasi
			</span>
			<?php if (get_role() === 'anggota_pme' && !$evaluasi) : ?>
				<button type="button" class="btn btn-primary btn-sm  float-right" data-toggle="modal" data-target="#modal_evaluasi">
					Tambah Evaluasi
				</button>
			<?php endif ?>
			<?php if (get_role() === 'anggota_pme' && $evaluasi) : ?>
				<button type="button" id="edit_evaluasi" class="btn btn-primary btn-sm  float-right" data-toggle="modal" data-target="#modal_evaluasi_edit">
					Edit Evaluasi
				</button>
			<?php endif ?>
			<?php if ($evaluasi) : ?>
				<a target="_blank" href="<?= base_url('penelitian/export_pdf/' . $penelitian->id)  ?>" type="button" class="btn btn-success btn-sm mr-2  float-right">
					Export PDF
				</a>
			<?php endif ?>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="judul">Nama Pemeriksa</label>
						<input placeholder="Belum ada data" value="<?= $evaluasi ? $evaluasi->nama : null ?>" class="form-control-plaintext" readonly required="required" />
					</div>
					<div class="form-group">
						<label>Tanggal Pemeriksaan</label>
						<input placeholder="Belum ada data" value="<?= $evaluasi ? date_readable($evaluasi->created_at) : null ?>" class="form-control-plaintext" readonly required="required" />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Status</label>
						<input style="text-transform:capitalize" placeholder="Belum ada data" value="<?= $evaluasi ? $evaluasi->status : null ?>" class="form-control-plaintext" readonly required="required" />
					</div>
					<div class="form-group">
						<label>Komentar</label>
						<input placeholder="Belum ada data" value="<?= $evaluasi ? $evaluasi->komentar : null ?>" class="form-control-plaintext" readonly required="required" />
					</div>
				</div>
				<?php include 'pernyataan.php' ?>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_evaluasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Data Evaluasi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form_evaluasi" action="<?= base_url('evaluasi') ?>" method="POST" autocomplete="off">
				<input value="<?= $penelitian->id ?>" name="id_penelitian" type="hidden" />
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="status">Status</label>
								<select style="text-transform:capitalize" name="status" class="custom-select" required="required">
									<option value="">Pilih Status</option>
									<option style="text-transform:capitalize" value="diajukan menunggu validasi">diajukan menunggu validasi</option>
									<option style="text-transform:capitalize" value="divalidasi dan disetujuin">divalidasi dan disetujuin</option>
									<option style="text-transform:capitalize" value="divalidasi dan tidak disetujui">divalidasi dan tidak disetujui</option>
									<option style="text-transform:capitalize" value="divalidasi dan ditetapkan">divalidasi dan ditetapkan</option>
								</select> </div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="komentar">Komentar</label>
								<textarea id="komentar" placeholder="Komentar" name="komentar" class="form-control" required="required"></textarea>
							</div>
						</div>
					</div>
					<hr>
					<div id="pernyataan_list"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_evaluasi_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Data Evaluasi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form_evaluasi_edit" action="<?= base_url('evaluasi/edit') ?>" method="POST" autocomplete="off">
				<input id="id_evaluasi_edit" value="<?= $evaluasi->id ?>" name="id" type="hidden" />
				<input id="id_penelitian_evaluasi_edit" value="<?= $evaluasi->id ?>" name="id_penelitian" type="hidden" />
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="status">Status</label>
								<select id="status_edit" style="text-transform:capitalize" name="status" class="custom-select" required="required">
									<option value="">Pilih Status</option>
									<option style="text-transform:capitalize" value="diajukan menunggu validasi">diajukan menunggu validasi</option>
									<option style="text-transform:capitalize" value="divalidasi dan disetujuin">divalidasi dan disetujuin</option>
									<option style="text-transform:capitalize" value="divalidasi dan tidak disetujui">divalidasi dan tidak disetujui</option>
									<option style="text-transform:capitalize" value="divalidasi dan ditetapkan">divalidasi dan ditetapkan</option>
								</select> </div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="komentar">Komentar</label>
								<textarea id="komentar_edit" placeholder="Komentar" name="komentar" class="form-control" required="required"></textarea>
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
		const pernyataan = [{
			pernyataan: "kesesuaian dengan peraturan",
			bobot: 20
		}, {
			pernyataan: "ketertelusuran dokumen",
			bobot: 10
		}, {
			pernyataan: "penguasaan materi",
			bobot: 10
		}, {
			pernyataan: "sistematika penyajian",
			bobot: 10
		}, {
			pernyataan: "kemampuan penyajian",
			bobot: 10
		}, {
			pernyataan: "ketepatan waktu",
			bobot: 15
		}, {
			pernyataan: "penggunaan metode",
			bobot: 10
		}, {
			pernyataan: "pencapaian tujuan penelitian",
			bobot: 15
		}]

		let html = "<div/>"
		for (let i = 0; i < pernyataan.length; i++) {
			html += `
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="pernyataan">Pernyataan</label>
								<input placeholder="Pernyataan" style="text-transform:capitalize" value="${pernyataan[i].pernyataan}" name="pernyataan[]" class="form-control" required="required" readonly />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="bobot">Bobot %</label>
								<input min="1" type="number"  max="100" placeholder="Bobot" name="bobot[]" value="${pernyataan[i].bobot}" readonly class="form-control bobot" required="required" />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="skor">Skor</label>
								<input min="1" type="number" value="0" max="100" placeholder="Skor" name="skor[]" class="form-control skor" required="required" />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="nilai">Nilai</label>
								<input min="1" type="number" readonly value="0" placeholder="Nilai" name="nilai[]" class="form-control nilai" required="required" />
							</div>
						</div>
					</div>
					<hr>
				`
		}

		$('#pernyataan_list').html(html)

		function count_nilai() {
			const bobot_values = $('.bobot').map((_, el) => el.value).get()
			const skor_values = $('.skor').map((_, el) => el.value).get()
			let nilai_value = $('.nilai').map((_, el) => el.value).get()
			for (let i = 0; i < bobot_values.length; i++) {
				nilai_value[i] = skor_values[i] * (bobot_values[i] / 100)
			}

			$('.nilai').each(function(index) {
				$(this).val(nilai_value[index])
			})
		}

		$('.bobot').change(function() {
			count_nilai()
		})

		$('.skor').change(function() {
			count_nilai()
		})

		$('.bobot').keyup(function() {
			count_nilai()
		})

		$('.skor').keyup(function() {
			count_nilai()
		})

		$('#modal_evaluasi').on('hidden.bs.modal', function(e) {
			$('#form_evaluasi').trigger('reset')
		})

		$('#edit_evaluasi').click(function() {
			const evaluasi_id = "<?= $evaluasi ? $evaluasi->id : 'empty' ?>"
			if (evaluasi_id !== 'empty') {
				$.get({
					url: `<?= base_url('evaluasi/get_one/') ?>${evaluasi_id}`,
					success: res => {
						$('#id_evaluasi_edit').val(res.id)
						$('#status_edit').val(res.status)
						$('#komentar_edit').val(res.komentar)
						$('#id_penelitian_evaluasi_edit').val(res.id_penelitian)
						$('#modal_evaluasi_edit').modal('show')
					},
					error: err => {
						console.log(err)
					}
				})
			}

		})
	})
</script>
