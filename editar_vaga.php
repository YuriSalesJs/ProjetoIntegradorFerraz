<?php
session_start();
if (!isset($_SESSION['id_empresa'])) {
    header('Location: entrar_empresa.php');
    exit();
}
include "navbar.php";
include "database.php";

// Segurança: Pega o ID da vaga e garante que ela pertence à empresa logada
$id_vaga = $_GET['id'];
$id_empresa = $_SESSION['id_empresa'];

$stmt = mysqli_prepare($conexao, "SELECT * FROM vagas WHERE id = ? AND empresa_id = ?");
mysqli_stmt_bind_param($stmt, "ii", $id_vaga, $id_empresa);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$vaga = mysqli_fetch_assoc($resultado);

// Se a vaga não for encontrada ou não pertencer à empresa, redireciona
if (!$vaga) {
    header('Location: painel_empresa.php?status=erro');
    exit();
}
?>

<main>
    <div class="form-container">
        <div class="form-card" style="max-width: 800px;">
            <h2>Editar Vaga: <?php echo htmlspecialchars($vaga['titulo']); ?></h2>
            <form action="processa_edicao_vaga.php" method="post" style="text-align: left;">
                <input type="hidden" name="id_vaga" value="<?php echo $vaga['id']; ?>">
                
                <label for="titulo">Título da Vaga:</label>
                <input type="text" id="titulo" name="titulo" class="form-input" value="<?php echo htmlspecialchars($vaga['titulo']); ?>" required>

                <label for="descricao_completa">Descrição Completa da Vaga:</label>
                <textarea id="descricao_completa" name="descricao_completa" class="form-input" rows="6" required><?php echo htmlspecialchars($vaga['descricao_completa']); ?></textarea>

                <label for="salario">Salário:</label>
                <input type="text" id="salario" name="salario" class="form-input" value="<?php echo htmlspecialchars($vaga['salario']); ?>" required>

                <label for="localizacao">Localização:</label>
                <input type="text" id="localizacao" name="localizacao" class="form-input" value="<?php echo htmlspecialchars($vaga['localizacao']); ?>" required>

                <label for="tipo_contrato">Tipo de Contrato:</label>
                <input type="text" id="tipo_contrato" name="tipo_contrato" class="form-input" value="<?php echo htmlspecialchars($vaga['tipo_contrato']); ?>" required>

                <label for="escolaridade">Escolaridade Mínima:</label>
                <input type="text" id="escolaridade" name="escolaridade" class="form-input" value="<?php echo htmlspecialchars($vaga['escolaridade']); ?>" required>
                
                <label for="experiencia">Experiência Necessária:</label>
                <input type="text" id="experiencia" name="experiencia" class="form-input" value="<?php echo htmlspecialchars($vaga['exp']); ?>" required>

                <button type="submit" class="btn btn-primary" style="margin-top: 1rem;">Salvar Alterações</button>
            </form>
        </div>
    </div>
</main>

<?php include "footer.php"; ?>