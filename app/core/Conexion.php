<?php
// app/core/Conexion.php

class Conexion {
    private static $conexion = null;

    public static function conectar() {
        if (self::$conexion === null) {
            try {
                // Configuración para Laragon / XAMPP local
                $host = 'localhost';
                $db   = 'saludconnect';
                $user = 'root';
                $pass = ''; // Por defecto viene vacío en entornos locales
                $charset = 'utf8mb4';

                $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
                
                // Creamos la instancia PDO con configuraciones de seguridad
                self::$conexion = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Lanza excepciones si hay errores de SQL
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Devuelve los datos en arrays asociativos prolijos
                    PDO::ATTR_EMULATE_PREPARES   => false,                  // Desactiva la emulación para usar consultas preparadas reales
                ]);
            } catch (PDOException $e) {
                // Si explota la conexión, frena el script y te avisa qué pasó
                die("Error crítico de conexión a la base de datos: " . $e->getMessage());
            }
        }
        return self::$conexion;
    }
}