<?php
include("connectionBD.php");
include_once("classes/workers.php");
$worker = new worker($_POST["name"], $_POST["rut"]);
$worker->save();
header("Location: index.php");