-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS app_database;

-- Seleção do banco de dados
USE app_database;

-- Criação da Tabela usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    nivel_privilegio INT NOT NULL DEFAULT 1,
    UNIQUE KEY unique_username (username)
);

-- Inserção de um usuário masterRoot
INSERT IGNORE INTO usuarios (username, password, nivel_privilegio) VALUES ('masterRoot', 'ola123', 1);

-- Criação da Tabela registros
CREATE TABLE IF NOT EXISTS registros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    placa VARCHAR(20) NOT NULL,
    nome_motorista VARCHAR(255) NOT NULL,
    cor_carro VARCHAR(255) NOT NULL,  -- Adicionada a coluna cor_carro
    modelo_carro VARCHAR(255) NOT NULL,
    local_destino VARCHAR(255) NOT NULL,
    de_onde_vem VARCHAR(255) NOT NULL,
    historia_triste TEXT NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_usuario INT,
    data_modificacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    excluido BOOLEAN DEFAULT 0,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

-- Adicionando Restrição Única à Coluna placa
ALTER TABLE registros ADD UNIQUE (placa);
