<?php
include("connectionBD.php");

session_start();

if (!isset($_SESSION['rol'])){
    header("Location: login.php");
}else{
    if($_SESSION['rol'] != 3){
        header("Location: login.php");
    }
}

include("header_footer/header.html");?>

<div class="row">
        <form action="viatical_ConsolidatedReport_Form_Supervisor.php" method="POST">
            <div class="row">
                <div class="col-4 py-3"> 
                    <select class="form-select" name="month">
                        <option selected>Selecciona el mes para el reporte</option>
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                </div>
                <div class="col-4 py-3 justify-content-md-center d-md-flex d-grid gap-2">
                        <p>Año: <?php 
                        $currentYear = date("Y");
                        echo "<span class='fw-bold'>".$currentYear."</span>"; 
                        ?></p>
                        <input type="hidden" value="<?php echo date("Y")?>" name="year">
                </div>
                <div class="col-4 py-3 justify-content-md-center d-md-flex d-grid gap-2">
                    <button type="submit" class="btn btn-success">Obtener Consolidado</button>
                </div>
                <hr>
            </div>
        </form>
    </div>

<?php
    if(isset($_GET['ans'])){
        // Hay resultados de la consulta, muestra la tabla
        $ans = json_decode($_GET['ans'],true);
        $total = 0;
        $month;
        $year;
?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre Completo</th>
                <th class="text-center">RUT</th>
                <th>Hábil</th>
                <th>Inhábil</th>
                <th>Lugar</th>
                <th>Desayuno</th>
                <th>Almuerzo</th>
                <th>Cena</th>
                <th>Extensión Horario</th>
                <th>Motivo</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ans as $an) { ?>
                <tr>
                   <td><?php echo $an["full_name"]?></td>
                   <td><?php echo $an["rut"]?></td>
                   <td><?php 
                    if($an["businessDay"]=="1990-01-01"){
                        echo "";
                    }else{
                        echo $an["businessDay"];
                    }
                   ?></td>
                   <td><?php 
                    if($an["non_businessDay"]=="1990-01-01"){
                        echo "";
                    }else{
                        echo $an["non_businessDay"];
                    }
                   ?></td>
                   <td><?php echo $an["city"]?></td>
                   <td class="text-center"><?php echo $an["breakfast"]?></td>
                   <td class="text-center"><?php echo $an["lunch"]?></td>
                   <td class="text-center"><?php echo $an["dinner"]?></td>
                   <td class="text-center"><?php echo $an["extraHour"]?></td>
                   <td><?php echo $an["reason"]?></td>
                   <td class="text-end"><?php echo "$ ".$an["amount"];
                               $total = $total+$an["amount"];     
                        ?></td>   
                </tr>
                <?php 
                $month = $an['month'];
                $year = $an['year'];
                ?>
            <?php } ?>
                <tr>
                    <td colspan="10" class="text-center fw-bold bg-warning">TOTAL VIÁTICOS</td>
                    <td class="text-end fw-bold bg-warning"><?php echo "$ ".$total?></td>
                </tr>
        </tbody>
    </table>
    <div class="py-2 my-2 justify-content-md-center d-md-flex d-grid gap-2">
        <form action="consolidado_PDF.php" method="POST">
            <input type="hidden" name="crear">
            <?php
            foreach($ans as $entradas){
                foreach($entradas as $valores){
                    echo '<input type="hidden" name="valor[]" value="'. $valores .'">';
                }   
            }
            ?>
            <button type="submit" class="btn btn-info">Descargar Reporte<i class="fa-solid fa-file-pdf fa-xl px-2"></i></button>
        </form>
    </div>
<?php } ?> <!-- Fin del If que permite mostrar la Tabla -->
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

