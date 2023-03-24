<?php 
include("connectionBD.php");

session_start();

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $_SESSION['username'] = $username;


    $sqlLog = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";

    $ans = $connection->query($sqlLog)
                or trigger_error("Query Failed! SQL: $ans - Error: ".mysqli_error($connection), E_USER_ERROR);
    
    $row = $ans->fetch_object();    
    
    if($row == true){
        //Validación del Rol
        $rol = $row->rol_id;
        $_SESSION['rol'] = $rol;
        
        print_r($_SESSION['rol']);

        if($_SESSION['rol'] == 2){
            header("Location: index.php");
        }elseif($_SESSION['rol'] == 3){
            header("Location: validationConsolidated.php");
        } 
    }else{
        //No existe el Usuario
        echo "El usuario o contraseña son incorrectos";
    }

}

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="style/img/icon.png">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="style/bootstrap_5.3.0/css/bootstrap.min.css" type="text/css">
        <!-- FontAwesome -->
        <link rel="stylesheet" href="style/fontawesome_6.3.0/css/all.min.css" type="text/css">
        <!-- CSS IHP -->
        <link rel="stylesheet" href="style/style_ihp.css" type="text/css">
        <title> Login Bonificaciones Tecnored</title>
    </head>
    <body>
        <header>
            <!-- Inicio de barra de navegacion superior -->
            <nav class="navbar px-4 mb-2 bg-dark bg-gradient fw-bold">
                <a class="navbar-brand text-light fs-4" href="index.php">
                    <img src="style/img/icon.png" alt="Logo" width="38" height="38" class="d-inline-block align-text-top">
                    Tecnored</a>
            </nav>
        </header>
        <main> 
            <div class="container">
                <div class="py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card bg-dark text-white" style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center">
                                    <div class="mb-md-3 mt-md-4 pb-5">
                                        <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                        <p class="text-white-50 mb-5">Ingrese sus datos:</p>
                                        <form action="#" method="POST">
                                            <label for="username" class="form-label fw-bold"><i class="fa-solid fa-user px-2"></i> Usuario</label>
                                            <input type="text" name="username" class="form-control" require>

                                            <label for="password" class="form-label pt-3 fw-bold"><i class="fa-solid fa-key"></i> Contraseña</label>
                                            <input type="password" name="password" class="form-control pb-2" require>
                                            
                                            <div class="pt-5">
                                                <input type="submit" value="Iniciar Sesion" class="btn btn-warning fw-bold">
                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>           
<?php include("header_footer/footer.html");?>