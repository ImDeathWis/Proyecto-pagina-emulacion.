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

---

## 💻​ Servicios a Implementar 💻​ 
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

## 🔹 Sistemas Operativos a Utilizar  
El proyecto utilizará principalmente sistemas basados en Linux por su estabilidad y compatibilidad con los servicios requeridos.  

| **Sistema Operativo** | **Uso en el Proyecto** | **Versión Recomendada** |
|----------------------|----------------------|------------------------|
| **Ubuntu Server** | Base para todas las máquinas virtuales (MV). | **Ubuntu Server 22.04 LTS** |
| **Ubuntu Desktop** | Para desarrollo y pruebas en entornos gráficos. | **Ubuntu 22.04 LTS** |
| **Sophos Firewall OS** | Seguridad y control de tráfico de red. | **Sophos XG / UTM** |
| **Docker OS (Linux)** | Entorno para contenerización de servicios. | **Basado en Ubuntu** |


# 📌 Configuración de DNS y DHCP en Ubuntu (Red NAT 10.1.2.1)

## ✅ Requisitos previos
- Ubuntu Server instalado.
- Conexión a Internet.
- Acceso con permisos de superusuario (`sudo`).
- Red NAT con gateway `10.1.2.1`.

---
## 1️⃣ Configurar IP Estática en el Servidor
Antes de instalar los servicios, asegurémonos de que el servidor tenga una IP fija.

### 🔹 Editar la configuración de la red
```bash
sudo nano /etc/netplan/00-installer-config.yaml
```

### 🔹 Ejemplo de configuración (ajusta según tu red):
```yaml
network:
  ethernets:
    ens33:  # Reemplaza con el nombre de tu interfaz (usa `ip a` para verla)
      dhcp4: no
      addresses:
        - 10.1.2.10/24  # IP estática del servidor
      gateway4: 10.1.2.1
      nameservers:
        addresses:
          - 8.8.8.8
          - 8.8.4.4
  version: 2
```

### 🔹 Aplicar cambios y verificar:
```bash
sudo netplan apply
ip a
```
---
## 2️⃣ Instalar y Configurar el Servicio DNS (Bind9)

### 🔹 Instalar BIND9
```bash
sudo apt update && sudo apt install -y bind9 bind9-utils
```

### 🔹 Configurar BIND9
Editar el archivo de configuración:
```bash
sudo nano /etc/bind/named.conf.options
```
Agregar o modificar:
```yaml
options {
    directory "/var/cache/bind";
    recursion yes;
    allow-query { any; };
    forwarders {
        8.8.8.8; 8.8.4.4;
    };
    listen-on { 10.1.2.10; };
    allow-recursion { any; };
};
```

### 🔹 Configurar Zona Directa
```bash
sudo nano /etc/bind/named.conf.local
```
Agregar:
```yaml
zone "midominio.com" {
    type master;
    file "/etc/bind/db.midominio.com";
};
```
Crear archivo de zona:
```bash
sudo cp /etc/bind/db.empty /etc/bind/db.midominio.com
sudo nano /etc/bind/db.midominio.com
```
Ejemplo de configuración:
```yaml
$TTL 86400
@   IN  SOA midominio.com. admin.midominio.com. (
        20240210 ; Serial
        604800   ; Refresh
        86400    ; Retry
        2419200  ; Expire
        86400 )  ; Minimum TTL

@   IN  NS  ns.midominio.com.
ns  IN  A   10.1.2.10
server1 IN  A   10.1.2.20
```

### 🔹 Reiniciar BIND9 y verificar
```bash
sudo systemctl restart bind9
sudo systemctl enable bind9
sudo systemctl status bind9
```

### 🔹 Probar la resolución de nombres
```bash
nslookup server1.midominio.com 10.1.2.10
```
---
## 3️⃣ Instalar y Configurar el Servicio DHCP (isc-dhcp-server)

### 🔹 Instalar DHCP Server
```bash
sudo apt install -y isc-dhcp-server
```

### 🔹 Configurar interfaz de red
```bash
sudo nano /etc/default/isc-dhcp-server
```
Modificar:
```yaml
INTERFACESv4="ens33"  # Reemplaza con tu interfaz de red
```

### 🔹 Configurar el Rango de IPs en DHCP
```bash
sudo nano /etc/dhcp/dhcpd.conf
```
Ejemplo:
```yaml
subnet 10.1.2.0 netmask 255.255.255.0 {
    range 10.1.2.100 10.1.2.200;
    option routers 10.1.2.1;
    option domain-name-servers 10.1.2.10, 8.8.8.8;
    option domain-name "midominio.com";
    default-lease-time 600;
    max-lease-time 7200;
}

host pc-cliente {
    hardware ethernet AA:BB:CC:DD:EE:FF;
    fixed-address 10.1.2.50;
}
```

### 🔹 Reiniciar el Servidor DHCP
```bash
sudo systemctl restart isc-dhcp-server
sudo systemctl enable isc-dhcp-server
sudo systemctl status isc-dhcp-server
```
---
## 4️⃣ Pruebas Finales

### 🔹 Ver Clientes Conectados
```bash
cat /var/lib/dhcp/dhcpd.leases
```

### 🔹 Comprobar si un Cliente Recibe IP
Desde un cliente en la red:
```bash
dhclient -v
```

### 🔹 Comprobar la Resolución de Nombres DNS
```bash
nslookup server1.midominio.com
```

---
## ✅ Conclusión

🚀 **Tu servidor Ubuntu ahora tiene:**
- DNS con **BIND9** (resolución de nombres en la red).
- DHCP con **isc-dhcp-server** (asignación de IPs automática).




































## 📖​Blibliografia📖​

https://github.com/mamedev/mame

https://github.com/ybootin/mamejs?tab=readme-ov-file

https://www.digitalocean.com/community/tutorials/how-to-install-the-apache-web-server-on-ubuntu-20-04-es

https://www.youtube.com/watch?v=WyR-qPAagLo&ab_channel=IvanildoGalv%C3%A3o
