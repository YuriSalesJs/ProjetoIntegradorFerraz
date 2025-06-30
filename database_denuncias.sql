-- Tabela de denúncias de vagas
CREATE TABLE IF NOT EXISTS denuncias_vagas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vaga_id INT NOT NULL,
    candidato_id INT NOT NULL,
    motivo ENUM('conteudo_inadequado', 'informacoes_falsas', 'discriminacao', 'outro') NOT NULL,
    descricao TEXT,
    status ENUM('pendente', 'analisada', 'resolvida') DEFAULT 'pendente',
    data_denuncia TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    data_analise TIMESTAMP NULL,
    observacoes_admin TEXT,
    FOREIGN KEY (vaga_id) REFERENCES vagas(id) ON DELETE CASCADE,
    FOREIGN KEY (candidato_id) REFERENCES cadastro(id) ON DELETE CASCADE,
    UNIQUE KEY unique_denuncia (candidato_id, vaga_id)
); 