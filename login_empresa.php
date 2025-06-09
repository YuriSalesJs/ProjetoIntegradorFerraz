<?php
include 'database.php';

$email_login = $_POST['email_login'];
$senha_digitada = $_POST['senha'];

$stmt = mysqli_prepare($conexao, "SELECT id, nome_fantasia, senha FROM empresas WHERE email_login = ?");
mysqli_stmt_bind_param($stmt, "s", $email_login);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($resultado) == 1) {
    $empresa = mysqli_fetch_assoc($resultado);
    
    if (password_verify($senha_digitada, $empresa['senha'])) {
        // --- LÓGICA DE SESSÃO CORRIGIDA ---
        session_start();
        // 1. Limpa qualquer sessão antiga
        session_unset();
        session_destroy();
        
        // 2. Inicia uma sessão nova e limpa
        session_start();

        // 3. Define os dados da nova sessão
        $_SESSION['id_empresa'] = $empresa['id'];
        $_SESSION['nome_fantasia'] = $empresa['nome_fantasia'];
        $_SESSION['tipo_usuario'] = 'empresa'; // A INFORMAÇÃO MAIS IMPORTANTE!

        header('Location: painel_empresa.php');
        exit();
    }
}

echo "<script>
    alert('E-mail ou senha inválidos.');
    window.location.href = 'entrar_empresa.php';
</script>";

mysqli_stmt_close($stmt);
?>