<?php include("header_footer/header.html");?>

<div class="row">
    <div class="col-12">
        <h3>Agregar Trabajador</h3>
        <form action="createWorker.php" method="POST" class="py-4">
            <div class="form-group py-1">
                <label for="name">Nombre completo (Nombre y Apellidos Paterno y Materno)</label>
                <input name="name" required type="text" id="name" class="form-control">
            </div>
            <div class="form-group py-1">
                <label for="rut">RUT (sin puntos ni guión)</label>
                <input name="rut" required type="number" id="rut" class="form-control">
            </div>
            <div class="form-group text-center pt-4">
                <button class="btn btn-success" type="submit">Guardar</button>
                <a href="index.php" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </div>
</div>


<?php include("header_footer/footer.html");?>