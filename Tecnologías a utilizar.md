 # 📘 Guía de Uso: DNS y DHCP

## 📌 1. Introducción al Servicio  

### 🖥️ 1.1 ¿Qué es DNS y DHCP?  

#### 🌐 DNS (Domain Name System)  
El **DNS** se encarga de traducir los nombres de dominio en direcciones IP para que sean comprensibles tanto por las personas como por las máquinas

Ejemplo:  
- **Dominio**: `www.ifp.es`  
- **Dirección IP**: `104.18.17.17`  

#### 📡 DHCP (Dynamic Host Configuration Protocol)  
**DHCP** es un protocolo de red que permite a un servidor asignar automáticamente direcciones IP y otros parámetros de configuración a los dispositivos conectados a la red. Esto nos +evita la necesidad de configurar manualmente cada dispositivo. 

---

## 🛠️ 2. ¿Por qué es necesario?  

### 2.1 Importancia del DNS  
- Permite la navegación en Internet sin recordar direcciones IP.  
- Facilita la conexión entre usuarios y servidores.  
- Resuelve nombres de dominio en direcciones IP correctas.  

### 2.2 Importancia del DHCP  
- Automatiza la asignación de direcciones IP.  
- Evita conflictos de direcciones IP en la red.  
- Optimiza la gestión de recursos de red.  

---

## 📚 3. ¿Dónde hay información oficial?  

[www.cisc](https://www.cisco.com/c/en/us/td/docs/ios-xml/ios/ipaddr_dhcp/configuration/15-mt/dhcp-15-mt-book.html)
https://www.fs.com/es/blog/dhcp-and-dns-difference-2676.html
https://www.adslzone.net/reportajes/internet/mejores-dns/
https://www.ionos.es/digitalguide/servidores/configuracion/que-es-el-dhcp-y-como-funciona/

### 🌍 **Detalles de la MV**  

 - Memoria base: 4096
 - Procesadores: 3
 - Red: Intel PRO/1000 MT Desktop (Red NAT, <SMX2_Rednat1>)
 - ISO: ubuntu-22.04.2-live-server-amd64.iso
 - Tamaño virtual: 50 

---

# 📌 Configuración de DNS y DHCP en Ubuntu (Red NAT 10.1.2.1)

## ✅ Requisitos previos
- Ubuntu Server instalado.
- Conexión a Internet.
- Acceso con permisos de superusuario (`sudo`).
- Red NAT con gateway `192.168.56.1`.

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
        - 192.168.56.0/24  # IP estática del servidor
      gateway4: 192.168.56.1
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
    listen-on { 192.168.56.10; };
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
ns  IN  A   192.168.56.10
server1 IN  A   192.168.56.10
```

### 🔹 Reiniciar BIND9 y verificar
```bash
sudo systemctl restart bind9
sudo systemctl enable bind9
sudo systemctl status bind9
```

### 🔹 Probar la resolución de nombres
```bash
nslookup server1.midominio.com 192.168.56.10
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
subnet 192.168.56.0 netmask 255.255.255.0 {
    range 192.168.56.100 192.168.56.200;
    option routers 192.168.56.1;
    option domain-name-servers 192.168.56.10, 8.8.8.8;
    option domain-name "midominio.com";
    default-lease-time 600;
    max-lease-time 7200;
}

host pc-cliente {
    hardware ethernet AA:BB:CC:DD:EE:FF;
    fixed-address 192.168.56.50;
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


