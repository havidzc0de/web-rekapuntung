<?php 

include "config/koneksi.php";

$id = $_GET['id'];

$query = "DELETE  FROM data_harian WHERE id = '$id'";
$hapus = mysqli_query($koneksi,$query);

if ($hapus) {  ?>
	<script type="text/javascript">
		alert("Delete Berhasil");
		document.location.href = "index.php";
	</script>
	<?php }else{ ?>
	<script type="text/javascript">
		alert("Delete Gagal");
		document.location.href = "index.php";
	</script>
	<?php } ?>


 ?>