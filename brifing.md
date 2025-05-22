[VOLVER ATRÁS](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/README.md)

# Proyecto de Síntesis: Plataforma de Emulación de Videojuegos Retro en Contenedores Docker

## 🔧 Introducción

El presente proyecto tiene como objetivo la creación de una plataforma de emulación de videojuegos retro mediante la implementación de servicios virtualizados en contenedores Docker. Cada contenedor estará dedicado a una funcionalidad específica para garantizar la modularidad, la escalabilidad y la eficiencia del sistema.
Esto facilita el despliegue, la administración y el mantenimiento.

## Objetivo General
Diseñar y desplegar una infraestructura basada en contenedores Docker que permita emular videojuegos retro, gestionando el alojamiento web, el almacenamiento de ROMs y los servicios de red necesarios (DNS y DHCP) para el correcto funcionamiento de la plataforma.

.
---
# Arquitectura del Proyecto

1. **Contenedor Apache (Servidor Web)**

- **Función:** Este contenedor será responsable de alojar y servir una página web donde los usuarios podrán acceder a la interfaz de la plataforma. La web será el punto central para interactuar con los emuladores y gestionar los videojuegos retro.
- **Componentes:**
    - Servidor Apache configurado para hostear la web.
    - Interfaz gráfica que permita a los usuarios seleccionar juegos, iniciar emulaciones y consultar información relevante.

2. **Contenedor FTP (Servidor de Almacenamiento)**
- **Función:** Este contenedor almacenará las ROMs de los videojuegos retro y permitirá la transferencia de archivos según sea necesario.
- **Componentes:**
    - Servidor FTP configurado para manejar el almacenamiento de ROMs.
    - Estructura organizada para facilitar el acceso y la gestión de los archivos.
    - Seguridad básica (usuario y contraseña) para proteger el acceso a las ROMs.

3. **Contenedor DNS/DHCP (Servicios de Red)**

- **Función:** Este contenedor será responsable de proporcionar servicios de red, como la resolución de nombres de dominio (DNS) y la asignación de direcciones IP (DHCP), para facilitar la comunicación entre los contenedores y otros dispositivos conectados.
- **Componentes:**
    - Configuración de un servidor DNS para resolver nombres dentro del entorno Docker.
    - Configuración de un servidor DHCP para asignar direcciones IP dinámicas a los contenedores y dispositivos cliente.

.
---
# Flujo de Trabajo
1. **Inicio de Servicios:** Los contenedores Docker se inician en el orden necesario para garantizar la correcta configuración de la red y los servicios.
2. **Interacción del Usuario:** El usuario accede a la página web alojada en el servidor Apache para explorar la biblioteca de ROMs y seleccionar un juego.
3. **Gestión de ROMs:** El servidor web accede al servidor FTP para cargar las ROMs necesarias en el emulador.
4. **Resolución de Nombres y Conexión:** El servidor DNS y DHCP aseguran la conectividad entre los contenedores y cualquier cliente externo que necesite interactuar con la plataforma.

.
---
# Tecnologías y Herramientas
- **Docker:** Plataforma principal para la virtualización y orquestación de los contenedores.
- **Servidor Apache:** Para hostear la página web.
- **Servidor ProFTPd o vsftpd:** Para el manejo del servidor FTP.
- **Bind9 o dnsmasq:** Para la configuración de servicios DNS y DHCP.
- **Emuladores Retro:** Software adicional para ejecutar videojuegos retro (por ejemplo, RetroArch o Mednafen).
- **Lenguajes Web:** HTML, CSS, JavaScript (opcional para dinamismo en la web).

## 📝 Servicios a Implementar
1. **Servidor Apache (HTTP/HTTPS)**
    - Servirá como servidor web principal.
    - Puede actuar como proxy inverso para redirigir solicitudes hacia otros servicios internos si es necesario.
2. **Servidor FTP**
    - Proporcionará acceso a archivos a través del protocolo FTP.
    - Herramienta sugerida: vsftpd o ProFTPD.
3. **Servidor DNS**
    - Gestionará la resolución de nombres de dominio internos.
    - Herramienta sugerida: Bind9 o dnsmasq.
4. **Servidor DHCP**
    - Asignará direcciones IP de forma dinámica a clientes en la red.
    - Herramienta sugerida: ISC DHCP Server.



# 🛠️"configuracios que se se haran"

## 📦 Estructura de Contenedores en Docker

Cada servicio se desplegará en un contenedor independiente. A continuación, te muestro una estructura básica:
```
Proyecto_Final/
│
├── docker-compose.yml    # Archivo principal para definir y orquestar los contenedores
│
├── apache/
│   └── Dockerfile        # Configuración para Apache
│
├── ftp/
│   └── Dockerfile        # Configuración para el servidor FTP
│
├── dns/
│   └── Dockerfile        # Configuración para el servidor DNS
│
├── dhcp/
    └── Dockerfile        # Configuración para el servidor DHCP


```


## ⚙️ docker-compose.yml
Aquí te dejo un ejemplo básico de un archivo <ins>docker-compose.yml</ins> que podrías usar como punto de partida:

## 🛠️ Configuración de los Contenedores
**Apache (Dockerfile):**

    FROM httpd:2.4
    COPY ./html/ /usr/local/apache2/htdocs/

**FTP (Dockerfile):**

    FROM ubuntu:latest
    RUN apt-get update && apt-get install -y vsftpd
    COPY vsftpd.conf /etc/vsftpd.conf
    CMD ["/usr/sbin/vsftpd", "/etc/vsftpd.conf"]

**DNS (Dockerfile):**

	FROM ubuntu:latest
    RUN apt-get update && apt-get install -y bind9
    CMD ["/usr/sbin/named", "-f"]

**DHCP (Dockerfile):**

	FROM ubuntu:latest
    RUN apt-get update && apt-get install -y isc-dhcp-server
    COPY dhcpd.conf /etc/dhcp/dhcpd.conf
    CMD ["dhcpd", "-f"]

    

## 🌐 Interconexión de Servicios
El uso de una red interna (<ins>internal_net</ins>) en Docker permite que todos los contenedores se comuniquen de manera eficiente y segura.
Puedes configurar el **Apache** como proxy inverso para redirigir tráfico HTTP hacia otros contenedores si es necesario.

¡Suena como un proyecto muy completo e interesante! 😊 Integrar **Docker* con varios servicios como **Apache, FTP, DNS, DHCP** es una excelente manera de demostrar habilidades en infraestructura y virtualización. Aquí te dejo un esquema claro y sugerencias para estructurar tu proyecto.

.
---
# Justificación
La virtualización con Docker permite aislar los servicios en contenedores independientes, asegurando un sistema eficiente, portable y fácilmente replicable. Este enfoque no solo proporciona una experiencia práctica en el uso de tecnologías actuales, sino que también destaca por su aplicabilidad en entornos educativos y de entretenimiento.

.
---
# Metas del Proyecto
Diseñar una infraestructura modular con contenedores Docker.
Configurar un servidor web funcional para alojar la interfaz de usuario.
Establecer un servidor FTP para almacenar y gestionar ROMs.
Configurar un servidor DNS/DHCP para garantizar la comunicación en el entorno.
Proporcionar una experiencia interactiva y funcional que permita la emulación de videojuegos retro.






Some body text of this section.

<a name="my-custom-anchor-point"></a>
Some text I want to provide a direct link to, but which doesn't have its own heading.

(… more content…)
