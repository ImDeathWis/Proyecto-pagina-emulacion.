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

<details><summary><h1><strong>🖥️ Crear y Configurar la Máquina Virtual en VirtualBox 🚀</strong></h1></summary>

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

<details><summary><h1><strong>⚙️ Instalación</strong></h1></summary>

<h2>Instalar Ubuntu en la Máquina Virtual 🖥️</h2>

Arranca la máquina con la ISO de <strong>Ubuntu Server</strong> y sigue la instalación:

- Configura un usuario, una contraseña y el idioma.
- Una vez finalizada la instalación, inicia sesión con el usuario creado.

<h2>Configurar la Red en Ubuntu 🌍</h2>

Dado que la red <strong>SMX2_Rednat1</strong> está configurada <strong>sin DHCP</strong>, la máquina con DHCP "Sophos firewall" será responsable de asignar la <strong>IP 192.168.6.14</strong>. Por lo tanto, será necesario asignar una <strong>IP estática</strong> a la máquina con Apache utilizando <strong>netplan</strong> para garantizar una configuración estable.

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
    <br>
  <pre><code>sudo netplan apply</code></pre>
  
  <li>Comprueba si la IP está configurada correctamente:</li>
  <br>
  <pre><code>sudo netplan try</code></pre>

  <li>Miramos el estado de la red:</li>
  <br>
  <pre><code>sudo networkctl status</code></pre>

  <li>Se deberán ver las siguientes configuraciones:</li><br>
  
  ![imagen1](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/imagenes/Imagen1.png)

<br>
  
  ![imagen2](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/imagenes/Imagen2.png)

</ol>
<h2>Instalar el Servidor Apache 🌐</h2>

Ahora instala <strong>Apache</strong>:

<ol>
  <li>Actualiza los paquetes y realiza la instalación:</li><br>
  <pre><code>sudo apt update
    sudo apt upgrade
    sudo apt install apache2</code></pre>

  <li>Verifica que Apache esté funcionando:</li><br>
  <pre><code>sudo systemctl status apache2</code></pre><br>

  ![imagen3](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/imagenes/Imagen3.png)

  <br>Si aparece como "active (running)" 👍, todo está bien.

</ol>

<h2>Crear y Configurar Apache 🌍</h2>
<ol>
  <li>Primero crearemos una carpeta con el nombre de nuestra web:</li>
    <br>
  <pre><code>sudo mkdir /var/www/retrogolt</code></pre>
  
  <li>Luego crearemos el archivo principal `index.html` dentro de la carpeta de nuestra web:</li>
    <br>
  <pre><code>sudo touch /var/www/retrogolt/index.html</code></pre>
  
  <li>Para luego entrar en el archivo `index.html` que creamos en la carpeta "retrogolt":</li>
  <br>
  <pre><code>sudo nano /var/www/retrogolt/index.html</code></pre>

  <li>Una vez dentro, escribiremos el código que nos sirva para nuestra página web (en este caso, pondré una página simple para mostrar que está funcionando):</li>
  <br>
  <pre><code>
          <!DOCTYPE html>
          <html lang="es">
          <head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>RetroGolt</title>
              <style>
                  body {
                      font-family: Arial, sans-serif;
                      background-color: #222;
                      color: white;
                      margin: 0;
                      padding: 0;
                      text-align: center;
                  }
                  header {
                      background-color: #f39c12;
                      padding: 20px;
                  }
                  header h1 {
                      font-size: 2em;
                      margin: 0;
                  }
                  .game-list {
                      margin-top: 30px;
                  }
                  .game-list h2 {
                      margin-bottom: 20px;
                  }
                  .game-item {
                      background-color: #444;
                      padding: 15px;
                      margin: 10px;
                      border-radius: 10px;
                  }
                  footer {
                      background-color: #333;
                      padding: 10px;
                      position: absolute;
                      width: 100%;
                      bottom: 0;
                  }
              </style>
          </head>
          <body>
          
              <header>
                  <h1>RetroBolt</h1>
                  <p>Juega los mejores clásicos arcade<br>"Actividad proyecto"</p>
              </header>
          
              <div class="game-list">
                  <h2>Juegos Clásicos</h2>
                  <div class="game-item">Pong</div>
                  <div class="game-item">Space Invaders</div>
                  <div class="game-item">Pac-Man</div>
                  <div class="game-item">Donkey Kong</div>
              </div>
          
              <footer>
                  <p>&copy; 2025 RetroBolt. Todos los derechos reservados para Luis Miguel y Mateo.</p>
              </footer>
          
          </body>
          </html>

  </code></pre>

  <li>Luego crearemos archivos de configuración para agregar nuestro dominio en Apache y configurar el sitio:</li><br>
  <pre><code>ls /etc/apache2/sites-available  # Esto lista los archivos .conf disponibles</code></pre>
  <pre><code>ls /etc/apache2/sites-enabled  # Esto muestra los sitios habilitados</code></pre>

  <li>Ahora, crearemos un archivo de configuración para nuestro dominio "retrogolt":</li><br>
    <pre><code>sudo touch /etc/apache2/sites-available/retrogold.conf</code></pre>

  <li>Verificamos que el archivo se haya creado correctamente:</li><br>
    <pre><code>ls /etc/apache2/sites-available</code></pre>

  <li>Una vez comprobado que el archivo está creado, vamos a editar el archivo "000-default.conf" para agregar nuestro dominio. Es importante verificar y modificar algunas configuraciones clave:</li>
  <pre><code>sudo nano /etc/apache2/sites-available/000-default.conf</code></pre>
</ol>
Se tendría que ver de esta manera por dentro, pero le tengo que quitar la "<" de delante del VirtualHost para que pueda verlo en GitHub.

