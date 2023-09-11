<?php include("cabecalho.php");
	  require_once 'class/Conecta.php';
	  require_once 'class/Museu.php';
	  require_once 'class/Tema.php';
	  require_once 'class/UnidadeAnalise.php';
	  require_once 'class/UnidadeContexto.php';
	  require_once 'class/CategoriaMuseu.php';
	  require_once 'class/Categoria.php';
	  require_once 'class/SubCategoria.php';
	  require_once 'class/ImagensMuseus.php';
?>

        <div class="page-header">
          <h1>Deletar Museu</h1>
        </div>

<?php
	$museu = new Museu($conexao);

	$museu->setCodigo($_GET['codigo']);
	$m = $museu->buscar();
	$museu->setNome($m['nome']);

	//DELETAR IMAGENS MUSEUS
	$imagemMuseu = new ImagensMuseus($conexao);
	$imagemMuseu->setMuseu($museu->getCodigo());
	$imagensMuseus = $imagemMuseu->buscarPorMuseu();

	if($imagensMuseus) {
		foreach ($imagensMuseus as $im) {
			//echo $im['codigo'].' - '.$im['nome'];
			$imagemMuseu->setCodigo($im['codigo']);
			if($imagemMuseu->deletar()) {
?>
				<p class="alert alert-success" >Imagem "<?= $im['codigo'] ?> - <?= $im['nome'] ?>" deletado com sucesso!</p>
<?php
			} else {
?>
				<p class="alert alert-danger" >Imagem "<?= $im['codigo'] ?> - <?= $im['nome'] ?>" não foi deletado!</p>
<?php				
			}
		}
	} else {
		echo "nao existe imagem cadastrado para este museu: ".$m['nome']."<br>";
	}

	//DELETAR CATEGORIAS MUSEUS
	$categoriaMuseu = new CategoriaMuseu($conexao);
	$categoriaMuseu->setMuseu($museu->getCodigo());
	$categoriasMuseus = $categoriaMuseu->buscaCategoriasSubCategoriasDoMuseu();

	if($categoriasMuseus) {
		foreach ($categoriasMuseus as $cm) {
			
			$categoriaMuseu->setMuseu($cm['museu']);
			$categoriaMuseu->setCategoria($cm['categoria']);
			if($categoriaMuseu->deletaCategoria()) {
?>
				<p class="alert alert-success" >Categoria "<?= $cm['museu'] ?> - <?= $cm['categoria'] ?>" deletado com sucesso!</p>
<?php
			} else {
?>
				<p class="alert alert-danger" >Categoria "<?= $cm['museu'] ?> - <?= $cm['categoria'] ?>" não foi deletado!</p>
<?php				
			}
		}
	} else {
		echo "nao existe categoria cadastrado para este museu: ".$m['nome']."<br>";
	}

	//DELETAR SUBCATEGORIAS MUSEUS
	$categoriaMuseu = new CategoriaMuseu($conexao);
	$categoriaMuseu->setMuseu($museu->getCodigo());
	$categoriasMuseus = $categoriaMuseu->buscaCategoriasSubCategoriasDoMuseu();

	if($categoriasMuseus) {
		foreach ($categoriasMuseus as $cm) {
			
			$categoriaMuseu->setMuseu($cm['museu']);
			$categoriaMuseu->setCategoria($cm['categoria']);
			$categoriaMuseu->setSubCategoria($cm['sub_categoria']);
			if($categoriaMuseu->deletar()) {
?>
				<p class="alert alert-success" >Categoria "<?= $cm['museu'] ?> - <?= $cm['categoria'] ?> - <?= $cm['sub_categoria'] ?>" deletado com sucesso!</p>
<?php
			} else {
?>
				<p class="alert alert-danger" >Categoria "<?= $cm['museu'] ?> - <?= $cm['categoria'] ?> - <?= $cm['sub_categoria'] ?>" não foi deletado!</p>
<?php				
			}
		}
	} else {
		echo "nao existe sub_categoria cadastrado para este museu: ".$m['nome']."<br>";
	}

	//DELETAR MUSEU
	if($m) {
		$deletou = $museu->deletar();
	 	if($deletou){
	?>
			<p class="alert alert-success" >Museu "<?= $museu->getCodigo()?> - <?=$museu->getNome()?>" deletado com sucesso!</p>
	<?php
	 	} else {
	?>
			<p class="alert alert-danger" >Museu "<?= $museu->getCodigo()?> - <?=$museu->getNome()?>" não foi deletado!</p>
			<p class="alert alert-info" >Talvez existem imagens, categorias e subcategorias gravadas e vinculadas à este Museu!</p>
	<?php
		}

	} else {
		echo "nao existe museu informado";
	}
	?>

<?php include("rodape.php"); ?>