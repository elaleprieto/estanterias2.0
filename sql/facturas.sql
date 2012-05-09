-- Table: facturas

--DROP TABLE facturas;

CREATE TABLE facturas
(
  -- id = Número de Factura
  id SERIAL NOT NULL PRIMARY KEY,
  created TIMESTAMP DEFAULT NULL,
  modified TIMESTAMP DEFAULT NULL,
  pedido_id INTEGER NOT NULL
);