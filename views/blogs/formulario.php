<fieldset>
    <legend>Crea tu Post:</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="blog[titulo]" placeholder="Titulo" value="<?php echo s($blog->titulo); ?>">

    <label for="autor">Autor:</label>
    <input type="text" id=autor" name="blog[autor]" placeholder="Autor del Post" value="<?php echo s($blog->autor); ?>">

    <label for="contenido">Contenido:</label>
    <textarea id="contenido" name="blog[contenido]"><?php echo s($blog->contenido); ?></textarea>

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpg, image/png, image/jpeg" name="blog[imagen]">

    <?php if($blog->imagen) { ?>
        <img src="/blogImages/<?php echo $blog->imagen ?>" class="imagen-small">
    <?php } ?>
                

</fieldset>