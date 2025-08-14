<main class="contenedor seccion contenido-centrado">
    <h1>Contacto</h1>

    <?php if($mensaje) { ?>
        <p class='alerta exito'> <?php echo $mensaje ?> </p>;
    <?php } ?>

    <img src="build/img/destacada3.webp" alt="contacto image">

    <h2>Llene el formulario de Contacto</h2>

    <form class="formulario" method="POST" action="/contacto">
        <fieldset>
            <legend>Informacion Personal</legend>

            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Tu nombre" id="nombre" name="contacto[nombre]">

            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="contacto[mensaje]"></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobre la Propiedad</legend>

            <label for="mensaje">Vende o Compra:</label>
            <select id="opciones" name="contacto[tipo]">
                <option value="" disabled selected>--- Seleccione ---</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="presupuesto">Precio o presupuesto</label>
            <input type="number" placeholder="Tu precio o presupuesto" id="presupuesto" name="contacto[precio]">
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>

            <p>Como desea ser contactado:</p>

            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]">

                <label for="contactar-email">Email</label>
                <input type="radio" value="email" id="contactar-email" name="contacto[contacto]">
            </div>

            <div id="contacto">
                <!-- JS llamada y Email form -->
            </div>
        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>