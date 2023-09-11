<?php include("cabecalho-mapa.php");
	  require_once 'class/Conecta.php';
	  require_once 'class/Cidade.php';
	  require_once 'class/Museu.php';
	  require_once 'class/Tema.php';
	  require_once 'class/UnidadeAnalise.php';
	  require_once 'class/UnidadeContexto.php';
	  require_once 'class/CategoriaMuseu.php';
	  require_once 'class/Categoria.php';
	  require_once 'class/SubCategoria.php';
	  require_once 'class/ImagensMuseus.php';

	  include 'array_estados.php';
?>

        <div class="page-header">
          <h1>Informações pesquisadas sobre o Museu</h1>
        </div>

<?php
	$museu = new Museu($conexao);
	$cidade = new Cidade($conexao);

	$museu->setCodigo($_GET['codigo']);
	$m = $museu->buscar();

	$cidade->setCodCidade($m['cod_cidade']);
	$c = $cidade->buscaCidade();


?>

	<table class="table table-striped">
		<tr>
			<th>Código</th>
			<td><?= $m['codigo']?></td>
		</tr>
		<tr>
			<th>Nome</th>
			<td><?= $m['nome']?></td>
		</tr>
		<tr>
			<th>Ano de fundação</th>
			<td><?= $m['ano_fundacao']?></td>
		</tr>
		<tr>
			<th>Atendimento Administrativo</th>
			<td><?= $m['horario_funcionamento_administrativo']?></td>
		</tr>
		<tr>
			<th>Atendimento ao público</th>
			<td><?= $m['horario_atendimento_publico']?></td>
		</tr>
		<tr>
			<th>Contacto</th>
			<td><?= $m['telefone']?></td>
		</tr>
		<?php

			$uf = '';
			//echo $c['uf'];
			//print_r($estados);
			foreach ($estados as $estado) {
				if($estado["sigla"] == $c['uf']) {
					$uf =  $estado["nome"];
				}	
				//echo '<p>'.$estado["sigla"].'</p>';
			}
		?>
		<tr>
			<th>Concelho - Distrito</th>
			<td><?= $c['nome']?> - <?= $uf ?></td>
		</tr>
		<tr>
			<th>Morada</th>
			<td><?= $m['endereco']?></td>
		</tr>
		<tr>
			<th>Situação</th>
			<td><?= $m['situacao'] == (1) ? "Ativo" : "Inativo" ; ?> </td>
		</tr>
		<tr>
			<th>Observações</th>
			<td class="text-justify"><?= $m['observacoes']?></td>
		</tr>
	</table>

