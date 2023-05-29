
CREATE DATABASE wikisports;

USE wikisports;

CREATE TABLE usuarios (
cod_usuario int(5) AUTO_INCREMENT,
nome_usuario varchar(50) NOT NULL,
senha_usuario varchar(20) NOT NULL,
PRIMARY KEY (cod_usuario)
);

INSERT INTO usuarios ( nome_usuario, senha_usuario ) VALUES ( 'admin', '12345' ); 

CREATE TABLE esportes (
cod_esporte int(5) AUTO_INCREMENT,
nome_esporte varchar(50) NOT NULL,
descricao_esporte varchar(300),
PRIMARY KEY (cod_esporte)
);

INSERT INTO esportes ( nome_esporte, descricao_esporte ) 
VALUES 
('Futebol', 'O futebol é o esporte coletivo, disputado por duas equipes, de 11 jogadores que têm como objetivo colocar a bola entre as traves adversárias o maior número de vezes sem usar mãos e braços.' ),
('Basquete', 'Esporte coletivo disputado entre duas equipes de cinco pessoas cada, o objetivo do desporto é passar a bola por dentro do cesto da equipe adversária.'),
('Voleibol', 'Voleibol é um esporte praticado numa quadra dividida em duas partes por uma rede, possuindo duas equipes de seis jogadores em cada lado.')
