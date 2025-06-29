<?php
session_start();
// Usando a variável de sessão correta que definimos
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 'candidato') {
    header('Location: entrar.php');
    exit();
}
include "navbar.php";
include "database.php";
?>

<main>
    <div class="form-container">
      <div class="form-card" style="text-align: left; max-width: 800px;">
        
        <?php if(isset($_GET['status']) && $_GET['status'] == 'sucesso'): ?>
            <div class="alert alert-success">Seu perfil foi atualizado com sucesso!</div>
        <?php elseif(isset($_GET['status']) && $_GET['status'] == 'erro'): ?>
            <div class="alert alert-danger">Ocorreu um erro ao atualizar seu perfil. Tente novamente.</div>
        <?php endif; ?>

        <h2>Perfil de <?php echo htmlspecialchars($_SESSION['nome_usuario']); ?></h2>
        <p class="form-subtitle">Este é o seu perfil profissional como ele será visto pelas empresas.</p>
        <hr>

        <?php
            $id_usuario = $_SESSION['id_usuario'];
            // Buscando todos os campos da tabela 'cadastro'
            $stmt = mysqli_prepare($conexao, "SELECT * FROM cadastro WHERE id = ?");
            mysqli_stmt_bind_param($stmt, "i", $id_usuario);
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);
            $usuario = mysqli_fetch_assoc($resultado);
            mysqli_stmt_close($stmt);

            if ($usuario) {
        ?>
            <h4>Dados de Contato</h4>
            <dl>
                <dt>Nome Completo:</dt><dd><?php echo htmlspecialchars($usuario['nome']); ?></dd>
                <dt>E-mail:</dt><dd><?php echo htmlspecialchars($usuario['email']); ?></dd>
                <dt>Telefone:</dt><dd><?php echo htmlspecialchars($usuario['telefone']); ?></dd>
            </dl>
            <hr>

            <h4>Resumo Profissional</h4>
            <p><?php echo nl2br(htmlspecialchars($usuario['resumo_profissional'])); ?></p>
            <hr>

            <h4>Experiência Profissional</h4>
            <p><?php echo nl2br(htmlspecialchars($usuario['experiencia_profissional'])); ?></p>
            <hr>
            
            <h4>Formação Acadêmica</h4>
            <p><?php echo nl2br(htmlspecialchars($usuario['formacao_academica'])); ?></p>
            <hr>

            <h4>Habilidades e Certificações</h4>
            <p><?php echo nl2br(htmlspecialchars($usuario['habilidades'])); ?></p>
            <p><?php echo nl2br(htmlspecialchars($usuario['certificacoes'])); ?></p>
            <hr>

            <h4>Currículo Anexado</h4>
            <?php if (!empty($usuario['caminho_cv'])): ?>
                <a href="<?php echo htmlspecialchars($usuario['caminho_cv']); ?>" class="btn btn-primary" target="_blank">Baixar Currículo (CV)</a>
            <?php else: ?>
                <p>Nenhum currículo enviado. Edite seu perfil para adicionar.</p>
            <?php endif; ?>

        <?php
            } else {
                echo "<p class='text-danger'>Erro: Não foi possível carregar os dados do perfil.</p>";
            }
        ?>
        
        <div style="margin-top: 2rem; border-top: 1px solid #eee; padding-top: 1rem; text-align: right;">
            <a href="editar_perfil.php" class="btn btn-info">Editar Perfil Completo</a>
            <a href="logout.php" class="btn btn-default">Sair</a>
        </div>
          
      </div>
    </div>
</main>

<?php include "footer.php"; ?>