<?php
  require_once("pessoa.php");

  class Jogador extends Pessoa{
    private $idEquipe;

    function __construct($nickname, $nome, $email, $senha, $ehOrganizador, $idEquipe){
      parent::__construct($nickname, $nome, $email, $senha, $ehOrganizador);
      $this->idEquipe = $idEquipe;
    }

    public function getIdEquipe(){
      return $this->idEquipe;
    }


  }

?>
