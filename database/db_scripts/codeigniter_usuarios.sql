use test;

CREATE TABLE usuarios (
	id int NOT NULL AUTO_INCREMENT,
    nome varchar(128) NOT NULL,
    email varchar(128) NOT NULL UNIQUE,
    dt_nascimento date NOT NULL,
    ft_perfil varchar(255),
    descricao text,
    subcategoria_id int,
    updated_at timestamp not null default now() on update now(),
    created_at timestamp not null default now(),
    PRIMARY KEY (id)
);

ALTER TABLE usuarios ADD CONSTRAINT fk_usuarios_subcategorias FOREIGN KEY ( subcategoria_id ) REFERENCES subcategorias ( id ) ON DELETE set null;
