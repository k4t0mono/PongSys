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

	<div class="container">
		<div class="row">
			<div class="col s8 m8 offset-m2">
				<div class="card blue-grey darken-1">
					<div class="card-content white-text">
						<span class="card-title center">Cadastro de Partida</span>
					</div>

					<div class="card-content white-text">
						<form method="post" action="../control/cadastrarPartida.php">
							<div class="row margin">
								<div class="input-field col s6">
									<select id="equipe1" name="equipe1">
										<option value="" disabled="true" selected="true">Selecione uma equipe</option>
										<?php
											require_once("../persistence/conexao.php");
											require_once("../persistence/equipeDAO.php");

											$c = new Conexao();
											$e = new EquipeDAO();
											$equipes = $e->listarEquipes($c->getLink());
											if($equipes != null) {
												foreach($equipes as $equipe) {
													echo "<option value='" . $equipe->getIdEquipe() . "'>";
													echo $equipe->getNome() . "</option>";
												}
											}
										?>
									</select>
									<label for="eqipe1">Equipe 1</label>
								</div>

								<div class="input-field col s6">
									<select id="equipe2" name="equipe2">
										<option value="" disabled="true" selected="true">Selecione uma equipe</option>
										<?php
											require_once("../persistence/conexao.php");
											require_once("../persistence/equipeDAO.php");

											$c = new Conexao();
											$e = new EquipeDAO();
											$equipes = $e->listarEquipes($c->getLink());
											if($equipes != null) {
												foreach($equipes as $equipe) {
													echo "<option value='" . $equipe->getIdEquipe() . "'>";
													echo $equipe->getNome() . "</option>";
												}
											}
										?>
									</select>
									<label for="eqipe2">Equipe 2</label>
								</div>
							</div>

							<div class="row margin">
								<div class="input-field col s6">
									<input type="text" class="datepicker" name="data" />
									<label for="data">Data</label>
								</div>

								<div class="input-field col s6">
									<input type="text" class="timepicker" name="horario" />
									<label for="horario">Horário</label>
								</div>
							</div>

							<div class="row margin">
								<div class="input-field col s6">
									<select id="estado" name="estado">
										<option value="" disabled="true" selected="true">Selecione uma equipe</option>
										<option value="0">Não realizada</option>
										<option value="1">Em andamento</option>
										<option value="2">Concluída</option>
									</select>
									<label for="estado">Estado</label>
								</div>

								<div class="input-field col s6">
									<select id="ganhador" name="ganhador">
										<option value="" disabled="true" selected="true">Selecione uma equipe</option>
										<?php
											require_once("../persistence/conexao.php");
											require_once("../persistence/equipeDAO.php");

											$c = new Conexao();
											$e = new EquipeDAO();
											$equipes = $e->listarEquipes($c->getLink());
											if($equipes != null) {
												foreach($equipes as $equipe) {
													echo "<option value='" . $equipe->getIdEquipe() . "'>";
													echo $equipe->getNome() . "</option>";
												}
											}
										?>
									</select>
									<label for="ganhador">Equipe ganhadora</label>
								</div>
							</div>

							<button type="reset" class="waves-effect waves-light btn left-align">Limpar</button>
							<button type="submit" class="waves-effect waves-light btn right-align">Enviar</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('select').material_select();

			$('.datepicker').pickadate({
				selectMonths: true,
				selectYears: 2,
				format: 'dd/mm/yyyy'
			});

			$('.timepicker').pickatime({
				default: 'now',
				twelvehour: false
			});
		});
	</script>
</body>
</html>
