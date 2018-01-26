<?php

require_once ('../model/jogador.php');
require_once ('../persistence/jogadorDAO.php');
require_once ('../persistence/conexao.php');

$conexao = new Conexao();
$jogadorDAO = new JogadorDAO();

$jogadores = $jogadorDAO->listarJogadores();

?>
