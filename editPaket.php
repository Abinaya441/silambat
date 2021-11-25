<?php 
    // include database connection file 
    include_once("config.php"); 
    
    // Check if form is submitted for data update, then redirect to homepage after update 
    if(isset($_POST['update'])) { 
        $id_paket = $_POST['id_paket'];
        $nama_paket = $_POST['nama_paket']; 
        $jenis_paket=$_POST['jenis_paket']; 
        $harga=$_POST['harga']; 
        
        // update data 
        $result = mysqli_query($link, "UPDATE paket SET nama_paket='$nama_paket', jenis_paket='$jenis_paket', harga='$harga' WHERE id_paket=$id_paket"); 
        
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
        <title>Edit Manufaktur</title>
        <style>
            table {
                margin-left: auto;
                margin-right: auto;
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
    
    <div class="Tabel">
    <h2>Edit Manufaktur</h2> 
        <form name="update_paket" method="post" action="editPaket.php">
            <table border="0"> 
                <tr>
                    <td>Nama Paket</td> 
                    <td><input type="text" name="nama_paket" value=<?php echo $nama_paket;?>></td>
                </tr> 
                
                <tr>
                    <td>Jenis Paket</td> 
                    <td><input type="text" name="jenis_paket" value=<?php echo $jenis_paket;?>></td> 
                </tr> 

                <tr>
                    <td>Harga</td> 
                    <td><input type="text" name="harga" value=<?php echo $harga;?>></td> 
                </tr> 
                
                <tr> 
                    <td><input type="hidden" name="id_paket" value=<?php echo $_GET['id_paket'];?>></td> 
                    <td><input type="submit" name="update" value="Update"></td> 
                </tr> 
            </table> 
        </form>
        </div>
    </body>
</html>