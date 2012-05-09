-- Table: pedidos

--DROP TABLE pedidos;

CREATE TABLE pedidos
(
  id SERIAL NOT NULL PRIMARY KEY,
  -- numero INTEGER NOT NULL,
  estado BOOLEAN NOT NULL DEFAULT FALSE,
  created TIMESTAMP DEFAULT NULL,
  modified TIMESTAMP DEFAULT NULL,
  finalizado TIMESTAMP DEFAULT NULL,
  cliente_id INTEGER NOT NULL
);


-- SETEO DE CONTADOR EN 2
SELECT pg_catalog.setval('pedidos_id_seq', 2, true);


-- INSERTS
INSERT INTO pedidos(id, created, modified, cliente_id)
	VALUES (1, '2010-10-23 11:06:05', '2010-10-23 12:36:11', 1);



-- Agregar una columna (cliente_id) con DEFAULT NOT NULL
--ALTER TABLE pedidos ADD COLUMN cliente_id INTEGER;
-- UPDATE pedidos SET cliente_id=1 WHERE cliente_id=65;
--ALTER TABLE pedidos ALTER COLUMN cliente_id SET NOT NULL;


-- Eliminar una columna (numero)
--ALTER TABLE pedidos DROP COLUMN numero;