# Instalación y Configuración de pfSense en VirtualBox 

<a href="https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/README.md" target="_blank">Haz clic aquí Para Volver a la Página Original</a>

## **1. Requisitos previos**
- **Máquina virtual con pfSense** (3072MB RAM, 2 núcleos, 16 GB de almacenamiento).
- **Máquina virtual Cliente** (Windows o Linux con una interfaz de red conectada al pfSense).
- **Imagen ISO de pfSense** (descargada desde [https://www.pfsense.org/download/](https://www.pfsense.org/download/)).

---

## **2. Creación de la Máquina Virtual para pfSense**
1. **Abrir VirtualBox** y crear una nueva VM.
2. **Asignar nombre**: `pfSense-Firewall`.
3. **Sistema operativo**: BSD → Versión: FreeBSD (64-bit).
4. **Controlador de almacenamiento**: Añadir la ISO de pfSense.
5. **Tarjetas de red**:
   - **Adaptador 1**: Modo Adaptador Puente (para acceso a internet).
   - **Adaptador 2**: Red Interna → Nombre: `RedInterna`.
     ![imagen8 ael adaptador de red en VBox](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/imagenes/imagen8.png)
     ![imagen 9 de como debe estar quitado el dhcp](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/imagenes/imagen9.png)

---

## **3. Instalación de pfSense**
1. Iniciar la VM y arrancar desde la ISO.
2. Seleccionar `Install pfSense`.
4. **Particionado**: Usar `Auto (UFS)`.
5. **Esperar a que se instale y reiniciar**.
6. Luego **apagamos la MV** para despues **quitarle la ISO**.
7. Luego Procederiamos a iniciarlo y esta vez nos mostraia que ya esta instalado.
8. En la consola, configuramos las interfaces:
   - **WAN** (reconoce automáticamente el adaptador NAT).
   - **LAN**: Configurar manualmente con la IP **10.20.30.12/24**.
     Para configuarar deberiamos seguir los pasos siguentes:
         ![immagen5 configuración de la interface de red](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/imagenes/image5.png)
       1. escribir 2, para configurar la interfase.
       2. Luego nos aparecera para selecionar que interface configurar en nuestro caso la LAN escribiremos 2 y luego enter.
       3. Después nos preguntara si queremos que pfesense se encarge de configurarlo y le responderemos **n** que es no lo configure y nosotros lo configuremos.
       4. Después ecribiremos nuestra IP (la que nosotros queramos) en mi caso yo quiro la **10.20.30.12** luego le dariamos enter.
       5. Luego nos pedirá que selecionemos la mascara y escribiremos 24 (255.255.255.0)que es la mía y le daré enter.
       6. Seguidamente daremos enter y no, hasta llegar a la configuracion de DHCP y le daremos **y** para que poder darle un rango en mi caso 10.20.30.100 a la 10.20.30.120, después le daniamos a enter.
       7. luego le damos a **n**  y enter.
       8. Y ya lo tendriamos hecho
    
9. **Deshabilitar el servidor DHCP** si se usará otro servidor, en el VitrualBox en la configuracion de solo-anfitrión desactivando el DHCP y leugo lo aplicamos.

---

## **4. Configuración del Cliente**
1. Crear una nueva VM Cliente con:
   - 2047MB RAM, 4 CPU.
   - Conectada a la `RedInterna` en VirtualBox, practimante tienen que estar lod 2 el cliente y el pfesense en la misma red interna para que nos de la ip que buscamos (la IP que estará dentro del rango de IP que le asignamos al Pfesense, **dentro del 10.20.30.100-10.20.30.120).
2. Revisar y ajustar si es necesario IP del Cliente:
   - **IP:** no dará una el fpsense y en mi caso me salio la 10.20.30.100
   - **Máscara:** 255.255.255.0
   - **Puerta de enlace:** 10.20.30.1 (pfSense).
   - **DNS:** no lo tendrá asignado y probablemente s no cargué el internet del cliente asi que, en la interface grafica añadiremos el DNS 8.8.8.8 (google que no permitira acceder a internet).

---

## **5. Acceder a la Interfaz Web de pfSense**
1. En el Cliente, abrir un navegador e ingresar:
   ```
   http://10.20.30.12
   ```
2. Usuario: `admin`
3. Contraseña: `pfsense`
4. Seguir el asistente para terminar la configuración.
5. Pfesense nos dará simpre el aviso que cabiemos la contraceña as si que deberemos asignerle una nosotros.
6. despues nos perdirá que cambiemos y haremos estos cambios:
   1. ![cambiospfsense](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/imagenes/imagen6.png)
7. Después de hacer todo eso tendremos estas vistas dentro de pfsense.
   1. ![imagen7 forma visual de pfsense](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/imagenes/imagen7.png)
8. Configuración de Firewall en pfSense

   1. 📌 Permitir tráfico en la LAN
      1. Ir a `Firewall` → `Rules` → `LAN`.
      2. Agregar una nueva regla (**Add 🔼** para colocarla arriba si hay reglas más restrictivas).
      3. Configurar:
         - **Action**: `Pass`
         - **Interface**: `LAN`
         - **Protocol**: `Any`
         - **Source**:
           - **Type**: `Network`
           - **Network**: `LAN subnet`
         - **Destination**: `Any`
      4. Guardar y aplicar cambios.

   2. 📌 Habilitar NAT para acceso a Internet
      1. Ir a `Firewall` → `NAT` → `Outbound`.
      2. Cambiar a **modo Manual**.
      3. Agregar una nueva regla (**Add 🔽** si no hay reglas conflictivas arriba).
      4. Configurar:
         - **Interface**: `WAN`
         - **Source**:
           - **Type**: `Network`
           - **Network**: `10.20.30.0/24`
         - **Translation**: `Interface Address`
      5. Guardar y aplicar cambios.
# Configuración de OpenVPN y Port Forwarding en pfSense

## 1. Configuración de OpenVPN en pfSense

### Paso 1: Crear la Autoridad Certificadora (CA)
1. Ve a `System` > `Cert. Manager` > `CAs`.
2. Haz clic en **Add** y completa los campos necesarios para crear una nueva CA.

### Paso 2: Crear el Certificado del Servidor
1. En `System` > `Cert. Manager` > `Certificates`, haz clic en **Add**.
2. Selecciona la CA creada previamente y configura el certificado como **Server Certificate**.

### Paso 3: Configurar el Servidor OpenVPN
1. Ve a `VPN` > `OpenVPN` > `Wizards` y sigue el asistente:
   - Selecciona la CA y el certificado del servidor creados.
   - Configura el puerto 5194 (por defecto, `1194`) y el protocolo (`UDP` recomendado).
   - Especifica la red local que los clientes VPN deben acceder.

### Paso 4: Configurar las Reglas de Firewall
1. Ve a `Firewall` > `Rules` > `WAN`.
2. Crea una regla para permitir el tráfico entrante al puerto OpenVPN:
   - **Action**: `Pass`
   - **Protocol**: `UDP`
   - **Destination Port Range**: `1194`
3. Ve a `Firewall` > `Rules` > `OpenVPN`.
4. Crea una regla para permitir el tráfico desde clientes VPN a la red local:
   - **Action**: `Pass`
   - **Source**: `Network` (especifica la red de túnel VPN)
   - **Destination**: `Any`

### Paso 5: Exportar Configuración para Clientes
1. Instala el paquete `openvpn-client-export` desde `System` > `Package Manager`.
2. Ve a `VPN` > `OpenVPN` > `Client Export`.
3. Descarga el archivo de configuración adecuado para tus clientes.

---

## 2. Configuración de Port Forwarding para Acceder al Servidor Apache

### Paso 1: Configurar NAT (Port Forwarding)
1. Ve a `Firewall` > `NAT` > `Port Forward` y haz clic en **Add**.
2. Configura los siguientes parámetros:
   - **Interface**: `WAN`
   - **Protocol**: `TCP`
   - **Destination**: `WAN Address`
   - **Destination Port Range**: `80` (HTTP) o `443` (HTTPS)
   - **Redirect Target IP**: `IP interna del servidor Apache`
   - **Redirect Target Port**: `80` o `443`
3. Guarda y aplica los cambios.

### Paso 2: Verificar Reglas de Firewall
pfSense suele crear automáticamente una regla de firewall asociada al configurar el port forwarding. Verifica que esta regla permita el tráfico adecuado.

---

## 3. Gestión de Certificados para HTTPS en el Servidor Apache

Para asegurar las conexiones al servidor Apache mediante HTTPS, es necesario instalar un certificado SSL válido.

### Generar Certificados en pfSense
1. Instala el paquete `acme` desde `System` > `Package Manager`.
2. Ve a `Services` > `Acme Certificates` y agrega una nueva cuenta de Let's Encrypt.
3. Configura un trabajo de renovación automática para obtener y renovar certificados.


---

## 4. Acceder desde un Teléfono
- Si estás en la red local, usa la **IP interna** del servidor (`172.16.10.1`).
- Si estás fuera de la red, usa la **IP pública** o un **dominio** con DNS configurado.
- Si configuraste HTTPS, accede con `https://tudominio.com`.

---

Este documento proporciona una guía básica para configurar **OpenVPN, port forwarding y certificados SSL en pfSense**. Puedes ampliarlo o modificarlo según las necesidades de tu proyecto. 🚀
---

💡 **Notas:**
- Si tienes reglas restrictivas en el firewall, usa **Add 🔼** para que la nueva regla tenga prioridad.
- Si solo estás agregando reglas generales, usa **Add 🔽** para mantener el orden.
- La red **RedInterna** debe ser la misma en pfSense y el Cliente.

---

Con esto, pfSense estará funcionando como firewall en la red **10.20.30.0/24** y el cliente podrá conectarse y navegar.
