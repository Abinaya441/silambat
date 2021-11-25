<?php
    include_once("config.php");

    //Inisialisasi sesi
    session_start();
    
    //Mengecek apakah user telah login, jika tidak akan kembali ke halaman login
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }

    if(isset($_GET['search'])){
        $search = $_GET['search'];
        $listnota = mysqli_query($link, "SELECT pelanggan.nama, pelanggan.no_hp, pelanggan.no_ktp, paket.nama_paket, paket.jenis_paket, pembayaran.tanggal, paket.harga*pembayaran.jumlah AS total_harga FROM paket INNER JOIN pembayaran ON paket.id_paket=pembayaran.id_paket INNER JOIN pelanggan ON pelanggan.id_pelanggan=pembayaran.id_pelanggan WHERE pembayaran.is_delete = 0 AND nama LIKE '%".$search."%'");
    } else {
        $listnota = mysqli_query($link, "SELECT pelanggan.nama, pelanggan.no_hp, pelanggan.no_ktp, paket.nama_paket, paket.jenis_paket, pembayaran.tanggal, paket.harga*pembayaran.jumlah AS total_harga FROM paket INNER JOIN pembayaran ON paket.id_paket=pembayaran.id_paket INNER JOIN pelanggan ON pelanggan.id_pelanggan=pembayaran.id_pelanggan WHERE pembayaran.is_delete = 0");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Norican' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ 
            font: 14px Outfit;
            text-align: center; 
            background-color: rgb(255, 255, 255);
            background: linear-gradient(to bottom, #00d2ff, #3a7bd5);
        }
        h1 {
            font: 50px Norican;
            margin-left: 10px;
            margin-right: 10px;
            color: rgb(255, 0, 0);
        }
        h2 {
            /* font: 70px sans-serif; */
            margin-left: 10px;
            margin-right: 10px;
            color: rgb(0, 0, 0);
        }
        h3 {
            text-align: center;
            color: rgb(0, 0, 0);
            font-weight: bold;
        }
        table {
            margin-left: auto;
            margin-right: auto;
            border-color: rgb(0, 0, 0);
        }
        th {
            padding: 10px 10px 10px 10px;
            text-align: center;
            font-weight: bold;
            font-size: 17px;
            background-color: rgb(58, 123, 213);
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
        .wrapper{ 
            text-align: center;
            width: 1200px; 
            padding: 100px; 
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            border-radius: 100px;
            background-color: rgb(255, 255, 255);
        }
        .Tabel {
            width: 90%;
            padding: 10px 10px 10px 10px;
            margin-top: 10px;
            margin-bottom: 10px;
            margin-left: auto;
            margin-right: auto;
            /* border-style: double;
            border-width: 5px; */
            background-color: rgb(255, 255, 255);
            border-radius: 100px;
            /* border-color: rgb(74, 71, 53); */
        }
        .buttonSearch {
            margin-bottom: 15px;
            background-color: rgb(200, 0, 0);
            margin-left: 20px;
            margin-right: auto;
            color: rgb(255, 255, 255);
            border-radius: 50px;
            border-color: rgb(200, 0, 0);
            /* -ms-transform: translate(-50%, -50%); */
            /* transform: translate(-50%, -50%); */
        }
        .searchLabel {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="Judul">
        <h1 class="my-5">SiLambat</h1>
    <div>
    <h2 class="my-5">Hello, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>!</h2>
    <h2 class="my-5">Selamat datang di sistem informasi pengiriman paket</h2>

    <div class="Tabel">
    <h3>Data Pengiriman Barang</h3>
    <form action="home.php" method="GET" name="form1"> 
        <table width="25%" border="0"> 
            <tr>
                <td class="searchLabel">Search by Name:</td>
                <td><input type="text" name="search"></td> 
            </tr>
        </table>
        <input class="buttonSearch" type="submit" value="Search" /> 
    </form>
        <table width='80%' border=2 >
            <tr class="Search">
                <th>Nama Pelanggan</th> <th>Nomor HP</th> <th>Nomor KTP</th> <th>Nama Paket</th> <th>Jenis Paket</th> <th>Tanggal</th> <th>Total Harga</th>
            </tr>
            
            <?php
                while($item = mysqli_fetch_array($listnota)) {
                    echo "<tr>";
                    echo "<td>".$item['nama']."</td>";
                    echo "<td>".$item['no_hp']."</td>";
                    echo "<td>".$item['no_ktp']."</td>";
                    echo "<td>".$item['nama_paket']."</td>";
                    echo "<td>".$item['jenis_paket']."</td>";
                    echo "<td>".$item['tanggal']."</td>";
                    echo "<td>".$item['total_harga']."</td>";
                } 
            ?>
        </table><br>
    </div>
    
    <p>
        <a href="logout.php" class="btn btn-danger ml-3">Log Out</a>
    </p>
</body>
</html>

<?php
    
?>