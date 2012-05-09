-- Table: articulos

DROP TABLE articulos;

CREATE TABLE articulos
(
  id SERIAL NOT NULL PRIMARY KEY,
  orden INTEGER NOT NULL DEFAULT 999999,
  detalle VARCHAR(250) NOT NULL,
  unidad VARCHAR(10) NOT NULL,
  -- mysql > FLOAT = NUMERIC < postgres
  precio NUMERIC NOT NULL DEFAULT 0.0,
  foto VARCHAR(100) NOT NULL DEFAULT 'nofoto',
  created TIMESTAMP DEFAULT NULL,
  modified TIMESTAMP DEFAULT NULL
);


-- SETEO DE CONTADOR EN 2
--SELECT pg_catalog.setval('articulos_id_seq', 2, true);


-- INSERTS
--INSERT INTO articulos(id, codigo, detalle, unidad, precio, created, modified)
--	VALUES (1, 1, 'Estantes', 'c/u', 12.55, '2010-10-23 11:06:05', '2010-10-23 12:36:11');

