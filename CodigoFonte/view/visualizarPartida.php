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

  <?php
    require_once("../persistence/conexao.php");
    require_once("../persistence/partidaDAO.php");
    require_once("../persistence/equipeDAO.php");
    require_once("../persistence/desempenhoDAO.php");
    require_once("../persistence/jogadorDAO.php");

    $partidaID = $_GET["id"];
    $c = new Conexao();
    $p = new PartidaDAO();
    $e = new EquipeDAO();
    $d = new DesempenhoDAO();
    $j = new JogadorDAO();

    $partida = $p->consultarPartidaPorId($partidaID, $c->getLink());
    $e1 = $e->buscarEquipe($partida->getEquipe1(), $c->getLink());
    $e2 = $e->buscarEquipe($partida->getEquipe2(), $c->getLink());

    // $desempenhos = $d->consultarDesempenhosPorIDPartida($partidaID, $c->getLink());
    $d1 = $d->consultarDesempenhosPorIDPartidaDaEquipe($partidaID, $e1->getIdEquipe(), $c->getLink());
    $d2 = $d->consultarDesempenhosPorIDPartidaDaEquipe($partidaID, $e2->getIdEquipe(), $c->getLink());
    // echo $d2->getIdPartida();

  ?>
  <div class="container center-align">
    <div class="card z-depth-5">
      <div class="card-content">
        <span class="card-title">
          <?php echo $partida->getData()." - ".$e1->getNome()." x ".$e2->getNome() ?>
        </span>

        <div class="row">
          <div class="col m6">
            <h5>
              <?php
                echo $e1->getNome();

                if($partida->getResultado() == 1 && $partida->getEstado() == 2) {
                  echo "<small>&nbsp;&nbsp;&nbsp;Win</small>";
                }
              ?>
            </h5>
            <table class="striped responsive-table">
              <thead>
                <tr>
                  <th>Nick</th>
                  <th>K</th>
                  <th>D</th>
                  <th>A</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if($d1 != null) {
                    foreach ($d1 as $ds) {
                      $jogador = $j->consultarJogadorPorEmail($ds->getIdJogador(), $c->getLink());

                      echo "<tr>";
                      echo "<td><a href='visualizarJogador.php?nick=".$jogador->getNickname()."'></a>".$jogador->getNickname()."</td>";
                      echo "<td>".$ds->getEliminacoes()."</td>";
                      echo "<td>".$ds->getMortes()."</td>";
                      echo "<td>".$ds->getAssistencias()."</td>";
                      echo "</tr>";
                    }
                  }
                ?>
              </tbody>
            </table>
          </div>

          <div class="col m6">
            <h5>
              <?php
                echo $e2->getNome();

                if($partida->getResultado() == 2 && $partida->getEstado() == 2) {
                  echo "<small>&nbsp;&nbsp;&nbsp;Win</small>";
                }
              ?>
            </h5>
            <table class="striped responsive-table">
              <thead>
                <tr>
                  <th>Nick</th>
                  <th>K</th>
                  <th>D</th>
                  <th>A</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if($d2 != null) {
                    foreach ($d2 as $ds) {
                      $jogador = $j->consultarJogadorPorEmail($ds->getIdJogador(), $c->getLink());

                      echo "<tr>";
                      echo "<td><a href='visualizarJogador.php?nick=".$jogador->getNickname()."'></a>".$jogador->getNickname()."</td>";
                      echo "<td>".$ds->getEliminacoes()."</td>";
                      echo "<td>".$ds->getMortes()."</td>";
                      echo "<td>".$ds->getAssistencias()."</td>";
                      echo "</tr>";
                    }
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

'  <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script type="text/javascript" src="js/tabelas.js"></script>
  <script>
    function confirmarDelecao(){
      var confirmacao = confirm("Deseja realmente deletar esse jogador? (não pode ser revertido)");
      if(confirmacao == true){
        var email = "<?php echo $jogador->getEmail()?>";
        window.location = "../control/deletarJogador.php?email=" + email;
      }
    }
  </script>

</body>
</html>
