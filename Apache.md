# Configuración de Apache y Página Web en Ubuntu Server
<details><summary><h1><strong>🎮​Introducción al servicio Apache​👾​🎮</strong></h1></summary>

<h2>📌 ¿Qué es Apache?</h2>
Apache HTTP Server, es un servidor web de código abierto que nos permite la publicar de sitios web y aplicaciones en Internet o en redes locales. Es uno de los servidores web más utilizados en el mundo debido a su <strong>flexibilidad, estabilidad y compatibilidad con múltiples sistemas operativos</strong>.

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


<details><summary><h1><strong>🖥️ Crear y Configurar la Máquina Virtual en VirtualBox 🚀</strong></h1></summary>

<h3>Detalles de la MV</h3>
- <strong>Nombre:</strong> `ServidorApache`  
- <strong>Tipo:</strong> Ubuntu (64-bit)  

<h3>Asignación de Recursos</h3>

- <strong>3 procesadores</strong>  
- <strong>4096 GB de RAM</strong>  
- <strong>Disco de 25 GB</strong>
- <strong>ISO: ubuntu-24.04.1-live-server-amd64.iso<strong>  

<h3>Configuración de Red</h3>

- En <strong>Adaptador 1</strong>, selecciona `Red NAT` 🌐 con la red <strong>192.168.6.0/24</strong>.
  
</details>

<details><summary><h1><strong>⚙️ Instalación</strong></h1></summary>

<h2>Instalar Ubuntu en la Máquina Virtual 🖥️</h2>

Arranca la máquina con la ISO de <strong>Ubuntu Server</strong> y sigue la instalación:

- Configura un usuario, una contraseña y el idioma.
- Una vez finalizada la instalación, inicia sesión con el usuario creado.

<h2>Configurar la Red en Ubuntu 🌍</h2>

Dado que la red <strong>SMX2_Rednat1</strong> está configurada <strong>sin DHCP</strong>, la máquina con DHCP "sofphos firewall" será responsable de asignar la <strong>IP 192.168.6.14</strong>. Por lo tanto, será necesario asignar una <strong>IP estática</strong> a la máquina con Apache utilizando <strong>netplan</strong> para garantizar una configuración estable.

<ol>
  <li>Editaremos el archivo de configuración de red con el siguiente comando:</li>
  <pre><code>sudo nano /etc/netplan/00-installer-config.yaml</code></pre>

  <li>Ajusta la configuración de red como sigue:</li>
  <pre><code>network:
  version: 2
  ethernets:
    enp0s3:
      dhcp4: false
      addresses:
        - 192.168.6.21/24
      nameservers:
        addresses:
          - 192.168.6.10
          - 8.8.8.8
          - 9.9.9.9
      routes:
        - to: default
          via: 192.168.6.1
  </code></pre>

  <li>Guarda con `Ctrl + O`, luego sal con `Ctrl + X`.</li>
  
  <li>Aplica la configuración:</li>
  <pre><code>sudo netplan apply</code></pre>
  
  <li>Comprueba si la IP está configurada correctamente:</li>

  <pre><code>sudo netplan try</code></pre>
  
</ol>



</details>


## 4. Instalar el Servidor Apache 🌐

Ahora instala **Apache**:

1. Actualiza los paquetes y realiza la instalación:

    ```bash
    sudo apt update && sudo apt upgrade -y
    sudo apt install apache2 -y
    ```

2. Verifica que Apache esté funcionando:

    ```bash
    sudo systemctl status apache2
    ```

   Si aparece como "active (running)" 👍, todo está bien.

3. Permite el tráfico HTTP en el firewall:

    ```bash
    sudo ufw allow 80/tcp
    sudo ufw reload
    ```

4. Abre un navegador y entra a la dirección:

    ```
    http://192.168.6.21
    ```

   Si ves la página de **Apache**, ¡la instalación fue exitosa! 🎉

---

## 5. Instalar RetroArch Web 🎮 (POR AHORA NO LO INSTALARE HASTA QUE ALINA DE EL VISTO BUENO)

Instala las dependencias necesarias para compilar **RetroArch Web**:

1. Instala las dependencias:

    ```bash
    sudo apt install build-essential cmake git libSDL2-dev libasound2-dev emscripten -y
    ```

2. Descarga **RetroArch Web** en el directorio web:

    ```bash
    cd /var/www/html
    sudo git clone --recursive https://github.com/libretro/RetroArch.git retroarch
    cd retroarch
    ```

3. Compila **RetroArch para WebAssembly**:

    ```bash
    emconfigure ./configure --disable-video-opengl --enable-web
    emmake make
    ```

4. Después de compilar, el archivo `.html` generado será la versión web de RetroArch. 🚀

---

## 6. Configurar Apache para RetroArch ⚙️

Para que **Apache** sirva correctamente **RetroArch**, crea un nuevo **VirtualHost**:

1. Crea y edita el archivo de configuración del sitio:

    ```bash
    sudo nano /etc/apache2/sites-available/retroarch.conf
    ```

2. Añade la siguiente configuración:

    ```apache
    <VirtualHost *:80>
        DocumentRoot /var/www/html/retroarch
        ServerName retroarch.local
        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
    </VirtualHost>
    ```

