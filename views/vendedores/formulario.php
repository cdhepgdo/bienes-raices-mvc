<fieldset>
    <legend>Informacion General</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" placeholder="Nombre Vendedor(a)" value="<?php echo s($vendedor->nombre); ?>">

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="apellido" placeholder="Apellido Vendedor(a)" value="<?php echo s($vendedor->apellido); ?>">
        
</fieldset>

<fieldset>
    <legend>Informacion Adicional</legend>
    <label for="telefono">Telefono:</label>
    <input type="number" id="telefono" name="telefono" placeholder="Vendedor(a) Telefono" value="<?php echo s($vendedor->telefono); ?>">

</fieldset>