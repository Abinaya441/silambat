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
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tambah Paket</title>
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
            <br/>
            <a href="homeadmin.php">Home Admin</a> 
            <br/> 
            <br/></br> 
        </form>
        </div>
    </body>
</html>