# Guía para Configuración de Apache y RetroArch Web en Ubuntu Server

## 1. Crear y Configurar la Máquina Virtual en VirtualBox 🚀

Primero, en **VirtualBox**, crea una nueva máquina virtual:

- Nombre: `ServidorApache`
- Tipo: **Ubuntu (64-bit)**

Asigna lo siguiente:

- **3 procesadores**
- **4 GB de RAM**
- **Disco de 25 GB**

Configura la red:

- En **Adaptador 1**, selecciona `Red NAT` 🌐 con la red **192.168.6.0/24**.

---

## 2. Instalar Ubuntu en la Máquina Virtual 🖥️

Arranca la máquina con la ISO de **Ubuntu Server** y sigue la instalación:

- Configura un usuario, una contraseña y el idioma.
- Una vez finalizada la instalación, inicia sesión con el usuario creado.

---

## 3. Configurar la Red en Ubuntu 🌍

Como tu red **NatNetworkSMX2** está configurada con **DHCP** y la **máquina con DHCP tiene la IP 192.168.6.14**, asigna una **IP estática** para la máquina con Apache:

1. Edita el archivo de configuración de red:

    ```bash
    sudo nano /etc/netplan/00-installer-config.yaml
    ```

2. Ajusta la configuración de red como sigue:

    ```yaml
    network:
      version: 2
      renderer: networkd
      ethernets:
        enp0s3:
          dhcp4: no
          addresses:
            - 192.168.6.21/24
          gateway4: 192.168.6.1
          nameservers:
            addresses:
              - 192.168.6.10
    ```

3. Guarda con `Ctrl + O`, luego sal con `Ctrl + X`.

4. Aplica la configuración:

    ```bash
    sudo netplan apply
    ```

5. Comprueba si la IP está configurada correctamente:

    ```bash
    ip a
    ```

---

## 4. Instalar el Servidor Apache 🌐

Ahora instala **Apache**:

1. Actualiza los paquetes y realiza la instalación:

    ```bash
    sudo apt update && sudo apt upgrade -y
    sudo apt install apache2 -y
    ```

2. Verifica que Apache esté funcionando:

    ```bash
    sudo systemctl status apache2
    ```

   Si aparece como "active (running)" 👍, todo está bien.

3. Permite el tráfico HTTP en el firewall:

    ```bash
    sudo ufw allow 80/tcp
    sudo ufw reload
    ```

4. Abre un navegador y entra a la dirección:

    ```
    http://192.168.6.21
    ```

   Si ves la página de **Apache**, ¡la instalación fue exitosa! 🎉

---

## 5. Instalar RetroArch Web 🎮 (POR AHORA NO LO INSTALARE HASTA QUE ALINA DE EL VISTO BUENO)

Instala las dependencias necesarias para compilar **RetroArch Web**:

1. Instala las dependencias:

    ```bash
    sudo apt install build-essential cmake git libSDL2-dev libasound2-dev emscripten -y
    ```

2. Descarga **RetroArch Web** en el directorio web:

    ```bash
    cd /var/www/html
    sudo git clone --recursive https://github.com/libretro/RetroArch.git retroarch
    cd retroarch
    ```

3. Compila **RetroArch para WebAssembly**:

    ```bash
    emconfigure ./configure --disable-video-opengl --enable-web
    emmake make
    ```

4. Después de compilar, el archivo `.html` generado será la versión web de RetroArch. 🚀

---

## 6. Configurar Apache para RetroArch ⚙️

Para que **Apache** sirva correctamente **RetroArch**, crea un nuevo **VirtualHost**:

1. Crea y edita el archivo de configuración del sitio:

    ```bash
    sudo nano /etc/apache2/sites-available/retroarch.conf
    ```

2. Añade la siguiente configuración:

    ```apache
    <VirtualHost *:80>
        DocumentRoot /var/www/html/retroarch
        ServerName retroarch.local
        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
    </VirtualHost>
    ```

3. Guarda el archivo y habilita el sitio:

    ```bash
    sudo a2ensite retroarch.conf
    sudo systemctl reload apache2
    ```

4. Abre un navegador y accede a:

    ```
    http://192.168.6.15
    ```

   Si ves **RetroArch Web** funcionando, ¡ya está todo listo! 🖥️🎮

---

## 7. Personalizar la Interfaz de RetroArch ✨

Si quieres personalizar la apariencia de **RetroArch**, edita los archivos **CSS** en:

```bash
/var/www/html/retroarch/assets/

