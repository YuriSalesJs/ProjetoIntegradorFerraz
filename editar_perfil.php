<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: entrar.php');
    exit();
}
include "navbar.php";
include "database.php";

// Busca os dados atuais do usuário para preencher o formulário
$id_usuario = $_SESSION['id'];
$stmt = mysqli_prepare($conexao, "SELECT nome, email, telefone, cpf FROM cadastro WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id_usuario);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$usuario = mysqli_fetch_assoc($resultado);
mysqli_stmt_close($stmt);
?>

<main>
    <div class="form-container">
      <div class="form-card" style="max-width: 600px;">
        <h2>Editar Meus Dados</h2>
        <p class="form-subtitle">Altere as informações desejadas e clique em salvar.</p>
        
        <form action="processa_edicao.php" method="post">
          <label for="nome">Nome Completo:</label>
          <input type="text" id="nome" name="nome" class="form-input" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
          
          <label for="email">E-mail:</label>
          <input type="email" id="email" name="email" class="form-input" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
          
          <label for="telefone">Telefone:</label>
          <input type="tel" id="telefone" name="telefone" class="form-input" value="<?php echo htmlspecialchars($usuario['telefone']); ?>">
          
          <label for="cpf">CPF (não pode ser alterado):</label>
          <input type="text" id="cpf" name="cpf" class="form-input" value="<?php echo htmlspecialchars($usuario['cpf']); ?>" readonly style="background-color: #eee;">
          
          <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>
        <a href="perfil.php" style="display: block; margin-top: 1rem; text-align: center;">Cancelar</a>
      </div>
    </div>
</main>

<?php include "footer.php"; ?>