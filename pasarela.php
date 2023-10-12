 


<form action="index.php?modulo=factura" method="post" id="payment-form">

<table class="table" id="tablaPasarela">
    <thead>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
       
    </tbody>
</table>
        <h4 class="mt-3">Datos de su tarjeta</h4>
        <div class="form-row">

            <div id="card-element" class="form-control">
                <!-- A Stripe Element will be inserted here. -->
            </div>
            <!-- Used to display form errors. -->
            <div id="card-errors" role="alert"></div>
        </div>
        <div class="mt-3">
            <h4>Terminos y condiciones</h4>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, voluptate atque? Necessitatibus praesentium nesciunt dolores eveniet totam enim veritatis quia ex! Nemo nihil quae possimus perspiciatis! Facere non fugiat similique.
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue">
                Acepto los terminos y condiciones
              </label>
            </div>
        </div>
        <div class="mt-3">
            <a  class="btn btn-warning" href="index.php?modulo=envio" role="button">Ir a envio</a>
            <button type="submit" class="btn btn-primary float-right">Pagar</button>
        </div>
    </form>
    