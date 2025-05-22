[VOLVER ATRÁS](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/README.md)

# Guía de Configuración de Sophos para Redes Locales

## 🔍 Introducción

Este documento recoge toda la configuración básica de un firewall Sophos, pensada para crear una red local segura, ordenada y accesible también desde fuera. Explicamos cómo se organizan las IPs, cómo proteger la red con reglas, y cómo permitir el acceso remoto por VPN o ngrok. Está escrita con un lenguaje claro para que cualquier persona con conocimientos básicos de redes lo entienda.

---

## 🌐 Red y Direccionamiento IP

### 📍 ¿Qué es?

Es la parte donde asignamos direcciones IP a los dispositivos. Se usa una IP para la red interna (LAN) y otra para salir a internet (WAN).

### 📊 ¿Para qué sirve?

* Para que todos los equipos de la red se comuniquen correctamente.
* Para que el firewall y los servidores tengan IPs fijas.
* Para que el servidor DHCP reparta IPs automáticas sin conflictos.

### 🔧 Lo que configuramos:

* Interfaz LAN: `192.168.6.1/24`
* Interfaz WAN: `192.168.0.185` *(IP asignada por el router de casa, puede cambiar dependiendo de dónde se inicie la máquina virtual Sophos)*
* DNS local: `192.168.6.6`
* Rango DHCP: `192.168.6.100 - 192.168.6.200`
* Reservas: DNS, Apache y TrueNAS con IP fija

---

## 🔒 ACL y Acceso al Panel de Sophos

### 📍 ¿Qué es?

Una ACL es una regla que limita quién puede entrar al panel de administración de Sophos.

### 📊 ¿Para qué sirve?

* Para que sólo ciertas IPs puedan acceder a la configuración.
* Para evitar que usuarios externos entren sin permiso.

### 🔧 Lo que configuramos:

* Permitimos acceso desde una IP concreta: `192.168.0.155` *(es la IP del PC físico real desde el que se quiere acceder a Sophos; si se usa otro PC, esta IP debe cambiarse según el equipo que se utilice)*
* Habilitamos HTTPS, SSH y el portal VPN para esa IP

---

## ⚖️ Reglas de Firewall

### 📍 ¿Qué es?

Son instrucciones que controlan qué tráfico puede pasar entre diferentes zonas de red.

### 📊 ¿Para qué sirve?

* Para dejar navegar a los clientes.
* Para permitir el uso de servidores internos.
* Para aceptar conexiones externas específicas (como VPN).

### 🔧 Reglas creadas:

* LAN a WAN: DNS, HTTP, HTTPS permitidos
* LAN a Apache: HTTP y HTTPS permitidos
* WAN a VPN: acceso por el puerto `10443`

Todas las reglas tienen el registro activado para revisar el tráfico si hace falta.

---

## 🔄 NAT (Traducción de IPs)

### 📍 ¿Qué es?

NAT sirve para que los servicios de la red interna se vean desde fuera, o para ocultar las IPs de los clientes al salir a internet.

### 📊 ¿Para qué sirve?

* Para publicar un servidor web (como Apache) en internet.
* Para que los clientes usen una única IP al salir a internet.

### 🔧 Lo que configuramos:

* DNAT: redirige peticiones al puerto `8081` hacia Apache interno
* SNAT (MASQ): enmascara todas las IPs internas al salir a través del firewall

---

## 🏡 VPN SSL con OpenVPN

### 📍 ¿Qué es?

Una VPN crea una conexión segura desde fuera hacia la red interna, como si estuvieras dentro de la red local.

### 📊 ¿Para qué sirve?

* Para trabajar o hacer pruebas desde casa conectándote como si estuvieras en el centro o la empresa.
* Para acceder al DNS o servidor web de forma segura.

### 🔧 Lo que configuramos:

* VPN con red: `10.81.0.0/16`
* Red interna accesible: `192.168.6.0/24`
* Puerto: `10443`
* Cliente usado: OpenVPN
* DNS usado desde VPN: `192.168.6.6`

---

## ✨ Acceso Remoto con Ngrok

### 📍 ¿Qué es?

Ngrok permite acceder a un servidor interno sin tener que abrir puertos, creando un túnel desde internet.

### 📊 ¿Para qué sirve?

* Para mostrar tu web o proyecto desde fuera sin tocar el firewall.
* Ideal para hacer presentaciones o pruebas rápidas.

### 🔧 Lo que hicimos:

* Instalamos ngrok en el servidor Apache
* Ejecutamos: `ngrok http 8081`
* Obtenemos una URL pública temporal para acceder a Apache desde fuera

---

## 🧪 Pruebas Realizadas

* Probamos DNS con `ping`, `dig`, `nslookup`
* Conectamos con OpenVPN desde fuera y navegamos en la red interna
* Accedimos al servidor web desde LAN, VPN y con ngrok
* Verificamos que las reglas NAT y firewall funcionaban correctamente

---

## ✅ Resumen Final

* Se configuró correctamente el firewall Sophos con acceso seguro y controlado
* Toda la red funciona con direcciones bien definidas y protegidas
* Se permite acceso externo por VPN o túneles con ngrok, según convenga
* Esta configuración es ideal para prácticas de clase, simulaciones de empresa o montar una red segura en casa

---

> Documentación práctica redactada con un lenguaje accesible para estudiantes de informática o técnicos en formación.
