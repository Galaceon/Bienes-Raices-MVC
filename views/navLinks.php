<div class="barra">
    <a href="/">
        <img src="/build/img/logo.svg" alt="Logotipo de Bienes Raices">
    </a>

    <div class="mobile-menu">
        <img src="build/img/barras.svg" alt="icono menu responsive">
    </div>

    <div class="derecha">
        <img class="dark-mode-boton" src="/build/img/dark-mode.svg">
        <nav class="navegacion">
            <a href="nosotros">Nosotros</a>
            <a href="propiedades">Anuncios</a>
            <a href="blog">Blog</a>
            <a href="contacto">Contacto</a>
            <?php if($auth) : ?>
                <a href="cerrar-sesion">Cerrar Sesion</a>
            <?php endif; ?>
            </nav>
    </div>
</div> <!--.barra -->