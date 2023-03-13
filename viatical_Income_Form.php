<?php
include("connectionBD.php");
include_once("classes/viatics.php");

$valor_idWorker = $_POST["idWorker"];
$valor_month = $_POST["month"]; 
$valor_year = $_POST["year"]; 
$valor_businessDay = $_POST["businessDay"];   
$valor_non_businessDay = $_POST["non_businessDay"]; 
$valor_city = $_POST["city"]; 
$valor_breakfast = ""; 
$valor_lunch = ""; 
$valor_dinner = ""; 
$valor_extencionHor = ""; 
$valor_reason = $_POST["reason"]; 
$valor_amount = $_POST["amount"];

if($valor_businessDay == ""){
    $valor_businessDay = "1990-01-01";
}

if($valor_non_businessDay == ""){
    $valor_non_businessDay = "1990-01-01";
}

if(isset($_POST["breakfast"])){
    $valor_breakfast=1;
}else{
    $valor_breakfast=0;
}

if(isset($_POST["lunch"])){
    $valor_lunch=1;
}else{
    $valor_lunch=0;
}

if(isset($_POST["dinner"])){
    $valor_dinner=1;
}else{
    $valor_dinner=0;
}

if(isset($_POST["extencionHor"])){
    $valor_extencionHor=1;
}else{
    $valor_extencionHor=0;
}

$viatics = new viatic(  $valor_idWorker,
                        $valor_month, 
                        $valor_year, 
                        $valor_businessDay, 
                        $valor_non_businessDay, 
                        $valor_city, 
                        $valor_breakfast, 
                        $valor_lunch, 
                        $valor_dinner, 
                        $valor_extencionHor, 
                        $valor_reason, 
                        $valor_amount
                    );                                                                   

$viatics->save();

header("Location:viaticos.php?id=$valor_idWorker");
?>