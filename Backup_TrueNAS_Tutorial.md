[VOLVER ATRÁS](https://github.com/ImDeathWis/Proyecto-pagina-emulacion./blob/main/README.md)

# Backup automatizado con TrueNAS, Apache y BIND9

## 📌 Introducción

**TrueNAS** es un sistema operativo basado en FreeBSD especializado en almacenamiento en red (NAS). Permite crear servidores de archivos, realizar backups, compartir datos por SMB, NFS, FTP, rsync, entre otros, y es ampliamente usado tanto en entornos domésticos como empresariales.

En este tutorial aprenderás a configurar **TrueNAS** para que actúe como servidor de copias de seguridad para un entorno con:
- Un servidor **Apache** (web + ROMs).
- Un servidor **DNS (BIND9)**.

Ambos servidores enviarán sus copias automáticamente a TrueNAS usando **rsync** y generarán logs, manteniendo una rotación automática de los registros (borrado tras 7 días).

---

## 🧱 Infraestructura

| Elemento        | IP              | Descripción                          |
|-----------------|------------------|--------------------------------------|
| TrueNAS         | 192.168.6.102     | Receptor de backups vía rsync        |
| Servidor Apache | 192.168.6.101    | Web con emuladores y ROMs            |
| Servidor DNS    | 192.168.6.100    | Servidor BIND9 con zonas DNS         |
| Sophos UTM      | 192.168.6.1      | Firewall y servidor DHCP             |

---

## 🧰 Configuración en TrueNAS

### 1. Crear Pool y Datasets

- Ve a **Storage > Pools > Add** y crea un pool llamado `POOLBACKUP`.
- Dentro del pool, crea dos datasets:
  - `apache_data`
  - `dns_data`
![image](https://github.com/user-attachments/assets/6c4522bc-1ffd-4674-b9c2-5260bbfa7729)

### 2. Crear Usuarios

- Ve a **Accounts > Users > Add**
- Crea:
  - `apacheuser` → home: `/mnt/POOLBACKUP/apache_data`
  - `dnsuser` → home: `/mnt/POOLBACKUP/dns_data`

### 3. Configurar Servicio rsync

- Ve a **Services > Rsync** y actívalo.
- En **Services > Rsync Modules > Add** crea dos módulos:

#### Módulo Apache:
- Name: `apachebackup`
- Path: `/mnt/POOLBACKUP/apache_data`
- Hosts Allow: `192.168.6.101`
- User: `apacheuser`
![image](https://github.com/user-attachments/assets/61e55ab0-6b5b-42e6-9280-f7ebb844f6b5)

#### Módulo DNS:
- Name: `dnsbackup`
- Path: `/mnt/POOLBACKUP/dns_data`
- Hosts Allow: `192.168.6.100`
- User: `dnsuser`
![image](https://github.com/user-attachments/assets/a90acc4f-663f-4547-82a4-e9f7f444bbd6)

---

## 🖥️ Configuración en Servidores

### 🔹 Común a ambos (Apache y DNS)

```bash
sudo apt update
sudo apt install rsync
```

Crear archivo de contraseña:
```bash
echo "segura" | sudo tee /etc/rsyncd.pass
sudo chmod 600 /etc/rsyncd.pass
```

Crear directorio de logs:
```bash
sudo mkdir -p /var/log/rsync_backups
```

---

### 🔸 Script en el servidor Apache (`192.168.6.101`)

Ruta: `/usr/local/bin/backup_apache.sh`

```bash
#!/bin/bash

DESTINO="apacheuser@192.168.6.102::apachebackup"
ORIGEN="/var/www/"
PASSFILE="/etc/rsyncd.pass"
LOGDIR="/var/log/rsync_backups"
FECHA=$(date '+%Y-%m-%d_%H-%M-%S')
LOGFILE="$LOGDIR/backup_apache_$FECHA.log"

mkdir -p "$LOGDIR"

echo "[INFO] Iniciando backup de Apache a las $(date)" > "$LOGFILE"
rsync -avz --delete "$ORIGEN" "$DESTINO" --password-file="$PASSFILE" >> "$LOGFILE" 2>&1
echo "[INFO] Backup de Apache finalizado a las $(date)" >> "$LOGFILE"

# Eliminar logs antiguos
find "$LOGDIR" -type f -name "*.log" -mtime +7 -delete
```

Hacerlo ejecutable:
```bash
sudo chmod +x /usr/local/bin/backup_apache.sh
```

### Cron:
```bash
sudo crontab -e
0 2 * * * /usr/local/bin/backup_apache.sh
```

---

### 🔸 Script en el servidor DNS (`192.168.6.100`)

Ruta: `/usr/local/bin/backup_dns.sh`

```bash
#!/bin/bash

DESTINO="dnsuser@192.168.6.10::dnsbackup"
ORIGEN="/etc/bind/"
PASSFILE="/etc/rsyncd.pass"
LOGDIR="/var/log/rsync_backups"
FECHA=$(date '+%Y-%m-%d_%H-%M-%S')
LOGFILE="$LOGDIR/backup_dns_$FECHA.log"

mkdir -p "$LOGDIR"

echo "[INFO] Iniciando backup de DNS a las $(date)" > "$LOGFILE"
rsync -avz --delete "$ORIGEN" "$DESTINO" --password-file="$PASSFILE" >> "$LOGFILE" 2>&1
echo "[INFO] Backup de DNS finalizado a las $(date)" >> "$LOGFILE"

# Eliminar logs antiguos
find "$LOGDIR" -type f -name "*.log" -mtime +7 -delete
```

Hacerlo ejecutable:
```bash
sudo chmod +x /usr/local/bin/backup_dns.sh
```

### Cron:
```bash
sudo crontab -e
30 2 * * * /usr/local/bin/backup_dns.sh
```

---

## 🧪 Verificar funcionamiento

- Ejecuta manualmente:  
  `sudo /usr/local/bin/backup_apache.sh`
- Verifica logs en:  
  `/var/log/rsync_backups/`

---

## ✅ Resultado

- Copias automáticas en datasets organizados.
- Logs de cada ejecución.
- Limpieza automática de logs antiguos.
- Y todo estara a salvo y bien guardado
