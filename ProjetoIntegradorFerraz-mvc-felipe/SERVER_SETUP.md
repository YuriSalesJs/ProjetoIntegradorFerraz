# Configuração do Servidor Web

Este guia explica como configurar o servidor web para usar a nova estrutura MVC.

## XAMPP (Recomendado)

### 1. Configuração do Apache

1. **Abra o arquivo de configuração do Apache:**
   - Navegue até `C:\xampp\apache\conf\httpd.conf`
   - Abra o arquivo em um editor de texto

2. **Altere o DocumentRoot:**
   ```apache
   # Antes
   DocumentRoot "C:/xampp/htdocs"
   
   # Depois
   DocumentRoot "C:/xampp/htdocs/ProjetoIntegradorFerraz/public"
   ```

3. **Altere o Directory:**
   ```apache
   # Antes
   <Directory "C:/xampp/htdocs">
   
   # Depois
   <Directory "C:/xampp/htdocs/ProjetoIntegradorFerraz/public">
   ```

4. **Verifique se o mod_rewrite está habilitado:**
   ```apache
   LoadModule rewrite_module modules/mod_rewrite.so
   ```

5. **Reinicie o Apache:**
   - No painel de controle do XAMPP, clique em "Stop" no Apache
   - Clique em "Start" para reiniciar

### 2. Teste a configuração

1. **Acesse no navegador:**
   ```
   http://localhost/
   ```

2. **Você deve ver a página inicial do Ferraz Conecta**

## Apache (Linux/Ubuntu)

### 1. Configuração do Virtual Host

1. **Crie um arquivo de configuração:**
   ```bash
   sudo nano /etc/apache2/sites-available/ferraz-conecta.conf
   ```

2. **Adicione a configuração:**
   ```apache
   <VirtualHost *:80>
       ServerName ferraz-conecta.local
       DocumentRoot /var/www/ProjetoIntegradorFerraz/public
       
       <Directory /var/www/ProjetoIntegradorFerraz/public>
           AllowOverride All
           Require all granted
       </Directory>
       
       ErrorLog ${APACHE_LOG_DIR}/ferraz-conecta_error.log
       CustomLog ${APACHE_LOG_DIR}/ferraz-conecta_access.log combined
   </VirtualHost>
   ```

3. **Habilite o site:**
   ```bash
   sudo a2ensite ferraz-conecta.conf
   sudo systemctl reload apache2
   ```

4. **Habilite o mod_rewrite:**
   ```bash
   sudo a2enmod rewrite
   sudo systemctl restart apache2
   ```

## Nginx

### 1. Configuração do Server Block

1. **Crie um arquivo de configuração:**
   ```bash
   sudo nano /etc/nginx/sites-available/ferraz-conecta
   ```

2. **Adicione a configuração:**
   ```nginx
   server {
       listen 80;
       server_name ferraz-conecta.local;
       root /var/www/ProjetoIntegradorFerraz/public;
       index index.php;

       location / {
           try_files $uri $uri/ /index.php?$query_string;
       }

       location ~ \.php$ {
           include snippets/fastcgi-php.conf;
           fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
       }
   }
   ```

3. **Habilite o site:**
   ```bash
   sudo ln -s /etc/nginx/sites-available/ferraz-conecta /etc/nginx/sites-enabled/
   sudo nginx -t
   sudo systemctl reload nginx
   ```

## Verificações Importantes

### 1. Permissões de Arquivo

Certifique-se de que os arquivos têm as permissões corretas:

```bash
# Linux/Ubuntu
sudo chown -R www-data:www-data /var/www/ProjetoIntegradorFerraz
sudo chmod -R 755 /var/www/ProjetoIntegradorFerraz
sudo chmod -R 777 /var/www/ProjetoIntegradorFerraz/public/uploads
```

### 2. Extensões PHP Necessárias

Verifique se as seguintes extensões estão habilitadas:

```bash
# Verificar extensões PHP
php -m | grep -E "(pdo|pdo_mysql|mbstring|openssl)"
```

### 3. Configuração do PHP

Edite o arquivo `php.ini`:

```ini
; Habilitar extensões
extension=pdo
extension=pdo_mysql
extension=mbstring
extension=openssl

; Configurações de upload
upload_max_filesize = 10M
post_max_size = 10M
max_execution_time = 300
```

## Testando a Instalação

### 1. Teste Básico

Acesse no navegador:
```
http://localhost/
```

Você deve ver a página inicial do Ferraz Conecta.

### 2. Teste de Rotas

Teste algumas rotas:
```
http://localhost/vagas
http://localhost/login
http://localhost/cadastro
```

### 3. Teste de Banco de Dados

Se houver erro de conexão com o banco:

1. **Verifique as credenciais** em `config/database.php`
2. **Teste a conexão** manualmente:
   ```php
   <?php
   $pdo = new PDO("mysql:host=localhost;dbname=seu_banco", "usuario", "senha");
   echo "Conexão OK!";
   ```

## Troubleshooting

### Erro 404
- Verifique se o mod_rewrite está habilitado
- Confirme se o DocumentRoot está correto
- Verifique se o arquivo `.htaccess` está na pasta `public/`

### Erro 500
- Verifique os logs de erro do Apache/Nginx
- Confirme se o PHP está configurado corretamente
- Verifique as permissões dos arquivos

### Erro de Autoload
- Execute `composer install` na raiz do projeto
- Verifique se a pasta `vendor/` foi criada
- Confirme se o arquivo `vendor/autoload.php` existe

### Erro de Banco de Dados
- Verifique se o MySQL/MariaDB está rodando
- Confirme as credenciais em `config/database.php`
- Teste a conexão manualmente

## URLs de Desenvolvimento

Após a configuração, você pode acessar:

- **Página Inicial:** `http://localhost/`
- **Vagas:** `http://localhost/vagas`
- **Login:** `http://localhost/login`
- **Cadastro:** `http://localhost/cadastro`
- **Painel Empresa:** `http://localhost/painel-empresa` 