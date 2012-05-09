-- Table: clientes

DROP TABLE clientes;

CREATE TABLE clientes
(
  id SERIAL NOT NULL PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  direccion VARCHAR(50) NOT NULL,
  cuit VARCHAR(15) NOT NULL,
  bonificacion INTEGER NOT NULL,
  created TIMESTAMP DEFAULT NULL,
  modified TIMESTAMP DEFAULT NULL,
  localidad_id INTEGER NOT NULL,
  iva_id INTEGER NOT NULL
);


-- SETEO DE CONTADOR EN 2
--SELECT pg_catalog.setval('clientes_id_seq', 1, true);


-- INSERTS
--INSERT INTO clientes(id, numero, nombre, created, modified)
--	VALUES (1, 65, 'Ferretería del Sur', '2010-10-23 11:06:05', '2010-10-23 12:36:11');