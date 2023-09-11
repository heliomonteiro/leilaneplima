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
	  <h1>Relatório quantitativo - quantidade de museus/categoria</h1>
	</div>

	<!-- TEMAS -->
	<?php
		$tema = new Tema($conexao);
		$temas = $tema->listar();
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

									$codigos_dos_museus = array(); // armazena os códigos dos museus a serem mostrados entre "()"

									if($c['tipo_categoria'] == 1) {

										$categoria_museu->setCategoria($c['codigo']);
										$qtdMuseus = $categoria_museu->quantidadeMuseusCategoria();
										$museusDestaCategoria = $categoria_museu->QuaisMuseusUtilizaramEstaCategoria();

										if($qtdMuseus['quantidade'] == null) {
											$qtd = 0;
										} else {
											$qtd = $qtdMuseus['quantidade'];
										}

										foreach ($museusDestaCategoria as $mc) {

											array_push($codigos_dos_museus, $mc['museu']);

										}


									?>

										<p><?= $c['descricao'] ?> : <?= $qtd ?> ( <?php echo implode(" - ", $codigos_dos_museus) ?> )</p>
										
									<?php

						    		}
						    	}

						        $sub_categoria = new SubCategoria($conexao);

						    	//percorre categorias tipo subcategorias
								foreach ($categorias as $c) {

									if($c['tipo_categoria'] == 4) {
						?>
						          		<p><strong> <?= $c['descricao'] ?></strong></p>
						         <?php

						          		$sub_categoria->setCategoria($c['codigo']);
						          		$sub_categorias = $sub_categoria->listarPorCategoria();
						          		foreach ($sub_categorias as $sc) {

											$codigos_dos_museus = array(); // armazena os códigos dos museus a serem mostrados entre "()"

											$categoria_museu->setSubCategoria($sc['codigo']);
											$qtdMuseus = $categoria_museu->quantidadeMuseusSubCategoria();
											$museusDestaSubCategoria = $categoria_museu->QuaisMuseusUtilizaramEstaSubCategoria();

											if($qtdMuseus['quantidade'] == null) {
												$qtd = 0;
											} else {
												$qtd = $qtdMuseus['quantidade'];
											}



										foreach ($museusDestaSubCategoria as $msc) {

											array_push($codigos_dos_museus, $msc['museu']);

										}

						          ?>
											<p><?= $sc['descricao'] ?> : <?= $qtd ?> ( <?php echo implode(" - ", $codigos_dos_museus) ?> )</span></p>
						    <?php
						    			}
						    		}
						    	}

								//percorre categorias texto
								foreach ($categorias as $c) {

									$codigos_dos_museus = array(); // armazena os códigos dos museus a serem mostrados entre "()"

									if($c['tipo_categoria'] == 2) {

										$categoria_museu->setCategoria($c['codigo']);
										$qtdMuseus = $categoria_museu->quantidadeMuseusCategoria();

										if($qtdMuseus['quantidade'] == null) {
											$qtd = 0;
										} else {
											$qtd = $qtdMuseus['quantidade'];
										}

							?>
										<p><strong><?= $c['descricao'] ?></strong> <?= $qtd ?></span></p>
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