<main class="contenedor seccion contenido-centrado">
        <h1><?php echo $entrada->titulo ?></h1>

        <picture>
            <!-- <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg"> -->
            <img loading="lazy" src="/images_blog/<?php echo $entrada->imagen ?>" alt="imagen de anuncio">
        </picture>

        <p class="informacion-meta">Escrito el: <span><?php echo $entrada->fecha ?></span> por: <span><?php echo $entrada->autor ?></span></p>

        <div class="resumen-propiedad">

            <p><?php echo $entrada->descripcion_completa ?></p>

            <p>Quas, deleniti neque consectetur voluptatibus tenetur assumenda ducimus aut pariatur excepturi doloremque? Itaque accusamus perspiciatis blanditiis facilis voluptatibus!</p>
        </div>
    </main>