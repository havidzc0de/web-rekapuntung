<?php 

include "config/koneksi.php";

	// $query = "SELECT * FROM data where kd_barang = 'BJ01' ";
	// $kirim = mysqli_query($koneksi,$query);
	// $show_data = mysqli_fetch_array($kirim);

	// $total_jual = $show_data['harga_jual']*3;
	// $total_beli = $show_data['harga_beli']*3;

	// $untung = $total_jual-$total_beli;

	// echo $untung;




$query = "SELECT SUM(total_harga) FROM data_harian";
$ambil = mysqli_query($koneksi,$query);
$data =  mysqli_fetch_array($ambil);

$harga = $data['SUM(total_harga)'];

echo $harga;










 ?>