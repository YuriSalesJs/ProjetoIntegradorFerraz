<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: entrar.php');
    exit();
}
include "navbar.php";
include "database.php";
?>

<main>
    <div class="form-container">
      <div class="form-card" style="text-align: left; max-width: 600px;">
        
        <?php if(isset($_GET['status']) && $_GET['status'] == 'sucesso'): ?>
            <div class="alert alert-success">Dados atualizados com sucesso!</div>
        <?php elseif(isset($_GET['status']) && $_GET['status'] == 'erro'): ?>
            <div class="alert alert-danger">Ocorreu um erro ao atualizar os dados. Tente novamente.</div>
        <?php endif; ?>

        <h2>Perfil de <?php echo htmlspecialchars($_SESSION['nome']); ?></h2>
        <p class="form-subtitle">Estas são suas informações cadastradas.</p>
        <hr>

        <?php
            $id_usuario = $_SESSION['id'];
            $stmt = mysqli_prepare($conexao, "SELECT nome, email, telefone, cpf, nascimento FROM cadastro WHERE id = ?");
            mysqli_stmt_bind_param($stmt, "i", $id_usuario);
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($resultado) > 0) {
                $usuario = mysqli_fetch_assoc($resultado);
                echo "<dl>";
                echo "<dt>Nome Completo:</dt><dd>" . htmlspecialchars($usuario['nome']) . "</dd>";
                echo "<dt>E-mail:</dt><dd>" . htmlspecialchars($usuario['email']) . "</dd>";
                echo "<dt>Telefone:</dt><dd>" . htmlspecialchars($usuario['telefone']) . "</dd>";
                echo "<dt>CPF:</dt><dd>" . htmlspecialchars($usuario['cpf']) . "</dd>";
                echo "<dt>Data de Nascimento:</dt><dd>" . date('d/m/Y', strtotime($usuario['nascimento'])) . "</dd>";
                echo "</dl>";
            } else {
                echo "<p class='text-danger'>Erro: Não foi possível encontrar os dados do usuário.</p>";
            }
            mysqli_stmt_close($stmt);
        ?>
        
        <a href="editar_perfil.php" class="btn btn-primary" style="margin-top: 1rem; background-color: #5bc0de; border-color: #46b8da;">Editar Dados</a>
        <a href="logout.php" class="btn btn-primary" style="margin-top: 1rem;">Sair</a>
          
      </div>
    </div>
</main>

<?php include "footer.php"; ?>