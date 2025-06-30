<?php
$title = htmlspecialchars($vaga['titulo']) . ' - Ferraz Conecta';
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-body">
                    <h1 class="card-title mb-3"><?= htmlspecialchars($vaga['titulo']) ?></h1>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5><i class="fas fa-money-bill-wave text-success"></i> Salário</h5>
                            <p class="text-muted"><?= $this->formatMoney($vaga['salario']) ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fas fa-map-marker-alt text-primary"></i> Localização</h5>
                            <p class="text-muted"><?= htmlspecialchars($vaga['localizacao']) ?></p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <h5><i class="fas fa-briefcase text-info"></i> Experiência</h5>
                            <p class="text-muted"><?= htmlspecialchars($vaga['exp']) ?></p>
                        </div>
                        <div class="col-md-4">
                            <h5><i class="fas fa-graduation-cap text-warning"></i> Escolaridade</h5>
                            <p class="text-muted"><?= htmlspecialchars($vaga['escolaridade']) ?></p>
                        </div>
                        <div class="col-md-4">
                            <h5><i class="fas fa-user text-secondary"></i> Sexo</h5>
                            <p class="text-muted"><?= htmlspecialchars($vaga['sexo']) ?></p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5><i class="fas fa-file-alt text-dark"></i> Descrição Completa</h5>
                        <div class="bg-light p-3 rounded">
                            <?= nl2br(htmlspecialchars($vaga['descricao_completa'])) ?>
                        </div>
                    </div>

                    <div class="text-muted small">
                        <i class="fas fa-calendar"></i> 
                        Publicada em: <?= date('d/m/Y', strtotime($vaga['data_postagem'])) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Ações</h5>
                    
                    <?php if ($this->isLoggedIn()): ?>
                        <?php if ($this->getSession('user_type') === 'candidato'): ?>
                            <form method="POST" action="/vagas/candidatar" class="mb-3">
                                <input type="hidden" name="vaga_id" value="<?= $vaga['id'] ?>">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-paper-plane"></i> Candidatar-se
                                </button>
                            </form>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            Faça login para se candidatar a esta vaga.
                        </div>
                        <a href="/login" class="btn btn-primary w-100">
                            <i class="fas fa-sign-in-alt"></i> Fazer Login
                        </a>
                    <?php endif; ?>

                    <hr>
                    
                    <a href="/vagas" class="btn btn-outline-secondary w-100 mb-2">
                        <i class="fas fa-arrow-left"></i> Voltar às Vagas
                    </a>
                    
                    <a href="/" class="btn btn-outline-primary w-100">
                        <i class="fas fa-home"></i> Página Inicial
                    </a>
                </div>
            </div>
        </div>
    </div>
</div> 