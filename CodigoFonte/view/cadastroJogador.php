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
      <a href="../view" class="brand-logo">PongSys</a>

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
                echo "<li><a href='../view/edicaoJogador.php?nick=".$usuario->getNickname()."'>Bem-vindo, ".$usuario->getNome()."</a></li>";
                echo "<li><a href='../control/logoff.php'>Logoff</a></li>";
              }
              else{
                echo "<li><a href='login.php'>Login</a></li>";
              }
            }
            else{
              echo "<li><a href='login.php'>Login</a></li>";
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
            <span class="card-title center">Cadastro de Jogador</span>
          </div>

          <div class="card-content white-text">
            <form method="post" action="../control/cadastrarJogador.php">
              <div class="row margin">
                <div class="input-field col s12">
                  <input sid="nome" name="nome" type="text" required/>
                  <label for="nome">Nome</label>
                </div>
              </div>

              <div class="row margin">
                <div class="input-field col s12">
                  <input id="email" name="email" type="email" class="validate" required/>
                  <label for="email">Email</label>
                </div>
              </div>

              <div class="row margin">
                <div class="input-field col s6">
                  <input id="nick" name="nick" type="text" required/>
                  <label for="nick">Nick</label>
                </div>

                <div class="input-field col s6">
                  <!-- <input id="equipe" name="equipe" type="text" /> -->
                  <select id="equipe" name="equipe" required>
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
                  <label for="equipe">Equipe</label>
                </div>
              </div>

              <div class="row margin">
                <div class="input-field col s6">
                  <input id="pass" name="pass" type="password" required/>
                  <label for="pass">Senha</label>
                </div>

                <div class="input-field col s6">
                  <input id="pass_confirm" name="pass_confirm" type="password" required/>
                  <label for="pass_confirm">Confirmação da Senha</label>
                </div>
              </div>

              <button type="reset" class="waves-effect waves-light btn left-align">Limpar</button>
              <button type="submit" class="waves-effect waves-light btn right-align" id="enviar">Enviar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

'  <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('select').material_select();

			$("#enviar").click(function() {
				if($("#equipe").val() === null) {
					Materialize.toast("Selecione uma equipe!", 4000);
				}
			});
    });
  </script>
</body>
</html>
