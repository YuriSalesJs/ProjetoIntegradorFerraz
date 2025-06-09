<?php
session_start();
include "navbar.php";
include "database.php";

// Inicializa as variáveis como nulas
$empresa = null;
$vagas_da_empresa = [];

// 1. Verifica se um ID de empresa foi passado pela URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_empresa = $_GET['id'];

    // 2. Busca os dados da empresa de forma segura
    $stmt_empresa = mysqli_prepare($conexao, "SELECT * FROM empresas WHERE id = ?");
    mysqli_stmt_bind_param($stmt_empresa, "i", $id_empresa);
    mysqli_stmt_execute($stmt_empresa);
    $resultado_empresa = mysqli_stmt_get_result($stmt_empresa);

    if (mysqli_num_rows($resultado_empresa) == 1) {
        $empresa = mysqli_fetch_assoc($resultado_empresa);

        // 3. Se encontrou a empresa, busca as vagas associadas a ela
        $stmt_vagas = mysqli_prepare($conexao, "SELECT * FROM vagas WHERE empresa_id = ? ORDER BY data_postagem DESC");
        mysqli_stmt_bind_param($stmt_vagas, "i", $id_empresa);
        mysqli_stmt_execute($stmt_vagas);
        $resultado_vagas = mysqli_stmt_get_result($stmt_vagas);
        
        while ($vaga = mysqli_fetch_assoc($resultado_vagas)) {
            $vagas_da_empresa[] = $vaga; // Adiciona cada vaga a um array
        }
        mysqli_stmt_close($stmt_vagas);
    }
    mysqli_stmt_close($stmt_empresa);
}
?>

<main>
    <div style="max-width: 900px; margin: 2rem auto; padding: 0 1rem;">
        <?php if ($empresa): // Se a empresa foi encontrada ?>
            
            <div class="perfil-empresa-card" style="background-color: #fff; padding: 2rem; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.08);">
                
                <h1 style="font-size: 2.5em; font-weight: bold; margin-bottom: 0.5rem;"><?php echo htmlspecialchars($empresa['nome_fantasia']); ?></h1>
                <h2 style="font-weight: normal; font-size: 1.5rem; margin-top: -0.5rem; margin-bottom: 1.5rem; color: #555;"><?php echo htmlspecialchars($empresa['razao_social']); ?></h2>
                <p><strong>Ramo de Atividade:</strong> <?php echo htmlspecialchars($empresa['ramo_atividade']); ?></p>
                <hr>

                <h3 style="margin-top: 2rem;">Informações de Contato</h3>
                <p><strong>Endereço:</strong> <?php echo htmlspecialchars($empresa['endereco']); ?></p>
                <p><strong>E-mail:</strong> <?php echo htmlspecialchars($empresa['email_contato']); ?></p>
                <p><strong>Telefone:</strong> <?php echo htmlspecialchars($empresa['telefone']); ?></p>

                <h3 style="margin-top: 2rem;">Vagas Abertas Nesta Empresa</h3>
                <hr>
                
                <?php if (!empty($vagas_da_empresa)): ?>
                    <div class="cards-container">
                        <?php foreach ($vagas_da_empresa as $vaga): ?>
                            <article class='card'>
                                <h3><?php echo htmlspecialchars($vaga['titulo']); ?></h3>
                                <ul class='details'>
                                    <li><strong>Salário:</strong> <?php echo htmlspecialchars($vaga['salario']); ?></li>
                                    <li><strong>Localização:</strong> <?php echo htmlspecialchars($vaga['localizacao']); ?></li>
                                </ul>
                                <a href='detalhes_vaga.php?id=<?php echo $vaga['id']; ?>' class='btn btn-primary'>Ver Detalhes</a>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>Esta empresa não possui nenhuma vaga aberta no momento.</p>
                <?php endif; ?>

            </div>

        <?php else: // Se a empresa não foi encontrada ?>
            
            <div class="alert alert-danger text-center">
                <h2>Empresa não encontrada</h2>
                <p>O link que você seguiu pode estar quebrado ou a empresa pode ter sido removida.</p>
                <a href="empresas.php" class="btn btn-primary">Voltar para a Lista de Empresas</a>
            </div>

        <?php endif; ?>
    </div>
</main>

<?php include "footer.php"; ?>