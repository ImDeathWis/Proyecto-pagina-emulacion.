[VOLVER ATRÁS](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/README.md)

# Guía de Configuración de Sophos para Redes Locales

## 🔍 Introducción

Este documento recoge toda la configuración básica de un firewall Sophos, pensada para crear una red local segura, ordenada y accesible también desde fuera. Explicamos cómo se organizan las IPs, cómo proteger la red con reglas, y cómo permitir el acceso remoto por VPN o ngrok.

---

## 🌐 Red y Direccionamiento IP

* Interfaz LAN: `192.168.6.1/24`  
  <img src="https://github.com/user-attachments/assets/fbeb8944-2677-4320-b30e-6a7cef0eb255" width="600">  

* Interfaz WAN: `192.168.0.185`  
  <img src="https://github.com/user-attachments/assets/437f4c31-9e93-431a-9873-4c2dbfd813c7" width="600">  

* DNS local: `192.168.6.6`  
  <img src="https://github.com/user-attachments/assets/3b2b4958-7df5-433f-83c6-d4aed74de6bc" width="600">  

* Reservas DHCP  
  <img src="https://github.com/user-attachments/assets/212208bc-c333-4edd-8b71-11d297e4ed60" width="600">

---

## 🔒 ACL y Acceso al Panel de Sophos

<img src="https://github.com/user-attachments/assets/21e132e0-1908-4d72-9710-e9232313b19b" width="600">

---

## ⚖️ Reglas de Firewall

<img src="https://github.com/user-attachments/assets/da1f5043-3d71-4a68-b47a-6b7eab19323c" width="600">
<img src="https://github.com/user-attachments/assets/7840d184-9666-4b8c-b469-a400f4b79fb5" width="600">

---

## 🔄 NAT (Traducción de IPs)

---

## 🏡 VPN SSL con OpenVPN

<img src="https://github.com/user-attachments/assets/fe452bc7-d084-4a3f-9922-7081ce951b97" width="600">
<img src="https://github.com/user-attachments/assets/0c9e1e54-d1f0-4550-a25a-90a0fe468a73" width="600">
<img src="https://github.com/user-attachments/assets/40d6d63f-c4f1-4c60-9a47-970de8a486fa" width="600">
<img src="https://github.com/user-attachments/assets/c4750982-c602-420d-8dcf-4a8982dc633f" width="600">
<img src="https://github.com/user-attachments/assets/b0d7d48c-0eb4-42e7-a1ef-b3fbcd05443c" width="600">

---

## ✨ Acceso Remoto con Ngrok

<img src="https://github.com/user-attachments/assets/a19f5d68-7b17-484f-9bf6-f2f9d355194e" width="600">
<img src="https://github.com/user-attachments/assets/7eba39e4-15a0-411d-95dd-9f3fd765d97c" width="600">
<img src="https://github.com/user-attachments/assets/e878061b-f0e9-4c3e-af8c-649fbda02c1b" width="600">
<img src="https://github.com/user-attachments/assets/05811cd3-c2b5-4532-9a6c-71bd84eb8a49" width="600">

---

## 🧪 Pruebas Realizadas

- Probamos DNS con `ping`, `dig`, `nslookup`
- Conectamos con OpenVPN desde fuera y navegamos en la red interna
- Accedimos al servidor web desde LAN, VPN y con ngrok
- Verificamos que las reglas NAT y firewall funcionaban correctamente

---

## ✅ Resumen Final

* Se configuró correctamente el firewall Sophos con acceso seguro y controlado
* Toda la red funciona con direcciones bien definidas y protegidas
* Se permite acceso externo por VPN o túneles con ngrok, según convenga
* Esta configuración es ideal para prácticas de clase, simulaciones de empresa o montar una red segura en casa

---
