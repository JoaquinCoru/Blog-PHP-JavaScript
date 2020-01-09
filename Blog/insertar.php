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

    if (isset($_POST['insertar'])){
        //Cargar imagen en repositorio del servidor
        $target_path = "./imagenes/";
        $target_path = $target_path . basename( $_FILES['imagen']['name']);
        if(move_uploaded_file($_FILES['imagen']['tmp_name'], $target_path)) 
        { 
            echo "El fichero ". basename( $_FILES['imagen']['name']). " se ha subido correctamente.<br>";
    
        } else {
            echo "Ha habido un error en subir al servidor, intentelo nuevamente!!<br>";
        }    
    
        //Insertar noticia en base de datos
        $con=connectDB();
        
        if ($_POST['titular']==null){
            
            echo "No ha incluido ningún texto para insertar una nueva noticia o novedad... Inténtelo nuevamente!!";
            echo "<br><br><a href='contenidos.html'>VOLVER</a>";
            
        } else {	
            $titular=$_POST['titular'];
            $cuerpo=$_POST['mensaje'];
            $imagen=  $target_path;


            $consulta="INSERT INTO blog(titulo, mensaje, imagen) VALUES ('$titular','$cuerpo','$imagen')";
        
            mysqli_query($con,$consulta);
            echo "Registro insertado con exito... ";
            echo "<br><br><a href='info2.html'>VOLVER</a>";
        }

        mysqli_close($con); 
    }

    if (isset($_POST['borrar'])){
        $con=connectDB();
        $consulta="DELETE FROM blog";
        $paquete=mysqli_query($con,$consulta);

        if ($paquete){
            echo "Todas los posts de blog borrados correctamente de la base de datos";
            echo "<br><br><a href='info2.html'>VOLVER</a>";
        }else{
            echo "Ha habido un error";
               echo "<br><br><a href='info2.html'>VOLVER</a>";         
        }
    }

?>