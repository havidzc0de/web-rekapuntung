
<?php 

include "config/koneksi.php";



if (isset($_POST['submitbeli'])) {

	$waktu = date("l, j-M-Y");	
	$kode_barang = $_POST['kode_barang'];	
	$jumlah = $_POST['jumlah_barang'];

	$query = "SELECT * FROM data where kd_barang = '$kode_barang' ";
	$kirim = mysqli_query($koneksi,$query);
	$show_data = mysqli_fetch_array($kirim);

	$total_jual = $show_data['harga_jual']*$jumlah;
	$total_beli = $show_data['harga_beli']*$jumlah;
	$nama_barang = $show_data['nama_barang'];	

	$untung = $total_jual-$total_beli;

	echo $untung;

	$query = "INSERT INTO data_harian(waktu,kd_barang,nama_barang,jumlah,total_harga,untung)VALUES('$waktu','$kode_barang','$nama_barang','$jumlah','$total_jual','$untung')";
	$add = mysqli_query($koneksi,$query);




	if ($add) { ?>
	<script type="text/javascript">
		alert("Data Berhasil Ditambah");
		document.location.href = "index.php";
	</script>
	<?php }else{ ?>
	<script type="text/javascript">
		alert("Data Gagal Ditambah!");
		document.location.href = "index.php";
	</script>	
	<?php } 

}

?>
