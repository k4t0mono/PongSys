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
				<?php
					require_once("../persistence/jogadorDAO.php");
					require_once("../persistence/conexao.php");
					session_start();
					if(array_key_exists('adm',$_SESSION)){
						if($_SESSION["adm"] != null){
							echo "<li><a>Bem-vindo, Organizador</a></li>";
							echo "<li><a href='../control/logoff.php'>Logoff</a></li>";
						}
					}
					else{
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
					}
				?>

			</ul>
		</div>
	</nav>

	<div class="container center-align">
		<?php
		if(array_key_exists('adm',$_SESSION)){

			if($_SESSION["adm"] == true){
			echo "<a href='./cadastroEquipe.php'>";
			echo "	<div class='col s8 m8 offset-m2'>";
			echo "		<div class='card blue-grey darken-1 waves-effect waves-light '>";
			echo "			<div class='card-content white-text'>";
			echo "				<span class='card-title center'>Cadastro de Equipes</span>";
			echo "			</div>";
			echo "		</div>";
			echo "	</div>";
			echo "</a>";

			echo "<a href='./cadastroJogador.php'>";
			echo "	<div class='row'>";
			echo "		<div class='col s8 m8 offset-m2'>";
			echo "			<div class='card blue-grey darken-1 waves-effect waves-light '>";
			echo "				<div class='card-content white-text'>";
			echo "					<span class='card-title center'>Cadastro de Jogadores</span>";
			echo "				</div>";
			echo "			</div>";
			echo "		</div>";
			echo "	</a>";

				echo "<a href='./cadastroPartida.php'>";
				echo "	<div class='col s8 m8 offset-m2'>";
				echo "		<div class='card blue-grey darken-1 waves-effect waves-light '>";
				echo "			<div class='card-content white-text'>";
				echo "					<span class='card-title center'>Cadastro de Partidas</span>";
				echo "			</div>";
				echo "		</div>";
				echo "	</div>";
				echo "</a>";

				echo "<a href='./cadastroDesempenho.php'>";
				echo "	<div class='col s8 m8 offset-m2'>";
				echo "		<div class='card blue-grey darken-1 waves-effect waves-light '>";
				echo "			<div class='card-content white-text'>";
				echo "					<span class='card-title center'>Cadastro de Desempenhos</span>";
				echo "			</div>";
				echo "		</div>";
				echo "	</div>";
				echo "</a>";
			}
		}
			?>

			<a href="../view/listarEquipes.php">
				<div class="col s8 m8 offset-m2">
					<div class="card blue-grey darken-1 waves-effect waves-light ">
						<div class="card-content white-text">
							<span class="card-title center">Listar Equipes</span>
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

			<a href="../view/listarPartidas.php">
				<div class="col s8 m8 offset-m2">
					<div class="card blue-grey darken-1 waves-effect waves-light ">
						<div class="card-content white-text">
								<span class="card-title center">Listar Partidas</span>
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
