# Validações e Máscaras Implementadas

## 📋 Visão Geral

Este documento descreve as validações em JavaScript e máscaras implementadas nos formulários do sistema Ferraz Conecta.

## 🎯 Funcionalidades Implementadas

### 1. Máscaras de Entrada

#### CPF
- **Formato**: XXX.XXX.XXX-XX
- **Validação**: Algoritmo oficial de validação de CPF
- **Campos**: Campo CPF no cadastro de candidatos

#### CNPJ
- **Formato**: XX.XXX.XXX/XXXX-XX
- **Validação**: Algoritmo oficial de validação de CNPJ
- **Campos**: Campo CNPJ no cadastro de empresas

#### Telefone
- **Formato**: (XX) XXXXX-XXXX ou (XX) XXXX-XXXX
- **Validação**: Aceita telefones com 10 ou 11 dígitos
- **Campos**: Campo telefone em todos os formulários

#### CEP
- **Formato**: XXXXX-XXX
- **Campos**: Campo CEP (quando implementado)

#### Salário
- **Formato**: R$ X.XXX,XX
- **Validação**: Valor entre R$ 0,01 e R$ 1.000.000,00
- **Campos**: Campo salário nos formulários de vagas

### 2. Validações de Campos

#### Email
- **Regex**: `/^[^\s@]+@[^\s@]+\.[^\s@]+$/`
- **Mensagem**: "Email inválido"

#### Senha
- **Requisitos**: Mínimo 6 caracteres, pelo menos uma letra e um número
- **Regex**: `/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*?&]{6,}$/`
- **Mensagem**: "Senha deve ter pelo menos 6 caracteres, uma letra e um número"

#### Nome/Razão Social
- **Requisitos**: Mínimo 3 caracteres
- **Mensagem**: "Nome deve ter pelo menos 3 caracteres" / "Razão social deve ter pelo menos 3 caracteres"

#### Endereço
- **Requisitos**: Mínimo 10 caracteres
- **Mensagem**: "Endereço deve ter pelo menos 10 caracteres"

#### Data de Nascimento
- **Requisitos**: Idade entre 16 e 100 anos
- **Mensagem**: "Data de nascimento inválida (idade entre 16 e 100 anos)"

#### Título da Vaga
- **Requisitos**: Mínimo 5 caracteres
- **Mensagem**: "Título deve ter pelo menos 5 caracteres"

#### Descrição da Vaga
- **Requisitos**: Mínimo 20 caracteres
- **Mensagem**: "Descrição deve ter pelo menos 20 caracteres"

#### Localização
- **Requisitos**: Mínimo 3 caracteres
- **Mensagem**: "Localização deve ter pelo menos 3 caracteres"

## 🎨 Estilos Visuais

### Indicadores Visuais
- **Campos obrigatórios**: Asterisco vermelho (*) nos labels
- **Campos válidos**: Borda verde e ícone de sucesso
- **Campos inválidos**: Borda vermelha e mensagem de erro
- **Animações**: Fade-in suave para mensagens de erro

### Classes CSS Utilizadas
- `.form-control.is-valid`: Campo válido
- `.form-control.is-invalid`: Campo inválido
- `.invalid-feedback`: Mensagem de erro
- `.valid-feedback`: Mensagem de sucesso
- `.form-label.required`: Label de campo obrigatório

## 📁 Arquivos JavaScript

### 1. `public/js/form-validation.js`
- Validações gerais para todos os formulários
- Máscaras para CPF, CNPJ, telefone e CEP
- Validações de email, senha, nome, endereço
- Funções de exibição de erros e sucessos

### 2. `public/js/vagas-validation.js`
- Validações específicas para formulários de vagas
- Máscara de salário
- Validações de título, descrição, salário e localização

## 🔧 Como Usar

### Inclusão Automática
Os scripts são incluídos automaticamente em todas as páginas através do layout base (`app/Views/layouts/base.php`).

### Validação Manual
Para validar um campo manualmente:
```javascript
validarCampo(document.getElementById('cpf'));
```

### Aplicar Máscara Manualmente
```javascript
aplicarMascaraCPF(document.getElementById('cpf'));
```

## 📝 Formulários Atualizados

### Cadastro de Candidato (`/cadastro`)
- ✅ CPF com máscara e validação
- ✅ Telefone com máscara e validação
- ✅ Email com validação
- ✅ Senha com validação
- ✅ Nome com validação
- ✅ Data de nascimento com validação
- ✅ Endereço com validação

### Cadastro de Empresa (`/cadastro-empresa`)
- ✅ CNPJ com máscara e validação
- ✅ Telefone com máscara e validação
- ✅ Email com validação
- ✅ Senha com validação
- ✅ Razão social com validação
- ✅ Endereço com validação

### Login (`/login` e `/login-empresa`)
- ✅ Email com validação
- ✅ Senha com validação
- ✅ Tipo de conta obrigatório

### Perfil do Candidato (`/perfil`)
- ✅ Telefone com máscara e validação
- ✅ Nome com validação
- ✅ Endereço com validação

### Criação de Vaga (`/vagas/criar`)
- ✅ Título com validação
- ✅ Descrição com validação
- ✅ Salário com máscara e validação
- ✅ Localização com validação

### Edição de Vaga (`/vagas/editar`)
- ✅ Título com validação
- ✅ Descrição com validação
- ✅ Salário com máscara e validação
- ✅ Localização com validação

## 🚀 Benefícios

1. **Experiência do Usuário**: Feedback imediato sobre erros
2. **Prevenção de Erros**: Validação antes do envio
3. **Formatação Automática**: Máscaras facilitam a digitação
4. **Validação Robusta**: Algoritmos oficiais para CPF e CNPJ
5. **Interface Moderna**: Animações e indicadores visuais
6. **Acessibilidade**: Mensagens claras e indicadores visuais

## 🔄 Próximas Melhorias

- [ ] Validação de CEP com API ViaCEP
- [ ] Validação de força da senha em tempo real
- [ ] Máscara para campos de data
- [ ] Validação de arquivos de upload
- [ ] Integração com validações do backend 