<?php
    include_once("config.php");

    $listpaket = mysqli_query($link, "SELECT * FROM paket WHERE is_delete=0 ORDER BY id_paket");
    $listpelanggan = mysqli_query($link, "SELECT * FROM pelanggan WHERE is_delete=0 ORDER BY id_pelanggan");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tambah Transaksi</title>
        <style>
            table {
                margin-left: auto;
                margin-right: auto;
            }
            h2 {
                text-align: center;
            }
            h3 {
                text-align: center;
            }
            h4 {
                text-align: center;
            }
            table {
                margin-left: auto;
                margin-right: auto;
            }
            th {
                padding: 10px 10px 10px 10px;
                text-align: center;
            }
            tr  {
                text-align: center;
            }
            td  {
                text-align: center;
                padding: 7px 10px 7px 10px;
            }
            .Tabel {
                margin-bottom: 10px;
                margin-left: 20px;
                margin-right: 20px;
                border-style: solid;
            }
        </style>
    </head>
    <body>
        <a href="homeadmin.php">Home Admin</a> 
        <br/><br/>

        <div class="Tabel">
        <h2>Tambah Transaksi</h2>
        <form action="addPembayaran.php" method="post" name="form1"> 
            <table width="25%" border="0"> 
                <tr>
                    <td>ID Paket</td> 
                    <td><input type="text" name="id_paket"></td> 
                </tr>
                <tr>
                    <td>ID Pelanggan</td> 
                    <td><input type="text" name="id_pelanggan"></td> 
                </tr>
                <tr>
                    <td>Jumlah</td> 
                    <td><input type="text" name="jumlah"></td> 
                </tr>
                <tr>
                    <td>Tanggal</td> 
                    <td><input type="text" name="tanggal"></td> 
                </tr>
                <tr>
                    <td></td> 
                    <td><input type="submit" name="Submit" value="Add"></td> 
                </tr> 
            </table> 
        </form>
        </div>

        <h3>Masukkan ID Paket dan ID Pelanggan sesuai nomor tabel di bawah:</h3>

        <div class="Tabel">
        <h4>Daftar Paket</h4>
        <table width='80%' border=1>
            <tr>
                <th>ID Paket</th> <th>Nama Paket</th> <th>Jenis Paket</th> <th>Harga</th>  
            </tr>

            <?php
                while($item = mysqli_fetch_array($listpaket)) {
                    echo "<tr>"; 
                    echo "<td>".$item['id_paket']."</td>"; 
                    echo "<td>".$item['nama_paket']."</td>"; 
                    echo "<td>".$item['jenis_paket']."</td>"; 
                    echo "<td>".$item['harga']."</td>"; 
                }
            ?>
        </table><br>
        </div>

        <div class="Tabel">
        <h4>Daftar Pelanggan</h4>
        <table width='80%' border=1>
            <tr>
                <th>ID Pelanggan</th> <th>Nama Pelanggan</th> <th>No. HP</th> <th>No. KTP</th>
            </tr>
        
            <?php
                while($item = mysqli_fetch_array($listpelanggan)) {
                    echo "<tr>"; 
                    echo "<td>".$item['id_pelanggan']."</td>"; 
                    echo "<td>".$item['nama']."</td>"; 
                    echo "<td>".$item['no_hp']."</td>"; 
                    echo "<td>".$item['no_ktp']."</td>";
                }
            ?>
        </table><br>
        </div>

        <?php
            // Check If form submitted, insert form data into users table.
            if(isset($_POST['Submit'])) { 
                //$id_transaksi = $_POST['id_transaksi'];
                $id_paket = $_POST['id_paket'];
                $id_pelanggan = $_POST['id_pelanggan'];
                $jumlah = $_POST['jumlah']; 
                $tanggal = $_POST['tanggal'];
                //$total_harga = $_POST['total_harga'];
                
                // include database connection file 
                include_once("config.php");

                // Insert user data into table 
                $result = mysqli_query($link, "INSERT INTO pembayaran(id_paket, id_pelanggan, jumlah, tanggal) VALUES('$id_paket','$id_pelanggan','$jumlah','$tanggal')"); 
                // Show message when user added 
                echo "Berhasil menambahkan ke Katalog Handphone! <br><a href='homeadmin.php'>Kembali ke Home Admin</a>"; 
            }
        ?>
    </body>
</html>