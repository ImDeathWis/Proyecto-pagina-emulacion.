
<details><summary><h1><strong>🎮​👾​🕹️​ RetroGold 🕹️​👾​🎮</strong></h1></summary>  

**RetroGold** es tu portal para revivir los videojuegos clásicos, impulsado por el emulador **MAME**.  
Una experiencia envolvente para los fans del retro gaming, permitiendo jugar títulos icónicos de los salones recreativos.  

<img src="https://github.com/user-attachments/assets/e8d85532-bad1-464d-8d1b-57406362fe65" width="250" height="250">  
<br>
🔗 [Core del Proyecto](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/core_proyecto_Retrogold.md)

---

<details><summary><h2><strong>🛠️ Mapa de la Red</strong></h2></summary>  

📷 Diagrama general de la red implementada:  

<img src="https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/imagenes/mapa_de_red.jpg" width="960" height="540">  

📄 [Briefing del Proyecto (Resumen)](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/brifing.md)  


</details>  

---

<details><summary><h2><strong>🏗️ Arquitectura del Sistema</strong></h2></summary>  

**Componentes principales del entorno:**  

- **Servidor Web (Apache):** Aloja el portal de juegos retro.  
- **Servidor DNS:** Resuelve los dominios internos de la red.  
- **Servidor DHCP:** Asigna direcciones IP automáticamente.  
- **Firewall (Sophos):** Sistema final elegido para proteger la infraestructura.  
  - Inicialmente se utilizó **pfSense**, pero fue reemplazado por **Sophos Firewall** tras una búsqueda e investigación autónoma.  
- **VPN (Ngrok):** Implementado para simular el acceso remoto seguro desde otra red.  

📋 [Listado de Tareas del Equipo](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/Especificar%20listado%20de%20tareas.md)  

</details>  

---

<details><summary><h2><strong>🎯 Objetivos del Sistema</strong></h2></summary>  

- 🎮 **Acceso a Juegos Retro de Arcade**  
  Disfrutar de títulos clásicos alojados en un servidor web usando el emulador MAME.

- 🔐 **Modularidad y Seguridad**  
  Separar roles entre servidores y aplicar medidas de seguridad usando un firewall dedicado.

- 🌐 **Acceso Remoto Seguro**  
  Implementación de acceso por VPN mediante **Ngrok** para gestionar el entorno desde otra red.

👥 [Asignación de Roles del Equipo](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/Asignar%20roles%20y%20responsabilidades%20del%20equipo.md)  

</details>  

---

<details><summary><h2><strong>⚙️ Funcionamiento General</strong></h2></summary>  

Los usuarios acceden a una web donde pueden explorar y lanzar juegos clásicos. La comunicación entre servicios es la clave.  

---

### 1️⃣ Servidor Web (Apache)  
🔗 [Ver configuración detallada](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/Apache.md)  
- Alojamiento del sitio web (HTML, CSS, JS)  
- Integración de MAME + carga de ROMs desde servidor FTP  
- HTTPS mediante certificado SSL/TLS  

---

### 2️⃣ Servidor DNS  
🔗 [DNS y DHCP antes del SOPHOS](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/DNSyDHCP.md)  
🔗 [DNS integrado con Sophos](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/DNS%20con%20sophos%20Incluido.md)  
- Resolución de nombres internos  
- Subdominios personalizados  
- Redundancia con Google DNS y Cloudflare  

---

### 3️⃣ Servidor DHCP  
🔗 [Configuración DHCP](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/DNSyDHCP.md)  
- Asignación dinámica de IP  
- Gestión de rangos para distintas redes/dispositivos  

---

### 4️⃣ Firewall  
🔗 [Configuración temporal con pfSense](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/pfesense.md) <br>
🔗 [Configuración de Sophos y VPN](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/SOPHOS%20DHCP%20%2B%20FIREWALL%20.md)
- pfSense se utilizó al inicio del proyecto para pruebas básicas.  
- Posteriormente, se migró a **Sophos Firewall**, con reglas configuradas tras investigación adicional por parte del equipo.  

---

### 5️⃣ Acceso Remoto Seguro

Para simular el acceso externo al entorno de RetroGold, se configuró un sistema VPN basado en **SSL VPN Remote Access**, utilizando el propio firewall **Sophos**.
Además, para facilitar la apertura de puertos desde redes sin acceso a configuración NAT, se utilizó la herramienta **Ngrok**, lo que permitió exponer servicios locales a través de túneles seguros.
🔒 Esto proporcionó una conexión cifrada entre el entorno interno y el cliente externo, simulando un acceso remoto real.


</details>  

---

