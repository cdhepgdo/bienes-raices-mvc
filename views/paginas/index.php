<main class="contenedor seccion">
        <h1>Mas Sobre Nosotros</h1>

        <?php include 'iconos.php' ?>
    </main> 

    <section class="seccion contenedor">
        <h2>Casas y Depas en Venta!</h2>

        <?php 
        //$limite = 3;
        //require "./includes/config/databases.php";
        include "listado.php"; 
        
        ?>

        <div class="alinear-derecha">
            <a href="/propiedades" class="boton-verde">Ver Todas</a>
        </div>
    </section><!-- seccion anuncios -->

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>llena el formulario y un asesor se pondra en contacto contigo a la brevedad</p>
        <a href="/contacto" class="boton-amarillo-block">Contactanos</a>
    </section><!-- seccion contacto -->

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <!-- <h3>Nuestro Blog</h3> -->

            <?php include '../views/entradas_blog/entradas_blog.php' ?>

            

        </section><!-- seccion blog -->

        <section class="testimoniales">
            <h3>Testimoniales</h3>

            <div class="testimonial">
                <blockquote>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet, neque vero? Amet placeat fugit officia esse veritatis temporibus, impedit officiis reprehenderit maxime dolor
                </blockquote>
                <p>- Fulano de Tal</p>
            </div>
        </section>

    </div><!-- cont seccion -->