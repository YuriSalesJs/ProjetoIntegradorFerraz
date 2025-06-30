<?php
$title = 'Cadastro - Ferraz Conecta';
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h2 class="text-center mb-4">Cadastro de Candidato</h2>
                    
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger">
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>

                    <!-- Botões de Autenticação Social -->
                    <div class="mb-4">
                        <p class="text-center text-muted mb-3">Ou cadastre-se com:</p>
                        <div class="d-grid gap-2">
                            <a href="/auth/google" class="btn btn-outline-danger">
                                <i class="fab fa-google me-2"></i>Cadastrar com Google
                            </a>
                            <a href="/auth/linkedin" class="btn btn-outline-primary">
                                <i class="fab fa-linkedin me-2"></i>Cadastrar com LinkedIn
                            </a>
                        </div>
                    </div>

                    <div class="text-center mb-3">
                        <span class="bg-white px-3 text-muted">ou</span>
                    </div>

                    <form method="POST" action="/cadastro">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nome" class="form-label required">Nome Completo</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label required">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="senha" class="form-label required">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha" required>
                                <small class="form-text text-muted">Mínimo 6 caracteres, uma letra e um número</small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="telefone" class="form-label required">Telefone</label>
                                <input type="tel" class="form-control" id="telefone" name="telefone" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cpf" class="form-label required">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="data_nascimento" class="form-label required">Data de Nascimento</label>
                                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="endereco" class="form-label required">Endereço</label>
                            <textarea class="form-control" id="endereco" name="endereco" rows="3" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            Criar Conta
                        </button>
                    </form>

                    <div class="text-center">
                        <p class="mb-2">Já tem uma conta?</p>
                        <a href="/login" class="btn btn-outline-primary">Fazer Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 