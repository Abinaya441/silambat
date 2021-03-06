<?php
    //Include config.php
    require_once "config.php";

    //Mendefinisikan variabel untuk login dengan nilai kosong
    $username = $password = $confirm_password = "";
    $username_err = $password_err = $confirm_password_err = "";
 
//Memproses data saat form di submit
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    //Validasi username agar tidak menerima simbol aneh
    if(empty(trim($_POST["username"]))){
        $username_err = "Silahkan masukkan username anda.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username hanya boleh terdiri dari huruf, angka, dan underscore.";
    } else{

        //Men-select kolom id dari tabel users
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            //Mengikat variabel ke statement sebagai parameter
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            //Men-set parameter
            $param_username = trim($_POST["username"]);
            
            //Mencoba untuk menjalankan statement yang telah di siapkan
            if(mysqli_stmt_execute($stmt)){
                
                //Menyimpan result
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Sudah ada pengguna dengan username ini.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Sepertinya terjadi masalah, mohon dicoba lagi setelah beberapa saat.";
            }

            //Menutup statement
            mysqli_stmt_close($stmt);
        }
    }
    
    //Validasi password
    if(empty(trim($_POST["password"]))){
        $password_err = "Silahkan masukkan password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password harus terdiri dari minimal 6 karakter.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    //Validasi confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Mohon konfirmasi password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password yang anda masukkan tidak sama.";
        }
    }
    
    //Memeriksa apakah ada error sebelum masuk ke database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        //Menyiapkan insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            //Mengikat variabel ke statement sebagai parameter
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            //Men-set parameter
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            //Mencoba untuk menjalankan statement yang telah disiapkan
            if(mysqli_stmt_execute($stmt)){
                
                //Mengalihkan pengguna ke halaman login
                header("location: login.php");
            } else{
                echo "Sepertinya terjadi masalah, mohon dicoba lagi setelah beberapa saat.";
            }

            //Menutup statement
            mysqli_stmt_close($stmt);
        }
    }
    
    //Menutup koneksi
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrasi - SiLambat</title>
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
            text-align: center;
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
        #tombolDaftar {
            border-radius: 100px;
            background-color: rgb(0, 150, 0);
            padding: 0px, 0px, 0px, 0px;
        }
        #tombolReset {
            border-radius: 100px;
            background-color: rgb(200, 0, 0);
            padding: 0px, 0px, 0px, 0px;
        }
        #hrefLogin {
            color: rgb(0, 0, 0);
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1>SiLambat</h1>
        <h2>Daftar</h2>
        <p>Mohon isi form ini untuk membuat akun.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input id="tombolDaftar" type="submit" class="btn btn-primary" value="Submit">
                <input id="tombolReset" type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Sudah memiliki akun? <a id="hrefLogin" href="login.php">Login disini</a></p>
        </form>
    </div>    
</body>
</html>