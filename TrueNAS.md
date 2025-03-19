
# Guía de Instalación y Configuración de TrueNAS con RAID 5 y Servidor FTP

## 1. Instalación de TrueNAS
### Requisitos previos:
- Un equipo con al menos 4GB de RAM (recomendado 8GB para ZFS).
- 3 o más discos duros para configurar RAID 5.
- Unidad USB con TrueNAS descargado desde [truenas.com](https://www.truenas.com/).

### Pasos de instalación:
1. **Crear un USB booteable** con Rufus o Balena Etcher.
2. **Arrancar desde el USB** y seleccionar "Install/Upgrade TrueNAS".
3. **Seleccionar el disco de instalación** (usar un disco diferente a los del RAID).
4. **Configurar red** (puede ser DHCP o IP estática en la red 10.20.30.x).
5. **Finalizar la instalación y reiniciar**.
6. **Acceder a la interfaz web** desde un navegador: `http://10.20.30.X` (reemplazar X con la IP asignada).

---

## 2. Configuración de RAID 5 en TrueNAS
### Creación del pool de almacenamiento:
1. Ir a `Storage` > `Pools` > `Add`.
2. Seleccionar `Create New Pool`.
3. Elegir los discos que formarán el RAID 5.
4. Seleccionar `RAIDZ1` (equivalente a RAID 5 en ZFS).
5. Asignar un nombre y confirmar la creación.

---

## 3. Configuración del Servidor FTP en TrueNAS
### Habilitar FTP:
1. Ir a `Services` > Habilitar `FTP`.
2. Configurar la ruta del directorio FTP en `Storage` > `Datasets`.
3. Crear usuarios para acceso FTP en `Accounts` > `Users`.
4. Asignar permisos adecuados a las carpetas compartidas.
5. Aplicar cambios y probar la conexión con un cliente FTP.

---

## 4. Configuración de Copias de Seguridad de LAMP a TrueNAS (FTP + rsync)
### En el Servidor LAMP:
1. Instalar `rsync` si no está disponible:
   ```bash
   sudo apt update && sudo apt install rsync -y
   ```
2. Crear un script para sincronizar datos con TrueNAS:
   ```bash
   #!/bin/bash
   rsync -avz /var/www/ usuario@10.20.30.X:/mnt/pool/backup_lamp
   ```
3. Asignar permisos y hacer ejecutable el script:
   ```bash
   chmod +x /ruta/del/script.sh
   ```
4. Programar la ejecución con cron:
   ```bash
   crontab -e
   ```
   Agregar la siguiente línea para ejecutar el script cada noche a las 2 AM:
   ```bash
   0 2 * * * /ruta/del/script.sh
   ```

---

## 5. Restauración de Datos desde TrueNAS a LAMP
1. En LAMP, configurar un script para descargar los datos desde TrueNAS:
   ```bash
   #!/bin/bash
   rsync -avz usuario@10.20.30.X:/mnt/pool/backup_lamp /var/www/
   ```
2. Programar la ejecución con cron si es necesario.

---

## 6. Pruebas y Verificación
- Probar la conexión FTP desde LAMP con:
  ```bash
  ftp 10.20.30.X
  ```
- Verificar que `rsync` transfiera correctamente los archivos.
- Revisar logs en TrueNAS (`/var/log/messages`) y LAMP (`/var/log/syslog`).

Con esto, tendrás un TrueNAS con RAID 5 y copias de seguridad automatizadas para tu servidor LAMP. 🚀
