# 🎮​👾​🕹️​RetroArch🕹️​👾​🎮

Esto es RetroArch, tu portal de juegos para revivir los mejores clásicos de los videojuegos con la potencia del emulador MAME. En nuestro sitio, ofrecemos una experiencia única para los amantes de los juegos retro, permitiéndote disfrutar de los títulos que marcaron una época dorada en los salones recreativos.

## 🛠️​Arquitectura del Sistema🛠️​

### Componentes Principales:

Servidor Web (Apache): Hospeda el sitio web de emulación de juegos retro.

Servidor FTP (vsftpd): Almacena las ROMs de los juegos y permite su acceso a través del emulador MAME.

Servidor DNS: Traduce nombres de dominio a direcciones IP.

Servidor DHCP: Asigna dinámicamente direcciones IP dentro de una red interna.

Contenedores Docker (a futuro): Para facilitar la gestión y escalabilidad del sistema, todo del entorno podría ejecutarse en contenedores Docker.

## ✅Objetivos del Sistema✅

### Proveer Acceso a Juegos Retro de Arcade:

Ofrecer acceso a una biblioteca de juegos clásicos de arcade a través de un emulador MAME alojado en un servidor Apache.

### Descentralización de Servicios:

El servidor DNS y DHCP son servicios clave para la red interna que gestionarán las direcciones IP y la resolución de nombres, pero están separados del servidor web y FTP, lo que mejora la modularidad del sistema.

### Preparación para Dockerización:

A futuro, todos los componentes clave (el servidor web, el servidor FTP, e incluso el emulador MAME) podrían ser empaquetados como contenedores Docker para facilitar la gestión, escalabilidad y portabilidad del sistema.

## 👷🏻‍♂️Funcionamiento General👷🏻‍♂️

El sistema completo se configura para que los usuarios puedan acceder al sitio web, donde el servidor Apache proporcionará la interfaz de usuario para seleccionar y jugar títulos retro. A continuación, explico cómo interactúan los diferentes componentes:


### 1. Servidor Web (Apache) con el Sitio de Emulación

  El servidor Apache se encarga de servir el sitio web (HTML, CSS, JavaScript) que permite a los usuarios interactuar con el emulador MAME.

  El emulador MAME se ejecuta en el navegador y carga los juegos desde el servidor FTP que almacena las ROMs.

  Funcionalidades:

    Alojamiento del sitio web: Apache sirve todos los archivos estáticos (HTML, CSS, JS) que permiten la navegación por el catálogo de juegos.
  
    Integración con MAME: El emulador en el navegador se conecta al servidor FTP para obtener las ROMs necesarias.
  
    Seguridad HTTPS: Asegurar la comunicación con el servidor mediante cifrado SSL/TLS.

### 2. Servidor FTP (vsftpd)

  El servidor FTP aloja las ROMs de los juegos retro y facilita su acceso al emulador MAME cuando un usuario selecciona un juego.

  Funcionalidades:

    Almacenamiento y acceso a ROMs: Los juegos (archivos ROM) se almacenan en el servidor FTP y son accedidos por el emulador MAME a través de conexiones FTP.
    
    Configuración de permisos: Asegurarse de que los permisos del servidor FTP están correctamente configurados para permitir el acceso sólo al emulador y a los administradores autorizados.

### 3. Servidor DNS

El servidor DNS se encarga de la resolución de nombres de dominio para el sitio web. Por ejemplo, cuando un usuario ingresa una URL como www.retroarch.com, el servidor DNS resuelve este nombre a la dirección IP correcta.

Funcionalidades:

    Resolución de nombres: Traduce los dominios asociados con el sitio web (y otros servicios internos si es necesario).
 
    Manejo de subdominios: Si se usa un subdominio para las ROMs (por ejemplo, roms.retroarch.com), el servidor DNS se encarga de redirigir las solicitudes al servidor FTP o al servidor adecuado.
 
    Redundancia: En caso de que el servidor DNS esté fuera de línea, se pueden usar servicios DNS externos como Google DNS o Cloudflare como respaldo.

### 4. Servidor DHCP

  El servidor DHCP asigna dinámicamente direcciones IP a los dispositivos dentro de la red interna de tu infraestructura. Este servidor no interactúa directamente con el sitio web, pero es crucial para la asignación de IPs en una red local, especialmente si tienes     varias máquinas de prueba o servidores internos.

  Funcionalidades:

    Asignación de IPs: Los dispositivos que se conecten a la red recibirán automáticamente una dirección IP.
  
    Configuración de rango de IPs: Se pueden configurar rangos específicos de direcciones IP para diferentes tipos de dispositivos, como servidores o estaciones de trabajo.
  
    Facilitación de pruebas: Si el sitio va a ser probado en una red interna antes de su lanzamiento, DHCP facilita la configuración automática de los dispositivos.




































## 📖​Blibliografia📖​

https://github.com/mamedev/mame

https://github.com/ybootin/mamejs?tab=readme-ov-file

https://www.digitalocean.com/community/tutorials/how-to-install-the-apache-web-server-on-ubuntu-20-04-es
