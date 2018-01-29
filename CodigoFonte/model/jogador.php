<?php
  class Jogador{
    private $nickname;
    private $nome;
    private $email;
    private $senha;
    private $idEquipe;

    function __construct($email, $idEquipe, $nickname, $nome, $senha){
      $this->nickname = $nickname;
      $this->nome = $nome;
      $this->email = $email;
      $this->senha = $senha;
      $this->idEquipe = $idEquipe;
    }

    public function getNickname(){
      return $this->nickname;
    }

    public function getNome(){
      return $this->nome;
    }

    public function getEmail(){
      return $this->email;
    }

    public function getSenha(){
      return $this->senha;
    }

    public function getIdEquipe(){
      return $this->idEquipe;
    }
  }

?>
