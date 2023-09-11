<?php include("cabecalho.php");
	require_once "class/Conecta.php";
	require_once "class/Tema.php";
	require_once "class/UnidadeAnalise.php";
	require_once "class/UnidadeContexto.php";
	require_once "class/Categoria.php";
	require_once "class/SubCategoria.php";
?>

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
								//Houve necessidade de percorrer por categoria para organização da visualização
								//percorre categorias checkboxes
								foreach ($categorias as $c) {
									if($c['tipo_categoria'] == 1) {
							?>
										<p><?= $c['descricao'] ?>
											<a href="formulario-altera-categoria.php?codigo=<?=$c['codigo']?>" title="alterar categoria"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
											<a onclick="confirmaDelecaoCategoria('<?= $c['codigo'] ?>','<?= $c['descricao'] ?>')" href="javascript:func()" title="deletar categoria"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
										</p>
						    <?php
						    		}
						    	}
						    	//percorre categorias tipo subcategorias
								foreach ($categorias as $c) {
									if($c['tipo_categoria'] == 4) {
						?>
						          		<p><strong> <?= $c['descricao'] ?></strong>
						          			<a href="formulario-altera-categoria.php?codigo=<?=$c['codigo']?>" title="alterar categoria"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
						          			<a onclick="confirmaDelecaoCategoria('<?= $c['codigo'] ?>','<?= $c['descricao'] ?>')" href="javascript:func()" title="deletar categoria"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
						          		</p>
						         <?php
						          		$sub_categoria = new SubCategoria($conexao);
						          		$sub_categoria->setCategoria($c['codigo']);
						          		$sub_categorias = $sub_categoria->listarPorCategoria();
						          		foreach ($sub_categorias as $sc) {
						          ?>
											<p><?= $sc['descricao'] ?>
												<a href="formulario-altera-subcategoria.php?codigo=<?=$sc['codigo']?>" title="alterar subcategoria"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
												<a onclick="confirmaDelecaoSubCategoria('<?=$sc['codigo']?>','<?= $sc['descricao'] ?>')" href="javascript:func()" title="deletar subcategoria"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
											</p>
						    <?php
						    			}
						    		}
						    	}
								//percorre categorias texto
								foreach ($categorias as $c) {
									if($c['tipo_categoria'] == 2) {
							?>
										<p><?= $c['descricao'] ?>
											<a href="formulario-altera-categoria.php?codigo=<?= $c['codigo'] ?>" title="alterar categoria"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
											<a onclick="confirmaDelecaoCategoria('<?= $c['codigo'] ?>','<?= $c['descricao'] ?>')" href="javascript:func()" title="deletar categoria"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
										</p>
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

	<script type="text/javascript">
		function confirmaDelecaoCategoria(id,descricao) {
			var resposta = confirm("Deseja excluir esta categoria: "+id+" - "+descricao+"?");
			if (resposta == true) {
				window.location.href="deleta-categoria.php?codigo="+id;
			}
		}
		function confirmaDelecaoSubCategoria(id,descricao) {
			var resposta = confirm("Deseja excluir esta subcategoria: "+id+" - "+descricao+"?");
			if (resposta == true) {
				window.location.href="deleta-subcategoria.php?codigo="+id;
			}
		}
	</script>

<?php include("rodape.php"); ?>