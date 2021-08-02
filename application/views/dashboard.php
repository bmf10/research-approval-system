<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h3><span style="font-weight: bold;">Selamat Datang,</span> <?= get_session('nama') ?></h3>
		</div>
		<?php if (get_role() === 'admin') : ?>
			<div class="col-md-3">
				<div class="small-box bg-info">
					<div class="inner">
						<h3><?= $total_user ?></h3>
						<p>Total User</p>
					</div>
					<div class="icon">
						<i class="fas fa-users"></i>
					</div>
					<a href="user" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
		<?php endif ?>
		<div class="col-md-3">
			<div class="small-box bg-primary">
				<div class="inner">
					<h3><?= $total_penelitian ?></h3>
					<p>Total Penelitian</p>
				</div>
				<div class="icon">
					<i class="fas fa-book"></i>
				</div>
				<a href="penelitian" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="col-md-3">
			<div class="small-box bg-success">
				<div class="inner">
					<h3><?= $total_penilaian ?></h3>
					<p>Total Penilaian</p>
				</div>
				<div class="icon">
					<i class="far fa-edit"></i>
				</div>
				<a href="penilaian" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
	</div>
</div>


<script>
	$(document).ready(function() {
		$('#dashboard_menu').addClass('active')
	})
</script>
