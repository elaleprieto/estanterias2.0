-- Table: pasillos

DROP TABLE pasillos;

CREATE TABLE pasillos
(
  id SERIAL NOT NULL PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  lado VARCHAR(50) NOT NULL,
  distancia INTEGER DEFAULT 0,
  created TIMESTAMP DEFAULT NULL,
  modified TIMESTAMP DEFAULT NULL
);


-- SETEO DE CONTADOR EN 2
SELECT pg_catalog.setval('pasillos_id_seq', 2, true);


-- INSERTS
INSERT INTO pasillos(id, nombre, lado, created, modified)
	VALUES (1,'Celeste', 'Derecho', '2010-10-23 11:06:05', '2010-10-23 12:36:11');
INSERT INTO pasillos(id, nombre, lado, created, modified)
	VALUES (2,'Celeste', 'Izquierdo', '2010-10-23 11:06:05', '2010-10-23 12:36:11');