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
    Precio DECIMAL(10,2) NOT NULL,
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
('admin', 'admin'),
('paco', 'clave1'),
('javi', 'javi'),
('manolo', 'clave2');

INSERT INTO categoria (NombreCat) VALUES 
('Ordenadores de sobremesa'),
('Portatiles'),
('Componentes'),
('Accesorios');

INSERT INTO producto (CodCat, NombreProd, Stock, Precio) VALUES
-- Para la categoría 'Ordenadores de sobremesa'
(1, 'PC PcPlus Basic', 20, 399.99),
(1, 'PC PcPlus Gaming', 15, 1099.99),
(1, 'PC HP All-in-One', 10, 599.99),
(1, 'PC Acer All-in-One', 12, 699.99),
(1, 'PC Lenovo Gaming', 8, 649.99),
(1, 'PC Acer Gaming', 5, 499.99),
-- Para la categoría 'Portatiles'
(2, 'HP Pavilion 15', 30, 899.99),
(2, 'Dell XPS 13', 25, 1299.99),
(2, 'Lenovo Yoga', 20, 799.99),
(2, 'Asus ZenBook', 18, 999.99),
(2, 'Acer Swift', 22, 749.99),
(2, 'MacBook Air', 15, 1199.99),
-- Para la categoría 'Componentes'
(3, 'GPU NVIDIA RTX 3080', 20, 699.99),
(3, 'RAM 16GB DDR4', 40, 89.99),
(3, 'Disco SSD 1TB', 25, 129.99),
(3, 'Placa Base ASUS ROG', 10, 299.99),
(3, 'Fuente de Alimentación 750W', 15, 89.99),
(3, 'CPU Cooler Master', 30, 49.99),
(3, 'Tarjeta de Sonido Creative', 12, 99.99),
(3, 'Unidad Óptica Externa', 8, 39.99),
(3, 'Adaptador WiFi USB', 50, 19.99),
(3, 'Cables SATA', 100, 9.99),
(3, 'Caja de Ordenador ATX', 5, 79.99),
(3, 'Kit de Limpieza para PC', 60, 14.99),
-- Para la categoría 'Accesorios'
(4, 'Teclado Mecánico', 15, 89.99),
(4, 'Ratón Inalámbrico', 20, 39.99),
(4, 'Monitor 24 pulgadas', 10, 149.99),
(4, 'Auriculares Gaming', 30, 79.99),
(4, 'Webcam HD', 25, 49.99),
(4, 'Alfombrilla para Ratón', 50, 9.99),
(4, 'Base Refrigeradora para Portátil', 18, 19.99),
(4, 'Micrófono USB', 12, 59.99),
(4, 'Altavoces Bluetooth', 22, 89.99),
(4, 'Cargador Universal para Portátil', 14, 29.99),
(4, 'Hub USB 3.0', 40, 19.99),
(4, 'Lámpara LED para Escritorio', 35, 24.99),
(4, 'Soporte para Monitor', 10, 39.99),
(4, 'Cable HDMI', 100, 7.99),
(4, 'Adaptador USB-C a HDMI', 25, 14.99),
(4, 'Funda para Portátil', 20, 19.99),
(4, 'Soporte para Portátil', 15, 29.99),
(4, 'Cámara de Seguridad WiFi', 8, 129.99);


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