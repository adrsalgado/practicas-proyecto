-- Script para inicializar la base de datos
-- Ejecutar como administrador (`root`) de MySQL/MariaDB
-- 
-- Fecha: 2022-11-02
-- Autor: 
-- 

--
-- Crear la Base de Datos
-- 
CREATE DATABASE IF NOT EXISTS `prosalco`;

-- 
-- Crear el usuario de la aplicacion, identificado por contrase~na
-- 
CREATE USER IF NOT EXISTS 'prosalco'@'localhost' IDENTIFIED BY '1234';

--
-- Conceder privilegios al usuario
-- 
GRANT ALL PRIVILEGES ON `prosalco`.* TO 'prosalco'@'localhost';


