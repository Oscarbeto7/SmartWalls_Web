@extends('layouts.plantilla')
@section('title', 'SmartWalls')
@section('content')
<section id="main-content">
<section id="contenedor">
            <section id="hero-image" >
                <img src="../img/ImagenCasa1.png" alt="Remodelaciones" style="width: 100%; height: auto;">
                <div class="text-container">
                    <h1 class="main-title animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">Remodelaciones y</h1>
                    <h1 class="main-title animate__animated animate__fadeInUp" style="animation-delay: 0.6s;">renovaciones</h1>
                    <h1 class="main-title animate__animated animate__fadeInUp" style="animation-delay: 0.8s;">domésticas</h1>
                    <h3 class="sub-title animate__animated animate__fadeInUp" style="animation-delay: 1s;">Usa nuestra app para controlar tus paredes y tu casa</h3>
                    <a href="#acerca_de2">
                        <button id="btn-more-info" class="animate__animated animate__fadeInUp" style="animation-delay: 1.2s;" title="Mas informacion">Ubicanos</button>
                    </a>
                    
                </div>
            </section>
            
            <section id="acerca_de" class="hidden" style="animation-delay: 0.4s;">
                <div class="container">
                    <div class="row">
                        <div class="col izquierda">
                            <h2 class="hidden" style="animation-delay: 0.8s;">Nosotros</h2>
                            <h4 class="hidden" style="animation-delay: 1s;">SmartWalls, el control de tu hogar en la palma de tu mano.</h4>
                            <p class="hidden" style="animation-delay: 1s;">
                                SmartWalls es sistema residencial dedicado a la remodelación y construcción de casas inteligentes con tecnología IoT desarrollado por Code OPS.
                            </p>
                        </div>
                        <div class="col derecha hidden" style="animation-delay: 0.8s;">
                            <iframe width="315" height="560" src="https://www.youtube.com/embed/ThYd7xpzCic" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </section>
            
            <section id="servicios" class="hidden" style="animation-delay: 0.4s;">
    <div class="container2 my-5">
        <h2 class="hidden" style="animation-delay: 0.1s;">Nuestros servicios</h2>
        <div class="info-cards">
            <div class="info-card hidden"  style="background-image: url('../img/lucesInteligentes.webp'); animation-delay: 0.4s;">
                <div class="card-bg"></div>
                <div class="card-content">
                    <h3>Luces inteligentes</h3>
                    <p>Controla la iluminación de tu hogar desde la app: enciende, apaga y ajusta la intensidad con un solo toque.</p>
                </div>
            </div>
            <div class="info-card hidden"  style="background-image: url('../img/ParedesInteligentes.jpg'); animation-delay: 0.6s;">
                <div class="card-bg"></div>
                <div class="card-content">
                    <h3>Paredes móviles</h3>
                    <p>Transforma tus espacios al instante con paredes que se adaptan a tus necesidades con solo presionar un botón.</p>
                </div>
            </div>
            <div class="info-card hidden" style="background-image: url('../img/ImagenCalefaccion.jpg'); animation-delay: 0.8s;">
                <div class="card-bg"></div>
                <div class="card-content">
                    <h3>Sistema de prevención</h3>
                    <p>Detecta fugas de gas en tiempo real y recibe alertas inmediatas para mantener tu hogar seguro.</p>
                </div>
            </div>
        </div>
    </div>
</section>

            
            

            

            <section id="listo">
                <div class="container_listo">
                    <div class="row">
                        <!-- Parte izquierda: Imagen -->
                        <div class="col izquierda animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                            <img src="../img/ImagenCasa3.jpeg" alt="Imagen sobre SmartWalls" />
                            <!-- Capa oscura sobre la imagen -->
                            <div class="text-container">
                                <h2>¿Preparado?</h2>
                            </div>
                        </div>
            
                        <!-- Parte derecha: Texto y botón -->
                        <div class="col derecha animate__animated animate__fadeInUp" style="animation-delay: 0.8s;">
                            <h4>Si estas preparado para renovar tu hogar haz clic en el botón de "Empezar" y envíanos tu solicitud para poder contactarnos contigo y brindarte nuestros servicios.</h4>
                            <a href="../src/login.html">
                                <button class="hero-button">Empezar</button>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            
            <section id="acerca_de2" class="hidden" style="animation-delay: 0.4s;">
                <div class="container">
                    <div class="row">
                        <!-- Parte izquierda: Texto -->
                        <div class="col izquierda hidden" style="animation-delay: 0.8s;">
                            <h2 class="hidden" style="animation-delay: 0.8s;">Ubicanos</h2>
                            <h4 class="hidden" style="animation-delay: 0.8s;">SmartWalls, el control de tu hogar en la palma de tu mano.</h4>
                            <p class="hidden" style="animation-delay: 0.8s;">
                                Encuentra nuestras oficinas generales en Av. Fray. A. Alcalde 10 44100 Guad., Jal., México
                            </p>
                        </div>
            
                        <!-- Parte derecha: Mapa de Google Maps -->
                        <div class="col derecha hidden" style="animation-delay: 0.8s;" >
                            <div id="map" style="height: 400px; width: 100%;"></div>
                            <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=iniciarMap" async defer></script>
                            <script src="../js/scriptmaps.js"></script>
                        </div>
                    </div>
                </div>
    </section>
@endsection()

