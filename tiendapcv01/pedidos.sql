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
('La Ragua', 'clave1'),
('Foster', 'clave2'),
('Burger King', 'clave3'),
('Doner Kebab', 'clave4');

INSERT INTO categoria (NombreCat) VALUES 
('Bebidas'),
('Carnes'),
('Frutas'),
('Postres');

INSERT INTO producto (CodCat, NombreProd, Stock) VALUES
-- Para la categoría 'Bebidas'
(1, 'Refresco', 50),
(1, 'Agua Mineral', 30),
(1, 'Jugo de Naranja', 20),
(1, 'Café', 40),
(1, 'Té', 25),
-- Para la categoría 'Carnes'
(2, 'Filete de Ternera', 15),
(2, 'Pollo Asado', 20),
(2, 'Chuletas de Cerdo', 10),
(2, 'Hamburguesa', 30),
(2, 'Salchichas', 25),
-- Para la categoría 'Frutas'
(3, 'Manzanas', 40),
(3, 'Plátanos', 35),
(3, 'Fresas', 25),
(3, 'Uvas', 30),
(3, 'Kiwi', 20),
-- Para la categoría 'Postres'
(4, 'Pastel de Chocolate', 15),
(4, 'Helado de Vainilla', 20),
(4, 'Tarta de Fresa', 10),
(4, 'Flan', 25),
(4, 'Galletas de Mantequilla', 30);

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