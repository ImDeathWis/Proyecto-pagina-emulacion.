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

# 🌐 Configuración Completa de Apache para RetroGold

Este documento describe todos los pasos realizados para configurar correctamente el servidor web **Apache** y publicar la web de RetroGold dentro del entorno Ubuntu Server.

---

## 📍 Ruta del Proyecto Web

El archivo principal del sitio se encuentra en:  
```bash
/var/www/retrogolds/portada.html
```

---

## 🛠️ Configuración de Red con Netplan

Archivo editado: `/etc/netplan/00-installer-config.yaml`

```yaml
network:
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
```

Aplicar cambios:
```bash
sudo netplan apply
```

---

## 🌍 Instalación y Activación de Apache

```bash
sudo apt update && sudo apt upgrade -y
sudo apt install apache2 -y
sudo systemctl status apache2
```

---

## 📁 Creación de la Carpeta del Proyecto

```bash
sudo mkdir -p /var/www/retrogolds
sudo nano /var/www/retrogolds/portada.html
```

Se diseñó un `portada.html` como página principal del sitio.

---

## ⚙️ Configuración del Virtual Host

Se modificó el archivo por defecto de Apache:  
```bash
/etc/apache2/sites-available/000-default.conf
```

Contenido adaptado:

```apache
<VirtualHost *:80>
    ServerAdmin webmaster@retrogold.es
    DocumentRoot /var/www/retrogolds
    DirectoryIndex portada.html

    ServerName retrogold.es
    ServerAlias www.retrogold.es

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

Comandos para aplicar cambios:

```bash
sudo a2ensite 000-default.conf
sudo systemctl reload apache2
sudo apachectl -S
```

📷 Verificación del sitio web configurado  
![Imagen 4](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/imagenes/Imagen4.png)

---

## 🧪 Prueba de Dominio desde Cliente

Editar `/etc/hosts` en el cliente:

```bash
sudo nano /etc/hosts
```

Y añadir:

```text
192.168.6.21      retrogold.es
```

Esto permite acceder directamente a `http://retrogold.es` desde el navegador.

---

## 🔐 Prueba de Entorno con PHP y Base de Datos

Se configuró un archivo PHP de prueba para comprobar la integración de Apache con PHP y MySQL:

```bash
sudo nano /var/www/html/info.php
```

Contenido del archivo:

```php
<?php
phpinfo();
?>
```

La base de datos configurada se llama `web_retrogold` y contiene la tabla `admin` para usuarios administrativos, utilizando el campo `password` para las contraseñas hasheadas.

---

✅ Apache quedó funcional, sirviendo la página `portada.html` correctamente desde el dominio interno `retrogold.es`.
