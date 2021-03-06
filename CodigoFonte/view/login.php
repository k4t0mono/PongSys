<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection" />
  <link rel="stylesheet" href="./style.css" />

  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

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

      </ul>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col s12 z-depth-4 card">
        <div class="row">
          <div class="col s12 center">
            <img href="image/logo.png" />
            <span class="card-title">PongSys</span>
          </div>
        </div>

        <form class="login-form" action="../control/login.php" method="post">
          <div class="row margin">
            <div class="input-field col s12">
              <i class="material-icons prefix">account_circle</i>
              <input id="email" type="email" class="validate" name="email">
              <label for="email" data-error="Insira um email válido">E-mail</label>
            </div>
          </div>

          <div class="row margin">
            <div class="input-field col s12">
              <i class="material-icons prefix">lock_outline</i>
              <input id="icon_prefix" type="password" name="senha">
              <label for="icon_prefix">Senha</label>
            </div>
          </div>

          <div class="row margin">
            <div class="input-field col s12">

            </div>
          </div>
          <div class="center-align">
            <button type="submit" class="waves-effect waves-light btn">Enviar</button>
          </div>
          <div class="center-align">
            <a href="../view/cadastroJogador.php">Não possui conta? Clique e registre-se</a>
          </div>

        </form>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <?php
    $fail = null;
    if(array_key_exists("fail", $_GET)){
        $fail = true;
      }
    else{
      $fail = false;
    }
  ?>
  <script>
    var fail =  "<?php echo $fail; ?>";
    // aler(fail);
    if(fail){
      Materialize.toast("Login falhou :(", 4000);
    }
  </script>


</body>
</html>
