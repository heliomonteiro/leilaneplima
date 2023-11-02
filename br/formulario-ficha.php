<?php
  include("cabecalho.php");
  require_once("class/Conecta.php");
  require_once("class/UnidadeContexto.php");
  require_once("class/Categoria.php");
  require_once("class/SubCategoria.php");
  require_once("class/Ficha.php");
  require_once("class/ItensFichas.php");
  require_once("class/Tema.php");
  require_once("class/UnidadeAnalise.php");
  require_once("class/Museu.php");
  
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
  
  if(isset($_GET['ficha']) ) {
  	$codigo = $_GET['ficha'];
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
  
  	//$codigo = $_GET['ficha'];
	
	$unidade_analise = new UnidadeAnalise($conexao);
	$unidade_analise->setCodigo($pagina);
	$ua = $unidade_analise->buscar();
	
	$tema = new Tema($conexao);
	$tema->setCodigo($ua['tema']);
	$t = $tema->buscar();

	$ficha = new Ficha($conexao);
	$ficha->setCodigo($codigo);
	$f = $ficha->buscar();

	var_dump($f['codigo']); echo '<br><br>';

	$museu = new Museu($conexao);
	$museu->setCodigo($f['museu']);
	$m = $museu->buscar();

	$ficha_anterior = new Ficha($conexao);
	$ficha_anterior->setMuseu($m);
	$ficha_anterior->setCodigo($codigo);
	$f_anterior = $ficha_anterior->buscarAnterior();

	//echo 'ficha anterior: '. $f_anterior['codigo']. '<br>';

	$teste = (!empty($f_anterior)) ? $f_anterior['codigo'] : 0;
	echo "ficha anterior: $teste <br>";

?>
        
	<div class="page-header">
	  <h1>Cadastro Ficha <?= $f['indice'] ?> - Museu <?= $m['nome'] ?></h1>
	</div>

	<h2> <?=$t['letra']?> - <?=$t['descricao']?> </h2>


	<form class="form-horizontal" action="adiciona-categorias-museu.php" method="post">

	<?php
		if($pagina == 1) { //echo 'Aqui';		// formulario ficha - apenas na primeira pagina
	?>

		<input type="hidden" id="museu" name="museu" value="<?= $f['museu'] ?>">

		<div class="form-group">
		  <label for="indice" class="col-sm-2 control-label">índice</label>
		  <div class="col-sm-10">
			<input type="number" class="form-control" id="indice" name="indice" value="<?= $f['indice'] ?>">
		  </div>
		</div>

		<div class="form-group">
		  <label for="horario_funcionamento_administrativo" class="col-sm-2 control-label">Horário do atendimento administrativo</label>
		  <div class="col-sm-10">
			<input type="text" class="form-control" id="horario_funcionamento_administrativo" name="horario_funcionamento_administrativo" value="<?= $f['horario_funcionamento_administrativo'] ?>">
		  </div>
		</div>

		<div class="form-group">
		  <label for="horario_atendimento_publico" class="col-sm-2 control-label">Horário de atendimento ao público</label>
		  <div class="col-sm-10">
			<input type="text" class="form-control" id="horario_atendimento_publico" name="horario_atendimento_publico" value="<?= $f['horario_atendimento_publico'] ?>">
		  </div>
		</div>

		<div class="form-group">
		  <label for="telefone" class="col-sm-2 control-label">Telefone</label>
		  <div class="col-sm-10">
			<input type="text" class="form-control" id="telefone" name="telefone" value="<?= $f['telefone'] ?>">
		  </div>
		</div>

		<div class="form-group">
		  <label for="endereco" class="col-sm-2 control-label">Endereço</label>
		  <div class="col-sm-10">
			<input type="text" class="form-control" id="endereco" name="endereco" value="<?= $f['endereco'] ?>">
		  </div>
		</div>

		<div class="form-group">
		  <label for="situacao" class="col-sm-2 control-label">Situação</label>
		  <div class="col-sm-10">
			<select class="form-control" name="situacao" id="situacao" />
			  <option value="1" <?= ($f['situacao'] == 1) ? 'selected' : ''?> >Ativo</option>
			  <option value="2" <?= ($f['situacao'] == 2) ? 'selected' : ''?> >Inativo</option>
			</select>
		  </div>
		</div>

		<div class="form-group">
            <label for="observacoes" class="col-sm-2 control-label">Observações:</label>
            <div class="col-sm-10">
              <textarea class="form-control" id="observacoes" name="observacoes" rows="5"><?= $f['observacoes'] ?></textarea>
            </div>
        </div>

		<div class="form-group">
		  <label for="visita_tecnica" class="col-sm-2 control-label">Data da visita técnica:</label>
		  <div class="col-sm-10">
			<input type="date" class="form-control" id="visita_tecnica" name="visita_tecnica" value="<?= $f['visita_tecnica'] ?>">
		  </div>
		</div>

		<div class="form-group">
		  <label for="revisitacao" class="col-sm-2 control-label">Revisitação</label>
		  <div class="col-sm-10">
			<select class="form-control" name="revisitacao" id="revisitacao" />
			  <option value="1" <?= ($f['revisitacao'] == 1) ? 'selected' : ''?> >Visita Técnica</option>
			  <option value="2" <?= ($f['revisitacao'] == 2) ? 'selected' : ''?> >Revisitação</option>
			</select>
		  </div>
		</div>

	<?php	
		}; //fim formlario ficha
	?>

	<h3> <?=$ua['num_romano']?> - <?=$ua['descricao']?> </h3>

		<input type="hidden" name="ficha" value="<?= $codigo ?>" >
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

		  	$itens_fichas = new ItensFichas($conexao);
			$itens_fichas_anterior = new ItensFichas($conexao);
			//foreach para listar categorias tipo 1 (checkboxes) e 4 (subcategorias)
		  	foreach ($categorias as $c) {

				$categoriaAssinaladaFichaAnterior = null;

				switch ($c['tipo_categoria']) {
				    case 1: #tipo checkbox
				    	//verificar se esta categoria já foi gravada para o ficha
				    	$itens_fichas->setFicha($codigo);
				    	$itens_fichas->setCategoria($c['codigo']);

						$categoriaAssinalada = $itens_fichas->buscaCategoriaPorMuseu();

						if($f_anterior){
							$itens_fichas_anterior->setFicha($f_anterior['codigo']);
							$itens_fichas_anterior->setCategoria($c['codigo']);
							
							$categoriaAssinaladaFichaAnterior = $itens_fichas_anterior->buscaCategoriaPorMuseu();								
						}

						//var_dump($categoriaAssinaladaFichaAnterior['categoria']); // categoria anterior

						if($categoriaAssinalada){
							if($f_anterior && !$categoriaAssinaladaFichaAnterior){ // (NOVO)
							?>
								<label class="checkbox-inline text-success">
									<input type="checkbox" name="categoria[]" value="<?= $c['codigo'] ?>" checked>
									<?= $c['descricao'] ?> <i class="fa-solid fa-circle-check" style="color: #005000;"></i>
								</label>
							<?php
							} else { 
							?>
								<label class="checkbox-inline">
									<input type="checkbox" name="categoria[]" value="<?= $c['codigo'] ?>" checked>
									<?= $c['descricao'] ?>
								</label>
							<?php
							}
						} else { // caso categoria não esteja assinalada será criado checkbox sem 'checked'
							if($f_anterior && $categoriaAssinaladaFichaAnterior){ // (REMOVIDO)
							?>
								<label class="checkbox-inline text-danger">
									<input type="checkbox" name="categoria[]" value="<?= $c['codigo'] ?>">
									<?= $c['descricao'] ?> <i class="fa-solid fa-circle-xmark" style="color: #be0000;"></i>
								</label>
							<?php
							} else {
							?>
								<label class="checkbox-inline">
									<input type="checkbox" name="categoria[]" value="<?= $c['codigo'] ?>">
									<?= $c['descricao'] ?>
								</label>
							<?php
							}
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

					    	//verificar se esta SUBcategoria já foi gravada para a ficha selecionada do museu
					    	$itens_fichas->setFicha($codigo);
					    	$itens_fichas->setSubCategoria($sc['codigo']);

							$subCategoriaAssinalada = $itens_fichas->buscaSubCategoriaPorMuseu();

							if($f_anterior){
								$itens_fichas_anterior->setFicha($f_anterior['codigo']);
								$itens_fichas_anterior->setSubCategoria($sc['codigo']);
								
								$subCategoriaAssinaladaFichaAnterior = $itens_fichas_anterior->buscaSubCategoriaPorMuseu();								
							}

							if($subCategoriaAssinalada){ // Marcado
								if($f_anterior && !$subCategoriaAssinaladaFichaAnterior){ // (NOVO)
						?>
									<label class="checkbox-inline">
								    <input type="checkbox" name="sub_categoria[]" value="<?= $sc['codigo'] ?>" checked>
								   		<?= $sc['descricao'] ?> <i class="fa-solid fa-circle-check" style="color: #005000;"></i>
								  </label>
						<?php
								} else {
						?>
								  <label class="checkbox-inline">
								    <input type="checkbox" name="sub_categoria[]" value="<?= $sc['codigo'] ?>" checked>
								   		<?= $sc['descricao'] ?>
								  </label>
						<?php
								}
							} else { //Não marcado
								if($f_anterior && $subCategoriaAssinaladaFichaAnterior){ // (REMOVIDO)
						?>
									<label class="checkbox-inline">
								    <input type="checkbox" name="sub_categoria[]" value="<?= $sc['codigo'] ?>">
								   		<?= $sc['descricao'] ?> <i class="fa-solid fa-circle-xmark" style="color: #be0000;"></i>
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
					  	}

				        break;

				}

		  	}
			//foreach para listar categorias tipo 2 - Pois a categoria 2 estava aparecendo entre as checkbox (1) e subcategorias (4). Ordem errada, pois ela deve aparecer por ultimo.
		  	foreach ($categorias as $c) {
				switch ($c['tipo_categoria']) {
				    case 2: #tipo texto
				    	//verificar se esta categoria já foi gravada para o museu
				    	$itens_fichas->setFicha($codigo);
				    	$itens_fichas->setCategoria($c['codigo']);

						$categoriaTexto = $itens_fichas->buscaCategoriaPorMuseu();
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
	      <a href="formulario-ficha.php?ficha=<?= $codigo?>&pagina=<?= $paginaAnterior?>" aria-label="Previous">
	        <span aria-hidden="true">&laquo;</span>
	      </a>
	    </li>
	    <?php
	    	//cada página é uma unidade de análise, portanto, pagina = unidade de analise (no contexto deste sistema)
	    	for ($pag = 1; $pag <= $qtd_unidades_analises; $pag++) {
	    	?>
	    		<li class="<?= ($pagina == $pag) ? "active" : "disabled" ?>"><a href="formulario-ficha.php?ficha=<?= $codigo?>&pagina=<?= $pag?>"><?=$pag?></a></li>
	    	<?php
	    	}
	    ?>
	    <li>
	      <a href="formulario-ficha.php?ficha=<?= $codigo?>&pagina=<?= $proximaPagina?>" aria-label="Next">
	        <span aria-hidden="true">&raquo;</span>
	      </a>
	    </li>
	  </ul>
	</nav>

<?php include("rodape-formulario.php"); ?>