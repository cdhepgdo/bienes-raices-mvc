<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad->titulo ?></h1>

    <img loading="lazy" src="/imagenF/<?php echo $propiedad->imagen ?>" alt="anuncio">

    <div class="resumen-propiedad">
        <p class="precio"><?php echo $propiedad->precio ?> $</p>

        <ul class="iconos-caracteristicas">
            <li>
                <img loading="lazy" src="/build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad->wc ?></p>
            </li>
            <li>
                <img loading="lazy" src="/build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p><?php echo $propiedad->estacionamientos ?></p>
            </li>
            <li>
                <img loading="lazy" src="/build/img/icono_dormitorio.svg" alt="icono dormitorio">
                <p><?php echo $propiedad->habitaciones ?></p>
            </li>
        </ul>

        <p><?php echo $propiedad->descripcion ?></p>

        <p>Quas, deleniti neque consectetur voluptatibus tenetur assumenda ducimus aut pariatur excepturi doloremque? Itaque accusamus perspiciatis blanditiis facilis voluptatibus!</p>
    </div>
</main>