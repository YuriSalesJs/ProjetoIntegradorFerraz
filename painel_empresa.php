<?php
// Inicia a sessão no topo de tudo
session_start();

// Verifica se a empresa está logada. Se não, redireciona para a página de login da empresa.
if (!isset($_SESSION['id_empresa'])) {
    header('Location: entrar_empresa.php');
    exit(); // Para a execução do script
}

// Inclui os arquivos necessários
include "navbar.php";
include "database.php";

// Pega o ID e o nome da empresa da sessão para usar na página
$id_empresa = $_SESSION['id_empresa'];
$nome_fantasia = $_SESSION['nome_fantasia'];
?>

<main class="container" style="padding-top: 2rem;">

    <div class="painel-header" style="margin-bottom: 2rem; padding: 1rem; background-color: #f4f4f4; border-radius: 8px;">
        <h1>Painel da Empresa</h1>
        <h2>Bem-vinda, <?php echo htmlspecialchars($nome_fantasia); ?>!</h2>
    </div>

    <?php if(isset($_GET['status'])): ?>
        <?php if($_GET['status'] == 'vaga_cadastrada'): ?>
            <div class="alert alert-success"><strong>Sucesso!</strong> Sua vaga foi cadastrada e já está visível para os candidatos.</div>
        <?php elseif($_GET['status'] == 'vaga_editada'): ?>
            <div class="alert alert-success"><strong>Sucesso!</strong> A vaga foi atualizada.</div>
        <?php elseif($_GET['status'] == 'vaga_excluida'): ?>
            <div class="alert alert-success"><strong>Sucesso!</strong> A vaga foi excluída.</div>
        <?php elseif(strpos($_GET['status'], 'erro') !== false): ?>
            <div class="alert alert-danger">Ocorreu um erro ao processar sua solicitação. Tente novamente.</div>
        <?php endif; ?>
    <?php endif; ?>
    
    <div class="acoes" style="margin-bottom: 2rem;">
        <a href="cadastrar_vaga.php" class="btn btn-primary" style="font-size: 1.2rem; padding: 0.8rem 1.5rem;">+ Cadastrar Nova Vaga</a>
    </div>

    <div class="lista-vagas">
        <h3>Suas Vagas Cadastradas</h3>
        <hr>
        
        <?php
            // Prepara uma consulta segura para buscar as vagas que pertencem a esta empresa
            $stmt = mysqli_prepare($conexao, "SELECT id, titulo, localizacao, data_postagem FROM vagas WHERE empresa_id = ? ORDER BY data_postagem DESC");
            mysqli_stmt_bind_param($stmt, "i", $id_empresa);
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);

            // Verifica se a empresa tem alguma vaga cadastrada
            if (mysqli_num_rows($resultado) > 0) {
        ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Título da Vaga</th>
                            <th>Localização</th>
                            <th>Data de Publicação</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // Loop para exibir cada vaga em uma linha da tabela
                            while ($vaga = mysqli_fetch_assoc($resultado)) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($vaga['titulo']) . "</td>";
                                echo "<td>" . htmlspecialchars($vaga['localizacao']) . "</td>";
                                echo "<td>" . date('d/m/Y', strtotime($vaga['data_postagem'])) . "</td>";
                                echo "<td>";
                                echo "<a href='editar_vaga.php?id=" . $vaga['id'] . "' class='btn btn-sm btn-info'>Editar</a> ";
                                echo "<a href='excluir_vaga.php?id=" . $vaga['id'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Tem certeza que deseja excluir esta vaga?\");'>Excluir</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
            } else {
                // Mensagem exibida se a empresa não tiver nenhuma vaga
                echo "<p>Você ainda não cadastrou nenhuma vaga. Clique no botão acima para começar!</p>";
            }
            mysqli_stmt_close($stmt);
        ?>
    </div>

</main>

<?php include "footer.php"; ?>