<?php include("cabecalho-impressao.php");
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
?>

        <div>
          <h1 class="impressao">Informações pesquisadas sobre o Museu</h1>
        </div>

<?php
	$museu = new Museu($conexao);
	$cidade = new Cidade($conexao);

	$museu->setCodigo($_GET['codigo']);
	$m = $museu->buscar();

	$cidade->setCodCidade($m['cod_cidade']);
	$c = $cidade->buscaCidade();

?>

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
			<td><?= $m['horario_funcionamento_administrativo']?></td>
		</tr>
		<tr>
			<th>Atendimento ao público</th>
			<td><?= $m['horario_atendimento_publico']?></td>
		</tr>
		<tr>
			<th>Telefone</th>
			<td><?= $m['telefone']?></td>
		</tr>
		<tr>
			<th>Cidade</th>
			<td><?= $c['nome']?></td>
		</tr>
		<tr>
			<th>Endereço</th>
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
								$categoria_museu = new CategoriaMuseu($conexao);
								$categoria_museu->setMuseu($m['codigo']);
								$categoria_museu->setUnidadeContexto($uc['codigo']);
								$lista_categorias_museu = $categoria_museu->listarCategoriasPorUcMuseu();
								//listar categorias tipo checkboxes
								foreach ($lista_categorias_museu as $cm) {
									$categoria = new Categoria($conexao);
									$categoria->setCodigo($cm['categoria']);
									$c = $categoria->buscar();

									switch ($c['tipo_categoria']) {
										case 1:
											//$categoria_museu->setCategoria($c['codigo']);
											//$cm = $categoria_museu->buscaCategoriaPorMuseu();
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

									//$categoria_museu->setCategoria($c['codigo']);
									//$cm = $categoria_museu->buscaCategoriaPorMuseu();
									switch ($c['tipo_categoria']) {
										case 4:
											?>
										        <h4 class="text-left"><strong><?= $c['descricao'] ?></strong></h4>
										        <ul class="list-inline">
										    <?php
										    	$sub_categoria_museu = new CategoriaMuseu($conexao);
										    	$sub_categoria_museu->setMuseu($m['codigo']);
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
											$categoria_museu->setCategoria($c['codigo']);
											$cm = $categoria_museu->buscaCategoriaPorMuseu();
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