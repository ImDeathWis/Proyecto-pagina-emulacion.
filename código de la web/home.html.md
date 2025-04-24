<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto-Luismi-Mateo</title>
    <link rel="stylesheet" href="css/styles-home.css">
</head>
<body>

    <!-- Menú Transparente -->
    <header class="menu">
        <a href="home.html">
            <img src="fotos/logo.png" alt="Logo" class="logo"> 
         </a>
        <nav>
            <a href="login.html">Login</a>
            <a href="register.html">Register</a>
            
    </header>

    <!-- Carrusel de fondo -->
    <div class="carousel">
        <div class="carousel-1">
            <div class="carousel-a">
                <img src="fotos/fondo1.jpg" alt="">
            </div>
            <div class="carousel-a">
                <img src="fotos/fondo2.jpg" alt="">
            </div>
            <div class="carousel-a">
                <img src="fotos/fondo1.jpg" alt="">
            </div>
            <div class="carousel-a">
                <img src="fotos/fondo2.jpg" alt="">
            </div>
        </div>
    </div>

    <!-- Carrusel de plataformas de emulación -->
    <div class="container">
        <div class="mySlides">
            <img src="fotos/n64.png" alt="Nintendo 64">
        </div>
        <div class="mySlides">
            <img src="fotos/mame.png" alt="MAME">
        </div>
        <div class="mySlides">
            <img src="fotos/nes.png" alt="NES">
        </div>
        
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>

        <div class="elements">
            <span class="quadrate" onclick="currentSlide(1)"></span>
            <span class="quadrate" onclick="currentSlide(2)"></span>
            <span class="quadrate" onclick="currentSlide(3)"></span>
        </div>
    </div>


    <script src="script.js"></script>
</body>
</html>

