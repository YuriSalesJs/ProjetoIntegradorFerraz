<?php
session_start();
// CORREÇÃO: Usando a variável de sessão correta que definimos
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 'candidato') {
    header('Location: entrar.php');
    exit();
}
include "navbar.php";
include "database.php";

// Busca os dados atuais do usuário para preencher o formulário
$id_usuario = $_SESSION['id_usuario'];
// ATUALIZAÇÃO: Buscando todos os novos campos
$stmt = mysqli_prepare($conexao, "SELECT * FROM cadastro WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id_usuario);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$usuario = mysqli_fetch_assoc($resultado);
mysqli_stmt_close($stmt);
?>

<main>
    <div class="form-container">
      <div class="form-card" style="max-width: 800px;">
        <h2>Meu Perfil Profissional</h2>
        <p class="form-subtitle">Mantenha seus dados atualizados para aumentar suas chances.</p>
        
        <form action="processa_edicao.php" method="post" enctype="multipart/form-data" style="text-align: left;">
          
          <fieldset>
            <legend>Dados Pessoais</legend>
            <label for="nome">Nome Completo:</label>
            <input type="text" id="nome" name="nome" class="form-input" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
            
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" class="form-input" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
            
            <label for="telefone">Telefone:</label>
            <input type="tel" id="telefone" name="telefone" class="form-input" value="<?php echo htmlspecialchars($usuario['telefone']); ?>">
          </fieldset>
          
          <fieldset style="margin-top: 2rem;">
            <legend>Dados Profissionais</legend>
            <label for="resumo_profissional">Resumo Profissional (uma breve carta de apresentação):</label>
            <textarea id="resumo_profissional" name="resumo_profissional" class="form-input" rows="5"><?php echo htmlspecialchars($usuario['resumo_profissional']); ?></textarea>

            <label for="experiencia_profissional">Experiências Profissionais:</label>
            <textarea id="experiencia_profissional" name="experiencia_profissional" class="form-input" rows="5" placeholder="Liste suas experiências, da mais recente para a mais antiga."><?php echo htmlspecialchars($usuario['experiencia_profissional']); ?></textarea>
            
            <label for="formacao_academica">Formação Acadêmica:</label>
            <textarea id="formacao_academica" name="formacao_academica" class="form-input" rows="5" placeholder="Ex: Ensino Médio Completo - Escola XYZ (2020)&#10;Tecnólogo em Análise de Sistemas - Faculdade ABC (Cursando)"><?php echo htmlspecialchars($usuario['formacao_academica']); ?></textarea>

            <label for="certificacoes">Cursos e Certificações:</label>
            <textarea id="certificacoes" name="certificacoes" class="form-input" rows="5"><?php echo htmlspecialchars($usuario['certificacoes']); ?></textarea>

            <label for="habilidades">Principais Habilidades:</label>
            <textarea id="habilidades" name="habilidades" class="form-input" rows="5" placeholder="Ex: Pacote Office, Comunicação, Proatividade, etc."><?php echo htmlspecialchars($usuario['habilidades']); ?></textarea>
          </fieldset>

          <fieldset style="margin-top: 2rem;">
            <legend>Currículo (CV)</legend>
            <label for="curriculo">Enviar novo currículo (somente .pdf, .doc, .docx):</label>
            <input type="file" id="curriculo" name="curriculo" class="form-input">
            <?php if (!empty($usuario['caminho_cv'])): ?>
                <p>Você já tem um currículo salvo. <a href="<?php echo htmlspecialchars($usuario['caminho_cv']); ?>" target="_blank">Ver currículo atual</a>. Enviar um novo irá substituí-lo.</p>
            <?php endif; ?>
          </fieldset>
          
          <button type="submit" class="btn btn-primary" style="margin-top: 1rem;">Salvar Alterações no Perfil</button>
        </form>
        <a href="perfil.php" style="display: block; margin-top: 1rem; text-align: center;">Cancelar</a>
      </div>
    </div>
</main>

<?php include "footer.php"; ?>