<details><summary><h1><strong>🎮​👾​🕹️​ RetroGold 🕹️​👾​🎮</strong></h1></summary>  

**RetroGold** es tu portal para revivir los videojuegos clásicos, impulsado por el emulador **MAME**.  
Una experiencia envolvente para los fans del retro gaming, permitiendo jugar títulos icónicos de los salones recreativos.  

<img src="https://github.com/user-attachments/assets/e8d85532-bad1-464d-8d1b-57406362fe65" width="250" height="250">  

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
- **VPN (WireGuard):** Implementado para simular el acceso remoto seguro desde otra red.  

📋 [Listado de Tareas del Equipo](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/Especificar%20listado%20de%20tareas.md)  

</details>  

---

<details><summary><h2><strong>🎯 Objetivos del Sistema</strong></h2></summary>  

- 🎮 **Acceso a Juegos Retro de Arcade**  
  Disfrutar de títulos clásicos alojados en un servidor web usando el emulador MAME.

- 🔐 **Modularidad y Seguridad**  
  Separar roles entre servidores y aplicar medidas de seguridad usando un firewall dedicado.

- 🌐 **Acceso Remoto Seguro**  
  Implementación de acceso por VPN mediante **WireGuard** para gestionar el entorno desde otra red.

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
🔗 [DNS y DHCP](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/DNSyDHCP.md)  
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
🔗 [Configuración temporal con pfSense](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/pfesense.md)  
- pfSense se utilizó al inicio del proyecto para pruebas básicas.  
- Posteriormente, se migró a **Sophos Firewall**, con reglas configuradas tras investigación adicional por parte del equipo.  

---

### 5️⃣ Acceso por VPN  
- Uso de **WireGuard** para permitir conexión segura desde una red externa simulada.  
- Investigación y pruebas realizadas por cuenta propia para asegurar acceso remoto.

</details>  
