<?php
require_once('lib/dompdf/vendor/autoload.php'); // carga el archivo autoload.php
use Dompdf\Dompdf;

if(isset($_POST['crear'])){
    $total=0;
    $valor = $_POST['valor'];
    $ans = array();
    $num_valores = count($valor);
    $num_campos = 15;

    for($i = 0; $i< $num_valores; $i+= $num_campos){
        $fila = array_slice($valor, $i, $num_campos);
        array_push($ans, $fila);
    }

    ob_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <style>
        /* Estilos para el reporte de viáticos */
        body {
        font-size: 14px;
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        line-height: 1.42857143;
        color: #333;
        background-color: #fff;
        }

        .logo {
        display: flex;
        align-items: center;
        }

        .logo img {
        width: 38px;
        height: 38px;
        margin-right: 10px;
        }

        .logo h1 {
        font-size: 2rem;
        font-weight: 700;
        margin: 5px;
        line-height: inherit;
        text-transform: uppercase;
        }

        .centrar {
        text-align: center !important;
        }

        .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-collapse: collapse;
        }

        .table th,
        .table td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border: 1px solid #ddd;
        }

        .table th {
        font-weight: bold;
        }

        .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #ddd;
        }

        .total {
        font-weight: bold;
        background-color: #ffc107 !important;
        }

        .py-5 {
        padding-top: 3rem !important;
        padding-bottom: 3rem !important;
        }

        .bg-warning {
        background-color: #ffc107 !important;
        }

        h2 {
        font-size: 24px;
        margin-top: 0;
        margin-bottom: 10px;
        font-weight: bold;
        color: #333;
        background-color: #ffc107;
        padding: 8px 16px;
        }

        .firma {
        text-align: center;
        margin-top: 150px;
        margin-bottom: 10px;
        font-size: 14px;
        font-weight: normal;
        }

        .firma span {
        border-top: 1px solid #000;
        padding-bottom: 5px;
        display: inline-block;
        width: 200px;
        margin: 0 20px;
        }

        .firma .jefatura {
        display: inline-block;
        font-weight: bold;
        }


    </style>
    <title>Reporte_PDF</title>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="./style/img/logo.png" alt="Logo" />
            <h1>Tecnored</h1>
        </div>
        <div>
            <h2 class="centrar">Reporte de Viáticos</h2>
        </div>
        <table class="table">
            <thead>
                <tr class="centrar">
                    <th>Nombre Completo</th>
                    <th>RUT</th>
                    <th>Hábil</th>
                    <th>Inhábil</th>
                    <th>Lugar</th>
                    <th>Desayuno</th>
                    <th>Almuerzo</th>
                    <th>Cena</th>
                    <th>Extensión Horario</th>
                    <th>Motivo</th>
                    <th style="width: 50px">Monto</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ans as $an) { ?>
                    <tr>
                    <td><?php echo $an[0]?></td>
                    <td><?php echo $an[1]?></td>
                    <td><?php 
                        if($an[6]=="1990-01-01"){
                            echo "";
                        }else{
                            echo $an[6];
                        }
                    ?></td>
                    <td><?php 
                        if($an[7]=="1990-01-01"){
                            echo "";
                        }else{
                            echo $an[7];
                        }
                    ?></td>
                    <td><?php echo $an[8]?></td>
                    <td class="centrar"><?php echo $an[9]?></td>
                    <td class="centrar"><?php echo $an[10]?></td>
                    <td class="centrar"><?php echo $an[11]?></td>
                    <td class="centrar"><?php echo $an[12]?></td>
                    <td><?php echo $an[13]?></td>
                    <td style="text-align: right"><?php echo "$ ".$an[14];
                                $total = $total+$an[14];     
                            ?></td>   
                    </tr>
                <?php } ?>
                    <tr>
                        <td colspan="10" class="total">TOTAL VIÁTICOS</td>
                        <td class="total" style="text-align: right"><?php echo "$ ".$total?></td>
                    </tr>
            </tbody>
        </table>
        <div class="firma">
            <span class="jefatura">Firma Supervisor</span>
            <span class="jefatura">Firma Subgerente</span>
        </div>
    </div>  
</body>
</html>
    
<?php
$html = ob_get_clean();

// crea una instancia de Dompdf
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnable' => true));
$dompdf->setOptions($options);

// convierte el HTML a PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("reporte_pdf.pdf", array("Attachment" => false));

}
?>