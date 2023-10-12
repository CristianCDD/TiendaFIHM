<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/3922c9a6a2.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;500;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="diseño.css">
    <link rel="stylesheet" href="../admin/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="../admin/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="../admin/css/loginRegisterUser.css">
</head>
<style>
  body{
    height: 100vh !important;
  }
</style>
<body class="hold-transition login-page">
    <main class="login-design">
        <div class="login">
            <!-- Derehga -->
            <div class="login-data">
              <div class="inicio">
                <h1 class="inicSe">Inicio de sesión  </h1>
                <img src="./images/LogoT.png" alt="">
              </div>
                
                <?php
                if(isset($_REQUEST['login'])){
                  session_start();
                  $email = $_REQUEST['email'] ?? '';
                  $pasword = $_REQUEST['pass'] ?? '';
                  $pasword = md5($pasword);
                  include_once "db_ecommerce.php";
                  $con = mysqli_connect($host, $user, $pass, $db);
                  $query = "SELECT id,email,nombre, cargo from usuarios where email='" . $email . "' and pass='" . $pasword . "';  ";
                  $res = mysqli_query($con, $query);
                  $row = mysqli_fetch_assoc($res);

                    if($row){
                      $_SESSION['id'] = $row['id'];
                      $_SESSION['email'] = $row['email'];
                      $_SESSION['nombre'] = $row['nombre'];
                      $_SESSION['cargo'] = $row['cargo'];
                      if ($row['cargo'] == 1) {
                        header("location: panel.php");
                      } elseif ($row['cargo'] == 2) {
                        header("location: panel.php");
                      } else {
                        // Manejar otros valores de 'cargo' aquí
                      }
                    }else{
                    ?>
                    <div class="alert alert-danger" role="alert">
                        Error de login
                    </div>
                    <?php
                    }
                }
                ?>
                <form method="post" class="login-form">
                    <div class="input-group">
                        <label class="input-fill">
                            <input type="email" name="email">
                            <span class="input-label">Correo electrónico</span>
                            <i class="fas fa-envelope"></i>
                        </label>
                    </div>
                    <div class="input-group">
                        <label class="input-fill">
                            <input type="password" name="pass">
                            <span class="input-label">Contraseña</span>
                            <i class="fas fa-lock"></i>
                        </label>
                    </div>
                    <button type="submit" class="btn-login" name="login">Loguearse</button>
                </form>
            </div>
        </div>
    </main>
    <!-- jQuery -->
    <script src="admin/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="admin/dist/js/adminlte.min.js"></script>
</body>
</html>
