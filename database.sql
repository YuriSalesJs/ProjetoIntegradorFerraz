-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS ferraz_conecta CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE ferraz_conecta;

-- Tabela de candidatos
CREATE TABLE IF NOT EXISTS cadastro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    cpf VARCHAR(14),
    data_nascimento DATE,
    endereco TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabela de empresas
CREATE TABLE IF NOT EXISTS empresas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    razao_social VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    cnpj VARCHAR(18),
    endereco TEXT,
    descricao TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabela de vagas
CREATE TABLE IF NOT EXISTS vagas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descricao_completa TEXT NOT NULL,
    salario DECIMAL(10,2),
    exp VARCHAR(100),
    escolaridade VARCHAR(100),
    localizacao VARCHAR(255),
    sexo VARCHAR(20),
    empresa_id INT NOT NULL,
    status ENUM('ativa', 'fechada') DEFAULT 'ativa',
    data_postagem TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE
);

-- Tabela de relacionamento candidatos-vagas
CREATE TABLE IF NOT EXISTS candidatos_vagas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    candidato_id INT NOT NULL,
    vaga_id INT NOT NULL,
    data_candidatura TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pendente', 'aprovada', 'reprovada') DEFAULT 'pendente',
    FOREIGN KEY (candidato_id) REFERENCES cadastro(id) ON DELETE CASCADE,
    FOREIGN KEY (vaga_id) REFERENCES vagas(id) ON DELETE CASCADE,
    UNIQUE KEY unique_candidatura (candidato_id, vaga_id)
);

-- Inserir dados de exemplo

-- Empresas de exemplo
INSERT INTO empresas (razao_social, email, senha, telefone, cnpj, endereco, descricao) VALUES
('Empresa Exemplo 1', 'empresa1@exemplo.com', '123456', '(11) 99999-9999', '12.345.678/0001-90', 'Rua Exemplo, 123 - Ferraz de Vasconcelos', 'Empresa de tecnologia'),
('Empresa Exemplo 2', 'empresa2@exemplo.com', '123456', '(11) 88888-8888', '98.765.432/0001-10', 'Av. Principal, 456 - Ferraz de Vasconcelos', 'Empresa de serviços');

-- Candidatos de exemplo
INSERT INTO cadastro (nome, email, senha, telefone, cpf, data_nascimento, endereco) VALUES
('João Silva', 'joao@exemplo.com', '123456', '(11) 77777-7777', '123.456.789-00', '1990-01-01', 'Rua das Flores, 789 - Ferraz de Vasconcelos'),
('Maria Santos', 'maria@exemplo.com', '123456', '(11) 66666-6666', '987.654.321-00', '1985-05-15', 'Av. Central, 321 - Ferraz de Vasconcelos');

-- Vagas de exemplo
INSERT INTO vagas (titulo, descricao_completa, salario, exp, escolaridade, localizacao, sexo, empresa_id) VALUES
('Desenvolvedor PHP', 'Desenvolvedor PHP com experiência em frameworks modernos. Conhecimentos em MySQL, HTML, CSS e JavaScript.', 3500.00, '2-3 anos', 'Ensino Superior', 'Ferraz de Vasconcelos', 'Indiferente', 1),
('Auxiliar Administrativo', 'Auxiliar administrativo para empresa de tecnologia. Organização, pontualidade e conhecimento em Excel.', 1800.00, '1-2 anos', 'Ensino Médio', 'Ferraz de Vasconcelos', 'Indiferente', 1),
('Vendedor', 'Vendedor para loja de roupas. Experiência em vendas e atendimento ao cliente.', 1500.00, '1 ano', 'Ensino Médio', 'Ferraz de Vasconcelos', 'Indiferente', 2);

-- Candidaturas de exemplo
INSERT INTO candidatos_vagas (candidato_id, vaga_id, status) VALUES
(1, 1, 'pendente'),
(2, 2, 'aprovada'),
(1, 3, 'pendente'); 