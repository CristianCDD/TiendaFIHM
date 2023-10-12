<div class="row mt-1">
    <?php
    $nombre = mysqli_real_escape_string($con, $_REQUEST['nombre'] ?? '');
    $where = ''; // Inicializa $where como cadena vacía

    if (!empty($nombre)) {
        $where = "WHERE nombre LIKE '%$nombre%'";
    }

    $queryCuenta = "SELECT count(*) as cuenta from productos $where ;";
    $resCuenta = mysqli_query($con, $queryCuenta);
    $rowCuenta = mysqli_fetch_assoc($resCuenta);
    $totalRegistro = $rowCuenta['cuenta'];

    $elementosPorPagina = 6;

    $totalPaginas = ceil($totalRegistro / $elementosPorPagina);

    $paginaSel = $_REQUEST['pagina'] ?? false;

    if ($paginaSel == false) {
        $inicioLimite = 0;
        $paginaSel = 1;
    } else {
        $inicioLimite = ($paginaSel - 1) * $elementosPorPagina;
    }

    $limite = " LIMIT $inicioLimite, $elementosPorPagina ";

    $query = "SELECT 
                p.id, 
                p.nombre, 
                p.precio, 
                p.descripcion, 
                f.web_path 
                FROM productos AS p 
                INNER JOIN productos_files AS pf ON pf.producto_id = p.id 
                INNER JOIN files AS f ON f.id = pf.file_id
                $where
                GROUP BY p.id
                $limite";

    $res = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($res)) {
    ?>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card border-primary">
                <img class="card-img-top img-thumbnail" src="<?php echo $row['web_path'] ?>" alt="">
                <div class="card-body">
                    <h2 class="card-title"><strong><?php echo $row['nombre'] ?></strong></h2>
                    <p class="card-text"><strong class="precio">S/<?php echo $row['precio'] ?></strong></p>
                    <!--  <p class="card-text"><strong>descripcion:</strong><?php echo $row['descripcion'] ?></p> -->
                    <a href="index.php?modulo=detalleproducto&id=<?php echo $row['id'] ?>" class="learn-more">
                        <span class="circle" aria-hidden="true">
                            <span class="icon arrow"></span>
                        </span>
                        <span class="button-text">Ver mas </span>
                    </a>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<?php
if ($totalPaginas > 0) {
?>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php
            if ($paginaSel != 1) {
            ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?modulo=productos&pagina=<?php echo ($paginaSel - 1) ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
            <?php
            }
            ?>

            <?php
            for ($i = 1; $i <= ($totalPaginas); $i++) {
            ?>
                <li class="page-item <?php echo ($paginaSel == $i) ? " active " : "" ?>">
                    <a class="page-link" href="index.php?modulo=productos&pagina=<?php echo $i ?>"><?php echo $i ?></a>
                </li>
            <?php
            }
            ?>

            <?php
            if ($paginaSel != $totalPaginas) {
            ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?modulo=productos&pagina=<?php echo ($paginaSel + 1); ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            <?php
            }
            ?>
        </ul>
    </nav>
<?php
}
?>