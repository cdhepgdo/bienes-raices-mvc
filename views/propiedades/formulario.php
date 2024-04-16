    <fieldset>
        <legend>Informacion General</legend>

        <label for="titulo">Titulo:</label>
        <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo s($propiedad->titulo); ?>">

        <label for="Precio">Precio:</label>
        <input type="number" id="Precio" name="precio" placeholder="Precio Propiedad" value="<?php echo s($propiedad->precio); ?>">

        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" name="propiedad[imagen]" accept="image/jpeg, image/png" >
        <?php if(strpos($_SERVER['REQUEST_URI'], '/propiedades/actualizar') !== false) { ?>
        <?php if($propiedad->imagen){ ?>
            <img src="<?php echo '/imagenF/' . $propiedad->imagen; ?>" alt="imagen-small" class="imagen-propiedad">
        <?php } ?>
        <?php } ?>

        <label for="descripcion">Descripcion:</label>
        <textarea id="Descripcion" name="descripcion"><?php echo s($propiedad->descripcion); ?></textarea>
        
    </fieldset>

    <fieldset>
        <legend>Informacion Propiedad</legend>

        <label for="habitaciones">Habitaciones:</label>
        <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->habitaciones); ?>">
        
        <label for="wc">Baños:</label>
        <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->wc); ?>">

        <label for="estacionamiento">Estacionamiento:</label>
        <input type="number" id="estacionamiento" name="estacionamientos" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->estacionamientos); ?>">
    </fieldset>
    <fieldset>
        <legend>Vendedor</legend>

        <select name="vendedores_id">
            <option value="">--Seleccione--</option>
            <?php foreach($vendedores as $vendedor) { ?>

            <option <?php echo $propiedad->vendedores_id === $vendedor->id ? 'selected' : ''; ?> value="<?php echo s($vendedor->id); ?>">
                <?php echo $vendedor->nombre . " " . $vendedor->apellido.$vendedor->id; ?>
            </option>

            <?php }; ?><!-- fin del while -->
        </select>
    </fieldset>
            
