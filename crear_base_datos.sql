-- ==========================================
-- CREAR BASE DE DATOS
-- ==========================================

CREATE DATABASE IF NOT EXISTS mision_secreta;
USE mision_secreta;

-- ==========================================
-- TABLA DE USUARIOS AUTORIZADOS
-- (Solo el administrador agrega personas)
-- ==========================================

CREATE TABLE usuarios (

    id INT AUTO_INCREMENT PRIMARY KEY,

    cedula VARCHAR(10) NOT NULL UNIQUE,

    nombre VARCHAR(100) NOT NULL,

    usuario VARCHAR(50) UNIQUE,

    contrasena VARCHAR(255),

    imagen_seguridad VARCHAR(100),

    -- Respuesta de seguridad (guardada cifrada)
    respuesta_secreta VARCHAR(255),

    registrado TINYINT(1) DEFAULT 0,

    rango VARCHAR(30) DEFAULT 'Recluta',

    nivel INT DEFAULT 1,

    puntaje INT DEFAULT 0,

    tiempo INT DEFAULT 0,

    puntaje_nivel1 INT DEFAULT 0,

    tiempo_nivel1 INT DEFAULT 0,

    puntaje_nivel2 INT DEFAULT 0,

    tiempo_nivel2 INT DEFAULT 0

);

-- ==========================================
-- USUARIOS AUTORIZADOS
-- (Estos sí podrán crear una cuenta)
-- ==========================================

INSERT INTO usuarios
(cedula, nombre)
VALUES

('2400149916',' '),

('24000149917','Naomi Ortiz'),

('24000149918','Kimy Chen'),

('24000149919','Valentina Merino'),

('24000149920','Valentina Zgone'),

('24000149950','Marca Villafuerte Cristian Jhoel'),