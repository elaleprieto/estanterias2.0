-- Table: ubicados

-- DROP TABLE ubicados;

CREATE TABLE ubicados
(
  id SERIAL NOT NULL PRIMARY KEY,
  estado BOOLEAN NOT NULL DEFAULT FALSE,
  created TIMESTAMP DEFAULT NULL,
  modified TIMESTAMP DEFAULT NULL,
  articulo_id INTEGER NOT NULL,
  pasillo_id INTEGER NOT NULL,
  ubicacion_id INTEGER NOT NULL
);


-- SETEO DE CONTADOR EN 2
SELECT pg_catalog.setval('ubicados_id_seq', 2, true);


-- INSERTS
INSERT INTO ubicados(id, created, modified, articulo_id, pasillo_id, ubicacion_id)
	VALUES (1, '2010-10-23 11:06:05', '2010-10-23 12:36:11', 1, 1, 1);