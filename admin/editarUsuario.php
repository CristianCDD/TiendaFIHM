<?php
        include_once "db_ecommerce.php";
        $con = mysqli_connect($host, $user, $pass, $db);
    if(isset($_REQUEST['guardar'])){

        $email = mysqli_real_escape_string($con, $_REQUEST['email'] ?? '');
    $pass = md5(mysqli_real_escape_string($con, $_REQUEST['pass'] ?? ''));
    $nombre = mysqli_real_escape_string($con, $_REQUEST['nombre'] ?? '');
    $cargo = mysqli_real_escape_string($con, $_REQUEST['cargo'] ?? '');  // Nuevo campo "Cargo"
    $id = mysqli_real_escape_string($con, $_REQUEST['id'] ?? '');

    $query = "UPDATE usuarios SET 
        email = '$email', 
        pass = '$pass', 
        nombre = '$nombre',
        cargo = '$cargo'
        WHERE id = '$id'";
        

        $res =  mysqli_query($con, $query);

        if($res){
            echo '<meta http-equiv="refresh" content ="0; url=panel.php?modulo=usuarios&mensaje=Usuario '. $nombre . ' editado exitosamente"/>';
        }else{
            ?>
            <div class="alert alert-danger" role="alert">
                Error al crear usuario <?php echo mysqli_error($con) ?>
            </div>
            <?php   
        }
    }

    $id = mysqli_real_escape_string($con, $_REQUEST['id']??'');
    $query = "SELECT usuarios.id, email, pass, nombre, roles.descripcion AS cargo
    FROM usuarios
    INNER JOIN roles
    ON usuarios.cargo = roles.id
    WHERE usuarios.id = $id";
    

    $res = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($res);

    ?>

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar usuario  </h1>

                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                       
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="panel.php?modulo=editarUsuario" method="post">
                                <div class="form-group">
                                  <label for="">Email <?php echo $id  ?> </label>

                                  <input type="email" name="email" class="form-control" value="<?php echo $row['email']  ?>" required = "required"  >
                                </div>

                                <div class="form-group">
                                  <label for="">Password</label>
                                 

                                  <input type="password" name="pass" class="form-control" required = "required"  >
                                  
                                </div>

                                <div class="form-group">
                                  <label for="">Nombre</label>
                                  <input type="text" name="nombre" class="form-control" value="<?php echo $row['nombre']  ?>" required = "required" >
                                </div>

                                <div class="form-group">
    <label for="cargo">Cargo</label>
    <select name="cargo" class="form-control">
        <option value="1" <?php if ($row['cargo'] == 1) echo 'selected'; ?>>Administrador</option>
        <option value="2" <?php if ($row['cargo'] == 2) echo 'selected'; ?>>Jefe de Producción</option>
        <!-- Agrega más opciones según tus necesidades -->
    </select>
</div>



                                <div class="form-group">
                                 
                                    
                                    <input type="hidden" name="id"  value="<?php echo $row['id']  ?>" >
                                    <button type="submit" class="btn btn-primary" name="guardar">Guardar</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>