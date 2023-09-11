<?php
  include("cabecalho.php");
  require_once("class/Conecta.php");
  require_once("class/UnidadeContexto.php");
  require_once("class/Categoria.php");
  require_once("class/SubCategoria.php");
  require_once("class/CategoriaMuseu.php");
  require_once("class/Tema.php");
  require_once("class/UnidadeAnalise.php");
  
	$qtd_unidades_analises = 14; // quantidade de páginas, pois , cada unidade de análise será utilizado em uma página

	//tratamento da página
  if(!isset($_GET['pagina'])) {
  	$pagina = 1;
  } else {
  	
  	if( ($_GET['pagina'] >= 1) && ($_GET['pagina'] <= $qtd_unidades_analises) ) {
  		$pagina = $pagina = $_GET['pagina'];
  	} else {
  		$pagina = 1;
  	}
  }
  
  if(isset($_GET['museu']) ) {
  	$museu = $_GET['museu'];
  }

  	$ultima_pagina = $qtd_unidades_analises;
  	$primeira_pagina = 1;
  	//proxima pagina
  	if($pagina == $ultima_pagina) {
 		$proximaPagina = $pagina;
  	} else {
  		$proximaPagina = $pagina + 1;
  	}
  	//pagina anterior
  	if($pagina == $primeira_pagina) {
  		$paginaAnterior = $pagina;
  	} else {
  		$paginaAnterior = $pagina - 1;
  	}
  
  	//$museu = $_GET['museu'];
	
	$unidade_analise = new UnidadeAnalise($conexao);
	$unidade_analise->setCodigo($pagina);
	$ua = $unidade_analise->buscar();
	
	$tema = new Tema($conexao);
	$tema->setCodigo($ua['tema']);
	$t = $tema->buscar();

