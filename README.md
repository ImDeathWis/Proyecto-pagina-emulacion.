<details><summary><h1><strong>🎮​👾​🕹️​RetroGold🕹️​👾​🎮</strong></h1></summary>  

RetroGold es tu portal para revivir los mejores clásicos de los videojuegos, potenciado por el emulador MAME. Ofrecemos una experiencia única para los amantes de los juegos retro, permitiéndote disfrutar de títulos icónicos que marcaron la época dorada de los salones recreativos.  

<img src="https://github.com/user-attachments/assets/e8d85532-bad1-464d-8d1b-57406362fe65" width="500" height="500">  

<details><summary><h2><strong>🛠️ Mapa de la Red 🛠️</strong></h2></summary>  

<img src="https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/imagenes/mapa_de_red.jpg" width="960" height="540">  

<a href="https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/brifing.md" target="_blank">Nuestro Briefing/Resumen del proyecto (Haz clic para ver)</a>  

---</details>  

<details><summary><h2><strong>🛠️​ Arquitectura del Sistema 🛠️</strong></h2></summary>  

<h3>Componentes Principales:</h3>  

- **Servidor Web (Apache):** Hospeda el sitio de emulación de juegos retro.  
- **Servidor FTP (vsftpd):** Almacena las ROMs y permite su acceso mediante el emulador MAME.  
- **Servidor DNS:** Gestiona la resolución de nombres de dominio.  
- **Servidor DHCP:** Asigna dinámicamente direcciones IP en la red interna.  
- **Firewall (Sophos):** Implementado en una máquina virtual para proteger la infraestructura contra amenazas de seguridad.  
- **Contenedores Docker (futuro):** Facilitarán la gestión, escalabilidad y portabilidad del sistema.  

<a href="https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/Especificar%20listado%20de%20tareas.md" target="_blank">Haz clic aquí para ver el listado de tareas del equipo</a>  

---


</details>

<details><summary><h2><strong>✅ Objetivos del Sistema ✅</strong></h2></summary>
  
<h3>Acceso a Juegos Retro de Arcade:</h3>

Ofrecer una biblioteca de juegos clásicos de arcade mediante un emulador MAME alojado en un servidor Apache.

<h3>Modularidad y Seguridad:</h3>

Separar servicios como DNS y DHCP del servidor web y FTP mejora la modularidad. Además, el firewall Sophos refuerza la seguridad del sistema.

<h3>Preparación para Dockerización:</h3>

Se planea empaquetar los componentes clave (servidor web, FTP, emulador MAME) en contenedores Docker para optimizar la gestión y escalabilidad.

<a href="https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/Asignar%20roles%20y%20responsabilidades%20del%20equipo.md" target="_blank">Haz clic aquí para ver cómo nos asignaremos los roles</a>

---

</details>

<details><summary><h2><strong>👷🏻 Funcionamiento General 👷🏻</strong></h2></summary>
El sistema permite a los usuarios acceder al sitio web, donde Apache sirve la interfaz para seleccionar y jugar títulos retro. Los componentes interactúan de la siguiente manera:  

<h3>1. Servidor Web (Apache)</h3><a href="https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/Apache.md" target="_blank">Haz clic aquí para ir a la información</a>

- **Funcionalidades:**
  - Alojamiento del sitio web (HTML, CSS, JavaScript).
  - Integración con MAME para cargar juegos desde el servidor FTP.
  - Seguridad HTTPS mediante cifrado SSL/TLS.

<h3>2. Servidor FTP (vsftpd)</h3><a href="https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/Apache.md" target="_blank">Haz clic aquí para ir a la información</a>

- **Funcionalidades:**
  - Almacenamiento y acceso a ROMs para el emulador MAME.
  - Configuración de permisos para acceso seguro.

<h3>3. Servidor DNS</h3><a href="https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/DNSyDHCP.md" target="_blank">Haz clic aquí para ir a la información (Se encuentra el DNS y el DHCP)</a>
<h3>3. Servidor DNS</h3><a href="https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/DNS%20con%20sophos%20Incluido.md" target="_blank">Haz clic aquí para ir a la información (Se encuentra el DNS ya implementado al sophos)</a>

- **Funcionalidades:**
  - Resolución de nombres de dominio y gestión de subdominios.
  - Redundancia mediante DNS externos (Google DNS, Cloudflare).

<h3>4. Servidor DHCP</h3><a href="https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/DNSyDHCP.md" target="_blank">Haz clic aquí para ir a la información (Se encuentra el DNS y el DHCP)</a>

