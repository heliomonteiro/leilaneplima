<?php include("cabecalho.php");
	require_once 'class/Conecta.php';
	require_once 'class/Categoria.php';

	$categoria = new Categoria($conexao);
	$categoria->setCodigo($_GET['codigo']);
	$c = $categoria->buscar();

	$retornoDelecaoCategoria = $categoria->deletar(); // array [0]->true ou false, [1]->id inserido
	if($retornoDelecaoCategoria) {
?>

	<p class="alert alert-success" >Categoria <?php echo $c['descricao']; ?> deletado com sucesso!</p>

<?php 
	} else {
?>

	<p class="alert alert-danger" >Categoria <?php echo $c['descricao']; ?> não foi deletado!</p>

<?php
}
include("rodape.php");
?>