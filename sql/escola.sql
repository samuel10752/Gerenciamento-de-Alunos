-- Criação da tabela alunos com os novos campos
CREATE TABLE alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    curso VARCHAR(100) NOT NULL,
    sexo ENUM('masculino', 'feminino') NOT NULL
);