- **Funcionalidades:**
  - Asignación automática de IPs en la red interna.
  - Configuración de rangos de IPs para diferentes dispositivos.

<h3>5. Firewall (Sophos)</h3><a href="https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/pfesense.md" target="_blank">Haz clic aquí para ir a la información (pfSense "es temporal")</a>

- **Funcionalidades:**
  - Filtrado de tráfico y prevención de amenazas.
  - Monitorización de la seguridad de la red.
  - Implementado en una máquina virtual para mayor flexibilidad.

---
</details>

<details><summary><h2><strong>🦾​ Tecnologías Utilizadas 🦾​</strong></h2></summary>
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
</details>
<details><summary><h2><strong>🔹 Hardware a Utilizar ​</strong></h2></summary>

Se necesitará un hardware adecuado para soportar las MV y la emulación de juegos retro.  

<h3>Requisitos mínimos por Máquina Virtual (MV)</h3>

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

---
</details>

<details><summary><h2><strong>💻​ Servicios a Implementar 💻​​</strong></h2></summary>
  
El proyecto requiere múltiples servicios para funcionar correctamente:  

| **Servicio**  | **Función**  | **Software/Herramienta**  |
|--------------|------------|--------------------------|
| **Servidor Web** | Aloja la página web para la interfaz de usuario. | **Apache** |
| **Servidor FTP** | Almacena y gestiona las ROMs de los juegos. | **vsftpd** o **ProFTPD** |
| **Servidor DNS** | Resuelve nombres de dominio internos para la red. | **Bind9** |
| **Servidor DHCP** | Asigna direcciones IP dinámicas a los dispositivos. | **ISC DHCP Server** |
| **Firewall** | Controla el tráfico y protege los servicios. | **Sophos Firewall** |
| **Plataforma de Emulación** | Ejecuta videojuegos retro dentro del sistema. | **RetroArch** |
| **Docker** | Permite la virtualización y despliegue de servicios. | **Docker y Docker Compose** |
| **Monitoreo Docker** | Aplicación para visualizar contenedores Docker en tiempo real. | **Portainer** o **Lazydocker** |
| **Desarrollo Web** | Creación de interfaz interactiva. | **HTML, CSS, JavaScript, C#, WebAssembly (Blazor)** |
| **Control de Versiones** | Gestiona el código y la documentación del proyecto. | **GitHub** |

---
</details>

<details><summary><h2><strong>🔹 Sistemas Operativos a Utilizar ​​</strong></h2></summary>

El proyecto utilizará principalmente sistemas basados en Linux por su estabilidad y compatibilidad con los servicios requeridos.  

| **Sistema Operativo** | **Uso en el Proyecto** | **Versión Recomendada** |
|----------------------|----------------------|------------------------|
| **Ubuntu Server** | Base para todas las máquinas virtuales (MV). | **Ubuntu Server 22.04 LTS** |
| **Ubuntu Desktop** | Para desarrollo y pruebas en entornos gráficos. | **Ubuntu 22.04 LTS** |
| **Sophos Firewall OS** | Seguridad y control de tráfico de red. | **Sophos XG / UTM** |
| **Docker OS (Linux)** | Entorno para contenerización de servicios. | **Basado en Ubuntu** |

</details>

<details><summary><h2><strong>📖​ Bibliografía 📖​​​</strong></h2></summary>

https://github.com/mamedev/mame

https://github.com/ybootin/mamejs?tab=readme-ov-file

https://www.digitalocean.com/community/tutorials/how-to-install-the-apache-web-server-on-ubuntu-20-04-es

https://www.youtube.com/watch?v=WyR-qPAagLo&ab_channel=IvanildoGalv%C3%A3o

https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-20-04-es

https://www.digitalocean.com/community/tutorials/how-to-install-the-apache-web-server-on-ubuntu-20-04-es 

https://httpd.apache.org/docs/trunk/es/install.html 

https://www.ionos.es/digitalguide/servidores/configuracion/instalar-apache-en-ubuntu/

https://extassisnetwork.com/tutoriales/como-instalar-apache-en-ubuntu/

https://ubuntu.com/server/docs/set-up-an-ftp-server

https://github.com/kabukki/wasm-nes 

https://www.php.net/manual/es/function.phpinfo.php

https://github.com/mupen64plus

https://jsnes.org/

https://www.youtube.com/watch?v=nQu4U0r-w-M&list=PLS1R8PLgpkVROGR9dAWw6gtyuq_oA-Z2q&index=6

</details>

</details>
