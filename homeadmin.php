<?php
    include_once("config.php");
    
    //Inisialisasi sesi
    session_start();
    
    //Mengecek apakah user telah login, jika tidak akan kembali ke halaman login
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: loginadmin.php");
        exit;
    }

    $listpaket = mysqli_query($link, "SELECT * FROM paket WHERE is_delete=0 ORDER BY id_paket");
    $listpelanggan = mysqli_query($link, "SELECT * FROM pelanggan WHERE is_delete=0 ORDER BY id_pelanggan");
    $listnota = mysqli_query($link, "SELECT pembayaran.id_transaksi, pelanggan.nama, pelanggan.no_hp, pelanggan.no_ktp, paket.nama_paket, paket.jenis_paket, pembayaran.jumlah, pembayaran.tanggal, paket.harga*pembayaran.jumlah AS total_harga FROM paket INNER JOIN pembayaran ON paket.id_paket=pembayaran.id_paket INNER JOIN pelanggan ON pelanggan.id_pelanggan=pembayaran.id_pelanggan WHERE pembayaran.is_delete = 0 ORDER BY id_transaksi");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Admin - SiLambat</title>
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Norican' rel='stylesheet'>
        <style>
            body{ 
            font: 16px Raleway;
            text-align: center; 
            background-color: rgb(255, 255, 255);
            background: linear-gradient(to top, #fe636b, #f4af02) no-repeat center fixed;
            background-size: cover;
            }
            h1 {
            font: 50px Norican;
            margin-left: 10px;
            margin-right: 10px;
            color: rgb(255, 0, 0);
            }
            h2 {
            margin-left: 10px;
            margin-right: 10px;
            color: rgb(0, 0, 0);
            }
            h3 {
                text-align: center;
            }
            table {
                margin-left: auto;
                margin-right: auto;
                border-color: rgb(0, 0, 0);
                border-collapse: collapse;
            }
            th {
                padding: 10px 10px 10px 10px;
                text-align: center;
                font-weight: bold;
                font-size: 17px;
                background-color: rgb(254, 99, 107);
                color: rgb(255, 255, 255);
            }
            tr  {
                text-align: center;
                color: rgb(0, 0, 0);
            }
            td {
                padding: 10px 10px 10px 10px;
                color: rgb(0, 0, 0);
            }
            p {
                text-align: center;
            }
            .Tabel {
                width: 90%;
                padding: 10px 10px 10px 10px;
                margin-top: 50px;
                margin-bottom: 50px;
                margin-left: auto;
                margin-right: auto;
                background-color: rgb(255, 255, 255);
                border-radius: 100px;
            }
        </style>
    </head>
    <body>
        <div class="Tabel">
        <div class="Judul">
        <h1 class="my-5">SiLambat</h1>
        </div>
        <br/>
        <div style="text-align: center">
            <h2>Data Keseluruhan</h2>
        </div></br>
        
        <h3>Daftar Paket</h3>
        <table width='80%' border=2>
        <p>
            <a href="addPaket.php">Tambah Paket</a>
        </p> 
            <tr>
                <th>ID Paket</th> <th>Nama Paket</th> <th>Jenis Paket</th> <th>Harga</th> <th>Modifikasi</th>   
            </tr>

            <?php
                while($item = mysqli_fetch_array($listpaket)) {
                    echo "<tr>"; 
                    echo "<td>".$item['id_paket']."</td>"; 
                    echo "<td>".$item['nama_paket']."</td>"; 
                    echo "<td>".$item['jenis_paket']."</td>"; 
                    echo "<td>".$item['harga']."</td>"; 
                    echo "<td><a href='editPaket.php?id_paket=$item[id_paket]'>Edit</a> 
                    | 
                    <a href='softdeletePaket.php?id_paket=$item[id_paket]'>Hapus</a></td></tr>";
                }
            ?>
        </table><br>
        <h3>Daftar Pelanggan</h3>
        <table width='80%' border=1>
        <p>
            <a href="addPelanggan.php">Tambah Pelanggan</a>
        </p> 
            <tr>
                <th>ID Pelanggan</th> <th>Nama Pelanggan</th> <th>No. HP</th> <th>No. KTP</th> <th>Modifikasi</th> 
            </tr>
        
            <?php
                while($item = mysqli_fetch_array($listpelanggan)) {
                    echo "<tr>"; 
                    echo "<td>".$item['id_pelanggan']."</td>"; 
                    echo "<td>".$item['nama']."</td>"; 
                    echo "<td>".$item['no_hp']."</td>"; 
                    echo "<td>".$item['no_ktp']."</td>";
                    echo "<td><a href='editPelanggan.php?id_pelanggan=$item[id_pelanggan]'>Edit</a> 
                    | 
                    <a href='softdeletePelanggan.php?id_pelanggan=$item[id_pelanggan]'>Hapus</a></td></tr>"; 
                }
            ?>
        </table><br>
        <h3>Daftar Transaksi</h3>
        <table width='80%' border=1>
        <p>
            <a href="addPembayaran.php">Tambah Transaksi</a>
        </p>
            <tr>
            <th>ID Transaksi</th> <th>Nama Pelanggan</th> <th>No. HP</th> <th>No. KTP</th> <th>Nama Paket</th> <th>Jenis Paket</th> <th>Jumlah</th> <th>Tanggal</th> <th>Total Harga</th> <th>Modifikasi</th>
            </tr>
            
            <?php
                while($item = mysqli_fetch_array($listnota)) {
                    echo "<tr>";
                    echo "<td>".$item['id_transaksi']."</td>";
                    echo "<td>".$item['nama']."</td>";
                    echo "<td>".$item['no_hp']."</td>";
                    echo "<td>".$item['no_ktp']."</td>";
                    echo "<td>".$item['nama_paket']."</td>";
                    echo "<td>".$item['jenis_paket']."</td>";
                    echo "<td>".$item['jumlah']."</td>";
                    echo "<td>".$item['tanggal']."</td>";
                    echo "<td>".$item['total_harga']."</td>";
                    echo "<td><a href='editPembayaran.php?id_transaksi=$item[id_transaksi]'>Edit</a> 
                    | 
                    <a href='softdeletePembayaran.php?id_transaksi=$item[id_transaksi]'>Hapus</a></td></tr>";
                } 
            ?>
        </table><br>
        <br/>
        <div style="text-align: center">
            <b><a href="recycleBin.php">Recycle Bin</a></b>
        </div>

        <p>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out</a>
        </p>
        </div>
            <br/>
    </body>
</html>