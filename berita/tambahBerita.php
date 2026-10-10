<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
    <div class="container">
        <h1 class="display-5">Form Tambah Berita</h1>
        <form id="beritaForm" action="simpanBerita.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="" required>
            </div>
            <div class="mb-3">
                <label for="isiberita" class="form-label">Isi Berita</label>
                <textarea class="form-control" id="isi" name="isi" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Unggah Gambar</label>
                <input class="form-control" id="gambar" name="fupload" accept="image/*" type="file" required>
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="penulis" name="penulis" placeholder="" required>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" id="submitBtn" type="submit">Submit</button>
                <button class="btn btn-light" id="resetBtn" type="reset">Reset</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <script>
        document.getElementById("submitBtn").addEventListener("click", function (event) {
            event.preventDefault(); 
            const form = document.getElementById("beritaForm");
            if (form.checkValidity()) {
                Swal.fire({
                    title: "Berhasil!",
                    text: "Berita berhasil dikirim!",
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

        document.getElementById("resetBtn").addEventListener("click", function (event) {
            event.preventDefault(); 
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Semua isian berita akan direset.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, reset!",
                cancelButtonText: "Tidak, batalkan!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("beritaForm").reset();
                    Swal.fire("Reset!", "Berita telah direset.", "success");
                }
            });
        });
    </script>
</body>
</html>
