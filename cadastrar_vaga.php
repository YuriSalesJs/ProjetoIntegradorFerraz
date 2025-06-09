<?php
// Inicia a sessão
session_start();

// Verifica se é uma empresa que está logada, se não, redireciona
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 'empresa') {
    header('Location: entrar_empresa.php');
    exit();
}

include "navbar.php";
?>

<main>
    <div class="form-container">
        <div class="form-card" style="max-width: 800px;">
            <h2>Cadastrar Nova Vaga</h2>
            <p class="form-subtitle">Preencha os detalhes da oportunidade abaixo</p>

            <form action="processa_cadastro_vaga.php" method="post" style="text-align: left;">
                <label for="titulo">Título da Vaga:</label>
                <input type="text" id="titulo" name="titulo" class="form-input" placeholder="Ex: Auxiliar Administrativo" required>

                <label for="descricao_completa">Descrição Completa da Vaga:</label>
                <textarea id="descricao_completa" name="descricao_completa" class="form-input" rows="6" placeholder="Descreva as responsabilidades, atividades do dia a dia, etc." required></textarea>

                <label for="salario">Salário:</label>
                <input type="text" id="salario" name="salario" class="form-input" placeholder="Ex: R$ 2.500,00 ou A combinar" required>

                <label for="localizacao">Localização:</label>
                <input type="text" id="localizacao" name="localizacao" class="form-input" placeholder="Ex: Ferraz de Vasconcelos - SP ou Remoto" required>

                <label for="tipo_contrato">Tipo de Contrato:</label>
                <input type="text" id="tipo_contrato" name="tipo_contrato" class="form-input" placeholder="Ex: CLT, PJ, Temporário" required>

                <label for="escolaridade">Escolaridade Mínima:</label>
                <input type="text" id="escolaridade" name="escolaridade" class="form-input" placeholder="Ex: Ensino Médio Completo" required>
                
                <label for="experiencia">Experiência Necessária:</label>
                <input type="text" id="experiencia" name="experiencia" class="form-input" placeholder="Ex: Não exige, 6 meses, 2 anos" required>

                <button type="submit" class="btn btn-primary" style="margin-top: 1rem;">Publicar Vaga</button>
            </form>
        </div>
    </div>
</main>

<?php include "footer.php"; ?>