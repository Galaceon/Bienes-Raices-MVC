<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $blog->titulo; ?></h1>

    <img src="/blogImages/<?php echo $blog->imagen; ?>" alt="blog image">
    <div class="texto-entrada">
        <p>Escritorio el <span> <?php echo $blog->creado; ?> </span> por <span> <?php $blog->autor; ?> </span> </p>
    </div>

    <p> <?php echo $blog->contenido; ?> </p>
</main>