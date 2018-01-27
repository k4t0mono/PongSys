<?php

require_once('../model/desempenho.php');

class DesempenhoDAO {

	function cadastrarDesempenho($d, $link) {
		$SQL = "INSERT INTO Desempenho VALUES(".$d->getIdPartida().",
						'".$d->getIdJogador()."', ".$d->getEliminacoes().",
						".$d->getMortes().", ".$d->getAssistencias().");";

		echo $SQL;
		if(!mysqli_query($link, $SQL)){
			die("Nao foi possivel inserir desempenho");
		}
	}

	function consultarDesempenhosPorIDPartida($id, $link) {
		$SQL = "SELECT * FROM Desempenho WHERE idPartida=".$id.";";

		$retorno = mysqli_query($link, $SQL);
		if(!$retorno) {
			die("Erro na consulta de Desempenho");
		}

		if(mysqli_num_rows($retorno) > 0) {
			$ret = $retorno->fetch_all();
			$desempenho = array();
			foreach($ret as $l) {
				$desempenho[] = new Desempenho($l[1], $l[0], $l[2], $l[3], $l[4]);
			}
			return $desempenho;
		}
		return null;
	}

	function consultarDesempenhosPorIDPartidaDaEquipe($id, $equipeID, $link) {
		$SQL = "SELECT D.idPartida, D.email_jogador, D.eliminações, D.mortes, D.assistencias
						FROM Jogador as J, Desempenho as D WHERE J.idEquipe=".$equipeID." and
						D.email_jogador = J.email;";

		$retorno = mysqli_query($link, $SQL);
		if(!$retorno) {
			die("Erro na consulta de Desempenho");
		}

		if(mysqli_num_rows($retorno) > 0) {
			$ret = $retorno->fetch_all();
			$desempenho = array();
			foreach($ret as $l) {
				$desempenho[] = new Desempenho($l[1], $l[0], $l[2], $l[3], $l[4]);
			}
			return $desempenho;
		}
		return null;
	}

	function consultarDesempenhoJogador($email, $link){
		$SQL = "SELECT * FROM Desempenho WHERE email_jogador = '$email';";
		$retorno = mysqli_query($link, $SQL);
		if(!$retorno){
			die("Erro na consulta de desempenho");
		}
		if(mysqli_num_rows($retorno) > 0){
			$resultado = array();
			$ret = $retorno->fetch_all();
			foreach($ret as $linha){
				$resultado[] = new Desempenho($linha[1],$linha[0],$linha[2],$linha[3],$linha[4]);
			}
			return $resultado;
		}
		return null;
	}

}

?>
