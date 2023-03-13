<?php
class viatic{

    //Declaracion de variables.
    private $id, $id_worker, $month, $year, $businessDay, $non_businessDay, $city, $breakfast, $lunch, $dinner, $extraHour, $reason, $amount;

    //Constructor
    public function __construct($id_worker, $month, $year, $businessDay, $non_businessDay, $city, $breakfast, $lunch, $dinner, $extraHour, $reason, $amount, $id=null)
    {
        if ($id) {
            $this->id = $id;
        }
        $this->id_worker = $id_worker;
        $this->month = $month;
        $this->year = $year;
        $this->businessDay = $businessDay;
        $this->non_businessDay = $non_businessDay;
        $this->city = $city;
        $this->breakfast = $breakfast;
        $this->lunch = $lunch;
        $this->dinner = $dinner;
        $this->extraHour = $extraHour;
        $this->reason = $reason;
        $this->amount = $amount;
    }


    //Método para guardar.
    public function save(){
        include("connectionBD.php");
        $sqlSave ="INSERT INTO viatics_data (id, id_workers, month, year, businessDay, non_businessDay, city, breakfast, lunch, dinner, extraHour, reason, amount) VALUE (null, '$this->id_worker', '$this->month', '$this->year', STR_TO_DATE('$this->businessDay', '%Y-%m-%d'), STR_TO_DATE('$this->non_businessDay', '%Y-%m-%d'), '$this->city', '$this->breakfast', '$this->lunch', '$this->dinner', '$this->extraHour', '$this->reason', '$this->amount')";
        $ans = $connection->query($sqlSave)
                or trigger_error("Query Failed! SQL: $ans - Error: ".mysqli_error($connection), E_USER_ERROR);
        if($ans){
            echo 
            "<script type='text/javascript'>
                window.location.href='viaticos.php';       
            </script>;";
           mysqli_close($connection);
        }else{
            "<script type='text/javascript'>
                alert('ha ocurrido un error al guardar');
                window.location.href='viaticos.php';       
            </script>;";
            mysqli_close($connection);
        }  
    }

    //Método para obtener reportes individuales por trabajador
    public function getOneReport(){
        include("connectionBD.php");
        $sqlGetOneReport = "SELECT workers.full_name, workers.rut, viatics_data.* FROM workers INNER JOIN viatics_data ON workers.id = viatics_data.id_workers WHERE viatics_data.month ='$this->month' AND viatics_data.year = '$this->year' AND viatics_data.id_workers = '$this->id_worker'"; 
        $ans = $connection->query($sqlGetOneReport)
                or trigger_error("Query Failed! SQL: $ans - Error: ".mysqli_error($connection), E_USER_ERROR);
        return $ans->fetch_all(MYSQLI_ASSOC);
        mysqli_close($conexion);
    }

    //Método para obtener reporte consolidado
    public function getReport(){
        include("connectionBD.php");
        $sqlGetReport = "SELECT workers.full_name, workers.rut, viatics_data.* FROM workers INNER JOIN viatics_data ON workers.id = viatics_data.id_workers WHERE viatics_data.month ='$this->month' AND viatics_data.year = '$this->year' ORDER BY workers.full_name ASC";
        $ans = $connection->query($sqlGetReport)
                or trigger_error("Query Failed! SQL: $ans - Error: ".mysqli_error($connection), E_USER_ERROR);
        return $ans->fetch_all(MYSQLI_ASSOC);
    }

}
?>

