<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<?php

include 'sql.php'; 

$Alta = false;   
$Alimento = "";   
$Categoria = "";
$Cantidad = "";


if (isset($_POST['alimento'])){
    $Alimento = $_POST['alimento'];
}

if (isset($_POST['categoria'])){
    $Categoria = $_POST['categoria'];
}

if (isset($_POST['cantidad'])){
    if (is_numeric($_POST['cantidad'])){
        $Cantidad = $_POST['cantidad'];
    } 
} 
  
if($Alimento != "" && $Categoria != "" && $Cantidad!=""){
    $Alta=true;
    $sql = "INSERT INTO $tabla (alimento, categoria, cantidad) VALUES ('$Alimento','$Categoria','$Cantidad')"; //Defino mi consulta (insert) para usar despues en la funcion que vincula la conexion a base con la consulta
    if ($Alta==true){
        if (mysqli_query($conne, $sql)) { ?> 
            <script>
            var x = <?php echo $Alta;?> ;
            </script>
            <?php
            $Alta = false;
            header("refresh: 2; url=".$_SERVER["PHP_SELF"]); //Recargar la pagina 
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conne);
        }
    }
}

?>

