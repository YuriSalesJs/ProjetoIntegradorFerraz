// Validações e Máscaras para Formulários - Ferraz Conecta

// Função para aplicar máscara de CPF
function aplicarMascaraCPF(input) {
    let value = input.value.replace(/\D/g, '');
    value = value.replace(/(\d{3})(\d)/, '$1.$2');
    value = value.replace(/(\d{3})(\d)/, '$1.$2');
    value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    input.value = value;
}

// Função para aplicar máscara de CNPJ
function aplicarMascaraCNPJ(input) {
    let value = input.value.replace(/\D/g, '');
    value = value.replace(/^(\d{2})(\d)/, '$1.$2');
    value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
    value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
    value = value.replace(/(\d{4})(\d)/, '$1-$2');
    input.value = value;
}

// Função para aplicar máscara de telefone
function aplicarMascaraTelefone(input) {
    let value = input.value.replace(/\D/g, '');
    if (value.length === 11) {
        value = value.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
    } else if (value.length === 10) {
        value = value.replace(/^(\d{2})(\d{4})(\d{4})$/, '($1) $2-$3');
    }
    input.value = value;
}

// Função para aplicar máscara de CEP
function aplicarMascaraCEP(input) {
    let value = input.value.replace(/\D/g, '');
    value = value.replace(/^(\d{5})(\d)/, '$1-$2');
    input.value = value;
}

// Função para validar CPF
function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]/g, '');
    
    if (cpf.length !== 11) return false;
    
    // Verifica se todos os dígitos são iguais
    if (/^(\d)\1{10}$/.test(cpf)) return false;
    
    // Validação do primeiro dígito verificador
    let soma = 0;
    for (let i = 0; i < 9; i++) {
        soma += parseInt(cpf.charAt(i)) * (10 - i);
    }
    let resto = 11 - (soma % 11);
    let digitoVerificador1 = resto < 2 ? 0 : resto;
    
    if (parseInt(cpf.charAt(9)) !== digitoVerificador1) return false;
    
    // Validação do segundo dígito verificador
    soma = 0;
    for (let i = 0; i < 10; i++) {
        soma += parseInt(cpf.charAt(i)) * (11 - i);
    }
    resto = 11 - (soma % 11);
    let digitoVerificador2 = resto < 2 ? 0 : resto;
    
    return parseInt(cpf.charAt(10)) === digitoVerificador2;
}

// Função para validar CNPJ
function validarCNPJ(cnpj) {
    cnpj = cnpj.replace(/[^\d]/g, '');
    
    if (cnpj.length !== 14) return false;
    
    // Verifica se todos os dígitos são iguais
    if (/^(\d)\1{13}$/.test(cnpj)) return false;
    
    // Validação do primeiro dígito verificador
    let multiplicadores1 = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    let soma = 0;
    for (let i = 0; i < 12; i++) {
        soma += parseInt(cnpj.charAt(i)) * multiplicadores1[i];
    }
    let resto = soma % 11;
    let digitoVerificador1 = resto < 2 ? 0 : 11 - resto;
    
    if (parseInt(cnpj.charAt(12)) !== digitoVerificador1) return false;
    
    // Validação do segundo dígito verificador
    let multiplicadores2 = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    soma = 0;
    for (let i = 0; i < 13; i++) {
        soma += parseInt(cnpj.charAt(i)) * multiplicadores2[i];
    }
    resto = soma % 11;
    let digitoVerificador2 = resto < 2 ? 0 : 11 - resto;
    
    return parseInt(cnpj.charAt(13)) === digitoVerificador2;
}

// Função para validar email
function validarEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

// Função para validar telefone
function validarTelefone(telefone) {
    const numero = telefone.replace(/\D/g, '');
    return numero.length >= 10 && numero.length <= 11;
}

// Função para validar senha
function validarSenha(senha) {
    // Mínimo 6 caracteres, pelo menos uma letra e um número
    const regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*?&]{6,}$/;
    return regex.test(senha);
}

