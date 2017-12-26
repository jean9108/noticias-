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
    <link href="http://72.29.73.35/~sgesecurityfair/SGE/pafyc/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/main_1.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<?php  
include 'conexion.php';


$query = "SELECT * FROM noticias WHERE Mostrar=0 ORDER BY FechaNoticia DESC";
$result = mysql_query($query,$link); 
?>

<?php 
        define('HOST_DB', 'localhost');  //Nombre del host, nomalmente localhost
        define('USER_DB', 'sgesecurityfair_SGE');       //Usuario de la bbdd
        define('PASS_DB', 'VT!1ag3}#Xp.');           //Contraseña de la bbdd
        define('NAME_DB', 'sgesecurityfair_expositores'); //Nombre de la bbdd
?>
        
<div>
 <div class="row text-center">    
<?php
$cont =0;
if(mysql_num_rows($result) > 0)
{
    while ($row = mysql_fetch_array($result)){?>
     	<?php if($cont < 3):?>
        <?php 
            conectar();
            mysql_set_charset('utf8');
            $sql = "SELECT * FROM empresas WHERE EmpresaID=".$row['EmpresaIDFK'];
            $resultado = mysql_query($sql);//Ejecución de la consulta
        ?>
            <div class="col-sm-4 col-xs-4 column">	
		<div class="cliente"> 
                    <div class="col-sm-12  col-xs-12 view"> 
                        <div class="col-sm-12 col-xs-12 image-news">
                            <?php $directory = 'images';
                                echo "<a href='http://securityfaircolombia.com/index.php/noticias-completas' target = '_blank'>";
                                if($row['UrlArticulo'])
                                     echo "<img src='http://sge.securityfaircolombia.com/SGE/pafyc/images/content/".$row['UrlArticulo']."' alt=''/>";
                                else
                                    echo "<img src='../images/content/noticia.jpg' alt=''/>";
                                echo "</a>"
                            ?>              
                        </div>
                        <div class="titulo-noticia">
                            <?php if ($row2 = mysql_fetch_array($resultado))                    
                                    echo '<p>'.$row2['NombreEmpresa'].'</p>';
                            ?>                 
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <div class="contenido">
                                <?php $id = $row['NoticiaID'];?>
                                <p style='text-align:center;'><b><?php echo $row['TituloNoticia']; ?></b> </p>      
                                <p> <?php echo substr(strip_tags($row['DescripcionNoticia']),0,140).'...'; ?> 
                                 <?php echo "<a href='http://securityfaircolombia.com/index.php/noticias-completas' target = '_blank'>[+]</a>"; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php $cont+=1;   endif;?>
<?php } ?>
 </div> 
    <!-- Modal HTML -->
    <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div class="title-showroom" id="myModalLabel">
                        <h4 class="modal-title">
                            <i class='fa fa-eye' aria-hidden='true'></i> NOTICIAS EXPOSITORES 2017
                        </h4>
                    </div>      
                </div>
          
                <div id="contenido" class="row-fluid col-sm-12">

                </div>
                

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
     <div class="col-sm-12 col-xs-12 noticiabtn">
        <a href="http://securityfaircolombia.com/index.php/noticias-completas" class="btn btn-info" target="_blank" role="button" >Ver más Noticias</a>
    </div>
    
<?php }else{?>
      <?php echo "<div class='col-sm-12'><h1 class='text-center'>Espere noticias próximamente </h1> </div>";?>
<?php } ?>
</div>
   
<?php 
    //Liberar resultados
    mysql_free_result($result);
    //Cerrar la conexión
    mysql_close($link);
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
<script  type="text/javascript">
     $('#edit-modal').on('show.bs.modal', function(e) {
            var $modal = $(this),
                esseyId = e.relatedTarget.id;
                $productos = '<iframe width="100%" height="450px" src="http://localhost:8084/noticia/productos.php?NoticiasID='+esseyId+'" frameborder="0" allowfullscreen scrolling="yes"></iframe>';
                $("#contenido").html($productos);
                nombreEmpresa(esseyId);

        });

function nombreEmpresa(NoticiasID){
        var parametros = {"NoticiasID" : NoticiasID};
        $.ajax({
                data:  parametros,
                url:   'nombreempresa.php/EmpresaID?=parametros',
                type:  'POST',
                success:  function (response){$("#myModalLabel").html(response);}
        })
}
</script>
</body>
</html>