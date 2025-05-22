<?php
session_start();
if (!isset($_SESSION['moder_correo'])) {
    header("Location: loginModer.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Moderador</title>
  <style>
    .btn { margin: 0 5px; cursor: pointer; }
    .clave { font-weight: bold; color: green; margin-top: 5px; }
  </style>
</head>
<body>
  <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['moder_nombre']); ?></h2>
  <p><a href="logout.php">Cerrar sesión</a></p>

  <h3>Solicitudes:</h3>
  <table border="1" cellpadding="5">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Teléfono</th>
        <th>Fecha</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody id="tablaSolicitudes">
      <tr><td colspan="6">Cargando...</td></tr>
    </tbody>
  </table>

  <script>
    function cargarSolicitudes() {
      fetch("getSolicitudes.php")
        .then(res => res.json())
        .then(data => {
          const tabla = document.getElementById("tablaSolicitudes");
          tabla.innerHTML = "";
          if (data.success && data.data.length > 0) {
            data.data.forEach(s => {
              const fila = document.createElement("tr");
              fila.innerHTML = `
                <td>${s.id}</td>
                <td>${s.nombre}</td>
                <td>${s.correo}</td>
                <td>${s.telefono || '-'}</td>
                <td>${s.fecha}</td>
                <td>
                  <button class="btn" onclick="verInfo(${s.id}, '${s.nombre}', '${s.correo}', '${s.telefono}')">Ver info</button>
                  <button class="btn" onclick="aceptarSolicitud(${s.id}, this)">Aceptar</button>
                  <div id="clave-${s.id}" class="clave" style="display: ${s.clave_generada ? 'block' : 'none'};">
                    ${
                      s.clave_generada
                        ? `
                          Clave:
                          <input type="password" id="input-clave-${s.id}" value="${s.clave_generada}" readonly style="width:120px;">
                          <button onclick="toggleClave(${s.id})">👁️</button>
                          <button onclick="copiarClave(${s.id})">📋</button>
                        `
                        : ""
                    }
                  </div>
                </td>
              `;
              tabla.appendChild(fila);
            });
          } else {
            tabla.innerHTML = "<tr><td colspan='6'>No hay solicitudes.</td></tr>";
          }
        })
        .catch(err => {
          document.getElementById("tablaSolicitudes").innerHTML =
            "<tr><td colspan='6'>Error al cargar datos.</td></tr>";
          console.error(err);
        });
    }

    function verInfo(id, nombre, correo, telefono) {
      alert(`ID: ${id}\nNombre: ${nombre}\nCorreo: ${correo}\nTeléfono: ${telefono}`);
    }

    function aceptarSolicitud(id, btn) {
      fetch('aceptarSolicitud.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id=${id}`
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          // Oculta el botón Aceptar
          btn.style.display = "none";

          // Muestra el botón para generar clave
          const divClave = document.getElementById(`clave-${id}`);
          divClave.style.display = "block";
          divClave.innerHTML = `
            <button onclick="generarClave(${id})">🔐 Generar clave</button>
          `;
        } else {
          alert("Error al aceptar solicitud.");
        }
      });
    }

    function generarClave(id) {
      fetch('generarClave.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id=${id}`
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          const divClave = document.getElementById(`clave-${id}`);
          divClave.innerHTML = `
            Clave:
            <input type="password" id="input-clave-${id}" value="${data.clave}" readonly style="width:120px;">
            <button onclick="toggleClave(${id})">👁️</button>
            <button onclick="copiarClave(${id})">📋</button>
          `;
        } else {
          alert("Error al generar clave.");
        }
      });
    }

    function toggleClave(id) {
      const input = document.getElementById(`input-clave-${id}`);
      input.type = input.type === 'password' ? 'text' : 'password';
    }

    function copiarClave(id) {
      const input = document.getElementById(`input-clave-${id}`);
      input.select();
      document.execCommand('copy');
      alert("✅ Clave copiada al portapapeles.");
    }

    window.onload = cargarSolicitudes;
  </script>
</body>
</html>
