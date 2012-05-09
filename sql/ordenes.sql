-- Table: ordenes

-- DROP TABLE ordenes;

CREATE TABLE ordenes
(
  id SERIAL NOT NULL PRIMARY KEY,
  cantidad INTEGER NOT NULL,
  estado BOOLEAN NOT NULL DEFAULT FALSE,
  sin_cargo boolean NOT NULL DEFAULT false,
  created TIMESTAMP DEFAULT NULL,
  modified TIMESTAMP DEFAULT NULL,
  articulo_id INTEGER NOT NULL,
  pedido_id INTEGER NOT NULL
);


-- SETEO DE CONTADOR EN 2
-- SELECT pg_catalog.setval('ordenes_id_seq', 2, true);


-- INSERTS
-- INSERT INTO ordenes(id, cantidad, created, modified, articulo_id, pedido_id)
-- 	VALUES (1, 25, '2010-10-23 11:06:05', '2010-10-23 12:36:11', 1, 1);
-- INSERT INTO ordenes(id, cantidad, created, modified, articulo_id, pedido_id)
-- 	VALUES (2, 15, '2010-10-23 11:06:05', '2010-10-23 12:36:11', 3, 1);