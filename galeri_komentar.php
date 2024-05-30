<?php 
$id =$_GET['id'];
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
                                    <td><?php echo $data['judul']; ?></td>
                                </tr>
                                <tr>
                                    <td>Deskripsi</td>
                                    <td>:</td>
                                    <td><?php echo $data['deskripsi']; ?></td>
                                </tr>
                                <tr>
                                    <td>Album</td>
                                    <td>:</td>
                                    <td>
                                        <select name="id_album" disabled class="form-select form-control">
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
                                    <td><?php echo $data['tanggal']; ?></td>
                                </tr>
                                <tr>
                                    <td>Gambar</td>
                                    <td>:</td>
                                    <td>
                                        <a href="gambar/<?php echo $data['gambar']; ?>" target="_blank">
                                            <img src="gambar/<?php echo $data['gambar']; ?>" width="200" alt="gambar">
                                        </a>
                                    </td>
                                </tr>
                            </table>                            

                        </form>

                        <h1 class="mt-4">Komentar</h1>
                        <?php
                            if (isset($_POST['komentar'])) {
                                $komentar = $_POST['komentar'];
                                $tanggal = date('Y/m/d');
                                $id_user = $_SESSION['user']['id_user'];

                                $query = mysqli_query($koneksi, "INSERT INTO komentar(id_foto,id_user,komentar,tanggal) VALUES('$id','$id_user','$komentar','$tanggal')");

                                if ($query) {
                                    echo '<script>alert("Tambah komentar berhasil");</script>';
                                } else {
                                    echo '<script>alert("Tambah komentar gagal")</script>';
                                }
                                
                            }

                            $query = mysqli_query($koneksi, "SELECT * FROM komentar left join user on user.id_user = komentar.id_user where id_foto=$id");
                            while($data = mysqli_fetch_array($query)) {
                            ?>
                            <div class="card mb-2">
                                <div class="card-header bg-primary"><?php echo $data['nama_lengkap'] . '('.$data['tanggal']. ')'; ?></div>
                                <div class="card-body"><?php echo $data['komentar']; ?></div>
                            </div>
                            <?php
                            }

                      
                            
                        ?>

                        <form method="post">
                            <hr />
                            <label>Masukkan Komentar Baru</label>
                            <textarea name="komentar" rows="5" class="form-control mb-2"></textarea>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                    