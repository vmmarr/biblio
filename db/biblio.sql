------------------------------
-- Archivo de base de datos --
------------------------------

DROP TABLE IF EXISTS libros CASCADE;

CREATE TABLE libros
(
    id       bigserial    PRIMARY KEY
  , isbn     varchar(13)  NOT NULL UNIQUE
  , titulo   varchar(255) NOT NULL
  , num_pags int          CONSTRAINT ck_libros_num_pags_no_negativo
                          CHECK (num_pags >= 0)
);

INSERT INTO libros (isbn, titulo, num_pags)
VALUES ('1111111111111', 'El nombre de la rosa', 760)
     , ('2222222222222', 'Cómo aprender PHP en 24 horas', 12);
