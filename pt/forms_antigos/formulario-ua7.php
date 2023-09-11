<?php
  include("cabecalho.php");
  require_once("class/Conecta.php");
  require_once("class/UnidadeContexto.php");
  require_once("class/Categoria.php");
  require_once("class/SubCategoria.php");
  require_once("class/CategoriaMuseu.php");
  
  $pagina = 7;
  $proximaPagina = $pagina + 1;
  $paginaAnterior = $pagina - 1;

  $museu = $_GET['museu'];

?>
        
	<div class="page-header">
	  <h1>Cadastro Ficha</h1>
	</div>

	<h2> A - Museu</h2>
	<h3> VII - Sobre a organização espacial</h3>

	<form class="form-horizontal" action="adiciona-categorias-museu.php" method="get">

		<input type="hidden" name="museu" value="<?= $museu ?>" >
		<input type="hidden" name="pagina" value="<?= $pagina ?>" >

	<div class="unidades_contextos">

		<?php // listagem unidades contexto
		  $unidade_contexto = new UnidadeContexto($conexao);
		  $unidade_contexto->setUnidadeAnalise($pagina);
		  $unidades_contextos = $unidade_contexto->listarPorUnidadeAnalise();
		  foreach($unidades_contextos as $uc) :
		?>

		  <h4 class="texto_unidade_cntexto"><?= $uc['num_cardinal']?> - <?= $uc['descricao']?></h4>

		  <?php // listagem categorias
		  	$categoria = new Categoria($conexao); 
		  	$categoria->setUnidadeContexto($uc['codigo']);
		  	$categorias = $categoria->listarPorUnidadeContexto();

		  	$categoria_museu = new CategoriaMuseu($conexao);

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
			              <input type="text" class="form-control" name="categoria_texto[]" value="<?= $texto ?>">
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
				    default:
				    ?>
				        <p>sem categorias</p>
				    <?php
				}

		  	}

		  endforeach
		  ?>
	</div>

	  <div class="form-group">
	    <div class="">
	      <button type="submit" class="btn btn-default">Salvar</button>
	    </div>
	  </div>
	</form>

	<nav>
	  <ul class="pagination">
	    <li>
	      <a href="formulario-ua<?= $paginaAnterior ?>.php?museu=<?= $museu?>" aria-label="Previous">
	        <span aria-hidden="true">&laquo;</span>
	      </a>
	    </li>
	    <li class="disabled"><a href="formulario-ua1.php?museu=<?= $museu?>">1</a></li>
	    <li class="disabled"><a href="formulario-ua2.php?museu=<?= $museu?>">2</a></li>
	    <li class="disabled"><a href="formulario-ua3.php?museu=<?= $museu?>">3</a></li>
	    <li class="disabled"><a href="formulario-ua4.php?museu=<?= $museu?>">4</a></li>
	    <li class="disabled"><a href="formulario-ua5.php?museu=<?= $museu?>">5</a></li>
	    <li class="disabled"><a href="formulario-ua6.php?museu=<?= $museu?>">6</a></li>
	    <li class="active"><a href="formulario-ua7.php?museu=<?= $museu?>">7</a></li>
	    <li class="disabled"><a href="formulario-ua8.php?museu=<?= $museu?>">8</a></li>
	    <li class="disabled"><a href="formulario-ua9.php?museu=<?= $museu?>">9</a></li>
	    <li class="disabled"><a href="formulario-ua10.php?museu=<?= $museu?>">10</a></li>
	    <li class="disabled"><a href="formulario-ua11.php?museu=<?= $museu?>">11</a></li>
	    <li class="disabled"><a href="formulario-ua12.php?museu=<?= $museu?>">12</a></li>
	    <li class="disabled"><a href="formulario-ua13.php?museu=<?= $museu?>">13</a></li>
	    <li class="disabled"><a href="formulario-ua14.php?museu=<?= $museu?>">14</a></li>
	    <li>
	      <a href="formulario-ua<?= $proximaPagina ?>.php?museu=<?= $museu?>" aria-label="Next">
	        <span aria-hidden="true">&raquo;</span>
	      </a>
	    </li>
	  </ul>
	</nav>

<?php include("rodape-formulario.php"); ?>