# Configuração das APIs de Autenticação Social

Este documento explica como configurar as APIs do Google e LinkedIn para autenticação social no Ferraz Conecta.

## Pré-requisitos

- Conta no Google Cloud Console
- Conta no LinkedIn Developer Portal
- Servidor web com HTTPS (para produção)

## 1. Configuração do Google OAuth 2.0

### 1.1 Criar Projeto no Google Cloud Console

1. Acesse [Google Cloud Console](https://console.cloud.google.com/)
2. Crie um novo projeto ou selecione um existente
3. Ative a API "Google+ API" ou "Google Identity API"

### 1.2 Configurar Credenciais OAuth 2.0

1. Vá para "APIs & Services" > "Credentials"
2. Clique em "Create Credentials" > "OAuth 2.0 Client IDs"
3. Configure o tipo de aplicação (Web application)
4. Adicione as URLs autorizadas:
   - **Authorized JavaScript origins:**
     - `http://localhost` (desenvolvimento)
     - `https://seudominio.com` (produção)
   - **Authorized redirect URIs:**
     - `http://localhost/ProjetoIntegradorFerraz-mvc/public/auth/google/callback` (desenvolvimento)
     - `https://seudominio.com/auth/google/callback` (produção)

### 1.3 Obter Credenciais

- **Client ID:** Copie o Client ID gerado
- **Client Secret:** Copie o Client Secret gerado

## 2. Configuração do LinkedIn OAuth 2.0

### 2.1 Criar Aplicação no LinkedIn

1. Acesse [LinkedIn Developer Portal](https://www.linkedin.com/developers/)
2. Clique em "Create App"
3. Preencha as informações do aplicativo

### 2.2 Configurar OAuth 2.0

1. Vá para "Auth" na barra lateral
2. Configure as URLs de redirecionamento:
   - `http://localhost/ProjetoIntegradorFerraz-mvc/public/auth/linkedin/callback` (desenvolvimento)
   - `https://seudominio.com/auth/linkedin/callback` (produção)

### 2.3 Solicitar Permissões

1. Vá para "Products" > "Sign In with LinkedIn"
2. Solicite acesso aos escopos:
   - `r_liteprofile` (informações básicas do perfil)
   - `r_emailaddress` (endereço de email)

### 2.4 Obter Credenciais

- **Client ID:** Copie o Client ID da aplicação
- **Client Secret:** Copie o Client Secret da aplicação

## 3. Configuração no Projeto

### 3.1 Atualizar Arquivo de Configuração

Edite o arquivo `config/social_auth.php`:

```php
<?php

return [
    'google' => [
        'client_id' => 'SEU_GOOGLE_CLIENT_ID',
        'client_secret' => 'SEU_GOOGLE_CLIENT_SECRET',
        'redirect_uri' => 'http://localhost/ProjetoIntegradorFerraz-mvc/public/auth/google/callback',
        // ... outras configurações
    ],
    
    'linkedin' => [
        'client_id' => 'SEU_LINKEDIN_CLIENT_ID',
        'client_secret' => 'SEU_LINKEDIN_CLIENT_SECRET',
        'redirect_uri' => 'http://localhost/ProjetoIntegradorFerraz-mvc/public/auth/linkedin/callback',
        // ... outras configurações
    ]
];
```

### 3.2 Executar Script SQL

Execute o script `database_social_auth.sql` para adicionar os campos necessários:

```bash
mysql -u seu_usuario -p ferraz_conecta < database_social_auth.sql
```

## 4. Configuração para Produção

### 4.1 URLs de Redirecionamento

Para produção, atualize as URLs de redirecionamento em:
- Google Cloud Console
- LinkedIn Developer Portal
- Arquivo `config/social_auth.php`

### 4.2 HTTPS

Certifique-se de que seu servidor use HTTPS em produção, pois as APIs do Google e LinkedIn requerem conexões seguras.

## 5. Testando a Integração

1. Acesse a página de login ou cadastro
2. Clique em "Entrar com Google" ou "Entrar com LinkedIn"
3. Autorize o aplicativo
4. Verifique se o usuário foi criado/logado corretamente

## 6. Solução de Problemas

### Erro: "redirect_uri_mismatch"
- Verifique se as URLs de redirecionamento estão configuradas corretamente
- Certifique-se de que não há espaços extras ou caracteres especiais

### Erro: "invalid_client"
- Verifique se o Client ID e Client Secret estão corretos
- Certifique-se de que as credenciais estão ativas

### Erro: "access_denied"
- Verifique se os escopos necessários foram solicitados
- Certifique-se de que o aplicativo foi aprovado (LinkedIn)

## 7. Segurança

- Nunca compartilhe suas credenciais
- Use variáveis de ambiente para as credenciais em produção
- Monitore o uso das APIs regularmente
- Implemente rate limiting se necessário

## 8. Recursos Adicionais

- [Google OAuth 2.0 Documentation](https://developers.google.com/identity/protocols/oauth2)
- [LinkedIn OAuth 2.0 Documentation](https://docs.microsoft.com/en-us/linkedin/shared/authentication/authentication)
- [PHP cURL Documentation](https://www.php.net/manual/en/book.curl.php) 