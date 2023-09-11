<?php
  include("cabecalho.php");
  require_once "class/Conecta.php";
  require_once "class/UnidadeContexto.php";
  require_once "class/TipoCategoria.php";
  require_once "class/Categoria.php";
?>
        
        <div class="page-header">
          <h1>Alteração de Categorias</h1>
        </div>

        <?php

            $codigo = $_GET['codigo'];
            $categoria = new Categoria($conexao);
            $categoria->setCodigo($codigo);
            $c = $categoria->buscar();

            $unidade_contexto = new UnidadeContexto($conexao);
            $unidade_contexto->setCodigo($c['unidade_contexto']);
            $uc = $unidade_contexto->buscar();

            $tipo_categoria = new TipoCategoria($conexao);
            $tipo_categoria->setCodigo($c['tipo_categoria']);
            $tc = $tipo_categoria->buscar();
        ?>
        <div class="alert alert-info">Codigo - <?= $c['codigo']?></div>
        <div class="alert alert-info">Descricao - <?= $c['descricao']?></div>
        <div class="alert alert-info">Unidade de contexto - <?= $c['unidade_contexto']?> - <?= $uc['descricao']?></div>
        <div class="alert alert-info">Tipo de categoria - <?= $c['tipo_categoria']?> - <?= $tc['descricao']?></div>

        <form class="form-horizontal" action="altera-categoria.php" method="post">

          <input type="hidden" name="codigo" value="<?= $c['codigo'] ?>">

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
                    <option value="<?= $uc['codigo'] ?>" <?= ($uc['codigo'] == $c['unidade_contexto']) ? 'selected' : ''?> > <?= $uc['num_cardinal'] ?> - <?= $uc['descricao'] ?> </option>
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
                    <option value="<?= $tc['codigo'] ?>" <?= ($tc['codigo'] == $c['tipo_categoria']) ? 'selected' : ''?> ><?= $tc['codigo'] ?> - <?= $tc['descricao'] ?></option>
                <?php
                  }
                ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="descricao" class="col-sm-2 control-label">Descrição:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="descricao" name="descricao" value="<?= $c['descricao'] ?>">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Salvar alterações</button>
            </div>
          </div>
        </form>

<?php include("rodape-formulario.php"); ?>