<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>Inicio</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="estilos/normalize.css">
        <link rel="stylesheet" href="estilos/estilos.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    </head>

    <body>
        <div class="container">
            <header id="header1">
                <p><img src="logo.jpg" height="150px" width="200px"></p>
                <h1>Página de inicio</h1>
                <p>Artículos de JSON y destacados </p>
            </header>   

            <div class=" cabecera">
                <div class="row">
                    <div class="col-lg-8 menu">
                        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
                            <ul class="nav navbar-nav">
                                <li class="nav-item active">
                                <a class="nav-link" href="index.html">Inicio</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="info1.html">Info1</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="info2.html">Info2</a>
                                </li>
                            </ul>                        
                        </nav>
                        <br>
                        <div class="bg-dark" id="mensaje">
                            <br>
                            <p id="salida"></p>
                        </div>
                    </div>

                    <div class="col-lg-4" id="login">   
                        <br>                     
                        <label>Usuario:</label>
                        <input type="text" id="nombre" autofocus><br><br>
                        <label>Contraseña:</label>
                        <input type="password" id="clave"><br><br>
                        <button type="submit" class=" btn btn-md btn-primary " onclick="Permitir()">Acceder</button> 
                        <p style="text-align:center;">  Usuario=cualquiera, Clave=admin</p>                 

                    </div>
                </div>
                <br>
                <div class="row hidden" id="cuerpo">
                    <div class="col-lg-8">
                        <h2> NOVEDADES </h2>
                        <div id="novedades">

                        </div>                 
                    </div>

                    <div class="col-lg-4">
                        <h2>DESTACADOS</h2>
                            <?php
                                $dir="./imagenes/";
                                $directorio = opendir($dir);
                                
                                while ($archivo = readdir($directorio)) {  
                                    if ($archivo=="." || $archivo=="..") { echo " "; } 
                                    else {  
                                        $archivos[$archivo] = $archivo; 
                                    } 
                                }                         
                                sort($archivos, SORT_NATURAL | SORT_FLAG_CASE); 
                                $i=0;
                                
                                foreach ($archivos as $archivo) {
                                    $extension = pathinfo($archivo, PATHINFO_EXTENSION);
                                    $nombre_solo = basename($archivo, '.'.$extension); 
                                    
                                        echo '<div class="thumbnail" >
                                                <a href="'.$dir.'/'.$archivo.'" target="_blank">
                                                    <div class="image" style="height:100%;" >
                                                        <img title="'.$nombre_solo.'" src="'.$dir.'/'.$archivo.'" style="width:100%;height:100%;border-radius:10px;">
                                                    </div>
                                                </a>
                                        </div>';
                                        $i++; 
                                    if ($i==3){
                                        break;
                                    }                                                                                  
                                }                     
                            ?>
                    </div>

                </div>
            </div>
            <footer>
                <hr style="border:solid 2px;color:blue;">
                <div class="row">
                    <div class="col-lg-6">
                        <p id="copyright"> </p>
                    </div>
                    <div class="col-lg-6">
                        <p id="fecha"> </p>
                    </div>

                </div>

            </footer>

        </div>    
        <script>
            function Permitir(){
                var nombre=document.getElementById("nombre").value;
                var clave=document.getElementById("clave").value;
                sessionStorage.setItem("PASSWORD",clave);
                if (clave=='admin'){
                    document.getElementById("salida").innerHTML="Bienvenido "+nombre;
                    document.getElementById("cuerpo").className="visible";
                }else{
                    document.getElementById("salida").innerHTML="Acceso denegado"
                }

            }
            //Para cargas artículos de fichero JSON
            let conexion= new XMLHttpRequest();
            conexion.onreadystatechange=function(){
                if(this.readyState==4 && this.status==200){
                    let objetojson=JSON.parse(this.responseText); 

                    for (a=0;objetojson.novedades[a];a++){
                        document.getElementById("novedades").innerHTML+=
                            `<br>
                            <hr style="border:solid 2px;color:green; ">
                            <h4>`+ objetojson.novedades[a].Titulo+ `</h4>
                            <p>`+ objetojson.novedades[a].Cuerpo+ `</p>`;
                    }                
                };
            };
            conexion.open("GET","noticias.json",true);
            conexion.send();

        </script>
        <script src="scripts/fecha.js"></script>

    </body>

</html>