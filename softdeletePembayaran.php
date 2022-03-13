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
    $id_transaksi = $_GET['id_transaksi']; 
    
    // Delete data row from table based on given id
    $result = mysqli_query($link, "UPDATE pembayaran SET is_delete=1 WHERE id_transaksi=$id_transaksi"); 
    
    // After delete redirect to Home, so that latest user list will be displayed. 
    header("Location: homeadmin.php"); 
?>