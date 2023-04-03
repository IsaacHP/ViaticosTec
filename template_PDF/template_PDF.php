<?php

function getPlantilla($ans){

    $total=0;
    $plantilla='<body>
                    <header>
                        <!-- Inicio de barra de navegacion superior -->
                        <nav class="navbar px-4 mb-2 fw-bold">
                            <a class="navbar-brand fs-4" href="index.php">
                                <img src="style\img\icon.png" alt="Logo" width="38" height="38" class="d-inline-block align-text-top">
                                Tecnored</a>
                        </nav>
                    </header>
                    <main>
                        <div class="container">
                            <!-- Titulo -->
                            <div class="row text-center">
                                <h2 class="py-2 fs-1 col-12 text-warning font-bold">BONIFICACIÓN DE VIÁTICOS</h2>
                                <hr>
                                <p>Reporte de viáticos</p>
                            </div>
                            <!-- Fin titulo -->
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
                                    </tr>
                                </thead>
                                <tbody>';
                                    foreach ($ans as $an) {
                                    $plantilla .='<tr>
                                        <td>'. $an[0] .'</td>
                                        <td>'. $an[1] .'</td>
                                        <td>'. $an[6] .'</td>
                                        <td>'. $an[7] .'</td>
                                        <td>'. $an[8] .'</td>
                                        <td class="centrar">'. $an[9].'</td>
                                        <td class="centrar">'. $an[10].'</td>
                                        <td class="centrar">'. $an[11].'</td>
                                        <td class="centrar">'. $an[12].'</td>
                                        <td>'.$an[13] .'</td>
                                        <td class="text-end">'. "$ ".$an[14] .'</td>   
                                        </tr>
                                    '; 
                                    $total = $total+$an[14];
                                    } $plantilla .='
                                        <tr>
                                            <td colspan="10" class="text-center fw-bold ">TOTAL VIÁTICOS</td>
                                            <td class="text-end fw-bold ">'."$ ".$total.'</td>
                                        </tr>
                                </tbody>
                            </table>
                            <div>
                                <h2>______________</h2>
                                <p>Firma Jefatura</p>
                            </div>
                        </div>
                    </main>        
                </body>';

    return $plantilla;
} 

?>