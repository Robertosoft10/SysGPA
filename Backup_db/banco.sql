CREATE DATABASE sysgpa;
USE sysgpa;

CREATE TABLE tb_usuarios(
	useId int not null auto_increment primary key,
	useName varchar (100),
	useEmail varchar(255),
	useNivel varchar(20),
	password varchar(255),
	useFoto varchar(255)
);
CREATE TABLE tb_clientes(
	clientId int not null auto_increment primary key,
	clientName varchar (255),
	clientContact varchar(30),
	clientEndereco varchar(900)
);
CREATE TABLE tb_artes_pedido(
	artId int not null auto_increment primary key,
	pedClienteId int,
	artTipo varchar (255),
	artDescripiton varchar(900),
	artEntreg varchar(100),
	artValue varchar(50),
	artStatus varchar(50),
    FOREIGN KEY (pedClienteId) REFERENCES tb_clientes (clientId)
);

