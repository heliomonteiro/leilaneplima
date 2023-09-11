<?php
  include("cabecalho.php");
  require_once "class/Conecta.php";
  require_once "class/Categoria.php";
  require_once "class/TipoCategoria.php";
  require_once "class/UnidadeContexto.php";

?>
        
        <div class="page-header">
          <h1>Cadastro de SubCategoria</h1>
        </div>


        <form class="form-horizontal" action="adiciona-subcategoria.php" method="get">
<!--  Museu -->
        <fieldset>

          <div class="form-group">
            <label for="categoria" class="col-sm-2 control-label">Categoria:</label>
            <div class="col-sm-10">
              <select class="form-control" name="categoria" id="categoria">
                    <option value=""></option>
                <?php
                  $categoria = new Categoria($conexao);
                  $categorias = $categoria->listarCategoriasTipoSubCategoria();
                  foreach ($categorias as $c) {
                    $unidade_contexto = new UnidadeContexto($conexao);
                    $unidade_contexto->setCodigo($c['unidade_contexto']);
                    $uc = $unidade_contexto->buscar();
                ?>
                    <option value="<?= $c['codigo'] ?>"><?= $uc['num_cardinal'] ?> - <?= $uc['descricao'] ?> / <?= $c['descricao'] ?></option>
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