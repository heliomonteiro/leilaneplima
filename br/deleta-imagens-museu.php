<?php include("cabecalho.php");
	  require_once 'class/Conecta.php';
	  require_once 'class/Museu.php';
	  require_once 'class/ImagensMuseus.php';
?>

        <div class="page-header">
          <h1>Deletação de Imagens do Museu</h1>
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

	?>

<?php include("rodape.php"); ?>