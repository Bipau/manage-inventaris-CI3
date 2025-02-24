<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>

	<table>
		<thead>
			<tr>
				<th>No</th>
				<th>Foto</th>
				<th>Username</th>
				<th>Nama Petugas</th>
				<th>Level</th>

			</tr>
		</thead>
		<tbody>
			<?php $no = 1;
			foreach ($petugas as $data) : ?>
				<tr>
					<td><?= $no++; ?></td>
					<td>
						<img src="<?= base_url('assets/img/' . $data['foto']); ?>" alt="Foto Petugas" class="avatar-img rounded-circle" width="50" height="50" style="object-fit: cover;">
					</td>
					<td><?= $data['username']; ?></td>
					<td><?= $data['nama_petugas']; ?></td>
					<td><?= $data['nama_level']; ?></td>
				</tr>


			<?php endforeach; ?>
		</tbody>

		<tfoot>
			<tr>
				<th>No</th>
				<th>Foto</th>
				<th>Username</th>
				<th>Nama Petugas</th>
				<th>Level</th>

			</tr>
		</tfoot>
	</table>



	<script type="text/javascript">
		window.print();
	</script>

</body>

</html>
