CREATE DATABASE IF NOT EXISTS `estante_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `estante_db`;

CREATE TABLE IF NOT EXISTS `autores` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL,
    `nacionalidade` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `livros` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `titulo` VARCHAR(150) NOT NULL,
    `genero` VARCHAR(60) NOT NULL,
    `ano_publicacao` SMALLINT NOT NULL,
    `preco` DECIMAL(10,2) NOT NULL,
    `autor_id` INT NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`autor_id`) REFERENCES `autores`(`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `autores` (`nome`, `nacionalidade`) VALUES
('Machado de Assis', 'Brasileira'),
('Clarice Lispector', 'Brasileira'),
('Isaac Asimov', 'Americana'),
('Agatha Christie', 'Britânica');

INSERT INTO `livros` (`titulo`, `genero`, `ano_publicacao`, `preco`, `autor_id`) VALUES
('Dom Casmurro', 'Romance', 1899, 29.90, 1),
('Memórias Póstumas de Brás Cubas', 'Romance', 1881, 32.50, 1),
('A Hora da Estrela', 'Ficção', 1977, 39.90, 2),
('Eu, Robô', 'Ficção científica', 1950, 49.90, 3),
('Assassinato no Expresso do Oriente', 'Mistério', 1934, 44.90, 4);
