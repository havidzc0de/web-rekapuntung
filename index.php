<?php 
include "config/koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Perhitungan Penjualan Harian</title>
	<link rel="stylesheet" type="text/css" href="../../bootstrap/dist/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
	<style type="text/css">
	.header h1{
		font-family:'Lobster', cursive;
		font-size: 45px;
		text-align: center;
	}
	.total_untung .total{
		background-color: #212529;
		color: white;
	}
	.total_untung .untung{
		background-color: salmon;
		color: white;	
		text-align: center;
		width: 200px;

	}
</style>
</head>
<body>
	<div class="header">
		<div class="col-md-2">
			<a class="btn btn-info" href="tambah-barang.php" target="_blank">Tambah Data Barang</a>
		</div>
		<h1>Perhitungan Penjualan Harian</h1>
	</div>
	<div class="container">

		<form action="tambah-data-harian.php" method="POST">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Kode Barang</label>
				<div class="col-sm-4">
					<input name="kode_barang" class="form-control" type="text" name="kode_barang" placeholder="Kode Barang">
				</div>
				<label class="col-sm-2 col-form-label">Jumlah Barang</label>
				<div class="col-sm-4">
					<input name="jumlah_barang" class="form-control" type="text" name="jumlah_barang" placeholder="Jumlah Barang">
				</div>
				<br><br>
				<div class="col-sm-10"></div>
				<button name="submitbeli" type="submit" class="btn btn-info col-sm-2">Tambah</button>
			</div>
		</form>

		<div class="row">
			<div class="col-md-12 ">

				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead class="table-dark">
							<tr>
								<th>No</th>
								<th>Waktu</th>
								<th>Kode Barang</th>
								<th>Nama Barang</th>
								<th>Jumlah</th>
								<th>Total Harga</th>
								<th>Untung</th>
								<th>Opsi</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							include "config/koneksi.php";

							function torupiah($hasil){
								$jadi ='Rp. ' . number_format($hasil,2,',','.');
								return $jadi;
							}

							$query = "SELECT * FROM data_harian ";
							$show =  mysqli_query($koneksi,$query);
							$no = 1;
							while ($data = mysqli_fetch_array($show)) { ?>

							<tr>
								<td><?= $no++ ; ?></td>
								<td><?= $data['waktu']; ?></td>
								<td><?= $data['kd_barang']; ?></td>
								<td><?= $data['nama_barang']; ?></td>
								<td><?= $data['jumlah'] ?></td>
								<td><?= torupiah($data['total_harga']); ?></td>
								<td><?= torupiah($data['untung']); ?></td>
								<td>
									<a href="edit-data-harian.php?id=<?= $data['id']; ?>">Edit</a> |
									<a href="hapus-data-harian.php?id=<?= $data['id']; ?>">Hapus</a>
								</td>
							</tr>
							<?php } 
							?>
						</tbody>
					</table>
				</div>

				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead class=" total_untung">
							<tr>
								<th class="total">Total Untung</th>

								<th class="untung"><?php
								$query = "SELECT SUM(untung) FROM data_harian";
								$ambil = mysqli_query($koneksi,$query);
								$data =  mysqli_fetch_array($ambil);
								$untung = $data['SUM(untung)'];

								echo torupiah($untung); ?>
							</th>
						</tr>
					</thead>			
				</table>
			</div>
		</div>
	</div>
</div>
</body>
</html>

