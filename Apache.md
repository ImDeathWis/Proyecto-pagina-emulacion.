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
    <br>
  <pre><code>sudo netplan apply</code></pre>
  
  <li>Comprueba si la IP está configurada correctamente:</li>
  <br>
  <pre><code>sudo netplan try</code></pre>

  <li>Miraremos el estado de la red</li>
  <br>
  <pre><code>sudo networkctl status</code></pre>

  <li>Se tendrán que ver de esta forma</li><br>
  
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
  <li>Primero crearemos una carpeta con nuetro nombre de nuestra web</li>
    <br>
  <pre><code>sudo mkdir /var/www/retrogolt</code></pre>
  
  <li>Luego crearemos la carpeta en la ruta "retrogolt", con el nombre de nuestra web</li>
    <br>
  <pre><code>sudo touch /var/www/retrogolt/index.html</code></pre>
  
  <li>Para luego entrar dentro del archivo index que creamos en la carpeta retrobolt</li>
  <br>
  <pre><code>sudo nano/var/www/retrogolt/index.html</code></pre>

  <li>Una vez dentro escribiremos el codigo que nos vaya a servir pa nuestra página web "en este caso pondre una pagina simple para que se sepa que va"</li>
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

  <li>Luego aquí creamos archivos de configuración, para hacerle una pregunta al apache que dominios tengo, para luego crearlo:</li><br>
  <pre><code>ls /etc/apache2/sites-available  #con esto ver los archivos que .conf que hay no solo por defecto.
    ls /etc/apache2/sites-enable  # con esta otra podremos ver la carpetas que etan disponibles como websites.</code></pre>

  <li>Luego tendremos que crear nuestras sites para que esten disponibles con los sigueintes comando</li><br>
    <pre><code>sudo touch  /etc/apache2/sites-available/retrogold.conf</code></pre>
  <li>tendremos que revisar si esta creado con el sigueinte comando</li><br>
    <pre><code>ls /etc/apache2/sites-available</code></pre>

  <li>Unavez comprobado que la están las carpetas, tendromos que editar la carpeta "000-default.conf" añadiendo nuestro dominio "el nombre en mi caso retrogold" editando cosas importntes como las sigueites</li>
  <pre><code>sudo nano /etc/apache2/sites-available/000-default.conf</code></pre>

  <br>Se tendría que ver de esta manera por dentro, pero le tengo que quitar la "<" de delante del Virtualhost, para que pueda verlo en github
  <pre><code>
    VirtualHost *: 80>
            #Nombre del dominio
            ServerName retrogold.es
            
            ServerAdmin webmaster@retrogold.es
            
            ServerAlias www.retrogold.es
            
            DirectoryIndex index.html
            
            #Carpeta raiz de nuestro sitio web
            DocumentRoot /var/www/retrogold
            
            ErrorLog ${APACHE_LOG_DIR}/error.log
            CustomLog ${APACHE_LOG_DIR}/access. log combined
            
            # For most configuration files from conf-available/, which are
            # enabled or disabled at a global level, it is possible to
            # include a line for only one particular virtual host. For example the
            # following line enables the CGI configuration for this host only
            # after it has been globally disabled with "a2disconf".
            #Include conf-available/serve-cgi-bin. conf
    /VirtualHost>

    # vim: syntax=apache ts=4 sw=4 sts=4 sr noet
    
  </code></pre>

  <br>Luego lo guardaré con el nombre "retrogold.conf" en vez de "000-default.conf"

  <li>Luego haremos la comprobación que la pagina este correctamente con:</li>
  <pre><code>ls /etc/apache2/sites-enabled</code></pre>
  <pre><code>ls /etc/apache2/sites-available</code></pre>
  
  <li>Probablemente no esten haci que lo avilitaremos con:</li>
  <pre><code>sudo a2ensite retrogold.conf</code></pre>
  <br>De esa manera lo tendriamos activado la web.

  <li>Luego recargaremos el apache para saber que todo va bien</li>
  <pre><code>sudo systemctl reload apache2</code></pre>

  <li>Despues usaremos el siguiente comando para ver si nuestra página web esta </li>
  <pre><conde>sudo apachectl -S</conde></pre>
  
  <br>![imagen4](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/imagenes/Imagen4.png)
 
</ol>

<h2>Después en el cliente como estara en la misma red, tendremos configurar los hosts del cliente para que busque especificamente la pagina que creamos, sin confundirse con otra. Usando comando:</h2>
<ol>
  <li>Tendremos que añadir la direccion IP del servidor Apache más el nombre del dominio de la siguiente forma</li><br>
  <pre><code>sudo cat /etc/hosts</code></pre><br>  
  <pre><code>
    127.0.0.1         localhost
    127.0.1.1         mateo-VirtualBox
    192.168.6.21      retrogold.conf
    
    # The following lines are desirable for IPv6 capable hosts
    ::1       ip6-localhost ip6-loopback
    fe0o :: 0 ip6-localnet
    ff0o :: 0 ip6-mcastprefix
    ff02 :: 1 ip6-allnodes
    ff02 :: 2 ip6-allrouters
  </code></pre><br>  
  
  <br> de esta manera podremos buscar sinla necesidad de tener problemas, a la hora de buscarlos mediante el dominio "retrogold.es" en la barra de busqueda del Cliente. Podremos ver que nos busca sin problemas la pagina.
</ol>

</details>




<details><summary><h1><strong>Cosas que configurar y revidar "pendientes"</strong></h1></summary>

# ⚡ Guía para Montar RetroGold en Apache



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
</details>

<details><summary><h1><strong>🖥️ Otros Complementos Adicionales 🚀</strong></h1></summary>

  ##Instalacion de PhP
