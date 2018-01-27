<?php
  require_once('../model/partida.php');
  require_once('../persistence/partidaDAO.php');
  require_once('../persistence/conexao.php');

  $equipe1 = $_POST["equipe1"];
  $equipe2 = $_POST["equipe2"];
  $data = $_POST["data"];
  $horario = $_POST["horario"] . ":00";
  $estado = $_POST["estado"];
  $ganhador = $_POST["ganhador"];

  $data = str_replace('/', '-', $data);
  $data =  date('Y-m-d', strtotime($data));

  $dt = "$data $horario";

  $partida = new partida($equipe1, $equipe2, $dt, $estado, $ganhador, null);
  $conexao = new Conexao();

  $partidaDAO = new partidaDAO();
  $partidaDAO->cadastrarPartida($partida, $conexao->getLink());

  header('Location: ../view/listarPartidas.php');

?>
