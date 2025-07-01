-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/07/2025 às 03:20
-- Versão do servidor: 11.7.2-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ferraz_conecta`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `endereco` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `provider` varchar(50) DEFAULT NULL COMMENT 'Provedor de autenticação (google, linkedin, etc)',
  `provider_id` varchar(255) DEFAULT NULL COMMENT 'ID do usuário no provedor',
  `provider_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Dados adicionais do provedor' CHECK (json_valid(`provider_data`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `cadastro`
--

INSERT INTO `cadastro` (`id`, `nome`, `email`, `senha`, `telefone`, `cpf`, `data_nascimento`, `endereco`, `created_at`, `updated_at`, `provider`, `provider_id`, `provider_data`) VALUES
(1, 'João Silva', 'joao@exemplo.com', '123456', '(11) 77777-7777', '123.456.789-00', '1990-01-01', 'Rua das Flores, 789 - Ferraz de Vasconcelos', '2025-06-29 08:14:25', '2025-06-29 08:14:25', NULL, NULL, NULL),
(2, 'Maria Santos', 'maria@exemplo.com', '123456', '(11) 66666-6666', '987.654.321-00', '1985-05-15', 'Av. Central, 321 - Ferraz de Vasconcelos', '2025-06-29 08:14:25', '2025-06-29 08:14:25', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `candidatos_vagas`
--

CREATE TABLE `candidatos_vagas` (
  `id` int(11) NOT NULL,
  `candidato_id` int(11) NOT NULL,
  `vaga_id` int(11) NOT NULL,
  `data_candidatura` timestamp NULL DEFAULT current_timestamp(),
  `status` enum('pendente','aprovada','reprovada') DEFAULT 'pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `candidatos_vagas`
--

INSERT INTO `candidatos_vagas` (`id`, `candidato_id`, `vaga_id`, `data_candidatura`, `status`) VALUES
(2, 2, 2, '2025-06-29 08:14:25', 'aprovada');

-- --------------------------------------------------------

--
-- Estrutura para tabela `denuncias_vagas`
--

CREATE TABLE `denuncias_vagas` (
  `id` int(11) NOT NULL,
  `vaga_id` int(11) NOT NULL,
  `candidato_id` int(11) NOT NULL,
  `motivo` enum('conteudo_inadequado','informacoes_falsas','discriminacao','outro') NOT NULL,
  `descricao` text DEFAULT NULL,
  `status` enum('pendente','analisada','resolvida') DEFAULT 'pendente',
  `data_denuncia` timestamp NULL DEFAULT current_timestamp(),
  `data_analise` timestamp NULL DEFAULT NULL,
  `observacoes_admin` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresas`
--

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL,
  `razao_social` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `cnpj` varchar(18) DEFAULT NULL,
  `endereco` text DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `empresas`
--

INSERT INTO `empresas` (`id`, `razao_social`, `email`, `senha`, `telefone`, `cnpj`, `endereco`, `descricao`, `created_at`, `updated_at`) VALUES
(1, 'Empresa Exemplo 1', 'empresa1@exemplo.com', '123456', '(11) 99999-9999', '12.345.678/0001-90', 'Rua Exemplo, 123 - Ferraz de Vasconcelos', 'Empresa de tecnologia', '2025-06-29 08:14:24', '2025-06-29 08:14:24'),
(2, 'Empresa Exemplo 2', 'empresa2@exemplo.com', '123456', '(11) 88888-8888', '98.765.432/0001-10', 'Av. Principal, 456 - Ferraz de Vasconcelos', 'Empresa de serviços', '2025-06-29 08:14:24', '2025-06-29 08:14:24');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vagas`
--

CREATE TABLE `vagas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao_completa` text NOT NULL,
  `salario` decimal(10,2) DEFAULT NULL,
  `exp` varchar(100) DEFAULT NULL,
  `escolaridade` varchar(100) DEFAULT NULL,
  `localizacao` varchar(255) DEFAULT NULL,
  `sexo` varchar(20) DEFAULT NULL,
  `empresa_id` int(11) NOT NULL,
  `status` enum('ativa','fechada') DEFAULT 'ativa',
  `data_postagem` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `vagas`
--

INSERT INTO `vagas` (`id`, `titulo`, `descricao_completa`, `salario`, `exp`, `escolaridade`, `localizacao`, `sexo`, `empresa_id`, `status`, `data_postagem`) VALUES
(1, 'Desenvolvedor PHP/Laravel', 'Desenvolvedor PHP com experiência em frameworks modernos. Conhecimentos em MySQL, HTML, CSS e JavaScript.', 3500.00, 'Sem experiência', 'Superior Completo', 'Ferraz de Vasconcelos', 'Masculino', 1, 'ativa', '2025-06-29 08:14:25'),
(2, 'Auxiliar Administrativo', 'Auxiliar administrativo para empresa de tecnologia. Organização, pontualidade e conhecimento em Excel.', 1800.00, '1-2 anos', 'Ensino Médio', 'Ferraz de Vasconcelos', 'Masculino', 1, 'ativa', '2025-06-29 08:14:25'),
(3, 'Vendedor', 'Vendedor para loja de roupas. Experiência em vendas e atendimento ao cliente.', 1500.00, '1 ano', 'Ensino Médio', 'Ferraz de Vasconcelos', 'Indiferente', 2, 'ativa', '2025-06-29 08:14:25'),
(4, 'Auxilixar de almoxarifado', 'Realizar tarefas de almoxarife', 1512.01, '1-2 anos', 'Ensino Médio', 'Ferraz de Vasconcelos', 'Feminino', 1, 'ativa', '2025-06-29 21:18:55'),
(5, 'Teste', 'Teste Vaga Teste Vaga Teste Vaga Teste Vaga ', 5000.00, 'Sem experiência', 'Ensino Médio', 'Poá', 'Masculino', 1, 'ativa', '2025-07-01 03:58:05');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_cadastro_provider` (`provider`,`provider_id`),
  ADD KEY `idx_cadastro_email_provider` (`email`,`provider`);

--
-- Índices de tabela `candidatos_vagas`
--
ALTER TABLE `candidatos_vagas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_candidatura` (`candidato_id`,`vaga_id`),
  ADD KEY `vaga_id` (`vaga_id`);

--
-- Índices de tabela `denuncias_vagas`
--
ALTER TABLE `denuncias_vagas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_denuncia` (`candidato_id`,`vaga_id`),
  ADD KEY `vaga_id` (`vaga_id`);

--
-- Índices de tabela `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `vagas`
--
ALTER TABLE `vagas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empresa_id` (`empresa_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `candidatos_vagas`
--
ALTER TABLE `candidatos_vagas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `denuncias_vagas`
--
ALTER TABLE `denuncias_vagas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `vagas`
--
ALTER TABLE `vagas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `candidatos_vagas`
--
ALTER TABLE `candidatos_vagas`
  ADD CONSTRAINT `candidatos_vagas_ibfk_1` FOREIGN KEY (`candidato_id`) REFERENCES `cadastro` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `candidatos_vagas_ibfk_2` FOREIGN KEY (`vaga_id`) REFERENCES `vagas` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `denuncias_vagas`
--
ALTER TABLE `denuncias_vagas`
  ADD CONSTRAINT `denuncias_vagas_ibfk_1` FOREIGN KEY (`vaga_id`) REFERENCES `vagas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `denuncias_vagas_ibfk_2` FOREIGN KEY (`candidato_id`) REFERENCES `cadastro` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `vagas`
--
ALTER TABLE `vagas`
  ADD CONSTRAINT `vagas_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
