<?php include("cabecalho.php");
	require_once 'class/Conecta.php';
	require_once 'class/Categoria.php';
	require_once 'class/SubCategoria.php';
	require_once 'class/CategoriaMuseu.php';
	require_once 'class/UnidadeContexto.php';
	require_once 'class/UnidadeAnalise.php';
	require_once 'class/Tema.php';
	require_once 'class/Museu.php';
	require_once 'class/TipoCategoria.php';

	$categoria_museu = new CategoriaMuseu($conexao);
	$categoria = new Categoria($conexao);
	$sub_categoria = new SubCategoria($conexao);
	$unidade_contexto = new UnidadeContexto($conexao);
	$unidade_analise = new UnidadeAnalise($conexao);
	$tema = new Tema($conexao);
	$museu = new Museu($conexao);
	$tipo_categoria = new TipoCategoria($conexao);

	if(!empty($_POST)){
		//PARAMETRO MUSEU
		if(isset($_POST['museu'])) {
			$museu->setCodigo($_POST['museu']);
			$m = $museu->buscar();
		} else {
			echo "não foi informado o <strong>museu</strong>"."<br>";
		}
		//PARAMETRO PAGINA
		if(isset($_POST['pagina'])) {
			$pagina = $_POST['pagina']; // pagina indica a unidade de analise, pois cada pagina tem um unidade de analise
			$paginaAnterior = $pagina - 1;
			$proximaPagina = $pagina + 1;
		} else {
			echo "não foi informado a <strong>pagina/unidade de analise</strong>"."<br>";
		}
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

						$categoria_museu->setMuseu($m['codigo']);
						$categoria_museu->setTema($t['codigo']);
						$categoria_museu->setUnidadeAnalise($ua['codigo']);
						$categoria_museu->setUnidadeContexto($uc['codigo']);
						$categoria_museu->setCategoria($c['codigo']);
						
						//Confere se esta categoria ja foi inserida para este museu. Se não, insere.
						$resultadoBusca = $categoria_museu->buscaCategoriaPorMuseu();
						if($resultadoBusca){
							?>
								<p class="alert alert-warning" >Categoria "<?= $c['codigo'] ?> - <?= $c['descricao'] ?>" já existe para este Museu!</p>
							<?php
						} else {
							//insere categoria
							$resultadoInsercao = $categoria_museu->inserirCategoria();
							var_dump($categoria_museu);
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

			$categoria_museu->setUnidadeAnalise($unidade_analise_atual);
			$categoriasDaUnidadeDeAnalise = $categoria_museu->buscaCategoriasPorUnidadeDeAnalise();

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
					$categoria_museu->setCategoria($cs);
					$retornoDelecaoCategoria = $categoria_museu->deletaCategoria();

					if($retornoDelecaoCategoria) {
						?>
							<p class="alert alert-danger" >Categoria "<?= $cs ?>" desmarcada!</p>
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

				$categoria_museu->setMuseu($m['codigo']);
				$categoria_museu->setTema($t['codigo']);
				$categoria_museu->setUnidadeAnalise($ua['codigo']);
				$categoria_museu->setUnidadeContexto($uc['codigo']);
				$categoria_museu->setCategoria($c['codigo']);
				$categoria_museu->setSubCategoria($sc['codigo']);
				
				//Confere se esta categoria ja foi inserida para este museu. Se não, insere.
				$resultadoBusca = $categoria_museu->buscaSubCategoriaPorMuseu();
				if($resultadoBusca){
					?>
						<p class="alert alert-warning" >SubCategoria "<?= $sc['codigo'] ?> - <?= $sc['descricao'] ?>" já existe para este Museu!</p>
					<?php
				} else {
					//insere subcategoria
					$resultadoInsercao = $categoria_museu->inserirSubCategoria();
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

			$categoria_museu->setUnidadeAnalise($unidade_analise_atual);
			$subCategoriasDaUnidadeDeAnalise = $categoria_museu->listarSubCategoriasPorUnidadeDeAnalise();

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

					$categoria_museu->setSubCategoria($scs);
					$retornoDelecaoSubCategoria = $categoria_museu->deletaSubCategoria();

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

				$categoria_museu->setMuseu($m['codigo']);
				$categoria_museu->setTema($t['codigo']);
				$categoria_museu->setUnidadeAnalise($ua['codigo']);
				$categoria_museu->setUnidadeContexto($uc['codigo']);
				$categoria_museu->setCategoria($c['codigo']);

				//INSERE CATEGORIA
				//INSERE CATEGORIA_MUSEU DAS CATEGORIAS TIPO TEXTO
				//Confere se esta categoria ja foi inserida para este museu. Se não, insere.
				$resultadoBusca = $categoria_museu->buscaCategoriaPorMuseu();

				if($resultadoBusca){
					?>
						<p class="alert alert-warning" >Categoria "<?= $c['codigo'] ?> - <?= $c['descricao'] ?>" já existe para este Museu e foi alterada!</p>
					<?php
				} else {
					//insere categoria
					$resultadoInsercao = $categoria_museu->inserirCategoria();
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
				$categoria_museu->setTexto($ct[$indice]);

				$resultado_alteracao = $categoria_museu->alterarCategoriaTexto();
				if($resultado_alteracao){
				?>
					<p class="alert alert-success" >Categoria "<?= $c['codigo'] ?> - <?= $c['descricao'] ?> - texto: <?= $categoria_museu->getTexto() ?>" alterado com sucesso!</p>
				<?php
				} else {
				?>
					<p class="alert alert-danger" >Categoria "<?= $c['codigo'] ?> - <?= $c['descricao'] ?> - texto: <?= $categoria_museu->getTexto() ?>" não foi alterada!</p>
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
    <li class="next"><a href="formulario-ficha.php?museu=<?= $m['codigo'] ?>&pagina=<?= $proximaPagina?>">Próximo <span aria-hidden="true">&rarr;</span></a></li>
<?php } ?>
  </ul>
</nav>
<?php

include("rodape.php");
?>