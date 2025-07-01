<?php
$title = 'Login - Ferraz Conecta';
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h2 class="text-center mb-4">Entrar</h2>
                    
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger">
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>

                    <!-- Botões de Autenticação Social -->
                    <div class="mb-4">
                        <p class="text-center text-muted mb-3">Ou entre com:</p>
                        <div class="d-grid gap-2">
                            <a href="/auth/google" class="btn btn-outline-danger">
                                <i class="fab fa-google me-2"></i>Entrar com Google
                            </a>
                            <a href="/auth/linkedin" class="btn btn-outline-primary">
                                <i class="fab fa-linkedin me-2"></i>Entrar com LinkedIn
                            </a>
                        </div>
                    </div>

                    <div class="text-center mb-3">
                        <span class="bg-white px-3 text-muted">ou</span>
                    </div>

                    <form method="POST" action="/login">
                        <div class="mb-3">
                            <label for="email" class="form-label required">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="senha" class="form-label required">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" required>
                        </div>

                        <div class="mb-3">
                            <label for="tipo" class="form-label required">Tipo de Conta</label>
                            <select class="form-select" id="tipo" name="tipo" required>
                                <option value="">Selecione...</option>
                                <option value="candidato">Candidato</option>
                                <option value="empresa">Empresa</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            Entrar
                        </button>
                    </form>

                    <div class="text-center">
                        <p class="mb-2">Não tem uma conta?</p>
                        <a href="/cadastro" class="btn btn-outline-primary me-2">Cadastrar Candidato</a>
                        <a href="/cadastro-empresa" class="btn btn-outline-secondary">Cadastrar Empresa</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 