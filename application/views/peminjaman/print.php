	<!DOCTYPE html>
	<html lang="id">
	<head>
		<meta charset="UTF-8">
		<title><?= $title ?></title>
		<style>
			body {
				font-family: Arial, sans-serif;
				margin: 30px;
			}
			.header {
				text-align: center;
				margin-bottom: 20px;
			}
			.company-name {
				font-size: 24px;
				font-weight: bold;
			}
			.report-title {
				font-size: 18px;
				margin: 10px 0;
			}
			table {
				width: 100%;
				border-collapse: collapse;
				margin-top: 20px;
			}
			th, td {
				border: 1px solid #000;
				padding: 8px;
				text-align: left;
			}
			th {
				background-color: #f5f5f5;
			}
			.footer {
				margin-top: 30px;
				text-align: right;
			}
			.signature {
				margin-top: 50px;
			}
			img {
				max-width: 100px;
				height: auto;
			}
		</style>
	</head>
	<body>
		<div class="header">
			<div class="company-name">NAMA PERUSAHAAN</div>
			<div class="report-title">LAPORAN PEMINJAMAN DAN PENGEMBALIAN</div>
			<div>Tanggal Cetak: <?= $tanggal_cetak ?></div>
		</div>
		<table>
			<thead>
				<tr>
					<th>No</th>
					<th>ID Peminjaman</th>
					<th>Tanggal Pinjam</th>
					<th>Tanggal Kembali</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1; foreach ($peminjaman as $p): ?>
				<tr>
					<td><?= $no++ ?></td>
					<td><?= $p->id_peminjaman ?></td>
					<td><?= date('d-m-Y', strtotime($p->tanggal_pinjam)) ?></td>
					<td><?= date('d-m-Y', strtotime($p->tanggal_kembali)) ?></td>
					<td><?= $p->status_peminjaman ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<div class="footer">
			<div>Jakarta, <?= date('d F Y') ?></div>
			<div class="signature">
				<div>Mengetahui,</div>
				<div style="margin-top: 50px;">(_________________)</div>
				<div>Kepala Bagian</div>
			</div>
		</div>
	</body>
	</html>
