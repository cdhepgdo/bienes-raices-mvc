<main class="contenedor seccion admin">
        <h1>Administrador  Bienes Raices</h1>

        <?php if ($mensaje) { ?>
            <p class="alerta exito"><?php echo $mensaje; ?></p>
        <?php } ?>

        <h2>Propiedades</h2>
        <a href="./propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
        <a href="./vendedores/crear" class="boton boton-amarillo">Nuev@ Vendedor/a</a>
        <a href="./entradas_blog/crear" class="boton boton-amarillo">Nueva Entrada de  Blog</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($propiedades as $propiedad) { ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td><img src="../imagenF/<?php echo $propiedad->imagen; ?>" alt="" class="imagen-tabla"></td>
                    <td><?php echo $propiedad->precio; ?></td>
                    <td>
                        <form method="POST" class="w-100" action="propiedades/eliminar">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="./propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php }; ?><!-- fin del while -->
            </tbody>
        </table>

        <!-- vendedores -->
        <h2>Vendedores</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($vendedores as $vendedor) { ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <form method="POST" class="w-100" action="./vendedores/eliminar">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="./vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php }; ?><!-- fin del while -->
            </tbody>
        </table>

        <h2>Entradas de Blog</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Fecha</th>
                    <th>Autor</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($entradas as $entrada) { ?>
                <tr>
                    <td><?php echo $entrada->id; ?></td>
                    <td><?php echo $entrada->titulo ; ?></td>
                    <td><?php echo $entrada->fecha; ?></td>
                    <td><?php echo $entrada->autor; ?></td>
                    <td><img src="../images_blog/<?php echo $entrada->imagen; ?>" class="imagen-tabla"></td>
                    <td>
                        <form method="POST" class="w-100" action="./entradas_blog/eliminar">
                            <input type="hidden" name="id" value="<?php echo $entrada->id; ?>">
                            <input type="hidden" name="tipo" value="entrada">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="./entradas_blog/actualizar?id=<?php echo $entrada->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php }; ?><!-- fin del while -->
            </tbody>
        </table>
</main>