<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<style>
	.table {
		width: 100%;
		border-collapse: collapse;
		border: 1px solid black;
	}

	.table td,
	.table th {
		border: 1px solid black;
	}
</style>

<body>
	<h3 style="text-align: center;">MONITORING EVALUASI</h3>
	<br><br>
	<table>
		<tr>
			<td style="width: 200px;">Nama Peneliti</td>
			<td>:</td>
			<td><?= $penelitian->nama ?></td>
		</tr>
		<tr>
			<td>Judul</td>
			<td>:</td>
			<td><?= $penelitian->judul ?></td>
		</tr>
		<tr>
			<td>Lokasi</td>
			<td>:</td>
			<td><?= $penelitian->lokasi ?></td>
		</tr>
		<tr>
			<td>Jumlah Anggota</td>
			<td>:</td>
			<td><?= $penelitian->jumlah_anggota ?></td>
		</tr>
		<tr>
			<td>Jumlah Biaya</td>
			<td>:</td>
			<td><?= $penelitian->jumlah_biaya ?></td>
		</tr>
		<tr>
			<td>Tanggal Pelaksanaan</td>
			<td>:</td>
			<td><?= date_readable($penelitian->tanggal_pelaksanaan) ?></td>
		</tr>
		<tr>
			<td>Objek Penelitian</td>
			<td>:</td>
			<td><?= $penelitian->objek_penelitian ?></td>
		</tr>
		<tr>
			<td>Masa Pelaksanaan</td>
			<td>:</td>
			<td><?= $penelitian->masa_pelaksanaan ?></td>
		</tr>
		<tr>
			<td>Target Temuan</td>
			<td>:</td>
			<td><?= $penelitian->target_temuan ?></td>
		</tr>
		<tr>
			<td>Abstrak</td>
			<td>:</td>
			<td><?= $penelitian->abstrak ?></td>
		</tr>
	</table>
	<br>
	<table class="table">
		<thead>
			<tr>
				<th>No</th>
				<th>Kriteria Penilaian</th>
				<th>Bobot</th>
				<th>Skor</th>
				<th>Nilai</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($pernyataan as $key => $d) : ?>
				<tr>
					<td style="text-align:center"><?= $key + 1 ?></td>
					<td style="text-transform: capitalize;"><?= $d->pernyataan ?></td>
					<td style="text-align:center"><?= $d->bobot ?></td>
					<td style="text-align:center"><?= $d->skor ?></td>
					<td style="text-align:center"><?= $d->nilai ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="2">Total</th>
				<th><?= $total_bobot ?></th>
				<th><?= $total_skor ?></th>
				<th><?= $total_nilai ?></th>
			</tr>
		</tfoot>
	</table>
	<table>
		<tr>
			<td>
				<p><span style="font-weight: bold;">Keterangan: </span> Skor(1 = Buruk; 2 = Kurang; 3 = Cukup; 4 = Baik; 5 = Sangat Baik);</p>
			</td>
		</tr>
	</table>
	<table>
		<tr>
			<td style="font-weight: bold;">Kriteria</td>
			<td style="width: 30px;">:</td>
			<td>0-150</td>
			<td>=></td>
			<td>Tidak diterima</td>
		</tr>
		<tr>
			<td style="font-weight: bold;"></td>
			<td></td>
			<td>151-300</td>
			<td>=></td>
			<td>Diterima dgn dana tidak penuh</td>
		</tr>
		<tr>
			<td style="font-weight: bold;"></td>
			<td></td>
			<td>301-400</td>
			<td>=></td>
			<td>Diterima dgn dana tidak penuh</td>
		</tr>
		<tr>
			<td style="font-weight: bold;"></td>
			<td></td>
			<td>401-450</td>
			<td>=></td>
			<td>Diterima dgn dana tidak penuh</td>
		</tr>
		<tr>
			<td style="font-weight: bold;"></td>
			<td></td>
			<td>451-500</td>
			<td>=></td>
			<td>Diterima dgn dana penuh (sesuai usulan)</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td style="font-weight: bold;">Komentar</td>
			<td>:</td>
			<td><?= $evaluasi->komentar ?></td>
		</tr>
	</table>
</body>

</html>