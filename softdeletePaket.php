<?php 
    // include database connection file 
    include_once("config.php"); 
    
    // Get id from URL to delete that data 
    $id_paket = $_GET['id_paket']; 
    
    // Delete data row from table based on given id
    $result = mysqli_query($link, "UPDATE paket SET is_delete=1 WHERE id_paket=$id_paket"); 
    
    // After delete redirect to Home, so that latest user list will be displayed. 
    header("Location: homeadmin.php"); 
?>