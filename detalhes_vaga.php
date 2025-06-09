<?php
session_start();
include "navbar.php";
include "database.php";

$vaga = null; 

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_vaga = $_GET['id'];

    $stmt = mysqli_prepare($conexao, "SELECT * FROM vagas WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id_vaga);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resultado) == 1) {
        $vaga = mysqli_fetch_assoc($resultado);
    }
    mysqli_stmt_close($stmt);
}
?>

<main>
<div class="container" style="padding-top: 2rem;">
        <?php if(isset($_GET['status']) && $_GET['status'] == 'ja_candidatado'): ?>
            <div class="alert alert-warning">Você já se candidatou para esta vaga.</div>
        <?php elseif(isset($_GET['status']) && $_GET['status'] == 'erro'): ?>
            <div class="alert alert-danger">Ocorreu um erro ao processar sua candidatura. Tente novamente.</div>
        <?php endif; ?>
    <div style="max-width: 900px; margin: 2rem auto; padding: 0 1rem;">
        <?php if ($vaga): ?>
            
            <div class="vaga-detalhe-card" style="background-color: #fff; padding: 2rem; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.08);">
                
                <h1 style="font-size: 2.5em; font-weight: bold; margin-bottom: 0.5rem;"><?php echo htmlspecialchars($vaga['titulo']); ?></h1>
                <h2 style="font-weight: normal; font-size: 1.5rem; margin-top: -0.5rem; margin-bottom: 1.5rem; color: #555;"><?php echo htmlspecialchars($vaga['empresa_nome']); ?></h2>
                <hr>

                <h3 style="margin-top: 2rem;">Detalhes da Vaga</h3>
                <div class="detalhes-vaga-lista">
                    <div class="detalhe-item">
                        <span class="detalhe-titulo">Salário:</span>
                        <span class="detalhe-valor"><?php echo htmlspecialchars($vaga['salario']); ?></span>
                    </div>
                    <div class="detalhe-item">
                        <span class="detalhe-titulo">Localização:</span>
                        <span class="detalhe-valor"><?php echo htmlspecialchars($vaga['localizacao']); ?></span>
                    </div>
                    <div class="detalhe-item">
                        <span class="detalhe-titulo">Escolaridade Mínima:</span>
                        <span class="detalhe-valor"><?php echo htmlspecialchars($vaga['escolaridade']); ?></span>
                    </div>
                    <div class="detalhe-item">
                        <span class="detalhe-titulo">Experiência Mínima Necessária:</span>
                        <span class="detalhe-valor"><?php echo htmlspecialchars($vaga['exp']); ?></span>
                    </div>
                </div>

                <h3 style="margin-top: 2rem;">Descrição Completa da Vaga</h3>
                <p style="text-align: justify; line-height: 1.6;">
                    <?php echo nl2br(htmlspecialchars($vaga['descricao_completa'])); ?>
                </p>

                <div style="text-align: center; margin-top: 3rem;">
                    <a href="candidatar.php?id_vaga=<?php echo $vaga['id']; ?>" class="btn btn-primary" style="padding: 1rem 2rem; font-size: 1.2rem;">Candidatar-se a esta Vaga</a>
                </div>
            </div>

        <?php else: ?>
            
            <div class="alert alert-danger text-center">
                <h2>Vaga não encontrada</h2>
                <p>O link que você seguiu pode estar quebrado ou a vaga pode ter sido removida.</p>
                <a href="index.php" class="btn btn-primary">Voltar para a Página Inicial</a>
            </div>

        <?php endif; ?>
    </div>
</main>


<?php include "footer.php"; ?>