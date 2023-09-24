<?php include("cabecalho-impressao.php");
	  require_once 'class/Conecta.php';
	  require_once 'class/Cidade.php';
	  require_once 'class/Museu.php';
	  require_once 'class/Ficha.php';
	  require_once 'class/Tema.php';
	  require_once 'class/UnidadeAnalise.php';
	  require_once 'class/UnidadeContexto.php';
	  require_once 'class/ItensFichas.php';
	  require_once 'class/Categoria.php';
	  require_once 'class/SubCategoria.php';
	  require_once 'class/ImagensMuseus.php';

	$museu = new Museu($conexao);
	$ficha = new Ficha($conexao);
	$cidade = new Cidade($conexao);

	$ficha->setCodigo($_GET['codigo']);
	$f = $ficha->buscar();


	$museu->setCodigo($f['museu']);
	$m = $museu->buscar();

	$cidade->setCodCidade($m['cod_cidade']);
	$c = $cidade->buscaCidade();

?>

	<div class="page-header">
		<h1>Informações pesquisadas sobre <small><?= $m['nome'] ?></small> <span class="badge badge-info">Ficha <?= $f['indice'] ?></span></h1>
	</div>

	<table class="table">
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
			<td><?= $f['horario_funcionamento_administrativo']?></td>
		</tr>
		<tr>
			<th>Atendimento ao público</th>
			<td><?= $f['horario_atendimento_publico']?></td>
		</tr>
		<tr>
			<th>Telefone</th>
			<td><?= $f['telefone']?></td>
		</tr>
		<tr>
			<th>Cidade</th>
			<td><?= $c['nome']?></td>
		</tr>
		<tr>
			<th>Endereço</th>
			<td><?= $f['endereco']?></td>
		</tr>
		<tr>
			<th>Situação</th>
			<td><span class="badge badge-info"><?= $f['situacao'] == (1) ? "Ativo" : "Inativo" ; ?></span></td>
		</tr>
		<tr>
			<th>Observações</th>
			<td class="text-justify"><?= $f['observacoes']?></td>
		</tr>
		<tr>
		<th>Revisitação</th>
			<td class="text-justify"><span class="badge badge-info"><?= ($f['revisitacao']) ? 'Revisitação' : 'Visita Técnica'?></span></td>
		</tr>
		<th>Data da Visita Técnica</th>
		<td class="text-justify"><?= Date('d/m/y', strtotime ($f['visita_tecnica']))?></td>
	</table>

<?php
	if ($f['situacao'] == (1)) { // MOSTRA TODA FICHA ABAIXO
?>

	<!-- TEMAS -->
	<?php
		$tema = new Tema($conexao);
		$temas = $tema->listar();
		foreach ($temas as $t) {
	?>
          <h1 class="text-warning"><?= $t['letra'] ?> - <?= $t['descricao'] ?></h1>
			<!-- UNIDADES DE ANALISES -->
			<?php
				$unidade_analise = new UnidadeAnalise($conexao);
				$unidade_analise->setTema($t['codigo']);
				$unidades_analises = $unidade_analise->listarPorTema();
				foreach ($unidades_analises as $ua) {
			?>
		          <h2 class="text-info"><?= $ua['num_romano'] ?> - <?= $ua['descricao'] ?></h2>
					<!-- UNIDADES DE CONTEXTOS -->
					<?php
						$unidade_contexto = new UnidadeContexto($conexao);
						$unidade_contexto->setUnidadeAnalise($ua['codigo']);
						$unidades_contextos = $unidade_contexto->listarPorUnidadeAnalise();
						foreach ($unidades_contextos as $uc) {
							$texto_uc = $uc['num_cardinal']." - ".$uc['descricao'];
							if ($uc['num_cardinal'] == 0){
								$texto_uc = $uc['descricao'];
							}
					?>
							<h3><?php echo $texto_uc ?></h3>

						    <!-- UNIDADES DE CONTEXTOS -->
						    <ul class="list-inline text-left">
						    	
							<?php
								$itens_fichas = new ItensFichas($conexao);
								$itens_fichas->setFicha($f['codigo']);
								$itens_fichas->setUnidadeContexto($uc['codigo']);
								$lista_categorias_museu = $itens_fichas->listarCategoriasPorUcMuseu();
								//listar categorias tipo checkboxes
								foreach ($lista_categorias_museu as $cm) {
									$categoria = new Categoria($conexao);
									$categoria->setCodigo($cm['categoria']);
									$c = $categoria->buscar();

									switch ($c['tipo_categoria']) {
										case 1:
											//$itens_fichas->setCategoria($c['codigo']);
											//$cm = $itens_fichas->buscaCategoriaPorMuseu();
											?>
										        <li>  <?= $c['descricao'] ?></li>
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

									//$itens_fichas->setCategoria($c['codigo']);
									//$cm = $itens_fichas->buscaCategoriaPorMuseu();
									switch ($c['tipo_categoria']) {
										case 4:
											?>
										        <h4 class="text-left"><strong><?= $c['descricao'] ?></strong></h4>
										        <ul class="list-inline">
										    <?php
										    	$sub_categoria_museu = new ItensFichas($conexao);
										    	$sub_categoria_museu->setFicha($f['codigo']);
										    	$sub_categoria_museu->setCategoria($c['codigo']);
										    	$sub_categorias_museu = $sub_categoria_museu->listarSubCategoriasPorMuseu();
										    	
											    $sub_categoria = new SubCategoria($conexao);

										    	foreach ($sub_categorias_museu as $scm) {
											    	$sub_categoria->setCodigo($scm['sub_categoria']);
											    	$sc = $sub_categoria->buscar();
											    ?>
										        	<li> <?= $sc['descricao'] ?></li>
										    	<?php
										    	}
										    	?>
										    	</ul>	
										    	<?php

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
											$itens_fichas->setCategoria($c['codigo']);
											$cm = $itens_fichas->buscaCategoriaPorMuseu();
												if ($cm['texto'] != "") {
											?>
										        <p class="text-justify"> <strong><?= $c['descricao'] ?>: </strong> <?= $cm['texto'] ?></p>
										    <?php
												} else if ($c['descricao'] != "Observações") {
											?>
												<p class="text-justify"> <strong><?= $c['descricao'] ?>: </strong> <?= $cm['texto'] ?></p>
											<?php
												}
											break;
										
										default:
											# code...
											break;
									}
						    	}
						    ?>
						    	
							</ul>
							<!-- FIM CATEGORIAS -->
				    <?php
				    	}
				    ?>
					<!-- FIM UNIDADES DE CONTEXTOS -->
		    <?php
		    	}
		    ?>
			<!-- FIM UNIDADES DE ANALISES -->
    <?php
    	}
    ?>
	<!-- FIM TEMAS -->
<?php
	} //Fim do if de mostrar Ficha
?>

	<!-- IMAGENS -->
    <div class="titulo_imagens">
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
         <div>
           <div class="foto">

             <img src="uploads/<?=$new_name?>" alt="<?= $new_name ?>" height="400px">
             <div class="titulo">
               <h3><?= $descricao ?></h3>
             </div>   

           </div>
         </div>
    <?php
	}

	?>
	<!-- FIM IMAGENS -->
    </div>

<!--
    <div class="row">


	    <div class="page-header">
	      <h1>Mapa do museu</h1>
	    </div>

		<div id="mapa"></div>

	</div>

	<hr>
-->

<?php include("rodape-impressao.php"); ?>