<?php include("cabecalho.php");
	require_once 'class/Ficha.php';
	require_once 'class/Conecta.php';

	$ficha = new Ficha($conexao);
	$ficha->setMuseu($_GET['museu']);


	//buscar ultimo indice e incrementar
	$retornoBuscaUltimoIndice = $ficha->buscarUltimoIndice(); 
	$ultimo_indice = $retornoBuscaUltimoIndice['ultima_ficha'];
	$proximo_indice = $ultimo_indice + 1;

	$ficha->setIndice($proximo_indice);

	$retornoInsercaoFichaVazia = $ficha->insereVazio(); // array [0]->true ou false, [1]->id inserido


	if($retornoInsercaoFichaVazia[0]) {
?>

	<p class="alert alert-success" >Ficha <?php echo $ficha->getIndice(); ?> adicionado com sucesso!</p>

<?php 
	} else {
?>

	<p class="alert alert-danger" >Ficha <?php echo $ficha->getIndice(); ?> não foi adicionado!</p>

<?php

//redireciona devolta
$URL_ATUAL= "http://$_SERVER[HTTP_HOST]/Museus/br/listagem-museus.php";
header("location: $URL_ATUAL");

}
include("rodape.php");
?>