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

# 🌐 Instalación y Configuración de Apache para RetroGold

Este documento resume los pasos realizados para instalar y configurar el servidor Apache que aloja la web de **RetroGold**.

---

## 🧱 Instalación de Apache

```bash
sudo apt update && sudo apt upgrade -y
sudo apt install apache2 -y
sudo systemctl status apache2
```

Verificamos que Apache esté activo con:
```bash
sudo systemctl status apache2
```

---

## 🛠️ Configuración de Apache

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

---

## 🧪 Configuración de Cliente (Resolución del Dominio)

En la máquina cliente, añadimos la IP estática al archivo `/etc/hosts` para asociar el dominio `www.retrogold.com`:

```bash
sudo nano /etc/hosts
```

Y se añadió la siguiente línea:

```text
192.168.6.20    www.retrogold.com
```

Esto permite acceder correctamente al servidor Apache desde un navegador en la red local usando el dominio `www.retrogold.com`.

