<main class="contenedor seccion">
    <h1>Más Sobre Nosotros</h1>

    <?php include 'iconos.php'; ?>
</main>

<section class="contenedor anuncios">
    <h2>Casas y Departamentos en Venta</h2>

    <?php
        include 'listado.php'; 
    ?>

    <div class="alinear-derecha">
        <a href="/propiedades" class="boton-verde">Ver Todas</a>
    </div>
</section>

<section class="imagen-contacto">
    <h2>Encuentra la casa de tus sueños</h2>
    <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la breveda</p>
    <a href="contacto.php" class="boton-amarillo">Contactanos</a>
</section>

<div class="contenedor secction seccion-inferior">
    <section class="blog">
        <h3>Nuestro Blog</h3>

        <?php foreach($blogs as $blog) : ?>
        <article class="entrada-blog">
            <div class="imagen">
                <img loading="lazy" src="/blogImages/<?php echo $blog->imagen; ?>" alt="blog image">
            </div>

            <div class="texto-entrada">
                <a href="/entrada?id=<?php echo $blog->id; ?>" class="index-entrada">
                    <h4><?php echo $blog->titulo; ?></h4>
                    <p>Escritorio el: <span> <?php echo $blog->creado; ?> </span> por: <span> <?php echo $blog->autor; ?> </span> </p>

                    <p> <?php echo $blog->contenido; ?> </p>
                </a>
            </div>
        </article>
        <?php endforeach; ?>
    </section>

    <section class="testimoniales">
        <h3>Testimoniales</h3>

        <div class="testimonial">
            <blockquote>
                El personal se comportó de una excelente forma, muy buena atención y la casa que me
                ofrecieron cumple con todas mis expectativas.
            </blockquote>
            <p>- Antonio Jesus Garcia</p>
        </div>
    </section>
</div>