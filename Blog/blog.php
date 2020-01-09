<?php
    function connectDB(){
        $con=mysqli_connect("localhost","root","","web");
        if (mysqli_connect_errno())
        {
        echo "Fallo en la conexion con la base de datos - TIPO ERROR: " . mysqli_connect_error();
        }   
        
        mysqli_set_charset($con,"utf8");
        return $con;
    }
    //Generar objeto Json con las noticias
    $con=connectDB();
    $consulta="SELECT * FROM blog";

    $resultado=mysqli_query($con,$consulta);

    //Guardar array multidimensional para resultados de la consulta
    $noticias=array();
 
    while($row=mysqli_fetch_array($resultado)){
        $titulo=$row['titulo'];
        $mensaje=$row['mensaje'];
        $imagen=$row['imagen'];

        $noticias[]=array('titulo'=>$titulo,'mensaje'=>$mensaje,'imagen'=>$imagen);
    }
 
    echo json_encode($noticias);

?>