?>
        
	<div class="page-header">
	  <h1>Cadastro Ficha</h1>
	</div>

			<h2> <?=$t['letra']?> - <?=$t['descricao']?> </h2>

	<h3> <?=$ua['num_romano']?> - <?=$ua['descricao']?> </h3>

	<form class="form-horizontal" action="adiciona-categorias-museu.php" method="post">

		<input type="hidden" name="museu" value="<?= $museu ?>" >
		<input type="hidden" name="pagina" value="<?= $pagina ?>" >

	<div class="unidades_contextos">

		<?php // listagem unidades contexto
		  $unidade_contexto = new UnidadeContexto($conexao);
		  $unidade_contexto->setUnidadeAnalise($pagina);
		  $unidades_contextos = $unidade_contexto->listarPorUnidadeAnalise();
		  foreach($unidades_contextos as $uc) {
		?>

		  <h4 class="texto_unidade_cntexto"><?= $uc['num_cardinal']?> - <?= $uc['descricao']?></h4>

		  <?php // listagem categorias
		  	$categoria = new Categoria($conexao);
		  	$categoria->setUnidadeContexto($uc['codigo']);
		  	$categorias = $categoria->listarPorUnidadeContexto();

		  	$categoria_museu = new CategoriaMuseu($conexao);
			//foreach para listar categorias tipo 1 e 4
		  	foreach ($categorias as $c) {

				switch ($c['tipo_categoria']) {
				    case 1: #tipo checkbox
				    	//verificar se esta categoria já foi gravada para o museu
				    	$categoria_museu->setMuseu($museu);
				    	$categoria_museu->setCategoria($c['codigo']);

						$categoriaAssinalada = $categoria_museu->buscaCategoriaPorMuseu();
						if($categoriaAssinalada){
						?>
							<label class="checkbox-inline">
						    	<input type="checkbox" name="categoria[]" value="<?= $c['codigo'] ?>" checked>
						   			<?= $c['descricao'] ?>
						 	</label>
						<?php
						} else { // caso categoria não esteja assinalada será criado checkbox sem 'checked'
				    ?>
						  <label class="checkbox-inline">
						    <input type="checkbox" name="categoria[]" value="<?= $c['codigo'] ?>">
						   		<?= $c['descricao'] ?>
						  </label>
					<?php
						}
				        break;

				    case 3: #tipo imagem
				        
				        break;
				    case 4: #tipo subcategoria
				    ?>
						<h5><strong><?= $c['descricao'] ?></strong></h5>
					<?php // listagem subcategorias
					  	$sub_categoria = new SubCategoria($conexao); 
					  	$sub_categoria->setCategoria($c['codigo']);
					  	$sub_categorias = $sub_categoria->listarPorCategoria();
					  	foreach ($sub_categorias as $sc) {

					    	//verificar se esta SUBcategoria já foi gravada para o museu
					    	$categoria_museu->setMuseu($museu);
					    	$categoria_museu->setSubCategoria($sc['codigo']);

							$subCategoriaAssinalada = $categoria_museu->buscaSubCategoriaPorMuseu();
							if($subCategoriaAssinalada){
						?>
								  <label class="checkbox-inline">
								    <input type="checkbox" name="sub_categoria[]" value="<?= $sc['codigo'] ?>" checked>
								   		<?= $sc['descricao'] ?>
								  </label>
						<?php
							} else {
						?>
								  <label class="checkbox-inline">
								    <input type="checkbox" name="sub_categoria[]" value="<?= $sc['codigo'] ?>">
								   		<?= $sc['descricao'] ?>
								  </label>
						<?php
							}
					  	}

				        break;

				}

		  	}
			//foreach para listar categorias tipo 2 - Pois a categoria 2 estava aparecendo entre as checkbox (1) e subcategorias (4). Ordem errada, pois ela deve aparecer por ultimo.
		  	foreach ($categorias as $c) {
				switch ($c['tipo_categoria']) {
				    case 2: #tipo texto
				    	//verificar se esta categoria já foi gravada para o museu
				    	$categoria_museu->setMuseu($museu);
				    	$categoria_museu->setCategoria($c['codigo']);

						$categoriaTexto = $categoria_museu->buscaCategoriaPorMuseu();
						if($categoriaTexto){ // se esta categoria já foi gravada antes, recuperar texto
							$texto = $categoriaTexto['texto'];
							//echo $texto;

					?>
			          <div class="form-group">
			            <div class="col-sm-10">
			              <input type="hidden" class="form-control" name="id_categoria_texto[]" value="<?= $c['codigo'] ?>">
			            </div>
			          </div>
			          <div class="form-group">
			            <label for="nome" class="col-sm-2 control-label"><?= $c['descricao'] ?></label>
			            <div class="col-sm-10">
			              <input type="text" class="form-control" name="categoria_texto[]" value="<?= htmlspecialchars($texto) ?>">
			            </div>
			          </div>
					<?php
						} else { // Se não houve gravação desta categoria antes para o museu
				    ?>
			          <div class="form-group">
			            <div class="col-sm-10">
			              <input type="hidden" class="form-control" name="id_categoria_texto[]" value="<?= $c['codigo'] ?>">
			            </div>
			          </div>
			          <div class="form-group">
			            <label for="nome" class="col-sm-2 control-label"><?= $c['descricao'] ?></label>
			            <div class="col-sm-10">
			              <input type="text" class="form-control" name="categoria_texto[]">
			            </div>
			          </div>
				    <?php
						}
				}

		  	}
			if($categorias == null){

					echo "<p>sem categorias</p>";

			}
			
		  }//endforeach
		  
		  if($unidades_contextos == null) {

				    echo "<p>sem unidades de contexto</p>";
		  }
		  ?>
	</div>

	  <div class="form-group">
	    <div>
	      <button type="submit" class="btn btn-default">Salvar</button>
	    </div>
	  </div>
	</form>

	<nav>
	  <ul class="pagination">
	    <li>
	      <a href="formulario-ficha.php?museu=<?= $museu?>&pagina=<?= $paginaAnterior?>" aria-label="Previous">
	        <span aria-hidden="true">&laquo;</span>
	      </a>
	    </li>
	    <?php
	    	//cada página é uma unidade de análise, portanto, pagina = unidade de analise (no contexto deste sistema)
	    	for ($pag = 1; $pag <= $qtd_unidades_analises; $pag++) {
	    	?>
	    		<li class="<?= ($pagina == $pag) ? "active" : "disabled" ?>"><a href="formulario-ficha.php?museu=<?= $museu?>&pagina=<?= $pag?>"><?=$pag?></a></li>
	    	<?php
	    	}
	    ?>
	    <li>
	      <a href="formulario-ficha.php?museu=<?= $museu?>&pagina=<?= $proximaPagina?>" aria-label="Next">
	        <span aria-hidden="true">&raquo;</span>
	      </a>
	    </li>
	  </ul>
	</nav>

<?php include("rodape-formulario.php"); ?>