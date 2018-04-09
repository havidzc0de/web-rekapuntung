<?php 

include "config/koneksi.php";

$id = $_GET['id'];

$query = "DELETE FROM data WHERE id='$id'";
$hapus = mysqli_query($koneksi,$query);

if ($hapus) { ?>
	<script type="text/javascript">
		alert("Data Berhasil Dihapus");
		document.location.href="tambah-barang.php";
	</script>

	<?php }else { ?>
	<script type="text/javascript">
		alert("Data Gagal Dihapus!");
		document.location.href="tambah-barang.php";
	</script>

	<?php }


 ?>