<!-- Navbar -->
<nav class="navbar navbar-expand navbar-dark">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">

                        <li class="nav-item d-none d-sm-inline-block">
                            <img class="logo"  src="admin/images/LogoT.png"  alt="">
                        </li>

                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="admin/index.php" class="nav-link">Login</a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="#" class="nav-link">Nosotros</a>
                        </li>
                    </ul>

                    

                    <!-- Right navbar links -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Navbar Search -->
                       
                                <form class="form-inline" action="index.php">
                                    <div class="input-group input-group-sm">
                                        <input class="busqueda" id="busqueda" type="search" placeholder="Buscar" aria-label="Search" name="nombre" value="<?php echo $_REQUEST['nombre']??''  ?>">
                                        <input type="hidden" name="modulo" value="productos">
                                      
                                    </div>
                                </form>

                        <!-- Messages Dropdown Menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#" id="iconoCarrito">
                                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                <span class="badge badge-danger navbar-badge" id="badgeProducto">   </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="listaCarrito">
                               
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <img src="admin/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                Nora Silvester
                                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                            </h3>
                                            <p class="text-sm">The subject goes here</p>
                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                                <div class="dropdown-divider"></div>
                            </div>
                        </li>
                        <!-- Notifications Dropdown Menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <?php
                                if(isset($_SESSION['idCliente']) == false){         
                                ?>

                                <a href="login.php" class="dropdown-item">
                                    <i class="fa-solid fa-door-open mr-2 text-primary"></i>Loguearse
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="registro.php" class="dropdown-item mr-2">
                                    <i class="fa-solid fa-right-to-bracket mr-2 text-primary "></i>Registrarse
                                </a>

                                

                                <?php
                                }else{
                                    ?>  
                                      <a href="index.php?modulo=usuario" class="dropdown-item mr-2">
                                          <i class="fa-solid fa-door-closed text-primary mr-2"></i>Hola
                                          <?php echo $_SESSION['nombreCliente'] ?>
                                    </a>

                                    <form action="index.php" method="post">
                                        <button name="accion" class="btn btn-danger dropdown-item" type="submit" value="accion">
                                            <i class="fa-solid fa-door-closed text-danger mr-2"></i>Cerrar sesion
                                        </button>
                                   
                                    </form>

                                    
                                    <?php
                                }

                                ?>
                               
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                        <button class="switch" id="switch">
                    <span><i class="fa-solid fa-sun"></i></span>
                    <span><i class="fa-solid fa-moon"></i></span>

                </button>
                        </li>

                    </ul>
                </nav>

                <?php
                $mensaje = $_REQUEST['mensaje']??'';
                if($mensaje){
                    ?>
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <?php echo $mensaje;  ?>
                        </div>
                    <?php
                }
                ?>