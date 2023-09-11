<?php include("cabecalho.php");
     require_once 'class/Conecta.php';
     require_once 'class/Museu.php';
     require_once 'class/ImagensMuseus.php';

?>

        <div class="page-header">
          <h1>Envia Imagens do Museu</h1>
        </div>

<?php
   $museu = new Museu($conexao);
   $imagensMuseus = new ImagensMuseus($conexao);

   $museu->setCodigo($_POST['codigo']);
   $m = $museu->buscar();

   $imagensMuseus->setMuseu($museu->getCodigo());

?>
   <h3>Gravado no Museu <?= $museu->getCodigo() ?></h3>
<?php

   //SCRIPT UPLOAD IMAGENS
   if(isset($_FILES['fileUpload']))
   {
      require 'WideImage/lib/WideImage.php'; //Inclui classe WideImage à página
 
      date_default_timezone_set("Brazil/East");
 
      $name 	= $_FILES['fileUpload']['name']; //Atribui uma array com os nomes dos arquivos à variável
      $tmp_name = $_FILES['fileUpload']['tmp_name']; //Atribui uma array com os nomes temporários dos arquivos à variável
 
      $allowedExts = array(".gif", ".jpeg", ".jpg", ".png", ".bmp"); //Extensões permitidas
 
      $dir = 'uploads/';
 
      for($i = 0; $i < count($tmp_name); $i++) //passa por todos os arquivos
      {
         $ext = strtolower(substr($name[$i],-4));
 
         if(in_array($ext, $allowedExts)) //Pergunta se a extensão do arquivo, está presente no array das extensões permitidas
         {
            $old_name = $name[$i];
            //echo $old_name.'<br>';
            $descricao = substr($old_name, 0, strlen($old_name) - 4);
            //echo $descricao;

            $new_name = date("Y.m.d-H.i.s") ."-". $i . $ext;
 
            $image = WideImage::load($tmp_name[$i]); //Carrega a imagem utilizando a WideImage
 
            //$image = $image->resize(170, 180, 'outside'); //Redimensiona a imagem para 170 de largura e 180 de altura, mantendo sua proporção no máximo possível
            //$image = $image->crop('center', 'center', 170, 180); //Corta a imagem do centro, forçando sua altura e largura
 
            $image->saveToFile($dir.$new_name); //Salva a imagem

            //MOSTRA IMAGENS
            ?>
               <div class="row">
                 <div class="col-sm-6 col-md-4">
                   <div class="thumbnail">
                     <img src="uploads/<?=$new_name?>" alt="...">
                     <div class="caption">
                       <h3><?= $descricao ?></h3>
                       <h3><?= $new_name ?></h3>
                     </div>
                   </div>
                 </div>
               </div>
            <?php
            //GRAVA NO BANCO
            $imagensMuseus->setNome($new_name);
            $imagensMuseus->setDescricao($descricao);
            if($imagensMuseus->insere()) {
                  ?>
                     <p class="alert alert-success" >Imagem <?= $imagensMuseus->getNome() ?> foi adicionado com sucesso!</p>
                  <?php
            } else {
                  ?>
                     <p class="alert alert-danger" >Imagem <?= $imagensMuseus->getNome() ?> não foi adicionado!</p>
                  <?php
            }
         }
      }
   }

 include("rodape.php");
?>