<?php include("cabecalho.php");

   $codigo = $_GET['codigo'];

?>

   <form action="upload-imagens.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="codigo" value="<?= $codigo ?>">
      <input type="file" name="fileUpload[]" multiple>
      <input type="submit" value="Enviar">
   </form>

<?php include("rodape.php"); ?>