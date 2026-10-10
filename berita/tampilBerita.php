<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampil Berita</title>
    <!-- bootstrap CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
    
<?php 
    include "koneksi.php";
    $sql = mysqli_query($koneksi,"SELECT * FROM tbberita order by nomor asc");
?>

<div class="container">
    <h1 class="display-5">DAFTAR BERITA</h1>
    <p>Berikut ini adalah daftar berita yang paling populer.</p>

    <input type="button" value="Add Berita" onClick="document.location='tambahBerita.php'" class="btn btn-primary btn-sm"><br><br>
    
    <div class="table-responsive-sm">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Berita</th>
                    <th>Isi Berita</th>
                    <th>Gambar</th>
                    <th>Penulis</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <?php 
                $i=1;
                while ($data=mysqli_fetch_array($sql)) {
            ?>
                <tbody>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $data['judul']?></td>
                        <td><?php echo $data['isiberita']?></td>
                        <td><?php echo "<img src='foto_berita/$data[gambar]' width=100 height=100>"?></td>
                        <td><?php echo $data['penulis']?></td>
                        
                        <td width="20%">
                            <button class="btn btn-outline-warning btn-sm" onclick="editBerita('<?php echo $data['nomor'];?>')">Edit</button>
                            <button class="btn btn-outline-danger btn-sm" onclick="hapusBerita('<?php echo $data['nomor'];?>')">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            <?php
               $i++; }
            ?>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<script>
    function editBerita(id) {
        Swal.fire({
            title: "Edit Berita",
            text: "Apakah Anda yakin ingin mengedit berita ini?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Ya, edit!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.location = `editBerita.php?kdberita=${id}`;
            }
        });
    }

    function hapusBerita(id) {
        Swal.fire({
            title: "Hapus Berita",
            text: "Apakah Anda yakin ingin menghapus berita ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.location = `hapusBerita.php?kdhapus=${id}`;
            }
        });
    }
</script>

</body>
</html>
