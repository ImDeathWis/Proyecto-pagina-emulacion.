# SERVIDOR FTP


<details><summary><h1><strong>📂 Introducción a FTP</strong></h1></summary>

<h2>📌 Definición</h2>

Un **Servidor FTP (File Transfer Protocol)** es un sistema que permite la transferencia de archivos entre dispositivos a través de una red, utilizando el protocolo FTP. Se usa comúnmente para compartir y administrar archivos en entornos locales o remotos.  

<h2>❓ ¿Por qué es necesario?</h2>

✅ Facilita la transferencia de archivos entre clientes y servidores.  
✅ Permite **usuarios con permisos específicos** para gestionar archivos.  
✅ Compatible con múltiples plataformas (Windows, Linux, macOS).  
✅ Se puede integrar con **FTPS o SFTP** para mayor seguridad.  

<h2>⚖️ Ventajas y Desventajas</h2>

✔️ **Ventajas**  
- Rápido y eficiente para la transferencia de archivos grandes.  
- Fácil de configurar y administrar en entornos locales y empresariales.  
- Compatible con múltiples sistemas operativos y clientes FTP.  

❌ **Desventajas**  
- **Inseguro por defecto**: FTP no cifra los datos, lo que puede ser un riesgo en redes abiertas.  
- **Usa múltiples puertos**, lo que puede ser complicado en redes con firewall.  
- **Puede ser reemplazado por métodos más seguros**, como SFTP o FTPS.  

<h2>🛠️ ¿Qué necesitamos para configurar un Servidor FTP?</h2>

1️⃣ **Elegir un software de servidor FTP** (Ejemplo: **vsftpd, ProFTPD, FileZilla Server**).  
2️⃣ **Configurar cuentas de usuario** y establecer permisos adecuados.  
3️⃣ **Abrir los puertos necesarios** en el firewall (Ejemplo: 21 para FTP, 990 para FTPS).  
4️⃣ **Configurar opciones de seguridad** como encriptación (FTPS o SFTP).  
5️⃣ **Probar la conexión** con un cliente FTP como **FileZilla o WinSCP**.  

<h2>🌐 Información oficial</h2>

🔗 Documentación sobre servidores FTP:  
<a href="https://www.w3.org/Protocols/rfc959/" target="_blank">RFC 959 - FTP Protocol</a>  

</details>

<details><summary><h1><strong>🖥️ Detalles de la Máquina Virtual en VirtualBox 🚀</strong></h1></summary>

<h3>Detalles de la MV</h3>

- <strong>Nombre:</strong> `ServidorFTP`
- <strong>Tipo:</strong> Ubuntu (64-bit)  

<h3>Asignación de Recursos</h3>

- <strong>3 procesadores</strong>  
- <strong>4096 MB de RAM</strong>  
- <strong>Disco de 25 GB</strong>
- <strong>ISO: ubuntu-24.04.1-live-server-amd64.iso</strong>  

<h3>Configuración de Red</h3>

- En <strong>Adaptador 1</strong>, selecciona `Red NAT` 🌐 con la red <strong>192.168.6.0/24</strong>.
  
</details>
