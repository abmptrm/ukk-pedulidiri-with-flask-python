<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peduli Diri | Login</title>
    <link rel="stylesheet" href="assets/style/login.css">
</head>
<body>
    
    <div class="container">
        <form action="" method="post">
            <center><h1>Log in</h1></center><br>
            <label for="nik"></label>
            <input type="text" name="nik" placeholder="NIK"><br><br>
            <label for="Nama"></label>
            <input type="text" name="nama" placeholder="Nama Lengkap">
            <div class="tombol">
                <button type="submit" name="daftar" id="btn_daftar">Saya Pengguna Baru</button>
                <button type="submit" name="masuk" id="btn_masuk">Masuk</button>
            </div>
        
        </form>
       
        
    </div>
    
</body>
</html>

<?php

    
    if ( isset( $_POST["daftar"] ) ) {
        $nik = md5($_POST['nik']);
        $nama = md5($_POST['nama']);

        include 'config.php';
        $validation = "SELECT*FROM tbuser WHERE nik= '$nik'";
        $query = mysqli_query( $conn, $validation );

        if ( mysqli_num_rows( $query ) == 0 ) {
            $query_regist = mysqli_query( $conn, "INSERT INTO tbuser(nik, nama) VALUES ('$nik', '$nama')" );
            if ( $query_regist ) {
                echo '<script>alert("Registrasi berhasil! Silakan login");</script>';    
            }
        } else {
            echo '<script>alert("Registrasi gagal");</script>';
        }
    }


    // Login 
    if ( isset( $_POST["masuk"] ) ) {
        $nik = md5($_POST['nik']);
        $nama = md5($_POST['nama']);

        include "config.php";
        $query = mysqli_query( $conn, "SELECT * FROM tbuser WHERE nik='$nik' AND nama='$nama'" );
        if ( mysqli_num_rows( $query ) == 0 ) {
            echo '<script>alert("NIK dan Nama belum terdaftar");</script>';
        } else {

            $nik1 = $_POST['nik'];
            $nama1 = $_POST['nama'];

            session_start();
            $_SESSION['nik'] = $nik1;
            $_SESSION['nama'] = $nama1;
            $_SESSION['masuk'] = true;

            header( "location: home.php" );
        }
    }
?>