[VOLVER ATRÁS](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/README.md)

# 🛠️ Errores encontrados en el proyecto JSNES RetroEmulator

## 🔴 1. RangeError: Maximum call stack size exceeded (Desbordamiento de pila)
**Causa:**  
Se estaba iniciando el bucle `nes.start()` múltiples veces sin detener el anterior. Cada vez que se cargaba una ROM, se iniciaba un `setInterval` adicional, lo que causaba una pila infinita.

**Solución:**  
Antes de iniciar `nes.start()`, limpiar el ciclo anterior con:
```js
if (nes._interval) clearInterval(nes._interval);
```

---

## 🔴 2. ROM inválida: `Not a valid NES ROM`
**Causa:**  
- Algunas ROMs tenían formato incorrecto o estaban dañadas.  
- Se usaba `String.fromCharCode(...new Uint8Array(buffer))`, lo que corrompía los datos binarios.

**Solución:**  
Pasar directamente un `Uint8Array` a `nes.loadROM()`:
```js
fetch(`roms/${rom}`)
  .then(res => res.arrayBuffer())
  .then(buffer => {
    nes.loadROM(new Uint8Array(buffer));
    nes.start();
  });
```

---

## 🔴 3. ROM incompatible: `This ROM uses a mapper not supported by JSNES`
**Causa:**  
La ROM usaba un **mapper** no compatible con JSNES (ej. Pirate Mapper 91).

**Solución:**  
Solo usar ROMs con mappers compatibles:
- Mapper 0 (NROM)
- Mapper 1 (MMC1)
- Mapper 2 (UNROM)
- Mapper 3 (CNROM)
- Mapper 4 (MMC3)

Ejemplos compatibles: Super Mario Bros, Donkey Kong, Tetris (Nintendo).

---

## 🔴 4. Error de ejecución: `this.nes.stop is not a function`
**Causa:**  
Se intentó llamar a `nes.frame()` desde un `setInterval`, pero `nes` estaba mal reinicializado y no tenía método `start()` definido.

**Solución:**  
- Asegurarse de crear `nes` una sola vez correctamente.
- Agregar el método `start()` de forma manual si JSNES no lo trae:
```js
nes.start = function () {
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
```

---

## 🔴 5. Error de carga: `fetch('roms.json')` falla o devuelve vacío
**Causa:**  
- El archivo `roms.json` tenía errores de sintaxis.
- El navegador cacheaba una versión antigua.
- Algunas rutas a las ROMs estaban mal escritas.

**Solución:**  
- Corregir el JSON con comas y formato válido:
```json
[
  "SuperMarioBros.nes",
  "Donkey Kong.nes",
  "KirbysAdventure.nes"
]
```
- Forzar recarga con Ctrl+Shift+R.
- Manejar errores del fetch:
```js
fetch('roms.json')
  .then(res => {
    if (!res.ok) throw new Error("No se pudo cargar roms.json");
    return res.json();
  })
  .catch(err => console.error("Error cargando roms.json:", err));
```

---

## 🔴 6. Estructura incorrecta de carpetas
**Causa:**  
Las ROMs no estaban ubicadas donde el `fetch()` las buscaba.

**Solución:**  
Mantener esta estructura exacta:
```
/index.html
/emulador.js
/roms.json
/roms/
    SuperMarioBros.nes
    Donkey Kong.nes
    ...
/estilos.css
/js/jsnes.min.js
```

---

# ✅ Resumen final de cambios importantes

- ✔️ Controlar el ciclo de frames para evitar bucles infinitos (`clearInterval`).
- ✔️ Cargar las ROMs como `Uint8Array`, no como string.
- ✔️ Verificar que las ROMs sean válidas y compatibles con JSNES.
- ✔️ Mantener una estructura de carpetas clara y precisa.
- ✔️ Manejar errores al usar `fetch` con `roms.json`.
- ✔️ Definir correctamente el método `nes.start()` si no existe por defecto.

---

# 💡 Recomendaciones finales

- ✅ Probar nuevas ROMs primero en emuladores como **Nestopia** o **FCEUX**.
- ✅ Validar archivos `.json` con herramientas online (como [JSONLint](https://jsonlint.com/)).
- ✅ Usar un servidor local como **Live Server (VSCode)** o `python -m http.server` para evitar errores de ruta.
- ✅ Monitorear consola del navegador (F12 → Consola) para detectar errores JS o 404.
---

# 🚀 Cómo implementar JSNES en un sitio web (Guía rápida)

## 📁 1. Estructura recomendada de archivos

```
/index.html
/emulador.js
/js/jsnes.min.js
/roms.json
/roms/
    SuperMarioBros.nes
    Donkey Kong.nes
    ...
```

## 🔗 2. Incluir JSNES en tu HTML

```html
<script src="js/jsnes.min.js"></script>
<script src="emulador.js"></script>
```

## 🎮 3. Crear un canvas para el emulador

```html
<canvas id="pantalla" width="256" height="240"></canvas>
<select id="romSelector" onchange="cargarROM()"></select>
```

## ⚙️ 4. Código base de `emulador.js`

```js
const canvas = document.getElementById('pantalla');
const ctx = canvas.getContext('2d');

const nes = new jsnes.NES({
  onFrame(framebuffer_24) {
    const imageData = ctx.createImageData(256, 240);
    for (let i = 0; i < framebuffer_24.length; i++) {
      const pixel = framebuffer_24[i];
      imageData.data[i * 4 + 0] = (pixel >> 16) & 0xFF;
      imageData.data[i * 4 + 1] = (pixel >> 8) & 0xFF;
      imageData.data[i * 4 + 2] = pixel & 0xFF;
      imageData.data[i * 4 + 3] = 0xFF;
    }
    ctx.putImageData(imageData, 0, 0);
  }
});

// Método para emular frames
nes.start = function () {
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

// Cargar lista de ROMs
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

// Cargar ROM seleccionada
function cargarROM() {
  const rom = document.getElementById('romSelector').value;
  fetch(`roms/${rom}`)
    .then(res => res.arrayBuffer())
    .then(buffer => {
      nes.reset();
      nes.loadROM(new TextDecoder('latin1').decode(buffer));
      nes.start();
    });
}
```

## ⌨️ 5. Controles de teclado

```js
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
  if (teclas[e.code]) {
    nes.buttonDown(1, teclas[e.code]);
    e.preventDefault();
  }
});
document.addEventListener('keyup', (e) => {
  if (teclas[e.code]) {
    nes.buttonUp(1, teclas[e.code]);
    e.preventDefault();
  }
});
```
