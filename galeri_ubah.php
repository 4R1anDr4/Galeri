<?php 
$id =$_GET['id'];
if (isset($_POST['judul'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $id_album = $_POST['id_album'];
    $tanggal = $_POST['tanggal'];
    $id_user = $_SESSION['user']['id_user'];

    $query = mysqli_query($koneksi, "UPDATE foto set judul='$judul', deskripsi='$deskripsi', id_album='$id_album', tanggal='$tanggal', id_user='$id_user' WHERE id_foto=$id");

    $gambar = $_FILES['gambar'];

    if ($gambar['name'] != "") {
        $nama_gambar = $gambar['name'];
        $file_tmp = $gambar['tmp_name'];
        $file_destination = 'gambar/' . $nama_gambar;
        if (move_uploaded_file($file_tmp, $file_destination)) {
            $query = mysqli_query($koneksi, "UPDATE foto set gambar='$nama_gambar' WHERE id_foto=$id");
        }
    }

    

        if ($query) {
            echo '<script>alert("Ubah data berhasil");</script>';
        } else {
            echo '<script>alert("Ubah data gagal")</script>';
        }
    
}

$query = mysqli_query($koneksi, "SELECT*FROM foto WHERE id_foto=$id");
$data = mysqli_fetch_array($query);

?>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Galeri Foto</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Galeri Foto</li>
                        </ol>
                        <a href="?page=galeri" class="btn btn-danger">Kembali</a>
                        <form method="post" enctype="multipart/form-data">
                            <table class="table">
                                <tr>
                                    <td width="200">Judul</td>
                                    <td width="1">:</td>
                                    <td><input type="text" name="judul" value="<?php echo $data['judul']; ?>" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Deskripsi</td>
                                    <td>:</td>
                                    <td><input type="text" name="deskripsi" value="<?php echo $data['deskripsi']; ?>" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Album</td>
                                    <td>:</td>
                                    <td>
                                        <select name="id_album" class="form-select form-control">
                                            <?php 
                                                $al = mysqli_query($koneksi, "SELECT*FROM album");
                                                while($album = mysqli_fetch_array($al)){
                                                    ?>
                                                    <option 

                                                    <?php 
                                                        if($data['id_album'] == $album['id_album']) echo 'selected';
                                                    ?>
                                                    
                                                    value="<?php echo $album['id_album']; ?>"><?php echo $album['nama_album']; ?></option>
                                                    <?php 
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>:</td>
                                    <td><input type="date" name="tanggal" value="<?php echo $data['tanggal']; ?>" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Gambar</td>
                                    <td>:</td>
                                    <td>
                                        <input type="file" name="gambar" class="form-control">
                                        <a href="gambar/<?php echo $data['gambar']; ?>" target="_blank">
                                            <img src="gambar/<?php echo $data['gambar']; ?>" width="200" alt="gambar">
                                        </a>
                                        <br>
                                        <i class="text-danger">*Jika tidak diganti, kosongkan saja.</i>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <button type="reset" class="btn btn-danger">Reset</button>
                                    </td>
                                </tr>
                            </table>                            

                        </form>

                    </div>