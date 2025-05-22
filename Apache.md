# Configuración de Apache y Página Web en Ubuntu Server

<a href="https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/README.md" target="_blank">Haz clic aquí Para Volver a la Página Original</a>

<details><summary><h1><strong>🎮​Introducción al servicio Apache​👾​🎮</strong></h1></summary>

<h2>📌 ¿Qué es Apache?</h2>
Apache HTTP Server, es un servidor web de código abierto que nos permite la publicación de sitios web y aplicaciones en Internet o en redes locales. Es uno de los servidores web más utilizados en el mundo debido a su <strong>flexibilidad, estabilidad y compatibilidad con múltiples sistemas operativos</strong>.

<h2>❓ ¿Por qué es necesario?</h2>

✅ Permite alojar páginas web y aplicaciones de forma accesible desde Internet.  
✅ Soporta múltiples lenguajes de programación como <strong>PHP y Python</strong>.  
✅ Es altamente <strong>configurable</strong> y permite módulos para mejorar su funcionalidad.  
✅ Es <strong>seguro</strong>, con opciones avanzadas de autenticación y cifrado.      
✅ Funciona en plataformas como <strong>Linux, Windows y macOS</strong>. 

<h2>🌐 ¿Dónde hay información oficial?</h2>

https://www.digitalocean.com/community/tutorials/how-to-install-the-apache-web-server-on-ubuntu-20-04-es  
https://httpd.apache.org/docs/trunk/es/install.html  
https://www.ionos.es/digitalguide/servidores/configuracion/instalar-apache-en-ubuntu/  
https://extassisnetwork.com/tutoriales/como-instalar-apache-en-ubuntu/

</details>

<details><summary><h1><strong>🎨🖼️MOCKUP de nuestro Proyecto🖼️🎨</strong></h1></summary>
<p>Aquí subimos el link de nuestros mockup para que lo visualicen como sería la meta final (visual) de la Página Web.</p>

<h2>Previsualizacion de como se veria la WEB</h2>
https://www.figma.com/design/8jn705VLBuXTJVUrUUnT1i/Retrogold?node-id=0-1&p=f&t=EcJ4naGGRlGmIWIv-0

<h2>Mapa de navegación de como se veria la WEB en funsionamiento</h2>
https://www.figma.com/proto/8jn705VLBuXTJVUrUUnT1i/Retrogold?node-id=0-1&p=f&t=EcJ4naGGRlGmIWIv-0&scaling=scale-down&content-scaling=fixed&page-id=0%3A1&starting-point-node-id=3%3A15

</details>


<details><summary><h1><strong>🖥️ Detalles de la Máquina Virtual en VirtualBox 🚀</strong></h1></summary>

<h3>Detalles de la MV</h3>

- <strong>Nombre:</strong> `ServidorApache`
- <strong>Tipo:</strong> Ubuntu (64-bit)  

<h3>Asignación de Recursos</h3>

- <strong>3 procesadores</strong>  
- <strong>4096 MB de RAM</strong>  
- <strong>Disco de 25 GB</strong>
- <strong>ISO: ubuntu-24.04.1-live-server-amd64.iso</strong>  

<h3>Configuración de Red</h3>

- En <strong>Adaptador 1</strong>, selecciona `Red NAT` 🌐 con la red <strong>192.168.6.0/24</strong>.
  
</details>


<details><summary><h1>🌐 Instalación y Configuración de Apache para RetroGold</h1></summary>

Este documento resume los pasos realizados para instalar y configurar el servidor Apache que aloja la web de **RetroGold**.



<details><summary><h2>📦 Instalación de Apache</h2></summary>

```bash
sudo apt update && sudo apt upgrade -y
sudo apt install apache2 -y
sudo systemctl status apache2
```

Verificamos que Apache esté activo con:

```bash
sudo systemctl status apache2
```

</details>

<details><summary><h2>⚙️ Configuración de Apache</h2></summary>

La máquina del servidor recibe **IP estática 192.168.6.20** gracias al servidor **DHCP de Sophos**.  
Se configuró el archivo `/etc/apache2/sites-available/000-default.conf` para apuntar a la ruta del sitio web:

