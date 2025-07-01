<?php
$title = 'Cadastro Empresa - Ferraz Conecta';
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h2 class="text-center mb-4">Cadastro de Empresa</h2>
                    
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger">
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="/cadastro-empresa">
                        <div class="mb-3">
                            <label for="razao_social" class="form-label required">Razão Social</label>
                            <input type="text" class="form-control" id="razao_social" name="razao_social" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label required">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="senha" class="form-label required">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha" required>
                                <small class="form-text text-muted">Mínimo 6 caracteres, uma letra e um número</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="telefone" class="form-label required">Telefone</label>
                                <input type="tel" class="form-control" id="telefone" name="telefone" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="cnpj" class="form-label required">CNPJ</label>
                                <input type="text" class="form-control" id="cnpj" name="cnpj" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="endereco" class="form-label required">Endereço</label>
                            <textarea class="form-control" id="endereco" name="endereco" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição da Empresa</label>
                            <textarea class="form-control" id="descricao" name="descricao" rows="4" placeholder="Conte um pouco sobre sua empresa..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            Criar Conta Empresarial
                        </button>
                    </form>

                    <div class="text-center">
                        <p class="mb-2">Já tem uma conta empresarial?</p>
                        <a href="/login-empresa" class="btn btn-outline-primary">Fazer Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 