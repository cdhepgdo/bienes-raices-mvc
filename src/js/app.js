
const mobileMenu = document.querySelector('.mobile-menu')
const navegacion = document.querySelector('.navegacion.hd')

const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');




document.addEventListener('DOMContentLoaded', function(){
    
    eventListener();
    darkmode();
    metodoContacto.forEach(input => {
        input.addEventListener('click', mostrarTipoContacto)
    });
});

function mostrarTipoContacto(e){
    const contacto = document.querySelector('#contacto');
    if (e.target.value === 'telefono') {
        contacto.innerHTML = 
        `
        <!-- <label for="telefono">Telelfono</label>-->
        <input name="contacto[telefono]" type="tel" id="telefono" placeholder="Tu Telefono"><!-- telefono -->

        <p>elija la fecha y la hora para ser contactado por telefono</p>
        
        <label for="fecha">Fecha</label>
        <input name="contacto[fecha]" type="date" id="fecha"><!-- fecha -->
        
        <label for="hora">Hora</label>
        <input name="contacto[hora]" type="time" id="hora" min="09:00" max="18:00"><!-- hora -->
        `;
    }else{
        contacto.innerHTML = 
        `
        <label for="email">Email</label>
        <input name="contacto[email]" type="email" id="email" placeholder="Tu E-Mail" autocomplete="on" required><!-- email -->
        `;
    }
}

function darkmode(){
    const preferDarkmode = window.matchMedia('(prefers-color-scheme: dark)');
    if (preferDarkmode) {
        document.body.classList.add('dark-mode')
    }else{
        document.body.classList.remove('dark-mode')
    }

    preferDarkmode.addEventListener('change', function(){
        if (preferDarkmode) {
            document.body.classList.add('dark-mode')
        }else{
            document.body.classList.remove('dark-mode')
        }
    })

    const darkBoton = document.querySelector('.dark-mode-boton');

    darkBoton.addEventListener('click', function(){
        document.body.classList.toggle('dark-mode')
    })
}

function eventListener(){
    mobileMenu.addEventListener('click', mostrar)
}

function mostrar(){
    navegacion.classList.toggle('mostrar')
}


