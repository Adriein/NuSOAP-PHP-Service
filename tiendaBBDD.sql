CREATE DATABASE tienda;

USE tienda;

CREATE TABLE categoria(
	identificador int NOT NULL AUTO_INCREMENT,
    nombre varchar(50) NOT NULL,
    PRIMARY KEY (identificador)
);

CREATE TABLE producto(
	identificador int NOT NULL AUTO_INCREMENT,
    nombre varchar(50) NOT NULL,
    categoria int NOT NULL,
    PRIMARY KEY (identificador),
    FOREIGN KEY (categoria) REFERENCES categoria(identificador) ON UPDATE CASCADE ON DELETE CASCADE
);
