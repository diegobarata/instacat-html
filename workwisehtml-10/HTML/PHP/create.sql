CREATE DATABASE InstaCat;
USE InstaCat;

CREATE TABLE Usuario (
    id_usuario int NOT NULL AUTO_INCREMENT,
    senha varchar(250) NOT NULL,
    nome varchar(50) NOT NULL,
    email varchar(30) NOT NULL,
    primary key(id_usuario)
);
CREATE TABLE Administrador (
    id_adm int NOT NULL AUTO_INCREMENT,
    senha varchar(250) NOT NULL,
    email varchar(30) NOT NULL,
    primary key(id_adm)
);
CREATE TABLE Postagem (
    id_postagem int NOT NULL AUTO_INCREMENT,
    Autor varchar(30) NOT NULL,
    primary key(id_postagem),
    FOREIGN KEY (Autor) REFERENCES Usuario(id_usuario)
);

