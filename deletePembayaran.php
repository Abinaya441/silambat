<?php
    // include database connection file
    include_once("config.php");
    // Get id from URL to delete that data
    $id = $_GET['id'];
    // Delete data row from table based on given id
    $result = mysqli_query($mysqli, "DELETE FROM paket_bumbu WHERE kode_paket='$id'");
    // After delete redirect to Home, so that latest user list will bedisplayed.
    header("Location:viewSoftDelete.php");
?>

<?php 
    // include database connection file 
    include_once("config.php"); 
    
    // Get id from URL to delete that data 
    $id = $_GET['id']; 
    
    // Delete data row from table based on given id
    $result = mysqli_query($link, "DELETE FROM handphone SET WHERE id_hp='$id'"); 
    
    // After delete redirect to Home, so that latest user list will be displayed. 
    header("Location: viewSoftDelete.php"); 
?>