```apache
<VirtualHost *:80>
    ServerAdmin webmaster@retrogold.es
    DocumentRoot /var/www/retrogolds
    DirectoryIndex portada.html

    ServerName retrogold.es
    ServerAlias www.retrogold.com

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

Activamos y recargamos la configuración:

```bash
sudo a2ensite 000-default.conf
sudo systemctl reload apache2
sudo apachectl -S
```

</details>

<details><summary><h2>🧪 Configuración de Cliente (/etc/hosts)</h2></summary>

En la máquina cliente, añadimos la IP estática al archivo `/etc/hosts` para asociar el dominio `www.retrogold.com`:

```bash
sudo nano /etc/hosts
```

Y se añadió la siguiente línea:

```text
192.168.6.20    www.retrogold.com
```

Esto permite acceder correctamente al servidor Apache desde un navegador en la red local usando el dominio `www.retrogold.com`.

</details>

<details><summary><h2>🗃️ Base de Datos del Proyecto: web_retrogold</h2></summary>

Como parte del sistema de gestión de usuarios y roles de RetroGold, se diseñó y configuró una base de datos relacional llamada **`web_retrogold`** utilizando **MariaDB 10.4** y gestionada con **phpMyAdmin**.

### 📐 Estructura General

La base de datos se compone de las siguientes tablas clave:

- **usuarios**: Guarda la información principal de los usuarios registrados. Soporta roles `admin` y `user`.
- **administradores**: Información extendida sobre usuarios con privilegios elevados. Incluye estado `activo` o `suspendido`.
- **moderadores**: Encargados de validar las solicitudes de administrador. Guardan contraseña cifrada.
- **solicitudes_admin**: Recoge los formularios de los usuarios que desean ser administradores. Incluye estado (`pendiente`, `aceptado`, `rechazado`) y la contraseña encriptada que se validará.
- **claves_validas**: Tabla que contiene claves únicas generadas por moderadores para permitir el acceso restringido. Cada clave tiene un estado (`usada` o no).
- **mensaje**: Permite intercambiar mensajes simples entre usuarios registrados.

### 🔐 Seguridad

- Las contraseñas de usuarios, moderadores y administradores están cifradas con **bcrypt**.
- Solo se puede acceder a funciones administrativas usando una clave generada por un moderador y almacenada en `claves_validas`.
- Todas las tablas están indexadas correctamente con claves primarias y únicas para `correo` y `username` donde corresponde.

### 🧪 Datos de prueba incluidos

Se cargaron registros de prueba para validar el flujo completo del sistema, incluyendo solicitudes pendientes y usuarios ya registrados.

Esta base de datos alimenta todo el sistema de login, solicitudes y gestión de perfiles de RetroGold.

</details>


</details>

<details><summary><h2>💾 Código Fuente del Proyecto y Emuladores Integrados</h2></summary>

### 🌐 Repositorio Web del Proyecto RetroGold

Puedes ver el código fuente completo del sitio web aquí:  
🔗 [Código Web RetroGold (HTML, CSS, JS, PHP, SQL, Python)](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./tree/main/CODIGOWEB)

# 🧠 Resumen General del Funcionamiento de la Web RetroGold

**RetroGold** es una plataforma web que permite a los usuarios acceder y jugar videojuegos clásicos desde el navegador, además de gestionar un sistema completo de login, roles, administración y verificación mediante claves.

---

## 🎮 Emuladores Retro Integrados

La web ofrece integración directa en el navegador de los siguientes emuladores utilizando **WebAssembly**:

- **JSNES** (NES)  
- **MAME** (Arcade)  
- **JSN64** (Nintendo 64)  

📁 Las ROMs están almacenadas localmente y se enlazan dinámicamente desde la interfaz.

---

## 👤 Registro y Gestión de Usuarios

### 📝 `registerUser.html`
Formulario accesible para cualquier visitante para registrarse como **usuario normal**.  
- Guarda datos en la tabla `usuarios`.
- El rol asignado es automáticamente `user`.
- Acceso a emuladores y perfil.

### 🛂 `registerAdmin.html`
Formulario para solicitar acceso como **administrador**, pero solo mediante validación posterior.  
- El solicitante introduce sus datos y una contraseña que se guarda cifrada.
- La solicitud queda en estado `pendiente` en `solicitudes_admin`.

### 🔐 Verificación mediante Clave
- Una vez aceptado, el **moderador** genera una clave única que se guarda en `claves_validas`.
- El aspirante debe verificar su solicitud usando dicha clave para poder convertirse en administrador.

---

## 🔑 Inicio de Sesión (`login.html`)
- Valida credenciales con la base de datos (`usuarios`, `administradores`, `moderadores`).
- Redirige según el rol:
  - `user` ➜ `home.php`
  - `admin` ➜ `dashboardAdmin.php`
  - `moderador` ➜ `panelModerador.php` (u otra ruta según configuración)

---

## 🛡️ Roles y Permisos

### 👤 `user`
- Acceso a juegos, emuladores y su propio perfil.
- Puede navegar libremente por la interfaz retro.

### 🛠️ `admin`
- Accede a un panel de administración (`dashboardAdmin.php`).
- Visualiza usuarios, gestiona contenido, mensajes, y estadísticas.
- **No puede aprobar solicitudes ni generar claves.**

### 🧑‍⚖️ `moderador`
- Accede a un panel exclusivo de moderación.
- Revisa solicitudes desde `solicitudes_admin`.
- Acepta o rechaza candidatos a administrador.
- **Genera claves únicas** para validar el acceso de nuevos administradores.
- Puede ver contraseñas hasheadas y controlar accesos administrativos.

📝 **Resumen:** El **moderador** tiene control sobre el flujo de admisión de administradores. El **administrador** solo tiene acceso a herramientas de gestión interna, sin capacidad de modificar roles ni validar usuarios.

---

## ⚙️ Backend y Aplicación

- Lenguajes usados: HTML, CSS, JS, PHP, SQL, Python.
- Comunicación entre frontend y backend mediante AJAX y formularios.
- Uso de PHP para lógica de login, validación de claves, inserciones en base de datos.
- Base de datos `web_retrogold` con tablas: `usuarios`, `administradores`, `moderadores`, `claves_validas`, `solicitudes_admin`, `mensaje`.

---

✅ Todo el sistema corre sobre Apache en Ubuntu Server con IP estática.  
🔐 El acceso externo fue simulado mediante **SSL VPN Remote Access** (Sophos) y **Ngrok** para exponer servicios localmente.


### 🕹️ Enlaces a Emuladores Integrados

- 🎮 [Emulador JSNES (NES)](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/JSNES_Error_Report.md)  
- 🎮 [Emulador MAME (Arcade)](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/mame_wasm_guia.md)  
- 🎮 [Emulador JSN64 (Nintendo 64)](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/n64.md)  

Cada uno de estos emuladores está integrado en la interfaz web, usando WebAssembly para su funcionamiento en el navegador.

</details>


