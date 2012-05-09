-- Table: localidades

DROP TABLE localidades;

CREATE TABLE localidades
(
  id SERIAL NOT NULL PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  "codigo_postal" INTEGER NOT NULL,
  created TIMESTAMP DEFAULT NULL,
  modified TIMESTAMP DEFAULT NULL,
  provincia_id INTEGER NOT NULL
);