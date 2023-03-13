<?php
include("connectionBD.php");
include_once("classes/workers.php");
worker::delete($_GET["id"]);
header("Location: index.php");