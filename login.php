<?php
//Memulai sesi
session_start();
 
//Mengecek apakah user sudah login. Bila iya, user akan dibawa ke halaman Home
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: home.php");
    exit;
}
 
//Include config.php
require_once "config.php";
 
//Mendefinisikan variabel dengan nilai kosong
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
//Memproses form saat data di submit
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    //Mengecek apakah form username kosong
    if(empty(trim($_POST["username"]))){
        $username_err = "Mohon masukkan username anda.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    //Mengecek apakah form password kosong
    if(empty(trim($_POST["password"]))){
        $password_err = "Mohon masukkan password anda.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    //Validasi kredensial
    if(empty($username_err) && empty($password_err)){
        
        //Menyiapkan statement select
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            //Mengikat variabel ke statement sebagai parameter
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            //Men-set parameter
            $param_username = $username;
            
            //Mencoba menjalankan statement yang telah disiapkan
            if(mysqli_stmt_execute($stmt)){
                
                //Menyimpan result
                mysqli_stmt_store_result($stmt);
                
                //Mengecek apakah username ada pada database dan menverifikasi password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    
                    //Mengikat variabel result
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            
                            //Jika password benar, mulai sesi baru
                            session_start();
                            
                            //Menyimpan data pada variabel sesi
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            //Mengarahkan user ke halaman Home
                            header("location: home.php");
                     
                        }else{
                            //Jika password tidak benar, menampilkan statement error
                            $login_err = "Username atau password yang dimasukkan salah.";
                        }
                    }
                } else{
                    //Jika username tidak ada, menampilkan statement error
                    $login_err = "Username yang dimasukkan tidak ada.";
                }
            } else{
                echo "Sepertinya terjadi masalah, mohon dicoba lagi setelah beberapa saat.";
            }

            //Menutup statement
            mysqli_stmt_close($stmt);
        }
    }
    
    //Menutup koneski
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - SiLambat</title>
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Norican' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ 
            font: Outfit;
            text-align: center; 
            background-color: rgb(255, 255, 255);
            background: linear-gradient(to top, #fe636b, #f4af02) no-repeat center fixed;
            background-size: cover;
        }
        h1 {
            font: 50px Norican;
            margin-left: 10px;
            margin-right: 10px;
            margin-bottom: 50px;
            color: rgb(255, 0, 0);
        }
        h2{
            text-align: center;
        }
        .wrapper{ 
            text-align: center;
            width: 700px; 
            padding: 50px; 
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            border-radius: 100px;
            background-color: rgb(255, 255, 255);
        }
        #tombolLogin {
            border-radius: 100px;
            background-color: rgb(200, 0, 0);
            padding: 0px, 0px, 0px, 0px;
            /* border-style: solid;
            border-color: rgb(255, 0, 0); */
        }
        #hrefHalLogin {
            color: rgb(0, 0, 0);
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1>SiLambat</h1>
        <h2>Login</h2>
        <p>Masukkan username dan password anda untuk login</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input id="tombolLogin" type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Belum memiliki akun? <a id="hrefHalLogin" href="register.php">Daftar sekarang</a></p>
            <p><a id="hrefHalLogin" href="loginadmin.php">Login Admin</a></p>
        </form>
    </div>
</body>
</html>