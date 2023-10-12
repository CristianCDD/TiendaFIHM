   <?php
    $id = mysqli_real_escape_string($con, $_REQUEST['id'] ?? '');
    $queryProducto = "SELECT id, nombre, precio, descripcion FROM productos where id='$id'";
    $resProducto = mysqli_query($con, $queryProducto);
    $rowProducto = mysqli_fetch_assoc($resProducto);

    ?>

   <!-- Default box -->
   <div class="card card-solid">
     <div class="card-body">
       <div class="row">
         <div class="col-12 col-sm-6">
           <h3 class="d-inline-block d-sm-none"><?php echo $rowProducto['nombre'] ?></h3>
           <?php
            $queryImagenes = "SELECT 
             
              f.web_path 
              from productos AS p 
              INNER JOIN productos_files AS pf ON pf.producto_id = p.id 
              INNER JOIN files AS f on f.id = pf.file_id
              WHERE p.id = '$id'
              ";
            $resPrimerImagen = mysqli_query($con, $queryImagenes);
            $rowPrimerImagen = mysqli_fetch_assoc($resPrimerImagen);
            ?>
           <div class="col-12">
             <img src="<?php echo $rowPrimerImagen['web_path'] ?>" class="product-image" alt="Product Image">
           </div>
           <div class="col-12 product-image-thumbs">

             <?php
              $resImagenes = mysqli_query($con, $queryImagenes);

              while ($rowImagen = mysqli_fetch_assoc($resImagenes)) {
              ?>

               <div class="product-image-thumb">
                 <img src="<?php echo $rowImagen['web_path'] ?>" alt="Product Image">
               </div>
             <?php
              }
              ?>
           </div>

         </div>
         <div class="col-12 col-sm-6">
           <h3 class="my-3"><?php echo $rowProducto['nombre'] ?></h3>
           <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa dolor consequatur maiores voluptatum rerum facilis pariatur impedit velit similique, laborum reiciendis illo? Doloribus quaerat aliquam dolorem mollitia ipsa totam veritatis?
              Necessitatibus sapiente accusamus saepe ipsum vel mollitia temporibus nisi quo, possimus delectus, similique dolores earum recusandae ducimus. Eaque in explicabo dolorum nobis numquam libero quasi dolor totam. Aspernatur, minus porro?</p> -->
               <?php echo $rowProducto['descripcion']  ?> </h4>
           <hr>

           <!-- <h4>descripcion <?php echo $rowProducto['descripcion']  ?> </h4> -->

           <div class="bg-gray py-2 px-3 mt-4">
             <h2 class="mb-0">
               Precio: S/<?php echo ($rowProducto['precio']) ?>
             </h2>

           </div>

          

           <div class="mt-4">
             Cantidad
             <input type="number" class="form-control" id="cantidadProductos" value="1">
           </div>

           <div class="mt-4">

                <button class="CartBtn" id="agregarCarrito" data-id="<?php echo $_REQUEST['id'] ?>" data-nombre="<?php echo $rowProducto['nombre'] ?>" data-web_path="<?php echo $rowPrimerImagen['web_path'] ?>" data-precio="<?php echo $rowProducto['precio'] ?>">
                  <div class="IconContainer">
                    <i class="fas fa-cart-plus fa-lg mr-2 icon"></i>
                  </div>
                  <span class="text">Agregar</span>
               </button>

           </div>

         </div>
       </div>

     </div>
     <!-- /.card-body -->
   </div>
   <!-- /.card -->