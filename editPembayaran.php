<?php 
    // include database connection file 
    include_once("config.php"); 

    $listpaket = mysqli_query($link, "SELECT * FROM paket WHERE is_delete=0 ORDER BY id_paket");
    $listpelanggan = mysqli_query($link, "SELECT * FROM pelanggan WHERE is_delete=0 ORDER BY id_pelanggan");
    
    // Check if form is submitted for data update, then redirect to homepage after update 
    if(isset($_POST['update'])) { 
        $id_transaksi = $_POST['id_transaksi'];
        $id_paket = $_POST['id_paket'];
        $id_pelanggan = $_POST['id_pelanggan'];
        $jumlah = $_POST['jumlah']; 
        $tanggal = $_POST['tanggal'];
        //$total_harga = $_POST['total_harga'];
        
        // update data 
        $result = mysqli_query($link, "UPDATE pembayaran SET id_paket='$id_paket', id_pelanggan='$id_pelanggan', jumlah='$jumlah', tanggal='$tanggal' WHERE id_transaksi=$id_transaksi"); 
        
        // Redirect to homepage to display updated data in list 
        header("Location: homeadmin.php"); }
?>

<?php
    // Display selected minuman based on id 
    // Getting id from url 
    $id_transaksi = $_GET['id_transaksi']; 
    
    // Fetch data based on id 
    $result_pembayaran = mysqli_query($link, "SELECT * FROM pembayaran WHERE id_transaksi=$id_transaksi");

    while($nota = mysqli_fetch_array($result_pembayaran)) {
        $id_paket = $nota['id_paket'];
        $id_pelanggan = $nota['id_pelanggan'];
        $jumlah = $nota['jumlah'];
        $tanggal = $nota['tanggal'];
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Pembayaran</title>
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
    <body><a href="homeadmin.php">Home Admin</a> 
    <br/><br/> 
    
    <h2>Edit Pembayaran</h2> 

        <div class="Tabel">
        <form name="update_pembayaran" method="post" action="editPembayaran.php">
            <table border="0"> 
                <!-- <tr>
                    <td>Nama</td> 
                    <td><input type="text" name="nama" value=<?php echo $nama;?>></td>
                </tr>  -->
                
                <tr>
                    <td>ID Paket</td> 
                    <td><input type="text" name="id_paket" value=<?php echo $id_paket;?>></td> 
                </tr> 

                <tr>
                    <td>ID Pelanggan</td> 
                    <td><input type="text" name="id_pelanggan" value=<?php echo $id_pelanggan;?>></td> 
                </tr>

                <!-- <tr>
                    <td>No. HP</td> 
                    <td><input type="text" name="no_hp" value=<?php echo $no_hp;?>></td> 
                </tr> -->

                <!-- <tr>
                    <td>No. KTP</td> 
                    <td><input type="text" name="no_ktp" value=<?php echo $no_ktp;?>></td> 
                </tr> -->

                <tr>
                    <td>Jumlah</td> 
                    <td><input type="text" name="jumlah" value=<?php echo $jumlah;?>></td> 
                </tr>

                <tr>
                    <td>Tanggal</td> 
                    <td><input type="text" name="tanggal" value=<?php echo $tanggal;?>></td> 
                </tr> 
                
                <tr> 
                    <td><input type="hidden" name="id_transaksi" value=<?php echo $_GET['id_transaksi'];?>></td> 
                    <td><input type="submit" name="update" value="Update"></td> 
                </tr> 
            </table> 
        </form>
        </div>

        <h3>Masukkan ID Paket dan ID Pelanggan sesuai nomor tabel di bawah:</h3>

        <div class="Tabel">
        <h3>Daftar Paket</h3>
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
        <h3>Daftar Pelanggan</h3>
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
    </body>
</html>