<?php

  require_once ('../persistence/jogadorDAO.php');
  require_once ('../persistence/conexao.php');

  $email = $_GET["email"];

  $conexao = new Conexao();

  $jogadorDAO = new JogadorDAO();

  $jogadorDAO->deletarJogador($email, $conexao->getLink());

  // echo "<script type='text/javascript'>alert('Jogador cadastrado com sucesso.')</script>";
  header('Location: ../view/listarJogadores.php');

?>
