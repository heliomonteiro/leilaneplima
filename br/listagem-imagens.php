<?php include("cabecalho.php");
     require_once 'class/Conecta.php';
     require_once 'class/Museu.php';
     require_once 'class/ImagensMuseus.php';

?>

    <div class="page-header">
      <h1>Imagens do Museu</h1>
      <p>Clique no ícone "lixeira" para deletar a imagem desejada</p>
    </div>

  <?php

  $codigo = $_GET['codigo'];

  $museu = new Museu($conexao);
  $museu->setCodigo($codigo);
  $m = $museu->buscar();

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

         <a href="deleta-imagem.php?codigo=<?=$im['codigo']?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>

           <div class="thumbnail">
             <img src="uploads/<?=$new_name?>" alt="...">
             <div class="caption">
               <h3><?= $descricao ?></h3>
               <h3><?= $new_name ?></h3>
             </div>
           </div>
         </div>
    <?php
  }

 include("rodape.php");
?>