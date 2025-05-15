# Documentación Completa del Firewall Sophos

## 🔍 Introducción

Este documento reúne toda la configuración realizada en Sophos Firewall para proteger y gestionar la red corporativa *retrogold.com*. Se incluyen configuraciones de interfaces, ACL, reglas de firewall/NAT, VPN, pruebas realizadas y acceso remoto con ngrok. También se incluye un core resumen de cada apartado.

---

## 🌐 Red y Direccionamiento IP

### 📍 ¿Qué es?

La configuración de red define la estructura IP y la asignación de direcciones a los distintos dispositivos de la red. A través del interfaz LAN se distribuye conectividad interna, y mediante el interfaz WAN se accede a internet o redes externas.

### 📊 Para qué lo usamos:

* Establecer comunicación entre dispositivos
* Controlar el rango de IPs y asignar direcciones estáticas a servicios críticos

### Configuración:

* **LAN (PortA)**: `192.168.6.1/24`
* **WAN (PortB)**: `192.168.0.185` (DHCP)

### DHCP:

* **Rango dinámico**: `192.168.6.100 - 192.168.6.200`
* **Reservas**:

  * DNS: `192.168.6.6`
  * Apache: `192.168.6.20`
  * TrueNAS: `192.168.6.30`

### DNS:

* Interno: `192.168.6.6`
* Reenvío: `8.8.8.8`, `9.9.9.9`
* Dominio: `retrogold.com`

### 🎥 Detalles del video:

Video: [Configurar DHCP y balanceo](https://www.youtube.com/watch?v=YBsrHn-g-2w)

* Reservar IPs para dispositivos críticos
* Activar redundancia con gateways en balanceo de carga

### Core:

* Red en `192.168.6.0/24`
* Gateway: `192.168.6.1`
* DNS y servidores bien definidos para estabilidad

---

## 🔒 ACL y Acceso Local

### 📍 ¿Qué es?

Las ACL (Listas de Control de Acceso) determinan qué dispositivos pueden acceder a la administración de Sophos y desde qué zonas (LAN, WAN, VPN, etc).

### 📊 Para qué lo usamos:

* Limitar acceso a la consola desde IPs específicas
* Evitar ataques desde redes no autorizadas

### Configuración:

* Excepción ACL: `regla_ACL_IP_myhome`

  * IP: `192.168.0.155`
  * Zona: WAN
  * Servicios: HTTPS, SSH, SSL VPN, User Portal, Ping

### Core:

* Acceso remoto sólo desde IPs autorizadas
* ACL personalizadas para seguridad reforzada

---

## ⚖️ Reglas de Firewall

### 📍 ¿Qué es?

Son las reglas que definen qué tráfico está permitido entre zonas (LAN, WAN, VPN, etc.), bajo qué condiciones y con qué servicios.

### 📊 Para qué lo usamos:

* Permitir o bloquear accesos
* Controlar puertos y protocolos

### Configuración destacada:

| Nombre                | Zona origen → destino | Servicios        |
| --------------------- | --------------------- | ---------------- |
| LAN\_a\_DNS           | LAN → WAN             | DNS, HTTP, HTTPS |
| LAN\_a\_WebServer     | LAN → Apache          | HTTP, HTTPS      |
| LAN\_a\_Internet      | LAN → WAN             | DNS, HTTP, HTTPS |
| LAN\_a\_LAN           | LAN → LAN             | Todos            |
| Permitir\_LAN\_a\_WAN | LAN → WAN             | Todos            |
| Acceso\_admin\_WAN    | WAN → LAN             | HTTP, HTTPS, VPN |

### 🎥 Detalles del video:

Video: [Reglas de Firewall Sophos](https://www.youtube.com/watch?v=YOcbR1pejXE)

* Orden de reglas: primero las específicas
* Habilitar registro de tráfico para auditoría

### Core:

* Separación de servicios por zonas
* Monitoreo activo en cada regla

---

## 🔄 Reglas NAT

### 📍 ¿Qué es?

Las reglas de traducción (NAT) permiten acceder desde fuera de la red a servicios internos (DNAT), o disfrazar la IP interna al salir a internet (SNAT).

### 📊 Para qué lo usamos:

* Exponer servidores como Apache al exterior
* Permitir navegación saliente desde LAN

### Configuración:

| Regla                  | Tipo | Traducción                |
| ---------------------- | ---- | ------------------------- |
| DNAT\_10443\_VPN       | DNAT | Puerto 10443 a Sophos VPN |
| NAT\_LAN\_a\_WAN       | SNAT | Mascaramiento (MASQ)      |
| DNAT\_SERVIDOR\_APACHE | DNAT | TCP 8081 a Apache         |

### Core:

* NAT controlado evita exponer servicios innecesarios
* NAT de salida con MASQ oculta IPs internas

---

## 🏡 VPN SSL

### 📍 ¿Qué es?

Una VPN SSL permite a usuarios acceder remotamente a la red local mediante un túnel seguro.

### 📊 Para qué lo usamos:

* Acceder desde casa a la red `retrogold.com`
* Conectar a servicios internos como DNS o Apache

### Configuración:

* Nombre: `SSL_VPN_HOME`
* Red VPN: `10.81.0.0/16`
* Red interna permitida: `192.168.6.0/24`
* Split tunnel: activado
* Puerto: `10443`
* DNS interno: `192.168.6.6`

### 🎥 Detalles del video:

Video: [Configurar VPN SSL en Sophos](https://www.youtube.com/watch?v=apZX7oudbwE)

* Asociar grupo a usuarios
* Configurar políticas de acceso
* Habilitar split tunneling para eficiencia

### Core:

* Acceso remoto seguro
* Direccionamiento controlado a red interna

---

## ✨ Acceso remoto con Ngrok

### 📍 ¿Qué es?

Ngrok permite exponer un servicio local (ej. Apache) en internet a través de un túnel temporal y seguro.

### 📊 Para qué lo usamos:

* Probar el acceso a Apache sin abrir puertos
* Acceso rápido desde móviles o fuera de la red

### Pasos:

1. Descargar ngrok
2. Configurar token de autenticación
3. Ejecutar:

```bash
ngrok http 8081
```

4. Usar URL externa generada

### 🎥 Detalles del video:

Video: [Ngrok acceso remoto Apache](https://www.youtube.com/watch?v=jEZMVAeW8-g)

* Ideal para pruebas y demostraciones
* Proteger con autenticación

### Core:

* Túnel seguro para pruebas
* No requiere configuración en el firewall

---

## ✅ Pruebas realizadas

### DNS:

* `dig`, `nslookup`, `ping` desde clientes a `retrogold.com`

### Apache:

* Acceso desde LAN y vía ngrok externo

### VPN:

* Conexión remota funcional
* Navegación a `192.168.6.x` desde fuera

### Seguridad:

* Registro de tráfico y ACL para acceso restringido

---

## 🔄 Core General Final

* Sophos gestiona seguridad, acceso remoto, red interna y VPN
* Integrado con dominio propio `retrogold.com`
* Reglas y servicios bien definidos, separados y monitoreados
* Preparado para entornos de pruebas, oficinas remotas o demostraciones