<pre><code>
    VirtualHost *:80>
            #Nombre del dominio
            ServerName retrogold.es
            
            ServerAdmin webmaster@retrogold.es
            
            ServerAlias www.retrogold.es
            
            DirectoryIndex index.html
            
            #Carpeta raíz de nuestro sitio web
            DocumentRoot /var/www/retrogold
            
            ErrorLog ${APACHE_LOG_DIR}/error.log
            CustomLog ${APACHE_LOG_DIR}/access.log combined
            
            # For most configuration files from conf-available/, which are
            # enabled or disabled at a global level, it is possible to
            # include a line for only one particular virtual host. For example, the
            # following line enables the CGI configuration for this host only
            # after it has been globally disabled with "a2disconf".
            #Include conf-available/serve-cgi-bin.conf
    /VirtualHost>

    # vim: syntax=apache ts=4 sw=4 sts=4 sr noet
</code></pre>

Luego lo guardaré con el nombre "retrogold.conf" en vez de "000-default.conf".

<li>Luego haremos la comprobación de que la página esté correctamente configurada con:</li>
<pre><code>ls /etc/apache2/sites-enabled</code></pre>
<pre><code>ls /etc/apache2/sites-available</code></pre>

<li>Probablemente no estén habilitadas, así que lo activaremos con:</li>
<pre><code>sudo a2ensite retrogold.conf</code></pre>
<br>De esa manera tendremos activada la web.

<li>Luego recargaremos Apache para verificar que todo esté bien:</li>
<pre><code>sudo systemctl reload apache2</code></pre>

<li>Después, usaremos el siguiente comando para ver si nuestra página web está configurada correctamente:</li>
<pre><code>sudo apachectl -S</code></pre>

<br>![imagen4](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/imagenes/Imagen4.png)

</ol>

<h2>Configuración en el cliente</h2>

Después, en el cliente, como estará en la misma red, tendremos que configurar los hosts del cliente para que busque específicamente la página que creamos sin confundirse con otra. Usaremos el siguiente comando:

<ol>
  <li>Tendremos que añadir la dirección IP del servidor Apache más el nombre del dominio de la siguiente forma:</li><br>
  <pre><code>sudo nano /etc/hosts</code></pre><br>  
  <pre><code>
    127.0.0.1         localhost
    127.0.1.1         mateo-VirtualBox
    192.168.6.21      retrogold.es
# The following lines are desirable for IPv6 capable hosts
::1       ip6-localhost ip6-loopback
fe00::0   ip6-localnet
ff00::0   ip6-mcastprefix
ff02::1   ip6-allnodes
ff02::2   ip6-allrouters
</code></pre><br>  

De esta manera podremos buscar sin la necesidad de tener problemas a la hora de acceder mediante el dominio "retrogold.es" en la barra de búsqueda del Cliente. Podremos ver que nos busca sin problemas la página.
</ol>

</details>

<details><summary><h1><strong>Cosas que configurar y revisar "pendientes"</strong></h1></summary>

# ⚡ Guía para Montar RetroGold en Apache

### Habilitar Apache en el firewall (solo para CentOS/RHEL):
```bash
sudo firewall-cmd --add-service=http --permanent
sudo firewall-cmd --reload

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
</details>

<details><summary><h1><strong>🖥️ Otros Complementos Adicionales 🚀</strong></h1></summary>

  # Guía de Instalación de LAMP

## Introducción
LAMP (Linux, Apache, MySQL, PHP) es un conjunto de software utilizado para alojar sitios web dinámicos y aplicaciones web. Esta guía explica cómo instalar LAMP en Ubuntu 20.04.

## Requisitos Previos
- Un servidor Ubuntu 20.04 actualizado.
- Acceso a un usuario con privilegios de `sudo`.

## Paso 1: Actualizar el Sistema
Ejecuta el siguiente comando para actualizar la lista de paquetes:
```bash
sudo apt update && sudo apt upgrade -y
```

## Paso 2: Instalar Apache
Instala el servidor web Apache con:
```bash
sudo apt install apache2 -y
```
Verifica el estado del servicio:
```bash
sudo systemctl status apache2
```
Permite el tráfico HTTP y HTTPS en el firewall:
```bash
sudo ufw allow in "Apache Full"
```

## Paso 3: Instalar MySQL
Instala MySQL con:
```bash
sudo apt install mysql-server -y
```
Asegura la instalación ejecutando:
```bash
sudo mysql_secure_installation
```
Sigue las instrucciones en pantalla para configurar la seguridad de MySQL.

## Paso 4: Instalar PHP
Instala PHP y sus módulos necesarios:
```bash
sudo apt install php libapache2-mod-php php-mysql -y
```
Verifica la versión de PHP instalada:
```bash
php -v
```

## Paso 5: Configurar Apache para Priorizar PHP
Edita el archivo de configuración de Apache:
```bash
sudo nano /etc/apache2/mods-enabled/dir.conf
```
Asegúrate de que `index.php` esté primero:
```
DirectoryIndex index.php index.html index.cgi index.pl index.xhtml index.htm
```
Guarda y cierra el archivo, luego reinicia Apache:
```bash
sudo systemctl restart apache2
```

## Paso 6: Probar la Instalación de PHP
Crea un archivo de prueba:
```bash
sudo nano /var/www/html/info.php
```
Añade lo siguiente:
```php
<?php
phpinfo();
?>
```
Guarda y cierra el archivo, luego abre en un navegador:
```
http://tu-servidor/info.php
```
Si ves la información de PHP, la instalación fue exitosa.

## Conclusión
Has instalado correctamente la pila LAMP en Ubuntu 20.04. Ahora puedes comenzar a desarrollar y alojar tus aplicaciones web.


