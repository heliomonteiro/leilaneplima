<?php include("cabecalho.php");
	require_once 'class/Conecta.php';
	require_once 'class/Categoria.php';

	$categoria = new Categoria($conexao);
	$categoria->setUnidadeContexto($_GET['unidade_contexto']);
	$categoria->setTipoCategoria($_GET['tipo_categoria']);
	$categoria->setDescricao($_GET['descricao']);

	$retornoInsercaoCategoria = $categoria->inserir(); // array [0]->true ou false, [1]->id inserido
	if($retornoInsercaoCategoria) {
?>

	<p class="alert alert-success" >Categoria <?php echo $categoria->getDescricao(); ?> adicionado com sucesso!</p>

<?php 
	} else {
?>

	<p class="alert alert-danger" >Categoria <?php echo $categoria->getDescricao(); ?> não foi adicionado!</p>

<?php
}
include("rodape.php");
?>