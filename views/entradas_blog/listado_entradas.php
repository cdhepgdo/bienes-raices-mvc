<?php foreach($entradas as $entrada) {?>

    <article class="entrada-blog">
        <div class="imagen">
            <picture>
                <!-- <source srcset="build/img/blog1.webp" type="image/webp">
                <source srcset="build/img/blog1.jpg" type="image/jpeg"> -->
                <img loading="lazy" src="/images_blog/<?php echo $entrada->imagen ?>" alt="texto entrada blogo">
            </picture>
        </div><!-- imagen -->

        <div class="texto-entrada">
            <a href="/entrada?id=<?php echo $entrada->id ?>">
                <h4><?php echo $entrada->titulo ?></h4>
                <p>Escrito el: <span><?php echo $entrada->fecha ?></span> Por <span><?php echo $entrada->autor ?></span> </p>

                <p>
                <?php echo $entrada->descripcion_corta ?>
                </p>
            </a>
        </div>
    </article><!-- articulo -->

<?php } ?>
