-- Table: ubicaciones

DROP TABLE ubicaciones;

CREATE TABLE ubicaciones
(
  id SERIAL NOT NULL PRIMARY KEY,
  altura VARCHAR(100) NOT NULL,
  posicion VARCHAR(100) NOT NULL,
  created TIMESTAMP DEFAULT NULL,
  modified TIMESTAMP DEFAULT NULL
);


-- SETEO DE CONTADOR EN 2
SELECT pg_catalog.setval('ubicaciones_id_seq', 2, true);


-- INSERTS
INSERT INTO ubicaciones(id, altura, posicion, created, modified)
	VALUES (1,'1', '1', '2010-10-23 11:06:05', '2010-10-23 12:36:11');

