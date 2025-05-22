import tkinter as tk
from tkinter import simpledialog, messagebox
import requests

API_URL_LOGIN = "http://localhost/api/loginAdmin.php"
API_URL_GET = "http://localhost/api/getSolicitudes.php"
API_URL_POST = "http://localhost/api/aceptarSolicitud.php"
API_URL_MAIL = "http://localhost/api/enviarCorreo.php"

class LoginWindow:
    def __init__(self, root):
        self.root = root
        self.root.title("Login Admin")
        self.root.geometry("300x200")

        tk.Label(root, text="Correo:").pack(pady=5)
        self.entry_correo = tk.Entry(root, width=30)
        self.entry_correo.pack()

        tk.Label(root, text="Contraseña:").pack(pady=5)
        self.entry_pass = tk.Entry(root, show="*", width=30)
        self.entry_pass.pack()

        tk.Button(root, text="Iniciar sesión", command=self.login).pack(pady=15)

    def login(self):
        correo = self.entry_correo.get()
        contraseña = self.entry_pass.get()

        if not correo or not contraseña:
            messagebox.showwarning("Campos vacíos", "Introduce correo y contraseña.")
            return

        try:
            response = requests.post(API_URL_LOGIN, json={
                "correo": correo,
                "contraseña": contraseña
            })
            data = response.json()
            if data["success"]:
                self.root.destroy()
                root_panel = tk.Tk()
                AdminApp(root_panel, data["nombre"])
                root_panel.mainloop()
            else:
                messagebox.showerror("Error", data["error"])
        except Exception as e:
            messagebox.showerror("Error de conexión", str(e))

class AdminApp:
    def __init__(self, root, admin_name):
        self.root = root
        self.root.title(f"Gestor de Solicitudes - Bienvenido {admin_name}")
        self.root.geometry("600x450")

        self.lista = tk.Listbox(root, width=80)
        self.lista.pack(pady=20)

        self.btn_actualizar = tk.Button(root, text="Actualizar solicitudes", command=self.cargar_solicitudes)
        self.btn_actualizar.pack()

        self.btn_aceptar = tk.Button(root, text="Aceptar seleccionada", command=self.aceptar_solicitud)
        self.btn_aceptar.pack(pady=5)

        self.btn_enviar = tk.Button(root, text="Enviar clave por correo", command=self.enviar_correo)
        self.btn_enviar.pack(pady=5)

        self.solicitudes = []
        self.cargar_solicitudes()

    def cargar_solicitudes(self):
        self.lista.delete(0, tk.END)
        try:
            response = requests.get(API_URL_GET)
            data = response.json()
            if data["success"]:
                self.solicitudes = data["data"]
                for s in self.solicitudes:
                    texto = f"{s['id']} - {s['nombre']} - {s['correo']} - {s['telefono']} - {s['fecha']}"
                    self.lista.insert(tk.END, texto)
            else:
                messagebox.showerror("Error", "No se pudieron cargar las solicitudes.")
        except Exception as e:
            messagebox.showerror("Error", f"Fallo de conexión: {e}")

    def aceptar_solicitud(self):
        seleccion = self.lista.curselection()
        if not seleccion:
            messagebox.showwarning("Atención", "Selecciona una solicitud.")
            return

        index = seleccion[0]
        solicitud = self.solicitudes[index]

        clave = simpledialog.askstring("Generar Clave", f"Ingrese la clave para {solicitud['nombre']}:")
        if not clave:
            return

        payload = {
            "id": solicitud["id"],
            "clave_generada": clave
        }

        try:
            response = requests.post(API_URL_POST, json=payload)
            result = response.json()
            if result["success"]:
                self.solicitudes[index]["clave_generada"] = clave
                messagebox.showinfo("Listo", "Solicitud aceptada y clave guardada.")
                self.cargar_solicitudes()
            else:
                messagebox.showerror("Error", result["error"])
        except Exception as e:
            messagebox.showerror("Error", f"Fallo al conectar: {e}")

    def enviar_correo(self):
        seleccion = self.lista.curselection()
        if not seleccion:
            messagebox.showwarning("Atención", "Selecciona una solicitud.")
            return

        index = seleccion[0]
        solicitud = self.solicitudes[index]

        if not solicitud.get("clave_generada"):
            messagebox.showwarning("Advertencia", "Primero debes aceptar la solicitud y generar una clave.")
            return

        payload = {
            "correo": solicitud["correo"],
            "nombre": solicitud["nombre"],
            "clave": solicitud["clave_generada"]
        }

        try:
            r = requests.post(API_URL_MAIL, json=payload)
            res = r.json()
            if res["success"]:
                messagebox.showinfo("Correo enviado", "Clave enviada correctamente.")
            else:
                messagebox.showerror("Error", res["error"])
        except Exception as e:
            messagebox.showerror("Error", str(e))

# -------- INICIO --------
if __name__ == "__main__":
    root_login = tk.Tk()
    LoginWindow(root_login)
    root_login.mainloop()
