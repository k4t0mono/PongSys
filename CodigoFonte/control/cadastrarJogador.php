<?php

  require_once ('../control/jogadorController.php');

  $nome = $_POST["nome"];
  $email = $_POST["email"];
  $nick = $_POST["nick"];
  $equipe = $_POST["equipe"];
  $senha = $_POST["pass"];

  $jc = new JogadorController();

  $jc->cadastrarJogador($email, $equipe, $nick, $nome, $senha);

  header('Location: ../view/listarJogadores.php');

?>
