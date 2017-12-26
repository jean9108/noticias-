<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     
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

<?php 
    $conn = new mysqli("localhost","sgesecurityfair_SGE","VT!1ag3}#Xp.","sgesecurityfair_expositores");
?>
<body>
<?php  
include 'conexion.php';
$v1=$_GET['id'];
$v2 = explode("_", $v1);
$v1 = implode(" ", $v2);

$sql1= "SELECT * FROM `empresas` WHERE `NombreEmpresa` LIKE '%$v1%'";
$documento = 0;
if($result = $conn->query($sql1)){
    $fila = $result->fetch_assoc();
    $documento=$fila['EmpresaID'];
}
$conn->close();

$query = "SELECT * FROM noticias WHERE Mostrar=0 AND EmpresaIDFK = $documento OR Mostrar = 1 AND EmpresaIDFK = $documento ORDER BY FechaNoticia DESC";
$result = mysql_query($query, $link); 
?>

<div style="padding:30px;">
<?php
if(mysql_num_rows($result) > 0)
{
    while($row = mysql_fetch_array($result)){?>
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
<?php } ?>
    
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
<?php }else{?>
     <?php echo ("<script>
                   bootbox.alert('No se encontro noticias de la empresa', function(){
                    window.open('http://72.29.73.35/~sgesecurityfair/SGE/noticia/noticiacompleta2.php', '_self');
                    });
                    </script>");?>
<?php } ?>
</div>
   
<?php 
    //Liberar resultados
    mysql_free_result($result);
    //Cerrar la conexión
    mysql_close($link);
?>

<script  type="text/javascript">
     $('#edit-modal').on('show.bs.modal', function(e){
            var $modal = $(this),
                esseyId = e.relatedTarget.id;
                $productos = '<iframe width="100%" height="450px" src="http://72.29.73.35/~sgesecurityfair/SGE/noticia/productos.php?NoticiasID='+esseyId+'" frameborder="0" allowfullscreen scrolling="yes"></iframe>';
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

