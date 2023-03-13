<?php 
include("header_footer/header.html");
include("connectionBD.php");
include("classes/workers.php");

if (isset($_GET['id'])) {
    $id = $_GET["id"];
    $worker = worker::get_oneWorker($id);
    $worker_id = $worker->id;
    $worker_fullName = $worker->full_name;
    $worker_rut = $worker->rut;   
?>

    <div class="row">
        <div class="col-6 pt-2">
            <p>Viáticos de: <span class="fw-bold"><?php echo $worker_fullName ?></span></p>
        </div>
        <div class="col-6 pt-2">
            <p>RUT: <span class="fw-bold"><?php echo $worker_rut ?></span></p>
        </div>
        <hr>
        <form action="viatical_Report_Form.php" method="POST">
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
                    <button type="submit" class="btn btn-success">Obtener reporte</button>
                </div>
                <hr>
            </div>
            <input type="hidden" value="<?php echo $worker_id ?>" name="idWorker"> 
        </form>
    </div>

<?php
}
if(isset($_GET['ans'])){
    // Hay resultados de la consulta, muestra la tabla
    $ans = json_decode($_GET['ans'],true);
    $total = 0;
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
            <?php } ?>
                <tr>
                    <td colspan="10" class="text-center fw-bold bg-warning">TOTAL VIÁTICOS</td>
                    <td class="text-end fw-bold bg-warning"><?php echo "$ ".$total?></td>
                </tr>
        </tbody>
    </table>
    <div class="py-2 my-2 justify-content-md-center d-md-flex d-grid gap-2">
        <form action="reportes_PDF.php" method="POST">
            <input type="hidden" name="crear">
            <?php
            foreach($ans as $entradas){
                foreach($entradas as $valores){
                    echo '<input type="hidden" name="valor[]" value="'. $valores .'">';
                }   
            }
            ?>
            <button type="submit" class="btn btn-info">Descargar Reporte <i class="fa-solid fa-file-pdf fa-xl"></i></button>
        </form>
    </div>
<?php } ?> <!-- Fin del If que permite mostrar la Tabla -->
    <div class="py-2 my-2 justify-content-md-center d-md-flex d-grid gap-2">
        <a href="index.php" class="btn btn-secondary">Volver</a>
    </div>    
<?php include("header_footer/footer.html");?>