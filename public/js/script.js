//menu hamburguesa
// Seleccionar el menú de hamburguesa y las opciones de navegación
const hamburgerMenu = document.getElementById("hamburger-menu");
const navItems = document.querySelector(".divisiones");

// Función para alternar el menú
hamburgerMenu.addEventListener("click", () => {
    navItems.classList.toggle("active");
});
//fin



// Cuando el usuario se desplaza hacia abajo 20px desde la parte superior de la página, muestra el botón
window.onscroll = function() { scrollFunction() };

function scrollFunction() {
    const backToTopBtn = document.getElementById("backToTopBtn");
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        backToTopBtn.classList.add("show"); // Añade la clase que muestra el botón
        backToTopBtn.classList.remove("hide"); // Asegúrate de que se elimine la clase de ocultar
    } else {
        backToTopBtn.classList.remove("show"); // Quita la clase que muestra el botón
        backToTopBtn.classList.add("hide"); // Añade la clase que oculta el botón
    }
}

//script animacion de entrada://
// Esperar a que el contenido del DOM esté completamente cargado
document.addEventListener("DOMContentLoaded", function () {
    window.addEventListener("scroll", function () {
        const elements = document.querySelectorAll(".hidden");

        elements.forEach(element => {
            const rect = element.getBoundingClientRect();
            const isVisible = rect.top < window.innerHeight && rect.bottom >= 0;

            console.log("Rect top:", rect.top, "Rect bottom:", rect.bottom);  // Para depuración

            if (isVisible) {
                element.classList.remove("hidden");
                element.classList.add("animate__animated", "animate__fadeInUp");
            }
        });
    });
});
//fin//

// Función para desplazarse hacia arriba de manera suave
function scrollToTop(duration) {
    const start = window.scrollY; // Posición actual de desplazamiento
    const startTime = performance.now(); // Tiempo inicial

    // Función de animación
    function animation(currentTime) {
        const elapsed = currentTime - startTime; // Tiempo transcurrido
        const t = Math.min(elapsed / duration, 1); // Normalizar el tiempo entre 0 y 1

        // Usar una función de easing que empieza lento y se acelera
        const easing = 0.5 * (1 - Math.cos(Math.PI * t)); // Easing "ease-in-out" mejorado

        // Desplazamiento hacia arriba
        window.scrollTo(0, start * (1 - easing)); // Desplazamiento hacia la parte superior

        // Continuar la animación si el tiempo no ha terminado
        if (elapsed < duration) {
            requestAnimationFrame(animation); // Llama a la función de animación en el siguiente frame
        }
    }

    requestAnimationFrame(animation); // Inicia la animación
}

// Cuando el usuario haga clic en el botón, vuelve al inicio de la página
document.getElementById("backToTopBtn").addEventListener("click", function() {
    scrollToTop(500); // Ajusta el tiempo de desplazamiento en milisegundos
});
//script para el boton para ir hasta arriba


//script para el header
let prevScrollPos = window.pageYOffset;
const header = document.getElementById("main-header");

window.addEventListener("scroll", () => {
    const currentScrollPos = window.pageYOffset;

    if (prevScrollPos > currentScrollPos) {
        // El usuario está subiendo
        header.style.transform = "translateY(0)";
    } else {
        // El usuario está bajando
        header.style.transform = "translateY(-100%)";
    }

    prevScrollPos = currentScrollPos;
});
//fin script header

