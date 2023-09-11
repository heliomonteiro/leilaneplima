<?php
  include("cabecalho.php");
  require_once "class/Conecta.php";
  require_once "class/Categoria.php";
  require_once "class/SubCategoria.php";
  require_once "class/UnidadeContexto.php";
?>
        
        <div class="page-header">
          <h1>Cadastro de SubCategoria</h1>
        </div>

<?php
        $codigo = $_GET['codigo'];

        $subcategoria = new SubCategoria($conexao);
        $subcategoria->setCodigo($codigo);
        $sc = $subcategoria->buscar();

        $categoria = new Categoria($conexao);
        $categoria->setCodigo($sc['categoria']);
        $c = $categoria->buscar();
?>

        <div class="alert alert-info">Codigo - <?= $sc['codigo']?></div>
        <div class="alert alert-info">Descricao - <?= $sc['descricao']?></div>
        <div class="alert alert-info">Categoria - <?= $c['codigo']?> - <?= $c['descricao']?></div>

        <form class="form-horizontal" action="altera-subcategoria.php" method="post">

          <input type="hidden" name="codigo" value="<?= $sc['codigo'] ?>">

          <div class="form-group">
            <label for="categoria" class="col-sm-2 control-label">Categoria:</label>
            <div class="col-sm-10">
              <select class="form-control" name="categoria" id="categoria">
                    <option value=""></option>
                <?php
                  $categorias = $categoria->listarCategoriasTipoSubCategoria();

                  foreach ($categorias as $c2) {
                    $unidade_contexto = new UnidadeContexto($conexao);
                    $unidade_contexto->setCodigo($c2['unidade_contexto']);
                    $uc = $unidade_contexto->buscar();
                ?>                                       
                    <option value="<?= $c2['codigo'] ?>" <?= ($c2['codigo'] == $c['codigo']) ? 'selected' : ''?> ><?= $uc['num_cardinal'] ?> - <?= $uc['descricao'] ?> / <?= $c2['descricao'] ?></option>
                <?php
                  }
                ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="descricao" class="col-sm-2 control-label">Descrição:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="descricao" name="descricao" value="<?= $sc['descricao'] ?>">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Salvar alterações</button>
            </div>
          </div>
        </form>

<?php include("rodape-formulario.php"); ?>