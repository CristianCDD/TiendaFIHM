<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/3922c9a6a2.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;500;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="diseño.css">
    <link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="./admin/css/loginRegisterUser.css">

</head>

<body>
    <main class="login-design">
        <div class="login">
            <div class="login-data">
                <h1>Registrarse</h1>
                <?php
                // ... (other code)

                if(isset($_REQUEST['registro'])){
                    session_start();
                    $email = $_REQUEST['email'] ?? '';
                    $nombre = $_REQUEST['nombre'] ?? '';
                    $password = $_REQUEST['pass'] ?? '';
                    $password = md5($password);
                    
                    include_once "admin/db_ecommerce.php";
                    
                    $conn = mysqli_connect($host, $user, $pass, $db);
                    $query = "INSERT INTO clientes(nombre, email, pass) values ('$nombre', '$email', '$password')";
                    
                    try {
                        $res = mysqli_query($conn, $query);
                        if($res){
                            ?>
                            <div class="alert alert-primary" role="alert">
                                <strong>Registro exitoso</strong><a href="login.php" class="Rbutton"> Ir al login</a>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="alert alert-danger" role="alert">
                                Error de registro
                            </div>
                            <?php
                        }
                    } catch (mysqli_sql_exception $e) {
                        if ($e->getCode() == 1062) { // 1062 is the error code for duplicate entry
                            ?>
                            <div class="alert alert-danger" role="alert">
                                El correo ya está registrado. Error de registro.
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="alert alert-danger" role="alert">
                                Error de registro
                            </div>
                            <?php
                        }
                    }
                }
                ?>
                <form method="post" class="login-form">
                    <div class="input-group">
                        <label class="input-fill">
                            <input type="text" class="form-control" name="nombre">
                            <span class="input-label">Nombre</span>
                            <i class="fa-solid fa-user"></i>
                        </label>
                    </div>

                    <div class="input-group">
                        <label class="input-fill">
                            <input type="email" class="form-control"  name="email">
                            <span class="input-label">Email</span>
                            <i class="fa-solid fa-envelope"></i>
                        </label>
                    </div>

                    <div class="input-group">
                        <label class="input-fill">
                            <input type="password" class="form-control"  name="pass">
                            <span class="input-label">Contraseña</span>
                            <i class="fa-solid fa-lock"></i>
                        </label>
                    </div>

                    <button type="submit" class="btn-login" name="registro">Registrarse</button>
                    <a href="login.php" class="Rbutton">Ir al login</a>
                </form>
            </div>
        </div>
    </main>
</body>

</html>
