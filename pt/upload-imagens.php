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
            
            //$tamanho = $tmp_name[$i]->getimagesize($image);

            $image = WideImage::load($tmp_name[$i]); //Carrega a imagem utilizando a WideImage

            $largura  = $image->getWidth();
            $altura = $image->getHeight();

            // 37,8px x 7cm  = 265px - retrato
            // 37,8px x 14cm = 530px - paisagem

            $orientacao = '';
            $largura_pretendida = 0;
            $altura_pretendida = 0;
            $scala = 0;

            if($largura > $altura) {
              $orientacao = 'paisagem';

              $largura_pretendida = 530;
              $escala = $largura / $largura_pretendida;
              $altura_pretendida = $altura / $escala;

              $image = $image->resize($largura_pretendida,$altura_pretendida);
            } else if ($largura < $altura) {
              $largura_pretendida = 265;
              $orientacao = 'retrato';

              $largura_pretendida = 530;
              $escala = $largura / $largura_pretendida;
              $altura_pretendida = $altura / $escala;

              $image = $image->resize($largura_pretendida,$altura_pretendida);
            } else {
              $orientacao = 'quadrado';
              $largura_pretendida = 530;
              $altura_pretendida = 530;
              $image = $image->resize($largura_pretendida,$altura_pretendida);
            }


            //$image = $image->resize(170, 180, 'outside'); //Redimensiona a imagem para 170 de largura e 180 de altura, mantendo sua proporção no máximo possível
            //$image = $image->crop('center', 'center', 170, 180); //Corta a imagem do centro, forçando sua altura e largura
 
            $image_copy = $image;
            $image->saveToFile($dir.$new_name); //Salva a imagem
            //$image->output('jpg', 90); //mostra a imagem

            //MOSTRA IMAGENS
            ?>
               <div class="row">
                 <div class="col-sm-6 col-md-4">
                   <div class="thumbnail">
                     <img src="uploads/<?=$new_name?>" alt="...">
                     <div class="caption">
                       <h3><?= $descricao ?></h3>
                       <h3><?= $new_name ?></h3>
                       <p>largura: <?= $largura ?> x altura: <?= $altura ?></p>
                       <p>
                         

                          <?php

                          // Calling getimagesize() function
                          list($width, $height, $type, $attr) = getimagesize($tmp_name[$i]);

                          // Displaying dimensions of the image
                          echo "<p>Width of image : " . $width . "</p>";

                          echo "<p>Height of image : " . $height . "</p>";

                          echo "<p>Image type :" . $type . "</p>";

                          echo "<p>Image attribute :" .$attr . "</p>";

                          $numero = (filesize($tmp_name[$i])/1024)/1024;
                          echo "<p>File size :" . number_format($numero, 2, ',', '.') . "MB</p>";

                          echo "<p>Largura : " . $largura . "</p>";
                          echo "<p>Altura : " . $altura . "</p>";

                          echo "<p>Nova largura : " . $largura_pretendida . "</p>";
                          echo "<p>Nova Altura : " . $altura_pretendida . "</p>";

                          list($width, $height, $type, $attr) = getimagesize($image_copy);

                          // Displaying dimensions of the image
                          echo "<p>Width of image : " . $width . "</p>";

                          echo "<p>Height of image : " . $height . "</p>";

                          echo "<p>Image type :" . $type . "</p>";

                          echo "<p>Image attribute :" .$attr . "</p>";

                          $numero = (filesize($image_copy)/1024)/1024;
                          echo "<p>File size :" . number_format($numero, 2, ',', '.') . "MB</p>";

                          ?>

                       </p>
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