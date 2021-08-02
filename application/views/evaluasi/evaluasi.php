<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<span class="inline-block align-middle">
				Evaluasi
			</span>
			<?php if ($evaluasi) : ?>
				<a target="_blank" href="<?= base_url('penelitian/export_pdf/' . $evaluasi->id_penelitian)  ?>" type="button" class="btn btn-success btn-sm mr-2  float-right">
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
