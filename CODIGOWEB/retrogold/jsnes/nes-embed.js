// Nes-Embed.js - Código básico para integrar JSNES en una página web.

var nes;

function nes_load_url(url) {
    fetch(url)
        .then(response => response.arrayBuffer())
        .then(data => {
            nes.loadROM(data);
            nes.start();
        })
        .catch(error => {
            console.error("Error al cargar la ROM:", error);
        });
}

// Inicialización del emulador NES
function initNES() {
    var canvas = document.getElementById("nes-canvas"); // Asegúrate de que tengas un canvas en tu HTML
    nes = new JSNES({
        ui: {
            update: function(framebuffer_32) {
                // Establece los píxeles en el canvas
                var ctx = canvas.getContext('2d');
                var imageData = ctx.createImageData(256, 240); // Resolución NES
                var data = imageData.data;
                for (var i = 0; i < framebuffer_32.length; i++) {
                    var color = framebuffer_32[i];
                    data[i * 4] = (color >> 16) & 0xFF;
                    data[i * 4 + 1] = (color >> 8) & 0xFF;
                    data[i * 4 + 2] = color & 0xFF;
                    data[i * 4 + 3] = 255; // Opacidad total
                }
                ctx.putImageData(imageData, 0, 0);
            }
        },
        onload: function() {
            console.log("Emulador cargado correctamente");
        }
    });
}

// Ejecuta el emulador con una ROM por URL
window.onload = function() {
    initNES();
    // Reemplaza 'ruta/a/tu/rom.nes' con la ubicación de tu ROM
    nes_load_url('ruta/a/tu/rom.nes');
};
