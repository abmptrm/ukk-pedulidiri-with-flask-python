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
    <link rel="stylesheet" href="assets/style/catatan.css">
    <title>Catatan Perjalanan</title>
</head>
<body>
    <div class="container-catatan">
        <div class="urutkan">
        <h4>Urutkan Berdasarkan Tanggal : 
        <select id="urut" onclick="urutkan(this)" style="margin-left: 5px; margin-right: 5px;">
            <option value="0">Tanggal</option>
            <option value="1">Waktu</option>
            <option value="2">Lokasi</option>
            <option value="3">Suhu</option>
        </select>
        </h4>
    </div>
    <div class="table-data">
        <table align="center" border="1" width="95%" style="border-style:solid" id="myTable">
            <thead>
                <tr>
                    <th style="width:5%">No.</th>
                    <th style="width:18%">Tanggal</th>
                    <th style="width:15%">Waktu</th>
                    <th style="width:30%">Lokasi Yang Dikunjungi</th>
                    <th style="width:15%">Suhu Tubuh</th>
				</tr>
            </thead>
            <tbody>
                <?php
                        $i = 1;
                        $cek = true;
                        include 'config.php';
                        $nik = md5($_SESSION['nik']);
                        $sql = "SELECT*FROM tbperjalanan WHERE nik='$nik'";
                        $query = mysqli_query( $conn, $sql );
                        foreach ( $query as $value ) {
                            $cek = false;
                        ?>

                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $value['tanggal'] ?></td>
                            <td><?php echo $value['waktu'] ?></td>
                            <td><?php echo $value['lokasi'] ?></td>
                            <td><?php echo $value['suhu'] ?></td>
                            
                        </tr>
                        <?php }?>
            </tbody>
                    
                    
        </table>
    </div>
    </div>
    <script src="main.js"></script>
</body>
</html>