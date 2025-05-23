[VOLVER ATRÁS](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/README.md)

# Guía de Configuración de Sophos para Redes Locales

## 🔍 Introducción

Este documento recoge toda la configuración básica de un firewall Sophos, pensada para crear una red local segura, ordenada y accesible también desde fuera. Explicamos cómo se organizan las IPs, cómo proteger la red con reglas, y cómo permitir el acceso remoto por VPN o ngrok. Está escrita con un lenguaje claro para que cualquier persona con conocimientos básicos de redes lo entienda.

---

## 🌐 Red y Direccionamiento IP

![Diagrama de SOPHOS y  VPN (con NGROK)](https://github.com/user-attachments/assets/334c944b-c593-4e6c-af04-53a351befa11)


### 📍 ¿Qué es?
Es la parte donde asignamos direcciones IP a los dispositivos. Se usa una IP para la red interna (LAN) y otra para salir a internet (WAN).

### 📊 ¿Para qué sirve?
* Para que todos los equipos de la red se comuniquen correctamente.
* Para que el firewall y los servidores tengan IPs fijas.
* Para que el servidor DHCP reparta IPs automáticas sin conflictos.

### 🔧 Lo que configuramos:
* Interfaz LAN: `192.168.6.1/24`  
  <img src="https://github.com/user-attachments/assets/fbeb8944-2677-4320-b30e-6a7cef0eb255" width="600">  
* Interfaz WAN: `192.168.0.185`  
  <img src="https://github.com/user-attachments/assets/437f4c31-9e93-431a-9873-4c2dbfd813c7" width="600">  
* DNS local: `192.168.6.6`  
  <img src="https://github.com/user-attachments/assets/3b2b4958-7df5-433f-83c6-d4aed74de6bc" width="600">  
* Rango DHCP: `192.168.6.100 - 192.168.6.200`
* Reservas: DNS, Apache y TrueNAS con IP fija  
  <img src="https://github.com/user-attachments/assets/212208bc-c333-4edd-8b71-11d297e4ed60" width="600">

---

## 🔒 ACL y Acceso al Panel de Sophos

### 📍 ¿Qué es?
Una ACL es una regla que limita quién puede entrar al panel de administración de Sophos.

### 📊 ¿Para qué sirve?
* Para que sólo ciertas IPs puedan acceder a la configuración.
* Para evitar que usuarios externos entren sin permiso.

### 🔧 Lo que configuramos:

<img src="https://github.com/user-attachments/assets/21e132e0-1908-4d72-9710-e9232313b19b" width="600"> 

* Permitimos acceso desde una IP concreta: `192.168.0.155`
* Habilitamos HTTPS, SSH y el portal VPN para esa IP

---

## ⚖️ Reglas de Firewall

### 📍 ¿Qué es?
Son instrucciones que controlan qué tráfico puede pasar entre diferentes zonas de red.

### 📊 ¿Para qué sirve?
* Para dejar navegar a los clientes.
* Para permitir el uso de servidores internos.
* Para aceptar conexiones externas específicas (como VPN).

<img src="https://github.com/user-attachments/assets/da1f5043-3d71-4a68-b47a-6b7eab19323c" width="600">  
<img src="https://github.com/user-attachments/assets/7840d184-9666-4b8c-b469-a400f4b79fb5" width="600">

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
<img src="https://github.com/user-attachments/assets/fe452bc7-d084-4a3f-9922-7081ce951b97" width="600">
<img src="https://github.com/user-attachments/assets/0c9e1e54-d1f0-4550-a25a-90a0fe468a73" width="600">
<img src="https://github.com/user-attachments/assets/40d6d63f-c4f1-4c60-9a47-970de8a486fa" width="600">
<img src="https://github.com/user-attachments/assets/c4750982-c602-420d-8dcf-4a8982dc633f" width="600">
<img src="https://github.com/user-attachments/assets/b0d7d48c-0eb4-42e7-a1ef-b3fbcd05443c" width="600">

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

<img src="https://github.com/user-attachments/assets/a19f5d68-7b17-484f-9bf6-f2f9d355194e" width="600">
<img src="https://github.com/user-attachments/assets/7eba39e4-15a0-411d-95dd-9f3fd765d97c" width="600">
<img src="https://github.com/user-attachments/assets/e878061b-f0e9-4c3e-af8c-649fbda02c1b" width="600">
<img src="https://github.com/user-attachments/assets/05811cd3-c2b5-4532-9a6c-71bd84eb8a49" width="300">

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
