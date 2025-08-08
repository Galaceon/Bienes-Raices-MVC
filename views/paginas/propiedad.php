<main class="contenedor seccion contenido-centrado">
        <h1> <?php echo $propiedad->titulo; ?> </h1>

        <img src="imagenes/<?php echo $propiedad->imagen ?>" alt="anuncio image">

        <p class="precio"><?php echo $propiedad->precio; ?></p>

        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg">
                <p><?php echo $propiedad->wc; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg">
                <p><?php echo $propiedad->estacionamiento; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg">
                <p><?php echo $propiedad->habitaciones; ?></p>
            </li>
        </ul>

        <p> <?php echo $propiedad->descripcion; ?> </p>
    </main>