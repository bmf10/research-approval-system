<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<span class="inline-block align-middle">
						Informasi Penelitian
					</span>
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
		<?php include 'penilaian.php' ?>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#penilaian_menu').addClass('active')
	})
</script>
