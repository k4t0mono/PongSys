<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
	<link rel="stylesheet" href="css/materialize.min.css"  media="screen,projection" />
	<link rel="stylesheet" href="style.css">
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

	<div class="container">
		<div class="row">
			<div class="col s8 m8 offset-m2">
				<div class="card blue-grey darken-1">
					<div class="card-content white-text">
						<span class="card-title center">Cadastro de Equipe</span>
					</div>

					<div class="card-content white-text">
						<form method="post" action="../control/cadastrarEquipe.php">
							<div class="row margin">
								<div class="input-field col s12">
									<input id="nome" type="text" name="nome"/>
									<label for="nome">Nome</label>
								</div>
							</div>
							<div class='center-align'>
								<button type="submit" class="waves-effect waves-light btn">Enviar</button>
								<button type="reset" class="waves-effect waves-light btn">Limpar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>
