<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "viaticos_tecnored";

$connection = mysqli_connect($host, $username, $password, $database);

if(!$connection) {
    echo "error al conectar con la base de datos";
}

?>