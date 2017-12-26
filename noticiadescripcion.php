<?php
$v1=$_GET['id'];
define('HOST_DB', 'localhost');  //Nombre del host, nomalmente localhost
define('USER_DB', 'sgesecurityfair_SGE');       //Usuario de la bbdd
define('PASS_DB', 'VT!1ag3}#Xp.');           //Contraseña de la bbdd
define('NAME_DB', 'sgesecurityfair_expositores'); //Nombre de la bbdd
if(empty($v1)){
    echo 'No existen resultado con '.$v1;
    
}else{?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    	<meta name="viewport" content="width=device-width, user-scalable=no">
    	<meta name="viewport" content="width=device-width, initial-scale=1" />
    	<meta name="language" content="es">
    	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    	<link href="http://securityfaircolombia.com/pafyc/css/estilo.css" rel="stylesheet" type="text/css"/>
     	<link href= "css/main.css" rel="stylesheet" type="text/css"/>
    	<link href="css/custom.css" rel="stylesheet" type="text/css"/>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>
    <body>
    <?php conectar();
      mysql_set_charset('utf8');  
      $sql = "SELECT * FROM noticias WHERE DescripcionNoticia LIKE '%" .$v1. "%' AND Mostrar = 0  OR  TituloNoticia LIKE '%".$v1."%' AND Mostrar = 0 OR DescripcionNoticia LIKE '%" .$v1. "%' AND Mostrar = 1  OR  TituloNoticia LIKE '%".$v1."%' AND Mostrar = 1 ORDER BY FechaNoticia DESC";
//     SELECT * FROM `noticias` WHERE `DescripcionNoticia` LIKE '%Prueba%' AND `Mostrar` = 0 OR `TituloNoticia` LIKE '%siete%' AND `Mostrar` = 0 ORDER BY `NoticiaID` ASC
      $resultado = mysql_query($sql);//Ejecución de la consulta
     
      if (mysql_num_rows($resultado) > 0){
        // Se recoge el número de resultados
          if(mysql_num_rows($resultado) ==1){
              echo '<div class = "container busq"><p>Se encontro ' . mysql_num_rows($resultado) . ' noticia </p></div>';
          }else
            echo '<div class = "container busq"><p>Se encontraron ' . mysql_num_rows($resultado) . ' noticias </p></div>';
          while($row = mysql_fetch_array($resultado)){?>
            <div class="container">
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
                            <div class="col-sm-4 col-xs-12 leer">
                                <?php $id = $row['NoticiaID'];?>
                             
                                <?php echo "<a class='btn btn-primary btn-xs' data-toggle='modal' id=".$id." data-target='#edit-modal'><i class='fa fa-eye' aria-hidden='true'></i> Ver Noticia Completa</a>"; ?>
                            </div>
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4 col-xs-12 fecha">
                                <?php $date = substr($row['FechaNoticia'],0,-9)?>
                                <?php echo '<p><strong>[Fecha Publicación : </strong>'.$date.'<strong>]</strong></p>'?>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          <?php }?>
        
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
                
                <div id="contenido" class="row-fluid col-sm-12">

                </div>
                

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 noticiabtn">
        <a href="http://72.29.73.35/~sgesecurityfair/SGE/noticia/noticiacompleta2.php" class="btn btn-primary" role="button">Volver</a>
    </div>
      <?php  } else{?>
       <?php echo ("<script>
                   bootbox.alert('No se encontro noticias de la empresa', function(){
                    window.open('http://72.29.73.35/~sgesecurityfair/SGE/noticia/noticiacompleta2.php', '_self');
                    });
                    </script>");?>
<?php  }}?>
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
</body>
</html>