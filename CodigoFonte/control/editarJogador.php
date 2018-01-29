<?php

  require_once ('../model/jogador.php');
  require_once ('../persistence/jogadorDAO.php');
  require_once ('../persistence/conexao.php');

  $nome = $_POST["nome"];
  $email = $_POST["email"];
  $nick = $_POST["nick"];
  $equipe = $_POST["equipe"];
  $senha = $_POST["pass"];

  $conexao = new Conexao();
  $jogadorDAO = new JogadorDAO();

  $jogador = new Jogador($email, $equipe, $nick, $nome, $senha);


  $nick = $jogadorDAO->editarJogador($jogador, $conexao->getLink());

  header('Location: ../view/visualizarJogador.php?nick='.$nick);

?>
