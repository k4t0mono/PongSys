<?php
  require_once('./model/pessoa.php');

  class PessoaDAO{
    function cadastrarPessoa($pessoa, $link){
      $SQL = "INSERT INTO Pessoa VALUES (0,
                                          '".$pessoa->getNickname()."',
                                          '".$pessoa->getNome()."',
                                          '".$pessoa->getEmail()."',
                                          '".$pessoa->getSenha()."',
                                          0);";

  		if (!mysqli_query($link, $SQL)) {
  			die("Erro na inserção de cliente");
  		}
    }
  }


?>
