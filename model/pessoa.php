<?php
  class Pessoa{
    private $nickname;
    private $nome;
    private $email;
    private $senha;
    private $ehOrganizador;
    private $idPessoa;

    function __construct($nickname, $nome, $email, $senha, $ehOrganizador){
      $this->nickname = $nickname;
      $this->nome = $nome;
      $this->email = $email;
      $this->senha = $senha;
      $this->ehOrganizador = $ehOrganizador;
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

    public function getEhOrganizador(){
      return $this->ehOrganizador;
    }

  }

?>
