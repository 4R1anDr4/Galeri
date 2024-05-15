<?php 
$id = $_GET['id'];

$query = mysqli_query($koneksi, "DELETE FROM foto WHERE id_foto=$id");

if ($query) {
    echo '<script>alert("Hapus data berhasil"); location.href="?page=galeri";</script>';
}else{
    echo '<script>alert("Hapus data gagal")</script>';
}

?>