<?php 
    // include database connection file 
    include_once("config.php"); 
    
    //Inisialisasi sesi
    session_start();
    
    //Mengecek apakah user telah login, jika tidak akan kembali ke halaman login
    if(!isset($_SESSION["loggedinadmin"]) || $_SESSION["loggedinadmin"] !== true){
        header("location: loginadmin.php");
        exit;
    }

    // Check if form is submitted for data update, then redirect to homepage after update 
    if(isset($_POST['update'])) { 
        $id_paket = $_POST['id_paket'];
        $nama_paket = $_POST['nama_paket']; 
        $jenis_paket=$_POST['jenis_paket']; 
        $harga=$_POST['harga']; 
        
        // update data 
        $result = mysqli_query($link, "UPDATE paket SET nama_paket='".$nama_paket."', jenis_paket='$jenis_paket', harga='$harga' WHERE id_paket=$id_paket"); 
        
        // Redirect to homepage to display updated data in list 
        header("Location: homeadmin.php"); }
?>

<?php
    // Display selected minuman based on id 
    // Getting id from url 
    $id_paket = $_GET['id_paket']; 
    
    // Fetch data based on id 
    $result = mysqli_query($link, "SELECT * FROM paket WHERE id_paket=$id_paket");

    while($paket = mysqli_fetch_array($result)) { 
        $nama_paket = $paket['nama_paket']; 
        $jenis_paket = $paket['jenis_paket'];
        $harga = $paket['harga']; 
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tambah Paket - SiLambat</title>
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
            table {
                margin-left: auto;
                margin-right: auto;
                border-color: rgb(0, 0, 0);
                border-collapse: collapse;
            }
            h1 {
            font: 50px Norican;
            margin-left: 10px;
            margin-right: 10px;
            color: rgb(255, 0, 0);
            }
            h2 {
                text-align: center;
            }
            table {
                margin-left: auto;
                margin-right: auto;
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
    <h2>Edit Paket</h2> 
        <form name="update_paket" method="post" action="editPaket.php">
            <table border="0"> 
                <tr>
                    <td>Nama Paket</td> 
                    <td><input type="text" name="nama_paket" value="<?php echo $nama_paket;?>"></td>
                </tr> 
                
                <tr>
                    <td>Jenis Paket</td> 
                    <td><input type="text" name="jenis_paket" value="<?php echo $jenis_paket;?>"></td> 
                </tr> 

                <tr>
                    <td>Harga</td> 
                    <td><input type="text" name="harga" value="<?php echo $harga;?>"></td> 
                </tr> 
                
                <tr> 
                    <td><input type="hidden" name="id_paket" value="<?php echo $_GET['id_paket'];?>"></td> 
                    <td><input type="submit" name="update" value="Update"></td> 
                </tr> 
            </table> 
            <br/>
            <a href="homeadmin.php">Home Admin</a> 
            <br/> 
            <br>
        </form>
        </div>
    </body>
</html>