
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

Se configuró un archivo PHP de prueba:

```bash
sudo nano /var/www/html/info.php
```

Contenido:
```php
<?php
phpinfo();
?>
```

El sistema utiliza una base de datos llamada `web_retrogold` con una tabla `admin` y columna `password` como credenciales.

---

✅ Apache queda totalmente funcional, sirviendo correctamente la web `portada.html` desde el dominio `retrogold.es`.

