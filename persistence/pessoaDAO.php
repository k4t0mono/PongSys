<?php
  require_once('./model/pessoa.php');

  class PessoaDAO{
    function cadastrarPessoa($pessoa, $link){
      $SQL = "INSERT INTO Pessoa VALUES ( '".$pessoa->getEmail()."',
                                          '".$pessoa->getNickname()."',
                                          '".$pessoa->getNome()."',
                                          '".$pessoa->getSenha()."',
                                          0);";

  		if (!mysqli_query($link, $SQL)) {
  			die("Erro na inserção de cliente");
  		} 
    }

    function consultarPessoaPorEmail($email, $link){

      $SQL = "SELECT * FROM Pessoa WHERE email ='$email';";

      echo $SQL."<br />";
      $retorno = mysqli_query($link, $SQL);
      if(!$retorno){
        die("Erro na consulta de cliente");
      }
      if(mysqli_num_rows($retorno) > 0){
        $ret = $retorno->fetch_all();
        $resultado = new Pessoa($ret[0],$ret[1],$ret[2],$ret[3]);
        return $resultado;
      }
      return null;
    }
  }


?>
