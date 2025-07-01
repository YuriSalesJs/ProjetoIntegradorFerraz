-- Script para adicionar campos de autenticação social à tabela de candidatos
USE ferraz_conecta;

-- Adicionar campos para autenticação social
ALTER TABLE cadastro 
ADD COLUMN provider VARCHAR(50) NULL COMMENT 'Provedor de autenticação (google, linkedin, etc)',
ADD COLUMN provider_id VARCHAR(255) NULL COMMENT 'ID do usuário no provedor',
ADD COLUMN provider_data JSON NULL COMMENT 'Dados adicionais do provedor';

-- Criar índice para melhorar performance nas consultas por provider
CREATE INDEX idx_cadastro_provider ON cadastro(provider, provider_id);
CREATE INDEX idx_cadastro_email_provider ON cadastro(email, provider);

-- Comentário sobre a estrutura atualizada
-- A tabela cadastro agora suporta:
-- 1. Autenticação tradicional (email/senha)
-- 2. Autenticação social (Google, LinkedIn)
-- 3. Dados adicionais do provedor em formato JSON 