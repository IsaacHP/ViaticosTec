<?php 
include("connectionBD.php");   
include_once("classes/viatics.php");

$valor_month = $_POST["month"]; 
$valor_year = $_POST["year"];

$consolidated = new viatic(   null,
                        $valor_month, 
                        $valor_year, null, null, null, null, null, null, null, null, null
                        );

$ans_consolidated = $consolidated->getReport();

header("Location:consolidado.php?ans=".urlencode(json_encode($ans_consolidated)));