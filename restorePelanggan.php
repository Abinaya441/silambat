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
    
    // Get id from URL to delete that data 
    $id_pelanggan = $_GET['id_pelanggan']; 
    
    // Delete data row from table based on given id
    $result = mysqli_query($link, "UPDATE pelanggan SET is_delete=0 WHERE id_pelanggan=$id_pelanggan"); 
    
    // After delete redirect to Home, so that latest user list will be displayed. 
    header("Location: recycleBin.php"); 
?>