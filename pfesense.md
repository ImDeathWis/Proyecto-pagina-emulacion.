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
   - **LAN**: Configurar manualmente con la IP **10.20.30.1/24**.
     Para configuarar deberiamos seguir los pasos siguentes:
         ![immagen5 configuración de la interface de red](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/imagenes/image5.png)
       1. escribir 2, para configurar la interfase.
       2. Luego nos aparecera para selecionar que interface configurar en nuestro caso la LAN escribiremos 2 y luego enter.
       3. Después nos preguntara si queremos que pfesense se encarge de configurarlo y le responderemos **n** que es no lo configure y nosotros lo configuremos.
       4. Después ecribiremos nuestra IP (la que nosotros queramos) en mi caso yo quiro la **10.20.30.12** luego le dariamos enter.
       5. Luego nos pedirá que selecionemos la mascara y escribiremos 24 (255.255.255.0)que es la mía y le daré enter.
       6. Seguidamente daremos enter y no, hasta llegar a la configuracion de DHCP y le daremos **y** para que poder darle un rango en mi caso 10.20.30.100 a la 10.20.30.120, después le daniamos a enter.
       7. 
    
9. **Deshabilitar el servidor DHCP** si se usará otro servidor.

---

## **4. Configuración del Cliente**
1. Crear una nueva VM Cliente con:
   - 2 GB RAM, 1 CPU.
   - Conectada a la `RedInterna` en VirtualBox.
2. Asignar IP manualmente:
   - **IP:** 10.20.30.2
   - **Máscara:** 255.255.255.0
   - **Puerta de enlace:** 10.20.30.1 (pfSense).
   - **DNS:** 8.8.8.8 o 1.1.1.1.

---

## **5. Acceder a la Interfaz Web de pfSense**
1. En el Cliente, abrir un navegador e ingresar:
   ```
   http://10.20.30.1
   ```
2. Usuario: `admin`
3. Contraseña: `pfsense`
4. Seguir el asistente para terminar la configuración.

---

Con esto, pfSense estará funcionando como firewall en la red **10.20.30.0/24** y el cliente podrá conectarse y navegar.
