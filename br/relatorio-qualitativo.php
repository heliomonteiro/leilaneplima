<?php include("cabecalho.php");
	require_once "class/Conecta.php";
	require_once "class/Tema.php";
	require_once "class/UnidadeAnalise.php";
	require_once "class/UnidadeContexto.php";
	require_once "class/Categoria.php";
	require_once "class/SubCategoria.php";
	require_once "class/CategoriaMuseu.php";
?>

	<div class="page-header">
	  <h1>Relatório qualitativo</h1>
	</div>

<?php
	include("array_estados.php");
?>

	<form action="relatorio-qualitativo-2.php" method="get">
		<div>
			<p>Selecione um estado para buscar os museus</p>
              <select class="form-control" name="estado" id="estado">
                    <option value=""></option>
                <?php
                  foreach ($estados as $estado) {
                ?>
                    <option value="<?= $estado['sigla']?>"><?= $estado['nome'] ?></option>
                <?php
                  }
                ?>
              </select>
		</div>
		<button type="submit">Buscar</button>
	</form>

<?php include("rodape.php"); ?>