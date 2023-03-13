<?php 
include("connectionBD.php");   
include_once("classes/viatics.php");

$valor_idWorker = $_POST["idWorker"];
$valor_month = $_POST["month"]; 
$valor_year = $_POST["year"];

$report = new viatic(   $valor_idWorker,
                        $valor_month, 
                        $valor_year, null, null, null, null, null, null, null, null, null
                        );

$ans_Report = $report->getOneReport();

header("Location:reportes.php?id=".$valor_idWorker."&ans=".urlencode(json_encode($ans_Report)));