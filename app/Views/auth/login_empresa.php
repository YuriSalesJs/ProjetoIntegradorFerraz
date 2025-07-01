<?php
$title = 'Login Empresa - Ferraz Conecta';
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h2 class="text-center mb-4">Login Empresa</h2>
                    
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger">
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="/login-empresa">
                        <div class="mb-3">
                            <label for="email" class="form-label required">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="senha" class="form-label required">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            Entrar como Empresa
                        </button>
                    </form>

                    <div class="text-center">
                        <p class="mb-2">Não tem uma conta empresarial?</p>
                        <a href="/cadastro-empresa" class="btn btn-outline-primary">Cadastrar Empresa</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 