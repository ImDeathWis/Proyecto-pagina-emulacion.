# 🎮 Proyecto de Síntesis: Plataforma de Emulación de Videojuegos Retro en Contenedores Docker  

## 📌 Distribución de Roles y Responsabilidades  

Para garantizar que ambos integrantes adquieran el mismo nivel de conocimiento y habilidades técnicas, cada persona será responsable de investigar, aprender y posteriormente enseñar a su compañero/a lo que ha comprendido. Además, cada uno mantendrá una copia en su **Máquina Virtual (MV)** para evitar la pérdida del proyecto antes de la entrega.  

## 🔄 Aprendizaje y Enseñanza Mutua  
Cada integrante del equipo deberá:  
✅ **Buscar información relevante** sobre su área asignada en cursos, tutoriales y documentación técnica (Open Webinars, documentación oficial de Docker, foros especializados, documentación de RetroArch, etc.).  
✅ **Aplicar lo aprendido** en su respectiva parte del proyecto.  
✅ **Enseñar al compañero/a** lo aprendido, asegurándose de que ambos dominen la configuración, implementación y mantenimiento de todos los servicios.  
✅ **Crear documentación básica** de los procesos realizados, para acceso rápido en caso de dudas.  
✅ **Mantener una copia del proyecto** en su propia máquina virtual (MV), asegurando redundancia y disponibilidad en caso de fallos.  

---

## 👥 Mateo Sarmiente: Infraestructura, Redes y Configuración de RetroArch  
- **Docker y Contenedores**  
  - Creación y configuración del `docker-compose.yml`.  
  - Gestión de redes en Docker y conexión entre contenedores.  
- **Servicios de Red**  
  - Configuración y mantenimiento del contenedor **DNS/DHCP** con `Bind9` y `ISC DHCP Server`.  
  - Garantizar la conectividad y resolución de nombres de dominio.  
- **Seguridad y Accesibilidad**  
  - Configuración de permisos adecuados en Docker y en los servicios.  
  - Control de accesos y medidas de seguridad básicas.  
- **RetroArch (Configuración de Emuladores)**  
  - Instalación y configuración de **RetroArch** en Docker.  
  - Gestión de **cores** para diferentes consolas retro.  
  - Configuración de controladores y mapeo de teclas.  

📚 **Fuentes de Aprendizaje**:  
- Open Webinars (cursos sobre Docker, redes y administración de sistemas).  
- Documentación oficial de Docker y RetroArch.  
- Foros y comunidades como Stack Overflow, GitHub y Reddit (r/RetroArch).  

🧑‍🏫 **Enseñanza a Luis Miguel:** Explicar cómo se configura Docker, las redes, la seguridad en el proyecto y la integración de RetroArch.  

---

## 👥 Luis Miguel Gutiérrez: Desarrollo Web, Almacenamiento y Configuración de RetroArch  
- **Servidor Web (Apache)**  
  - Configuración del contenedor Apache y ajustes de servidor.  
  - Desarrollo de la interfaz web (HTML, CSS, JS).  
- **Servidor FTP**  
  - Implementación del servidor FTP con **vsftpd** o **ProFTPD**.  
  - Estructuración y organización del almacenamiento de ROMs.  
- **Integración con Emuladores y RetroArch**  
  - Asegurar la ejecución de los videojuegos desde la plataforma web.  
  - Configurar los scripts necesarios para la interacción con los emuladores en Docker.  
  - Sincronización entre la interfaz web y la ejecución de RetroArch.  

📚 **Fuentes de Aprendizaje**:  
- Open Webinars (cursos de desarrollo web y servidores).  
- Documentación de Apache, FTP y RetroArch.  
- Tutoriales en YouTube y blogs especializados sobre RetroArch y Docker.  

🧑‍🏫 **Enseñanza a Mateo:** Explicar cómo se configura Apache, FTP, la interfaz web y la integración con RetroArch desde la plataforma.  

---

## 📂 Copia de Seguridad y Gestión del Proyecto  
Para evitar la pérdida del proyecto y asegurar su disponibilidad:  
✅ Cada persona mantendrá una copia completa del proyecto en su **Máquina Virtual (MV)**.  
✅ Se usarán herramientas como **GitHub/GitLab** para almacenar y versionar el código.  
✅ Se realizarán pruebas individuales antes de la integración final.  
