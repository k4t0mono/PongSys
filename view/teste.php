<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
	<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection" />

	<link rel="stylesheet" href="./style.css" />
</head>
<body>
	<nav>
		<div class="nav-wrapper">
			<a href="#" class="brand-logo">PongSys</a>

			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<li><a href="../view">Home</a></li>
				<li><a href="../view/listarJogadores.php">Jogadores</a></li>
				<li><a href="../view/listarEquipes.php">Equipes</a></li>
				<li><a href="../view/listarPartidas.php">Partidas</a></li>
				<?php
					require_once("../persistence/jogadorDAO.php");
					require_once("../persistence/conexao.php");
					session_start();
					if(array_key_exists('user',$_SESSION)){
						$conexao = new Conexao();
						$jogadorDAO = new JogadorDAO();
						$usuario = $jogadorDAO->consultarJogadorPorEmail($_SESSION['user'], $conexao->getLink());
						if($usuario != null){
							echo "<li><a>Bem-vindo, ".$usuario->getNome()."</a></li>";
							echo "<li><a href='../control/logoff.php'>Logoff</a></li>";
						}
						else{
							echo "<li><a href='login.html'>Login</a></li>";
						}
					}
					else{
						echo "<li><a href='login.html'>Login</a></li>";
					}
				?>

			</ul>
		</div>
	</nav>

	<div class="card">


		<a href="../view/edicaoJogador.php?email=pedro.silveira@compjunior.com">CLica aquiiii	</a>
	</div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
  <script type="text/javascript" src="js/tabelas.js"></script>
</body>
</html>
