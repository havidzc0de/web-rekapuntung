<!DOCTYPE html>
<html>
<head>
	<title>Tambah Barang</title>
	<link rel="stylesheet" type="text/css" href="../../bootstrap/dist/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
	<style type="text/css">
	.header h1{
		font-family:'Lobster', cursive;
		font-size: 45px;
		text-align: center;
	}
</style>
</head>
<body>
	<div class="header">
		<h1>Tambah Data Barang</h1>
	</div>
	
	<div class="container container-fluid">
		<div class="col-md-2">
			<a class="btn btn-info" href="index.php">HOME</a>
		</div>
		<form method="POST">

			<div class="form-group row">
				<label for="colFormLabel" class="col-sm-2 col-form-label">Kode Barang</label>
				<div class="col-sm-10">
					<input name="kode_barang" type="text" class="form-control" placeholder="Kode Barang">
				</div>
			</div>
			<div class="form-group row">
				<label for="colFormLabel" class="col-sm-2 col-form-label">Nama Barang</label>
				<div class="col-sm-10">
					<input name="nama_barang" type="text" class="form-control" placeholder="Nama Barang">
				</div>
			</div>
			<div class="form-group row">
				<label for="colFormLabel" class="col-sm-2 col-form-label">Harga Beli</label>
				<div class="col-sm-10">
					<input name="harga_beli" type="text" class="form-control" placeholder="Harga Beli">
				</div>
			</div>
			<div class="form-group row">
				<label for="colFormLabel" class="col-sm-2 col-form-label">Harga Jual</label>
				<div class="col-sm-10">
					<input name="harga_jual" type="text" class="form-control" placeholder="Harga Jual">
				</div>
			</div>

			<div class="form-group row">
				<dic class="col-sm-10"></dic>
				<div class="col-sm-2">
					<button name="submit" type="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</form>

		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead class="table-dark">
					<tr>
						<th>No</th>
						<th>Kode Barang</th>
						<th>Nama Barang</th>
						<th>Harga Beli</th>
						<th>Harga Jual</th>
						<th>Opsi</th>

					</tr>
				</thead>
				<tbody>
					<?php 
					include "config/koneksi.php";

					function torupiah($hasil){
						$jadi = "Rp. ". number_format($hasil,2,',','.');
						return $jadi;
					}


					$query = "SELECT * FROM data ";
					$show =  mysqli_query($koneksi,$query);
					$no = 1;
					while ($data = mysqli_fetch_array($show)) { ?>

					<tr>
						<td><?= $no++ ; ?></td>
						<td><?= $data['kd_barang']; ?></td>
						<td><?= $data['nama_barang']; ?></td>
						<td><?= torupiah($data['harga_beli']); ?></td>
						<td><?= torupiah($data['harga_jual']); ?></td>
						<td>
							<a href="#edit.php?id=<?= $data['id']; ?>" target="_blank">Edit</a> |
							<a href="hapus-barang.php?id=<?= $data['id']; ?>">Hapus</a>
						</td>
					</tr>
					<?php } 
					?>
				</tbody>
			</table>
		</div>



	</div>
</body>
</html>


<?php 

include "config/koneksi.php";

if (isset($_POST['submit'])) {
	$kode_barang = $_POST['kode_barang'];
	$nama_barang = $_POST['nama_barang'];
	$harga_beli = $_POST['harga_beli'];
	$harga_jual = $_POST['harga_jual'];


	$query = "INSERT INTO data(kd_barang,nama_barang,harga_beli,harga_jual)VALUES('$kode_barang','$nama_barang','$harga_beli','$harga_jual')";

	$tambah = mysqli_query($koneksi,$query);

	if ($tambah) { ?>
	<script type="text/javascript">
		alert("Data Berhasil Ditambah");
		document.location.href = "tambah-barang.php";
	</script>
	<?php }else{ ?>
	<script type="text/javascript">
		alert("Data Gagal Ditambah!");
		document.location.href = "tambah-barang.php";
	</script>	
	<?php } 



}

?>