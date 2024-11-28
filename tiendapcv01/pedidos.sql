SET NAMES UTF8;
CREATE DATABASE  IF NOT EXISTS pedidos;

USE pedidos;

DROP TABLE IF EXISTS cliente;
DROP TABLE IF EXISTS pedido;
DROP TABLE IF EXISTS categoria;
DROP TABLE IF EXISTS producto;
DROP TABLE IF EXISTS pedidos_productos;


CREATE TABLE IF NOT EXISTS cliente(
    CodCliente int(2) NOT NULL auto_increment,
    Correo VARCHAR(20) NOT NULL,
    Clave VARCHAR(20) NOT NULL,
    PRIMARY KEY (CodCliente)
)CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS pedido(
    CodPed int(5) NOT NULL auto_increment,
    CodCliente int(2) NOT NULL,
    Fecha DATE NOT NULL,
    PRIMARY KEY (CodPed),
    FOREIGN KEY (CodCliente) REFERENCES cliente(CodCliente)
)CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS categoria(
    CodCat int(2) NOT NULL auto_increment,
    NombreCat VARCHAR(20) NOT NULL,
    PRIMARY KEY (CodCat)
)CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS producto(
    CodProd int(3) NOT NULL auto_increment,
    CodCat int(2) NOT NULL,
    NombreProd VARCHAR(20) NOT NULL,
    Stock INT(4) NOT NULL,
    PRIMARY KEY (CodProd),
    FOREIGN KEY (CodCat) REFERENCES categoria(CodCat)
)CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS pedidos_productos(
    id int(4) NOT NULL auto_increment,
    CodPed int(5) NOT NULL,
    CodProd int(3) NOT NULL,
    Unidades int(3) NOT NULL,
    FOREIGN KEY (CodPed) REFERENCES pedido(CodPed),
    FOREIGN KEY (CodProd) REFERENCES producto(CodProd),
    PRIMARY KEY (id)
)CHARACTER SET utf8 COLLATE utf8_general_ci;

INSERT INTO cliente (Correo, Clave) VALUES 
('Admin', 'admin'),
('paco', 'clave1'),
('javi', 'javi'),
('manolo', 'clave2');

INSERT INTO categoria (NombreCat) VALUES 
('Ordenadores de sobremesa'),
('Portatiles'),
('Componentes'),
('Accesorios');

INSERT INTO producto (CodCat, NombreProd, Stock) VALUES
-- Para la categoría 'Ordenadores de sobremesa'
(1, 'Ordenador Sobremesa PcPlus Ofimatica Intel Core i5-12400 / 32GB / 1TB SSD', 20),
(1, 'Ordenador Sobremesa Gaming AMD Ryzen 7 / 16GB / 1TB SSD', 15),
(1, 'Ordenador Sobremesa HP All-in-One', 10),
(1, 'Ordenador Sobremesa Dell Inspiron', 12),
(1, 'Ordenador Sobremesa Lenovo ThinkCentre', 8),
(1, 'Ordenador Sobremesa Acer Aspire', 5),
-- Para la categoría 'Portatiles'
(2, 'Portátil HP Pavilion 15', 30),
(2, 'Portátil Dell XPS 13', 25),
(2, 'Portátil Lenovo Yoga', 20),
(2, 'Portátil Asus ZenBook', 18),
(2, 'Portátil Acer Swift', 22),
(2, 'Portátil MacBook Air', 15),
-- Para la categoría 'Componentes'
(3, 'Tarjeta Gráfica NVIDIA RTX 3080', 20),
(3, 'Memoria RAM 16GB DDR4', 40),
(3, 'Disco Duro SSD 1TB', 25),
(3, 'Placa Base ASUS ROG', 10),
(3, 'Fuente de Alimentación 750W', 15),
(3, 'Ventilador CPU Cooler Master', 30),
(3, 'Tarjeta de Sonido Creative', 12),
(3, 'Unidad Óptica Externa', 8),
(3, 'Adaptador WiFi USB', 50),
(3, 'Cables SATA', 100),
(3, 'Caja de Ordenador ATX', 5),
(3, 'Kit de Limpieza para PC', 60),
-- Para la categoría 'Accesorios'
(4, 'Teclado Mecánico', 15),
(4, 'Ratón Inalámbrico', 20),
(4, 'Monitor 24 pulgadas', 10),
(4, 'Auriculares Gaming', 30),
(4, 'Webcam HD', 25),
(4, 'Alfombrilla para Ratón', 50),
(4, 'Base Refrigeradora para Portátil', 18),
(4, 'Micrófono USB', 12),
(4, 'Altavoces Bluetooth', 22),
(4, 'Cargador Universal para Portátil', 14),
(4, 'Hub USB 3.0', 40),
(4, 'Lámpara LED para Escritorio', 35),
(4, 'Soporte para Monitor', 10),
(4, 'Cable HDMI', 100),
(4, 'Adaptador USB-C a HDMI', 25),
(4, 'Funda para Portátil', 20),
(4, 'Soporte para Portátil', 15),
(4, 'Cámara de Seguridad WiFi', 8);


-- Crear cinco pedidos en la tabla 'pedido'
INSERT INTO pedido (CodCliente, Fecha) VALUES
(1, CURRENT_DATE),
(2, CURRENT_DATE),
(3, CURRENT_DATE),
(4, CURRENT_DATE),
(1, CURRENT_DATE);

-- Asociar productos a los pedidos en la tabla 'pedidos_productos'
INSERT INTO pedidos_productos (CodPed, CodProd, Unidades) VALUES
-- Para el pedido 1
(1, 1, 3),
(1, 5, 2),
(1, 9, 1),
-- Para el pedido 2
(2, 2, 4),
(2, 6, 2),
(2, 10, 3),
-- Para el pedido 3
(3, 3, 2),
(3, 7, 5),
(3, 11, 1),
-- Para el pedido 4
(4, 4, 3),
(4, 8, 2),
(4, 12, 4),
-- Para el pedido 5
(5, 5, 4),
(5, 9, 1),
(5, 13, 2);