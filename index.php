<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 


    <!-- Theme style -->
    <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">

    <!-- Daterange picker -->
    <link rel="stylesheet" href="admin/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="admin/plugins/summernote/summernote-bs4.min.css">

    <!-- DataTable -->

    


    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="admin/css/editor.dataTables.min.css">
    <link rel="stylesheet" href="admin/css/stripe.css">

    <link rel="stylesheet" href="admin/css/card.css">
    <link rel="stylesheet" href="admin/css/footer.css">
    <link rel="stylesheet" href="admin/css/pendiente.css">



    <?php
    session_start();
    $accion = $_REQUEST['accion']??'';
    if($accion == 'accion'){
        session_destroy();
        header("Refresh:0");
    }

    ?>
</head>


<body>
    <!--jQuery  -->
    <script src="admin/plugins/jquery/jquery.min.js"></script>
<?php 
    include_once "admin/db_ecommerce.php";
    $con = mysqli_connect($host, $user, $pass, $db);
?>

                   <?php include_once "menu.php"; ?> 

    <div class="container">
   
        <div class="row">
       
            <div class="col-12">
            
                <?php

                    $modulo = $_REQUEST['modulo']??'';
                    if($modulo == "productos" || $modulo == ""){
                        include_once "productos.php";
                    }else if($modulo == "detalleproducto" || $modulo == ""){
                        include_once "detalleProductos.php";
                    }else if($modulo == "carrito" || $modulo == ""){
                        include_once "carrito.php";
                    }else if($modulo == "envio" || $modulo == ""){
                        include_once "envio.php";
                    }else if($modulo == "pasarela" || $modulo == ""){
                        include_once "pasarela.php";
                    }else if($modulo == "factura" || $modulo == ""){
                        include_once "factura.php";
                    }
                ?>
            </div>
        </div>
    </div>

    <footer class="pie-pagina">
        <div class="grupo-1">
            <div class="box">
                <figure>
                    <a href="#">
                        <img src="admin/images/LogoT.png" alt="Logo de SLee Dw">
                    </a>
                </figure>
            </div>
            <div class="box">
                <h2>SOBRE NOSOTROS</h2>
                <p>Nuestro compromiso con la satisfacción del cliente es inquebrantable. Ofrecemos entregas rápidas y un servicio al cliente excepcional para asegurarnos de que obtengas lo que necesitas, cuando lo necesitas.</p>
               
            </div>
            <div class="box">
                <h2>SIGUENOS</h2>
                <div class="red-social">
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
        </div>
     
    </footer>

    
    <!-- jQuery UI 1.11.4 -->
    <script src="admin/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

    <!-- Bootstrap 4 -->
    <script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- daterangepicker -->
    <script src="admin/plugins/moment/moment.min.js"></script>
    <script src="admin/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="admin/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="admin/dist/js/adminlte.js"></script>

    

    <!-- Pasarela de pago -->
    <script src="https://js.stripe.com/v3/"></script>
    <script src="./admin/js/stripe.js"></script>

    <script src="admin/js/ecomerce.js"></script>
    <script src="admin/js/dark.js"></script>

</body>

</html>