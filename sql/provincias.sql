-- Table: provincias

-- DROP TABLE provincias;

CREATE TABLE provincias
(
  id SERIAL NOT NULL PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  created TIMESTAMP DEFAULT NULL,
  modified TIMESTAMP DEFAULT NULL
);