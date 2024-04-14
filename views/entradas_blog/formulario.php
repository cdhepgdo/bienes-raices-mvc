<fieldset>
    <legend>Informacion General</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="titulo" placeholder="titulo de Entrada" value="<?php echo s($entrada->titulo); ?>">
    
    <label for="fecha">Fecha:</label>
    <input type="date" id="fecha" name="fecha" placeholder="Fecha de Entrada" value="<?php echo s($entrada->fecha); ?>">
    
    <label for="autor">Autor:</label>
    <input type="text" id="autor" name="autor" placeholder="autor de Entrada" value="<?php echo s($entrada->autor); ?>">
    
    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">
    <?php if($_SERVER['PATH_INFO'] === '/entradas_blog/actualizar'){ ?>
    <?php if($entrada->imagen){ ?>
        <img src="<?php echo '/images_blog/' . $entrada->imagen; ?>" alt="imagen-small" class="imagen-propiedad">
    <?php } ?>
    <?php } ?>
    
</fieldset>

<fieldset>
    <legend>Informacion Adicional</legend>

    <label for="descripcion_corta">Descripcion corta:</label>
    <input type="text" id="descripcion
    _corta" name="descripcion_corta" placeholder="Descripcion corta de Entrada" value="<?php echo s($entrada->descripcion_corta); ?>">

    <label for="descripcion_completa">Descripcion Completa:</label>
    <input type="text" id="descripcion
    _completa" name="descripcion_completa" placeholder="Descripcion completa de Entrada" value="<?php echo s($entrada->descripcion_completa); ?>">

</fieldset>