<?php 
include "config/koneksi.php";

$id = $_GET['id'];

function torupiah($hasil){
	$jadi ='Rp. ' . number_format($hasil,2,',','.');
	return $jadi;
}



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
	.jumlah_untung{
		font-family: sans-serif;
		font-size: 20px;
		text-align: center;
		background-color: #212529;
		color: white;
	}
	.jumlah_untung p{
		margin: 5px 0;
	}
	.isi_jumlah_untung{
		font-family: sans-serif;
		font-size: 20px;
		text-align: center;
		background-color: salmon;
		color: white;
	}
	.isi_jumlah_untung p{
		margin: 5px 0;
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
					<input name="kode_barang" class="form-control" type="text">
				</div>
				<label class="col-sm-2 col-form-label">Jumlah Barang</label>
				<div class="col-sm-4">
					<input name="jumlah_barang" class="form-control" type="text">
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
								<td>
								<form method="POST">
									<input class="form-control" type="text" name="total_edit" placeholder="<?= $data['total_harga']; ?>">
							

								</td>
								<td><?= torupiah($data['untung']); ?></td>
								>
									<td>
										<button name="konfirmasi" type="submit" class="btn btn-info">Konfirmasi</button>
									</td>
								</form>
								
							</tr>
							<?php } 
							?>
						</tbody>
					</table>
				</div>
				<div class="row">
					<div class="col-sm-10 jumlah_untung">
						<p>Jumlah Untung</p>
					</div>
					<div class="col-sm-2 isi_jumlah_untung">
						<p>
							<?php
							$query = "SELECT SUM(untung) FROM data_harian";
							$ambil = mysqli_query($koneksi,$query);
							$data =  mysqli_fetch_array($ambil);
							$untung = $data['SUM(untung)'];

							echo torupiah($untung); ?>

						</p>
					</div>

				</div>
			</div>


		</div>



	</div>
</body>
</html>



<?php 

$query = "SELECT * FROM data_harian where id='$id'  ";
$show =  mysqli_query($koneksi,$query);
$data = mysqli_fetch_array($show);

if (isset($_POST['konfirmasi'])) {

	$waktu = date("l, j-M-Y");	
	$kode_barang = $data['kd_barang'];	
	$jumlah = $data['jumlah'];

	$query = "SELECT * FROM data where kd_barang = '$kode_barang' ";
	$kirim = mysqli_query($koneksi,$query);
	$show_data = mysqli_fetch_array($kirim);

	$total_jual = $_POST['total_edit'];
	$total_beli = $show_data['harga_beli']*$jumlah;
	$nama_barang = $data['nama_barang'];	

	$untung = $total_jual-$total_beli;

	echo $untung;

	$query = "UPDATE data_harian SET waktu='$waktu',kd_barang='$kode_barang' ,nama_barang='$nama_barang' ,jumlah='$jumlah' ,total_harga='$total_jual' ,untung='$untung' where id='$id'";
	$add = mysqli_query($koneksi,$query);




	if ($add) { ?>
	<script type="text/javascript">
		alert("Data Berhasil Diedit");
		document.location.href = "index.php";
	</script>
	<?php }else{ ?>
	<script type="text/javascript">
		alert("Data Gagal Diedit!");
		document.location.href = "index.php";
	</script>	
	<?php } 

}

 ?>
