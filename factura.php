<?php

$total = (float) ($_REQUEST['total'] ?? '');

include_once "./stripe/init.php";

\Stripe\Stripe::setApiKey("sk_test_51NlF8uGmFnL1NIwqgJC8JbtLSqEUuQhVNJUeNexlE85OXJsQTO4Asc429uVi9WC22WXxruXZ04KJGEjantoE6auD00d6NPnp41");
$toke = $_POST['stripeToken'];

$charge = \Stripe\Charge::create([
    'amount' => $total, //10000 = 100
    'currency' => 'usd',
    'description' => 'Pago a ecommerce',
    'source' => $toke
]);

if ($charge['captured']) {
    $queryVenta = "INSERT INTO ventas(idCli, idPago, fecha) values
        ('" . $_SESSION['idCliente'] . "', '" . $charge['id'] . "',now());";
    $resVenta = mysqli_query($con, $queryVenta);
    $id = mysqli_insert_id($con);

    /* if($resVenta){
            echo "La venta fue exitosa id=".$id;
        } */

    // ... código anterior ...

    $insertaDetalle = "";
    $cantProd = count($_REQUEST['id']);

    for ($i = 0; $i < $cantProd; $i++) {
        $subTotal = $_REQUEST['precio'][$i] * $_REQUEST['cantidad'][$i];
        $insertaDetalle .= "('" . $_REQUEST['id'][$i] . "', '$id', '" . $_REQUEST['cantidad'][$i] . "','" . $_REQUEST['precio'][$i] . "','$subTotal'),";
    }

    $insertaDetalle = rtrim($insertaDetalle, ",");
    $queryDetalle = "INSERT INTO detalleventas (idProd, idVenta, cantidad, precio, subTotal) VALUES $insertaDetalle;";
    // Añade un echo para verificar la consulta
    $resDetalle = mysqli_query($con, $queryDetalle);

    // Resto del código...





    if ($resVenta && $resDetalle) {
?>
    <div class="row">
            <div class="col-6">
                <?php muestraReciba($id);   ?>
            </div>

            <div class="col-6">
                <?php muestraDetalle($id);  ?>
            </div>
    </div>
        <?php
            borrarCarrito();
        ?>

    <?php
    }
}

function borrarCarrito(){
    ?>
    <script>
         $.ajax({
            type: "post",
            url: "ajax/borrarCarrito.php",
            dataType: "json",
            success: function(response){
                $('#badgeProducto').text("");
                $('#listaCarrito').text("");


            }
        });
    </script>
    <?php
}

function muestraReciba()
{
    ?>
    <table class="table">
        <thead>
            <tr>
                <th colspan="3" class="text-center">Persona que recibe</th>
            </tr>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Direccion</th>
            </tr>
        </thead>
        <tbody>
            <?php
            global $con;
            $queryRecibe = "SELECT nombre, email, direccion 
                        from recibe where idCli = $_SESSION[idCliente]";
            $resRecibe = mysqli_query($con, $queryRecibe);
            $row = mysqli_fetch_assoc($resRecibe);
            ?>
            <tr>
                <td><?php echo $row['nombre']; ?> </td>
                <td><?php echo $row['email']; ?> </td>
                <td><?php echo $row['direccion']; ?> </td>

            </tr>
            <tr>
                <td scope="row"></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
<?php
}


function muestraDetalle($idVenta)
{
?>
    <table class="table">
        <thead>
            <tr>
                <th colspan="3" class="text-center">Detalle de venta</th>
            </tr>
            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>SubTotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            global $con;
            $queryDetalle = "SELECT
                    p.nombre,
                    dv.cantidad,
                    dv.precio,
                    dv.subTotal
                FROM
                    ventas AS v
                    INNER JOIN detalleVentas AS dv ON dv.idVenta = v.id
                    INNER JOIN productos AS p ON p.id = dv.idProd
                WHERE
                    v.id = $idVenta";

            $resDetalle = mysqli_query($con, $queryDetalle);
            $total = 0;
            while ($row = mysqli_fetch_assoc($resDetalle)) {
                $total += $row['subTotal'];
            ?>
                <tr>
                    <td><?php echo $row['nombre']; ?> </td>
                    <td><?php echo $row['cantidad']; ?> </td>
                    <td><?php echo $row['precio']; ?> </td>
                    <td><?php echo $row['subTotal']; ?> </td>
                </tr>
            <?php
            }
            ?>
            <tr>
                <td colspan="3" class="text-right"> Total: </td>
                <td><?php echo $total; ?> </td>
            </tr>
        </tbody>
    </table>
    <a class="btn btn-secondary float-right" target="_blank" href="imprimirFactura.php?idVenta=<?php echo $idVenta ?>" role="button">Imprimir factura <i class="fa-solid fa-file-pdf"></i></a>
<?php
}


?>