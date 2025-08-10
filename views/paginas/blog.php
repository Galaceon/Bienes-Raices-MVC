<main class="blog contenedor contenido-centrado">
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
</main>