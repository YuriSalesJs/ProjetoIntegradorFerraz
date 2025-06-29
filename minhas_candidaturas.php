<?php
// Inicia a sessão e verifica se o usuário é um candidato logado
session_start();
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 'candidato') {
    header('Location: entrar.php');
    exit();
}

include "navbar.php";
include "database.php";

$id_candidato = $_SESSION['id_usuario'];
$candidaturas = [];

// PASSO 1 - Consulta SQL ATUALIZADA para buscar também o ID da candidatura
$sql = "SELECT 
            c.id AS id_candidatura, 
            v.id AS id_vaga,
            v.titulo, 
            v.empresa_nome, 
            v.localizacao, 
            c.data_candidatura 
        FROM 
            candidaturas AS c
        JOIN 
            vagas AS v ON c.id_vaga = v.id
        WHERE 
            c.id_usuario = ?
        ORDER BY 
            c.data_candidatura DESC";

$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_candidato);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

while ($row = mysqli_fetch_assoc($resultado)) {
    $candidaturas[] = $row;
}
mysqli_stmt_close($stmt);
?>

<main class="container" style="padding-top: 2rem;">
    <h1>Minhas Candidaturas</h1>
    <p>Aqui está o histórico de todas as vagas para as quais você se candidatou.</p>
    <hr>

    <?php if(isset($_GET['status'])): ?>
        <?php if($_GET['status'] == 'desistencia_sucesso'): ?>
            <div class="alert alert-success">Você desistiu da candidatura com sucesso.</div>
        <?php elseif($_GET['status'] == 'erro'): ?>
            <div class="alert alert-danger">Ocorreu um erro ao processar sua solicitação.</div>
        <?php endif; ?>
    <?php endif; ?>


    <?php if (empty($candidaturas)): ?>
        <div class="alert alert-info">
            Você ainda não se candidatou a nenhuma vaga. <a href="vagas.php" class="alert-link">Clique aqui para ver as vagas abertas!</a>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Título da Vaga</th>
                        <th>Empresa</th>
                        <th>Data da Candidatura</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($candidaturas as $candidatura): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($candidatura['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($candidatura['empresa_nome']); ?></td>
                            <td><?php echo date('d/m/Y \à\s H:i', strtotime($candidatura['data_candidatura'])); ?></td>
                            <td>
                                <a href="detalhes_vaga.php?id=<?php echo $candidatura['id_vaga']; ?>" class="btn btn-sm btn-primary">Ver Vaga</a>
                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#confirmarDesistenciaModal" data-id="<?php echo $candidatura['id_candidatura']; ?>">
                                    Desistir
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</main>

<div class="modal fade" id="confirmarDesistenciaModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalLabel">Desistir da Candidatura</h4>
      </div>
      <div class="modal-body">
        <p>Você tem certeza que deseja remover sua candidatura para esta vaga?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <a href="#" id="btn-confirmar-desistencia" class="btn btn-danger">Sim, Desistir</a>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    $('#confirmarDesistenciaModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var candidaturaId = button.data('id'); // Pega o ID da candidatura do botão
        var modal = $(this);
        var linkConfirmacao = modal.find('#btn-confirmar-desistencia');
        // Monta o link de exclusão com o ID correto
        linkConfirmacao.attr('href', 'desistir_candidatura.php?id_candidatura=' + candidaturaId);
    });
});
</script>

<?php include "footer.php"; ?>