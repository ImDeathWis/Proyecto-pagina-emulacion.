# Servidor DNS con BIND9 en Ubuntu Server Sophos

<a href="https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/README.md" target="_blank">Haz clic aquí Para Volver a la Página Original</a>

<details><summary><h1><strong>📄 Configuración de Servidor DNS con BIND9</strong></h1></summary>

<h2>⚠️ Nota Importante:</h2>
<ul>
  <li>El servidor <strong>DHCP del Sophos</strong> no está asignando direcciones IP estáticas, por lo que se recomienda configurarlas manualmente en cada dispositivo o usar una reserva de IP en el DHCP para los dispositivos que requieran una IP fija.</li>
  <li>El <strong>nombre de dominio</strong> configurado para la red local es <code>retrogold.local</code>.</li>
</ul>

<h2>🔍 Introducción</h2>
<p>Este documento describe la configuración y solución de problemas del servidor DNS en la máquina con IP <code>192.168.6.10</code>, utilizando BIND9 en un entorno de red con el dominio <code>retrogold.local</code>. BIND9 se utiliza para resolver tanto nombres de dominio directos como inversos en la red local.</p>

<h2>💻 Instalación de BIND9</h2>
<p>Para instalar BIND9 en la máquina, ejecute el siguiente comando en la terminal:</p>
<pre><code>sudo apt update && sudo apt install bind9 -y</code></pre>

<h2>⚙️ Configuración de Zonas DNS</h2>

<h3>3.1. 📝 Archivo de configuración principal <code>/etc/bind/named.conf.local</code></h3>
<p>Este archivo define las zonas directa e inversa para el servidor DNS. Añadir las siguientes líneas:</p>
<pre><code>sudo nano /etc/bind/named.conf.local</code></pre>
Contenido:
<pre><code>
zone "retrogold.local" {
    type master;
    file "/etc/bind/zonas/db.retrogold.local";
};

zone "6.168.192.in-addr.arpa" {
    type master;
    file "/etc/bind/zonas/db.6.168.192";
};
</code></pre>

<h3>3.2. 🗂️ Creación del directorio para las zonas y asignación de permisos</h3>
<pre><code>sudo mkdir -p /etc/bind/zonas</code></pre>
<pre><code>sudo chown -R bind:bind /etc/bind/zonas</code></pre>
<pre><code>sudo chmod -R 755 /etc/bind/zonas</code></pre>

<h3>3.3. 🗒️ Configuración de la Zona Directa <code>/etc/bind/zonas/db.retrogold.local</code></h3>
<pre><code>sudo nano /etc/bind/zonas/db.retrogold.local</code></pre>
Contenido:
<pre><code>
$TTL 604800
@   IN  SOA ns1.retrogold.local. admin.retrogold.local. (
    2024032201 ; Serial
    604800     ; Refresh
    86400      ; Retry
    2419200    ; Expire
    604800 )   ; Negative Cache TTL
;
@       IN  NS      ns1.retrogold.local.
ns1     IN  A       192.168.6.10
www     IN  A       192.168.6.20
ftp     IN  A       192.168.6.30
nas     IN  A       192.168.6.40
</code></pre>

<h3>3.4. 🔄 Configuración de la Zona Inversa <code>/etc/bind/zonas/db.6.168.192</code></h3>
<pre><code>sudo nano /etc/bind/zonas/db.6.168.192</code></pre>
Contenido:
<pre><code>
$TTL 604800
@   IN  SOA ns1.retrogold.local. admin.retrogold.local. (
    2024032201 ; Serial
    604800     ; Refresh
    86400      ; Retry
    2419200    ; Expire
    604800 )   ; Negative Cache TTL
;
@       IN  NS      ns1.retrogold.local.
10      IN  PTR     ns1.retrogold.local.
20      IN  PTR     www.retrogold.local.
30      IN  PTR     ftp.retrogold.local.
40      IN  PTR     nas.retrogold.local.
</code></pre>

<h3>3.5. 🔒 Asignación de permisos correctos a los archivos de zona</h3>
<pre><code>sudo chown root:bind /etc/bind/zonas/db.*</code></pre>
<pre><code>sudo chmod 644 /etc/bind/zonas/db.*</code></pre>

