<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="language" content="es">

        <title>Noticias 2017</title>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href= "css/main.css" rel="stylesheet" type="text/css"/>
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php include 'conexion.php';?>
        <?php 
            $sql = "SELECT * FROM noticias WHERE mostrar = 1 OR mostrar = 0 ORDER BY FechaNoticia DESC";
            $result = mysql_query($sql,$link); 
        ?>
        <?php 
            define('HOST_DB', 'localhost');  //Nombre del host, nomalmente localhost
            define('USER_DB', 'sgesecurityfair_SGE');       //Usuario de la bbdd
            define('PASS_DB', 'VT!1ag3}#Xp.');           //Contraseña de la bbdd
            define('NAME_DB', 'sgesecurityfair_expositores'); //Nombre de la bbdd
        ?>
        
        <?php 
            conectar();
            mysql_set_charset('utf8');  
            $url = basename($_SERVER ["PHP_SELF"]);
            $empresa = "SELECT * FROM empresas";
            $resultado = mysql_query($empresa);//Ejecución de la consulta
            if (mysql_num_rows($resultado) > 0){?>
                <div class="container notciaesp">       
                    <div class="col-sm-6 ">
                        <form action="#" method="post">
                            <div class="col-sm-8"> 
                                <input list="browsers" name="browser" class="form-control" placeholder="Buscar por Empresa" autofocus>
                                <datalist id="browsers">
                                    <?php while($row = mysql_fetch_array($resultado)){?>
                                        <?php $val = explode(" ", $row['NombreEmpresa'])?>
                                        <?php echo '<option value ='.implode("_",$val).'>'.$row['NombreEmpresa'].'</option>' ?>
                                    <?php }?>   
                                </datalist>
                            </div>  
                            <div class="col-sm-4">
                                <input type="submit" name="submit" value="Buscar" class="btn btn-info"/>
                            </div>
                        </form>
                    </div>    
                    <div class="col-sm-6 ">
                        <form id="buscador" name="buscador" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>"> 
                            <div class="col-sm-8 noticiabus"> 
                                <input id="buscar" name="buscar" type="search" class="form-control" placeholder="Buscar por título o descripción de la noticia" autofocus >
                            </div>
                            <div class="col-sm-4">
                                <input type="submit" name="buscador" class="btn btn-info" value="Buscar">
                            </div>
                        </form>
                    </div>
                </div>
           <?php }
        ?>
        <?php if(mysql_num_rows($result) > 0){?>
             <?php
            $num_total_registros = mysql_num_rows($result);
            $TAMANO_PAGINA = 5;
            $pagina = false;

            if (isset($_GET["pagina"]))
                $pagina = $_GET["pagina"];
            if (!$pagina) {
                $inicio = 0;
                $pagina = 1;
            } else {
                $inicio = ($pagina - 1) * $TAMANO_PAGINA;
            }

            $total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
           
            $sql = "SELECT * FROM noticias WHERE mostrar = 1 OR mostrar = 0 ORDER BY FechaNoticia DESC LIMIT $inicio, $TAMANO_PAGINA";
            $rs = mysql_query($sql, $link);
            
            ?> 	
            <div class="container notciaesp">
             <?php while($row = mysql_fetch_array($rs)){?>
                <div class="col-sm-12 view2"> 
                    <div class="col-sm-3 col-sm-12 image-news2">
                        <?php $directory = 'images';
                            if($row['UrlArticulo'])
                                echo "<img src='http://72.29.73.35/~sgesecurityfair/SGE/pafyc/images/content/".$row['UrlArticulo']."' alt=''/>";
                            else
                                echo "<img src='../images/content/noticia.jpg' alt=''/>";
                        ?>
                    </div>
                    <div class="col-sm-9">
                        <div class="title-noticia">
                            <strong><?php echo '<p>'.$row['TituloNoticia'].'</p>'; ?></strong>
                        </div>
                        <div class="contenido">
                            <?php echo substr(strip_tags($row['DescripcionNoticia']),0,350).'...'; ?> 
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-xs-12 leer2">
                                <?php $id = $row['NoticiaID'];?>
                                <?php echo "<a class='btn btn-info btn-xs' data-toggle='modal' id=".$id." data-target='#edit-modal'><i class='fa fa-eye' aria-hidden='true'></i> Ver Noticia Completa</a>"; ?>
                            </div>
                            <div class = "col-sm-1 leer2">
                            	 <?php echo '<a class = "btn btn-primary btn-xs" href = "http://www.facebook.com/sharer.php?u=http://sge.securityfaircolombia.com/SGE/noticia/noticia.php?id='.$row["TituloNoticia"].'" target = "_blank"><i class="fa fa-facebook-official" aria-hidden="true"></i> Compartir</a>'?>
                            </div>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-4 col-xs-12 fecha">
                                <?php $date = substr($row['FechaNoticia'],0,-9)?>
                                <?php echo '<p><strong>[Fecha Publicaci&#243n : </strong>'.$date.'<strong>]</strong></p>'?>    
                            </div>
                        </div>
                    </div>
                </div>    
             <?php }?>
              <nav aria-label="" style = "text-align: right;">
                    <ul class="pagination pager">

                        <?php
                        if ($total_paginas > 1) {
                            if ($pagina != 1) {
                                echo ' <li class="page-item"><a class="page-link" href="' . $url . '?pagina=' . ($pagina - 1) . '">Anterior</a></li>';
                            }

                            for ($i = 1; $i <= $total_paginas; $i++) {
                                if ($pagina == $i)
                                    echo '<li class="page-item active"><a class="page-link" href="#"><b>' . $pagina . '</b></a></li>';
                                else {
                                    echo '<li class="page-item"><a class="page-link" href="' . $url . '?pagina=' . $i . '">' . $i . '</a></li>';
                                }
                            }
                            if ($pagina != $total_paginas) {
                                echo '<li class="page-item"><a class="page-link" href="' . $url . '?pagina=' . ($pagina + 1) . '">Siguiente</a></li>
';
                            }
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        
            
            <!-- Modal HTML -->
            <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <div class="title-showroom" id="myModalLabel">
                                <h4 class="modal-title">
                                    <i class="fa fa-newspaper-o"  aria-hidden="true"></i> NOTICIAS EXPOSITORES 2017
                                </h4>
                            </div>      
                        </div>
                        <header class="header">
                            <!--logo-->
                            <div class= "col-sm-12 img-logo">
                                <img src="http://72.29.73.35/~sgesecurityfair/SGE/pafyc/images/CabezoteWeb2.jpg" alt=""/>
                            </div>
                        </header>
                
                        <div id="contenido" class="row-fluid col-sm-12"></div>
                
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
        
        <?php 
            //Liberar resultados
            mysql_free_result($result);
            //Cerrar la conexión
            mysql_close($link);
        ?>
        <!--div class="col-sm-12 noticiabtn">
            <a href="http://securityfaircolombia.com/expositores/noticias/noticiasxfecha.php" class="btn btn-primary" role="button">Ver noticias anteriores</a>
        </div-->   
        
        <script  type="text/javascript">
            $('#edit-modal').on('show.bs.modal', function(e) {
                var $modal = $(this),
                esseyId = e.relatedTarget.id;
                $productos = '<iframe width="100%" height="450px" src="http://72.29.73.35/~sgesecurityfair/SGE/noticia/productos.php?NoticiasID='+esseyId+'" frameborder="0" allowfullscreen scrolling="yes"></iframe>';;
                $("#contenido").html($productos);
                nombreEmpresa(esseyId);
            });

            function nombreEmpresa(NoticiasID){
                var parametros = {"NoticiasID" : NoticiasID};
                $.ajax({
                    data:  parametros,
                    url:   'nombreempresa.php',
                    type:  'POST',
                    success:  function (response){$("#myModalLabel").html(response);}
                })
            }
        </script>
        
        <?php
            if($_POST){
                if (isset($_POST['submit'])) {
                    $selected_val = $_POST['browser'];  // Storing Selected Value In Variable
                    echo '<script type="text/javascript">
                            window.location.assign("http://72.29.73.35/~sgesecurityfair/SGE/noticia/empresanoticia.php?id='.$selected_val.'"); 
                    </script>';
                } else{
                    $busqueda = trim($_POST['buscar']);  
                    echo '<script type="text/javascript">
                        window.location.assign("http://72.29.73.35/~sgesecurityfair/SGE/noticia/noticiadescripcion.php?id='.$busqueda.'"); 
                    </script>';   
                }
            }
        ?>
        <?php
            // Definimos la conexión
            function conectar(){
                global $conexion;  //Definición global para poder utilizar en todo el contexto
                $conexion = mysql_connect(HOST_DB, USER_DB, PASS_DB)
                or die ('NO SE HA PODIDO CONECTAR AL MOTOR DE LA BASE DE DATOS');
                mysql_select_db(NAME_DB)
                or die ('NO SE ENCUENTRA LA BASE DE DATOS ' . NAME_DB);
            }
            function desconectar(){
                global $conexion;
                mysql_close($conexion);
            }   
        ?>
    </body>
</html>
