<?php

session_start();

if (!isset($_SESSION['rol'])){
    header("Location: login.php");
}else{
    if($_SESSION['rol'] != 2 ){
        header("Location: login.php");
    }
}

include("header_footer/header.html");
include("connectionBD.php");
include_once("classes\workers.php");
$workers = worker::get_worker();
?>
    <div class="row">
        <div class="col-12 pt-2">
            <h2>Listado de Trabajadores</h2>
            <a href="addWorker.php" class="btn btn-warning my-2"> 
                <i class="fa-solid fa-user px-2"></i>  Agregar Nuevo Trabajador 
            </a>
        </div>
        <div class="col-12 table-responsive py-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre Completo</th>
                        <th class="text-center">RUT</th>
                        <th colspan="2" class="text-center">Viáticos</th>
                        <th class="text-center">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($workers as $worker) { ?>
                        <tr>
                            <td><?php echo $worker["full_name"] ?></td>
                            <td class="text-center"><?php echo $worker["rut"] ?></td>
                            <!-- Botones de los viáticos -->
                            <td class="text-center">
                                <a href="viaticos.php?id=<?php echo $worker["id"] ?>" class="btn btn-success">
                                    Ingresar <i class="fa-solid fa-arrow-up"></i>
                                </a>   
                            </td>
                            <td class="text-center">
                                <a href="reportes.php?id=<?php echo $worker["id"] ?>" class="btn btn-info">
                                    Reportes <i class="fa-solid fa-file"></i>
                                </a>   
                            </td>
                            <td class="text-center">
                                <a href="deleteWorker.php?id=<?php echo $worker["id"] ?>" class="btn btn-danger">
                                    Eliminar Trabajador <i class="fa-solid fa-trash "></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                        <tr>
                            <th colspan="3">Realizar consolidado general por mes</th>
                            <td class="text-center">
                                <a href="consolidado.php" class="btn btn-info">
                                    Consolidado <i class="fa-solid fa-layer-group"></i>
                                </a>
                            </td>
                            <td></td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Boton Salir -->
    <div class="py-5 pb-4 text-center">
        <form action="index.php" method="GET">
            <input type="hidden" value="1" name="cerrar_sesion">
            <button type="submit" class="p-2 bg-light text-dark font-weight-bold">Cerrar Sesion</button>
        </form>
        <?php
        if(isset($_GET['cerrar_sesion'])){
            session_unset();
            session_destroy();
        }
        ?>
    </div>
    <!-- Fin Boton Salir -->
<?php include("header_footer/footer.html");?>

