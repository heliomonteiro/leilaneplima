<?php include("cabecalho.php");
	require_once 'class/Conecta.php';
	require_once 'class/Categoria.php';

	$categoria = new Categoria($conexao);
	$categoria->setCodigo($_POST['codigo']);
	$categoria->setUnidadeContexto($_POST['unidade_contexto']);
	$categoria->setTipoCategoria($_POST['tipo_categoria']);
	$categoria->setDescricao($_POST['descricao']);

	$retornoAlteracaoCategoria = $categoria->alterar(); // array [0]->true ou false, [1]->id inserido
	if($retornoAlteracaoCategoria) {
?>

	<p class="alert alert-success" >Categoria <?php echo $categoria->getDescricao(); ?> alterado com sucesso!</p>

<?php 
	} else {
?>

	<p class="alert alert-danger" >Categoria <?php echo $categoria->getDescricao(); ?> não foi alterado!</p>

<?php
}
include("rodape.php");
?>