<?php
	if ($m['situacao'] == (1)) { // MOSTRA TODA FICHA ABAIXO
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
							$texto_uc = $uc['num_cardinal']." - ".$uc['descricao'];
							if ($uc['num_cardinal'] == 0){
								$texto_uc = $uc['descricao'];
							}
					?>
						  <h3><?php echo $texto_uc ?></h3>
				          
						    <!-- CATEGORIAS - listar categorias do museu-->
						    <ul class="list-group">
						    	<div class="row">
							<?php
								$categoria_museu = new CategoriaMuseu($conexao);
								$categoria_museu->setMuseu($m['codigo']);
								$categoria_museu->setUnidadeContexto($uc['codigo']);
								$lista_categorias_museu = $categoria_museu->listarCategoriasPorUcMuseu(); // lista categorias do museu sem repetir (distinct em categoria)
								//listar categorias tipo checkbox
								foreach ($lista_categorias_museu as $cm) {
									$categoria = new Categoria($conexao);
									$categoria->setCodigo($cm['categoria']);
									$c = $categoria->buscar();

									switch ($c['tipo_categoria']) {
										case 1: //checkbox
											//$categoria_museu->setCategoria($c['codigo']);
											//$cm = $categoria_museu->buscaCategoriaPorMuseu();
											?>
										        <div class="col-md-4 text-left"><li class="list-group-item"> <?= $c['descricao'] ?></li></div>
										    <?php
											break;
										
										default:
											# code...
											break;
									}
						    	}
						    	//listar categorias tipo subcategoria
								foreach ($lista_categorias_museu as $cm) {
									$categoria = new Categoria($conexao);
									$categoria->setCodigo($cm['categoria']);
									$c = $categoria->buscar();

									//$categoria_museu->setCategoria($c['codigo']);
									//$cm = $categoria_museu->buscaCategoriaPorMuseu();
									switch ($c['tipo_categoria']) {
										case 4:
											?>
										        <div class="col-md-12"><li class="list-group-item"> <strong><?= $c['descricao'] ?></strong></li></div>
										    <?php
										    	$sub_categoria_museu = new CategoriaMuseu($conexao);
										    	$sub_categoria_museu->setMuseu($m['codigo']);
										    	$sub_categoria_museu->setCategoria($c['codigo']);
										    	$sub_categorias_museu = $sub_categoria_museu->listarSubCategoriasPorMuseu();

										    	//var_dump($sub_categorias);
										    	
										    	$sub_categoria = new SubCategoria($conexao);
										    	
										    	foreach ($sub_categorias_museu as $scm) {
											    	$sub_categoria->setCodigo($scm['sub_categoria']);
											    	$sc = $sub_categoria->buscar();
											    ?>
										        	<div class="col-md-4 text-left"><li class="list-group-item"> <?= $sc['descricao'] ?></li></div>
										    	<?php
										    	}

											break;
										
										default:
											# code...
											break;
									}
						    	}
						    	//listar categorias tipo texto
								foreach ($lista_categorias_museu as $cm) {
									$categoria = new Categoria($conexao);
									$categoria->setCodigo($cm['categoria']);
									$c = $categoria->buscar();

									switch ($c['tipo_categoria']) {
										case 2:
											$categoria_museu->setCategoria($c['codigo']);
											$cm = $categoria_museu->buscaCategoriaPorMuseu();
												if ( $cm['texto'] != "" ) {
											?>
										        <div class="col-md-12 text-left"><li class="list-group-item"> <strong><?= $c['descricao'] ?>: </strong>  <p class="text-justify"><?= $cm['texto'] ?></p> </li></div>
										    <?php
												} else if ($c['descricao'] != "Observações") {
											?>
												<div class="col-md-12 text-left"><li class="list-group-item"> <strong><?= $c['descricao'] ?>: </strong>  <p class="text-justify"><?= $cm['texto'] ?></p> </li></div>
											<?php
												}
											break;
										
										default:
											# code...
											break;
									}
						    	}
						    ?>
						    	</div>
							</ul>
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
<?php
	} //Fim do if de mostrar Ficha
?>

	<!-- IMAGENS -->
    <div class="page-header">
      <h1>Imagens do Museu</h1>
    </div>

	<?php
	$imagens_museus = new ImagensMuseus($conexao);
	$imagens_museus->setMuseu($m['codigo']);
	$imagensMuseus = $imagens_museus->buscarPorMuseu();
	?>
    
    <div class="row">
    <?php
	foreach ($imagensMuseus as $im) {
		//echo $im;
		$new_name = $im['nome'];
		$descricao = $im['descricao'];
		//imagem
	?>
         <div class="col-sm-6 col-md-4">
           <div class="thumbnail">
             <img src="uploads/<?=$new_name?>" alt="<?=$new_name?>">
             <div class="caption">
               <h3><?= $descricao ?></h3>
               <h3><?= $new_name ?></h3>
             </div>
           </div>
         </div>
    <?php
	}

	?>
	<!-- 
    </div>

	<div class="row">

	    <div class="page-header">
	      <h1>Mapa do museu</h1>
	    </div>

		<div id="mapa"></div>

	</div>

	<hr>
	-->

<?php include("rodape.php"); ?>