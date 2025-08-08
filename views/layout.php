<?php
    if (!isset($_SESSION)) {
        session_start();
    }

    $auth = $_SESSION['login'] ?? false;

    if(!isset($inicio)) {
        $inicio = false;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../build/css/app.css">
    <title>Bienes Raices</title>
</head>

<body>

    <?php
    if ($inicio) {
        include 'mainHeader.php';
    } else {
        include 'pagesHeader.php';
    }
    ?>



    <?php echo $contenido; ?>


    
    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="/nosotros">Nosotros</a>
                <a href="/propiedades">Anuncios</a>
                <a href="/blog">Blog</a>
                <a href="/contacto">Contacto</a>
            </nav>
        </div>
    <p class="copyright">Todos los Derecho Reservado <?php echo date('Y'); ?> &copy;</p>
    </footer>


    <script src="../build/js/bundle.min.js"></script>
</body>
</html>
