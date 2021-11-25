<?php 
    // include database connection file 
    include_once("config.php"); 
    
    // Check if form is submitted for data update, then redirect to homepage after update 
    if(isset($_POST['update'])) { 
        $id_pelanggan = $_POST['id_pelanggan'];
        $nama = $_POST['nama']; 
        $no_hp=$_POST['no_hp']; 
        $no_ktp=$_POST['no_ktp']; 
        
        // update data 
        $result = mysqli_query($link, "UPDATE pelanggan SET nama='$nama', no_hp='$no_hp', no_ktp='$no_ktp' WHERE id_pelanggan=$id_pelanggan"); 
        
        // Redirect to homepage to display updated data in list 
        header("Location: homeadmin.php"); }
?>

<?php
    // Display selected minuman based on id 
    // Getting id from url 
    $id_pelanggan = $_GET['id_pelanggan']; 
    
    // Fetch data based on id 
    $result = mysqli_query($link, "SELECT * FROM pelanggan WHERE id_pelanggan=$id_pelanggan");

    while($pelanggan = mysqli_fetch_array($result)) { 
        $nama = $pelanggan['nama']; 
        $no_hp=$pelanggan['no_hp']; 
        $no_ktp=$pelanggan['no_ktp'];
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Pelanggan</title>
    </head>
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
                padding: 10px 10px 10px 10px;
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
    <body>
    <body><a href="homeadmin.php">Home Admin</a> 
    <br/><br/> 
    
    <div class="Tabel">
    <h2>Edit Pelanggan</h2> 
        <form name="update_os" method="post" action="editPelanggan.php">
            <table border="0"> 
                <tr>
                    <td>Nama</td> 
                    <td><input type="text" name="nama" value=<?php echo $nama;?>></td>
                </tr> 
                
                <tr>
                    <td>No. HP</td> 
                    <td><input type="text" name="no_hp" value=<?php echo $no_hp;?>></td> 
                </tr> 

                <tr>
                    <td>No. KTP</td> 
                    <td><input type="text" name="no_ktp" value=<?php echo $no_ktp;?>></td> 
                </tr> 
                
                <tr> 
                    <td><input type="hidden" name="id_pelanggan" value=<?php echo $_GET['id_pelanggan'];?>></td> 
                    <td><input type="submit" name="update" value="Update"></td> 
                </tr> 
            </table> 
        </form>
        </div>
    </body>
</html>