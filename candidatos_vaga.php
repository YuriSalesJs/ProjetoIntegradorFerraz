<?php
session_start();
// Segurança: Garante que apenas uma empresa logada possa acessar esta página
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 'empresa') {
    header('Location: entrar_empresa.php');
    exit();
}

include "navbar.php";
include "database.php";

$id_empresa = $_SESSION['id_empresa'];
$vaga = null;
$candidatos = [];

// 1. CORREÇÃO: Verificando o parâmetro 'id' que vem da URL, em vez de 'id_vaga'
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_vaga = $_GET['id'];

    // Primeira consulta para buscar o título da vaga e confirmar que ela pertence à empresa
    $stmt_vaga = mysqli_prepare($conexao, "SELECT titulo FROM vagas WHERE id = ? AND empresa_id = ?");
    mysqli_stmt_bind_param($stmt_vaga, "ii", $id_vaga, $id_empresa);
    mysqli_stmt_execute($stmt_vaga);
    $resultado_vaga = mysqli_stmt_get_result($stmt_vaga);
    
    // Se a vaga for válida e pertencer à empresa, busca os candidatos
    if (mysqli_num_rows($resultado_vaga) == 1) {
        $vaga = mysqli_fetch_assoc($resultado_vaga);

        // 2. Consulta principal com JOIN para buscar os dados dos candidatos
        $sql_candidatos = "SELECT u.id AS id_candidato, u.nome, u.email, u.telefone, c.data_candidatura 
                           FROM candidaturas AS c
                           JOIN cadastro AS u ON c.id_usuario = u.id
                           WHERE c.id_vaga = ?
                           ORDER BY c.data_candidatura DESC";

        $stmt_candidatos = mysqli_prepare($conexao, $sql_candidatos);
        mysqli_stmt_bind_param($stmt_candidatos, "i", $id_vaga);
        mysqli_stmt_execute($stmt_candidatos);
        $resultado_candidatos = mysqli_stmt_get_result($stmt_candidatos);

        while ($row = mysqli_fetch_assoc($resultado_candidatos)) {
            $candidatos[] = $row;
        }
        mysqli_stmt_close($stmt_candidatos);
    }
    mysqli_stmt_close($stmt_vaga);
}
?>

<main class="container" style="padding-top: 2rem;">
    
    <?php if ($vaga): // Se a vaga foi encontrada e pertence à empresa, mostra o conteúdo ?>
    
        <a href="painel_empresa.php" style="margin-bottom: 1rem; display: inline-block;">&larr; Voltar para o Painel</a>
        <h1>Candidatos para a Vaga</h1>
        <h2 style="font-weight: normal; color: #555;"><?php echo htmlspecialchars($vaga['titulo']); ?></h2>
        <hr>

        <?php if (empty($candidatos)): ?>
            <div class="alert alert-info">Ainda não há candidatos para esta vaga.</div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nome do Candidato</th>
                            <th>E-mail de Contato</th>
                            <th>Telefone</th>
                            <th>Data da Candidatura</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($candidatos as $candidato): ?>
                            <tr>
                                <td>
                                    <a href="perfil_candidato.php?id=<?php echo $candidato['id_candidato']; ?>">
                                        <?php echo htmlspecialchars($candidato['nome']); ?>
                                    </a>
                                </td>
                                <td><?php echo htmlspecialchars($candidato['email']); ?></td>
                                <td><?php echo htmlspecialchars($candidato['telefone']); ?></td>
                                <td><?php echo date('d/m/Y H:i', strtotime($candidato['data_candidatura'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

    <?php else: // Se a vaga não existe ou não pertence à empresa ?>

        <div class="alert alert-danger text-center">
            <h2>Acesso Negado ou Vaga não Encontrada</h2>
            <p>Você não tem permissão para ver os candidatos desta vaga ou a vaga não existe.</p>
            <a href="painel_empresa.php" class="btn btn-primary">Voltar para o Painel</a>
        </div>

    <?php endif; ?>
</main>

<?php include "footer.php"; ?>