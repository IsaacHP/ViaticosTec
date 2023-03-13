<?php
class worker{

    //Declaracion de variables.
    private $id, $full_name, $rut;

    //Constructor.
    public function __construct($full_name, $rut ,$id=null)
    {
        if ($id) {
            $this->id = $id;
        }
        $this->full_name = $full_name;
        $this->rut= $rut;
    }

    //Método para guardar.
    public function save(){
        include("connectionBD.php");
        $sqlSave ="INSERT INTO workers (id, full_name, rut) VALUE (null,'$this->full_name','$this->rut')"; 
        $ans = $connection->query($sqlSave) 
                or trigger_error("Query Failed! SQL: $ans - Error: ".mysqli_error($connection), E_USER_ERROR);
        if($ans){
            echo 
            "<script type='text/javascript'>
                window.location.href='index.php';       
            </script>;";
           mysqli_close($connection);
        }else{
            "<script type='text/javascript'>
                alert('ha ocurrido un error al guardar');
                window.location.href='index.php';       
            </script>;";
            mysqli_close($connection);
        }   
    }

    //Método para obtener todos los trabajadores y sus datos.
    public static function get_worker(){
        include("connectionBD.php");
        $sqlSelect ="SELECT * FROM workers";
        $ans = $connection->query($sqlSelect);
        return $ans->fetch_all(MYSQLI_ASSOC);
        mysqli_close($connection);
    }

    //Método para obtener solo un trabajador.
    public static function get_oneWorker($id){
        include("connectionBD.php");
        $sqlSelectOne ="SELECT * FROM workers WHERE id ='$id'";
        $ans = $connection->query($sqlSelectOne);
        return $ans->fetch_object();
        mysqli_close($connection);
    }

    //Método para eliminar trabajadores.
    public static function delete($id){
        include("connectionBD.php");
        $sqlDelete="DELETE FROM workers WHERE id='$id'";
        $connection->query($sqlDelete);
        mysqli_close($connection);
    }
}
?>