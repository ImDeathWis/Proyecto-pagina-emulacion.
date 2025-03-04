# Instalación y Configuración de pfSense en VirtualBox

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

---

💡 **Notas:**
- Si tienes reglas restrictivas en el firewall, usa **Add 🔼** para que la nueva regla tenga prioridad.
- Si solo estás agregando reglas generales, usa **Add 🔽** para mantener el orden.
- La red **RedInterna** debe ser la misma en pfSense y el Cliente.

---

Con esto, pfSense estará funcionando como firewall en la red **10.20.30.0/24** y el cliente podrá conectarse y navegar.
