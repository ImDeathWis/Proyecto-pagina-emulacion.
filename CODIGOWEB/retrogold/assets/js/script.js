document.addEventListener("DOMContentLoaded", () => {
    const toggle = document.getElementById("menu-toggle");
    const menu = document.getElementById("menu-vertical");

    toggle.addEventListener("click", () => {
        menu.style.display = menu.style.display === "block" ? "none" : "block";
    });
});

/* codigo de carrusel de imagenes para los emuladores */
let slideIndex = 1;
showSlides(slideIndex)

function plusSlides(n){
    showSlides(slideIndex += n)
}
function currentSlide(n){
    showSlides(slideIndex = n)
}
function showSlides(n){
    let i;
    let slides = document.querySelectorAll(".mySlides");
    let quadrates = document.querySelectorAll(".quadrate"); 
    if(n > slides.length) slideIndex = 1
    if(n < 1) slideIndex = slides.length
    for(i = 0; i < slides.length; i++){
        slides[i].style.display = "none"
    }
    for(i = 0; i < quadrates.length;i++){
        quadrates[i].className = quadrates[i].className.replace("active","")
    }
    slides[slideIndex-1].style.display = "block";
    quadrates[slideIndex-1].className += " active";
}


/* ventana emergente */
function mostrarAdvertencia() {
    document.getElementById("alertaTelefono").style.display = "block";
}

function cerrarAdvertencia() {
    document.getElementById("alertaTelefono").style.display = "none";
}