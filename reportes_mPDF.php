<?php 

require_once('lib/mpdf/vendor/autoload.php');
require_once('lib/mpdf/vendor/mpdf/mpdf/src/Mpdf.php');

if(isset($_POST['crear'])){
    
        $valor = $_POST['valor'];
        $ans = array();
        $num_valores = count($valor);
        $num_campos = 15;

        for($i = 0; $i< $num_valores; $i+= $num_campos){
            $fila = array_slice($valor, $i, $num_campos);
            array_push($ans, $fila);
        }

//Plantilla HTML
require_once('template_PDF/template_PDF.php');        

//Código CSS de la plantilla
$css = file_get_contents('style\bootstrap_5.3.0\css\bootstrap.css');

    try{
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'L'
        ]);

        $plantilla = getPlantilla($ans);

        $mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($plantilla, \Mpdf\HTMLParserMode::DEFAULT_MODE);

        $mpdf->Output();
        
    } catch(\Mpdf\MpdfException $e){
        echo $e->getMessage();
    }
}
?>