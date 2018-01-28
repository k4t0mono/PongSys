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
			<div class="col m8 m8 offset-m2">
				<div class="card blue-grey darken-1">
					<div class="card-content white-text">
						<span class="card-title center">Cadastro de Desempenho</span>
					</div>

					<div class="card-content white-text">
						<form method="post" action="../control/cadastrarDesempenho.php">
							<div class="row margin">
								<div class="input-field col m6">
									<select id="jogador" name="jogador">
										<option value="" disabled="true" selected="true">Selecione um jogador</option>
										<?php
											require_once("../persistence/conexao.php");
											require_once("../persistence/jogadorDAO.php");

											$c = new Conexao();
											$j = new JogadorDAO();


											$jogadores = $j->listarJogadores($c->getLink());
											if($jogadores != null) {
												foreach($jogadores as $jogador) {
													echo "<option value='" . $jogador->getEmail() . "'>";
													echo $jogador->getNickname() . "</option>";
												}
											}
										?>
									</select>
									<label for="jogador">Jogador</label>
								</div>

								<div class="input-field col m6" id="carregaPartida">
									<input id="carregaPartida" type="button" class="waves-effect waves-light btn left-align"  value="Carregar partidas"  />
								</div>
							</div>

							<div class="row margin">
								<div class="input-field col m12">
									<select id="partida" name="partida">
										<option value="" disabled="true" selected="true">Selecione uma partida</option>
										<?php
											require_once("../persistence/partidaDAO.php");
											require_once("../persistence/equipeDAO.php");

											$e = new EquipeDAO();
											$p = new partidaDAO();

											if(array_key_exists('jogador', $_GET)) {
												$jogador = $j->consultarJogadorPorEmail($_GET['jogador'], $c->getLink());
												$partidas = $p->consultarPartidasDaEquipe($jogador->getIdEquipe(), $c->getLink());
												foreach ($partidas as $par) {
													$e1 = $e->buscarEquipe($par->getEquipe1(), $c->getLink());
													$e2 = $e->buscarEquipe($par->getEquipe2(), $c->getLink());

													echo "<option value=".$par->getIdPartida().">".$par->getData()." - ".$e1->getNome()." x ".$e2->getNome();
													echo "</option>";
												}
											}

										?>
									</select>
									<label for="partida">Partida</label>
								</div>
							</div>

							<div class="row margin">
								<div class="input-field col m4">
									<input name="k" id="k" type="number" min="0" value="0" />
									<label for="k">Eliminações</label>
								</div>

								<div class="input-field col m4">
									<input name="d" id="d" type="number" min="0" value="0" />
									<label for="d">Mortes</label>
								</div>

								<div class="input-field col m4">
									<input name="a" id="a" type="number" min="0" value="0" />
									<label for="a">Assistências</label>
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

			var url = new URL(window.location.href);
			var c = url.searchParams.get("jogador");
			$('#jogador').val(c);
			$('select').material_select();
			console.log($('#jogador').val());

			$('#carregaPartida').click(function() {
				var jogador = encodeURIComponent($("#jogador").val());
				window.location.href = `cadastroDesempenho.php?jogador=${jogador}`;
			})
		});
	</script>
</body>
</html>
