<?php
$title = 'Painel Empresa - Ferraz Conecta';
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                    <h4 class="card-title"><?= htmlspecialchars($empresa['razao_social']) ?></h4>
                    <p class="text-muted"><?= htmlspecialchars($empresa['email']) ?></p>
                    
                    <div class="d-grid gap-2">
                        <a href="/vagas/criar" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nova Vaga
                        </a>
                        <a href="/empresa/vagas" class="btn btn-outline-primary">
                            <i class="fas fa-list"></i> Minhas Vagas
                        </a>
                    </div>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Informações da Empresa</h5>
                    <ul class="list-unstyled">
                        <li><strong>Telefone:</strong> <?= htmlspecialchars($empresa['telefone']) ?></li>
                        <li><strong>CNPJ:</strong> <?= htmlspecialchars($empresa['cnpj']) ?></li>
                        <li><strong>Endereço:</strong> <?= htmlspecialchars($empresa['endereco']) ?></li>
                    </ul>
                    
                    <?php if ($empresa['descricao']): ?>
                        <h6>Descrição:</h6>
                        <p class="text-muted"><?= htmlspecialchars($empresa['descricao']) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="card-title mb-4">
                        <i class="fas fa-chart-bar text-primary"></i> Resumo das Vagas
                    </h4>

                    <?php if (isset($_GET['status'])): ?>
                        <?php if ($_GET['status'] === 'vaga_criada'): ?>
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i> Vaga criada com sucesso!
                            </div>
                        <?php elseif ($_GET['status'] === 'vaga_atualizada'): ?>
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i> Vaga atualizada com sucesso!
                            </div>
                        <?php elseif ($_GET['status'] === 'vaga_excluida'): ?>
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i> Vaga excluída com sucesso!
                            </div>
                        <?php elseif ($_GET['status'] === 'cadastro_sucesso'): ?>
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i> Conta criada com sucesso! Bem-vindo ao Ferraz Conecta.
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if (!empty($vagas)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Vaga</th>
                                        <th>Salário</th>
                                        <th>Candidatos</th>
                                        <th>Data</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($vagas as $vaga): ?>
                                        <tr>
                                            <td>
                                                <strong><?= htmlspecialchars($vaga['titulo']) ?></strong>
                                                <br>
                                                <small class="text-muted"><?= htmlspecialchars($vaga['localizacao']) ?></small>
                                            </td>
                                            <td><?= $this->formatMoney($vaga['salario']) ?></td>
                                            <td>
                                                <span class="badge bg-primary"><?= $vaga['total_candidatos'] ?? 0 ?></span>
                                            </td>
                                            <td><?= date('d/m/Y', strtotime($vaga['data_postagem'])) ?></td>
                                            <td>
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
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h5>Nenhuma vaga criada ainda</h5>
                            <p class="text-muted">Comece criando sua primeira vaga para encontrar candidatos.</p>
                            <a href="/vagas/criar" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Criar Primeira Vaga
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div> 