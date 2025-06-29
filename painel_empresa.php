<?php
// Inicia a sessão no topo de tudo
session_start();

// Verifica se a empresa está logada.
if (!isset($_SESSION['id_empresa'])) {
    header('Location: entrar_empresa.php');
    exit();
}

include "navbar.php";
include "database.php";

$id_empresa = $_SESSION['id_empresa'];
$nome_fantasia = $_SESSION['nome_fantasia'];
?>

<main class="container" style="padding-top: 2rem;">

    <div class="painel-header">
        <h1>Painel da Empresa</h1>
        <h2>Bem-vinda, <?php echo htmlspecialchars($nome_fantasia); ?>!</h2>
    </div>

    <?php if(isset($_GET['status'])): ?>
        <?php if($_GET['status'] == 'vaga_cadastrada'): ?>
            <div class="alert alert-success"><strong>Sucesso!</strong> Sua vaga foi cadastrada.</div>
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
            // VERSÃO CORRIGIDA DA CONSULTA SQL com LEFT JOIN e COUNT
            $sql = "SELECT 
                        v.id, 
                        v.titulo, 
                        v.localizacao, 
                        v.data_postagem,
                        COUNT(c.id) AS total_candidatos
                    FROM 
                        vagas AS v
                    LEFT JOIN 
                        candidaturas AS c ON v.id = c.id_vaga
                    WHERE 
                        v.empresa_id = ?
                    GROUP BY 
                        v.id
                    ORDER BY 
                        v.data_postagem DESC";
            
            $stmt = mysqli_prepare($conexao, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id_empresa);
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($resultado) > 0) {
        ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Título da Vaga</th>
                            <th>Localização</th>
                            <th>Candidaturas</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($vaga = mysqli_fetch_assoc($resultado)) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($vaga['titulo']) . "</td>";
                                echo "<td>" . htmlspecialchars($vaga['localizacao']) . "</td>";
                                // Coluna com o total de candidaturas e um link
                                echo "<td><a href='candidatos_vaga.php?id=" . $vaga['id'] . "'>" . $vaga['total_candidatos'] . "</a></td>";
                                echo "<td>";
                                echo "<a href='candidatos_vaga.php?id=" . $vaga['id'] . "' class='btn btn-sm btn-success'>Ver Candidatos</a> ";
                                echo "<a href='editar_vaga.php?id=" . $vaga['id'] . "' class='btn btn-sm btn-info'>Editar</a> ";
                                echo "<button type='button' class='btn btn-sm btn-danger' data-toggle='modal' data-target='#confirmarExclusaoModal' data-id='" . $vaga['id'] . "'>Excluir</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
            } else {
                echo "<p>Você ainda não cadastrou nenhuma vaga. Clique no botão acima para começar!</p>";
            }
            mysqli_stmt_close($stmt);
        ?>
    </div>
</main>

<div class="modal fade" id="confirmarExclusaoModal" ...>
    ...
</div>
<script>
    ...
</script>

<?php include "footer.php"; ?>

<div class="modal fade" id="confirmarExclusaoModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalLabel">Confirmar Exclusão</h4>
      </div>
      <div class="modal-body">
        <p>Você tem certeza que deseja excluir esta vaga? Esta ação não pode ser desfeita.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <a href="#" id="btn-confirmar-exclusao" class="btn btn-danger">Sim, Excluir Vaga</a>
      </div>
    </div>
  </div>
</div>

<script>
// Usamos jQuery pois ele já está incluído no seu projeto com o Bootstrap
$(document).ready(function() {
    $('#confirmarExclusaoModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // O botão que acionou o modal
        var vagaId = button.data('id');      // Extrai o ID do atributo data-id

        // Encontra o link de confirmação dentro do modal
        var modal = $(this);
        var linkConfirmacao = modal.find('#btn-confirmar-exclusao');

        // Atualiza o link do botão de confirmação com o ID correto
        linkConfirmacao.attr('href', 'excluir_vaga.php?id=' + vagaId);
    });
});
</script>
<?php include "footer.php"; ?>