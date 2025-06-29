<?php
$title = 'Minhas Vagas - Ferraz Conecta';
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-list text-primary"></i> Minhas Vagas</h2>
        <a href="/vagas/criar" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nova Vaga
        </a>
    </div>

    <?php if (!empty($vagas)): ?>
        <div class="cards-container">
            <?php foreach ($vagas as $vaga): ?>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h3><?= htmlspecialchars($vaga['titulo']) ?></h3>
                            <div class="btn-group btn-group-sm">
                                <a href="/vagas/<?= $vaga['id'] ?>" class="btn btn-outline-primary" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="/vagas/<?= $vaga['id'] ?>/editar" class="btn btn-outline-warning" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="/empresa/vagas/<?= $vaga['id'] ?>/candidatos" class="btn btn-outline-info" title="Candidatos">
                                    <i class="fas fa-users"></i>
                                </a>
                                <form method="POST" action="/vagas/<?= $vaga['id'] ?>/excluir" class="d-inline" 
                                    onsubmit="return confirm('Tem certeza que deseja excluir esta vaga?')">
                                    <button type="submit" class="btn btn-outline-danger" title="Excluir">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <ul class="details">
                            <li><strong>Salário:</strong> <?= $this->formatMoney($vaga['salario']) ?></li>
                            <li><strong>Localização:</strong> <?= htmlspecialchars($vaga['localizacao']) ?></li>
                            <li><strong>Experiência:</strong> <?= htmlspecialchars($vaga['exp']) ?></li>
                            <li><strong>Escolaridade:</strong> <?= htmlspecialchars($vaga['escolaridade']) ?></li>
                            <li><strong>Sexo:</strong> <?= htmlspecialchars($vaga['sexo']) ?></li>
                            <li><strong>Data de Publicação:</strong> <?= date('d/m/Y', strtotime($vaga['data_postagem'])) ?></li>
                            <li><strong>Candidatos:</strong> 
                                <span class="badge bg-primary"><?= $vaga['total_candidatos'] ?? 0 ?></span>
                            </li>
                        </ul>

                        <div class="mt-3">
                            <a href="/empresa/vagas/<?= $vaga['id'] ?>/candidatos" class="btn btn-primary">
                                <i class="fas fa-users"></i> Ver Candidatos
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="text-center py-5">
            <i class="fas fa-inbox fa-4x text-muted mb-4"></i>
            <h3>Nenhuma vaga criada ainda</h3>
            <p class="text-muted mb-4">Comece criando sua primeira vaga para encontrar candidatos qualificados.</p>
            <a href="/vagas/criar" class="btn btn-primary btn-lg">
                <i class="fas fa-plus"></i> Criar Primeira Vaga
            </a>
        </div>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="/painel-empresa" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Voltar ao Painel
        </a>
    </div>
</div> 