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
    $consulta="SELECT * FROM articulos";

    $resultado=mysqli_query($con,$consulta);

    //Guardar array multidimensional para resultados de la consulta
    $noticias=array();
 
    while($row=mysqli_fetch_array($resultado)){
        $titulo=$row['titulo'];
        $cuerpo=$row['cuerpo'];
        $imagen1=$row['imagen1'];
        $imagen2=$row['imagen2'];
        $fecha=$row['fecha'];

        $noticias[]=array('titulo'=>$titulo,'cuerpo'=>$cuerpo,'imagen1'=>$imagen1,'imagen2'=>$imagen2,'fecha'=>$fecha );
    }
 
    echo json_encode($noticias);

?>