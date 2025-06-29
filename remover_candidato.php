<?php
session_start();
include "database.php";

// Verifica se a empresa está logada
if (!isset($_SESSION['id_empresa'])) {
    header('Location: entrar_empresa.php');
    exit();
}

// Verifica se os parâmetros necessários foram fornecidos
if (!isset($_GET['id']) || !is_numeric($_GET['id']) || !isset($_GET['vaga_id']) || !is_numeric($_GET['vaga_id'])) {
    header('Location: painel_empresa.php?status=erro');
    exit();
}

$id_candidatura = $_GET['id'];
$id_vaga = $_GET['vaga_id'];
$id_empresa = $_SESSION['id_empresa'];

// Verifica se a candidatura existe e se a vaga pertence à empresa
$stmt = mysqli_prepare($conexao, "
    SELECT c.id 
    FROM candidaturas c
    INNER JOIN vagas v ON c.id_vaga = v.id
    WHERE c.id = ? AND v.id = ? AND v.empresa_id = ?
");
mysqli_stmt_bind_param($stmt, "iii", $id_candidatura, $id_vaga, $id_empresa);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($resultado) == 0) {
    header('Location: painel_empresa.php?status=erro');
    exit();
}

mysqli_stmt_close($stmt);

// Remove a candidatura
$stmt_delete = mysqli_prepare($conexao, "DELETE FROM candidaturas WHERE id = ?");
mysqli_stmt_bind_param($stmt_delete, "i", $id_candidatura);

if (mysqli_stmt_execute($stmt_delete)) {
    header('Location: candidatos_vaga.php?id=' . $id_vaga . '&status=candidato_removido');
} else {
    header('Location: candidatos_vaga.php?id=' . $id_vaga . '&status=erro');
}

mysqli_stmt_close($stmt_delete);
exit();
?> 