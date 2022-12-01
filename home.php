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
    <link rel="stylesheet" href="assets/style/home.css">
    <title>Home</title>
    <style>
        
    </style>
</head>
<body>
    <div class="container">
        <div class="welcome">
            <h4>Selemat Datang <u style="background-color:yellow; padding:5px"><?php echo $_SESSION['nama']; ?></u> User Di Aplikasi Peduli Lindungi</h4>
        </div>        
    </div>
    
</body>
</html>