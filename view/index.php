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
				<li><a href="index.php">Home</a></li>
				<li><a href="view/jogadores.html">Jogadores</a></li>
				<li><a href="view/equipes.html">Equipes</a></li>
				<li><a href="view/partidas.html">Partidas</a></li>
				<?php
					require_once("../persistence/jogadorDAO.php");
					require_once("../persistence/conexao.php");
					session_start();
					if(array_key_exists('user',$_SESSION)){
						$conexao = new Conexao();
						$jogadorDAO = new JogadorDAO();
						$usuario = $jogadorDAO->consultarJogadorPorEmail($_SESSION['user'], $conexao->getLink());
						echo "<li><a>Bem-vindo, ".$usuario->getNome()."</a></li>";
						echo "<li><a href='../control/logoff.php'>Logoff</a></li>";
					}
					else{
						echo "<li><a href='login.html'>Login</a></li>";
					}
				?>

			</ul>
		</div>
	</nav>

	<div class="container center-align">
		<a href="./cadastro/cadastroJogador.html">
			<div class="row">
				<div class="col s8 m8 offset-m2">
					<div class="card blue-grey darken-1 waves-effect waves-light ">
						<div class="card-content white-text">
							<span class="card-title center">Cadastro de Jogadores</span>
						</div>
					</div>
				</div>
			</a>

			<a href="./cadastro/cadastroEquipe.html">
				<div class="col s8 m8 offset-m2">
					<div class="card blue-grey darken-1 waves-effect waves-light ">
						<div class="card-content white-text">
								<span class="card-title center">Cadastro de Equipes</span>
						</div>
					</div>
				</div>
			</a>


			<a href="../view/listarJogadores.php">
				<div class="col s8 m8 offset-m2">
					<div class="card blue-grey darken-1 waves-effect waves-light ">
						<div class="card-content white-text">
								<span class="card-title center">Listar Jogadores</span>
						</div>
					</div>
				</div>
			</a>

			<a href="../view/listarEquipes.php">
				<div class="col s8 m8 offset-m2">
					<div class="card blue-grey darken-1 waves-effect waves-light ">
						<div class="card-content white-text">
								<span class="card-title center">Listar Equipes</span>
						</div>
					</div>
				</div>
			</a>

		</div>
	</div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>
