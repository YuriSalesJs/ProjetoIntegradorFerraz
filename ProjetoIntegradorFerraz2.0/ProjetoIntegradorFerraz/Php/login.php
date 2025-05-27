<?php
include 'database.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$sqlquery = mysqli_query($conexao, "SELECT * FROM cadastro WHERE email = '$email' AND senha = '$senha'");
$dados = mysqli_fetch_assoc($sqlquery);

if (mysqli_num_rows($sqlquery) <=0) {
    echo "<script>
        alert('Login inválido');
        window.location.href = 'entrar.php';
    </script>";
} else {
    session_start();
    $_SESSION['nome'] = $dados['nome'];
   
    echo "<script>
        alert('Login Bem-Sucedido');
        window.location.href = 'index.php';
    </script>";
}
?>