3. Guarda el archivo y habilita el sitio:

    ```bash
    sudo a2ensite retroarch.conf
    sudo systemctl reload apache2
    ```

4. Abre un navegador y accede a:

    ```
    http://192.168.6.15
    ```

   Si ves **RetroArch Web** funcionando, ¡ya está todo listo! 🖥️🎮

---

## 7. Personalizar la Interfaz de RetroArch ✨

Si quieres personalizar la apariencia de **RetroArch**, edita los archivos **CSS** en:

```bash
/var/www/html/retroarch/assets/








# 📌 Configuración de Apache en Ubuntu + Clonar repositorio MAME (Red NAT 10.1.2.1)

## ✅ Requisitos previos
- Ubuntu Server instalado.
- Conexión a Internet.
- Acceso con permisos de superusuario (`sudo`).
- Red NAT con gateway `10.1.2.1`.

# ⚡ Guía para Montar RetroGold en Apache

## 1️⃣ Instalación de Apache

Para poder instalar Apache deberemos de seguir estos pasos

### Debian/Ubuntu:
```bash
sudo apt update && sudo apt install apache2 -y
```

### Iniciar el servicio:
```bash
sudo systemctl start apache2  # En Debian/Ubuntu
```

### Habilitar Apache para que se inicie automáticamente:
```bash
sudo systemctl enable apache2  # Debian/Ubuntu
```

---

## 2️⃣ Configurar Apache para Servir RetroGold

### Crear el directorio del proyecto:
```bash
sudo mkdir -p /var/www/retrogold
```

### Dar permisos al usuario (reemplaza `tuusuario` con tu nombre de usuario):
```bash
sudo chown -R tuusuario:www-data /var/www/retrogold
sudo chmod -R 755 /var/www/retrogold
```

### Crear un archivo de configuración para Apache:
```bash
sudo nano /etc/apache2/sites-available/retrogold.conf
```

### Contenido del archivo:
```apache
<VirtualHost *:80>
    ServerAdmin admin@retrogold.com
    DocumentRoot /var/www/retrogold
    ServerName retrogold.com
    ServerAlias www.retrogold.com

    <Directory /var/www/retrogold>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/retrogold_error.log
    CustomLog ${APACHE_LOG_DIR}/retrogold_access.log combined
</VirtualHost>
```

Guarda y cierra el archivo (`CTRL + X`, luego `Y` y `ENTER`).

### Activar el sitio y reiniciar Apache:
```bash
sudo a2ensite retrogold.conf
sudo systemctl restart apache2
```

### Habilitar Apache en el firewall (solo para CentOS/RHEL):
```bash
sudo firewall-cmd --add-service=http --permanent
sudo firewall-cmd --reload
```

---

## 3️⃣ Descargar e Integrar MAME en WebAssembly

### Clonar el repositorio de MAME:
```bash
git clone https://github.com/mamedev/mame.git
```

### Copiar la versión WebAssembly de MAME a la carpeta del proyecto:
```bash
cp -r mame/webassembly /var/www/retrogold/mame
```

### Agregar MAME en `index.html`:
```html
<script src="mame/mame.wasm.js"></script>
<script>
  async function startMAME() {
    const response = await fetch('mame/mame.wasm');
    const buffer = await response.arrayBuffer();
    MAME(buffer, { arguments: ["pacman"] });
  }
</script>
<button onclick="startMAME()">Iniciar MAME</button>
```

---

## 4️⃣ Configurar VSFTPD para las ROMs

### Instalar VSFTPD:
```bash
sudo apt install vsftpd -y  # Debian/Ubuntu
sudo yum install vsftpd -y   # CentOS/RHEL
```

### Editar la configuración de VSFTPD:
```bash
sudo nano /etc/vsftpd.conf
```

### Añadir o modificar las siguientes líneas:
```ini
anonymous_enable=NO
local_enable=YES
write_enable=YES
chroot_local_user=YES
pasv_enable=YES
pasv_min_port=40000
pasv_max_port=50000
```

Guarda y cierra el archivo (`CTRL + X`, luego `Y` y `ENTER`).

### Reiniciar VSFTPD:
```bash
sudo systemctl restart vsftpd
```

### Crear un directorio para las ROMs:
```bash
sudo mkdir -p /srv/ftp/roms
sudo chown ftp:ftp /srv/ftp/roms
```

Sube las ROMs a este directorio y verifica que se puedan descargar desde el navegador.

---

## 5️⃣ Conectar Apache con VSFTPD

En tu archivo `index.html`, usa JavaScript para listar y cargar las ROMs desde VSFTPD:
```html
<script>
async function loadROMs() {
    let response = await fetch('ftp://tu-servidor-ftp/roms/');
    let roms = await response.text();
    document.getElementById('rom-list').innerHTML = roms;
}
</script>
<button onclick="loadROMs()">Cargar ROMs</button>
<div id="rom-list"></div>
```

---

## 6️⃣ ¡Prueba RetroGold!

Abre en el navegador:
```bash
http://tu-ip-o-dominio
```

Deberías ver la interfaz y poder iniciar MAME con los juegos del servidor FTP. 🎮🚀
