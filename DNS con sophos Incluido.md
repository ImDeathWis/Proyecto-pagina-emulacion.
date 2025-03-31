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

### **📝 2.1. Instalación de BIND9**
<details>
<summary>💾 Instalación</summary>
<p>Para instalar BIND9 en la máquina, ejecutar:</p>
<pre><code>sudo apt update && sudo apt install bind9 -y</code></pre>
</details>

### **📝 2.2. Archivos de Configuración**
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
<summary>🛑 3.1. El servidor DNS no resuelve correctamente</summary>
<p><strong>Solución:</strong></p>
<pre><code>
echo "nameserver 192.168.6.6" | sudo tee /etc/resolv.conf
sudo systemctl disable --now systemd-resolved
</code></pre>
</details>

<details>
<summary>⚠️ 3.2. Error en named-checkzone</summary>
<pre><code>
named-checkzone retrogold.com /etc/bind/zones/db.retrogold.com
named-checkzone 6.168.192.in-addr.arpa /etc/bind/zones/db.6.168.192
</code></pre>
</details>

<details>
<summary>🔄 3.3. Restauración de /etc/resolv.conf</summary>
<pre><code>
sudo nano /etc/resolv.conf
</code></pre>
<p>Agregar:</p>
<pre><code>
nameserver 192.168.6.6
nameserver 8.8.8.8
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