// Função para mostrar mensagem de erro
function mostrarErro(campo, mensagem) {
    const errorDiv = document.getElementById(campo.id + '-error') || criarDivErro(campo);
    errorDiv.textContent = mensagem;
    errorDiv.style.display = 'block';
    campo.classList.add('is-invalid');
}

// Função para remover mensagem de erro
function removerErro(campo) {
    const errorDiv = document.getElementById(campo.id + '-error');
    if (errorDiv) {
        errorDiv.style.display = 'none';
    }
    campo.classList.remove('is-invalid');
    campo.classList.add('is-valid');
}

// Função para criar div de erro
function criarDivErro(campo) {
    const errorDiv = document.createElement('div');
    errorDiv.id = campo.id + '-error';
    errorDiv.className = 'invalid-feedback';
    errorDiv.style.display = 'none';
    
    const parent = campo.parentNode;
    parent.appendChild(errorDiv);
    
    return errorDiv;
}

// Função para validar formulário de cadastro de candidato
function validarFormularioCandidato(form) {
    let valido = true;
    
    // Validar nome
    const nome = form.querySelector('#nome');
    if (nome.value.trim().length < 3) {
        mostrarErro(nome, 'Nome deve ter pelo menos 3 caracteres');
        valido = false;
    } else {
        removerErro(nome);
    }
    
    // Validar email
    const email = form.querySelector('#email');
    if (!validarEmail(email.value)) {
        mostrarErro(email, 'Email inválido');
        valido = false;
    } else {
        removerErro(email);
    }
    
    // Validar senha
    const senha = form.querySelector('#senha');
    if (!validarSenha(senha.value)) {
        mostrarErro(senha, 'Senha deve ter pelo menos 6 caracteres, uma letra e um número');
        valido = false;
    } else {
        removerErro(senha);
    }
    
    // Validar telefone
    const telefone = form.querySelector('#telefone');
    if (!validarTelefone(telefone.value)) {
        mostrarErro(telefone, 'Telefone inválido');
        valido = false;
    } else {
        removerErro(telefone);
    }
    
    // Validar CPF
    const cpf = form.querySelector('#cpf');
    if (!validarCPF(cpf.value)) {
        mostrarErro(cpf, 'CPF inválido');
        valido = false;
    } else {
        removerErro(cpf);
    }
    
    // Validar data de nascimento
    const dataNascimento = form.querySelector('#data_nascimento');
    const data = new Date(dataNascimento.value);
    const hoje = new Date();
    const idade = hoje.getFullYear() - data.getFullYear();
    
    if (idade < 16 || idade > 100) {
        mostrarErro(dataNascimento, 'Data de nascimento inválida (idade entre 16 e 100 anos)');
        valido = false;
    } else {
        removerErro(dataNascimento);
    }
    
    // Validar endereço
    const endereco = form.querySelector('#endereco');
    if (endereco.value.trim().length < 10) {
        mostrarErro(endereco, 'Endereço deve ter pelo menos 10 caracteres');
        valido = false;
    } else {
        removerErro(endereco);
    }
    
    return valido;
}

// Função para validar formulário de cadastro de empresa
function validarFormularioEmpresa(form) {
    let valido = true;
    
    // Validar razão social
    const razaoSocial = form.querySelector('#razao_social');
    if (razaoSocial.value.trim().length < 3) {
        mostrarErro(razaoSocial, 'Razão social deve ter pelo menos 3 caracteres');
        valido = false;
    } else {
        removerErro(razaoSocial);
    }
    
    // Validar email
    const email = form.querySelector('#email');
    if (!validarEmail(email.value)) {
        mostrarErro(email, 'Email inválido');
        valido = false;
    } else {
        removerErro(email);
    }
    
    // Validar senha
    const senha = form.querySelector('#senha');
    if (!validarSenha(senha.value)) {
        mostrarErro(senha, 'Senha deve ter pelo menos 6 caracteres, uma letra e um número');
        valido = false;
    } else {
        removerErro(senha);
    }
    
    // Validar telefone
    const telefone = form.querySelector('#telefone');
    if (!validarTelefone(telefone.value)) {
        mostrarErro(telefone, 'Telefone inválido');
        valido = false;
    } else {
        removerErro(telefone);
    }
    
    // Validar CNPJ
    const cnpj = form.querySelector('#cnpj');
    if (!validarCNPJ(cnpj.value)) {
        mostrarErro(cnpj, 'CNPJ inválido');
        valido = false;
    } else {
        removerErro(cnpj);
    }
    
    // Validar endereço
    const endereco = form.querySelector('#endereco');
    if (endereco.value.trim().length < 10) {
        mostrarErro(endereco, 'Endereço deve ter pelo menos 10 caracteres');
        valido = false;
    } else {
        removerErro(endereco);
    }
    
    return valido;
}

