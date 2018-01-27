<?php
  class Conexao{
  	var $servidor;
  	var $usuario;
  	var $senha;
  	var $bd;
  	var $link;

  	function Conexao() {
  		$this->servidor = 'localhost';
  		$this->usuario = 'PongSys';
  		$this->senha = '3emM7yM1T0lW9qZK';
  		$this->bd = 'PongSys';

  		$this->link = mysqli_connect($this->servidor,
  						$this->usuario,$this->senha,$this->bd);

  		if(!$this->link) {
  			die("conexao falhou");
  		}

  	}
  	function getLink(){
  		return $this->link;
  	}

  	function fechar(){
  		mysqli_close($this->link);
  	}
  }


?>
