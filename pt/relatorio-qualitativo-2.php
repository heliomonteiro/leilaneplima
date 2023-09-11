<?php include("cabecalho.php");
	require_once "class/Conecta.php";
	require_once "class/Tema.php";
	require_once "class/UnidadeAnalise.php";
	require_once "class/UnidadeContexto.php";
	require_once "class/Categoria.php";
	require_once "class/SubCategoria.php";
	require_once "class/CategoriaMuseu.php";
	require_once "class/Cidade.php";
	require_once "class/museu.php";
?>

<?php
	$estado = $_GET['estado'];
	$museu = new Museu($conexao);
	$cidade = new Cidade($conexao);
?>
	<div class="page-header">
	  <h1>Relatório qualitativo <small>Amostra de museus por categoria no estado <strong><?= $estado ?></strong></small></h1>
	</div>


	<div class="alert alert-info">
		<h2>Museus cadastrados no estado: <?= $estado ?></h2>
			<ul class="list-inline">
				<?php
				$museus = $museu->listar();
				foreach ($museus as $m) {
					$cidade->setCodCidade($m['cod_cidade']);
					$c = $cidade->buscaCidade();
					if ($c['uf'] == $estado) {
						?>
						<li><?= $m['codigo'] ?> - <?= $m['nome'] ?></li>
						<?php
					}
				}
				?>
			</ul>
		<div>
			<a class="btn btn-primary btn-sm" href="relatorio-qualitativo.php" role="button">Nova busca</a>
		</div>
	</div>

	<hr>

	<!-- TEMAS -->
	<?php
		$tema = new Tema($conexao);
		$temas = $tema->listarTemasQualitativo();
		foreach ($temas as $t) :
	?>
          <h1 class="text-warning"><?= $t['letra'] ?> - <?= $t['descricao'] ?></h1>
			<!-- UNIDADES DE ANALISES -->
			<?php
				$unidade_analise = new UnidadeAnalise($conexao);
				$unidade_analise->setTema($t['codigo']);
				$unidades_analises = $unidade_analise->listarPorTema();
				foreach ($unidades_analises as $ua) :
			?>
		          <h2 class="text-info"><?= $ua['num_romano'] ?> - <?= $ua['descricao'] ?></h2>
					<!-- UNIDADES DE CONTEXTOS -->
					<?php
						$unidade_contexto = new UnidadeContexto($conexao);
						$unidade_contexto->setUnidadeAnalise($ua['codigo']);
						$unidades_contextos = $unidade_contexto->listarPorUnidadeAnalise();
						foreach ($unidades_contextos as $uc) :
							if($uc['num_cardinal'] == 0) {
						?>
								<h3><?= $uc['descricao'] ?></h3>
						<?php
							} else {
					?>
				          		<h3><?= $uc['num_cardinal'] ?> - <?= $uc['descricao'] ?></h3>
				        <?php
				          	}
				        ?>
							<!-- CATEGORIAS -->
							<?php
								$categoria = new Categoria($conexao);
								$categoria->setUnidadeContexto($uc['codigo']);
								$categorias = $categoria->listarPorUnidadeContexto();

								$categoria_museu = new CategoriaMuseu($conexao);

								//Houve necessidade de percorrer por categoria para organização da visualização
								//percorre categorias checkboxes
								foreach ($categorias as $c) {
									if($c['tipo_categoria'] == 1) {

										$categoria_museu->setCategoria($c['codigo']);
										$qtdMuseus = $categoria_museu->quantidadeMuseusCategoria();
										$museusDestaCategoria = $categoria_museu->QuaisMuseusUtilizaramEstaCategoria();

										$qtd = 0;
										//conta museus se for do estado escolhido
										foreach ($museusDestaCategoria as $mc) {
											$museu->setCodigo($mc['museu']);
											$m = $museu->buscar();

											$cidade->setCodCidade($m['cod_cidade']);
											$cid = $cidade->buscaCidade();

											if($qtdMuseus['quantidade'] == null) {
												$qtd = 0;
											} else if ( $cid['uf'] == $estado ){
												$qtd++;
											}

										}

										if ($qtd == 0) {
											$classe = "alert-danger";
										} else {
											$classe = "alert-success";
										}
							?>
										<p><?= $c['descricao'] ?> : <?= $qtd ?> (
										
									<?php	
										foreach ($museusDestaCategoria as $mc) {
											$museu->setCodigo($mc['museu']);
											$m = $museu->buscar();

											$cidade->setCodCidade($m['cod_cidade']);
											$cid = $cidade->buscaCidade();
											
											if($cid['uf'] == $estado) {
												//imprime o museu e nome
											?>
												<?= $m['codigo'] ?>
											<?php

											}
										}
									?>
										)</p>
									<?php
						    		}
						    	}

						    	//percorre categorias tipo subcategorias
								foreach ($categorias as $c) {
									if($c['tipo_categoria'] == 4) {
						?>
						          		<p><strong> <?= $c['descricao'] ?></strong></p>
						         <?php
						          		$sub_categoria = new SubCategoria($conexao);
						          		$sub_categoria->setCategoria($c['codigo']);
						          		$sub_categorias = $sub_categoria->listarPorCategoria();
						          		//IMPRIME CADA SUBCATEGORIA
						          		foreach ($sub_categorias as $sc) {

											$categoria_museu->setSubCategoria($sc['codigo']);
											$qtdMuseus = $categoria_museu->quantidadeMuseusSubCategoria();
											$museusDestaSubCategoria = $categoria_museu->QuaisMuseusUtilizaramEstaSubCategoria();

											if($qtdMuseus['quantidade'] == null) {
												$qtd = 0;
											} else {
												$qtd = $qtdMuseus['quantidade'];
											}

											if ($qtd == 0) {
												$classe = "alert-danger";
											} else {
												$classe = "alert-success";
											}
						          ?>
											<p><?= $sc['descricao'] ?> : <?= $qtd ?> ( </p>

											<?php	
												foreach ($museusDestaCategoria as $mc) {
													$museu->setCodigo($mc['museu']);
													$m = $museu->buscar();

													$cidade->setCodCidade($m['cod_cidade']);
													$cid = $cidade->buscaCidade();
													
													if($cid['uf'] == $estado) {
													//IMPRIME O MUSEU COM NOME - CASO TENHA ESTA SUBCATEGORIA
													?>
														<?= $m['codigo'] ?> ?>
													<?php

													}
												}
											?>
												)</p>
											<?php
						    			}
						    		}
						    	}

								//Percorre categorias
								foreach ($categorias as $c) {
									//Filtra categorias tipo texto
									if($c['tipo_categoria'] == 2) {

										$categoria_museu->setCategoria($c['codigo']);
										$qtdMuseus = $categoria_museu->quantidadeMuseusCategoria(); // qtd de museus
										$museusDestaCategoria = $categoria_museu->QuaisMuseusUtilizaramEstaCategoria(); // lista museus que possui esta categoria

										$qtd = 0;
										//conta museus se for do estado escolhido
										foreach ($museusDestaCategoria as $mc) {
											$museu->setCodigo($mc['museu']);
											$m = $museu->buscar();

											$cidade->setCodCidade($m['cod_cidade']);
											$cid = $cidade->buscaCidade();

											if($qtdMuseus['quantidade'] == null) {
												$qtd = 0;
											} else if ( $cid['uf'] == $estado ){
												$qtd++;
											}

										}
	
										if ($qtd == 0) {
											$classe = "alert-danger";
										} else {
											$classe = "alert-success";
										}

										?>
											<p><strong><?= $c['descricao'] ?></strong> <?= $qtd ?> ( 
										<?php

											foreach ($museusDestaCategoria as $mc) {
												$museu->setCodigo($mc['museu']);
												$m = $museu->buscar();

												$cidade->setCodCidade($m['cod_cidade']);
												$cid = $cidade->buscaCidade();
												
												if($cid['uf'] == $estado) {
													//imprime o museu e nome
												?>
													<?= $m['codigo'] ?>
												<?php

												}
											}
										?>
											)</p>
										<?php

						    		}
						    	}
						    ?>
							<!-- FIM CATEGORIAS -->
				    <?php
				    	endforeach
				    ?>
					<!-- FIM UNIDADES DE CONTEXTOS -->
		    <?php
		    	endforeach
		    ?>
			<!-- FIM UNIDADES DE ANALISES -->
    <?php
    	endforeach
    ?>
	<!-- FIM TEMAS -->

<?php include("rodape.php"); ?>