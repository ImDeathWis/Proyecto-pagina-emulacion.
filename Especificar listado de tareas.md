[VOLVER ATRÁS](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/README.md)

# ✅ Proyecto: Plataforma de Emulación de Videojuegos Retro en Docker  

## 📌 Fase 1: Planificación y Preparación  
- [ ] Definir el alcance y objetivos principales del proyecto.  
- [ ] Asignar roles y responsabilidades entre los integrantes del equipo.  
- [ ] Crear un **repositorio en GitHub** para control de versiones.  
- [ ] Descargar las **ISO de Ubuntu Server** para las **Máquinas Virtuales (MV)**.  
- [ ] Diseñar la estructura y esquema de la web con **Figma**.  

---

## 📚 Fase 2: Estudio e Investigación  
Cada integrante debe estudiar los siguientes temas antes de la implementación. Se recomienda usar **tutoriales, OpenWebinars, YouTube y documentación oficial**.  

### 🔹 Infraestructura y Redes  
- [ ] Conceptos básicos de **Máquinas Virtuales (MV)** y su configuración en **Ubuntu Server**.  
- [ ] Fundamentos de redes (IP, DNS, DHCP, NAT, Firewall).  
- [ ] Configuración de redes en VirtualBox/VMware.  

### 🔹 Seguridad y Firewall  
- [ ] Funcionamiento de **Sophos Firewall** y su implementación en la misma MV del servidor DHCP.  
- [ ] Configuración de reglas de firewall y filtrado de tráfico.  

### 🔹 Administración de Servidores  
- [ ] Configuración de **servidores FTP** (vsftpd o ProFTPD).  
- [ ] Configuración de **servidores DNS** (Bind9).  
- [ ] Configuración de **servidores DHCP** (ISC DHCP Server).  
- [ ] Configuración de **servidores web Apache**.  

### 🔹 Desarrollo Web  
- [ ] Diseño del esquema de la interfaz web en **Figma**.  
- [ ] Aprender HTML, CSS y JavaScript.  

### 🔹 Emulación de Videojuegos  
- [ ] Instalación y configuración de **RetroArch** en Ubuntu.  
- [ ] Descarga y configuración de **cores de emulación**.  
- [ ] Gestión de ROMs y compatibilidad de juegos.  

---

## 🖥️ Fase 3: Instalación y Configuración de Máquinas Virtuales (MV) en Ubuntu  
- [ ] Instalar **VirtualBox / VMware** en cada máquina.  
- [ ] Crear e instalar las MV con **Ubuntu Server**.  
- [ ] Asignar recursos adecuados (CPU, RAM, almacenamiento).  
- [ ] Configurar conexión de red (modo puente).  
- [ ] Instalar herramientas básicas en la MV:  
  - [ ] **OpenSSH**  
  - [ ] **Git**  
  - [ ] **Paquetes básicos** (net-tools, nano, curl, etc.).  

---

## 🔥 Fase 4: Configuración del Firewall con Sophos  
- [ ] Descargar e instalar **Sophos UTM / XG Firewall** en la MV.  
- [ ] Configurar interfaces de red en Sophos (WAN, LAN).  
- [ ] Crear reglas de firewall y filtrado de tráfico.  
- [ ] Configurar NAT y reenvío de puertos.  

---

## 🖧 Fase 5: Configuración de Servicios en MV (Ubuntu)  

### 🌐 Servidor DNS/DHCP  
- [ ] Instalar y configurar **Bind9** como servidor DNS.  
- [ ] Crear registros para la resolución de nombres internos.  
- [ ] Instalar y configurar **ISC DHCP Server** para asignación dinámica de IPs.  

### 📂 Servidor FTP (Almacenamiento de ROMs)  
- [ ] Instalar **vsftpd** o **ProFTPD** en la MV.  
- [ ] Configurar permisos y autenticación.  
- [ ] Crear estructura de carpetas para ROMs.  

### 🌍 Servidor Web (Apache)  
- [ ] Instalar y configurar **Apache** en la MV.  
- [ ] Implementar el diseño web creado en **Figma**.  
- [ ] Integrar la interfaz con el servidor FTP.  

---

## 🎮 Fase 6: Instalación y Configuración de RetroArch  
- [ ] Instalar **RetroArch** en la MV con Ubuntu Server.  
- [ ] Descargar y configurar cores para diferentes consolas.  
- [ ] Configurar controles y opciones gráficas.  
- [ ] Probar la ejecución de juegos.  

---

## 📦 Fase 7: Exportación a Docker y Contenedores  
- [ ] Instalar **Docker y Docker Compose** en la MV.  
- [ ] Crear archivos **Dockerfile** para cada servicio:  
  - [ ] **Apache (Servidor Web)**  
  - [ ] **FTP (Almacenamiento de ROMs)**  
  - [ ] **DNS/DHCP (Servicios de Red)**  
  - [ ] **RetroArch (Emulador de Juegos)**  
- [ ] Migrar las configuraciones de los servicios a contenedores Docker.  
- [ ] Crear el archivo **docker-compose.yml**.  
- [ ] Verificar que los contenedores funcionan correctamente.  

---

## 🔄 Fase 8: Optimización, Seguridad y Copias de Seguridad  
- [ ] Revisar permisos y accesos en cada servicio.  
- [ ] Implementar medidas de seguridad en **Apache, FTP y RetroArch**.  
- [ ] Realizar pruebas de carga y optimización de rendimiento.  
- [ ] Hacer copias de seguridad de ROMs y configuraciones.  

---

## 🚀 Fase 9: Pruebas Finales y Entrega  
- [ ] Hacer pruebas completas de funcionamiento.  
- [ ] Documentar todo el proceso y crear una guía de instalación.  
- [ ] Verificar que la documentación está clara y completa.  
- [ ] Preparar la presentación y entrega del proyecto.  


