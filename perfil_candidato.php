<?php
session_start();
// Segurança: Garante que apenas uma empresa logada possa acessar
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 'empresa') {
    header('Location: entrar_empresa.php');
    exit();
}
include "navbar.php";
include "database.php";

$candidato = null;
$tem_permissao = false;

// 1. Verifica se um ID de candidato foi passado
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_candidato = $_GET['id'];
    $id_empresa = $_SESSION['id_empresa'];

    // 2. VERIFICAÇÃO DE PERMISSÃO: Checa se este candidato se aplicou a alguma vaga DESTA empresa
    $sql_permissao = "SELECT COUNT(*) AS total 
                      FROM candidaturas c 
                      JOIN vagas v ON c.id_vaga = v.id 
                      WHERE c.id_usuario = ? AND v.empresa_id = ?";
    
    $stmt_permissao = mysqli_prepare($conexao, $sql_permissao);
    mysqli_stmt_bind_param($stmt_permissao, "ii", $id_candidato, $id_empresa);
    mysqli_stmt_execute($stmt_permissao);
    $resultado_permissao = mysqli_stmt_get_result($stmt_permissao);
    $verificacao = mysqli_fetch_assoc($resultado_permissao);

    if ($verificacao['total'] > 0) {
        $tem_permissao = true;
    }
    mysqli_stmt_close($stmt_permissao);


    // 3. Se tem permissão, busca todos os dados do candidato
    if ($tem_permissao) {
        $stmt_candidato = mysqli_prepare($conexao, "SELECT * FROM cadastro WHERE id = ?");
        mysqli_stmt_bind_param($stmt_candidato, "i", $id_candidato);
        mysqli_stmt_execute($stmt_candidato);
        $resultado_candidato = mysqli_stmt_get_result($stmt_candidato);
        $candidato = mysqli_fetch_assoc($resultado_candidato);
        mysqli_stmt_close($stmt_candidato);
    }
}
?>

<main>
    <div class="form-container">
        <div class="form-card" style="text-align: left; max-width: 800px;">
        
            <?php if ($candidato && $tem_permissao): // Se encontrou o candidato E tem permissão ?>
                
                <h2>Perfil de <?php echo htmlspecialchars($candidato['nome']); ?></h2>
                <p class="form-subtitle">Informações profissionais e de contato do candidato.</p>
                <hr>

                <h4>Dados de Contato</h4>
                <dl>
                    <dt>E-mail:</dt><dd><?php echo htmlspecialchars($candidato['email']); ?></dd>
                    <dt>Telefone:</dt><dd><?php echo htmlspecialchars($candidato['telefone']); ?></dd>
                </dl>
                <hr>

                <h4>Resumo Profissional</h4>
                <p><?php echo nl2br(htmlspecialchars($candidato['resumo_profissional'])); ?></p>
                <hr>

                <h4>Experiência Profissional</h4>
                <p><?php echo nl2br(htmlspecialchars($candidato['experiencia_profissional'])); ?></p>
                <hr>
                
                <h4>Formação Acadêmica</h4>
                <p><?php echo nl2br(htmlspecialchars($candidato['formacao_academica'])); ?></p>
                <hr>

                <h4>Habilidades e Certificações</h4>
                <p><?php echo nl2br(htmlspecialchars($candidato['habilidades'])); ?></p>
                <p><?php echo nl2br(htmlspecialchars($candidato['certificacoes'])); ?></p>
                <hr>

                <h4>Currículo Anexado</h4>
                <?php if (!empty($candidato['caminho_cv'])): ?>
                    <a href="<?php echo htmlspecialchars($candidato['caminho_cv']); ?>" class="btn btn-primary" target="_blank">Baixar Currículo (CV)</a>
                <?php else: ?>
                    <p>O candidato não enviou um currículo.</p>
                <?php endif; ?>

            <?php else: // Se não encontrou ou não tem permissão ?>
                <div class="alert alert-danger text-center">
                    <h2>Acesso Negado</h2>
                    <p>Você não tem permissão para visualizar este perfil ou o candidato não existe.</p>
                    <a href="painel_empresa.php" class="btn btn-primary">Voltar para o Painel</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include "footer.php"; ?>