<?php	
	try {
		$conexao = new PDO("mysql:host=localhost;dbname=projeto_museus;charset=UTF8","root","");
		//#$conexao = new PDO("mysql:host=localhost;dbname=u524039621_museu;charset=UTF8","u524039621_helio","helio2016");
	} catch(PDOException $e){
		die("Não foi possível conectar ao banco de dados ".$e->getCode().": ".$e->getMessage());
	}