<?php
$title = 'Candidatos - ' . htmlspecialchars($vaga['titulo']) . ' - Ferraz Conecta';
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2><i class="fas fa-users text-primary"></i> Candidatos da Vaga</h2>
            <h5 class="text-muted"><?= htmlspecialchars($vaga['titulo']) ?></h5>
        </div>
        <a href="/empresa/vagas" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Voltar às Vagas
        </a>
    </div>

    <?php if (isset($_GET['status'])): ?>
        <?php if ($_GET['status'] === 'status_atualizado'): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> Status do candidato atualizado com sucesso!
            </div>
        <?php elseif ($_GET['status'] === 'candidato_removido'): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> Candidato removido da vaga com sucesso!
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (!empty($candidatos)): ?>
        <div class="cards-container">
            <?php foreach ($candidatos as $candidato): ?>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h3><?= htmlspecialchars($candidato['nome']) ?></h3>
                            <span class="badge bg-<?= $candidato['status'] === 'aprovada' ? 'success' : ($candidato['status'] === 'reprovada' ? 'danger' : 'warning') ?>">
                                <?= ucfirst(htmlspecialchars($candidato['status'])) ?>
                            </span>
                        </div>

                        <ul class="details">
                            <li><strong>Email:</strong> <?= htmlspecialchars($candidato['email']) ?></li>
                            <li><strong>Telefone:</strong> <?= htmlspecialchars($candidato['telefone']) ?></li>
                            <li><strong>CPF:</strong> <?= htmlspecialchars($candidato['cpf']) ?></li>
                            <li><strong>Data de Nascimento:</strong> <?= date('d/m/Y', strtotime($candidato['data_nascimento'])) ?></li>
                            <li><strong>Endereço:</strong> <?= htmlspecialchars($candidato['endereco']) ?></li>
                            <li><strong>Data da Candidatura:</strong> <?= date('d/m/Y', strtotime($candidato['data_candidatura'])) ?></li>
                        </ul>

                        <div class="mt-3">
                            <div class="btn-group" role="group">
                                <form method="POST" action="/empresa/candidatos/status" class="d-inline">
                                    <input type="hidden" name="candidato_id" value="<?= $candidato['id'] ?>">
                                    <input type="hidden" name="vaga_id" value="<?= $vaga['id'] ?>">
                                    <input type="hidden" name="status" value="aprovada">
                                    <button type="submit" class="btn btn-success btn-sm" 
                                        onclick="return confirm('Aprovar este candidato?')">
                                        <i class="fas fa-check"></i> Aprovar
                                    </button>
                                </form>

                                <form method="POST" action="/empresa/candidatos/status" class="d-inline">
                                    <input type="hidden" name="candidato_id" value="<?= $candidato['id'] ?>">
                                    <input type="hidden" name="vaga_id" value="<?= $vaga['id'] ?>">
                                    <input type="hidden" name="status" value="reprovada">
                                    <button type="submit" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Reprovar este candidato?')">
                                        <i class="fas fa-times"></i> Reprovar
                                    </button>
                                </form>

                                <form method="POST" action="/empresa/candidatos/remover" class="d-inline" 
                                    onsubmit="return confirm('Tem certeza que deseja remover este candidato da vaga?')">
                                    <input type="hidden" name="candidato_id" value="<?= $candidato['id'] ?>">
                                    <input type="hidden" name="vaga_id" value="<?= $vaga['id'] ?>">
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-trash"></i> Remover
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="text-center py-5">
            <i class="fas fa-users fa-4x text-muted mb-4"></i>
            <h3>Nenhum candidato ainda</h3>
            <p class="text-muted mb-4">Esta vaga ainda não recebeu candidaturas.</p>
            <a href="/vagas/<?= $vaga['id'] ?>" class="btn btn-primary">
                <i class="fas fa-eye"></i> Ver Vaga
            </a>
        </div>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="/painel-empresa" class="btn btn-outline-primary">
            <i class="fas fa-tachometer-alt"></i> Voltar ao Painel
        </a>
    </div>
</div> 