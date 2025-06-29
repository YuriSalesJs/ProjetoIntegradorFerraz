# Solução para Erro de Conexão com Banco de Dados

## Erro: `auth_gssapi_client`

Este erro ocorre quando o MySQL está configurado para usar um método de autenticação incompatível com o PDO.

## Solução Rápida

### 1. Teste a conexão
Acesse: `http://localhost/test_connection.php`

### 2. Crie o banco de dados
Execute o arquivo `database.sql` no phpMyAdmin:

1. Acesse `http://localhost/phpmyadmin`
2. Clique em "SQL"
3. Cole o conteúdo do arquivo `database.sql`
4. Clique em "Executar"

### 3. Se ainda houver erro, altere o método de autenticação

No phpMyAdmin, execute:

```sql
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '';
FLUSH PRIVILEGES;
```

### 4. Teste a aplicação
Acesse: `http://localhost/`

## Solução Alternativa (mysqli)

Se o PDO continuar com problemas, você pode usar mysqli temporariamente:

1. Renomeie `app/Models/Database.php` para `app/Models/Database.php.bak`
2. Renomeie `app/Models/DatabaseMysqli.php` para `app/Models/Database.php`
3. Teste a aplicação

## Verificações Importantes

### 1. MySQL está rodando?
- No XAMPP Control Panel, verifique se MySQL está "Running"

### 2. Credenciais corretas?
- Verifique o arquivo `config/database.php`
- Usuário: `root`
- Senha: `` (vazia)
- Banco: `ferraz_conecta`

### 3. Banco existe?
- No phpMyAdmin, verifique se o banco `ferraz_conecta` existe
- Se não existir, execute o `database.sql`

## Dados de Teste

Após criar o banco, você pode testar com:

**Candidato:**
- Email: `joao@exemplo.com`
- Senha: `123456`

**Empresa:**
- Email: `empresa1@exemplo.com`
- Senha: `123456`

## URLs para Teste

- Página inicial: `http://localhost/`
- Vagas: `http://localhost/vagas`
- Login: `http://localhost/login`
- Cadastro: `http://localhost/cadastro`

## Se nada funcionar

1. Verifique os logs de erro do Apache
2. Confirme se o mod_rewrite está habilitado
3. Verifique se o DocumentRoot está apontando para a pasta `public/`
4. Teste com uma conexão simples em um arquivo PHP separado 