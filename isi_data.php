<?php
  session_start();
  include "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isi Data</title>
    <link rel="stylesheet" href="assets/style/isidata.css">
</head>
<body>
    <div class="container-data">
        
        <div class="isi-data">
                <form action="" method="POST">

                    <table>
                        <tr>
                            <th ><label for="tanggal">Tanggal</label></th>
                            <th><input type="date" name="tanggal" id="date"></th>
                        </tr>
                        <tr>
                            <th><label for="jam">Jam</label></th>
                            <th><input type="time" name="jam" id="time"></th>
                        </tr>
                        <tr>
                            <th><label for="lokasi">Lokasi yang dikunjungi</label></th>
                            <th><input type="text" name="lokasi" id="lokasi"></th>
                        </tr>
                        <tr>
                            <th><label for="suhu">Suhu</label></th>
                            <th><input type="text" name="suhu" id="suhutubuh"></th>
                        </tr>
                        <tr>
                            <th></th>
                            <th><button style="float: right;" name="simpan" type="submit">Simpan</button></th>
                        </tr>
                        
                    </table>
                    
                </form>
            </div>
        
    </div>
</body>
</html>

<?php

    if ( isset( $_POST['simpan'] ) ) {
        session_start();
        $nik = md5($_SESSION['nik']);
        $tanggal = $_POST['tanggal'];
        $waktu = $_POST['jam'];
        $lokasi = $_POST['lokasi'];
        $suhu = $_POST['suhu'];

        include 'config.php';
        $sql = "INSERT INTO tbperjalanan(nik,tanggal,waktu,lokasi,suhu) VALUES ('$nik','$tanggal','$waktu','$lokasi','$suhu')";
        $query = mysqli_query( $conn, $sql );

        if ( $query ) {
            echo '<script>alert("Data catatan berhasil disimpan!");</script>';
        } else {
            echo '<script>alert("Data catatan tidak tersimpan");</script>';
        }

    }

?>