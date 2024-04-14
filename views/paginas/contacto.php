<main class="contenedor seccion">
        <h1>Contacto</h1>

        <?php 
       // debuguear($mensaje);
            if($mensaje){
                echo "
                    <div class=\"alerta exito\">
                        <p>$mensaje </p>
                    </div>
                ";
            }
        ?>
    

        <picture>
            <!-- <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg"> -->
            <img loading="lazy" src="/build/img/destacada3.jpg" alt="imagendestacada">
        </picture>

        <h2>Llene el formulario de Contacto</h2>

        <form action="/contacto" class="formulario" method="POST">
            <fieldset>
                <legend>Informacion Personal</legend>

                <label for="nombre">Nombre</label>
                <input name="contacto[nombre]" type="text" id="nombre" placeholder="Tu nombre" required> <!-- nombre -->

                <label for="mensaje">Mensaje</label>
                <textarea name="contacto[mensaje]" id="mensaje" cols="0" rows="1"></textarea required><!-- mensaje -->

            </fieldset>

            <fieldset>
                <legend>Informacion Sobre la Propiedad</legend>
                
                <label for="opciones">Vende o Compra</label>
                <select name="contacto[tipo]" id="opciones" required>
                    <option value="" disabled selected>--Seleccione--</option>
                    <option value="compra">Compra</option>
                    <option value="vende">Vende</option>
                </select><!-- vende o compra -->

                <label for="presupuesto">Precio o Presupuesto</label>
                <input name="contacto[precio]" type="number" id="presupuesto" placeholder="Tu Presupuesto" required><!--presupuesto -->

            </fieldset>

            <fieldset>
                <legend>Contacto</legend>

                <p>Eliga la forma que desea ser contactado</p>
                
                <div class="forma-contacto">
                    <label for="contactar-telefono">Telefono</label>
                    <input name="contacto[contacto]" type="radio" id="contactar-telefono" value="telefono" required>
                    
                    <label for="contactar-email">Email</label>
                    <input name="contacto[contacto]" type="radio" id="contactar-email" value="email" required>
                </div>

                <div id="contacto"></div>
            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>