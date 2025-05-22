const canvas = document.getElementById('pantalla');
const ctx = canvas.getContext('2d');

const nes = new jsnes.NES({
  onFrame(framebuffer_24) {
    const imageData = ctx.createImageData(256, 240);
    for (let i = 0; i < framebuffer_24.length; i++) {
      const pixel = framebuffer_24[i];
      imageData.data[i * 4] = (pixel >> 16) & 0xFF;
      imageData.data[i * 4 + 1] = (pixel >> 8) & 0xFF;
      imageData.data[i * 4 + 2] = pixel & 0xFF;
      imageData.data[i * 4 + 3] = 0xFF;
    }
    ctx.putImageData(imageData, 0, 0);
  },
  onStatusUpdate: console.log,
  emulateSound: true
});

// Añadimos método start manual
nes.start = function() {
  if (nes._interval) clearInterval(nes._interval);
  nes._interval = setInterval(() => {
    try {
      nes.frame();
    } catch (e) {
      console.error("Error ejecutando un frame NES:", e);
      clearInterval(nes._interval);
    }
  }, 1000 / 60);
};

fetch('roms.json')
  .then(res => res.json())
  .then(roms => {
    const selector = document.getElementById('romSelector');
    roms.forEach(nombre => {
      const opt = document.createElement('option');
      opt.value = nombre;
      opt.textContent = nombre.replace('.nes', '');
      selector.appendChild(opt);
    });
  });

function cargarROM() {
  const rom = document.getElementById('romSelector').value;
  
  if (!rom) {
    console.error("No se ha seleccionado ninguna ROM.");
    return;
  }
  
  fetch(`roms/${rom}`)
    .then(res => res.arrayBuffer())
    .then(buffer => {
      nes.reset(); // <- IMPORTANTE: Limpia antes
      nes.loadROM(String.fromCharCode(...new Uint8Array(buffer)));
      nes.start(); // <- Inicia animación
    })
    .catch(error => {
      console.error("Error al cargar ROM:", error);
    });

  // Registrar clic en el emulador NES
  fetch("../Home/registrar_click.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: "emulador=nes"
  });

}

// Mapear teclas
const teclas = {
  'KeyW': jsnes.Controller.BUTTON_UP,
  'KeyA': jsnes.Controller.BUTTON_LEFT,
  'KeyS': jsnes.Controller.BUTTON_DOWN,
  'KeyD': jsnes.Controller.BUTTON_RIGHT,
  'KeyN': jsnes.Controller.BUTTON_SELECT,
  'KeyM': jsnes.Controller.BUTTON_START,
  'KeyJ': jsnes.Controller.BUTTON_A,
  'KeyK': jsnes.Controller.BUTTON_B
};

document.addEventListener('keydown', (e) => {
  if (teclas[e.code] !== undefined) {
    nes.buttonDown(1, teclas[e.code]);
    e.preventDefault();
  }
});

document.addEventListener('keyup', (e) => {
  if (teclas[e.code] !== undefined) {
    nes.buttonUp(1, teclas[e.code]);
    e.preventDefault();
  }
});

