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

## 👷🏻Funcionamiento General👷🏻

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
Las principales tecnologías que se utilizarán en el proyecto incluyen:  

- **Virtualización:**  
  - VirtualBox o VMware para la creación de Máquinas Virtuales (MV).  
  - Docker para la contenerización de los servicios.  
  - Aplicación de monitoreo para Docker (**Portainer** o **Lazydocker**).  

- **Redes y Seguridad:**  
  - **Bind9** como servidor DNS.  
  - **ISC DHCP Server** para asignación de IPs dinámicas.  
  - **Sophos Firewall** para control de tráfico y seguridad.  

- **Servidores y Protocolos:**  
  - **Apache** como servidor web.  
  - **vsftpd** o **ProFTPD** para almacenamiento y transferencia de ROMs vía FTP.  
  - **RetroArch** como plataforma de emulación de videojuegos retro.  

- **Desarrollo Web y Software:**  
  - **C# y WebAssembly (Blazor)** para desarrollo de aplicaciones web interactivas.  
  - **Figma** para el diseño de la interfaz web.  
  - **HTML, CSS y JavaScript** para la creación del frontend.  

- **Gestión y Control de Versiones:**  
  - **GitHub** para el control de versiones y almacenamiento del proyecto.
    
---

## 🔹 Hardware a Utilizar  
Se necesitará un hardware adecuado para soportar las MV y la emulación de juegos retro.  

### **Requisitos mínimos por Máquina Virtual (MV)**  
✅ **Servidor Principal** (MV con Apache, FTP, RetroArch)  
- CPU: **4 núcleos**  
- RAM: **4 GB**  
- Almacenamiento: **40 GB SSD**  
- Tarjeta de Red: **1 Gbps**  

✅ **Servidor DNS/DHCP y Firewall (MV con Bind9, ISC DHCP y Sophos Firewall)**  
- CPU: **2 núcleos**  
- RAM: **2 GB**  
- Almacenamiento: **20 GB SSD**  
- Tarjeta de Red: **1 Gbps**  

✅ **Máquina Física para Virtualización (Host)**  
- Procesador: **Intel i5/i7 o AMD Ryzen 5/7**  
- RAM: **8-16 GB**  
- Almacenamiento: **SSD de 256GB+**  
- Conectividad: **Wi-Fi y Ethernet** 

## 💻​Servicios Utilizados💻​

- Apache
- DNS
- DHCP
- VSFTPD
- Sophos
  
---

## 🔹 Sistemas Operativos a Utilizar  
El proyecto utilizará principalmente sistemas basados en Linux por su estabilidad y compatibilidad con los servicios requeridos.  

| **Sistema Operativo** | **Uso en el Proyecto** | **Versión Recomendada** |
|----------------------|----------------------|------------------------|
| **Ubuntu Server** | Base para todas las máquinas virtuales (MV). | **Ubuntu Server 22.04 LTS** |
| **Ubuntu Desktop** | Para desarrollo y pruebas en entornos gráficos. | **Ubuntu 22.04 LTS** |
| **Sophos Firewall OS** | Seguridad y control de tráfico de red. | **Sophos XG / UTM** |
| **Docker OS (Linux)** | Entorno para contenerización de servicios. | **Basado en Ubuntu** |





































## 📖​Blibliografia📖​

https://github.com/mamedev/mame

https://github.com/ybootin/mamejs?tab=readme-ov-file

https://www.digitalocean.com/community/tutorials/how-to-install-the-apache-web-server-on-ubuntu-20-04-es

https://www.youtube.com/watch?v=WyR-qPAagLo&ab_channel=IvanildoGalv%C3%A3o
