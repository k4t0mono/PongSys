<?php
  require_once("../persistence/jogadorDAO.php");
  require_once("../persistence/conexao.php");

  $email = $_POST["email"];
  $senha = $_POST["senha"];

  $conexao = new Conexao();

  $jogadorDAO = new JogadorDAO();
  $jogador = $jogadorDAO->consultarJogadorPorEmail($email, $conexao->getLink());
  echo $jogador->getSenha();
  echo $senha;
  if($jogador->getSenha() == $senha){
    session_start();
    $_SESSION["user"] = $email;
    echo "Log in feito com sucesso <br>";

  }
  else{
    die("Log in falhou");
  }

  header('Location: ../view')

?>
