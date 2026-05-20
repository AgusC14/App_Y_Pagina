-- db/saludconnect.sql

-- 1. CREAR LA BASE DE DATOS
CREATE DATABASE IF NOT EXISTS saludconnect CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE saludconnect;

-- ========================================================
-- 2. TABLA: usuarios (Estructura base para el Login)
-- ========================================================
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    localidad VARCHAR(100) NOT NULL,
    rol ENUM('paciente', 'enfermero', 'administrador') NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ========================================================
-- 3. TABLA: enfermeros_detalles (Relación 1 a 1 con usuarios)
-- ========================================================
CREATE TABLE IF NOT EXISTS enfermeros_detalles (
    id_enfermero INT PRIMARY KEY,
    matricula VARCHAR(30) NOT NULL UNIQUE,
    especialidad VARCHAR(100) NOT NULL,
    tarifa DECIMAL(10,2) NOT NULL,
    zona_cobertura VARCHAR(255) NOT NULL,
    ruta_documento VARCHAR(255) NOT NULL,
    estado_validacion TINYINT(1) DEFAULT 0, -- 0: Pendiente, 1: Aprobado
    biografia TEXT NULL,
    FOREIGN KEY (id_enfermero) REFERENCES usuarios(id) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ========================================================
-- 4. TABLA: mensajes_chat (Relación 1 a N con usuarios)
-- ========================================================
CREATE TABLE IF NOT EXISTS mensajes_chat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    remitente ENUM('usuario', 'asistente') NOT NULL,
    mensaje TEXT NOT NULL,
    fecha_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) 
        ON DELETE CASCADE
) ENGINE=InnoDB;