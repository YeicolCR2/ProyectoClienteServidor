-- ============================================
-- BASE DE DATOS PROYECTO CINE
-- ============================================

USE proyecto_cine;

-- ============================================
-- TABLAS PRINCIPALES
-- ============================================

CREATE TABLE Rol (
    idRol INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE
);

INSERT INTO Rol (nombre) VALUES
('admin'),
('cliente');

CREATE TABLE Usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    estado VARCHAR(20) DEFAULT 'activo',
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_rol INT NOT NULL,
    FOREIGN KEY (id_rol) REFERENCES Rol(idRol)
);

CREATE TABLE Cine (
    id_cine INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    direccion VARCHAR(150),
    ciudad VARCHAR(100)
);

CREATE TABLE Sala (
    id_sala INT AUTO_INCREMENT PRIMARY KEY,
    numero INT NOT NULL,
    tipo VARCHAR(50),
    id_cine INT NOT NULL,
    FOREIGN KEY (id_cine) REFERENCES Cine(id_cine)
);

CREATE TABLE Pelicula (
    id_pelicula INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    duracion INT,
    descripcion TEXT,
    fecha_estreno DATE,
    estado VARCHAR(20)
);

CREATE TABLE Genero (
    id_genero INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    id_pelicula INT,
    FOREIGN KEY (id_pelicula) REFERENCES Pelicula(id_pelicula)
);

CREATE TABLE Funcion (
    id_funcion INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    precio DECIMAL(6,2),
    id_pelicula INT NOT NULL,
    id_sala INT NOT NULL,
    FOREIGN KEY (id_pelicula) REFERENCES Pelicula(id_pelicula),
    FOREIGN KEY (id_sala) REFERENCES Sala(id_sala),
    CONSTRAINT unique_funcion_sala UNIQUE (fecha, hora, id_sala)
);

CREATE TABLE Asiento (
    id_asiento INT AUTO_INCREMENT PRIMARY KEY,
    fila VARCHAR(5),
    numero INT,
    id_sala INT NOT NULL,
    FOREIGN KEY (id_sala) REFERENCES Sala(id_sala),
    CONSTRAINT unique_asiento_sala UNIQUE (fila, numero, id_sala)
);

-- ============================================
-- RESERVAS
-- ============================================

CREATE TABLE Reserva (
    id_reserva INT AUTO_INCREMENT PRIMARY KEY,
    fecha_reserva DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado VARCHAR(20) DEFAULT 'confirmada',
    id_usuario INT NOT NULL,
    id_funcion INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario),
    FOREIGN KEY (id_funcion) REFERENCES Funcion(id_funcion)
);

CREATE TABLE Reserva_Asiento (
    id_reserva INT,
    id_asiento INT,
    id_funcion INT,
    PRIMARY KEY (id_reserva, id_asiento),
    FOREIGN KEY (id_reserva) REFERENCES Reserva(id_reserva),
    FOREIGN KEY (id_asiento) REFERENCES Asiento(id_asiento),
    FOREIGN KEY (id_funcion) REFERENCES Funcion(id_funcion),
    CONSTRAINT unique_asiento_funcion UNIQUE (id_asiento, id_funcion)
);

-- ============================================
-- SEED DATA
-- ============================================

INSERT INTO Cine (nombre, direccion, ciudad)
VALUES ('CineMax', 'Mall Central', 'San José');

INSERT INTO Sala (numero, tipo, id_cine) VALUES
(1, '2D', 1),
(2, '3D', 1),
(3, 'IMAX', 1);

INSERT INTO Pelicula (titulo, duracion, descripcion, fecha_estreno, estado) VALUES
('Avengers: Endgame', 180, 'Superheroes luchan contra Thanos.', '2019-04-26', 'cartelera'),
('The Batman', 175, 'Batman investiga crimen en Gotham.', '2022-03-04', 'cartelera'),
('Interestelar', 169, 'Viaje espacial en busca de un nuevo hogar.', '2014-11-07', 'cartelera');

INSERT INTO Genero (nombre, id_pelicula) VALUES
('Acción', 1),
('Ciencia Ficción', 1),
('Acción', 2),
('Drama', 3),
('Ciencia Ficción', 3);

INSERT INTO Funcion (fecha, hora, precio, id_pelicula, id_sala) VALUES
('2026-03-05', '18:00:00', 3500.00, 1, 1),
('2026-03-05', '21:00:00', 3500.00, 1, 1),
('2026-03-05', '19:00:00', 4000.00, 2, 2),
('2026-03-06', '17:00:00', 3000.00, 3, 3);

-- ============================================
-- GENERACIÓN AUTOMÁTICA DE ASIENTOS
-- ============================================

-- Sala 1
INSERT INTO Asiento (fila, numero, id_sala)
SELECT fila, numero, 1
FROM (
    SELECT 'A' AS fila UNION
    SELECT 'B' UNION
    SELECT 'C' UNION
    SELECT 'D' UNION
    SELECT 'E'
) filas
CROSS JOIN (
    SELECT 1 AS numero UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5
    UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10
) numeros;

-- Sala 2
INSERT INTO Asiento (fila, numero, id_sala)
SELECT fila, numero, 2
FROM (
    SELECT 'A' AS fila UNION
    SELECT 'B' UNION
    SELECT 'C' UNION
    SELECT 'D' UNION
    SELECT 'E'
) filas
CROSS JOIN (
    SELECT 1 AS numero UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5
    UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10
) numeros;

-- Sala 3
INSERT INTO Asiento (fila, numero, id_sala)
SELECT fila, numero, 3
FROM (
    SELECT 'A' AS fila UNION
    SELECT 'B' UNION
    SELECT 'C' UNION
    SELECT 'D' UNION
    SELECT 'E'
) filas
CROSS JOIN (
    SELECT 1 AS numero UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5
    UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10
) numeros;