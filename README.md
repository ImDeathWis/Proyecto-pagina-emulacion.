<details><summary><h1><strong>🎮​👾​🕹️​RetroGold🕹️​👾​🎮</strong></h1></summary>

![DALL·E 2025-01-29 10 42 36 - A neon-style logo for a website called 'Retro Gold'  The design should incorporate an arcade theme with a retro-futuristic aesthetic  The color palett](https://github.com/user-attachments/assets/e8d85532-bad1-464d-8d1b-57406362fe65)


RetroArch es tu portal para revivir los mejores clásicos de los videojuegos, potenciado por el emulador MAME. Ofrecemos una experiencia única para los amantes de los juegos retro, permitiéndote disfrutar de títulos icónicos que marcaron la época dorada de los salones recreativos.

<details><summary><h2><strong>🛠️ Mapa de la Red 🛠️</strong></h2></summary>
  
![Frame 6](https://github.com/user-attachments/assets/0c022f26-0552-4fd4-bb8d-4b42ee07a960)
---
</details>

<details><summary><h2><strong>🛠️​Arquitectura del Sistema🛠️</strong></h2></summary>
  
<h3>Componentes Principales:</h3>

- **Servidor Web (Apache):** Hospeda el sitio de emulación de juegos retro.
- **Servidor FTP (vsftpd):** Almacena las ROMs y permite su acceso mediante el emulador MAME.
- **Servidor DNS:** Gestiona la resolución de nombres de dominio.
- **Servidor DHCP:** Asigna dinámicamente direcciones IP en la red interna.
- **Firewall (Sophos):** Implementado en una máquina virtual para proteger la infraestructura contra amenazas de seguridad.
- **Contenedores Docker (futuro):** Facilitarán la gestión, escalabilidad y portabilidad del sistema.

---
</details>

<details><summary><h2><strong>✅Objetivos del Sistema✅</strong></h2></summary>
  
<h3>Acceso a Juegos Retro de Arcade:</h3>

Ofrecer una biblioteca de juegos clásicos de arcade mediante un emulador MAME alojado en un servidor Apache.

<h3>Modularidad y Seguridad:</h3>

Separar servicios como DNS y DHCP del servidor web y FTP mejora la modularidad. Además, el firewall Sophos refuerza la seguridad del sistema.

<h3>Preparación para Dockerización:</h3>

Se planea empaquetar los componentes clave (servidor web, FTP, emulador MAME) en contenedores Docker para optimizar la gestión y escalabilidad.

---
</details>

<details><summary><h2><strong>👷🏻Funcionamiento General👷🏻</strong></h2></summary>
El sistema permite a los usuarios acceder al sitio web, donde Apache sirve la interfaz para seleccionar y jugar títulos retro. Los componentes interactúan de la siguiente manera:  

<h3>1. Servidor Web (Apache)</h3>

- **Funcionalidades:**
  - Alojamiento del sitio web (HTML, CSS, JavaScript).
  - Integración con MAME para cargar juegos desde el servidor FTP.
  - Seguridad HTTPS mediante cifrado SSL/TLS.

<h3>2. Servidor FTP (vsftpd)</h3>

- **Funcionalidades:**
  - Almacenamiento y acceso a ROMs para el emulador MAME.
  - Configuración de permisos para acceso seguro.

<h3>3. Servidor DNS</h3>

- **Funcionalidades:**
  - Resolución de nombres de dominio y gestión de subdominios.
  - Redundancia mediante DNS externos (Google DNS, Cloudflare).

<h3>4. Servidor DHCP</h3>

- **Funcionalidades:**
  - Asignación automática de IPs en la red interna.
  - Configuración de rangos de IPs para diferentes dispositivos.

<h3>5. Firewall (Sophos)</h3>

- **Funcionalidades:**
  - Filtrado de tráfico y prevención de amenazas.
  - Monitorización de la seguridad de la red.
  - Implementado en una máquina virtual para mayor flexibilidad.

---
</details>


<details><summary><h2><strong>🦾​Tecnologías Utilizadas🦾​</strong></h2></summary>
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

<h3>**Requisitos mínimos por Máquina Virtual (MV)**</h3>
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

---
</deatails>

# 📌 Configuración de Apache en Ubuntu + Clonar repositorio MAME (Red NAT 10.1.2.1)

## ✅ Requisitos previos
- Ubuntu Server instalado.
- Conexión a Internet.
- Acceso con permisos de superusuario (`sudo`).
- Red NAT con gateway `10.1.2.1`.

# ⚡ Guía para Montar RetroGold en Apache

## 1️⃣ Instalación de Apache

Para poder instalar Apache deberemos de seguir estos pasos

### Debian/Ubuntu:
```bash
sudo apt update && sudo apt install apache2 -y
```

### Iniciar el servicio:
```bash
sudo systemctl start apache2  # En Debian/Ubuntu
```

### Habilitar Apache para que se inicie automáticamente:
```bash
sudo systemctl enable apache2  # Debian/Ubuntu
```

---

## 2️⃣ Configurar Apache para Servir RetroGold

### Crear el directorio del proyecto:
```bash
sudo mkdir -p /var/www/retrogold
```

### Dar permisos al usuario (reemplaza `tuusuario` con tu nombre de usuario):
```bash
sudo chown -R tuusuario:www-data /var/www/retrogold
sudo chmod -R 755 /var/www/retrogold
```

### Crear un archivo de configuración para Apache:
```bash
sudo nano /etc/apache2/sites-available/retrogold.conf
```

### Contenido del archivo:
```apache
<VirtualHost *:80>
    ServerAdmin admin@retrogold.com
    DocumentRoot /var/www/retrogold
    ServerName retrogold.com
    ServerAlias www.retrogold.com

    <Directory /var/www/retrogold>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/retrogold_error.log
    CustomLog ${APACHE_LOG_DIR}/retrogold_access.log combined
</VirtualHost>
```

Guarda y cierra el archivo (`CTRL + X`, luego `Y` y `ENTER`).

### Activar el sitio y reiniciar Apache:
```bash
sudo a2ensite retrogold.conf
sudo systemctl restart apache2
```

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




## 📖​Blibliografia📖​

https://github.com/mamedev/mame

https://github.com/ybootin/mamejs?tab=readme-ov-file

https://www.digitalocean.com/community/tutorials/how-to-install-the-apache-web-server-on-ubuntu-20-04-es

https://www.youtube.com/watch?v=WyR-qPAagLo&ab_channel=IvanildoGalv%C3%A3o

https://github.com/kabukki/wasm-nes 
</details>
