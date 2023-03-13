<?php
require_once 'lib/dompdf/autoload.inc.php'; // carga el archivo autoload.php
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
        *{
            font-family: sans-serif;
        }
        .table{
            width: 100%;
            border: 1px solid #000;
            border-collapse: collapse;
        }
        td, th{
            border: 1px solid #000;
        }

        h2{
            padding-bottom: 10px;
        }

        .total{
            background-color: #ffc107;
            font-weight: bold;
            font-size: 1.02rem;
        }

        .centrar{
            text-align: center;
        }

        .paddingX{
            padding-left: 1.2em;
            padding-right: 1.2em;
        }    
        
        .logo{
            font-weight: bolder;
            font-size: large;
            font-style: italic;
            background-color: #ffc107;
            border-radius: 10px;
            padding: 5px 10px;
            display: inline-block;
        }
        

    </style>
    <title>Reporte_PDF</title>
</head>
<body>
    <div>
        <div>
            <p class="logo">Tecnored</p>
        </div>
        <div class=>
            <h2 class="centrar">Reporte de viáticos</h2>
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
                    <th class="paddingX" paddingX>Monto</th>
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
$dompdf->stream("reporte_pdf.pdf", array("Attachment" => true));

}
?>