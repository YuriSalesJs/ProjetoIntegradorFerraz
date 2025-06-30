// Validações específicas para formulários de vagas

// Função para aplicar máscara de salário
function aplicarMascaraSalario(input) {
    let value = input.value.replace(/\D/g, '');
    value = (parseFloat(value) / 100).toFixed(2);
    value = value.replace('.', ',');
    value = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
    input.value = value;
}

// Função para validar salário
function validarSalario(salario) {
    const valor = parseFloat(salario.replace(/\./g, '').replace(',', '.'));
    return valor > 0 && valor <= 1000000; // Máximo 1 milhão
}

// Função para validar formulário de vaga
function validarFormularioVaga(form) {
    let valido = true;
    
    // Validar título
    const titulo = form.querySelector('#titulo');
    if (titulo.value.trim().length < 5) {
        mostrarErro(titulo, 'Título deve ter pelo menos 5 caracteres');
        valido = false;
    } else {
        removerErro(titulo);
    }
    
    // Validar descrição
    const descricao = form.querySelector('#descricao_completa');
    if (descricao.value.trim().length < 20) {
        mostrarErro(descricao, 'Descrição deve ter pelo menos 20 caracteres');
        valido = false;
    } else {
        removerErro(descricao);
    }
    
    // Validar salário
    const salario = form.querySelector('#salario');
    if (salario.value && !validarSalario(salario.value)) {
        mostrarErro(salario, 'Salário deve ser maior que zero e menor que R$ 1.000.000');
        valido = false;
    } else if (salario.value) {
        removerErro(salario);
    }
    
    // Validar localização
    const localizacao = form.querySelector('#localizacao');
    if (localizacao.value.trim().length < 3) {
        mostrarErro(localizacao, 'Localização deve ter pelo menos 3 caracteres');
        valido = false;
    } else {
        removerErro(localizacao);
    }
    
    return valido;
}

// Função para inicializar validações de vagas
function inicializarValidacoesVagas() {
    // Aplicar máscara de salário
    const salarios = document.querySelectorAll('input[id="salario"]');
    salarios.forEach(salario => {
        salario.addEventListener('input', function() {
            aplicarMascaraSalario(this);
        });
    });
    
    // Validar formulários de vaga no submit
    const formVaga = document.querySelector('form[action="/vagas/criar"]');
    if (formVaga) {
        formVaga.addEventListener('submit', function(e) {
            if (!validarFormularioVaga(this)) {
                e.preventDefault();
            }
        });
    }
    
    const formEditarVaga = document.querySelector('form[action*="/vagas/editar"]');
    if (formEditarVaga) {
        formEditarVaga.addEventListener('submit', function(e) {
            if (!validarFormularioVaga(this)) {
                e.preventDefault();
            }
        });
    }
}

// Inicializar quando o DOM estiver carregado
document.addEventListener('DOMContentLoaded', inicializarValidacoesVagas); 