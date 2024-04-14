<main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesion</h1>

        <?php foreach($errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach;?>


        <form method="POST" class="formulario">
            <fieldset>
                <legend>Email y Password</legend>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $admin->email ?>" placeholder="Tu E-Mail" autocomplete="on" required><!-- email -->

                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="<?php echo $admin->password ?>" placeholder="Tu password" required><!-- passwoerd -->

            </fieldset>

            <input type="submit" value="Iniciar sesion" class="boton boton-verde">
        </form>
    </main>