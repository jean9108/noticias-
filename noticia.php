<?php
include 'conexion.php';
$archi = $_GET['id'];
$query = "SELECT * FROM `noticias` WHERE `TituloNoticia` LIKE '$archi'";
$result = mysql_query($query, $link);
?>

<?php while ($row = mysql_fetch_array($result)) { ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <meta name="viewport" content="width=device-width, user-scalable=no">
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <meta name="language" content="es">
            <title><?php $row['TituloNoticia'] ?></title>
            <meta property="og:type"   content="website" /> 
            <meta property="og:title" content="<?php echo $row['TituloNoticia'] ?>" />
            <meta property="og:description" content=" <?php echo substr(strip_tags($row['DescripcionNoticia']), 0, 350); ?> " />
            <meta property="og:image" content="http://sge.securityfaircolombia.com/SGE/pafyc/images/content/<?php echo $row['UrlArticulo'] ?>"/>
            <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
            <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link href= "css/main.css" rel="stylesheet" type="text/css"/>
            <!--<link href="css/custom.css" rel="stylesheet" type="text/css"/>-->
        </head>

        <body class ="bodyC">
            <header class ="headerNoticia">
                <div class="container">
                    <!--logo-->
                    <div class= "col-sm-12 col-xs-12 logo">

                        <img src="http://sge.securityfaircolombia.com/SGE/pafyc/images/CabezoteWeb2.jpg"/>

                    </div>
                </div>
            </header>
            <div class="container page"> 
                <div class="title-noticia">
                    <h1><?php echo $row['TituloNoticia'] ?></h1>
                </div>
                <div class="col-sm-12 image-news3">
                    <img src = "http://72.29.73.35/~sgesecurityfair/SGE/pafyc/images/content/<?php echo $row['UrlArticulo']; ?>"/>
                </div>
                <div class="col-sm-12 contenido">
                    <?php echo $row['DescripcionNoticia']; ?> 
                </div>
                <div class="col-sm-6 col-xs-12 fecha2">
                    <?php $date = substr($row['FechaNoticia'], 0, -9) ?>
                    <?php echo '<p><strong>[Fecha Publicaci&#243n : </strong>' . $date . '<strong>]</strong></p>' ?>    
                </div>
                <div class="col-sm-6 col-xs-12 vermas">
                    <a href="http://securityfaircolombia.com/index.php/noticias-completas" class = "btn btn-info"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Ver más noticias</a>
                </div>
            </div>
            <footer id = "foo">
                <div class="container">
                    <div class="bottom-fixclear"></div>
                    <div class="col-sm-4">
                        <img src="http://sge.securityfaircolombia.com/SGE/pafyc/images/copyright.png">
                    </div>

                    <div class="col-sm-3 description">
                        <p>&copy; 2016
                            <strong>INTERNATIONAL SECURITY FAIR 2016</strong>
                            .Todos los derechos reservados.
                            <br/>
                            Site Powered by
                            <a href="http://www.dataglobal.com.co" target="_blank">Data Global SAS</a> 	
                        </p>
                    </div>
                    <div class="col-sm-4 red">
                        <div class = "col-sm-12">
                            <div class="col-sm-4">
                                <h5>REDES SOCIALES</h5>
                            </div>
                            <div class="col-sm-1">
                                <a href="https://twitter.com/Securityfair" target = "_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            </div>
                            <div class="col-sm-1">
                                <a href="https://www.facebook.com/FeriaInternacionaldeSeguridad" target = "_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            </div>
                            <div class="col-sm-1">
                                <a href="https://www.linkedin.com/start/join?session_redirect=https%3A%2F%2Fwww.linkedin.com%2Fcompany%2Fferia-internacional-de-seguridad-e-s&source=ripf&trk=login_reg_redirect" target = "_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                            </div>
                            <div class="col-sm-1">
                                <a href="https://www.youtube.com/channel/UCo0piTpeYarLc4W7LRH6R1Q" target = "_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </body>

    </html>
    <?php
}?>