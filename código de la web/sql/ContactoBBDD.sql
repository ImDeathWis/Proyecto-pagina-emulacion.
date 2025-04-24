CREATE DATABASE contacto_web;   /*crea una base de dato dentro de contacto_web*/

USE contacto_web;

CREATE TABLE mensaje (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    email VARCHAR(100),
    mensaje TEXT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP /*fecha y hora de ahora*/
);
