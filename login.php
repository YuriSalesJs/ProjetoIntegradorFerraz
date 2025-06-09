<?php
// ATENÇÃO: AINDA NÃO ATUALIZAMOS ESTE SCRIPT PARA USAR SENHAS SEGURAS.
// ESTA VERSÃO APENAS CORRIGE O PROBLEMA DA SESSÃO.
// NOSSO PRÓXIMO PASSO DEVERÁ SER ATUALIZAR A SEGURANÇA AQUI.
include 'database.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$sqlquery = mysqli_query($conexao, "SELECT * FROM cadastro WHERE email = '$email' AND senha = '$senha'");

if (mysqli_num_rows($sqlquery) <= 0) {
    echo "<script>
        alert('Login inválido');
        window.location.href = 'entrar.php';
    </script>";
} else {
    $dados = mysqli_fetch_assoc($sqlquery);
    
    // --- LÓGICA DE SESSÃO CORRIGIDA ---
    session_start();
    // 1. Limpa qualquer sessão antiga
    session_unset();
    session_destroy();

    // 2. Inicia uma sessão nova e limpa
    session_start();

    // 3. Define os dados da nova sessão
    $_SESSION['id_usuario'] = $dados['id']; // Usaremos id_usuario para ser mais específico
    $_SESSION['nome_usuario'] = $dados['nome'];
    $_SESSION['tipo_usuario'] = 'candidato'; // A INFORMAÇÃO MAIS IMPORTANTE!
   
    echo "<script>
        alert('Login Bem-Sucedido');
        window.location.href = 'index.php';
    </script>";
}
?>
