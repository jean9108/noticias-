<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
        <link href="http://72.29.73.35/~sgesecurityfair/SGE/pafyc/css/estilo.css" rel="stylesheet" type="text/css"/>
        <link href="http://72.29.73.35/~sgesecurityfair/SGE/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
            include 'conexion.php';
            $NoticiasID=$_GET['NoticiasID'];
            $query = "SELECT * FROM noticias WHERE NoticiaID= $NoticiasID";
            $result = mysql_query($query,$link);  
        ?>
        <div class="container">
            <?php while($row = mysql_fetch_array($result)){?>
                <div class="col-sm-12 iframe-title">
                    <h3><?php echo $row['TituloNoticia']?></h3>
                </div>

                <div class="col-sm-12 iframe-img">    
                    <?php  echo "<img src='http://72.29.73.35/~sgesecurityfair/SGE/pafyc/images/content/".$row['UrlArticulo']."' alt=''/>";?>
                </div>
        
            <div class="col-sm-12 iframe-contenido">
                    <?php  echo strip_tags($row['DescripcionNoticia']) ?>
                </div>
            <?php }?>
        </div>    
    </body>

</html>