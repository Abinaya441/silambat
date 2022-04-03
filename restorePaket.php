<?php 
    // include database connection file 
    include_once("config.php"); 

    //Inisialisasi sesi
    session_start();
    
    //Mengecek apakah user telah login, jika tidak akan kembali ke halaman login
    if(!isset($_SESSION["loggedinadmin"]) || $_SESSION["loggedinadmin"] !== true){
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
            header("location: home.php");
            exit;
        }
        header("location: loginadmin.php");
        exit;
    }
    
    // Get id from URL to delete that data 
    $id_paket = $_GET['id_paket']; 
    
    // Delete data row from table based on given id
    $result = mysqli_query($link, "UPDATE paket SET is_delete=0 WHERE id_paket=$id_paket"); 
    
    // After delete redirect to Home, so that latest user list will be displayed. 
    header("Location: recycleBin.php"); 
?>