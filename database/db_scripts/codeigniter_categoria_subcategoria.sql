use test;

CREATE TABLE categorias (
	id int NOT NULL AUTO_INCREMENT,
    titulo varchar(128) NOT NULL UNIQUE,
    PRIMARY KEY (id)
);

CREATE TABLE subcategorias (
	id int NOT NULL AUTO_INCREMENT,
    titulo varchar(128) NOT NULL,
    categoria_id int NOT NULL,
    PRIMARY KEY (id)
);

ALTER TABLE subcategorias ADD CONSTRAINT fk_subcategorias_categorias FOREIGN KEY ( categoria_id ) REFERENCES categorias ( id ) ON DELETE CASCADE;