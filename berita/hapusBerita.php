<?php
include "koneksi.php";

mysqli_query($koneksi,"DELETE from tbberita where nomor='$_GET[kdhapus]'");
?>

<script>document.location='tampilBerita.php'</script>