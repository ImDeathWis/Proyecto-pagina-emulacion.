# 🎮​👾​🕹️​RetroGold🕹️​👾​🎮

![DALL·E 2025-01-29 10 42 36 - A neon-style logo for a website called 'Retro Gold'  The design should incorporate an arcade theme with a retro-futuristic aesthetic  The color palett](https://github.com/user-attachments/assets/e8d85532-bad1-464d-8d1b-57406362fe65)


RetroArch es tu portal para revivir los mejores clásicos de los videojuegos, potenciado por el emulador MAME. Ofrecemos una experiencia única para los amantes de los juegos retro, permitiéndote disfrutar de títulos icónicos que marcaron la época dorada de los salones recreativos.

## 🛠️Mapa de la Red🛠️​

![Frame 6](https://github.com/user-attachments/assets/0c022f26-0552-4fd4-bb8d-4b42ee07a960)


## 🛠️​Arquitectura del Sistema🛠️​

### Componentes Principales:

- **Servidor Web (Apache):** Hospeda el sitio de emulación de juegos retro.
- **Servidor FTP (vsftpd):** Almacena las ROMs y permite su acceso mediante el emulador MAME.
- **Servidor DNS:** Gestiona la resolución de nombres de dominio.
- **Servidor DHCP:** Asigna dinámicamente direcciones IP en la red interna.
- **Firewall (Sophos):** Implementado en una máquina virtual para proteger la infraestructura contra amenazas de seguridad.
- **Contenedores Docker (futuro):** Facilitarán la gestión, escalabilidad y portabilidad del sistema.

## ✅Objetivos del Sistema✅

### Acceso a Juegos Retro de Arcade:

Ofrecer una biblioteca de juegos clásicos de arcade mediante un emulador MAME alojado en un servidor Apache.

### Modularidad y Seguridad:

Separar servicios como DNS y DHCP del servidor web y FTP mejora la modularidad. Además, el firewall Sophos refuerza la seguridad del sistema.

### Preparación para Dockerización:

Se planea empaquetar los componentes clave (servidor web, FTP, emulador MAME) en contenedores Docker para optimizar la gestión y escalabilidad.

##👷🏻Funcionamiento General👷🏻

El sistema permite a los usuarios acceder al sitio web, donde Apache sirve la interfaz para seleccionar y jugar títulos retro. Los componentes interactúan de la siguiente manera:

### 1. Servidor Web (Apache)

- **Funcionalidades:**
  - Alojamiento del sitio web (HTML, CSS, JavaScript).
  - Integración con MAME para cargar juegos desde el servidor FTP.
  - Seguridad HTTPS mediante cifrado SSL/TLS.

### 2. Servidor FTP (vsftpd)

- **Funcionalidades:**
  - Almacenamiento y acceso a ROMs para el emulador MAME.
  - Configuración de permisos para acceso seguro.

### 3. Servidor DNS

- **Funcionalidades:**
  - Resolución de nombres de dominio y gestión de subdominios.
  - Redundancia mediante DNS externos (Google DNS, Cloudflare).

### 4. Servidor DHCP

- **Funcionalidades:**
  - Asignación automática de IPs en la red interna.
  - Configuración de rangos de IPs para diferentes dispositivos.

### 5. Firewall (Sophos)

- **Funcionalidades:**
  - Filtrado de tráfico y prevención de amenazas.
  - Monitorización de la seguridad de la red.
  - Implementado en una máquina virtual para mayor flexibilidad.

## 🦾​Tecnologías Utilizadas🦾​

- C#
- JavaScript
- CSS
- HTML
- WebAssembly

## 💻​Servicios Utilizados💻​

- Apache
- DNS
- DHCP
- VSFTPD
- Sophos




































## 📖​Blibliografia📖​

https://github.com/mamedev/mame

https://github.com/ybootin/mamejs?tab=readme-ov-file

https://www.digitalocean.com/community/tutorials/how-to-install-the-apache-web-server-on-ubuntu-20-04-es
