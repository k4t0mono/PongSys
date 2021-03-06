<?php
  require_once("../persistence/organizadorDAO.php");
  require_once("../persistence/jogadorDAO.php");
  require_once("../persistence/conexao.php");

  $email = $_POST["email"];
  $senha = $_POST["senha"];

  $conexao = new Conexao();

  $jogadorDAO = new JogadorDAO();

  $organizadorDAO = new OrganizadorDAO();

  $organizador = $organizadorDAO->consultarOrganizadorPorEmail($email, $conexao->getLink());

  if($organizador != null){
    session_start();
    $_SESSION["user"] = $email;
    $_SESSION["adm"] = true;
    echo "Log in feito com sucesso <br>";
    header('Location: ../view/index.php?login=true');
  }
  else{
    $jogador = $jogadorDAO->consultarJogadorPorEmail($email, $conexao->getLink());
    if($jogador != null && $jogador->getSenha() == $senha){
      session_start();
      $_SESSION["user"] = $email;
      echo "Log in feito com sucesso <br>";

    }
    else{
      header('Location: ../view/login.php?fail');
      die("Log in falhou");

    }

    header('Location: ../view/index.php?login=true');
  }


?>