<details><summary><h2><strong>📦 Almacenamiento y Backups con TrueNAS</strong></h2></summary>  

Como parte de la infraestructura, se utilizó **TrueNAS** para gestionar el almacenamiento centralizado y las copias de seguridad del proyecto:  
<br>
🔗 [Configuración de TrueNAS](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/Backup_TrueNAS_Tutorial.md)<br>

- 📁 **Servidor de almacenamiento (NAS)** virtualizado en una máquina independiente.  
- 🛡️ **RAID 5** configurado para tolerancia a fallos y seguridad de datos.  
- 🔄 **Backups automatizados** de los servicios críticos del sistema (Apache, configuraciones DNS/DHCP, etc).  
- 🔗 **Integración vía rsync** desde servidores hacia datasets de TrueNAS.  
- 👤 Acceso configurado por usuarios y permisos definidos por dataset para asegurar el aislamiento de información.  

🔧 Se realizó la configuración completa desde la interfaz web de TrueNAS, asegurando facilidad de administración y monitoreo.  

</details> 

---

<details><summary><h2><strong>🧰 Tecnologías Utilizadas</strong></h2></summary>  

**Virtualización:**  
- VirtualBox / VMware  

**Red y Seguridad:**  
- Bind9 (DNS)  
- ISC DHCP Server  
- Sophos Firewall  

**Emulación y Servidores:**  
- Apache  
- N64
- MAME
- NES  

**Desarrollo Web:**  
- HTML, CSS, JavaScript  
- C# + WebAssembly (Blazor)  
- Figma para diseño UI  

**Gestión del Proyecto:**  
- GitHub (repositorio + documentación)  

</details>  

---

<details><summary><h2><strong>🖥️ Hardware Recomendado</strong></h2></summary>  

### Por máquina virtual (MV):  
- CPU: 2 núcleos  
- RAM: 2 GB  
- Disco: 20 GB SSD  
- Red: 1 Gbps  

### Para máquina física (host):  
- CPU: Intel i5/i7 o Ryzen 5/7  
- RAM: 8–16 GB  
- Almacenamiento: SSD 256 GB+  
- Conectividad: Wi-Fi y Ethernet  

</details>  

---

<details><summary><h2><strong>🔌 Servicios a Implementar</strong></h2></summary>  

| Servicio               | Función principal                                  | Herramienta                  |
|------------------------|---------------------------------------------------|------------------------------|
| Servidor Web           | Portal de juegos retro                            | Apache                       |
| DNS                    | Resolución de dominios internos                   | Bind9                        |
| DHCP                   | Asignación de IPs dinámicas                       | ISC DHCP Server              |
| Firewall               | Seguridad de la red                               | Sophos Firewall              |
| Emulación              | Juegos clásicos retro                             | RetroArch                    |
| Desarrollo Web         | Interfaz web interactiva                          | HTML, CSS, JS, C#, Blazor    |
| Control de versiones   | Documentación y desarrollo colaborativo           | GitHub                       |

</details>  

---

<details><summary><h2><strong>💽 Sistemas Operativos</strong></h2></summary>  

| Sistema Operativo     | Uso en el Proyecto                 | Versión Recomendada    |
|-----------------------|------------------------------------|------------------------|
| Ubuntu Server         | Servidores principales              | 22.04 LTS              |
| Ubuntu Desktop        | Desarrollo y pruebas gráficas       | 22.04 LTS              |
| Sophos Firewall OS    | Gestión de seguridad de red         | Sophos XG / UTM        |

</details>  

---

<details><summary><h2><strong>📚 Bibliografía</strong></h2></summary>  

- https://github.com/mamedev/mame  
- https://github.com/ybootin/mamejs?tab=readme-ov-file  
- https://www.digitalocean.com/community/tutorials/how-to-install-the-apache-web-server-on-ubuntu-20-04-es  
- https://www.youtube.com/watch?v=WyR-qPAagLo  
- https://www.ionos.es/digitalguide/servidores/configuracion/instalar-apache-en-ubuntu/  
- https://extassisnetwork.com/tutoriales/como-instalar-apache-en-ubuntu/  
- https://ubuntu.com/server/docs/set-up-an-ftp-server  
- https://github.com/kabukki/wasm-nes  
- https://www.php.net/manual/es/function.phpinfo.php  
- https://github.com/mupen64plus  
- https://jsnes.org/  
- https://www.youtube.com/watch?v=nQu4U0r-w-M&list=PLS1R8PLgpkVROGR9dAWw6gtyuq_oA-Z2q&index=6
- https://www.youtube.com/watch?v=FZv3zBIH8io&t=99s

</details>  
