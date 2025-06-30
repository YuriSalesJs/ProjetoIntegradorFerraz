# Funcionalidade de Denúncia de Vagas

## Descrição
Sistema de denúncia que permite aos candidatos denunciarem vagas que consideram inadequadas ou que violam as políticas da plataforma.

## Funcionalidades Implementadas

### 1. Botão de Denúncia
- Localizado na página de detalhes da vaga (show.php)
- Visível apenas para candidatos logados
- Abre um modal com formulário de denúncia

### 2. Modal de Denúncia
- Formulário com seleção de motivo obrigatório
- Campo de descrição opcional
- Validação de dados
- Aviso sobre consequências de denúncias falsas

### 3. Motivos de Denúncia
- **Conteúdo Inadequado**: Vaga com conteúdo impróprio ou ofensivo
- **Informações Falsas**: Vaga com informações enganosas ou falsas
- **Discriminação**: Vaga que discrimina por gênero, raça, idade, etc.
- **Outro**: Outros motivos não listados

### 4. Validações
- Apenas candidatos podem denunciar
- Um candidato só pode denunciar uma vaga uma vez
- Motivo é obrigatório
- Validação de motivos permitidos

### 5. Feedback ao Usuário
- Mensagens de sucesso quando denúncia é enviada
- Mensagens de erro para casos específicos:
  - Já denunciou a vaga
  - Motivo inválido
  - Erro interno

## Estrutura do Banco de Dados

### Tabela: denuncias_vagas
```sql
CREATE TABLE denuncias_vagas (
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
```

## Arquivos Modificados/Criados

### 1. Modelo (Vaga.php)
- `denunciarVaga()`: Registra nova denúncia
- `verificarDenunciaExistente()`: Verifica se candidato já denunciou
- `getDenunciasVaga()`: Lista denúncias de uma vaga específica
- `getTodasDenuncias()`: Lista todas as denúncias (para admin)

### 2. Controller (VagaController.php)
- `denunciar()`: Processa a denúncia
- Validações de segurança
- Redirecionamentos com mensagens

### 3. View (show.php)
- Botão de denúncia
- Modal com formulário
- Mensagens de feedback

### 4. Rotas (index.php)
- `POST /vagas/denunciar`: Rota para processar denúncia

### 5. Banco de Dados
- `database_denuncias.sql`: Script para criar tabela

## Como Usar

1. **Para Candidatos:**
   - Acesse uma vaga específica
   - Clique no botão "Denunciar Vaga"
   - Selecione o motivo da denúncia
   - Adicione descrição (opcional)
   - Clique em "Enviar Denúncia"

2. **Para Administradores (Futuro):**
   - Painel para visualizar denúncias
   - Marcar denúncias como analisadas/resolvidas
   - Tomar ações sobre vagas denunciadas

## Próximos Passos Sugeridos

1. **Painel Administrativo**: Criar interface para gerenciar denúncias
2. **Notificações**: Enviar notificações para empresas sobre denúncias
3. **Ações Automáticas**: Suspender vagas com muitas denúncias
4. **Relatórios**: Estatísticas de denúncias por empresa/vaga
5. **Moderação**: Sistema de moderação manual de denúncias

## Segurança

- Validação de permissões (apenas candidatos)
- Prevenção de denúncias duplicadas
- Validação de dados de entrada
- Sanitização de dados
- Logs de denúncias para auditoria 