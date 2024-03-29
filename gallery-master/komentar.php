<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Komentar</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        .navbar-custom {
            background-color: #007bff; /* Change this to the desired color */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">Halaman Komentar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <?php
                        session_start();
                        if(!isset($_SESSION['userid'])){
                    ?>
                            <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                            <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <?php
                        }else{
                    ?>   
                            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="album.php">Album</a></li>
                            <li class="nav-item"><a class="nav-link" href="foto.php">Foto</a></li>
                            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>Halaman Komentar</h1>
        <p>Selamat datang, <b><?=$_SESSION['namalengkap']?></b></p>

        <hr>

        <h2 class="mt-4">Tambah Komentar</h2>
        <form action="tambah_komentar.php" method="post">
            <?php
                include "koneksi.php";
                $fotoid=$_GET['fotoid'];
                $sql=mysqli_query($conn,"select * from foto where fotoid='$fotoid'");
                while($data=mysqli_fetch_array($sql)){
            ?>
            <input type="text" name="fotoid" value="<?=$data['fotoid']?>" hidden>
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" class="form-control" id="judul" name="judulfoto" value="<?=$data['judulfoto']?>" readonly>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <input type="text" class="form-control" id="deskripsi" name="deskripsifoto" value="<?=$data['deskripsifoto']?>" readonly>
            </div>
            <div class="form-group">
                <label for="foto">Foto</label>
                <br>
                <img src="gambar/<?=$data['lokasifile']?>" class="img-thumbnail" width="200px" alt="Foto">
            </div>
            <div class="form-group">
                <label for="komentar">Komentar</label>
                <input type="text" class="form-control" id="komentar" name="isikomentar">
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
            <?php
                }
            ?>
        </form>

        <hr>

        <h2 class="mt-4">Daftar Komentar</h2>
        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Komentar</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include "koneksi.php";
                        $userid=$_SESSION['userid'];
                        $sql=mysqli_query($conn,"select * from komentarfoto,user where komentarfoto.userid=user.userid");
                        while($data=mysqli_fetch_array($sql)){
                    ?>
                        <tr>
                            <td><?=$data['komentarid']?></td>
                            <td><?=$data['namalengkap']?></td>
                            <td><?=$data['isikomentar']?></td>
                            <td><?=$data['tanggalkomentar']?></td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
