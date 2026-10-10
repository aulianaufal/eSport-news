<?php
include "koneksi.php";

if (isset($_GET['kdberita'])) {
    $id = intval($_GET['kdberita']);
    $result = mysqli_query($koneksi, "SELECT * FROM tbberita WHERE nomor = $id");
    $data = mysqli_fetch_assoc($result) or die("Data tidak ditemukan!");
} else {
    die("ID tidak diberikan.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $isi = mysqli_real_escape_string($koneksi, $_POST['isi']);
    $penulis = mysqli_real_escape_string($koneksi, $_POST['penulis']);

    if (!empty($_FILES['fupload']['name'])) {
        $gambar = $_FILES['fupload']['name'];
        move_uploaded_file($_FILES['fupload']['tmp_name'], "foto_berita/" . $gambar);
        $query = "UPDATE tbberita SET judul='$judul', isiberita='$isi', gambar='$gambar', penulis='$penulis' WHERE nomor=$id";
    } else {
        $query = "UPDATE tbberita SET judul='$judul', isiberita='$isi', penulis='$penulis' WHERE nomor=$id";
    }

    if (mysqli_query($koneksi, $query)) {
        header("Location: tampilBerita.php"); 
        exit();
    } else {
        die("Gagal memperbarui data: " . mysqli_error($koneksi));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
<div class="container">
    <h1 class="display-5">Form Edit Berita</h1>
    <form id="editBeritaForm" action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" value="<?php echo htmlspecialchars($data['judul']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="isi" class="form-label">Isi Berita</label>
            <textarea class="form-control" id="isi" name="isi" rows="3" required><?php echo htmlspecialchars($data['isiberita']); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Unggah Gambar (Kosongkan jika tidak ingin mengubah)</label>
            <input class="form-control" id="gambar" name="fupload" accept="image/*" type="file">
            <small class="text-muted">Gambar saat ini: <?php echo $data['gambar']; ?></small>
        </div>
        <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" class="form-control" id="penulis" name="penulis" value="<?php echo htmlspecialchars($data['penulis']); ?>" required>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" id="submitBtn" type="submit">Simpan Perubahan</button>
            <a href="tampilBerita.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<script>
    document.getElementById("submitBtn").addEventListener("click", function (event) {
        event.preventDefault();
        const form = document.getElementById("editBeritaForm");
        if (form.checkValidity()) {
            Swal.fire({
                title: "Berhasil!",
                text: "Perubahan berhasil disimpan!",
                icon: "success"
            }).then(() => {
                form.submit();
            });
        } else {
            Swal.fire({
                title: "Error!",
                text: "Harap isi semua field dengan benar!",
                icon: "error"
            });
        }
    });
</script>
</body>
</html>
