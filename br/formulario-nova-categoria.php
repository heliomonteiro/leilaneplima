<?php
  include("cabecalho.php");
  require_once "class/Conecta.php";
  require_once "class/UnidadeContexto.php";
  require_once "class/TipoCategoria.php";
?>
        
        <div class="page-header">
          <h1>Cadastro de Categoria</h1>
        </div>


        <form class="form-horizontal" action="adiciona-categoria.php" method="get">
<!--  Museu -->
        <fieldset>

          <div class="form-group">
            <label for="unidade_contexto" class="col-sm-2 control-label">Unidade de Contexto:</label>
            <div class="col-sm-10">
              <select class="form-control" name="unidade_contexto" id="unidade_contexto">
                    <option value=""></option>
                <?php
                  $unidade_contexto = new UnidadeContexto($conexao);
                  $unidades_contextos = $unidade_contexto->listar();
                  foreach ($unidades_contextos as $uc) {
                ?>
                    <option value="<?= $uc['codigo'] ?>"><?= $uc['num_cardinal'] ?> - <?= $uc['descricao'] ?></option>
                <?php
                  }
                ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="tipo_categoria" class="col-sm-2 control-label">Tipo Categoria:</label>
            <div class="col-sm-10">
              <select class="form-control" name="tipo_categoria" id="tipo_categoria"/>
                    <option value=""></option>
                <?php
                  $tipo_categoria = new TipoCategoria($conexao);
                  $tipos_categorias = $tipo_categoria->listar();
                  foreach ($tipos_categorias as $tc) {
                ?>
                    <option value="<?= $tc['codigo'] ?>"><?= $tc['descricao'] ?></option>
                <?php
                  }
                ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="descricao" class="col-sm-2 control-label">Descrição:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="descricao" name="descricao">
            </div>
          </div>

        </fieldset>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Salvar</button>
            </div>
          </div>
        </form>

<?php include("rodape-formulario.php"); ?>