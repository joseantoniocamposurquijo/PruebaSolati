-- Creacion de base de datos del proyecto PruebaSolati

create database PruebaSolati;

use PruebaSolati;

grant all privileges on PruebaSolati.* to 'PruebaSolati' identified by '1q2w3e4r';
grant all privileges on PruebaSolati.* to 'PruebaSolati'@'localhost' identified by '1q2w3e4r';

grant process on *.* to 'PruebaSolati';
grant process on *.* to 'PruebaSolati'@'localhost';


-- Creacion de tabla 
create table if not exists `productos` (
	`ProId` CHAR(3) not null comment 'Id',
	`ProDescripcion` VARCHAR(128) not null comment 'descripcion',
	`ProValor` INTEGER UNSIGNED not null comment 'valor',
	primary key (`ProId`)
) engine=InnoDB default charset=latin1;


-- Creacion de standar inserts
INSERT INTO productos (ProId, ProDescripcion, ProValor) VALUES ('su', 'sudaderas', 15000);
INSERT INTO productos (ProId, ProDescripcion, ProValor) VALUES ('pj', 'pantalon jean', 35000);
INSERT INTO productos (ProId, ProDescripcion, ProValor) VALUES ('sa', 'sweter de botones ', 22000);
INSERT INTO productos (ProId, ProDescripcion, ProValor) VALUES ('me', 'medias', 5000);
INSERT INTO productos (ProId, ProDescripcion, ProValor) VALUES ('rp', 'ropa interior', 12000);
INSERT INTO productos (ProId, ProDescripcion, ProValor) VALUES ('zm', 'zapatos mujer', 45000);
INSERT INTO productos (ProId, ProDescripcion, ProValor) VALUES ('zh', 'zapatos hombre', 48000);