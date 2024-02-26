<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Landing</title>
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
            <a class="navbar-brand" href="#">Halaman Landing</a>
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
        <h1>Halaman Landing</h1>
        <!-- Table -->
        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Foto</th>
                        <th>Uploader</th>
                        <th>Jumlah Like</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include "koneksi.php";
                        $sql=mysqli_query($conn,"select * from foto,user where foto.userid=user.userid");
                        $nomor = 1;
                        while($data=mysqli_fetch_array($sql)){
                    ?>
                        <tr>
                            <td><?=$nomor++?></td>
                            <td><?=$data['judulfoto']?></td>
                            <td><?=$data['deskripsifoto']?></td>
                            <td>
                                <img src="gambar/<?=$data['lokasifile']?>" class="img-fluid" style="max-width: 200px;">
                            </td>
                            <td><?=$data['namalengkap']?></td>
                            <td>
                                <?php
                                    $fotoid=$data['fotoid'];
                                    $sql2=mysqli_query($conn,"select * from likefoto where fotoid='$fotoid'");
                                    echo mysqli_num_rows($sql2);
                                ?>
                            </td>
                            <td>
                                <a href="like.php?fotoid=<?=$data['fotoid']?>" class="btn btn-primary btn-sm">Like</a>
                                <a href="unlike.php?fotoid=<?=$data['fotoid']?>" class="btn btn-danger btn-sm">Unlike</a>
                                <a href="komentar.php?fotoid=<?=$data['fotoid']?>" class="btn btn-secondary btn-sm">Komentar</a>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- End of Table -->
    </div>

    <!-- Bootstrap JS and jQuery (for the navbar toggler) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