<h2>4. 🔧 Configuración del archivo <code>/etc/bind/named.conf.options</code></h2>
<p>Este archivo configura las opciones globales de BIND9. Añadir las siguientes configuraciones para definir las ACLs (listas de control de acceso), permitir consultas desde la red local, habilitar la recursión y configurar los reenvíos a otros servidores DNS.</p>
<pre><code>sudo nano /etc/bind/named.conf.options</code></pre>
Contenido del archivo:
<pre><code>
acl "red_local" {
    192.168.6.0/24;
};

options {
    directory "/var/cache/bind";

    // Habilita la recursión de consultas
    recursion yes;
    allow-query { red_local; };

    // Validación de DNSSEC
    dnssec-validation auto;

    // Definir servidores DNS para reenviar las consultas
    forwarders {
        8.8.8.8;
        8.8.4.4;
    };

    // Especificar la IP del servidor para escuchar las consultas DNS
    listen-on { 192.168.6.10; };

    // Descomentar para habilitar IPv6 (si es necesario)
    // listen-on-v6 { any; };
};
</code></pre>

<h2>5. 🔄 Configuración del Archivo <code>/etc/resolv.conf</code></h2>
<p>Para que el sistema use el DNS local, crea un enlace simbólico hacia el archivo de configuración del sistema:</p>
<pre><code>sudo ln -sf /run/systemd/resolve/resolv.conf /etc/resolv.conf</code></pre>
<p>Verifica el contenido del archivo <code>/etc/resolv.conf</code>:</p>
<pre><code>cat /etc/resolv.conf</code></pre>
El archivo debe contener lo siguiente:
<pre><code>
domain RetroDHCPGold
search RetroDHCPGold
nameserver 192.168.6.10
nameserver 8.8.8.8
</code></pre>

<h2>6. 🔄 Reinicio y Verificación del Servicio</h2>
<p>Una vez realizadas todas las configuraciones, reinicia el servicio de BIND9:</p>
<pre><code>sudo systemctl restart bind9</code></pre>
<pre><code>sudo systemctl status bind9</code></pre>

<h2>7. 🧪 Pruebas de Funcionamiento</h2>

<h3>7.1. 🔎 Prueba con <code>nslookup</code></h3>
<p>Para verificar que el servidor DNS responde correctamente a las consultas, utiliza el comando <code>nslookup</code>:</p>
<pre><code>nslookup ns1.retrogold.local 192.168.6.10</code></pre>

<h3>7.2. 📡 Prueba con <code>dig</code></h3>
<p>Utiliza <code>dig</code> para comprobar la resolución DNS:</p>
<pre><code>dig @192.168.6.10 ns1.retrogold.local</code></pre>

<h3>7.3. 🔄 Prueba de Zona Inversa</h3>
<p>Verifica la zona inversa utilizando <code>dig -x</code>:</p>
<pre><code>dig -x 192.168.6.10 @192.168.6.10</code></pre>

<h2>8. 🛠️ Solución de Problemas</h2>
<ul>
  <li>Verifica el estado de BIND9: <pre><code>sudo systemctl status bind9</code></pre></li>
  <li>Revisa los archivos de zona en busca de errores de sintaxis: <pre><code>sudo named-checkzone retrogold.local /etc/bind/zonas/db.retrogold.local</code></pre><pre><code>sudo named-checkzone 6.168.192.in-addr.arpa /etc/bind/zonas/db.6.168.192</code></pre></li>
  <li>Verifica los logs en caso de errores: <pre><code>sudo journalctl -xe | grep named</code></pre></li>
</ul>

<h2>9. ✅ Conclusión</h2>
<p>Con esta configuración, el servidor DNS local resolverá tanto los nombres de dominio internos (como <code>www.retrogold.local</code>, <code>ftp.retrogold.local</code>, etc.) como las consultas inversas para la red local. Además, se ha configurado para reenviar consultas fuera de la red local a servidores DNS públicos de Google, lo que garantiza una resolución eficiente.</p>

<p>¡Tu servidor DNS ahora está listo para usarse! 🎉</p>

</details>

