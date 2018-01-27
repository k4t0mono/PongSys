<?php
  require_once('../model/equipe.php');
  require_once('../persistence/equipeDAO.php');
  require_once('../persistence/conexao.php');

  $nomeEquipe = $_POST["nome"];

  $equipe = new Equipe($nomeEquipe, null);
  $conexao = new Conexao();

  $equipeDAO = new EquipeDAO();
  $equipeDAO->cadastrarEquipe($equipe, $conexao->getLink());

  header('Location: ../view/listarEquipes.php');


?>
