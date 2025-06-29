<?php
$title = 'Minhas Candidaturas - Ferraz Conecta';
?>

<div class="container mt-4">
    <h2 class="mb-4">
        <i class="fas fa-briefcase text-primary"></i> Minhas Candidaturas
    </h2>

    <?php if (isset($_GET['status']) && $_GET['status'] === 'desistencia_sucesso'): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> Desistência realizada com sucesso!
        </div>
    <?php endif; ?>

    <?php if (!empty($candidaturas)): ?>
        <div class="cards-container">
            <?php foreach ($candidaturas as $candidatura): ?>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h3><?= htmlspecialchars($candidatura['titulo']) ?></h3>
                            <span class="badge bg-<?= $candidatura['status'] === 'aprovada' ? 'success' : ($candidatura['status'] === 'reprovada' ? 'danger' : 'warning') ?>">
                                <?= ucfirst(htmlspecialchars($candidatura['status'])) ?>
                            </span>
                        </div>

                        <ul class="details">
                            <li><strong>Empresa:</strong> <?= htmlspecialchars($candidatura['razao_social'] ?? 'Não informado') ?></li>
                            <li><strong>Salário:</strong> <?= $this->formatMoney($candidatura['salario']) ?></li>
                            <li><strong>Localização:</strong> <?= htmlspecialchars($candidatura['localizacao'] ?? 'Não informado') ?></li>
                            <li><strong>Experiência:</strong> <?= htmlspecialchars($candidatura['exp'] ?? 'Não informado') ?></li>
                            <li><strong>Escolaridade:</strong> <?= htmlspecialchars($candidatura['escolaridade'] ?? 'Não informado') ?></li>
                            <li><strong>Data da Candidatura:</strong> <?= isset($candidatura['data_candidatura']) ? date('d/m/Y', strtotime($candidatura['data_candidatura'])) : 'Data não disponível' ?></li>
                        </ul>

                        <div class="mt-3">
                            <div class="btn-group" role="group">
                                <a href="/vagas/<?= $candidatura['vaga_id'] ?? $candidatura['id'] ?>" class="btn btn-outline-primary">
                                    <i class="fas fa-eye"></i> Ver Vaga
                                </a>
                                
                                <form method="POST" action="/vagas/desistir" class="d-inline" 
                                    onsubmit="return confirm('Tem certeza que deseja desistir desta candidatura?')">
                                    <input type="hidden" name="vaga_id" value="<?= $candidatura['vaga_id'] ?? $candidatura['id'] ?>">
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fas fa-times"></i> Desistir
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
            <i class="fas fa-briefcase fa-4x text-muted mb-4"></i>
            <h3>Nenhuma candidatura ainda</h3>
            <p class="text-muted mb-4">Você ainda não se candidatou a nenhuma vaga.</p>
            <a href="/vagas" class="btn btn-primary btn-lg">
                <i class="fas fa-search"></i> Procurar Vagas
            </a>
        </div>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="/" class="btn btn-outline-primary">
            <i class="fas fa-home"></i> Página Inicial
        </a>
        <a href="/perfil" class="btn btn-outline-secondary">
            <i class="fas fa-user"></i> Meu Perfil
        </a>
    </div>
</div> 