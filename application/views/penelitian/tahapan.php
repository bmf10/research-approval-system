<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<span class="inline-block align-middle">
				Tahapan
			</span>
			<?php if (get_role() === 'peneliti') : ?>
				<button type="button" class="btn btn-primary btn-sm  float-right" data-toggle="modal" data-target="#modal_tahapan">
					Tambah tahapan
				</button>
			<?php endif ?>
		</div>
		<div class="card-body">
			<table id="table" class="table table-bordered table-striped">
				<thead>
					<th>No</th>
					<th>File</th>
					<th>Status</th>
					<th>Keterangan</th>
					<th>Tanggal Upload</th>
					<th>Action</th>
				</thead>
				<tbody>
					<?php foreach ($tahapan as $key => $d) : ?>
						<tr>
							<td><?= $key + 1 ?></td>
							<td><a target="_blank" href="<?= base_url('upload/') . $d->file ?>">Download</a></td>
							<td><?= $d->status ?></td>
							<td><?= $d->keterangan ?></td>
							<td><?= date_readable($d->created_at) ?></td>
							<td>
								<?php if (get_role() === 'peneliti') : ?>
									<a onclick="return confirm('Anda yakin akan menghapus data ini?')" href="<?= base_url('penelitian/delete_tahapan/' . $d->id . '/' . $penelitian->id) ?>" class="btn btn-sm btn-danger">Delete</a>
								<?php endif ?>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_tahapan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Data Tahapan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form_tahapan" enctype="multipart/form-data" action="<?= base_url('penelitian/tahapan') ?>" method="POST" autocomplete="off">
				<div class="modal-body">
					<input type="hidden" name="id_penelitian" value="<?= $penelitian->id ?>" />
					<div class="form-group">
						<label for="file">File</label>
						<input id="file" placeholder="File" style="height: 100%" name="document_upload" class="form-control" required="required" type="file" />
						<span id="textHelpBlock" class="form-text text-muted text-sm">Hanya Doc, Docx, atau PDF yang dapat diupload</span>
					</div>
					<div class="form-group">
						<label for="status">Status</label>
						<input id="status" placeholder="Status" name="status" class="form-control" required="required" />
					</div>
					<div class="form-group">
						<label for="keterangan">Keterangan</label>
						<textarea id="keterangan" placeholder="Keterangan" name="keterangan" class="form-control" required="required"></textarea>
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
