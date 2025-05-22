[VOLVER ATRÁS](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/README.md)

# 🕹️ Compilación de MAME en WebAssembly (WASM) desde Ubuntu

Este documento detalla el proceso, incidencias y soluciones al compilar MAME para WebAssembly usando Emscripten desde Ubuntu, tras un intento fallido inicial en MSYS2/MinGW64.

---

## ✅ Intento Inicial (Windows - MSYS2 / MinGW64)

- Se intentó compilar MAME en Windows usando MSYS2 y el entorno MinGW64.
- Resultado: errores relacionados con dependencias, configuración de entorno, y limitaciones de compatibilidad al usar Emscripten.
- Decisión: cambiar a Ubuntu 22.04 LTS para aprovechar mejor las herramientas de desarrollo y compatibilidad con Emscripten.

---

## ⚙️ Entorno de Trabajo en Ubuntu

### 1. Clonar el repositorio de MAME

```bash
git clone https://github.com/mamedev/mame.git
cd mame
```

### 2. Configurar Emscripten (si no está instalado)

```bash
git clone https://github.com/emscripten-core/emsdk.git
cd emsdk
./emsdk install latest
./emsdk activate latest
source ./emsdk_env.sh
```

---

## ⚠️ Incidencias y Soluciones durante la compilación

### ❌ Error 1: Versión de GCC insuficiente

```text
GCC version 9.4.0 detected — GCC version 10.3 or later needed
```

✅ **Solución: instalar GCC 11**

```bash
sudo add-apt-repository ppa:ubuntu-toolchain-r/test
sudo apt update
sudo apt install gcc-11 g++-11
sudo update-alternatives --install /usr/bin/gcc gcc /usr/bin/gcc-11 100
sudo update-alternatives --install /usr/bin/g++ g++ /usr/bin/g++-11 100
```

---

### ❌ Error 2: Falta Qt5

```text
No package 'Qt5Widgets' found
Qt's Meta Object Compiler (moc) wasn't found!
```

✅ **Solución: instalar Qt5**

```bash
sudo apt install qtbase5-dev qttools5-dev qttools5-dev-tools
```

---

### ❌ Error 3: Falta SDL2/SDL_ttf.h

```text
fatal error: SDL2/SDL_ttf.h: No such file or directory
```

✅ **Solución: instalar SDL2 y SDL2_ttf**

```bash
sudo apt install libsdl2-dev libsdl2-ttf-dev
```

---

## 🚀 Compilación Final

Una vez todas las dependencias instaladas:

```bash
make -j$(nproc) TOOLS=0 NOWERROR=1 EMSCRIPTEN=1
```

> Esto genera los archivos `mame.wasm`, `mame.js` y `mame.html` (opcional) para ejecutar desde navegador.

---

## 📁 Estructura Recomendada

```
/mame/
├── index.html
├── mame.js
├── mame.wasm
└── roms/
    ├── sf2.zip
    ├── kof2002.zip
    └── ...
```

---

## 📝 Notas

- La compilación puede tardar de **30 a 90 minutos**, dependiendo del hardware.
- Se recomienda utilizar un SSD y cerrar programas en segundo plano para mejorar el rendimiento.
- El archivo `index.html` debe estar adaptado a la carga de ROMs por `mame.js`.

---

## ✨ Próximos pasos

- Integrar `mame.js` en una web retro tipo Windows 98 o estilo arcade.
- Cargar ROMs dinámicamente desde servidor o VSFTPD.
- Crear historial de partidas y perfiles.
