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
        <form action="viatical_Income_Form.php" method="POST">
            <div class="row">
                <div class="col-6 pt-2"> 
                    <select class="form-select" name="month">
                        <option selected>Selecciona el mes que deseas ingresar los viáticos</option>
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
                <div class="col-6 py-3">
                        <p>Año: <?php 
                        $currentYear = date("Y");
                        echo "<span class='fw-bold'>".$currentYear."</span>"; 
                        ?></p>
                        <input type="hidden" value="<?php echo date("Y")?>" name="year">
                </div>
            </div>  
            <hr>
            <div class="col-12 table-responsive">
                <table class="table text-center table-bordered">
                    <thead>
                        <tr class="align-middle">
                            <th colspan="2">Fecha</th>
                            <th rowspan="2" class="align-middle">Lugar</th>
                            <th colspan="4">Horario</th>
                        </tr>
                        <tr>
                            <th>Hábil</th>
                            <th>Inhábil</th>
                            <th>Desayuno</th>
                            <th>Almuerzo</th>
                            <th>Cena</th>
                            <th>Extensión de Jornada</th>
                        </tr>
                    </thead>
                    <tbody>   
                        <tr>
                            <td>
                                <input type="date" id="habil" onchange="fechaSeleccionada()" name="businessDay">
                            </td>
                            <td>
                                <input type="date" id="inhabil" onchange="fechaSeleccionada()" name="non_businessDay">
                            </td>
                            <td>
                                <select class="form-select" id="lugar" name="city" required>
                                    <option selected>Selecciona</option>
                                    <option value="Valparaíso">Valparaíso</option>
                                    <option value="Viña del Mar">Viña del Mar</option>
                                    <option value="Quilpué">Quilpué</option>
                                    <option value="Villa Alemana">Villa Alemana</option>
                                    <option value="Limache">Limache</option>
                                    <option value="Quillota">Quillota</option>
                                    <option value="Calera">Calera</option>
                                    <option value="Llay-Llay">Llay-Llay</option>
                                    <option value="Panquehue">Panquehue</option>
                                    <option value="San Felipe">San Felipe</option>
                                    <option value="Los Andes">Los Andes</option>
                                    <option value="Quintero">Quintero</option>
                                    <option value="Ventana">Ventana</option>
                                    <option value="La Ligua">La Ligua</option>
                                    <option value="Algarrobo">Algarrobo</option>
                                    <option value="El Quisco">El Quisco</option>
                                    <option value="El Tabo">El Tabo</option>
                                    <option value="Cartagena">Cartagena</option>
                                    <option value="San Antonio">San Antonio</option>
                                    <option value="San Juan">San Juan</option>
                                    <option value="otros (entre 50-200km)">otros (entre 50-200km)</option>
                                    <option value="otros (sobre 200km)">otros (sobre 200km)</option>
                                </select>
                            </td>
                            <td class="position-relative">
                                <div class="form-check position-absolute top-50 start-50 translate-middle">
                                    <input class="form-check-input" type="checkbox" value="1" id="desayuno" name="breakfast">
                                </div>
                            </td>
                            <td class="position-relative">
                                <div class="form-check position-absolute top-50 start-50 translate-middle">
                                    <input class="form-check-input" type="checkbox"  value="1" id="almuerzo" checked name="lunch">
                                </div>
                            </td>
                            <td class="position-relative">
                                <div class="form-check position-absolute top-50 start-50 translate-middle">
                                    <input class="form-check-input" type="checkbox"  value="1" id="cena" name="dinner">
                                </div>
                            </td>
                            <td class="position-relative">
                                <div class="form-check position-absolute top-50 start-50 translate-middle">
                                    <input class="form-check-input" type="checkbox"  value="1" id="extencionHor" name="extencionHor">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <thead>
                        <tr>
                            <th colspan="5" class="align-middle">Motivo</th>
                            <th colspan="2" class="align-middle">Monto(clp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5"><input class="col-12" type="text" name="reason" required></td>
                            <td><input type="number" id="monto" name="amount" required></td>
                            <td><button type="button" class="btn btn-primary" onclick="calcular()">Calcular</button></td>
                        </tr>
                    </tbody>              
                </table>
                <div class="pt-2 justify-content-md-center d-md-flex d-grid gap-2">
                    <button type="submit" class="btn btn-success">Agregar Viáticos</button>
                    <a href="index.php" class="btn btn-secondary">Volver</a>
                </div> 
            </div>
            <input type="hidden" value="<?php echo $worker_id ?>" name="idWorker"> 
        </form>     
    </div>              
    <script src="script/script_ihp.js"></script>
<?php
} 
?>    
<?php include("header_footer/footer.html");?>