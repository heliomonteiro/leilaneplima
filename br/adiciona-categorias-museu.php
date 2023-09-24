<?php include("cabecalho.php");
	require_once 'class/Conecta.php';
	require_once 'class/Categoria.php';
	require_once 'class/SubCategoria.php';
	require_once 'class/ItensFichas.php';
	require_once 'class/UnidadeContexto.php';
	require_once 'class/UnidadeAnalise.php';
	require_once 'class/Tema.php';
	//require_once 'class/Museu.php';
	require_once 'class/Ficha.php';
	require_once 'class/TipoCategoria.php';

	$itens_fichas = new ItensFichas($conexao);
	$categoria = new Categoria($conexao);
	$sub_categoria = new SubCategoria($conexao);
	$unidade_contexto = new UnidadeContexto($conexao);
	$unidade_analise = new UnidadeAnalise($conexao);
	$tema = new Tema($conexao);
	$ficha = new Ficha($conexao);
	$tipo_categoria = new TipoCategoria($conexao);


	//var_dump($_POST);

	if(!empty($_POST)){
		//PARAMETRO ficha
		if(isset($_POST['ficha'])) {
			$ficha->setCodigo($_POST['ficha']);
			$f = $ficha->buscar();
		} else {
			echo "não foi informado o <strong>ficha</strong>"."<br>";
		}
		//PARAMETRO PAGINA
		if(isset($_POST['pagina'])) {
			$pagina = $_POST['pagina']; // pagina indica a unidade de analise, pois cada pagina tem um unidade de analise
			$paginaAnterior = $pagina - 1;
			$proximaPagina = $pagina + 1;
		} else {
			echo "não foi informado a <strong>pagina/unidade de analise</strong>"."<br>";
		}

	if(isset($_POST['museu'])) {
		$ficha->setIndice($_POST['indice']);

		$ficha->setHorarioFuncionamentoAdministrativo($_POST['horario_funcionamento_administrativo']);
		$ficha->setHorarioAtendimentoPublico($_POST['horario_atendimento_publico']);

		$ficha->setTelefone($_POST['telefone']);
		$ficha->setEndereco($_POST['endereco']);

		$ficha->setSituacao($_POST['situacao']);
		$ficha->setVisitaTecnica($_POST['visita_tecnica']);
		$ficha->setRevisitacao($_POST['revisitacao']);

		$ficha->setObservacoes($_POST['observacoes']);

		$ficha->setMuseu($_POST['museu']);
		$ficha->setCodigo($_POST['ficha']);


	$retornoAlteracaoFicha = $ficha->alterar(); // array [0]->true ou false, [1]->id inserido

		var_dump($retornoAlteracaoFicha);

	if($retornoAlteracaoFicha[0]) {
	?>

		<p class="alert alert-success" >Ficha <?php echo $ficha->getIndice(); ?> alterado com sucesso!</p>

	<?php 
		} else {
	?>

		<p class="alert alert-danger" >Ficha <?php echo $ficha->getIndice(); ?> não foi alterado!</p>

	<?php
	}

	} else {
		echo "não foi informado o <strong>museu</strong>"."<br>";
	}
	//echo '<br>';
	//	var_dump($ficha);


		//PARAMETRO CATEGORIAS
		if(isset($_POST['categoria'])) {
			//PERCORRE CATEGORIAS E GRAVA
			foreach($_POST['categoria'] AS $cat) {
				$categoria->setCodigo($cat);
				$c = $categoria->buscar();
				switch ($c['tipo_categoria']) {

				    case 1: #tipo checkbox
				    	#echo "categoria = ".$c['codigo']." - ".$c['descricao'];

						$unidade_contexto->setCodigo($c['unidade_contexto']);
						$uc = $unidade_contexto->buscar();

						$unidade_analise->setCodigo($uc['unidade_analise']);
						$ua = $unidade_analise->buscar();

						$tema->setCodigo($ua['tema']);
						$t  = $tema->buscar();

						$itens_fichas->setFicha($f['codigo']);
						$itens_fichas->setTema($t['codigo']);
						$itens_fichas->setUnidadeAnalise($ua['codigo']);
						$itens_fichas->setUnidadeContexto($uc['codigo']);
						$itens_fichas->setCategoria($c['codigo']);
						
						//Confere se esta categoria ja foi inserida para este ficha. Se não, insere.
						$resultadoBusca = $itens_fichas->buscaCategoriaPorMuseu();
						if($resultadoBusca){
							?>
								<p class="alert alert-warning" >Categoria "<?= $c['codigo'] ?> - <?= $c['descricao'] ?>" já existe para este Museu!</p>
							<?php
						} else {
							//insere categoria
							$resultadoInsercao = $itens_fichas->inserirCategoria();
							if($resultadoInsercao) {
						?>

							<p class="alert alert-success" >Categoria "<?= $c['codigo'] ?> - <?= $c['descricao'] ?>" adicionado com sucesso!</p>

						<?php 
							} else {
						?>

							<p class="alert alert-danger" >Categoria "<?= $c['codigo'] ?> - <?= $c['descricao'] ?>" não foi adicionado!</p>

						<?php
							}
						}
				        break;
				}
			}
			
			//PEGA CATEGORIAS DESMARCADAS (GRAVADAS NO BANCO DE DADOS, PORÉM NÃO ENVIADAS POR PARAMETRO PARA GRAVAÇÃO)
			$unidade_analise_atual = $pagina;

			$itens_fichas->setUnidadeAnalise($unidade_analise_atual);
			$categoriasDaUnidadeDeAnalise = $itens_fichas->buscaCategoriasPorUnidadeDeAnalise();

			$categoriasDesmarcadas = array();

			foreach ($categoriasDaUnidadeDeAnalise as $cats) {

				$categoriaGravada = false;
				$tipoCheckboxe = false;

				if($cats['tipo_categoria'] == 1) {

					$tipoCheckboxe = true;

					foreach ($_POST['categoria'] as $cat) {

						if($cat == $cats['categoria']) {
							$categoriaGravada = true;
						} 
					}

				}


				if($categoriaGravada) {

				} else if (!$categoriaGravada && $tipoCheckboxe) {
					array_push($categoriasDesmarcadas, $cats['categoria']);
				}

			}

			foreach ($categoriasDesmarcadas as $cs) {
					$itens_fichas->setCategoria($cs);
					$retornoDelecaoCategoria = $itens_fichas->deletaCategoria();

					$categoria->setCodigo($cs);
					$cs2 = $categoria->buscar();

					if($retornoDelecaoCategoria) {
						?>
							<p class="alert alert-danger" >Categoria "<?= $cs2['codigo'] ?> - <?= $cs2['descricao'] ?>" desmarcada!</p>
						<?php
					}
			}

		} else {
			echo "não foi marcado nenhuma <strong>categoria</strong>"."<br>";
		}
		//PARAMETRO SUB_CATEGORIAS
		if(isset($_POST['sub_categoria'])){
			//PERCORRE CATEGORIAS E GRAVA
			foreach($_POST['sub_categoria'] AS $scat) {

				$sub_categoria->setCodigo($scat);
				$sc = $sub_categoria->buscar();

				#echo "subcategoria = ".$sc['codigo']." - ".$sc['descricao'];

				$categoria->setCodigo($sc['categoria']);
				$c = $categoria->buscar();

				$unidade_contexto->setCodigo($c['unidade_contexto']);
				$uc = $unidade_contexto->buscar();

				$unidade_analise->setCodigo($uc['unidade_analise']);
				$ua = $unidade_analise->buscar();

				$tema->setCodigo($ua['tema']);
				$t  = $tema->buscar();

				$itens_fichas->setFicha($f['codigo']);
				$itens_fichas->setTema($t['codigo']);
				$itens_fichas->setUnidadeAnalise($ua['codigo']);
				$itens_fichas->setUnidadeContexto($uc['codigo']);
				$itens_fichas->setCategoria($c['codigo']);
				$itens_fichas->setSubCategoria($sc['codigo']);
				
				//Confere se esta categoria ja foi inserida para esta ficha. Se não, insere.
				$resultadoBusca = $itens_fichas->buscaSubCategoriaPorMuseu();
				if($resultadoBusca){
					?>
						<p class="alert alert-warning" >SubCategoria "<?= $sc['codigo'] ?> - <?= $sc['descricao'] ?>" já existe para esta ficha!</p>
					<?php
				} else {
					//insere subcategoria
					$resultadoInsercao = $itens_fichas->inserirSubCategoria();
					if($resultadoInsercao) {
				?>

					<p class="alert alert-success" >SubCategoria "<?= $sc['codigo'] ?> - <?= $sc['descricao'] ?>" adicionado com sucesso!</p>

				<?php 
					} else {
				?>

					<p class="alert alert-danger" >SubCategoria "<?= $sc['codigo'] ?> - <?= $sc['descricao'] ?>" não foi adicionado!</p>

				<?php
					}
				}

			}

			//PEGA SUB CATEGORIAS DESMARCADAS (GRAVADAS NO BANCO DE DADOS, PORÉM NÃO ENVIADAS POR PARAMETRO PARA GRAVAÇÃO)
			$unidade_analise_atual = $pagina;

			$itens_fichas->setUnidadeAnalise($unidade_analise_atual);
			$subCategoriasDaUnidadeDeAnalise = $itens_fichas->listarSubCategoriasPorUnidadeDeAnalise();

			$subCategoriasDesmarcadas = array();

			foreach ($subCategoriasDaUnidadeDeAnalise as $scats) { 

				$subCategoriaGravada = false;


				foreach ($_POST['sub_categoria'] as $scat) {

					if($scat == $scats['sub_categoria']) {
						$subCategoriaGravada = true;
					} 
				}



				if($subCategoriaGravada) {

				} else {
					array_push($subCategoriasDesmarcadas, $scats['sub_categoria']);
				}

			}

			foreach ($subCategoriasDesmarcadas as $scs) {

					$itens_fichas->setSubCategoria($scs);
					$retornoDelecaoSubCategoria = $itens_fichas->deletaSubCategoria();

					if($retornoDelecaoSubCategoria) {
					?>
						<p class="alert alert-danger" >SubCategoria "<?= $scs ?>" desmarcada!</p>
					<?php
					}
			}

		} else {
			echo "não foi marcado nenhuma <strong>subcategoria</strong>"."<br>";
		}
		//PARAMETRO ID_CATEGORIA_TEXTO
		if(isset($_POST['id_categoria_texto'])) {

		} else {
			echo "não tem <strong>categoria do tipo texto para gravar</strong>"."<br>";
		}
		//PARAMETRO CATEGORIA TEXTO
		if(isset($_POST['categoria_texto'])) {

			$indice = 0;

			$ict = $_POST['id_categoria_texto'];
			$ct = $_POST['categoria_texto'];

			//PERCORRE CATEGORIAS TIPO TEXTO E GRAVA ID E TEXTO
			while ($indice < count($ict)){

				$categoria->setCodigo($ict[$indice]);
				$c = $categoria->buscar();

				$unidade_contexto->setCodigo($c['unidade_contexto']);
				$uc = $unidade_contexto->buscar();

				$unidade_analise->setCodigo($uc['unidade_analise']);
				$ua = $unidade_analise->buscar();

				$tema->setCodigo($ua['tema']);
				$t  = $tema->buscar();

				$itens_fichas->setFicha($f['codigo']);
				$itens_fichas->setTema($t['codigo']);
				$itens_fichas->setUnidadeAnalise($ua['codigo']);
				$itens_fichas->setUnidadeContexto($uc['codigo']);
				$itens_fichas->setCategoria($c['codigo']);

				//INSERE CATEGORIA
				//INSERE ITENS FICHAS DAS CATEGORIAS TIPO TEXTO
				//Confere se esta categoria ja foi inserida para esta ficha. Se não, insere.
				$resultadoBusca = $itens_fichas->buscaCategoriaPorMuseu();

				if($resultadoBusca){
					?>
						<p class="alert alert-warning" >Categoria "<?= $c['codigo'] ?> - <?= $c['descricao'] ?>" já existe para esta Ficha e foi alterada!</p>
					<?php
				} else {
					//insere categoria
					$resultadoInsercao = $itens_fichas->inserirCategoria();
					if($resultadoInsercao) {
					?>
						<p class="alert alert-success" >Categoria "<?= $c['codigo'] ?> - <?= $c['descricao'] ?>" adicionado com sucesso!</p>

					<?php 
					} else {
					?>
						<p class="alert alert-danger" >Categoria "<?= $c['codigo'] ?> - <?= $c['descricao'] ?>" não foi adicionado!</p>

					<?php
					}
				}

				//ATUALIZA TEXTO CATEGORIA
				//INSERE TEXTO NA CATEGORIA MUSEU
				$itens_fichas->setTexto($ct[$indice]);

				$resultado_alteracao = $itens_fichas->alterarCategoriaTexto();
				if($resultado_alteracao){
				?>
					<p class="alert alert-success" >Categoria "<?= $c['codigo'] ?> - <?= $c['descricao'] ?> - texto: <?= $itens_fichas->getTexto() ?>" alterado com sucesso!</p>
				<?php
				} else {
				?>
					<p class="alert alert-danger" >Categoria "<?= $c['codigo'] ?> - <?= $c['descricao'] ?> - texto: <?= $itens_fichas->getTexto() ?>" não foi alterada!</p>
				<?php
				}

				$indice++;
			}
		} else {
			echo "não tem <strong>categoria do tipo texto para alterar descrição</strong>"."<br>";
		}

	} else {
		// NÃO FOI ENVIADO NENHUM PARAMETRO
		echo "Favor enviar parametros pelo formulario"."<br>";
	}

?>
<nav>
  <ul class="pager">
    <li class="previous disabled"><a href="#"><span aria-hidden="true">&larr;</span>Anterior</a></li>
<?php if($pagina == 14){ ?>
    <li class="next"><a href="listagem-museus.php">Finalizar <span aria-hidden="true">&rarr;</span></a></li>
<?php }	else { ?>
    <li class="next"><a href="formulario-ficha.php?ficha=<?= $f['codigo'] ?>&pagina=<?= $proximaPagina?>">Próximo <span aria-hidden="true">&rarr;</span></a></li>
<?php } ?>
  </ul>
</nav>
<?php

include("rodape.php");
?>