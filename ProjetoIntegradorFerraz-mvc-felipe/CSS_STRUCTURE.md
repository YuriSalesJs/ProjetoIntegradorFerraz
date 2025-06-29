# Estrutura CSS Organizada

## 📁 Arquivos CSS

### 1. **style.css** - Estilos Gerais
Localização: `public/css/style.css`

**Conteúdo:**
- Estilos base do body
- Navbar e footer
- Utilitários (cores, botões)
- Animações básicas
- Responsividade geral

### 2. **components.css** - Componentes Específicos
Localização: `public/css/components.css`

**Conteúdo:**
- Carrossel
- Cards de vagas
- Estatísticas
- Seção de busca
- Alertas e mensagens
- Responsividade específica

## 🎨 Como Usar

### 1. **Layout Base**
O arquivo `app/Views/layouts/base.php` já inclui automaticamente:
```html
<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet" href="/css/components.css">
```

### 2. **CSS Adicional**
Para páginas específicas, você pode adicionar CSS extra:
```php
$extraCSS = '<link rel="stylesheet" href="/css/pagina-especifica.css">';
return $this->render('minha-view', ['extraCSS' => $extraCSS]);
```

### 3. **Classes Disponíveis**

#### **Carrossel:**
- `.carousel` - Container do carrossel
- `.carousel-caption` - Texto sobreposto
- `.carousel-item img` - Imagens do carrossel

#### **Cards:**
- `.card` - Card básico
- `.card h3` - Título do card
- `.card .details` - Lista de detalhes
- `.cards-container` - Container dos cards

#### **Estatísticas:**
- `.estatisticas-container` - Container das estatísticas
- `.estatistica-item` - Item individual
- `.estatistica-numero` - Número da estatística
- `.estatistica-label` - Label da estatística

#### **Busca:**
- `.search-section` - Seção de busca
- `.search-form` - Formulário de busca
- `.input-group` - Grupo de input

#### **Títulos:**
- `.page-title` - Título principal da página
- `.page-subtitle` - Subtítulo da página

#### **Mensagens:**
- `.alert` - Alerta básico
- `.alert-success` - Alerta de sucesso
- `.alert-danger` - Alerta de erro
- `.alert-warning` - Alerta de aviso
- `.alert-info` - Alerta informativo

#### **Utilitários:**
- `.btn-primary` - Botão primário
- `.text-primary` - Texto primário
- `.bg-primary` - Fundo primário
- `.fade-in` - Animação de entrada
- `.loading` - Indicador de carregamento

## 📱 Responsividade

### **Breakpoints:**
- **Desktop:** > 768px
- **Tablet:** 768px - 480px
- **Mobile:** < 480px

### **Classes Responsivas:**
- Grid automático para cards
- Flexbox para estatísticas
- Imagens responsivas
- Texto adaptativo

## 🎯 Benefícios da Separação

### ✅ **Organização:**
- CSS separado do HTML
- Fácil manutenção
- Código limpo

### ✅ **Performance:**
- CSS cacheado pelo navegador
- Carregamento mais rápido
- Menos código repetido

### ✅ **Manutenibilidade:**
- Mudanças centralizadas
- Reutilização de estilos
- Padrões consistentes

### ✅ **Escalabilidade:**
- Fácil adição de novos estilos
- Componentes modulares
- Estrutura preparada para crescimento

## 🔧 Como Adicionar Novos Estilos

### 1. **Estilos Gerais**
Adicione em `public/css/style.css`:
```css
/* Novo estilo geral */
.minha-classe {
    propriedade: valor;
}
```

### 2. **Componentes Específicos**
Adicione em `public/css/components.css`:
```css
/* ===== MEU COMPONENTE ===== */
.meu-componente {
    propriedade: valor;
}
```

### 3. **CSS Específico de Página**
Crie um novo arquivo `public/css/pagina-especifica.css`:
```css
/* Estilos específicos da página */
.pagina-especifica {
    propriedade: valor;
}
```

## 🎨 Paleta de Cores

### **Primária:**
- `#007bff` - Azul principal
- `#0056b3` - Azul hover

### **Secundária:**
- `#6c757d` - Cinza
- `#28a745` - Verde (sucesso)
- `#dc3545` - Vermelho (erro)
- `#ffc107` - Amarelo (aviso)
- `#17a2b8` - Azul claro (info)

### **Neutras:**
- `#333` - Texto principal
- `#666` - Texto secundário
- `#f8f9fa` - Fundo claro
- `#e9ecef` - Fundo médio

## 📋 Checklist de Implementação

- [x] CSS separado do HTML
- [x] Layout base criado
- [x] Componentes organizados
- [x] Responsividade implementada
- [x] Paleta de cores definida
- [x] Classes utilitárias criadas
- [x] Documentação criada

**Resultado: CSS organizado, limpo e fácil de manter! 🎉** 