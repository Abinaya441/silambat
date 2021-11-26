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
        <h2>Tambah Paket</h2>
        <form action="addPaket.php" method="post" name="form1"> 
            <table width="25%" border="0"> 
                <tr>
                    <td>Nama Paket</td>
                    <td><input type="text" name="nama_paket"></td> 
                </tr> 
                <tr>
                    <td>Jenis Paket</td> 
                    <td><input type="text" name="jenis_paket"></td> 
                </tr>
                <tr>
                    <td>Harga</td> 
                    <td><input type="text" name="harga"></td> 
                </tr>
                <tr>
                    <td></td> 
                    <td><input type="submit" name="Submit" value="Add"></td> 
                </tr> 
            </table>
            
        </form>
        <br/>
            <a href="homeadmin.php">Home Admin</a> 
            <br/> 
            <br>
        </div>

        <?php
            // Check If form submitted, insert form data into users table.
            if(isset($_POST['Submit'])) { 
                $nama_paket = $_POST['nama_paket']; 
                $jenis_paket = $_POST['jenis_paket'];
                $harga = $_POST['harga'];

                // include database connection file 
                include_once("config.php");

                // Insert user data into table 
                $result = mysqli_query($link, "INSERT INTO paket(nama_paket, jenis_paket, harga) VALUES('$nama_paket', '$jenis_paket', '$harga')"); 
                // Show message when user added 
                echo "Berhasil menambahkan $nama_paket ke Daftar Paket! <br><a href='homeadmin.php'>Kembali ke Home Admin</a>"; 
            }
        ?>
    </body>
</html>