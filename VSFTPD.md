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



#otro



# **📄 Documentación de Configuración y Solución de Problemas en BIND9**

## **🔹 1. Introducción**
<details>
<summary>📌 Descripción</summary>
<p>Este documento describe la configuración y solución de problemas en un servidor DNS BIND9 en Ubuntu. Se documentan los errores encontrados, las causas y las soluciones aplicadas, basándonos en la configuración del servidor <strong>dns.retrogold.com (192.168.6.6)</strong>.</p>
</details>

---

## **🛠️ 2. Configuración del Servidor DNS BIND9**
<details>
<summary>📍 Información General</summary>
<ul>
<li>El servidor DNS se encuentra en la IP <strong>192.168.6.6</strong>.</li>
<li>Tiene configuradas zonas directas e inversas:
  <ul>
    <li><strong>Zona directa:</strong> <code>db.retrogold.com</code></li>
    <li><strong>Zona inversa:</strong> <code>db.6.168.192</code></li>
  </ul>
</li>
<li>El firewall <strong>Sophos</strong> asigna IPs estáticas y configura <code>/etc/resolv.conf</code> con:
<pre><code>
domain retrogold.com
search retrogold.com
nameserver 192.168.6.6
nameserver 8.8.8.8
</code></pre>
</li>
</ul>
</details>

### **📝 2.1. Archivos de Configuración**
<details>
<summary>📄 named.conf.local</summary>
<pre><code>
zone "retrogold.com" IN {
    type master;
    file "/etc/bind/zones/db.retrogold.com";
};

zone "6.168.192.in-addr.arpa" IN {
    type master;
    file "/etc/bind/zones/db.6.168.192";
};
</code></pre>
</details>

<details>
<summary>⚙️ named.conf.options</summary>
<pre><code>
acl "autorizados" {
    192.168.6.0/24;
};

options {
    directory "/var/cache/bind";
    recursion yes;
    allow-recursion { autorizados; };
    listen-on { 192.168.6.6; };
    allow-transfer { none; };

    forwarders {
        8.8.8.8;
        8.8.4.4;
    };

    dnssec-validation no;
    allow-query { 192.168.6.0/24; };
};
</code></pre>
</details>

<details>
<summary>📂 Archivo de Zona Directa (db.retrogold.com)</summary>
<pre><code>
$TTL 604800
@   IN  SOA dns.retrogold.com. root.retrogold.com. (
        20250327 ; Serial
        604800   ; Refresh
        86400    ; Retry
        2419200  ; Expire
        604800 ) ; Negative Cache TTL
;
@       IN  NS  dns.retrogold.com.
dns     IN  A   192.168.6.6
cliente-proyecto IN A 192.168.6.8
</code></pre>
</details>

<details>
<summary>🔄 Archivo de Zona Inversa (db.6.168.192)</summary>
<pre><code>
$TTL 604800
@   IN  SOA dns.retrogold.com. root.retrogold.com. (
        20250327 ; Serial
        604800   ; Refresh
        86400    ; Retry
        2419200  ; Expire
        604800 ) ; Negative Cache TTL
;
@       IN  NS  dns.retrogold.com.
6       IN  PTR dns.retrogold.com.
8       IN  PTR cliente-proyecto.retrogold.com.
</code></pre>
</details>

---

## **🚨 3. Problemas Encontrados y Soluciones**
<details>
<summary>🛑 3.1. El servidor DNS no resolvía correctamente</summary>
<p><strong>Problema:</strong> <br>
Al hacer <code>dig retrogold.com</code>, no obteníamos la respuesta correcta.</p>

<p><strong>Solución:</strong></p>
<pre><code>
systemctl restart bind9
</code></pre>
</details>

<details>
<summary>⚠️ 3.2. Error en named-checkzone</summary>
<p><strong>Problema:</strong> <br>
Se intentó verificar la zona con un archivo incorrecto.</p>

<p><strong>Solución:</strong></p>
<pre><code>
named-checkzone retrogold.com /etc/bind/zones/db.retrogold.com
named-checkzone 6.168.192.in-addr.arpa /etc/bind/zones/db.6.168.192
</code></pre>
</details>

<details>
<summary>🔄 3.3. El servicio BIND9 no cargaba correctamente las zonas</summary>
<p><strong>Solución:</strong></p>
<pre><code>
rndc reload
systemctl restart bind9
systemctl status bind9
ss -tulnp | grep named
</code></pre>
</details>

<details>
<summary>📝 3.4. Restauración de /etc/resolv.conf</summary>
<p><strong>Solución:</strong></p>
<pre><code>
sudo nano /etc/resolv.conf
</code></pre>
<p>Agregar:</p>
<pre><code>
nameserver 192.168.6.6
nameserver 8.8.8.8
nameserver 9.9.9.9
search retrogold.com
</code></pre>
<p>Proteger el archivo:</p>
<pre><code>
sudo chattr +i /etc/resolv.conf
</code></pre>
</details>

---

## **✅ 4. Pruebas Finales**
<details>
<summary>🔍 Comprobaciones</summary>
<ul>
<li><strong>Zona directa:</strong> <code>dig @192.168.6.6 retrogold.com</code></li>
<li><strong>Zona inversa:</strong> <code>dig @192.168.6.6 -x 192.168.6.8</code></li>
<li><strong>NSLOOKUP:</strong> <code>nslookup retrogold.com 192.168.6.6</code></li>
<li><strong>PING:</strong> <code>ping cliente-proyecto.retrogold.com</code></li>
</ul>
</details>

---

## **🏁 5. Conclusión**
<ul>
<li>El cliente debía usar el servidor DNS correcto.</li>
<li>Se corrigieron errores en la configuración de las zonas.</li>
<li>Se verificó que BIND9 estuviera ejecutándose y escuchando en el puerto 53.</li>
<li>Se restauró y protegió <code>/etc/resolv.conf</code>.</li>
<li>Finalmente, las consultas DNS se resolvieron correctamente.</li>
</ul>

🚀 **Servidor BIND9 en dns.retrogold.com (192.168.6.6) funcionando correctamente.**




















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