// Função para inicializar máscaras e validações
function inicializarValidacoes() {
    // Aplicar máscaras
    const cpfs = document.querySelectorAll('input[id="cpf"]');
    cpfs.forEach(cpf => {
        cpf.addEventListener('input', function() {
            aplicarMascaraCPF(this);
        });
    });
    
    const cnpjs = document.querySelectorAll('input[id="cnpj"]');
    cnpjs.forEach(cnpj => {
        cnpj.addEventListener('input', function() {
            aplicarMascaraCNPJ(this);
        });
    });
    
    const telefones = document.querySelectorAll('input[id="telefone"]');
    telefones.forEach(telefone => {
        telefone.addEventListener('input', function() {
            aplicarMascaraTelefone(this);
        });
    });
    
    const ceps = document.querySelectorAll('input[id="cep"]');
    ceps.forEach(cep => {
        cep.addEventListener('input', function() {
            aplicarMascaraCEP(this);
        });
    });
    
    // Aplicar validações em tempo real
    const campos = document.querySelectorAll('input, textarea, select');
    campos.forEach(campo => {
        campo.addEventListener('blur', function() {
            validarCampo(this);
        });
        
        campo.addEventListener('input', function() {
            if (this.classList.contains('is-invalid')) {
                validarCampo(this);
            }
        });
    });
    
    // Validar formulários no submit
    const formCandidato = document.querySelector('form[action="/cadastro"]');
    if (formCandidato) {
        formCandidato.addEventListener('submit', function(e) {
            if (!validarFormularioCandidato(this)) {
                e.preventDefault();
            }
        });
    }
    
    const formEmpresa = document.querySelector('form[action="/cadastro-empresa"]');
    if (formEmpresa) {
        formEmpresa.addEventListener('submit', function(e) {
            if (!validarFormularioEmpresa(this)) {
                e.preventDefault();
            }
        });
    }
}

// Função para validar campo individual
function validarCampo(campo) {
    switch (campo.id) {
        case 'cpf':
            if (campo.value && !validarCPF(campo.value)) {
                mostrarErro(campo, 'CPF inválido');
            } else if (campo.value) {
                removerErro(campo);
            }
            break;
            
        case 'cnpj':
            if (campo.value && !validarCNPJ(campo.value)) {
                mostrarErro(campo, 'CNPJ inválido');
            } else if (campo.value) {
                removerErro(campo);
            }
            break;
            
        case 'email':
            if (campo.value && !validarEmail(campo.value)) {
                mostrarErro(campo, 'Email inválido');
            } else if (campo.value) {
                removerErro(campo);
            }
            break;
            
        case 'telefone':
            if (campo.value && !validarTelefone(campo.value)) {
                mostrarErro(campo, 'Telefone inválido');
            } else if (campo.value) {
                removerErro(campo);
            }
            break;
            
        case 'senha':
            if (campo.value && !validarSenha(campo.value)) {
                mostrarErro(campo, 'Senha deve ter pelo menos 6 caracteres, uma letra e um número');
            } else if (campo.value) {
                removerErro(campo);
            }
            break;
    }
}

// Inicializar quando o DOM estiver carregado
document.addEventListener('DOMContentLoaded', inicializarValidacoes); 