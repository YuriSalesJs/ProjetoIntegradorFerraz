<?php
session_start();
if (isset($_SESSION['nome'])) {
  echo "Olá, " . $_SESSION['nome'] . "!";
}
  else {
    echo "deu ruim";
  }
?>