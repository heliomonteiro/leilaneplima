<?php
  require_once 'class/Cidade.php';
  require_once 'class/Conecta.php';

  $estado = $_GET['uf'];

  $cidade = new Cidade($conexao);
  $cidade->setUf($estado);
  $cidades = $cidade->buscaCidadesPorEstado();

?>
            <label for="cod_cidade" class="col-sm-2 control-label">Cidade:</label>
            <div class="col-sm-10">
            	<select class="form-control" name="cod_cidade" id="cod_cidade">
<?php foreach ($cidades as $cidade) { ?>
            		<option value="<?= $cidade['cod_cidade'] ?>"><?= $cidade['nome'] ?></option>
 <?php } ?>          
           		</select>
           	</div>